<div class="testimonial">
  <div class="testimonial__author">
    <img class="testimonial__author--img" src="<?php the_post_thumbnail_url() ?>" alt="<?php echo get_field('name');?>">
    <div class="testimonial__author--text">
      <div><?php echo get_field('name')?></div>
      <div><?php echo get_field('occupation'). ', '.get_field('company') ; ?></div>
    </div>
  </div>
  
  <h4 class="testimonial__heading"><?php the_title(); ?></h4>
  <div class="testimonial__text"><?php the_content(); ?></div>
</div>
   