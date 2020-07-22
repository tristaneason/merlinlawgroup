<?php
/**
Template Name: Our Firm
 */
get_header();
get_template_part( 'template-parts/section', 'hero' );

$firm_bio_left = get_field('firm_bio_left');
$firm_bio_right_img = get_field('firm_bio_right_img');
$firm_bio_bottom = get_field('firm_bio_bottom');

$firm_trusted_img = get_field('firm_trusted_img');
$firm_trusted_video = get_field('firm_trusted_video');

?>
<div class="page-firm">

<section class="section-breadcrumbs bg-gray">
  <div class="container">
    <?php get_template_part( 'template-parts/section', 'breadcrumbs' ); ?>
  </div>
</section>

<section class="section-wrap page-firm-intro">
  <div class="container">
    <div class="entry-content interior-basic-content border-bottom">
    <?php
      while ( have_posts() ) : the_post();
        the_content();
      endwhile;
    ?>
    </div><!--/.entry-content-->
  </div><!--/.container-->
</section>

<section class="section-wrap page-firm-bio">
  <div class="container">
    <div class="row entry-content">
      <div class="col-xs-12 col-sm-5">
        <img src="<?php echo $firm_bio_right_img; ?>" />
      </div><!--/.col-->
      <div class="col-xs-12 col-sm-7">
        <div class="vertical-center">
          <?php echo $firm_bio_left; ?>
        </div><!--/.v-center-->
      </div><!--/.col-->
      <div class="col-xs-12 pad-top">
        <?php echo $firm_bio_bottom; ?>
      </div><!--/.col-->
    </div><!--/.row-->
  </div><!--/.container-->
</section>

<section class="section-wrap page-firm-bio-text no-pad-t">
  <div class="container">
    <?php if( have_rows('firm_bio_textboxes') ): ?>

        <?php
        $i = 0;
        while( have_rows('firm_bio_textboxes') ): the_row();
        if ($i % 3 == 0) { //open row at every 3rd ?>
        <div class="row text-boxes">
        <?php } ?>
          <div class="col-xs-12 col-sm-4 text-box">
            <div class="text-boxes-gutter">
              <?php the_sub_field('firm_bio_textbox'); ?>
            </div>
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

<section class="section-wrap section-why-merlin bg-img-cover text-white" style="background-image:url('<?php echo $firm_trusted_img; ?>')">
  <div class="container">
    <div class="row text-center">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1">
        <h2 class="section-title">Why Merlin is a Trusted Name in Law</h2>

        <?php if( have_rows('firm_trusted_icon_boxes') ): ?>

            <?php
            $i = 0;
            while( have_rows('firm_trusted_icon_boxes') ): the_row();
            if ($i % 3 == 0) { //open row at every 3rd ?>
            <div class="row icon-boxes text-center">
            <?php } ?>
              <div class="col-xs-12 col-sm-4 icon-box">
                <div class="icon-box-gutter">
                  <img src="<?php the_sub_field('firm_trusted_icon_box_icon'); ?>"/>
                  <p><?php the_sub_field('firm_trusted_icon_box_text'); ?></p>
                </div>
              </div><!--/.col-->
            <?php $i++;
            if($i != 0 && $i % 3 == 0) { //add </div> after every 3rd != 0 ?>
            </div><!--/.row-->
            <div class="clearfix"></div>
            <?php } ?>
            <?php endwhile; ?>
          </div><!--/.row-->

        <?php endif; ?>

      </div><!--/.col-->
    </div><!--/.row-->
  </div><!--/.container-->
</section>

<section class="section-wrap section-empty bg-white">
  <div clas="container">
    <div class="row firm-video">
      <div class="col-xs-12 col-sm-6 col-sm-offset-3">
        <?php echo $firm_trusted_video; ?>
      </div>
    </div>
  </div>
</section>

</div><!--/.page-firm-->


<?php
//get_sidebar();
get_footer();
?>
