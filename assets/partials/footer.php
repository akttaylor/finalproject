<?php
function renderFooter() {
    echo '<footer class="footer">';
    echo '    <div class="footer-content">';
    echo '        <div class="footer-section">';
    echo '            <h3>Quick Links</h3>';
    echo '            <a href="#home">Home</a>';
    echo '            <a href="#services">Services</a>';
    echo '            <a href="#about">About</a>';
    echo '            <a href="#cars">Cars</a>';
    echo '            <a href="#contact">Contact</a>';
    echo '        </div>';
    echo '        <div class="footer-section">';
    echo '            <h3>Follow Us</h3>';
    echo '            <div class="social-icons">';
    echo '                <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>';
    echo '                <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>';
    echo '                <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>';
    echo '                <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>';
    echo '            </div>';
    echo '        </div>';
    echo '        <div class="footer-section">';
    echo '            <h3>Newsletter</h3>';
    echo '            <form class="newsletter-form">';
    echo '                <input type="email" placeholder="Enter your email" required>';
    echo '                <button type="submit" class="btn">Subscribe</button>';
    echo '            </form>';
    echo '        </div>';
    echo '    </div>';
    echo '    <div class="footer-bottom">';
    echo '        <p>&copy; 2024 Taylor Automobile. All rights reserved.</p>';
    echo '    </div>';
    echo '</footer>';
}
?>
