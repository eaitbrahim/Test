<?php

function bw_wp_bp_post_types() {
  // Banner Post Type
  register_post_type('banner', array(
    'show_in_rest' => true,
    'supports' => array('title', 'editor'),
    'public' => true,
    'labels' => array(
      'name' => 'Banners',
      'add_new_item' => 'Add New Banner',
      'edit_item' => 'Edit Banner',
      'all_items' => 'All Banners',
      'singular_name' => 'Banner'
    ),
    'menu_icon' => 'dashicons-welcome-write-blog'
  ));

  // Intro Post Type
  register_post_type('intro', array(
    'show_in_rest' => true,
    'supports' => array('title', 'editor', 'thumbnail'),
    'public' => true,
    'labels' => array(
      'name' => 'Intros',
      'add_new_item' => 'Add New Intro',
      'edit_item' => 'Edit Intro',
      'all_items' => 'All Intros',
      'singular_name' => 'Intro'
    ),
    'menu_icon' => 'dashicons-format-aside'
  ));
  
  // Feature Post Type
  register_post_type('feature', array(
    'show_in_rest' => true,
    'supports' => array('title', 'editor', 'thumbnail'),
    'public' => true,
    'labels' => array(
      'name' => 'Features',
      'add_new_item' => 'Add New Feature',
      'edit_item' => 'Edit Feature',
      'all_items' => 'All Features',
      'singular_name' => 'Feature'
    ),
    'menu_icon' => 'dashicons-admin-customizer'
  ));

  // Service Post Type
  register_post_type('service', array(
    'show_in_rest' => true,
    'supports' => array('title', 'editor', 'thumbnail'),
    'public' => true,
    'labels' => array(
      'name' => 'Services',
      'add_new_item' => 'Add New Service',
      'edit_item' => 'Edit Service',
      'all_items' => 'All Services',
      'singular_name' => 'Service'
    ),
    'menu_icon' => 'dashicons-awards'
  ));

  // Value Post Type
  register_post_type('value', array(
    'show_in_rest' => true,
    'supports' => array('title', 'editor', 'thumbnail'),
    'public' => true,
    'labels' => array(
      'name' => 'Values',
      'add_new_item' => 'Add New Value',
      'edit_item' => 'Edit Value',
      'all_items' => 'All Values',
      'singular_name' => 'Value'
    ),
    'menu_icon' => 'dashicons-welcome-learn-more'
  ));

  // Testimonial Post Type
  register_post_type('testimonial', array(
    'show_in_rest' => true,
    'supports' => array('title', 'editor', 'thumbnail'),
    'public' => true,
    'labels' => array(
      'name' => 'Testimonials',
      'add_new_item' => 'Add New Testimonial',
      'edit_item' => 'Edit Testimonial',
      'all_items' => 'All Testimonials',
      'singular_name' => 'Testimonial'
    ),
    'menu_icon' => 'dashicons-editor-quote'
  ));

  // Message Post Type
  register_post_type('message', array(
    'supports' => array('title', 'editor'),
    'public' => false,
    'show_ui' => true,
    'labels' => array(
      'name' => 'Messages',
      'add_new_item' => 'Add New Message',
      'edit_item' => 'Edit Message',
      'all_items' => 'All Messages',
      'singular_name' => 'Message'
    ),
    'menu_icon' => 'dashicons-heart'
  ));

  // Subscription Post Type
  register_post_type('subscription', array(
    'show_in_rest' => true,
    'supports' => array('title', 'editor'),
    'public' => false,
    'show_ui' => true,
    'labels' => array(
      'name' => 'Subscriptions',
      'add_new_item' => 'Add New Subscription',
      'edit_item' => 'Edit Subscription',
      'all_items' => 'All Subscriptions',
      'singular_name' => 'Subscription'
    ),
    'menu_icon' => 'dashicons-email-alt'
  ));

  // Subscription Post Type
  register_post_type('received-message', array(
    'show_in_rest' => true,
    'supports' => array('title', 'editor'),
    'public' => false,
    'show_ui' => true,
    'labels' => array(
      'name' => 'Received Messages',
      'add_new_item' => 'Add New Message',
      'edit_item' => 'Edit Message',
      'all_items' => 'All Messages',
      'singular_name' => 'Received Message'
    ),
    'menu_icon' => 'dashicons-edit-page'
  ));


}

add_action('init', 'bw_wp_bp_post_types');