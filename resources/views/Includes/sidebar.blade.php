<div class="fullscreen-slideshow w-100">
  <!-- Slide 1 -->
  <div class="slide position-absolute w-100 h-100" 
       style="background: linear-gradient(rgba(10, 31, 61, 0.9), rgba(10, 31, 61, 0.9)), url('{{ asset('img/slide1.jpg') }}') center/cover;">
    <div class="content position-absolute" style="top: 40%; left: 10%; max-width: 600px;">
      <h2 class="text-white display-4 fw-bold mb-3 neon-text">Premium Camping</h2>
      <p class="text-light-blue fs-3">Luxury tents with premium amenities</p>
    </div>
  </div>

  <!-- Slide 2 -->
  <div class="slide position-absolute w-100 h-100" 
       style="background: linear-gradient(rgba(10, 31, 61, 0.9), rgba(10, 31, 61, 0.9)), url('{{ asset('img/slide2.jpg') }}') center/cover;">
    <div class="content position-absolute" style="bottom: 30%; right: 10%; max-width: 600px; text-align: right;">
      <h2 class="text-white display-4 fw-bold mb-3 neon-text">Gourmet Food</h2>
      <p class="text-light-blue fs-3">From top local vendors</p>
    </div>
  </div>

  <!-- Slide 3 -->
  <div class="slide position-absolute w-100 h-100" 
       style="background: linear-gradient(rgba(10, 31, 61, 0.9), rgba(10, 31, 61, 0.9)), url('{{ asset('img/slide3.jpg') }}') center/cover;">
    <div class="content position-absolute text-center" style="top: 50%; left: 50%; transform: translate(-50%, -50%); max-width: 700px;">
      <h2 class="text-white display-4 fw-bold mb-3 neon-text">24/7 Health Support</h2>
      <p class="text-light-blue fs-3">Medical chat assistance anytime</p>
    </div>
  </div>

  <!-- Neon Search Bar -->
  <div class="search-container position-absolute w-100" style="bottom: 20%; z-index: 10;">
    <div class="container">
      <div class="neon-search-bar rounded-pill p-1 mx-auto" 
           style="max-width: 800px; background: linear-gradient(90deg, #0a1f3d, #4da6ff, #0a1f3d); background-size: 200% 100%; animation: gradientFlow 4s linear infinite;">
        <form class="d-flex h-100">
          <input type="text" class="form-control border-0 py-3 px-4 rounded-pill-start bg-dark text-white" 
                 placeholder="Search vendors, properties, services..." 
                 style="box-shadow: 0 0 20px rgba(77, 166, 255, 0.7);">
          <button class="btn btn-neon py-3 px-4 rounded-pill-end text-white fw-bold" style="letter-spacing: 1px;">
            <i class="fas fa-search me-2"></i>SEARCH
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

@push('styles')
<style>
  .fullscreen-slideshow {
   height: calc(150vh - 2cm - 60px); /* subtract navbar top offset + navbar height */
  margin-top: calc(-1 * (2cm + 60px)); /* pull up to cover white space */
  position: relative; /* ensure stacking context */
  overflow: hidden;
  }
  .slide {
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    transition: opacity 1.5s ease-in-out;
    z-index: 0;
  }
  .slide.active { opacity: 1; z-index: 1; }
  .neon-text {
    text-shadow: 0 0 10px rgba(77, 166, 255, 0.8),
                 0 0 20px rgba(77, 166, 255, 0.6);
  }
  .text-light-blue {
    color: #4da6ff;
    text-shadow: 0 0 8px rgba(77, 166, 255, 0.5);
  }
  .neon-search-bar {
    box-shadow: 0 0 30px rgba(77, 166, 255, 0.5);
    transition: all 0.3s ease;
  }
  .neon-search-bar:hover {
    box-shadow: 0 0 40px rgba(77, 166, 255, 0.7);
  }
  .btn-neon {
    background: linear-gradient(135deg, #4da6ff, #3a8de0);
    box-shadow: 0 0 20px rgba(77, 166, 255, 0.7);
    border: none;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
  }
  .btn-neon:hover {
    transform: translateY(-2px);
    box-shadow: 0 0 30px rgba(77, 166, 255, 0.9);
  }
  .btn-neon::after {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(to bottom right,
      rgba(255,255,255,0) 0%,
      rgba(255,255,255,0) 37%,
      rgba(255,255,255,0.8) 45%,
      rgba(255,255,255,0) 50%,
      rgba(255,255,255,0) 100%);
    transform: rotate(30deg);
    animation: shine 3s infinite;
  }
  @keyframes gradientFlow {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }
  @keyframes shine {
    0% { left: -50%; }
    20% { left: 100%; }
    100% { left: 100%; }
  }
  .form-control:focus {
    box-shadow: 0 0 25px rgba(77, 166, 255, 0.8) !important;
    background-color: rgba(10, 31, 61, 0.9) !important;
  }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const slides = document.querySelectorAll('.slide');
  let currentSlide = 0;

  if (slides.length) {
    slides[0].classList.add('active');
    setTimeout(changeSlide, 5000);
  }

  function changeSlide() {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].classList.add('active');
    setTimeout(changeSlide, 5000);
  }
});
</script>
@endpush
