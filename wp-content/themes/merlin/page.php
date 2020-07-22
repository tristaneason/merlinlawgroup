<?php
get_header();

get_template_part( 'template-parts/section', 'hero' );
?>

<section class="section-breadcrumbs bg-gray">
  <div class="container">
    <?php get_template_part( 'template-parts/section', 'breadcrumbs' ); ?>
  </div>
</section>

<section class="section-wrap section-page-default page-intro">
  <div class="container">
    <div class="row entry-content">
      <div class="col-xs-12">
        <?php
          while ( have_posts() ) : the_post();
            the_content();
          endwhile;
        ?>
      </div><!--/.col-->
    </div><!--/.row-->
  </div><!--/.container-->
</section>


<?php
//get_sidebar();
get_footer();
?>
