<?php if( have_rows('accordion') ): ?>

    <div class="accordion-content">
      <ul class="accordion">

      <?php while( have_rows('accordion') ): the_row(); ?>

          <li>
            <h6><a class="title"><?php the_sub_field('accordion_item_title'); ?></a></h6>
            <div class="accordion-answer"><?php the_sub_field('accordion_item_text'); ?></div>
          </li>

      <?php endwhile; ?>

    </ul><!--/.accordion-->
  </div><!--/.accordion-content-->

<?php endif; ?>
