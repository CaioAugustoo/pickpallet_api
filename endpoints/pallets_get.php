<?php

  // Return some infos about each pallet 
  function pallet_data($post) {
    $post_meta = get_post_meta($post->ID);
    $pallet1 = get_post_meta($post->pallet1);
    
    return [
      'id' => $post->ID,
      'created_at' => $post->post_date,
      'pallet1' => $post_meta['pallet1'][0],
      'pallet2' => $post_meta['pallet3'][0],
      'pallet3' => $post_meta['pallet3'][0],
      'pallet4' => $post_meta['pallet4'][0],
    ];
  };


  // Get pallet by id
  function api_pallet_get($request) {
    $post_id = $request['id'];
    $post = get_post($post_id);

    if(!isset($post) || empty($post_id)) {
      $response = new WP_Error('erro', 'Paleta não encontrada', ['status' => 404]);
      return rest_ensure_response($response);
    }

    $pallet = pallet_data($post);

    return rest_ensure_response($pallet);
  }

  function register_api_pallet_get() {
    register_rest_route('api', '/pallets/(?P<id>[0-9]+)', [
      'methods' => WP_REST_SERVER::READABLE,
      'callback' => 'api_pallet_get',
    ]);
  };
  add_action('rest_api_init', 'register_api_pallet_get');


  // Get all pallets
  function api_pallets_get($request) {
    $_total = sanitize_text_field($request['_total']) ?: 18;
    $_page = sanitize_text_field($request['_page']) ?: 1;

    $args = [
      'post_type' => 'post',
      'post_status' => 'publish',
      'posts_per_page' => $_total,
      'paged' => $_page,
    ];

    $query = new WP_Query($args);
    $posts = $query->posts;

    $pallets = [];
    if($posts) {
      foreach ($posts as $post) {
        $pallets[] = pallet_data($post);
      };
    };

    return rest_ensure_response($pallets);
  }

  function register_api_pallets_get() {
    register_rest_route('api', '/pallets', [
      'methods' => WP_REST_SERVER::READABLE,
      'callback' => 'api_pallets_get',
    ]);
  };
  add_action('rest_api_init', 'register_api_pallets_get');
?>