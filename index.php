<?php
include 'assets/partials/header.php';
include 'assets/partials/footer.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taylor Automobile - Luxury Redefined</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/ScrollTrigger.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
    <?php renderHeader(); ?>
    <main>
        <section id="home" class="hero">
            <div class="hero-content">
                <h1 class="glitch" data-text="Luxury Redefined">Luxury Redefined</h1>
                <p class="subtitle">Experience automotive excellence with Taylor Automobile</p>
                <a href="#cars" class="btn cta-btn">Explore Our Fleet</a>
            </div>
            <div class="hero-image"></div>
        </section>

        <section id="services" class="services">
            <h2 class="section-title">Our Premium Services</h2>
            <div class="service-cards">
                <div class="service-card">
                    <i class="fas fa-car-side"></i>
                    <h3>Luxury Rentals</h3>
                    <p>Experience the thrill of driving premium vehicles for any occasion.</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-tags"></i>
                    <h3>Exclusive Sales</h3>
                    <p>Own the car of your dreams from our curated collection of luxury vehicles.</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-tools"></i>
                    <h3>Test Drives</h3>
                    <p>Keep your prized possession in perfect condition with our specialized care.</p>
                </div>
            </div>
        </section>

        <section id="about" class="about">
            <div class="about-content">
                <h2 class="section-title">The Taylor Difference</h2>
                <p>At Taylor Automobile, we redefine the art of automotive luxury. Our passion for excellence drives us to provide an unparalleled experience in car sales, rentals, and maintenance. With a legacy of trust and a future of innovation, we're not just selling cars – we're crafting dreams on wheels.</p>
                <div class="stats">
                    <div class="stat">
                        <span class="stat-number">5000+</span>
                        <span class="stat-label">Happy Clients</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">500+</span>
                        <span class="stat-label">Luxury Vehicles</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">20+</span>
                        <span class="stat-label">Years of Excellence</span>
                    </div>
                </div>
            </div>
        </section>

        <section id="cars" class="cars">
            <h2 class="section-title">Our Exclusive Collection</h2>
            <div class="car-slider">
                <div class="car-card">
                    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Luxury Sedan">
                    <div class="car-info">
                        <h3>Elegant Cruiser</h3>
                        <p>Experience unmatched comfort and style</p>
                        <a href="#" class="btn">Learn More</a>
                    </div>
                </div>
                <div class="car-card">
                    <img src="https://images.unsplash.com/photo-1583121274602-3e2820c69888?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Sports Car">
                    <div class="car-info">
                        <h3>Speed Demon</h3>
                        <p>Feel the thrill of pure performance</p>
                        <a href="#" class="btn">Learn More</a>
                    </div>
                </div>
                <div class="car-card">
                    <img src="https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Luxury SUV">
                    <div class="car-info">
                        <h3>Family Luxury</h3>
                        <p>Spacious comfort meets cutting-edge technology</p>
                        <a href="#" class="btn">Learn More</a>
                    </div>
                </div>
                <div class="car-card">
                    <img src="https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Luxury SUV">
                    <div class="car-info">
                        <h3>Family Luxury</h3>
                        <p>Spacious comfort meets cutting-edge technology</p>
                        <a href="#" class="btn">Learn More</a>
                    </div>
                </div>
                <div class="car-card">
                    <img src="https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Luxury SUV">
                    <div class="car-info">
                        <h3>Family Luxury</h3>
                        <p>Spacious comfort meets cutting-edge technology</p>
                        <a href="#" class="btn">Learn More</a>
                    </div>
                </div>
                <div class="car-card">
                    <img src="https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Luxury SUV">
                    <div class="car-info">
                        <h3>Family Luxury</h3>
                        <p>Spacious comfort meets cutting-edge technology</p>
                        <a href="#" class="btn">Learn More</a>
                    </div>
                </div>
            </div>
        </section>

        <section id="contact" class="contact">
            <h2 class="section-title">Get in Touch</h2>
            <div class="contact-container">
                <form id="contact-form" class="contact-form">
                    <input type="text" name="name" placeholder="Your Name" required>
                    <input type="email" name="email" placeholder="Your Email" required>
                    <textarea name="message" placeholder="Your Message" required></textarea>
                    <button type="submit" class="btn submit-btn">Send Message</button>
                </form>
                <div class="contact-info">
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>123 Luxury Lane, Accra, Ghana</p>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-phone"></i>
                        <p>+233 20 1234 5678</p>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <p>info@taylorauto.com</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php renderFooter(); ?>
    <script src="assets/js/index.js"></script>
    <script src="assets/js/loader.js"></script>

</body>
</html>