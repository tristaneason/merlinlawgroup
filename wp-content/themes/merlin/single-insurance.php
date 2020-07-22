<?php
// Insurance single
get_header();
get_template_part( 'template-parts/section', 'hero' );
?>

<section class="section-breadcrumbs bg-gray">
  <div class="container">
    <?php get_template_part( 'template-parts/section', 'breadcrumbs' ); ?>
  </div>
</section>

<section class="section-wrap section-single">
  <div class="container">
    <div class="entry-content interior-basic-content">
    <?php
      while ( have_posts() ) : the_post();
        the_content();
      endwhile;
    ?>
    </div><!--/.entry-content-->
  </div><!--/.container-->
</section>

<section class="section-wrap section-form bg-gray border-bottom border-dark">
  <div class="container">
    <?php get_template_part( 'template-parts/section', 'contact-form' ); ?>
  </div>
</section>

<section class="section-wrap section-links bg-gray">
  <div class="container">
    <?php get_template_part( 'template-parts/section', 'links' ); ?>
  </div>
</section>

<?php
get_footer(); ?>
