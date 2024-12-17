<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taylor Automobile - Login/Signup</title>
    <link rel="stylesheet" href="../assets/css/auth.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../assets/css/index.css">
</head>
<body>
    <div class="loader">
        <div class="loader-content">
            <svg width="100" height="100" viewBox="0 0 100 100">
                <circle cx="50" cy="50" r="40" stroke="#007bff" stroke-width="8" fill="none" />
                <polygon points="40,30 65,50 40,70" fill="#007bff" />
            </svg>
            <p>Taylor Automobile</p>
        </div>
    </div>
    <div class="auth-page">
        <div class="auth-image">
            <div class="auth-logo">
                <svg width="50" height="50" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="40" stroke="#007bff" stroke-width="8" fill="none" />
                    <polygon points="40,30 65,50 40,70" fill="#007bff" />
                </svg>
                <span>Taylor Automobile</span>
            </div>
        </div>
        <div class="auth-form-container">
            <div class="auth-form-content">
                <h2 id="auth-title">Login to your account</h2>
                <p class="auth-description">Enter your email below to login to your account</p>
                <form id="auth-form" class="auth-form" method="POST" action="../actions/user_actions.php">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="name@example.com" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="form-group" id="name-group" style="display: none;">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter your full name">
                    </div>
                    <button type="submit" class="btn-submit">Login</button>
                </form>
                <p class="auth-toggle">
                    <span id="toggle-text">Don't have an account?</span>
                    <a href="#" id="toggle-auth">Sign Up</a>
                </p>
            </div>
        </div>
    </div>
    <script src="../assets/js/auth.js"></script>
    <script src="../assets/js/loader.js"></script>

    <?php
    require_once '../actions/user_actions.php';
    require_once '../db/db.php';

    $database = new DatabaseConnection();
    $conn = $database->connect();
    $userActions = new UserActions($conn);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['name'])) {
            // Registration
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = ''; // You can add a phone field if needed

            $result = $userActions->registerUser($name, $email, $phone, $password);
            echo "<script>Swal.fire({icon: '" . ($result['success'] ? "success" : "error") . "', title: '" . $result['message'] . "'});</script>";
        } else {
            // Login
            $email = $_POST['email'];
            $password = $_POST['password'];

            $result = $userActions->loginUser($email, $password);
            echo "<script>Swal.fire({icon: '" . ($result['success'] ? "success" : "error") . "', title: '" . $result['message'] . "'});</script>";

            if ($result['success']) {
                // Redirect to the dashboard or home page
                echo "<script>window.location.href = 'index.php';</script>";
            }
        }
    }
    ?>
</body>
</html>