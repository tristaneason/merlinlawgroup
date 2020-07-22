<?php
// Section-Resources

$site_twitter_url = get_field('site_twitter_url', 'option');
$site_linkedin_url = get_field('site_linkedin_url', 'option');
$site_facebook_url = get_field('site_facebook_url', 'option');

?>

<div class="row">
  <div class="col-xs-12 col-sm-offset-3 col-sm-6 text-center">
    <h6 class="section-title-sm home-case-review-title"><?php echo $home_resources_title; ?></h6>
    <div class="section-title home-resources-copy">
      <?php echo $home_resources_copy; ?>
    </div><!--/.home-case-review-copy-->
  </div><!--/.col-->
</div><!--/.row-->
<div class="row resources-wrap">
  <?php
    // if resource_is_featured is checked
    $args = array(
      'post_type' => 'resource',
      'posts_per_page' => 1,
      'order' => 'DESC',
      'orderby' => 'date',
      'meta_query'  => array(
       array(
         'key' => 'resource_is_featured',
         'value' => '1',
         'compare' => '==',
       ),
      ),
    );
    // if resource_is_featured is NOT checked, show latest by published date
      $args2 = array(
        'post_type' => 'resource',
        'posts_per_page' => 1,
        'order' => 'DESC',
        'orderby' => 'date'
      );
      $is_featured_set = new WP_Query($args);
      $default = new WP_Query($args2);

      if ($is_featured_set->have_posts()) :
      while($is_featured_set->have_posts()) : $is_featured_set->the_post();
      // FEATURED IS SET ?>
  <div class="card-items col-xs-12 col-sm-6">
    <div class="card-item blg height-lg bg-img-cover" style="background-image:url('<?php echo get_the_post_thumbnail_url( $post_id ); ?>')">
      <span class="resource-type">Blog</span>
      <p class="resource-title"><?php the_title(); ?></p>
      <p class="resource-excerpt"><?php the_excerpt(); ?></p>
      <div class="resource-more">
        <a class="btn secondary read-more" href="<?php the_permalink(); ?>">Read More</a>
      </div>
    </div><!--/.item-pad-->
  </div><!--/.item-->
<?php endwhile;
  else :
  while($default->have_posts()) : $default->the_post();
  // FEATURED IS NOT SET ?>
  <div class="card-items col-xs-12 col-sm-6">
    <div class="card-item blg height-lg bg-img-cover" style="background-image:url('<?php echo get_the_post_thumbnail_url( $post_id ); ?>')">
      <span class="resource-type">Blog</span>
      <p class="resource-title"><?php the_title(); ?></p>
      <p class="resource-excerpt"><?php the_excerpt(); ?></p>
      <div class="resource-more">
        <a class="btn secondary read-more" href="<?php the_permalink(); ?>">Read More</a>
      </div>
  </div><!--/.item-pad-->
  </div><!--/.item-->

<?php endwhile; endif; ?>

  <div class="card-items col-xs-12 col-sm-6">
    <div class="card-item fb height-sm bg-img-cover" style="background-image:url('<?php echo get_template_directory_uri(); ?>/public/img/bg-fb.jpg')">
      <span class="resource-type">Facebook</span>
      <p class="resource-title">
        <?php echo do_shortcode('[recent_facebook_posts number=1 excerpt_length=75 show_page_link=0]'); ?>
      </p>
      <div class="resource-more">
        <a class="btn secondary read-more" href="<?php echo $site_facebook_url; ?>" target="_blank">Follow Us</a>
      </div>
    </div><!--/.item-pad-->
  </div><!--/.item-->

  <div class="card-items col-xs-12 col-sm-6">
    <div class="card-item tw height-sm bg-gray">
      <span class="resource-type">Twitter</span>
      <div id="latest-tweet"></div>
      <div class="resource-more">
        <a class="btn secondary read-more" href="<?php echo $site_twitter_url; ?>" target="_blank">Follow Us</a>
      </div>
    </div><!--/.item-pad-->
  </div><!--/.item-->
</div>
<a class="underline-from-left primary view-more pull-right" href="<?php echo home_url(); ?>/resources">View More Resources</a>
</div><!--/.row-->
