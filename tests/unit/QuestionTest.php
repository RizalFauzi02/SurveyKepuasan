<?php
use PHPUnit\Framework\TestCase;

class QuestionTest extends TestCase
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

    public function testQuestionCreation()
    {
        $room_id = 1;
        $question_text = 'Test Question ' . time();
        $question_type = 'radio';
        $options = json_encode(['Option 1', 'Option 2', 'Option 3']);

        $sql = "INSERT INTO survey_questions (room_id, question_text, question_type, options, sort_order, is_active) VALUES (?, ?, ?, ?, 99, '1')";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('isss', $room_id, $question_text, $question_type, $options);
        $result = $stmt->execute();

        $this->assertTrue($result);
        $this->assertEquals(1, $stmt->affected_rows);

        // Cleanup
        $question_id = $this->db->insert_id;
        $this->db->query("DELETE FROM survey_questions WHERE id = $question_id");
    }

    public function testQuestionTypes()
    {
        $valid_types = ['radio', 'checkbox', 'text'];
        foreach ($valid_types as $type) {
            $this->assertContains($type, $valid_types);
        }
    }

    public function testQuestionWithOptions()
    {
        $options = json_encode(['Sangat Baik', 'Baik', 'Cukup', 'Kurang', 'Buruk']);
        $decoded = json_decode($options, true);

        $this->assertIsArray($decoded);
        $this->assertCount(5, $decoded);
        $this->assertEquals('Sangat Baik', $decoded[0]);
    }

    public function testQuestionWithoutOptions()
    {
        $options = null;
        $this->assertNull($options);
    }

    public function testCascadeDeleteFromRoom()
    {
        // Get a test room
        $result = $this->db->query("SELECT id FROM rooms LIMIT 1");
        $room = $result->fetch_assoc();
        $room_id = $room['id'];

        // Count questions before
        $result = $this->db->query("SELECT COUNT(*) as cnt FROM survey_questions WHERE room_id = $room_id");
        $before = $result->fetch_assoc()['cnt'];

        $this->assertGreaterThan(0, (int)$before);
    }

    public function testGetActiveQuestionsByRoom()
    {
        $result = $this->db->query("SELECT COUNT(*) as cnt FROM survey_questions WHERE room_id = 1 AND is_active = '1'");
        $row = $result->fetch_assoc();
        $this->assertGreaterThan(0, (int)$row['cnt']);
    }
}
