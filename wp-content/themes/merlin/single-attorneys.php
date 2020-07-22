<?php
// Single-attorneys
get_header();
get_template_part( 'template-parts/section', 'hero' );

$attorney_contact = get_field('attorney_contact_info');
$attorney_licensed_in = get_field('attorney_licensed_in');
$attorney_bar_admissions = get_field('attorney_bar_admissions');
$attorney_highlights = get_field('attorney_highlights');
$attorney_education = get_field('attorney_education');
$attorney_accordion_published = get_field('attorney_accordion_published');
$attorney_accordion_classes = get_field('attorney_accordion_classes');
$attorney_accordion_honors = get_field('attorney_accordion_honors');
$attorney_accordion_memberships = get_field('attorney_accordion_memberships');

if ( have_posts() ) : while ( have_posts() ) : the_post();
?>

<section class="section-breadcrumbs bg-gray">
  <div class="container">
    <?php get_template_part( 'template-parts/section', 'breadcrumbs' ); ?>
  </div>
</section>

<section class="section-entry section-wrap page-interior single-attorney-wrap">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-7 single-content">
        <h2 class="section-title"><?php the_title(); ?></h2>
        <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="attorney-img visible-sm" alt="<?php the_title(); ?>">
        <div class="entry-content">
          <?php the_content(); ?>
          <hr />
          <?php echo $attorney_education; ?>
        </div><!--/.entry-content-->
        <div clas="accordion-content">
          <ul class="accordion">
            <?php if ($attorney_accordion_published) : ?>
          	<li>
          		<h6><a class="title">Published Works</a></h6>
          		<div class="accordion-answer"><?php echo $attorney_accordion_published; ?></div>
          	</li>
            <?php endif; ?>
            <?php if ($attorney_accordion_classes) : ?>
          	<li>
          		<h6><a class="title">Classes/Seminars Taught</a></h6>
          		<div class="accordion-answer"><?php echo $attorney_accordion_classes; ?></div>
          	</li>
            <?php endif; ?>
            <?php if ($attorney_accordion_honors) : ?>
          	<li>
          		<h6><a class="title">Honors &amp; Awards</a></h6>
          		<div class="accordion-answer"><?php echo $attorney_accordion_honors; ?></p></div>
          	</li>
            <?php endif; ?>
            <li>
              <?php if ($attorney_accordion_memberships) : ?>
          		<h6><a class="title">Professional Associations &amp; Memberships</a></h6>
          		<div class="accordion-answer"><?php echo $attorney_accordion_memberships; ?></div>
          	</li>
            <?php endif; ?>
          </ul><!--/accordion-->
        </div><!--/.accordion-content-->
      </div><!--/.col-->
      <div class="col-xs-12 col-sm-offset-1 col-sm-4 single-sidebar">
        <div class="sidebar-content">
          <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="attorney-img hidden-sm" alt="<?php the_title(); ?>">
          <?php if ($attorney_contact) : ?>
          <h6 class="sidebar-title">Contact</h6>
          <div class="attorney-contact-info">
          <?php echo $attorney_contact; ?>
          </div>
          <?php endif; ?>

          <?php if ($attorney_licensed_in) : ?>
          <h6 class="sidebar-title">Licensed In</h6>
          <?php echo $attorney_licensed_in; ?>
          <?php endif; ?>

          <?php if ($attorney_bar_admissions) : ?>
          <h6 class="sidebar-title">Bar Admissions</h6>
          <?php echo $attorney_bar_admissions; ?>
          <?php endif; ?>

          <?php if ($attorney_highlights) : ?>
          <h6 class="sidebar-title">Highlights</h6>
          <?php echo $attorney_highlights; ?>
          <?php endif; ?>
        </div><!--/.sidebar-content-->
      </div><!--/.col-->
    </div><!--/.row-->
  </div><!--/.container-->
</section><!--/.singe-attorney-wrap-->

<?php endwhile; endif; ?>

<?php
get_footer();
?>
