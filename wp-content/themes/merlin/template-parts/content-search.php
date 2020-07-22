<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package sparxoo-dev
 */

?>
<article class="search-results-item">
	<div class="entry-header">
		<?php the_title( sprintf( '<h2 class="section-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</div><!--/.entry-header -->
	<div class="entry-summary">
    <div class="post-type-title">
      <?php
        $post_type_name = get_post_type( $post->ID );
        if ($post_type_name == 'post') : echo 'Blog';
        else : echo $post_type_name;
        endif;
      ?>
    </div>
		<?php the_excerpt(); ?>
	</div><!--/.entry-summary -->
  <a class="arrow-right" href="<?php the_permalink(); ?>"></a>
</article><!--/.search-results-item-->
