<?php
/**
Template Name: Contact
 */

get_header();

get_template_part( 'template-parts/section', 'hero' );
?>
<div class="page-contact">

<section class="section-breadcrumbs bg-gray">
  <div class="container">
    <?php get_template_part( 'template-parts/section', 'breadcrumbs' ); ?>
  </div>
</section>

<section class="section-wrap section-page-contact bg-gray">
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

<section class="section-wrap section-page-contact-ph page-contact bg-white">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 text-center">
        <svg class="svg-icon svg-phone" viewBox="0 0 83 83" xmlns="http://www.w3.org/2000/svg">
          <path d="M17.688.97c-.582-.033-1.14.07-1.688.186-1.093.235-2.228.66-3.406 1.25-2.346 1.173-4.837 2.93-6.813 4.97l-.03.03C.787 12.39-.687 19.136.312 25.626c1.002 6.5 4.384 12.85 9.22 17.686L39.655 73.47c4.836 4.834 11.217 8.216 17.72 9.218 6.487 1 13.202-.476 18.187-5.438l.03-.03c2.04-1.977 3.797-4.468 4.97-6.814.59-1.178 1.046-2.313 1.28-3.406.236-1.093.402-2.278-.437-3.5-.13-.18-.287-.34-.47-.47L64.75 51.28c-.8-.575-1.9-.482-2.594.22l-3.343 3.344c-1.427 1.426-2.87 2.047-4.126 2.125-1.254.076-2.432-.34-3.656-1.564L27.563 31.97c-1.223-1.225-1.64-2.434-1.562-3.69.077-1.253.73-2.666 2.156-4.092l3.344-3.344c.693-.7.772-1.8.188-2.594L19.968 2.063c-.135-.196-.304-.365-.5-.5-.61-.42-1.2-.563-1.78-.594zm-.5 4.06l10.28 14.157-2.155 2.157c-1.955 1.954-3.132 4.264-3.282 6.687-.148 2.424.827 4.858 2.72 6.75l23.47 23.47c1.892 1.893 4.295 2.868 6.718 2.72 2.422-.15 4.732-1.36 6.687-3.314l2.125-2.125 14.22 10.25c.002.103.01.177-.032.376-.13.598-.456 1.473-.938 2.438-.965 1.93-2.55 4.2-4.188 5.78l-.03.032c-4.01 4.008-9.277 5.166-14.813 4.313-5.537-.854-11.225-3.85-15.47-8.095L12.344 40.5C8.1 36.255 5.104 30.567 4.25 25.03c-.853-5.535.336-10.803 4.344-14.81l.03-.032c1.58-1.64 3.822-3.223 5.75-4.188.966-.482 1.873-.81 2.47-.937.183-.04.243-.034.343-.032z" fill-rule="nonzero" fill="currentColor"></path>
        </svg>
        <h3>We're here to help.</br>
        <a class="underline-from-left primary" href="tel:877-449-4700">877 449 4700</a></h3>
      </div><!--/.col-->
    </div><!--/.row-->
  </div><!--/.container-->
</section>

<section class="section-wrap no-pad-t section-page-contact-offices page-contact bg-white">
  <div class="container">
    <div class="row entry-content">
      <div class="col-xs-12">
        <h3>Practicing nationwide - <br />
          We make it convenient for you.</h3>
          <hr class="hr dark" />
      </div><!--/.col-->
    </div><!--/.row-->

    <?php if( have_rows('site_office_locations', 'option') ): ?>
      <h3 class="section-title">Offices</h3>
        <?php
        $i = 0;
        while( have_rows('site_office_locations', 'option') ): the_row();
        if ($i % 3 == 0) { //open row div at every 3rd ?>
        <div class="row offices">
        <?php } ?>
        <div class="col-xs-12 col-sm-4 office-item">
          <p><strong><?php the_sub_field('site_office_city', 'option'); ?></strong></p>
          <p><?php the_sub_field('site_office_address', 'option'); ?></p>
          -
      
          <p>Fax: <a href="<?php the_sub_field('site_office_fax', 'option'); ?>"></a><?php the_sub_field('site_office_fax', 'option'); ?></p>
        </div><!--/.col-->
        <?php $i++;
        if($i != 0 && $i % 3 == 0) { //add </div> after every 3rd != 0 ?>
        </div><!--/.row-->
        <div class="clearfix"></div>
        <?php } ?>
        <?php endwhile; ?>
      </div><!--/.row-->
    <?php endif; ?>

  </div><!--/.container-->
</section>

</div><!--/.page-contact-->

<?php
get_footer();
?>
