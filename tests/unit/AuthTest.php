<?php
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
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

    public function testPasswordHashWorks()
    {
        $password = 'password123';
        $hash = password_hash($password, PASSWORD_BCRYPT);

        $this->assertNotEmpty($hash);
        $this->assertTrue(password_verify($password, $hash));
        $this->assertFalse(password_verify('wrongpassword', $hash));
    }

    public function testUserExists()
    {
        $result = $this->db->query("SELECT * FROM users WHERE username = 'superadmin'");
        $this->assertGreaterThanOrEqual(1, $result->num_rows);
    }

    public function testUserPasswordVerification()
    {
        $result = $this->db->query("SELECT password FROM users WHERE username = 'superadmin'");
        $row = $result->fetch_assoc();

        // Default password is 'password' (bcrypt hash)
        $this->assertTrue(password_verify('password', $row['password']));
        $this->assertFalse(password_verify('wrongpassword', $row['password']));
    }

    public function testInvalidUsernameReturnsEmpty()
    {
        $result = $this->db->query("SELECT * FROM users WHERE username = 'nonexistent_user_xyz'");
        $this->assertEquals(0, $result->num_rows);
    }

    public function testRoleValidation()
    {
        $result = $this->db->query("SELECT is_role FROM users WHERE username = 'superadmin'");
        $row = $result->fetch_assoc();
        $this->assertContains($row['is_role'], ['1', '2']);
    }
}
