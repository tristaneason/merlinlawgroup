<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package sparxoo-dev
 */

?>

<section class="no-results not-found">
	<h2 class="section-title"><?php esc_html_e( 'No Results Found', 'sparxoo-dev' ); ?></h2>

	<div class="entry-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'sparxoo-dev' ); ?></p>
			<?php
				get_template_part( 'template-parts/search', 'form' );

		  else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'sparxoo-dev' ); ?></p>
			<?php
				get_template_part( 'template-parts/search', 'form' );

		endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
