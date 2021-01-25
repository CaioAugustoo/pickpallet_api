<?php

$dirbase = get_template_directory();
require_once $dirbase . '/endpoints/pallet_post.php';
require_once $dirbase . '/endpoints/pallets_get.php';

function change_api($slug) {
  return 'json';
}
add_filter('rest_url_prefix', 'change_api');
?>