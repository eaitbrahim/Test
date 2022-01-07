<?php get_header(); ?>

<section class="intro">
<?php 
    $homepageIntro = new WP_Query(array(  
            'posts_per_page' => 1,
            'post_type' => 'intro',
          ));
      
          while($homepageIntro->have_posts()) {
            $homepageIntro->the_post();
            get_template_part('template-parts/content', 'intro');
          }      
  ?>
</section>

<div class="features features__edge-left"></div>
<section class="features features__content" id="ourservices">
<?php 
      $homepageFeatures = new WP_Query(array(  
            'posts_per_page' => 3,
            'post_type' => 'feature',
            'orderby' => 'published',
            'order' => 'ASC',
          ));
      
          while($homepageFeatures->have_posts()) {
            $homepageFeatures->the_post();
            get_template_part('template-parts/content', 'feature');
          }      
  ?>
</section>
<div class="features features__edge-right"></div>

<section class="services">
<?php 
      $homepageServices = new WP_Query(array(  
            'posts_per_page' => 3,
            'post_type' => 'service',
            'orderby' => 'published',
            'order' => 'ASC',
          ));

          if ( $homepageServices->found_posts > 0 ) : 
?>
<h2 class="heading-2" id="whatwedo">What we do</h2>

<?php
          endif;
          $i = 0;
          while($homepageServices->have_posts()) {
            $homepageServices->the_post();
            if ($i % 2 == 0){
            ?>
              <div class="service">
                <div class="service__text">
                  <h4 class="heading-4">
                    <?php the_title(); ?>
                  </h4>
                  <div>
                  <?php the_content(); ?>
                  </div>
                </div>
                
                <figure class="service__img">
                  <img src="<?php the_post_thumbnail_url() ?>" alt="<?php the_title(); ?>">
                </figure>
              </div>
            <?php
            } else {
            ?>
              <div class="service">
                <figure class="service__img">
                  <img src="<?php the_post_thumbnail_url() ?>" alt="<?php the_title(); ?>">
                </figure>

                <div class="service__text">
                  <h4 class="heading-4">
                    <?php the_title(); ?>
                  </h4>
                  <div>
                  <?php the_content(); ?>
                  </div>
                </div>
              </div>
            <?php
            }
            $i = $i + 1;
          }      
  ?>
</section>

<div class="values values__edge-left"></div>
<section class="values values__content" id="ourvalues">
<?php 
      $homepageValues = new WP_Query(array(  
            'posts_per_page' => 3,
            'post_type' => 'value',
            'orderby' => 'published',
            'order' => 'ASC',
          ));
      
          while($homepageValues->have_posts()) {
            $homepageValues->the_post();
            get_template_part('template-parts/content', 'value');
          }      
  ?>
</section>
<div class="values values__edge-right"></div>

<div class="testimonials testimonials__edge-left"></div>
<section class="testimonials testimonials__content" id="testimonials">
  <button id="prev" title="Previous"><i class="fas fa-arrow-left"></i></button>
  
  <div class="slides">
  <?php 
      $homepageTestimonials = new WP_Query(array(  
            'posts_per_page' => -1,
            'post_type' => 'testimonial',
            'orderby' => 'published',
            'order' => 'ASC',
          ));
        
          while($homepageTestimonials->have_posts()) {
            $homepageTestimonials->the_post();
            get_template_part('template-parts/content', 'testimonial');
          }      
  ?>
  </div>
  <button id="next" title="Next"><i class="fas fa-arrow-right"></i></button>
  <div class="stop-play">
  <button id="pause" class="actif" title="Pause"><i class="fas fa-pause"></i></button>
  <button id="play" class="inactif" title="Play"><i class="fas fa-play"></i></button>
  </div>
</section>
<div class="testimonials testimonials__edge-right"></div>

<div class="message message__edge-left"></div>
<section class="message message__content">
<?php 
    $homepageMessage = new WP_Query(array(  
            'posts_per_page' => 1,
            'post_type' => 'message',
            'orderby' => 'published',
            'order' => 'DESC',
          ));
      
          while($homepageMessage->have_posts()) {
            $homepageMessage->the_post();
            get_template_part('template-parts/content', 'message');
          }      
  ?>
</section>
<div class="message message__edge-right"></div>


<div id="subscribe" class="subscribe subscribe__edge-left"></div>
<section class="subscribe subscribe__content">
  <?php get_template_part('template-parts/content', 'subscribe'); ?>
</section>
<div class="subscribe subscribe__edge-right"></div>

<?php get_footer();?> 