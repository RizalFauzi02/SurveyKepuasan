<?php
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $db;

    protected function setUp(): void
    {
        $this->db = new mysqli('localhost', 'root', '', 'db_survey');
        $this->db->set_charset('utf8mb4');
    }

    protected function tearDown(): void
    {
        if ($this->db) {
            $this->db->close();
        }
    }

    public function testCreateUser()
    {
        $username = 'test_user_' . time();
        $password = password_hash('password123', PASSWORD_BCRYPT);
        $unit = 'Test Unit';

        $sql = "INSERT INTO users (username, password, unit, is_role, is_active) VALUES (?, ?, ?, '2', '1')";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('sss', $username, $password, $unit);
        $result = $stmt->execute();

        $this->assertTrue($result);
        $this->assertEquals(1, $stmt->affected_rows);

        // Cleanup
        $this->db->query("DELETE FROM users WHERE username = '$username'");
    }

    public function testDuplicateUsername()
    {
        // Try to insert duplicate username - should fail due to unique constraint
        $password = password_hash('test', PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (username, password, unit, is_role, is_active) VALUES ('superadmin', '$password', 'Unit', '2', '1')";

        try {
            $result = $this->db->query($sql);
            // If no exception, the insert succeeded (shouldn't happen)
            $this->fail('Expected exception for duplicate username');
        } catch (mysqli_sql_exception $e) {
            // Expected: duplicate entry exception
            $this->assertStringContainsString('Duplicate entry', $e->getMessage());
        }
    }

    public function testUpdateUser()
    {
        // Insert test user
        $username = 'test_update_' . time();
        $password = password_hash('password123', PASSWORD_BCRYPT);
        $this->db->query("INSERT INTO users (username, password, unit, is_role, is_active) VALUES ('$username', '$password', 'Unit', '2', '1')");
        $user_id = $this->db->insert_id;

        // Update
        $new_unit = 'Updated Unit';
        $stmt = $this->db->prepare("UPDATE users SET unit = ? WHERE id_user = ?");
        $stmt->bind_param('si', $new_unit, $user_id);
        $result = $stmt->execute();

        $this->assertTrue($result);

        // Verify
        $result = $this->db->query("SELECT unit FROM users WHERE id_user = $user_id");
        $row = $result->fetch_assoc();
        $this->assertEquals('Updated Unit', $row['unit']);

        // Cleanup
        $this->db->query("DELETE FROM users WHERE id_user = $user_id");
    }

    public function testDeleteUser()
    {
        $username = 'test_delete_' . time();
        $password = password_hash('password123', PASSWORD_BCRYPT);
        $this->db->query("INSERT INTO users (username, password, unit, is_role, is_active) VALUES ('$username', '$password', 'Unit', '2', '1')");
        $user_id = $this->db->insert_id;

        $stmt = $this->db->prepare("DELETE FROM users WHERE id_user = ?");
        $stmt->bind_param('i', $user_id);
        $result = $stmt->execute();

        $this->assertTrue($result);
        $this->assertEquals(1, $stmt->affected_rows);
    }

    public function testUsernameUniqueness()
    {
        $username = 'unique_test_' . uniqid();

        // First insert
        $password = password_hash('password123', PASSWORD_BCRYPT);
        $this->db->query("INSERT INTO users (username, password, unit, is_role, is_active) VALUES ('$username', '$password', 'Unit', '2', '1')");
        $user_id = $this->db->insert_id;

        // Check if unique (should have exactly 1 match)
        $result = $this->db->query("SELECT COUNT(*) as cnt FROM users WHERE username = '$username'");
        $row = $result->fetch_assoc();
        $this->assertEquals(1, $row['cnt']);

        // Check if unique excluding own id (should be 0 matches)
        $result = $this->db->query("SELECT COUNT(*) as cnt FROM users WHERE username = '$username' AND id_user != $user_id");
        $row = $result->fetch_assoc();
        $this->assertEquals(0, $row['cnt']);

        // Cleanup
        $this->db->query("DELETE FROM users WHERE id_user = $user_id");
    }
}
