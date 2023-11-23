<footer id="footer" class="footer">

    <div class="footer-content">
      <div class="container">

        <div class="row g-5">
          <div class="col-lg-4">
            <h3 class="footer-heading">About ZenBlog</h3>
            <p><?= $websetting['description'] ?></p>
            <p><a href="about.html" class="footer-link-more">Learn More</a></p>
          </div>
          <div class="col-6 col-lg-2">
            <h3 class="footer-heading">Navigation</h3>
            <ul class="footer-links list-unstyled">
              <li><a href="index.html"><i class="bi bi-chevron-right"></i> Home</a></li>
              <li><a href="index.html"><i class="bi bi-chevron-right"></i> Blog</a></li>
              <li><a href="category.html"><i class="bi bi-chevron-right"></i> Categories</a></li>
              <li><a href="single-post.html"><i class="bi bi-chevron-right"></i> Single Post</a></li>
              <li><a href="about.html"><i class="bi bi-chevron-right"></i> About us</a></li>
              <li><a href="contact.html"><i class="bi bi-chevron-right"></i> Contact</a></li>
            </ul>
          </div>
          <div class="col-6 col-lg-2">
            <h3 class="footer-heading">Categories</h3>
            <ul class="footer-links list-unstyled">

            <?php foreach($categories as $category) {?>
              <li><a href="#"><i class="bi bi-chevron-right"></i><?= $category['name'] ?> </a></li>
              <?php } ?>

            </ul>
          </div>

          <div class="col-lg-4">
            <h3 class="footer-heading">Recent Posts</h3>

            <ul class="footer-links footer-blog-entry list-unstyled">

            <?php foreach($recentArticles as $recentArticle) {?>
              <li>
                <a href="single-post.html" class="d-flex align-items-center">
                  <img src="<?= asset($recentArticle['image']) ?>" alt="" class="img-fluid me-3">
                  <div>
                    <div class="post-meta d-block"><span class="date"><?= $recentArticle['category_name'] ?></span> <span class="mx-1">&bullet;</span> <span><?= $recentArticle['created_at'] ?></span></div>
                    <span><?= $recentArticle['title'] ?></span>
                  </div>
                </a>
              </li>
              <?php } ?>
              
            </ul>

          </div>
        </div>
      </div>
    </div>

    <div class="footer-legal">
      <div class="container">

        <div class="row justify-content-between">
          <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
            <div class="copyright">
              © Copyright <strong><span>ZenBlog</span></strong>. All Rights Reserved
            </div>

            <div class="credits">
              <!-- All the links in the footer should remain intact. -->
              <!-- You can delete the links only if you purchased the pro version. -->
              <!-- Licensing information: https://bootstrapmade.com/license/ -->
              <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/herobiz-bootstrap-business-template/ -->
              Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>

          </div>

          <div class="col-md-6">
            <div class="social-links mb-3 mb-lg-0 text-center text-md-end">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bi bi-skype"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>

          </div>

        </div>

      </div>
    </div>

  </footer>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?= asset('public/app/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= asset('public/app/assets/vendor/swiper/swiper-bundle.min.js') ?>"></script>
  <script src="<?= asset('public/app/assets/vendor/glightbox/js/glightbox.min.js') ?>"></script>
  <script src="<?= asset('public/app/assets/vendor/aos/aos.js') ?>"></script>
  <!-- <script src="<?= asset('public/app/assets/vendor/php-email-form/validate.js') ?>"></script> -->

  <!-- Template Main JS File -->
  <script src="<?= asset('public/app/assets/js/main.js') ?>"></script>

</body>

</html>