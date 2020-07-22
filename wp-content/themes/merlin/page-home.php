<?php
/**
Template Name: Homepage
 */
get_header();
// start loop
while ( have_posts() ) : the_post();

get_template_part( 'template-parts/section', 'hero' );

//Field Group == Template-Home
$home_intro_title = get_field('home_intro_title');
$home_intro_copy = get_field('home_intro_copy');
$home_intro_img = get_field('home_intro_img');

$home_case_review_title = get_field('home_case_review_title');
$home_case_review_copy = get_field('home_case_review_copy');
$home_case_review_img = get_field('home_case_review_img');

$home_resources_title = get_field('home_resources_title');
$home_resources_copy = get_field('home_resources_copy');

$home_testimonials_title = get_field('home_testimonials_title');

$home_awards_title = get_field('home_awards_title');
$home_awards_copy= get_field('home_awards_copy');

$home_outro_title = get_field('home_outro_title');
$home_outro_copy= get_field('home_outro_copy');

$site_twitter_url = get_field('site_twitter_url', 'option');
$site_linkedin_url = get_field('site_linkedin_url', 'option');
$site_facebook_url = get_field('site_facebook_url', 'option');
?>


  </div><!--/.container-->
</section><!--/.home-resources-->

<section class="home-intro bg-white text-primary">
  <div class="col-xs-12 col-sm-6 no-pad pull-right home-intro-img">
    <div class="img-overlay primary">
      <img class="img-wrap" id="js-img-change" src="<?php echo $home_intro_img; ?>">
      <div class="pos-btm-center hidden-sm">
        <a class="underline-from-left" href="<?php echo home_url(); ?>/insurance">View our full list of insurance claim specialties.</a>
      </div>
    </div><!--/.img-overlay.primary-->
  </div><!--/.col-->
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-6 section-wrap no-pad-b home-intro-text">
        <h6 class="section-title-sm home-intro-text-title"><?php echo $home_intro_title; ?></h6>
        <div class="home-intro-text-copy">
          <?php echo $home_intro_copy; ?>
        </div><!--/.home-intro-text-copy-->
      </div><!--/.col-->
    </div><!--/.row-->
  </div><!--/.container-->
</section><!--/.home-intro-->

<section class="home-case-review section-wrap-lg bg-img-cover" style="background-image:url('<?php echo $home_case_review_img; ?>')">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-6">
        <h3 class="section-title home-case-review-title"><?php echo $home_case_review_title; ?></h3>
        <div class="home-case-review-copy">
          <?php echo $home_case_review_copy; ?>
          <a class="btn secondary" href="<?php echo home_url(); ?>/contact-us/#free-case-review">Submit a Free Case Review</a>
        </div><!--/.home-case-review-copy-->
      </div><!--/.col-->
    </div><!--/.row-->
  </div><!--/.container-->
</section><!--/.home-case-review-->

<section class="home-resources section-wrap bg-white">
  <div class="container">
    <h6 class="section-title text-center">Our Insurance Claim Resources at Your Fingertips</h6>
    <h2 class="section-title text-center">Merlin Law Group is Committed to Educating the Public<br />on Insurance Litigation Topics</h2>
    <?php get_template_part('template-parts/section', 'resources'); ?>
  </div><!--/.container-->
</section><!--/.home-resources-->

<section class="home-testimonials section-wrap bg-primary">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-offset-3 col-sm-6 text-center">
        <h2 class="section-title home-case-review-title"><?php echo $home_testimonials_title; ?></h2>
      </div><!--/.col-->
    </div><!--/.row-->
    <div class="row">
      <div class="col-xs-12 col-sm-offset-3 col-sm-6 text-center">
        <?php get_template_part( 'template-parts/section', 'testimonials' ); ?>
      </div><!--/.col-->
    </div><!--/.row-->
  </div><!--/.container-->
</section><!--/.home-testimonials-->

<section class="home-awards section-wrap bg-white">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-offset-3 col-sm-6 text-center">
        <h3 class="section-title home-case-review-title"><?php echo $home_awards_title; ?></h3>
        <div class="home-awards-copy">
          <?php echo $home_awards_copy; ?>
        </div><!--/.home-awards-copy-->
      </div><!--/.col-->
    </div><!--/.row-->
    <div class="row">
      <div class="col-xs-12 awards-wrap">
        <?php get_template_part( 'template-parts/section', 'awards' ); ?>
      </div><!--/.col.awards-wrap-->
    </div><!--/.row-->
  </div><!--/.container-->
</section><!--/.home-awards-->

<section class="home-outro section-wrap bg-gray">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-offset-3 col-sm-6 text-center">
        <h3 class="section-title home-case-review-title"><?php echo $home_outro_title; ?></h3>
        <div class="home-outro-copy">
          <?php echo $home_outro_copy; ?>
          <a class="btn secondary" href="<?php echo home_url(); ?>/contact-us">Schedule a Case Evaluation</a>
        </div><!--/.home-outro-copy-->
      </div><!--/.col-->
    </div><!--/.row-->
  </div><!--/.container-->
</section><!--/.home-outro-->

<?php endwhile; // End loop ?>

<?php
get_footer();
?>
