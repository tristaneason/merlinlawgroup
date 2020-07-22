<?php
/**
Template Name: Resources
 */
get_header();
get_template_part( 'template-parts/section', 'hero' );

// Blog arguments
$args = array(
  'post_type' => 'post',
  'posts_per_page' => 2
  //'order' => 'DESC',
  //'orderby' => 'title'
);
$query = new WP_Query($args);
?>
<div class="page-resources">

<section class="section-breadcrumbs bg-gray">
  <div class="container">
    <?php get_template_part( 'template-parts/section', 'breadcrumbs' ); ?>
  </div>
</section>

<section class="section-wrap border-bottom dark">
  <div class="container">
    <div class="entry-content interior-basic-content">
    <h2 class="section-title" id="blog">Merlin Law Group Blogs</h2>
      <div class="row">
        <?php //start loop
          if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
          <div class="col-xs-12 col-sm-6 card-items">
            <a href="<?php the_permalink(); ?>">
            <div class="card-item blog-item bg-img-cover has-overlay" style="background-image:url('<?php echo get_the_post_thumbnail_url(); ?>')">
              <div class="section-title">
                <?php the_title(); ?>
              </div><!--/.section-title-->
              <div class="section-excerpt">
                <?php the_excerpt(); ?>
              </div><!--/.section-excerpt-->
            </div><!--/.item-->
            </a>
          </div><!--/.col.item-wrap-->
        <?php
          endwhile; endif;
        ?>
    </div><!--/.row-->
  </div><!--/.container-->
</section>
	
<section class="section-wrap section-resources-more">
  <div class="container">
     <h2 class="section-title">Other Recommended Blogs:</h2>
	   <a href="https://www.inredisputesblog.com">Insurance and Reinsurance Dispute Blog</a>
	  
<section class="section-wrap section-resources border-bottom">
  <div class="container">

   <h2 class="section-title text-left">Committed to Sharing Our Knowledge</h2>
    <?php get_template_part( 'template-parts/section', 'resources' ); ?>
  </div>
</section>

<section class="section-wrap section-resources-more">
  <div class="container">
    <h6 class="section-title">Other Resources</h6>
    <h2 class="section-title">Learn More About Insurance Related Topics</h2>
    <div class="row">
          <?php //other resources (insurance) args
          $args = array(
            'post_type' => 'insurance',
            'posts_per_page' => 6
            //'order' => 'DESC',
            //'orderby' => 'title'
          );
          $query = new WP_Query($args);
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
                <a class="underline-from-left" href="<?php the_permalink(); ?>">Browse</a>
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

</div><!--/.page-resources-->

<?php
//get_sidebar();
get_footer();
?>
