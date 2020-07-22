<?php
$args = array(
  'post_type' => 'award',
  'posts_per_page' => 6
);
$query = new WP_Query($args);
?>

<?php if( $query->have_posts() ): ?>
	<div class="row award-wrap">
	<?php while( $query->have_posts() ) : $query->the_post(); ?>
		<div class="col-xs-6 col-sm-4 col-md-2 award-item">
			<img src="<?php the_field('award_img'); ?>" alt="<?php the_title(); ?>" />
		</div><!--/.award-item-->
	<?php endwhile; ?>
  </div><!--/.row-->
<?php endif; ?>

<?php wp_reset_query();	?>
