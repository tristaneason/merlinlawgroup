<?php
//Custom Field Group == Section-Hero
$hero_type = get_field('hero_type');
$hero_bg = get_field('hero_bg');
$is_overlay = get_field('hero_is_overlay'); //boolean
$is_full_height = get_field('hero_is_full_height');//boolean
$hero_title = get_field('hero_title');
$hero_subtitle = get_field('hero_subtitle');
$hero_cta_title = get_field('hero_cta_title');
$hero_cta_link = get_field('hero_cta_link');
?>

<?php // If Hero Type "Slider" is selected
if ($hero_type == "Slider") : ?>
    <?php // slider loop
    $slides = get_field('hero_slider');
    if ($slides) : ?>
      <div class="gallery js-flickity" data-flickity-options='{"autoPlay": 5000, "prevNextButtons": false, "wrapAround": true, "pauseAutoPlayOnHover": false }'>
          <?php foreach($slides as $slide) : ?>
            <section class="hero hero-type-slider page-header vertical-center <?php if ($is_full_height == true) : echo 'full-height'; endif; ?> <?php if ($is_overlay == true) : echo 'has-overlay'; endif; ?>" style="background-image:url('<?php echo $slide['hero_slide_img']; ?>');">
              <div class="container">
                <div class="col-xs-12 gallery-cell hero-text">
                  <h1 class="hero-title">
                    <?php echo $slide['hero_slide_title']; ?>
                  </h1>
                  <p class="hero-subtitle">
                    <?php echo $slide['hero_slide_subtitle']; ?>
                  </p>
                  <?php if ($slide['hero_slide_cta_link']) : ?>
                    <a class="btn secondary hvr-ripple-out" href="<?php echo $slide['hero_slide_cta_link']; ?>"><?php echo $slide['hero_slide_cta_title']; ?></a>
                  <?php else : ?>
                  <?php endif; ?>
                </div><!--/.gallery-cell-->
              </div><!--/.container-->
            </section>
          <?php endforeach; ?>
      </div><!--/.row.gallery-->
    <?php endif; ?>
<link href="https://npmcdn.com/flickity@2.0.10/dist/flickity.css" />
<script src="https://unpkg.com/flickity@2.0.8/dist/flickity.pkgd.min.js"></script>



<?php // Else; Default hero type
else : ?>
<section class="hero hero-type-default page-header vertical-center <?php if ($is_full_height == true) : echo 'full-height'; endif; ?><?php if ($is_overlay == true) : echo 'has-overlay'; endif; ?>" style="background-image:url('<?php echo $hero_bg; ?>');">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-offset-2 col-sm-8 hero-text">
        <?php if ($hero_title) : ?>
          <h1 class="hero-title"><?php echo $hero_title; ?></h1>
        <?php elseif ( is_search() ) : ?>
          <h1 class="hero-title"><?php printf( esc_html__( 'Results for: %s', 'sparxoo-dev' ), '<strong>' . get_search_query() . '</strong>' ); ?></h1>
        <?php elseif ( is_404() ) : ?>
          <h1 class="hero-title"><?php printf( esc_html__( 'Page Does Not Exist: 404', 'sparxoo-dev' ), '<strong>' . get_search_query() . '</strong>' ); ?></h1>
        <?php else : ?>
          <h1 class="hero-title"><?php the_title(); ?></h1>
        <?php endif; ?>
        <?php if ($hero_subtitle) : ?>
          <p class="hero-subtitle"><?php echo $hero_subtitle; ?></p>
        <?php else : ?>
        <?php endif; ?>
        <?php if ($hero_cta_link) : ?>
          <a class="btn secondary hvr-ripple-out" href="<?php echo $hero_cta_link; ?>"><?php echo $hero_cta_title; ?></a>
        <?php else : ?>
        <?php endif; ?>
      </div><!--/.col-->
    </div><!--/.row-->

    <?php // if 'is_full_height' is set, add scroll down arrow
    if ($is_full_height == true) : ?>
    <div class="scroll-down">
      <span class="arrow-down"></span>
    </div><!--#scroll-down-->
    <?php endif; ?>

  </div><!--/.container-->
</section><!--/.hero.hero-type-default-->
<?php endif; ?>
