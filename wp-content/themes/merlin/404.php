<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package sparxoo-dev
 */

get_header();
get_template_part( 'template-parts/section', 'hero' );
?>
<section class="section-wrap page-intro">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <?php
          //while ( have_posts() ) : the_post();
          //get_template_part( 'template-parts/content', 'page' );
          //endwhile;
        ?>
        <p>The page you are looking for does not exist. <a href="<?php echo home_url(); ?>">Click here to return to homepage</a>, or try searching for another page using the form below.</p>
        <?php get_template_part( 'template-parts/search', 'form' ); ?>
      </div><!--/.col-->
    </div><!--/.row-->
  </div><!--/.container-->
</section>


<?php
get_footer();
