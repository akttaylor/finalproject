<?php
class PasswordSecurity {
    // Password complexity requirements
    public static function validatePassword($password) {
        // Minimum 8 characters
        if (strlen($password) < 8) {
            return false;
        }

        // At least one uppercase letter
        if (!preg_match("/[A-Z]/", $password)) {
            return false;
        }

        // At least one lowercase letter
        if (!preg_match("/[a-z]/", $password)) {
            return false;
        }

        // At least one number
        if (!preg_match("/[0-9]/", $password)) {
            return false;
        }

        // At least one special character
        if (!preg_match("/[!@#$%^&*()_+\-=\[\]{};':\"\\|,.<>\/?]/", $password)) {
            return false;
        }

        return true;
    }

    // Generate a secure random token
    public static function generateToken($length = 32) {
        return bin2hex(random_bytes($length));
    }
}
?>