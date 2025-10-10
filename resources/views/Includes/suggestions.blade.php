<!-- Add AOS CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    AOS.init({
      duration: 600,
      easing: 'ease-in-out',
      once: true
    });
  });
</script>


<!-- Popup Modal -->
<div id="suggestionModal" class="modal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(10,31,61,0.7); z-index:9999; align-items:center; justify-content:center;">
  <div class="modal-content" style="background:#161622; color:#fff; border-radius:12px; padding:2rem; min-width:300px; max-width:90vw; box-shadow:0 0 40px #00f2ff; position:relative;">
    <span id="closeModal" style="position:absolute; top:10px; right:18px; font-size:2rem; cursor:pointer;">&times;</span>
    <div id="modalBody"></div>
  </div>
</div>
<style>
  .dark-neo-card {
    transition: box-shadow 0.3s, transform 0.3s;
  }
  .dark-neo-card:hover {
    box-shadow: 0 0 12px #00f2ff, 0 0 4px #0a1f3d;
    transform: scale(1.02);
    z-index: 2;
  }
  /* Only food vendor cards get the yellow-gold neon glow */
  .food-vendor-card:hover {
    box-shadow: 0 0 24px #ffb800, 0 0 8px #b8860b !important;
    transform: scale(1.04);
    z-index: 3;
  }
  .food-vendor-card:active {
    box-shadow: 0 0 40px #ffb800, 0 0 16px #b8860b !important;
    transform: scale(1.07);
  }
  .dark-neo-card:active {
    box-shadow: 0 0 40px #00f2ff, 0 0 16px #0a1f3d;
    transform: scale(1.07);
  }
  .modal {
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .modal-content {
    animation: popIn 0.3s ease;
  }
  @keyframes popIn {
    0% { transform: scale(0.7); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
  }
</style>
</div>

<script>
document.querySelectorAll('.dark-neo-card').forEach(card => {
  card.addEventListener('click', function(e) {
    const modal = document.getElementById('suggestionModal');
    const modalBody = document.getElementById('modalBody');
    modalBody.innerHTML = card.innerHTML;
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
  });
});
document.getElementById('closeModal').onclick = function() {
  document.getElementById('suggestionModal').style.display = 'none';
  document.body.style.overflow = '';
};
window.onclick = function(event) {
  const modal = document.getElementById('suggestionModal');
  if (event.target === modal) {
    modal.style.display = 'none';
    document.body.style.overflow = '';
  }
};
</script>
</div>

<style>
  .square-img-container {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    position: relative;
  }
  .square-img-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    aspect-ratio: 1/1;
    transition: transform 0.5s ease;
    display: block;
  }
</style>
<!-- suggestions.blade -->

<!-- Rooms Suggestions Section -->
<div class="container-fluid px-0 my-5">
  <h2 class="mb-4 fw-bold text-center" style="color: #fff;">Room Suggestions</h2>
  <p class="text-center mb-4" style="font-size:1.1rem; color: #ffd600;">Find your perfect space for comfort and peace.</p>
  <div class="row g-4 justify-content-center">
    
    <!-- Room Suggestions (12 cards) -->
    @for ($i = 1; $i <= 12; $i++)
  <div class="col-xl-3 col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
        <div class="card dark-neo-card square-card w-100 h-100" style="aspect-ratio: 1/1; min-width: 260px; min-height: 260px;">
          <div class="square-img-container">
            <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=500&q=80" class="card-img-top" alt="Room Suggestion {{ $i }}">
          </div>
          <div class="card-body bg-dark-2">
            <h5 class="card-title text-primary neon-text-hover">Room Suggestion {{ $i }}</h5>
            <p class="card-text text-muted">Description for room {{ $i }}</p>
            <div class="d-flex justify-content-between align-items-center mt-3">
              <span class="badge bg-primary text-dark fs-6 py-2 px-3">${{ 100 + $i * 10 }}</span>
              <button class="btn btn-sm btn-outline-primary neon-hover">View</button>
            </div>
          </div>
        </div>
      </div>
    @endfor
</div>

  <hr class="my-4" style="border: none; border-top: 2px solid #fff; width: 60%; margin: 32px auto; opacity: 1;" />

<!-- Food Vendor Suggestions Section -->
<div class="container-fluid px-0 my-3">
  <h2 class="mb-4 fw-bold text-center" style="color: #fff;">Food Vendor Suggestions</h2>
  <p class="text-center mb-4" style="font-size:1.1rem; color: #ffd600;">Delicious meals from trusted local vendors.</p>
  <div class="row row-cols-1 row-cols-md-3 g-3 justify-content-center">

    <!-- Food Vendor Suggestions (12 cards) -->
    @for ($i = 1; $i <= 12; $i++)
      <div class="col-xl-3 col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
        <div class="card dark-neo-card square-card food-vendor-card w-100 h-100" style="aspect-ratio: 1/1;">
          <div class="square-img-container">
            <img src="https://images.unsplash.com/photo-1559847844-5315695dadae?auto=format&fit=crop&w=500&q=80" class="card-img-top" alt="Food Vendor {{ $i }}">
          </div>
          <div class="card-body bg-dark-2">
            <h5 class="card-title text-warning neon-text-hover">Food Vendor {{ $i }}</h5>
            <p class="card-text text-muted">Descriptions for vendor {{ $i }}</p>
            <div class="d-flex justify-content-between align-items-center mt-3">
              <span class="badge bg-warning text-dark fs-6 py-2 px-3">{{ '123-456-78' . sprintf('%02d', $i) }}</span>
              <button class="btn btn-sm btn-outline-warning neon-hover">Menu</button>
            </div>
          </div>
        </div>
      </div>
    @endfor
</div>
