<?php
// actions/purchase_actions.php
require_once '../config/database.php';

class PurchaseActions {
    private $conn;

    public function __construct($database_connection) {
        $this->conn = $database_connection;
    }

    // Initiate Purchase
    public function initiatePurchase($user_id, $vehicle_id) {
        // Check vehicle availability
        $vehicle_check = $this->conn->prepare("SELECT availability_status, price FROM Vehicles WHERE vehicle_id = ?");
        $vehicle_check->bind_param("i", $vehicle_id);
        $vehicle_check->execute();
        $vehicle_result = $vehicle_check->get_result();
        $vehicle = $vehicle_result->fetch_assoc();

        if ($vehicle['availability_status'] !== 'available') {
            return ['success' => false, 'message' => 'Vehicle not available for purchase'];
        }

        // Create purchase record
        $stmt = $this->conn->prepare("INSERT INTO Purchases (user_id, vehicle_id, purchase_price) VALUES (?, ?, ?)");
        $stmt->bind_param("iid", $user_id, $vehicle_id, $vehicle['price']);

        try {
            $this->conn->begin_transaction();

            $result = $stmt->execute();
            $purchase_id = $stmt->insert_id;

            // Update vehicle status
            $update_stmt = $this->conn->prepare("UPDATE Vehicles SET availability_status = 'reserved' WHERE vehicle_id = ?");
            $update_stmt->bind_param("i", $vehicle_id);
            $update_stmt->execute();

            $this->conn->commit();

            return [
                'success' => true, 
                'message' => 'Purchase initiated successfully',
                'purchase_id' => $purchase_id,
                'vehicle_price' => $vehicle['price']
            ];
        } catch (Exception $e) {
            $this->conn->rollback();
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function completePurchase($purchase_id, $user_id) {
        $stmt = $this->conn->prepare("
            UPDATE Purchases p
            JOIN Vehicles v ON p.vehicle_id = v.vehicle_id
            SET p.status = 'completed', 
                v.availability_status = 'sold'
            WHERE p.purchase_id = ? AND p.user_id = ? AND p.status = 'pending'
        ");
        $stmt->bind_param("ii", $purchase_id, $user_id);

        try {
            $result = $stmt->execute();
            return $result 
                ? ['success' => true, 'message' => 'Purchase completed successfully']
                : ['success' => false, 'message' => 'Purchase completion failed'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    // Get User Purchase History
    public function getUserPurchaseHistory($user_id) {
        $stmt = $this->conn->prepare("
            SELECT p.*, v.make, v.model, v.year, v.color 
            FROM Purchases p
            JOIN Vehicles v ON p.vehicle_id = v.vehicle_id
            WHERE p.user_id = ?
            ORDER BY p.purchase_date DESC
        ");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $purchases = [];
        while ($row = $result->fetch_assoc()) {
            $purchases[] = $row;
        }

        return [
            'success' => true, 
            'purchases' => $purchases
        ];
    }

    // Cancel Purchase
    public function cancelPurchase($purchase_id, $user_id) {
        $this->conn->begin_transaction();

        try {
            // Get vehicle ID associated with this purchase
            $vehicle_stmt = $this->conn->prepare("SELECT vehicle_id FROM Purchases WHERE purchase_id = ? AND user_id = ?");
            $vehicle_stmt->bind_param("ii", $purchase_id, $user_id);
            $vehicle_stmt->execute();
            $vehicle_result = $vehicle_stmt->get_result();
            
            if ($vehicle_result->num_rows === 0) {
                $this->conn->rollback();
                return ['success' => false, 'message' => 'Purchase not found'];
            }

            $vehicle = $vehicle_result->fetch_assoc();
            $vehicle_id = $vehicle['vehicle_id'];

            // Update purchase status
            $update_stmt = $this->conn->prepare("UPDATE Purchases SET status = 'cancelled' WHERE purchase_id = ?");
            $update_stmt->bind_param("i", $purchase_id);
            $update_stmt->execute();

            // Restore vehicle availability
            $vehicle_update_stmt = $this->conn->prepare("UPDATE Vehicles SET availability_status = 'available' WHERE vehicle_id = ?");
            $vehicle_update_stmt->bind_param("i", $vehicle_id);
            $vehicle_update_stmt->execute();

            // Commit transaction
            $this->conn->commit();

            return ['success' => true, 'message' => 'Purchase cancelled successfully'];
        } catch (Exception $e) {
            $this->conn->rollback();
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
?>