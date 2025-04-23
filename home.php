<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Primos Boarding House</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="./logo/balay.jpg" rel="icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --text-color: #2c3e50;
            --light-gray: #ecf0f1;
            --dark-gray: #34495e;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--light-gray);
            color: var(--text-color);
        }

        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 1.2rem 5%;
            background: rgba(255, 255, 255, 0.98);
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            padding: 1rem 5%;
            background: white;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
            letter-spacing: -0.5px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2.5rem;
        }

        .nav-links a {
            color: var(--text-color);
            text-decoration: none;
            font-weight: 500;
            font-size: 1.05rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-links a:not(.login-button)::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--secondary-color);
            transition: width 0.3s ease;
        }

        .nav-links a:not(.login-button):hover::after {
            width: 100%;
        }

        .nav-links a:not(.login-button):hover {
            color: var(--secondary-color);
        }

        .login-button {
            background-color: var(--secondary-color);
            color: white !important;
            padding: 0.8rem 1.8rem;
            border-radius: 50px;
            font-weight: 600;
            letter-spacing: 0.3px;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.2);
            transition: all 0.3s ease;
        }

        .login-button:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.3);
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            display: flex;
            align-items: center;
            padding: 0 8%;
            background: linear-gradient(135deg, rgba(44, 62, 80, 0.95), rgba(52, 73, 94, 0.95));
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('logo/balay.jpg') center/cover;
            opacity: 0.15;
            animation: slowZoom 20s infinite alternate;
        }

        @keyframes slowZoom {
            from { transform: scale(1); }
            to { transform: scale(1.1); }
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 600px;
            animation: slideUp 1s ease-out;
        }

        .hero h1 {
            font-size: 4rem;
            margin-bottom: 20px;
            line-height: 1.2;
            animation: slideInLeft 1s ease-out;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            opacity: 0.9;
            animation: slideInRight 1s ease-out;
        }

        .cta-buttons {
            display: flex;
            gap: 20px;
            animation: slideUp 1s ease-out 0.5s backwards;
        }

        .cta-button {
            padding: 15px 40px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .cta-primary {
            background: var(--secondary-color);
            color: white;
        }

        .cta-secondary {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* Stats Section */
        .stats {
            padding: 80px 0;
            background: white;
        }

        .stats-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }

        .stat-item {
            text-align: center;
            padding: 30px;
            animation: scaleIn 0.8s ease-out;
            transition: transform 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-10px);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 10px;
        }

        .stat-label {
            color: var(--text-color);
            font-size: 1.1rem;
        }

        /* Gallery Section */
        .gallery {
            padding: 100px 0;
            background: var(--light-gray);
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title h2 {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .section-title p {
            color: var(--text-color);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
            opacity: 0.8;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            padding: 0 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .gallery-item {
            position: relative;
            height: 300px;
            overflow: hidden;
            border-radius: 10px;
            cursor: pointer;
            animation: scaleIn 0.8s ease-out;
            transition: all 0.3s ease;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-overlay h3 {
            color: white;
            font-size: 1.5rem;
            text-align: center;
        }

        /* Testimonials Section */
        .testimonials {
            padding: 100px 0;
            background: white;
        }

        .testimonials-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .testimonial-card {
            background: var(--light-gray);
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            animation: slideUp 0.8s ease-out;
            transition: transform 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
        }

        .testimonial-content {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 20px;
            color: var(--text-color);
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .author-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
        }

        .author-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .author-info h4 {
            color: var(--primary-color);
            margin-bottom: 5px;
        }

        .author-info p {
            color: #666;
            font-size: 0.9rem;
        }

        /* Newsletter Section */
        .newsletter {
            padding: 80px 0;
            background: var(--primary-color);
            color: white;
            text-align: center;
        }

        .newsletter-content {
            max-width: 600px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .newsletter h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .newsletter p {
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .newsletter-form {
            display: flex;
            gap: 10px;
            max-width: 500px;
            margin: 0 auto;
        }

        .newsletter-input {
            flex: 1;
            padding: 15px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
        }

        .newsletter-button {
            padding: 15px 30px;
            background: var(--secondary-color);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .newsletter-button:hover {
            background: #2980b9;
        }

        /* Footer */
        .footer {
            background: var(--dark-gray);
            color: white;
            padding: 80px 0 30px;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
            margin-bottom: 50px;
        }

        .footer-section h3 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: var(--secondary-color);
        }

        .footer-section p {
            margin-bottom: 15px;
            opacity: 0.8;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 10px;
        }

        .footer-section ul li a {
            color: white;
            text-decoration: none;
            opacity: 0.8;
            transition: all 0.3s ease;
        }

        .footer-section ul li a:hover {
            opacity: 1;
            color: var(--secondary-color);
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-links a {
            color: white;
            font-size: 1.5rem;
            opacity: 0.8;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            opacity: 1;
            color: var(--secondary-color);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                padding: 15px 20px;
            }

            .nav-links {
                display: none;
            }

            .hero {
                padding: 0 20px;
                text-align: center;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .stats-container {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer-content {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .social-links {
                justify-content: center;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .section-title p {
                font-size: 1rem;
                padding: 0 20px;
            }

            .testimonials-container {
                grid-template-columns: 1fr;
            }
        }

        /* Add these animation keyframes at the top of the style section */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes slideInLeft {
            from { transform: translateX(-30px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes slideInRight {
            from { transform: translateX(30px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes scaleIn {
            from { transform: scale(0.9); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        /* Add animation classes */
        .animate-fade-in {
            animation: fadeIn 1s ease-out;
        }

        .animate-slide-up {
            animation: slideUp 0.8s ease-out;
        }

        .animate-slide-left {
            animation: slideInLeft 0.8s ease-out;
        }

        .animate-slide-right {
            animation: slideInRight 0.8s ease-out;
        }

        .animate-scale {
            animation: scaleIn 0.8s ease-out;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <a href="#" class="logo">Primos Boarding House</a>
        <div class="nav-links">
            <a href="#home">Home</a>
            <a href="#gallery">Gallery</a>
            <a href="#testimonials">Testimonials</a>
            <a href="#contact">Contact</a>
            <a href="login.php" class="login-button">Login</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-content">
            <h1>Your Home Away From Home</h1>
            <p>Experience comfortable and affordable living in a safe and friendly environment. Join our community of students and professionals.</p>
            <div class="cta-buttons">
                <a href="#contact" class="cta-button cta-primary">Apply Now</a>
                <a href="#gallery" class="cta-button cta-secondary">View Gallery</a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="stats-container">
            <div class="stat-item">
                <div class="stat-number">500+</div>
                <div class="stat-label">Happy Residents</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">50+</div>
                <div class="stat-label">Available Rooms</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Security</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">98%</div>
                <div class="stat-label">Satisfaction Rate</div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="gallery">
        <div class="section-title">
            <h2>Our Facilities</h2>
            <p>Take a virtual tour of our modern boarding house</p>
        </div>
        <div class="gallery-grid">
            <div class="gallery-item">
                <img src="logo/balay.jpg" alt="Room">
                <div class="gallery-overlay">
                    <h3>Comfortable Rooms</h3>
                </div>
            </div>
            <div class="gallery-item">
                <img src="logo/balay.jpg" alt="Common Area">
                <div class="gallery-overlay">
                    <h3>Common Areas</h3>
                </div>
            </div>
            <div class="gallery-item">
                <img src="logo/balay.jpg" alt="Kitchen">
                <div class="gallery-overlay">
                    <h3>Kitchen</h3>
                </div>
            </div>
            <div class="gallery-item">
                <img src="logo/balay.jpg" alt="Study Area">
                <div class="gallery-overlay">
                    <h3>Study Areas</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials">
        <div class="section-title">
            <h2>What Our Residents Say</h2>
            <p>Read testimonials from our satisfied residents</p>
        </div>
        <div class="testimonials-container">
            <div class="testimonial-card">
                <div class="testimonial-content">
                    "Primos Boarding House has been my home for the past year. The facilities are excellent, and the staff is very friendly and helpful."
                </div>
                <div class="testimonial-author">
                    <div class="author-image">
                        <img src="logo/balay.jpg" alt="John Doe">
                    </div>
                    <div class="author-info">
                        <h4>John Doe</h4>
                        <p>Student</p>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-content">
                    "The location is perfect, and the security is top-notch. I feel safe and comfortable living here."
                </div>
                <div class="testimonial-author">
                    <div class="author-image">
                        <img src="logo/balay.jpg" alt="Jane Smith">
                    </div>
                    <div class="author-info">
                        <h4>Jane Smith</h4>
                        <p>Professional</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter">
        <div class="newsletter-content">
            <h2>Stay Updated</h2>
            <p>Subscribe to our newsletter for the latest updates and special offers</p>
            <form class="newsletter-form">
                <input type="email" class="newsletter-input" placeholder="Enter your email">
                <button type="submit" class="newsletter-button">Subscribe</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>About Us</h3>
                <p>Primos Boarding House provides comfortable and affordable accommodation for students and professionals.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#gallery">Gallery</a></li>
                    <li><a href="#testimonials">Testimonials</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact Info</h3>
             
                <p>Tupi South Cotabato, Philippines</p>
                <p>Phone: +63 123 456 7890</p>
                <p>Email: info@primosboardinghouse.com</p>
            </div>
            <div class="footer-section">
                <h3>Opening Hours</h3>
                <p>Monday - Friday: 8:00 AM - 8:00 PM</p>
                <p>Saturday: 9:00 AM - 6:00 PM</p>
                <p>Sunday: Closed</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Primos Boarding House. All rights reserved.</p>
        </div>
    </footer>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/js/main.js"></script>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scroll for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Intersection Observer for scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe elements for scroll animations
        document.querySelectorAll('.stat-item, .gallery-item, .testimonial-card').forEach(el => {
            observer.observe(el);
        });

        // Add animation delay to gallery items
        document.querySelectorAll('.gallery-item').forEach((item, index) => {
            item.style.animationDelay = `${index * 0.2}s`;
        });

        // Add animation delay to testimonial cards
        document.querySelectorAll('.testimonial-card').forEach((card, index) => {
            card.style.animationDelay = `${index * 0.3}s`;
        });

        // Add hover effect to stats
        document.querySelectorAll('.stat-item').forEach(item => {
            item.addEventListener('mouseenter', () => {
                item.style.transform = 'translateY(-10px)';
            });
            item.addEventListener('mouseleave', () => {
                item.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>
