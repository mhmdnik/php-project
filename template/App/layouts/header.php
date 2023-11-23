<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>ZenBlog Bootstrap Template - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= asset('public/app/assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= asset('public/app/assets/vendor/bootstrap-icons/bootstrap-icons.css') ?> rel="stylesheet">
  <link href="<?= asset('public/app/assets/vendor/swiper/swiper-bundle.min.css') ?>" rel="stylesheet">
  <link href="<?= asset('public/app/assets/vendor/glightbox/css/glightbox.min.css') ?>" rel="stylesheet">
  <link href="<?= asset('public/app/assets/vendor/aos/aos.css') ?>" rel="stylesheet">

  <!-- Template Main CSS Files -->
  <link href="<?= asset('public/app/assets/css/variables.css') ?>" rel="stylesheet">
  <link href="<?= asset('public/app/assets/css/main.css') ?>" rel="stylesheet">

  <!-- =======================================================
  * Template Name: ZenBlog - v1.2.1
  * Template URL: https://bootstrapmade.com/zenblog-bootstrap-blog-template/
  * Author: BootstrapMade.com
  * License: https:///bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="<?= url('/') ?>" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>ZenBlog</h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>

        <?php

                use Database\Database;

 foreach($menus as $menu) {?>
            <li><?php if($menu['parent_id']== null && $menu['submenu_count'] == 0){ ?><a href="<?= url($menu['url']) ?>"><?= $menu['name'] ?></a><?php }?></li>
            <?php if($menu['submenu_count'] > 0) {?>
          <li class="dropdown"><a href="category.html"><span><?= $menu['name'] ?></span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
            <?php foreach($submenus as $submenu) {
              if($submenu['parent_id'] == $menu['id']){
                ?>
              <li><a href="<?= $submenu['url'] ?>"><?= $submenu['name'] ?></a></li>
              <?php }} ?>
            </ul>
            <?php }?>
          </li>
           
            

          <?php } ?>
          
      
          <?php if(!isset($_SESSION['user_id'])) {?>
            <ul>
              
              <li class="dropdown"><a href="#"><span>login/register</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                  <li><a href="<?= url('login') ?>">login</a></li>
                  <li><a href="<?= url('register') ?>">register</a></li>
                  
                </ul>
              </li>
              
            </ul>
            <?php }else{ 
              $db = new Database();
              $user = $db->select("SELECT * FROM users WHERE id = ?", [$_SESSION['user_id']])->fetch();
              ?>
              <li class="dropdown"><a href="#"><span><?= $user['username'] ?></span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                  <li><a href="<?= url('logout') ?>">logout</a></li>
                </ul>
              </li>
              <?php } ?>
        </ul>
      </nav><!-- .navbar -->

      <div class="position-relative">
        <a href="#" class="mx-2"><span class="bi-facebook"></span></a>
        <a href="#" class="mx-2"><span class="bi-twitter"></span></a>
        <a href="#" class="mx-2"><span class="bi-instagram"></span></a>

        <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>
        <i class="bi bi-list mobile-nav-toggle"></i>

        <!-- ======= Search Form ======= -->
        <div class="search-form-wrap js-search-form-wrap">
          <form action="search-result.html" class="search-form">
            <span class="icon bi-search"></span>
            <input type="text" placeholder="Search" class="form-control">
            <button class="btn js-search-close"><span class="bi-x"></span></button>
          </form>
        </div><!-- End Search Form -->

      </div>

    </div>

  </header><!-- End Header -->