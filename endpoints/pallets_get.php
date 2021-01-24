<?php
  function api_pallets_get($request) {
    $_total = sanitize_text_field($request['_total']) ?: 18;
    $_page = sanitize_text_field($request['_page']) ?: 1;

    $args = [
      'post_type' => 'post',
      'posts_per_page' => $_total,
      'paged' => $_page,
    ];

    $query = new WP_Query($args);
    $posts = $query->posts;

    $response = [
      'total' => $_total,
      'page' => $_page,
    ];

    return rest_ensure_response($posts);
  }

  function register_api_pallets_get() {
    register_rest_route('api/v2', '/pallets', [
      'methods' => WP_REST_SERVER::READABLE,
      'callback' => 'api_pallets_get',
    ]);
  };
  add_action('rest_api_init', 'register_api_pallets_get');
?>