document.addEventListener('DOMContentLoaded', () => {
    const loader = document.querySelector('.loader');
    
    const initializeMainScript = () => {
        // Navbar functionality
        const hamburger = document.querySelector('.hamburger');
        const navLinks = document.querySelector('.nav-links');

        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            hamburger.classList.toggle('active');
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Parallax effect for hero section
        const parallaxElements = document.querySelectorAll('.parallax');
        window.addEventListener('scroll', () => {
            let scrollPosition = window.pageYOffset;
            parallaxElements.forEach(el => {
                el.style.backgroundPositionY = scrollPosition * 0.7 + 'px';
            });
        });

        // Animate elements on scroll
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('.float-element');
            elements.forEach(el => {
                const elementTop = el.getBoundingClientRect().top;
                const elementBottom = el.getBoundingClientRect().bottom;
                if (elementTop < window.innerHeight && elementBottom > 0) {
                    el.classList.add('animate');
                } else {
                    el.classList.remove('animate');
                }
            });
        };

        window.addEventListener('scroll', animateOnScroll);
        animateOnScroll(); // Initial check on page load

        // Glitch effect for hero title
        const glitchText = document.querySelector('.glitch-text');
        if (glitchText) {
            setInterval(() => {
                glitchText.classList.add('glitch');
                setTimeout(() => {
                    glitchText.classList.remove('glitch');
                }, 200);
            }, 3000);
        }

        // 3D card rotation effect
        const cards = document.querySelectorAll('.card-3d');
        cards.forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                const rotateX = (y - centerY) / 10;
                const rotateY = (centerX - x) / 10;

                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0)';
            });
        });

        // Neon text pulsing effect
        const neonTexts = document.querySelectorAll('.neon-text');
        neonTexts.forEach(text => {
            setInterval(() => {
                text.style.textShadow = '0 0 5px #fff, 0 0 10px #fff, 0 0 15px #fff, 0 0 20px #ff00de, 0 0 35px #ff00de, 0 0 40px #ff00de';
                setTimeout(() => {
                    text.style.textShadow = '0 0 5px #fff, 0 0 10px #fff, 0 0 15px #fff, 0 0 20px #ff00de, 0 0 35px #ff00de';
                }, 100);
            }, 2000);
        });

        // Contact form submission
        const contactForm = document.getElementById('contact-form');
        if (contactForm) {
            contactForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const name = contactForm.querySelector('[name="name"]').value;
                const email = contactForm.querySelector('[name="email"]').value;
                const message = contactForm.querySelector('[name="message"]').value;

                // Here you would typically send the data to your server
                // For demonstration, we'll just show a success message
                Swal.fire({
                    icon: 'success',
                    title: 'Message Sent',
                    text: 'We will get back to you soon!',
                    background: 'rgba(0, 0, 0, 0.8)',
                    color: '#fff',
                    confirmButtonColor: '#3085d6',
                }).then(() => {
                    contactForm.reset();
                });
            });
        }

        // Car slider functionality
        const carSlider = document.querySelector('.car-slider');
        if (carSlider) {
            let isDown = false;
            let startX;
            let scrollLeft;

            carSlider.addEventListener('mousedown', (e) => {
                isDown = true;
                startX = e.pageX - carSlider.offsetLeft;
                scrollLeft = carSlider.scrollLeft;
            });

            carSlider.addEventListener('mouseleave', () => {
                isDown = false;
            });

            carSlider.addEventListener('mouseup', () => {
                isDown = false;
            });

            carSlider.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - carSlider.offsetLeft;
                const walk = (x - startX) * 3;
                carSlider.scrollLeft = scrollLeft - walk;
            });
        }

        // Animated counter for stats
        const stats = document.querySelectorAll('.stat-number');
        const animateStats = () => {
            stats.forEach(stat => {
                const target = parseInt(stat.getAttribute('data-target'));
                const count = parseInt(stat.innerText);
                const increment = target / 200;

                if (count < target) {
                    stat.innerText = Math.ceil(count + increment);
                    setTimeout(animateStats, 1);
                } else {
                    stat.innerText = target;
                }
            });
        };

        // Trigger stat animation when the stats section is in view
        const statsSection = document.querySelector('.stats');
        if (statsSection) {
            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    animateStats();
                }
            });
            observer.observe(statsSection);
        }

        // Lazy loading for images
        const lazyImages = document.querySelectorAll('img[data-src]');
        const lazyLoad = (target) => {
            const io = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.getAttribute('data-src');
                        img.removeAttribute('data-src');
                        observer.disconnect();
                    }
                });
            });
            io.observe(target);
        };
        lazyImages.forEach(lazyLoad);

        // Add a scroll-to-top button
        const scrollToTopBtn = document.createElement('button');
        scrollToTopBtn.innerHTML = '&uarr;';
        scrollToTopBtn.className = 'scroll-to-top';
        document.body.appendChild(scrollToTopBtn);

        const scrollFunction = () => {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                scrollToTopBtn.style.display = 'block';
            } else {
                scrollToTopBtn.style.display = 'none';
            }
        };

        window.addEventListener('scroll', scrollFunction);

        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    };

    if (loader) {
        loader.addEventListener('transitionend', () => {
            if (loader.classList.contains('hidden')) {
                initializeMainScript();
            }
        });
    } else {
        initializeMainScript();
    }
});

