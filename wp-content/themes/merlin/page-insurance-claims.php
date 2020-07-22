<?php
/**
Template Name: Insurance Claims
 */
get_header();
get_template_part( 'template-parts/section', 'hero' );

$args = array(
  'post_type' => 'insurance',
  'posts_per_page' => -1,
  'order' => 'ASC',
  'orderby' => 'title'
);
$query = new WP_Query($args);
?>

<section class="section-breadcrumbs bg-gray">
  <div class="container">
    <?php get_template_part( 'template-parts/section', 'breadcrumbs' ); ?>
  </div>
</section>

<section class="section-wrap page-loss">
  <div class="container">
    <div class="entry-content interior-basic-content pad-bottom border-bottom">
    <?php
      while ( have_posts() ) : the_post();
        the_content();
      endwhile;
    ?>
    <div class="read-more">
      <a class="btn secondary read-more pull-right" href="<?php echo home_url(); ?>/our-firm">Learn More About Us</a>
    </div><!--/.read-more-->
  </div><!--/.entry-content-->
    <h6 class="section-title">In Alphabetical Order</h6>
    <h3 class="section-title">Insurance Claims</h6>

    <div class="row">
        <?php //start loop
          if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
          <div class="col-xs-12 col-sm-6 card-items">
            <a href="<?php the_permalink(); ?>">
            <div class="card-item">
              <div class="section-title">
                <?php the_title(); ?>
              </div><!--/.section-title-->
              <div class="section-excerpt">
                <?php the_excerpt(); ?>
              </div><!--/.section-excerpt-->
              <div class="read-more">
                <a class="underline-from-left" href="<?php the_permalink(); ?>">Read More</a>
              </div><!--/.read-more-->
            </div><!--/.item-->
            </a>
          </div><!--/.col.item-wrap-->
        <?php
          endwhile; endif;
        ?>
    </div><!--/.row-->
  </div><!--/.container-->
</section>

<section class="section-wrap section-form">
  <div class="container">
    <?php get_template_part( 'template-parts/section', 'links' ); ?>
  </div>
</section>



<?php
//get_sidebar();
get_footer();
?>
