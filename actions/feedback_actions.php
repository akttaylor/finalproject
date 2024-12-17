<?php
require_once '../config/database.php';

class FeedbackActions {
    private $conn;

    public function __construct($database_connection) {
        $this->conn = $database_connection;
    }

    // Submit Feedback
    public function submitFeedback($user_id, $vehicle_id, $rating, $comment) {
        // Validate rating
        if ($rating < 1 || $rating > 5) {
            return ['success' => false, 'message' => 'Invalid rating. Must be between 1 and 5'];
        }

        $stmt = $this->conn->prepare("
            INSERT INTO Feedback (user_id, vehicle_id, rating, comment) 
            VALUES (?, ?, ?, ?)
        ");
        $stmt->bind_param("iiss", $user_id, $vehicle_id, $rating, $comment);

        try {
            $result = $stmt->execute();
            return $result 
                ? ['success' => true, 'message' => 'Feedback submitted successfully']
                : ['success' => false, 'message' => 'Feedback submission failed'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    // Get Vehicle Feedback
    public function getVehicleFeedback($vehicle_id) {
        $stmt = $this->conn->prepare("
            SELECT f.*, u.name, 
            FROM Feedback f
            JOIN Users u ON f.user_id = u.user_id
            WHERE f.vehicle_id = ?
            ORDER BY f.created_at DESC
        ");
        $stmt->bind_param("i", $vehicle_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $feedbacks = [];
        while ($row = $result->fetch_assoc()) {
            $feedbacks[] = $row;
        }

        // Calculate average rating
        $rating_stmt = $this->conn->prepare("SELECT AVG(rating) as avg_rating FROM Feedback WHERE vehicle_id = ?");
        $rating_stmt->bind_param("i", $vehicle_id);
        $rating_stmt->execute();
        $rating_result = $rating_stmt->get_result()->fetch_assoc();

        return [
            'success' => true, 
            'feedbacks' => $feedbacks,
            'average_rating' => round($rating_result['avg_rating'], 2)
        ];
    }
}
?>