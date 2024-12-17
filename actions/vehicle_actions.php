<?php
// actions/vehicle_actions.php
require_once '../config/database.php';

class VehicleActions {
    private $conn;

    public function __construct($database_connection) {
        $this->conn = $database_connection;
    }

    // Get All Available Vehicles
    public function getAllAvailableVehicles() {
        $stmt = $this->conn->prepare("SELECT * FROM Vehicles WHERE availability_status = 'available'");
        $stmt->execute();
        $result = $stmt->get_result();

        $vehicles = [];
        while ($row = $result->fetch_assoc()) {
            $vehicles[] = $row;
        }

        return [
            'success' => true, 
            'vehicles' => $vehicles
        ];
    }

    // Get Vehicle Details
    public function getVehicleDetails($vehicle_id) {
        $stmt = $this->conn->prepare("SELECT * FROM Vehicles WHERE vehicle_id = ?");
        $stmt->bind_param("i", $vehicle_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return ['success' => false, 'message' => 'Vehicle not found'];
        }

        return [
            'success' => true, 
            'vehicle' => $result->fetch_assoc()
        ];
    }

    // Update Vehicle Availability
    public function updateVehicleAvailability($vehicle_id, $status) {
        $stmt = $this->conn->prepare("UPDATE Vehicles SET availability_status = ? WHERE vehicle_id = ?");
        $stmt->bind_param("si", $status, $vehicle_id);

        try {
            $result = $stmt->execute();
            return $result 
                ? ['success' => true, 'message' => 'Vehicle availability updated']
                : ['success' => false, 'message' => 'Update failed'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
?>