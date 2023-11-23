<?php 
require_once (BASE_PATH . '/template/App/layouts/header.php');
?>

  <main id="main">

    <!-- ======= Hero Slider Section ======= -->
    <section id="hero-slider" class="hero-slider">
      <div class="container-md" data-aos="fade-in">
        <div class="row">
          <div class="col-12">
            <div class="swiper sliderFeaturedPosts">
              <div class="swiper-wrapper">
                <?php foreach($newestArticles as $newestArticle) {?>
                <div class="swiper-slide">
                  <a href="<?= url('single-post/'.$newestArticle['id'], $newestArticle['title']) ?>" class="img-bg d-flex align-items-end" style="background-image: url('<?= asset($newestArticle['image']) ?>');">
                    <div class="img-bg-inner">
                      <h2><?= $newestArticle['title'] ?></h2>
                      <p><?= substr($newestArticle['summary'], 0, 300) . ' ...' ?></p>
                    </div>
                  </a>
                </div>
                  <?php } ?>
              </div>
              <div class="custom-swiper-button-next">
                <span class="bi-chevron-right"></span>
              </div>
              <div class="custom-swiper-button-prev">
                <span class="bi-chevron-left"></span>
              </div>

              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Hero Slider Section -->

    <!-- ======= Post Grid Section ======= -->
    <section id="posts" class="posts">
      <div class="container" data-aos="fade-up">
        <div class="row g-5">
          <div class="col-lg-4">
            <div class="post-entry-1 lg">
              <a href="single-post.html"><img src="<?= asset($topViewArticle['image']) ?>" alt="" class="img-fluid"></a>
              <div class="post-meta"><span class="date"><?= $topViewArticle['category_name'] ?></span> <span class="mx-1">&bullet;</span> <span><?= $topViewArticle['created_at'] ?></span></div>
              <h2><a href="<?= url('single-post/'.$topViewArticle['id'], $topViewArticle['title']) ?>"><?= $topViewArticle['title'] ?></a></h2>
              <p class="mb-4 d-block"><?= $topViewArticle['summary'] ?></p>

              <div class="d-flex align-items-center author">
                <div class="photo"><img src="assets/img/person-1.jpg" alt="" class="img-fluid"></div>
                <div class="name">
                  <h3 class="m-0 p-0"><?= $topViewArticle['username'] ?></h3>
                </div>
              </div>
            </div>

          </div>

          <div class="col-lg-8">
            <div class="row g-5">
              <div class="col-lg-4 border-start custom-border">
                <?php foreach($randomArticles as $randomArticle) {?>
                <div class="post-entry-1">
                  <a href="<?= url('single-post/'.$randomArticle['id'], $randomArticle['title']) ?>"><img src="<?= asset($randomArticle['image']) ?>" alt="" class="img-fluid"></a>
                  <div class="post-meta"><span class="date"><?= $randomArticle['category_name'] ?></span> <span class="mx-1">&bullet;</span> <span><?= $randomArticle['created_at'] ?></span></div>
                  <h2><a href="single-post.html"><?= substr($randomArticle['title'], 0, 25).' ...' ?></a></h2>
                </div>
                <?php }?>
              </div>
              <div class="col-lg-4 border-start custom-border">
              <?php foreach($randomArticles2 as $randomArticle2) {?>
                <div class="post-entry-1">
                  <a href="<?= url('single-post/'.$randomArticle2['id'], $randomArticle2['title']) ?>"><img src="<?= asset($randomArticle2['image']) ?>" alt="" class="img-fluid"></a>
                  <div class="post-meta"><span class="date"><?= $randomArticle2['category_name'] ?></span> <span class="mx-1">&bullet;</span> <span><?= $randomArticle2['created_at'] ?></span></div>
                  <h2><a href="single-post.html"><?= substr($randomArticle2['title'], 0, 25).' ...' ?></a></h2>
                </div>
                <?php }?>
              </div>

              <!-- Trending Section -->
              <div class="col-lg-4">

                <div class="trending">
                  <h3>Trending</h3>
                  <ul class="trending-post">
                    <?php foreach($mostViewArticles as $mostViewArticle) {?>
                    <li>
                      <a href="<?= url('single-post/'.$mostViewArticle['id'], $mostViewArticle['title']) ?>">
                        <span class="number">1</span>
                        <h3><?= substr($mostViewArticle['title'], 0, 50).' ...' ?></h3>
                        <span class="author"><?= $mostViewArticle['username'] ?></span>
                      </a>
                    </li>
                    <?php } ?>
                  </ul>
                </div>

              </div> <!-- End Trending Section -->
            </div>
          </div>

        </div> <!-- End .row -->
      </div>
    </section> <!-- End Post Grid Section -->

    

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
<?php
require_once (BASE_PATH . '/template/App/layouts/footer.php');
?>