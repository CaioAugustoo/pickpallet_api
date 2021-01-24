<?php
  function api_pallet_post($request) {
  
    //  if(!preg_match('/^#[a-f0-9]{6}$/i'), $pallet1) {
    //   $response = new WP_Error('error', 'numero hexadecimal inválido', ['status' => 401]);
    //    return rest_ensure_response($response);
    // };

    $pallet1 = sanitize_text_field($request['pallet1']);
    $pallet2 = sanitize_text_field($request['pallet2']);
    $pallet3 = sanitize_text_field($request['pallet3']);
    $pallet4 = sanitize_text_field($request['pallet4']);

    if(empty($pallet1) || empty($pallet2) || empty($pallet3) || empty($pallet4)) {
      $response = new WP_Error('erro', 'Verifique se não deixou algum campo vazio ou não inseriu um hexadecimal incorreto.', ['status' => 422]);
      return rest_ensure_response($response);
    }

    $response = [
      'post_title' => 'pallet' . ' ' . rand(),
      'post_status' => 'publish',
      'meta_input' => [
        'pallet1' => $pallet1,
        'pallet2' => $pallet2,
        'pallet3' => $pallet4,
        'pallet4' => $pallet4,
      ],
    ];

    wp_insert_post($response);
    return rest_ensure_response($response);
  }

  function register_api_pallet_post() {
    register_rest_route('api/v2', '/pallets', [
      'methods' => WP_REST_SERVER::CREATABLE,
      'callback' => 'api_pallet_post',
    ]);
  };
  add_action('rest_api_init', 'register_api_pallet_post')
?>