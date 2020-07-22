<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package sparxoo-dev
 */

 get_header();
 get_template_part( 'template-parts/section', 'hero' );
 ?>
 <section class="section-breadcrumbs bg-gray">
   <div class="container">
     <?php get_template_part( 'template-parts/section', 'breadcrumbs' ); ?>
   </div>
 </section>
 
 <section class="section-wrap page-intro">
   <div class="container">
     <div class="row">
       <div class="col-xs-12">
         <?php
         if ( have_posts() ) :
           while ( have_posts() ) : the_post();

             get_template_part( 'template-parts/content', 'search' );

           endwhile;

           the_posts_navigation();

         else :

           get_template_part( 'template-parts/content', 'none' );

         endif; ?>
       </div><!--/.col-->
     </div><!--/.row-->
   </div><!--/.container-->
 </section>


 <?php
 //get_sidebar();
 get_footer();
 ?>
