<?php
// actions/test_drive_actions.php
require_once '../config/database.php';

class TestDriveActions {
    private $conn;

    public function __construct($database_connection) {
        $this->conn = $database_connection;
    }

    // Book Test Drive
    public function bookTestDrive($user_id, $vehicle_id, $booking_date, $preferred_time) {
        // First, check vehicle availability
        $vehicle_check = $this->conn->prepare("SELECT availability_status FROM Vehicles WHERE vehicle_id = ?");
        $vehicle_check->bind_param("i", $vehicle_id);
        $vehicle_check->execute();
        $vehicle_result = $vehicle_check->get_result();
        $vehicle = $vehicle_result->fetch_assoc();

        if ($vehicle['availability_status'] !== 'available') {
            return ['success' => false, 'message' => 'Vehicle not available for test drive'];
        }

        // Book test drive
        $stmt = $this->conn->prepare("INSERT INTO TestDrives (user_id, vehicle_id, booking_date, preferred_time) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $user_id, $vehicle_id, $booking_date, $preferred_time);

        try {
            $result = $stmt->execute();
            
            // Update vehicle status to reserved
            if ($result) {
                $update_stmt = $this->conn->prepare("UPDATE Vehicles SET availability_status = 'reserved' WHERE vehicle_id = ?");
                $update_stmt->bind_param("i", $vehicle_id);
                $update_stmt->execute();
            }

            return $result 
                ? ['success' => true, 'message' => 'Test drive booked successfully']
                : ['success' => false, 'message' => 'Test drive booking failed'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    // Get User's Test Drive Bookings
    public function getUserTestDrives($user_id) {
        $stmt = $this->conn->prepare("
            SELECT td.*, v.make, v.model, v.year 
            FROM TestDrives td 
            JOIN Vehicles v ON td.vehicle_id = v.vehicle_id 
            WHERE td.user_id = ?
        ");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $test_drives = [];
        while ($row = $result->fetch_assoc()) {
            $test_drives[] = $row;
        }

        return [
            'success' => true, 
            'test_drives' => $test_drives
        ];
    }

    // Cancel Test Drive
    public function cancelTestDrive($test_drive_id, $user_id) {
        // Begin transaction
        $this->conn->begin_transaction();

        try {
            // Get vehicle ID associated with this test drive
            $vehicle_stmt = $this->conn->prepare("SELECT vehicle_id FROM TestDrives WHERE test_drive_id = ? AND user_id = ?");
            $vehicle_stmt->bind_param("ii", $test_drive_id, $user_id);
            $vehicle_stmt->execute();
            $vehicle_result = $vehicle_stmt->get_result();
            
            if ($vehicle_result->num_rows === 0) {
                $this->conn->rollback();
                return ['success' => false, 'message' => 'Test drive not found'];
            }

            $vehicle = $vehicle_result->fetch_assoc();
            $vehicle_id = $vehicle['vehicle_id'];

            // Update test drive status
            $update_stmt = $this->conn->prepare("UPDATE TestDrives SET status = 'cancelled' WHERE test_drive_id = ?");
            $update_stmt->bind_param("i", $test_drive_id);
            $update_stmt->execute();

            // Restore vehicle availability
            $vehicle_update_stmt = $this->conn->prepare("UPDATE Vehicles SET availability_status = 'available' WHERE vehicle_id = ?");
            $vehicle_update_stmt->bind_param("i", $vehicle_id);
            $vehicle_update_stmt->execute();

            // Commit transaction
            $this->conn->commit();

            return ['success' => true, 'message' => 'Test drive cancelled successfully'];
        } catch (Exception $e) {
            $this->conn->rollback();
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
?>