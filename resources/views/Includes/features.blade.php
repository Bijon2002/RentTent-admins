<!-- Add AOS CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    AOS.init({
      duration: 700,
      easing: 'ease-in-out',
      once: true
    });
  });
</script>

<!-- What is RentTent -->
<section class="renttent-section text-center py-5">
  <div class="container">
    <h2 class="section-title">What is RentTent?</h2>
    <p class="section-desc">
      RentTent is a premium boarding rental platform that connects room seekers with verified hosts and local food vendors, 
      creating a complete living ecosystem for modern professionals and students.
    </p>

    <div class="row mt-4">
      <div class="col-md-3" data-aos="fade-up">
        <div class="feature-box">
          <div class="icon">🏠</div>
          <h5>Premium Rooms</h5>
          <p>Modern, fully-furnished rooms with smart amenities and high-speed internet.</p>
        </div>
      </div>
      <div class="col-md-3" data-aos="fade-up">
        <div class="feature-box">
          <div class="icon">🛡️</div>
          <h5>Safety First</h5>
          <p>Verified hosts, police safety indexes, and 24/7 security for peace of mind.</p>
        </div>
      </div>
      <div class="col-md-3" data-aos="fade-up">
        <div class="feature-box">
          <div class="icon">⚡</div>
          <h5>Instant Booking</h5>
          <p>Book your room in minutes with our streamlined process.</p>
        </div>
      </div>
      <div class="col-md-3" data-aos="fade-up">
        <div class="feature-box">
          <div class="icon">🍴</div>
          <h5>Food Vendors</h5>
          <p>Connect with local food vendors for daily meals and subscriptions.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Why Choose RentTent -->
<section class="renttent-section-alt py-5">
  <div class="container text-center">
    <h2 class="section-title">Why Choose RentTent?</h2>
    <div class="row mt-4">
      <div class="col-md-6 text-start" data-aos="fade-right">
        <ul class="benefits">
          <li>✅ Verified Properties – checked for safety, cleanliness, and amenities</li>
          <li>✅ Smart Matching – AI-powered recommendations</li>
          <li>✅ Food Ecosystem – hassle-free meal options</li>
        </ul>
        <a href="#" class="btn btn-light mt-3">Get Started Today</a>
      </div>
      <div class="col-md-6" data-aos="fade-left">
        <div class="stats-box">
          <h4>Join <span class="count-up" data-target="10000">0</span>+ Happy Residents</h4>
          <p>Experience the future of boarding with our premium platform</p>
          <div class="d-flex justify-content-around mt-3">
            <div><strong class="count-up" data-target="4.9">0</strong><br>Rating</div>
            <div><strong class="count-up" data-target="99">0</strong><br>Uptime</div>
            <div><strong class="count-up" data-target="24">0</strong><br>Support</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CountUp Script -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    function animateCountUp(el, target, duration = 1200, decimals = 0) {
      let start = 0;
      let startTime = null;
      function step(timestamp) {
        if (!startTime) startTime = timestamp;
        let progress = Math.min((timestamp - startTime) / duration, 1);
        let value = start + (target - start) * progress;
        el.textContent = decimals ? value.toFixed(decimals) : Math.floor(value);
        if (progress < 1) {
          requestAnimationFrame(step);
        } else {
          el.textContent = decimals ? target.toFixed(decimals) : target;
        }
      }
      requestAnimationFrame(step);
    }
    document.querySelectorAll('.count-up').forEach(el => {
      let target = parseFloat(el.getAttribute('data-target'));
      let decimals = (target % 1 !== 0) ? 1 : 0;
      animateCountUp(el, target, target === 10000 ? 1800 : 1200, decimals);
    });
  });
</script>

<!-- How RentTent Works -->
<section class="renttent-section text-center py-5">
  <div class="container">
    <h2 class="section-title">How RentTent Works</h2>
    <div class="row mt-5">

      <div class="col-md-4" data-aos="zoom-in-up">
        <div class="step-box">
          <img src="{{ asset('img/sear.webp') }}" alt="Search & Filter" class="img-fluid mb-3" style="border-radius:10px;">
          <span class="step-number">1</span>
          <h5>Search & Filter</h5>
          <p>Find rooms that match your preferences with smart filters.</p>
        </div>
      </div>

      <div class="col-md-4" data-aos="zoom-in-up">
        <div class="step-box">
          <img src="{{ asset('img/book.jpg') }}" alt="Book Instantly" class="img-fluid mb-3" style="border-radius:10px;">
          <span class="step-number">2</span>
          <h5>Book Instantly</h5>
          <p>Secure your perfect room with instant confirmation.</p>
        </div>
      </div>

      <div class="col-md-4" data-aos="zoom-in-up">
        <div class="step-box">
          <img src="{{ asset('img/enj.jpg') }}" alt="Enjoy & Connect" class="img-fluid mb-3" style="border-radius:10px;">
          <span class="step-number">3</span>
          <h5>Enjoy & Connect</h5>
          <p>Move in and connect with vendors for complete living.</p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Custom CSS -->
<style>
  body {
    background-color: #0a0f29;
    color: #fff;
    font-family: 'Arial', sans-serif;
    overflow-x: hidden;
  }

  .renttent-section { background-color: #0a0f29; }
  .renttent-section-alt { background-color: #10163a; }

  .section-title { color: #b37bff; font-weight: bold; }
  .section-desc { color: #ddd; max-width: 700px; margin: 0 auto; }

  .feature-box, .step-box {
  .step-number {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: linear-gradient(135deg, #4fdcff 60%, #10163a 100%);
    color: #10163a;
    font-size: 1.5rem;
    font-weight: bold;
    box-shadow: 0 0 8px #4fdcff99;
    margin-bottom: 12px;
    border: 2px solid #4fdcff;
  }
    background: #161d3a;
    border-radius: 12px;
    padding: 20px;
    margin: 10px 0;
    transition: 0.3s;
    border: 2px solid #4fdcff;
    box-shadow: 0 0 12px #4fdcff44;
  }

  .feature-box:hover, .step-box:hover { background: #1f2755; transform: translateY(-5px); }

  .icon { font-size: 2rem; margin-bottom: 10px; color: #b37bff; }

  .benefits li { margin: 10px 0; font-size: 1rem; }

  .stats-box {
    background: #161d3a;
    border-radius: 12px;
    padding: 25px;
  }

  .btn-light {
    background: #b37bff;
    color: white;
    border-radius: 30px;
    padding: 10px 20px;
  }
  .btn-light:hover { background: #9f63ff; }

  .step-number {
    display: inline-block;
    background: #b37bff;
    color: white;
    font-weight: bold;
    padding: 10px 15px;
    border-radius: 50%;
    margin-bottom: 10px;
  }
</style>
