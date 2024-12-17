<?php
function renderHeader()
{
    $baseURL = '/Webtech final/';
    echo '<header class="header">';
    echo '    <nav class="navbar">';
    echo '        <div class="navbar-container">';
    echo '            <a href="' . $baseURL . 'index.php" class="logo">';
    echo '                <svg width="50" height="50" viewBox="0 0 100 100">';
    echo '                    <circle cx="50" cy="50" r="40" stroke="#007bff" stroke-width="8" fill="none" />';
    echo '                    <polygon points="40,30 65,50 40,70" fill="#007bff" />';
    echo '                </svg>';
    echo '                Taylor Auto';
    echo '            </a>';
    echo '            <div class="nav-links">';
    echo '                <a href="' . $baseURL . '#services" class="nav-link">Services</a>';
    echo '                <a href="' . $baseURL . '#about" class="nav-link">About</a>';
    echo '                <a href="' . $baseURL . 'view/cars.php" class="nav-link">Cars</a>';
    echo '                <a href="' . $baseURL . '#contact" class="nav-link">Contact</a>';
    echo '            </div>';
    echo '            <a href="' . $baseURL . 'view/auth.php" class="btn login-btn">Log In / Sign Up</a>';
    echo '            <div class="hamburger">';
    echo '                <span></span>';
    echo '                <span></span>';
    echo '                <span></span>';
    echo '            </div>';
    echo '        </div>';
    echo '    </nav>';
    echo '</header>';
}

