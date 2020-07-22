<?php
/**
Template Name: Team
 */

get_header();

get_template_part( 'template-parts/section', 'hero' );
?>

<section class="section-breadcrumbs bg-gray">
  <div class="container">
    <?php get_template_part( 'template-parts/section', 'breadcrumbs' ); ?>
  </div>
</section>

<section class="section-no-wrap page-intro">
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

<section class="section-no-wrap section-team-mgt pad-btm border-bottom">
  <div class="container">
    <div class="row entry-content">
      <div class="col-xs-12">
        <h2><?php the_field('team_mgt_header'); ?></h2>
      </div>
        <?php if( have_rows('team_mgt') ): ?>
          <?php while( have_rows('team_mgt') ): the_row(); ?>
            <div class="col-xs-12">
              <h3><?php the_sub_field('team_mgt_name'); ?></h3>
            </div>
            <div class="col-xs-12 col-sm-4">
              <img src="<?php the_sub_field('team_mgt_img'); ?>" alt="<?php the_sub_field('team_mgt_name'); ?>" />
            </div><!--/.col-->
            <div class="col-xs-12 col-sm-8">
              <div class="pad-top-mobile">
                <?php the_sub_field('team_mgt_bio'); ?>
              </div>
            </div><!--/.col-->
          <?php endwhile; ?>
        <?php endif; ?>
      </div><!--/.col-->
    </div><!--/.row-->
  </div><!--/.container-->
</section>

<section class="section-no-wrap section-team-dept pad-btm border-bottom">
  <div class="container">
    <div class="row entry-content">
      <div class="col-xs-12">
        <h2><?php the_field('team_dept_header'); ?></h2>
      </div>
        <?php if( have_rows('team_dept') ): ?>
          <?php while( have_rows('team_dept') ): the_row(); ?>
            <div class="col-xs-12">
              <h3><?php the_sub_field('team_dept_name'); ?></h3>
            </div>
            <div class="col-xs-12 col-sm-4">
              <img src="<?php the_sub_field('team_dept_img'); ?>" alt="<?php the_sub_field('team_dept_name'); ?>" />
            </div><!--/.col-->
            <div class="col-xs-12 col-sm-8">
              <div class="pad-top-mobile">
                <?php the_sub_field('team_dept_bio'); ?>
              </div>
            </div><!--/.col-->
          <?php endwhile; ?>
        <?php endif; ?>
      </div><!--/.col-->
    </div><!--/.row-->
  </div><!--/.container-->
</section>

<section class="section-no-wrap section-team-spt pad-btm">
  <div class="container">
    <div class="row entry-content">
      <div class="col-xs-12">
        <h2><?php the_field('team_spt_header'); ?></h2>
      </div>
        <?php if( have_rows('team_spt') ): ?>
          <?php while( have_rows('team_spt') ): the_row(); ?>
            <div class="col-xs-12">
              <h3><?php the_sub_field('team_spt_name'); ?></h3>
            </div>
            <div class="col-xs-12 col-sm-4">
              <img src="<?php the_sub_field('team_spt_img'); ?>" alt="<?php the_sub_field('team_spt_name'); ?>" />
            </div><!--/.col-->
            <div class="col-xs-12 col-sm-8">
              <div class="pad-top-mobile">
                <?php the_sub_field('team_spt_bio'); ?>
              </div>
            </div><!--/.col-->
          <?php endwhile; ?>
        <?php endif; ?>
      </div><!--/.col-->
    </div><!--/.row-->
  </div><!--/.container-->
</section>


<?php
//get_sidebar();
get_footer();
?>
