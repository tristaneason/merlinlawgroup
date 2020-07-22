<?php
/**
Template Name: PPC
 */

get_header();

//get_template_part( 'template-parts/section', 'hero' );
?>

<div class="page-ppc">

  <section class="section-wrap-lg bg-primary text-white">
    <div class="container">
      <div class="row entry-content">
        <div class="col-md-6 page-title-7 title-area">
          <div class="title-container">
  					<div class="title">
              <h1><?php the_field('ppc_h1'); ?></h1>
              <p><?php the_field('ppc_intro'); ?></p>
            </div><!-- .title end -->
  				</div><!-- .title-container end -->
        </div><!--/.col-->
        <div class="col-md-6">
  				<div class="form-container">
  					<?php the_field('ppc_form_embed'); ?>
  				</div><!-- .form-container end -->
  			</div><!-- .col-md-6end -->
      </div><!--/.row-->
    </div><!--/.container-->
  </section>

  <section class="section-wrap bg-white text-body">
    <div class="container why">
      <div class="row title-row">
        <div class="col-xs-12">
          <div class="title-container">
  					<div class="title">
              <h2 class="section-title h1"><?php the_field('ppc_why_heading'); ?></h2>
            </div>
  				</div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-md-6 col-md-offset-3">
        <div class="content-container">
          <?php if( have_rows('ppc_bullets') ): ?>
            <div class="row bullets why">
              <?php while( have_rows('ppc_bullets') ): the_row(); ?>
                <div class="col-xs-1 bullet icon">
                  <svg class="svg" viewBox="0 0 283 283" xmlns="http://www.w3.org/2000/svg">
                    <g class="svg-check" fill-rule="nonzero" fill="currentColor">
                      <path d="M141.79.622C63.933.622.604 63.938.604 141.75c0 77.812 63.33 141.128 141.184 141.128 77.855 0 141.184-63.316 141.184-141.128C282.974 63.938 219.644.622 141.79.622zm0 266.58c-69.197 0-125.502-56.283-125.502-125.452 0-69.17 56.305-125.45 125.5-125.45 69.198 0 125.503 56.28 125.503 125.45S210.987 267.2 141.79 267.2z"/>
                      <path d="M126.107 169.872L92.43 136.21l-11.087 11.08 39.22 39.206c1.532 1.53 3.544 2.297 5.544 2.297 2.012 0 4.01-.766 5.543-2.297l78.44-78.41-11.087-11.082-72.896 72.868z"/>
                    </g>
                  </svg>
                </div><!-- .bullet.icon end -->
                <div class="col-xs-11 bullet text">
                  <h3><?php the_sub_field('ppc_bullet'); ?></h3>
                </div><!-- .bullet.text end -->
                <div class="clear"></div>
              <?php endwhile; ?>
              <?php else: ?>
            </div><!-- .bullets end -->
          <?php endif; ?>
        </div><!-- .title-container end -->
      </div><!-- .col-md-12 end -->
    </div><!-- .row end -->
  </section>


  <section class="section-wrap bg-gray">
    <div class="container vid">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="vid-container">
            <?php the_field('ppc_video_embed'); ?>
          </div><!-- .title-container end -->
        </div><!-- .col-md-12end -->
      </div><!-- .row end -->
    </div><!--/.container-->
  </section>

  <section class="section-wrap bg-primary">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="form-container">
            <?php the_field('ppc_form_embed'); ?>
          </div><!-- .form-container end -->
        </div><!-- .col-md-12end -->
      </div><!-- .row end -->
    </div><!--/.container-->
  </section>


</div><!-- .page-ppc end -->

<?php
get_footer();
?>
