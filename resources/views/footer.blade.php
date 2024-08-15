 <!-- footer section starts  -->
 <section class="footer">
    <div class="box-container">
      <div class="box">
        <h3>branches</h3>
        <a href="#"> <i class="fas fa-map-marker-alt"></i> Johor </a>
        <a href="#"> <i class="fas fa-map-marker-alt"></i> Kuala Lumpur </a>
        <a href="#"> <i class="fas fa-map-marker-alt"></i> Mersing </a>
        <a href="#"> <i class="fas fa-map-marker-alt"></i> Penang </a>
        <a href="#"> <i class="fas fa-map-marker-alt"></i> Muar </a>
      </div>

      <div class="box">
        <h3>quick links</h3>
        <a href="#"> <i class="fas fa-arrow-right"></i> home </a>
        <a href="#"> <i class="fas fa-arrow-right"></i> service </a>
        <a href="#"> <i class="fas fa-arrow-right"></i> about </a>
        <a href="#"> <i class="fas fa-arrow-right"></i> gallery </a>
        {{-- <a href="#"> <i class="fas fa-arrow-right"></i> price </a> --}}
        <a href="#"> <i class="fas fa-arrow-right"></i> reivew </a>
        <a href="#"> <i class="fas fa-arrow-right"></i> contact </a>
      </div>

      <div class="box">
        <h3>contact info</h3>
        <a href="#"> <i class="fas fa-phone"></i> 60+165093316 </a>
        {{-- <a href="#"> <i class="fas fa-phone"></i> +123-456-7890 </a> --}}
        <a href="#"> <i class="fas fa-envelope"></i> kanasu@gmail.com </a>
        <a href="#"> <i class="fas fa-envelope"></i> kanasuind@gmail.com </a>
        <a href="#">
          <i class="fas fa-map-marker-alt"></i> Southern University College
        </a>
      </div>

      <div class="box">
        <h3>follow us</h3>
        <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
        <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
        <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
        <a href="#"> <i class="fab fa-linkedin-in"></i> linkedin </a>
      </div>
    </div>

    <div class="credit">
      created by <span>LeeTq</span> | all rights reserved
    </div>
  </section>

  <!-- theme toggler  -->
  <div class="theme-toggler">
    <div class="toggle-btn">
      <i class="fas fa-cog"></i>
    </div>

    <h3>choose color</h3>

    <div class="buttons">
      <div class="theme-btn" style="background: #ccff33"></div>
      <div class="theme-btn" style="background: #d35400"></div>
      <div class="theme-btn" style="background: #f39c12"></div>
      <div class="theme-btn" style="background: #1abc9c"></div>
      <div class="theme-btn" style="background: #3498db"></div>
      <div class="theme-btn" style="background: #9b59b6"></div>
    </div>
  </div>

  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

  <!--JS file-->
{{--  <script src="app.js"></script>--}}
</body>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
<form id="login-form" action="{{ route('login') }}" method="POST" style="display: none;">
  @csrf
</form>
</div>
</body>
</html>
