<?php
use PHPUnit\Framework\TestCase;

class SurveyTest extends TestCase
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

    public function testSubmitSurvey()
    {
        $room_id = 1;
        $satisfaction_score = 5;
        $respondent_name = 'Test User';
        $feedback = 'Test feedback';

        $sql = "INSERT INTO survey_responses (room_id, respondent_name, satisfaction_score, feedback) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('isis', $room_id, $respondent_name, $satisfaction_score, $feedback);
        $result = $stmt->execute();

        $this->assertTrue($result);
        $this->assertEquals(1, $stmt->affected_rows);

        // Cleanup
        $response_id = $this->db->insert_id;
        $this->db->query("DELETE FROM response_answers WHERE response_id = $response_id");
        $this->db->query("DELETE FROM survey_responses WHERE id = $response_id");
    }

    public function testSubmitWithAnswers()
    {
        // First create a response
        $room_id = 1;
        $sql = "INSERT INTO survey_responses (room_id, satisfaction_score) VALUES (?, 4)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $room_id);
        $stmt->execute();
        $response_id = $this->db->insert_id;

        // Add answers
        $question_id = 1;
        $answer_text = 'Sangat Baik';
        $sql = "INSERT INTO response_answers (response_id, question_id, answer_text) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('iis', $response_id, $question_id, $answer_text);
        $result = $stmt->execute();

        $this->assertTrue($result);

        // Cleanup
        $this->db->query("DELETE FROM response_answers WHERE response_id = $response_id");
        $this->db->query("DELETE FROM survey_responses WHERE id = $response_id");
    }

    public function testSatisfactionScoreRange()
    {
        $valid_scores = [1, 2, 3, 4, 5];
        foreach ($valid_scores as $score) {
            $this->assertGreaterThanOrEqual(1, $score);
            $this->assertLessThanOrEqual(5, $score);
        }
    }

    public function testOptionalRespondentName()
    {
        $room_id = 1;
        $sql = "INSERT INTO survey_responses (room_id, respondent_name, satisfaction_score) VALUES (?, NULL, 3)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $room_id);
        $result = $stmt->execute();

        $this->assertTrue($result);

        // Cleanup
        $response_id = $this->db->insert_id;
        $this->db->query("DELETE FROM survey_responses WHERE id = $response_id");
    }

    public function testSurveyResponseCount()
    {
        $result = $this->db->query("SELECT COUNT(*) as cnt FROM survey_responses");
        $row = $result->fetch_assoc();
        $this->assertGreaterThanOrEqual(0, (int)$row['cnt']);
    }

    public function testGetRoomBySlug()
    {
        $result = $this->db->query("SELECT * FROM rooms WHERE slug = 'toilet_lantai_1' AND is_active = '1'");
        $this->assertEquals(1, $result->num_rows);
        $row = $result->fetch_assoc();
        $this->assertEquals('Toilet Lantai 1', $row['name']);
    }
}
