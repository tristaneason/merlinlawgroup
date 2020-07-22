<?php
/**
Template Name: Awards
 */
get_header();
get_template_part( 'template-parts/section', 'hero' );

?>
<div class="page-awards">

<section class="section-breadcrumbs bg-gray">
  <div class="container">
    <?php get_template_part( 'template-parts/section', 'breadcrumbs' ); ?>
  </div>
</section>

<section class="section-wrap page-firm-intro">
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

<section class="section-wrap no-pad-t bg-white">
  <div clas="container">
    <div class="row">
      <div class="col-xs-12">
        <?php get_template_part( 'template-parts/section', 'awards' ); ?>
      </div>
    </div>
  </div>
</section>

</div><!--/.page-firm-->


<?php
//get_sidebar();
get_footer();
?>
