<?php
// actions/user_actions.php
require_once '../db/db.php';
require_once '../utils/password_security.php';

class UserActions {
    private $conn;

    public function __construct($database_connection) {
        $this->conn = $database_connection;
    }

    // User Registration
    public function registerUser($name, $email, $phone, $password) {
        // Validate input
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'message' => 'Invalid email format'];
        }

        // Hash password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Prepare SQL
        $stmt = $this->conn->prepare("INSERT INTO Users ( name, email, phone_number, password_hash) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssss",  $name, $email, $phone, $hashed_password);

        try {
            $result = $stmt->execute();
            return $result 
                ? ['success' => true, 'message' => 'User registered successfully']
                : ['success' => false, 'message' => 'Registration failed'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    // User Login
    public function loginUser($email, $password) {
        $stmt = $this->conn->prepare("SELECT user_id, password_hash FROM Users WHERE email = ? ");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return ['success' => false, 'message' => 'User not found'];
        }

        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password_hash'])) {
            // Update last login
            $update_stmt = $this->conn->prepare("UPDATE Users SET last_login = CURRENT_TIMESTAMP WHERE user_id = ?");
            $update_stmt->bind_param("i", $user['user_id']);
            $update_stmt->execute();

            return [
                'success' => true, 
                'message' => 'Login successful',
                'user_id' => $user['user_id']
            ];
        }

        return ['success' => false, 'message' => 'Invalid credentials'];
    }

    // Update User Profile
    public function updateProfile($user_id, $name, $phone_number) {
        $stmt = $this->conn->prepare("UPDATE Users SET name = ?, phone_number = ? WHERE user_id = ?");
        $stmt->bind_param("sssi", $name, $phone_number, $user_id);

        try {
            $result = $stmt->execute();
            return $result 
                ? ['success' => true, 'message' => 'Profile updated successfully']
                : ['success' => false, 'message' => 'Profile update failed'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
?>