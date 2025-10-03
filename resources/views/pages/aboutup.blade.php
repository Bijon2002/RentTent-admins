@extends('Layout.master_contact')

@section('title', 'About Us - RentTent')

@section('content')
<style>
    :root {
        --primary: #3a5ec7;
        --secondary: #28a745;
        --accent: #ff6b35;
        --light: #f8f9fa;
        --dark: #2c3e50;
        --purple: #865ded;
        --yellow: #ffcb05;
    }

    body {
        font-family: 'Poppins', sans-serif;
        color: #333;
        overflow-x: hidden;
        line-height: 1.6;
        background: #0a2540 !important; /* Dark blue background */
    }

    /* Alternate Hero Section */
    .alternate-hero {
        background: linear-gradient(135deg, #000000 0%, #37198a 100%);
        padding: 80px 0 60px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .alternate-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,128L48,117.3C96,107,192,85,288,112C384,139,480,213,576,224C672,235,768,181,864,160C960,139,1056,149,1152,144C1248,139,1344,117,1392,106.7L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
        background-size: cover;
        background-position: bottom;
        opacity: 0.2;
    }

    .hero-badge {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 50px;
        padding: 8px 20px;
        display: inline-block;
        margin-bottom: 15px;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .hero-title {
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-image {
        position: relative;
        z-index: 2;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        transition: all 0.4s ease;
    }

    .hero-image:hover {
        transform: perspective(1000px) rotateY(0);
    }

    /* Section Common Styles */
    .section-container {
        padding: 60px 0;
    }

    .section-title {
        position: relative;
        margin-bottom: 2rem;
        font-weight: 700;
        color: var(--dark);
        font-size: 2rem;
    }

    .section-title:after {
        content: '';
        position: absolute;
        bottom: -12px;
        left: 0;
        width: 60px;
        height: 4px;
        background: var(--primary);
        border-radius: 2px;
    }

    .section-title.center:after {
        left: 50%;
        transform: translateX(-50%);
    }

    /* About Intro Section */
    .about-intro {
        background-color: white;
    }

    .about-img {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease;
    }

    .about-img:hover {
        transform: translateY(-5px);
    }

    /* Mission & Vision Section */
    .mission-vision {
        background: linear-gradient(to right, #f8f9fa, #e9ecef);
    }

    .mv-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        height: 100%;
    }

    .mv-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.12);
    }

    .mission-card {
        border-left: 4px solid var(--primary);
    }

    .vision-card {
        border-left: 4px solid var(--secondary);
    }

    .mv-icon {
        font-size: 2rem;
        margin-bottom: 0.8rem;
        color: var(--primary);
    }

    .vision-card .mv-icon {
        color: var(--secondary);
    }

    /* Features Section */
    .features {
        background-color: white;
    }

    .feature-card {
        border: none;
        border-radius: 12px;
        padding: 25px;
        transition: all 0.3s ease;
        height: 100%;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.04);
        margin-bottom: 20px;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    .feature-icon {
        font-size: 2.2rem;
        margin-bottom: 1.2rem;
        color: var(--primary);
    }

    /* Stats Section */
    .stats {
        background: linear-gradient(rgba(58, 94, 199, 0.9), rgba(58, 94, 199, 0.9)),
                    url('https://images.unsplash.com/photo-1560448204-603b3fc33ddc?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
        background-size: cover;
        background-attachment: fixed;
        color: white;
    }

    .stat-item {
        text-align: center;
        padding: 15px;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .stat-text {
        font-size: 1.1rem;
        font-weight: 500;
    }

    /* Team Section */
    .team-section {
        background-color: white;
    }

    .team-card {
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        height: 100%;
        background: white;
        margin-bottom: 20px;
    }

    .team-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .team-img-wrapper {
        position: relative;
        overflow: hidden;
        height: 220px;
    }

    .team-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.4s ease;
    }

    .team-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(58, 94, 199, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .team-img-wrapper:hover .team-overlay {
        opacity: 1;
    }

    .team-img-wrapper:hover .team-img {
        transform: scale(1.1);
    }

    .social-links a {
        display: inline-block;
        width: 36px;
        height: 36px;
        background: white;
        border-radius: 50%;
        text-align: center;
        line-height: 36px;
        margin: 0 4px;
        color: var(--primary);
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .social-links a:hover {
        background: var(--accent);
        color: white;
        transform: translateY(-3px);
    }

    .team-info {
        padding: 18px 15px;
    }

    .team-info h4 {
        font-weight: 700;
        color: var(--dark);
        font-size: 1.1rem;
        margin-bottom: 0.3rem;
    }

    .team-desc {
        color: #666;
        font-size: 0.85rem;
        margin-bottom: 0;
        line-height: 1.5;
    }

    /* Contact Section */
    .contact-section {
        background-color: #f8f9fa;
    }

    .contact-info {
        background: var(--primary);
        color: white;
        border-radius: 12px;
        padding: 30px;
        height: 100%;
    }

    .contact-form {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
    }

    .form-control {
        padding: 12px 16px;
        border-radius: 8px;
        border: 1px solid #e2e2e2;
        margin-bottom: 16px;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(58, 94, 199, 0.15);
    }

    .btn-primary {
        background-color: var(--primary);
        border-color: var(--primary);
        padding: 10px 25px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .btn-primary:hover {
        background-color: #2a4bb2;
        border-color: #2a4bb2;
        transform: translateY(-2px);
    }

    /* Compact spacing utilities */
    .compact-line-height {
        line-height: 1.5;
    }
    .compact-mb-1 {
        margin-bottom: 0.5rem !important;
    }
    .compact-mb-2 {
        margin-bottom: 1rem !important;
    }
    .compact-mb-3 {
        margin-bottom: 1.5rem !important;
    }
    .compact-mb-4 {
        margin-bottom: 2rem !important;
    }
    .compact-mt-3 {
        margin-top: 1.5rem !important;
    }

    /* Responsive Adjustments */
    @media (max-width: 992px) {
        .hero-title {
            font-size: 2.3rem;
        }
        .section-title {
            font-size: 1.8rem;
        }
    }

    @media (max-width: 768px) {
        .alternate-hero {
            padding: 60px 0 40px;
        }
        .hero-title {
            font-size: 2rem;
        }
        .section-title {
            font-size: 1.6rem;
            margin-bottom: 1.5rem;
        }
        .section-title:after {
            bottom: -10px;
            width: 50px;
            height: 3px;
        }
        .section-container {
            padding: 50px 0;
        }
        .stat-number {
            font-size: 2rem;
        }
        .hero-image {
            transform: none;
            margin-top: 30px;
        }
        .team-img-wrapper {
            height: 200px;
        }
    }

    @media (max-width: 576px) {
        .hero-title {
            font-size: 1.8rem;
        }
        .section-title {
            font-size: 1.5rem;
        }
        .section-container {
            padding: 40px 0;
        }
        .stat-number {
            font-size: 1.8rem;
        }
        .team-img-wrapper {
            height: 180px;
        }
    }
</style>

<!-- Alternate Hero Section -->
<section class="alternate-hero" data-aos="fade-up" data-aos-duration="1200">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <span class="hero-badge"><i class="fas fa-rocket me-2"></i>Welcome to RentTent</span>
                    <h1 class="hero-title compact-mb-2">Finding Your Perfect <span style="color: var(--yellow);">Student Home</span> Made Simple</h1>
                    <p class="lead compact-mb-3 compact-line-height">We're revolutionizing how students find accommodation and meals in Sri Lanka with our trusted platform.</p>
                    <div class="d-flex flex-wrap">
                        <a href="#about" class="btn btn-light btn-lg rounded-pill px-4 py-2 me-3 mb-2">
                            <i class="fas fa-book-open me-2"></i>Our Story
                        </a>
                        <a href="#contact" class="btn btn-outline-light btn-lg rounded-pill px-4 py-2 mb-2">
                            <i class="fas fa-comments me-2"></i>Get In Touch
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80"
                     alt="Student accommodation" class="hero-image img-fluid">
            </div>
        </div>
    </div>
</section>

<!-- About Intro Section -->
<section id="about" class="about-intro section-container" data-aos="fade-up" data-aos-duration="1200">
    <div class="container">
        <div class="text-center compact-mb-4">
            <small class="text-uppercase fw-bold" style="color: var(--purple); letter-spacing: 2px;">Welcome to Our Journey</small>
            <h2 class="section-title center">About Our <span style="color: var(--purple);">Company</span></h2>
        </div>

        <div class="row align-items-center">
            <div class="col-lg-6">
                <p class="lead compact-mb-3 compact-line-height">Finding safe and affordable boarding and good food was never easy. We thought, <span class="fw-bold" style="color: var(--accent);">"There has to be a better way."</span> So RentTent was born.</p>
                <p class="compact-mb-3 compact-line-height">Our mission is simple: connect students and professionals with reliable accommodation and meal services in one seamless platform.</p>
                <p class="compact-mb-3 compact-line-height">We carefully verify all our boarding providers and food vendors to ensure you get the best experience possible without any worries.</p>

                <div class="d-flex compact-mt-3">
                    <div class="me-4 text-center">
                        <h3 class="text-primary">5000+</h3>
                        <p>Happy Students</p>
                    </div>
                    <div class="me-4 text-center">
                        <h3 class="text-success">250+</h3>
                        <p>Verified Boardings</p>
                    </div>
                    <div class="text-center">
                        <h3 class="text-warning">120+</h3>
                        <p>Food Providers</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-md-6">
                        <img src="https://images.unsplash.com/photo-1580216643062-cf460548a66a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                             alt="Student accommodation" class="about-img img-fluid w-100" style="height: 220px; object-fit: cover;">
                    </div>
                    <div class="col-md-6">
                        <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                             alt="Food service" class="about-img img-fluid w-100" style="height: 220px; object-fit: cover;">
                    </div>
                    <div class="col-12">
                        <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                             alt="Team meeting" class="about-img img-fluid w-100" style="height: 240px; object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision Section -->
<section class="mission-vision section-container" data-aos="fade-up" data-aos-duration="1200">
    <div class="container">
        <h2 class="section-title text-center compact-mb-4 center">Our Mission & Vision</h2>

        <div class="row g-3">
            <!-- Mission Card -->
            <div class="col-lg-6">
                <div class="mv-card mission-card p-3 bg-white">
                    <div class="d-flex align-items-center compact-mb-3">
                        <i class="fas fa-bullseye mv-icon"></i>
                        <h3 class="mb-0 ms-3">Our Mission</h3>
                    </div>
                    <p class="mb-0 compact-line-height">To provide students and workers with convenient and reliable access to safe, affordable boarding and quality food services. We strive to create a seamless experience that eliminates the stress of finding suitable accommodation and meals.</p>
                </div>
            </div>

            <!-- Vision Card -->
            <div class="col-lg-6">
                <div class="mv-card vision-card p-3 bg-white">
                    <div class="d-flex align-items-center compact-mb-3">
                        <i class="fas fa-eye mv-icon"></i>
                        <h3 class="mb-0 ms-3">Our Vision</h3>
                    </div>
                    <p class="mb-0 compact-line-height">To become the leading platform in Sri Lanka that connects students and professionals with trusted accommodation and meal providers. We aim to revolutionize the rental industry through technology, trust, and community-building initiatives.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features section-container" data-aos="fade-up" data-aos-duration="1200">
    <div class="container">
        <h2 class="section-title text-center compact-mb-4 center">Why Choose RentTent?</h2>

        <div class="row g-3">
            <!-- Feature 1 -->
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <i class="fas fa-wallet feature-icon"></i>
                    <h4>Affordable Living</h4>
                    <p class="compact-line-height">Budget-friendly rates for boarding and meals without compromising quality or safety standards.</p>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <i class="fas fa-shield-alt feature-icon"></i>
                    <h4>Trusted Providers</h4>
                    <p class="compact-line-height">All our boarding houses and food vendors are carefully verified for your peace of mind.</p>
                </div>
            </div>

            <!-- Feature 3 -->
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <i class="fas fa-bolt feature-icon"></i>
                    <h4>Convenience</h4>
                    <p class="compact-line-height">A one-stop platform to manage your accommodation and food needs easily and efficiently.</p>
                </div>
            </div>

            <!-- Feature 4 -->
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <i class="fas fa-utensils feature-icon"></i>
                    <h4>Quality Food</h4>
                    <p class="compact-line-height">Enjoy nutritious and delicious meals from our verified food providers across the city.</p>
                </div>
            </div>

            <!-- Feature 5 -->
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <i class="fas fa-map-marker-alt feature-icon"></i>
                    <h4>Prime Locations</h4>
                    <p class="compact-line-height">Find boarding places in convenient locations close to universities and business districts.</p>
                </div>
            </div>

            <!-- Feature 6 -->
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <i class="fas fa-headset feature-icon"></i>
                    <h4>24/7 Support</h4>
                    <p class="compact-line-height">Our dedicated support team is always available to assist you with any issues or questions.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats section-container" style="padding: 50px 0;" data-aos="fade-up" data-aos-duration="1200">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-6">
                <div class="stat-item">
                    <div class="stat-number" data-count="5000">0</div>
                    <div class="stat-text">Happy Students</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-item">
                    <div class="stat-number" data-count="250">0</div>
                    <div class="stat-text">Verified Boardings</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-item">
                    <div class="stat-number" data-count="120">0</div>
                    <div class="stat-text">Food Providers</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-item">
                    <div class="stat-number" data-count="15">0</div>
                    <div class="stat-text">Cities Covered</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section id="team" class="team-section section-container" data-aos="fade-up" data-aos-duration="1200">
    <div class="container">
        <div class="text-center compact-mb-4">
            <small class="text-uppercase fw-bold" style="color: var(--purple); letter-spacing: 2px;">Meet Our Team</small>
            <h2 class="section-title">The People Behind <span style="color: var(--purple);">RentTent</span></h2>
            <p class="mx-auto" style="max-width: 800px;">Our team is passionate about making your stay in Sri Lanka unforgettable. We handle everything from tech to customer support, ensuring a seamless experience for our users.</p>
        </div>

        <div class="row justify-content-center">
            <!-- bijon-->
            <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 mb-3">
                <div class="team-card text-center">
                    <div class="team-img-wrapper">
                        <img src="/img/me.jpg" alt="Liam O'Connor" class="team-img"

                             alt="Alex Chen" class="team-img">
                        <div class="team-overlay">
                            <div class="social-links">
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="team-info">
                        <h4 class="compact-mb-1">Alex Chen</h4>
                        <p class="text-primary compact-mb-2">Lead Developer & Founder</p>
                        <p class="team-desc">Organizing spaces & building scalable backend systems. Obsessed with smooth bookings.</p>
                    </div>
                </div>
            </div>

            <!-- sheromi -->
            <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 mb-3">
                <div class="team-card text-center">
                    <div class="team-img-wrapper">
                         <img src="/img/sheromi.jpg" alt="Liam O'Connor" class="team-img"

                             alt="Priya Kumar" class="team-img">
                        <div class="team-overlay">
                            <div class="social-links">
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="team-info">
                        <h4 class="compact-mb-1">Sheromi</h4>
                        <p class="text-primary compact-mb-2">QA Testers</p>
                        <p class="team-desc">UI wizard & food lover. Makes every interface look as fresh as a good meal.</p>
                    </div>
                </div>
            </div>

            <!-- akhil-->
            <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 mb-3">
                <div class="team-card text-center">
                    <div class="team-img-wrapper">
                         <img src="/img/ak.jpg" alt="Liam O'Connor" class="team-img"

                             alt="Liam O'Connor" class="team-img">
                        <div class="team-overlay">
                            <div class="social-links">
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="team-info">
                        <h4 class="compact-mb-1">Akhil</h4>
                        <p class="text-primary compact-mb-2">QA Tester</p>
                        <p class="team-desc">Comfort seeker & API master. Optimizes listings for best user experience.</p>
                    </div>
                </div>
            </div>

            <!-- thula-->
            <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 mb-3">
                <div class="team-card text-center">
                    <div class="team-img-wrapper">
                        <img src="/img/thula.jpg" alt="Liam O'Connor" class="team-img"

                             alt="Sofia Martinez" class="team-img">
                        <div class="team-overlay">
                            <div class="social-links">
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="team-info">
                        <h4 class="compact-mb-1">Thulanjali</h4>
                        <p class="text-primary compact-mb-2">Fullstack Developer</p>
                        <p class="team-desc">Fullstack ninja & community builder. Ensures every user finds their perfect stay.</p>
                    </div>
                </div>
            </div>

            <!-- lux -->
            <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 mb-3">
                <div class="team-card text-center">
                    <div class="team-img-wrapper">
                         <img src="/img/lux.jpg" alt="Liam O'Connor" class="team-img"

                             alt="Marcus Johnson" class="team-img">
                        <div class="team-overlay">
                            <div class="social-links">
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="team-info">
                        <h4 class="compact-mb-1">lux</h4>
                        <p class="text-primary compact-mb-2">UX Designer</p>
                        <p class="team-desc">User experience expert & accessibility advocate. Creates intuitive flows for all users.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="contact-section section-container" data-aos="fade-up" data-aos-duration="1200">
    <div class="container">
        <h2 class="section-title text-center compact-mb-4 center">Get In Touch</h2>

        <div class="row g-4">
            <div class="col-lg-5">
                <div class="contact-info">
                    <h3 class="compact-mb-3">Have Questions?</h3>
                    <p class="compact-mb-3">We're here to help you find the best boarding or meal package.</p>

                    <div class="d-flex align-items-center compact-mb-2">
                        <i class="fas fa-map-marker-alt me-3"></i>
                        <span>Colombo, Sri Lanka</span>
                    </div>
                    <div class="d-flex align-items-center compact-mb-2">
                        <i class="fas fa-phone me-3"></i>
                        <span>+94 77 123 4567</span>
                    </div>
                    <div class="d-flex align-items-center compact-mb-3">
                        <i class="fas fa-envelope me-3"></i>
                        <span>support@renttent.com</span>
                    </div>

                    <div class="mt-4">
                        <h4 class="compact-mb-2">Follow Us</h4>
                        <div class="d-flex">
                            <a href="#" class="text-white me-3"><i class="fab fa-facebook-f fa-lg"></i></a>
                            <a href="#" class="text-white me-3"><i class="fab fa-twitter fa-lg"></i></a>
                            <a href="#" class="text-white me-3"><i class="fab fa-instagram fa-lg"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-linkedin-in fa-lg"></i></a>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="contact-form">
                        <h3 class="compact-mb-3">Send us a Message</h3>
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Your Name">
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" placeholder="Your Email">
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Subject">
                            <textarea class="form-control" rows="5" placeholder="Your Message"></textarea>
                            <button type="submit" class="btn btn-primary w-100">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Counter animation for stats section
    document.addEventListener('DOMContentLoaded', function() {
        const counters = document.querySelectorAll('.stat-number');
        const speed = 200;

        counters.forEach(counter => {
            const target = +counter.getAttribute('data-count');
            const count = +counter.innerText;
            const increment = Math.ceil(target / speed);

            if (count < target) {
                let current = count;
                const updateCount = () => {
                    current += increment;
                    counter.innerText = current;

                    if (current < target) {
                        setTimeout(updateCount, 1);
                    } else {
                        counter.innerText = target;
                    }
                };
                updateCount();
            } else {
                counter.innerText = target;
            }
        });
    });
</script>
@endsection
