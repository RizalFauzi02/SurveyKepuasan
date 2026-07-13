<?php
use PHPUnit\Framework\TestCase;

class RoomTest extends TestCase
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

    public function testRoomCreation()
    {
        $name = 'Test Room ' . time();
        $slug = strtolower(str_replace(' ', '_', $name));
        $floor = 1;
        $facility_type = 'Test Facility';

        $sql = "INSERT INTO rooms (name, slug, floor, facility_type, is_active, sort_order) VALUES (?, ?, ?, ?, '1', 0)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ssis', $name, $slug, $floor, $facility_type);
        $result = $stmt->execute();

        $this->assertTrue($result);
        $this->assertEquals(1, $stmt->affected_rows);

        // Cleanup
        $this->db->query("DELETE FROM rooms WHERE slug = '$slug'");
    }

    public function testSlugUniqueness()
    {
        $slug = 'unique_slug_test_' . uniqid();

        $this->db->query("INSERT INTO rooms (name, slug, floor, facility_type, is_active, sort_order) VALUES ('Test', '$slug', 1, 'Type', '1', 0)");

        // Try to insert duplicate slug - should fail
        try {
            $this->db->query("INSERT INTO rooms (name, slug, floor, facility_type, is_active, sort_order) VALUES ('Test2', '$slug', 2, 'Type2', '1', 0)");
            $this->fail('Expected exception for duplicate slug');
        } catch (mysqli_sql_exception $e) {
            $this->assertStringContainsString('Duplicate entry', $e->getMessage());
        }

        // Cleanup
        $this->db->query("DELETE FROM rooms WHERE slug = '$slug'");
    }

    public function testRoomUpdate()
    {
        $name = 'Update Room ' . time();
        $slug = strtolower(str_replace(' ', '_', $name));
        $this->db->query("INSERT INTO rooms (name, slug, floor, facility_type, is_active, sort_order) VALUES ('$name', '$slug', 1, 'Type', '1', 0)");
        $room_id = $this->db->insert_id;

        $new_name = 'Updated Room';
        $stmt = $this->db->prepare("UPDATE rooms SET name = ? WHERE id = ?");
        $stmt->bind_param('si', $new_name, $room_id);
        $result = $stmt->execute();

        $this->assertTrue($result);

        $result = $this->db->query("SELECT name FROM rooms WHERE id = $room_id");
        $row = $result->fetch_assoc();
        $this->assertEquals('Updated Room', $row['name']);

        // Cleanup
        $this->db->query("DELETE FROM rooms WHERE id = $room_id");
    }

    public function testRoomDelete()
    {
        $slug = 'delete_room_' . time();
        $this->db->query("INSERT INTO rooms (name, slug, floor, facility_type, is_active, sort_order) VALUES ('Delete Me', '$slug', 1, 'Type', '1', 0)");
        $room_id = $this->db->insert_id;

        $stmt = $this->db->prepare("DELETE FROM rooms WHERE id = ?");
        $stmt->bind_param('i', $room_id);
        $result = $stmt->execute();

        $this->assertTrue($result);
        $this->assertEquals(1, $stmt->affected_rows);
    }

    public function testActiveRoomsCount()
    {
        $result = $this->db->query("SELECT COUNT(*) as cnt FROM rooms WHERE is_active = '1'");
        $row = $result->fetch_assoc();
        $this->assertGreaterThan(0, (int)$row['cnt']);
    }

    public function testRoomGetBySlug()
    {
        $result = $this->db->query("SELECT * FROM rooms WHERE slug = 'toilet_lantai_1' AND is_active = '1'");
        $this->assertEquals(1, $result->num_rows);
    }
}
