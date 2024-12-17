<?php
class DatabaseConnection {
    private $host = 'localhost';
    private $username = 'alvin.yeboah';
    private $password = 'thyme84?pro';
    private $database = 'webtech_fall2024_alvin_yeboah';

    public function connect() {
        // Create connection
        $conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

    public function closeConnection($conn) {
        $conn->close();
    }
}
?>