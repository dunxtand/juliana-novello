<?php

function process_image($image_url, $width, $height) {

  $exploded_url = explode("f_auto,q_auto",$image_url);

  if ( isset($exploded_url[1]) ) {
      $resize_url = $exploded_url[0]."w_".$width.",h_".$height.",c_fill".$exploded_url[1];
  }
  else {
      $resize_url = $image_url;
  }

  return $resize_url;
}