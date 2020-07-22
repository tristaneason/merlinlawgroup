<?php
$args = array(
  'post_type' => 'testimonial',
  'posts_per_page' => 6
);
$query = new WP_Query($args);
?>
<div id="carousel" class="carousel slide" data-ride="carousel">

  <!--Indicators-->
  <ol class="carousel-indicators">
    <?php //start loop for indicators
      if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
      $count = $query->current_post;
    ?>
    <li data-target="#carousel" data-slide-to="<?php echo $count; ?>" <?php if($count == 0): ?>class="active"<?php endif; ?> ></li>
    <?php endwhile; endif; ?>
  </ol>
  <!--/Indicators-->

  <div class="carousel-inner">
    <?php // start the loop for testimonials
      if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
      $count = $query->current_post;
    ?>
    <div class="item <?php echo $count; ?> <?php if($count == 0): ?>active<?php endif; ?>">
      <div class="carousel-content">
        <div class="carousel-title">
          <h5><?php the_field('testimonial_company_name'); ?></h5>

          <?php // display custom tax name == 'testimonial type'
          $terms = get_the_terms( $post->ID , 'testimonial-type' );
            foreach ( $terms as $term ) {
            echo '<h5>' . $term->name . '</h5>';
          }

          ?>
        </div><!--/.carousel-title-->
        <div class="carousel-entry">
          <?php the_content(); ?>
        </div><!--/.carousel-entry-->
      </div><!--/.carousel-caption-->
    </div><!--/.item-->

    <?php endwhile; endif; ?>
    <?php wp_reset_postdata(); ?>
  </div><!--/.carousel-inner-->

</div><!--/#carusel-->
