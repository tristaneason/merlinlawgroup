<?php
/**
Template Name: Attorney Directory
 */
get_header();
get_template_part( 'template-parts/section', 'hero' );

$args = array(
  'post_type' => 'attorneys',
  'posts_per_page' => -1,
  'order' => 'ASC',
  'orderby' => 'title'
);
$query = new WP_Query($args);
?>
<section class="section-wrap page-attorney">
  <div class="container">
    <div clas="accordion-content">
      <ul class="accordion attorney-filter">
        <li>
          <div class="push-up">
          <!-- Removed until specialties are added ...
          <h6><a class="title">Filter by State and Specialty</a></h6>-->
          <h6><a class="title">Filter by State</a></h6>
          <div class="row attorney-filter-cats">
            <div class="col-xs-12 pad-bottom">
              <h5 class="section-title">State</h5>
                <div class="filter-wrap state flex-wrap one-fourth">
                <?php // display custom tax name == 'attorney state'
                  if ( $query->have_posts() ) : $query->the_post();
                  $terms = get_terms('attorney-state', array('hide_empty' => false, 'orderby' => 'title', 'order' => 'ASC') ); ?>
                  <?php foreach($terms as $term) { ?>
                   <span>
                     <input name="<?php echo $term->name; ?>" type="checkbox" class="ios8-switch ios8-switch" id="<?php echo $term->name; ?>"/>
                     <label class="filter-label" for="<?php echo $term->name; ?>"><?php echo $term->name; ?></label>
                   </span>
                  <?php }
                endif;
                  ?>
                </div><!--/.flex-wrap-->
            </div><!--/.col-->

            <a id="attorney-filter-search" class="btn secondary pull-right block-mobile">Apply</a>
          </div><!--/.row-->
        </li>
      </div>
      </ul>
    </div><!--/.accordion-content-->
  </div><!--/.row-->
</div><!--/.container-->
</section>


<section class="section-wrap attorneys-results-wrap">
  <div class="container">
    <div id="loading">
      <div class="bar"></div>
      <div class="spinner-icon"></div>
      <h5 class="spinner-text">Searching Attorneys...</h5>
    </div><!--/.loading-->
    <div class="row" id="results">
      <?php load_all_attorneys(); ?>
    </div><!--/.row-->
  </div><!--/.container-->
</section>


<?php
get_footer();
?>
