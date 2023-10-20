<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Manajemen Arsip Surat Berbasis Elektronik | UBSI Kota Tegal</title>
    <link rel="stylesheet" href="{{asset('landingthemes/style.css')}}">
    <!-- Google Fonts Links For Icon -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
  </head>
  <body>
    <header>
      <nav class="navbar">
        <a class="logo" href="#">SIMASBE<span>.</span></a>
        <ul class="menu-links">
          <span id="close-menu-btn" class="material-symbols-outlined">close</span>
          <li><a href="#">Home</a></li>
          <li><a href="#">About us</a></li>
          <li><a href="#">Contact us</a></li>
        </ul>
        <span id="hamburger-btn" class="material-symbols-outlined">menu</span>
      </nav>
    </header>

    <section class="hero-section">
      <div class="content">
        <h2>Selamat Datang di SIMASBE</h2>
        <p>
          SIMASBE adalah aplikasi untuk melakukan pengelolaan arsip surat. <br>Anda dapat mengelola surat masuk dan surat keluar dengan mudah menggunakan aplikasi ini.
        </p>
        <button onclick="javascript:window.location.href='home'">MULAI SEKARANG</button>
      </div>
    </section>

    <script>
      const header = document.querySelector("header");
      const hamburgerBtn = document.querySelector("#hamburger-btn");
      const closeMenuBtn = document.querySelector("#close-menu-btn");

      // Toggle mobile menu on hamburger button click
      hamburgerBtn.addEventListener("click", () => header.classList.toggle("show-mobile-menu"));

      // Close mobile menu on close button click
      closeMenuBtn.addEventListener("click", () => hamburgerBtn.click());
    </script>
    
  </body>
</html>