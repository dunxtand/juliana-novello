<?php

add_filter( 'timber_context', 'global_timber_context' );

function global_timber_context( $context ) {

  $context['officelocations'] = get_field('office_locations', 'option');
  $context['socialnetworks'] = get_field('social_networks', 'option');
  $context['contactemail'] = get_field('contact_email', 'option');
  $context['contactphone'] = get_field('contact_phone', 'option');
  $context['friends'] = get_field('friends', 'option');

  $context['flexblock'] = get_field('content_blocks');

  return $context;
}

