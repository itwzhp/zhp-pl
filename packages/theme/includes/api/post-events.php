<?php
function zhppl_post_events(WP_REST_Request $request)
{
    // $headers['origin'][0] === 'http://localhost:3000'
    $file = $request->get_file_params();
    list(
        'title'=> $post_title,
        'excerpt' => $post_excerpt,
        'description' => $post_description,
        'conditions' => $post_conditions,
        'place' => $post_place,
        'unit' => $organizer_unit,
        'person' => $organizer_person,
        'phone' => $organizer_phone,
        'mail' => $organizer_mail,
        'web' => $web,
        'begin' => $date_begin,
        'end' => $date_end,
        'plikilinki' => $plikilinki,
        'age_groups' => $tax_age_groups,
        'localization' => $tax_localization,
        'event_type' => $tax_event_type,
        'to_confirm' => $to_confirm,
        'id' => $id,
        'token' => $key
        ) = $request;

    if($id && $key) {
        $status = get_post_status($id);
        $token = get_post_meta($id, 'token', true);
        if($status == 'temporary' && $key == $token) {
            wp_update_post(array(
                'ID' => $id,
                'post_status' => 'pending'
            ));
            delete_post_meta($id, 'token');

            return array(
                'status' => 'success',
                'message' => 'Zgłoszenie zaakceptowane. Wydarzenie oczekuje na akceptacje ze strony administracji.'
            );
        }
        return array(
            'status' => 'error',
            'message' => 'Prawdopodobnie ten link został już wykorzystany a twoje zgłoszenie oczekuje na akceptację.'
        );
    }

    $pattern = '/@(.*+)$/i';
    $domains_string = get_theme_mod('domains', '');
    if(strlen($domains_string)) {
        $domains = explode(',', str_replace(' ', '', $domains_string));
        preg_match($pattern, $to_confirm, $matches);
        $domain = $matches[1];
        $confirmed = in_array($domain, $domains);
        if(!$confirmed) {
            return array(
                'status' => 'error',
                'message' => 'Domena '.$domain.' nie jest dozwolona.'
            );
        }
    }

    $post_content = ''
        .'<!-- wp:heading -->'
        .'<h2>Opis wydarzenia</h2>'
        .'<!-- /wp:heading -->'
        .'<!-- wp:paragraph -->'
        .'<p>'.wp_kses($post_description, wp_kses_allowed_html()).'</p>'
        .'<!-- /wp:paragraph -->'
        .'<!-- wp:heading -->'
        .'<h2>Warunki uczestnictwa</h2>'
        .'<!-- /wp:heading -->'
        .'<!-- wp:paragraph -->'
        .'<p>'.wp_kses($post_conditions, wp_kses_allowed_html()).'</p>'
        .'<!-- /wp:paragraph -->'
        .'<!-- wp:heading -->'
        .'<h2>Miejsce wydarzenia</h2>'
        .'<!-- /wp:heading -->'
        .'<!-- wp:paragraph -->'
        .'<p>'.wp_kses($post_place, wp_kses_allowed_html()).'</p>'
        .'<!-- /wp:paragraph -->';

    $post = array(
        'post_title' => wp_kses($post_title, wp_kses_allowed_html('title')),
        'post_content' => $post_content,
        'post_excerpt' => wp_kses($post_excerpt, wp_kses_allowed_html()),
        'post_status' => 'temporary',
        'post_type' => 'event',
    );
    $post_id = wp_insert_post($post);

    // set token
    $date = new DateTime();
    $token = md5($date->getTimestamp().$to_confirm);
    add_post_meta($post_id, 'token', $token);
    // set ACF fields
    update_field('organizer', array(
        'unit'=>sanitize_text_field($organizer_unit),
        'person'=>sanitize_text_field($organizer_person),
        'phone'=> sanitize_text_field($organizer_phone),
        'mail'=>sanitize_text_field($organizer_mail)
    ), $post_id);
    update_field('web', sanitize_text_field($web), $post_id);
    update_field('date', array(
        'begin'=>sanitize_text_field($date_begin),
        'end'=>sanitize_text_field($date_end)
    ), $post_id);
    update_field('plikilinki', $plikilinki, $post_id);
    // set taxonomies
    wp_set_post_terms($post_id, $tax_age_groups, 'age_group');
    wp_set_post_terms($post_id, $tax_localization, 'localization');
    wp_set_post_terms($post_id, $tax_event_type, 'event_type');

    // * set thumbnail
    // set_post_thumbnail($id, );
    $uploadedfile = $file['file'];
    $upload_overrides = array(
        'test_form' => false,
    );
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    $file_return = wp_handle_upload($uploadedfile, $upload_overrides);
    $filename = $file_return['file'];
    $attachment = array(
        'post_mime_type' => $file_return['type'],
        'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
        'post_content' => '',
        'post_status' => 'inherit',
        'guid' => $file_return['url']
    );
    $attachment_id = wp_insert_attachment($attachment, $file_return['url']);
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attachment_data = wp_generate_attachment_metadata($attachment_id, $filename);
    wp_update_attachment_metadata($attachment_id, $attachment_data);
    set_post_thumbnail($post_id, $attachment_id);

    // send e-mail
    $to = $to_confirm;
    $subject = get_theme_mod('subject', '');
    $url = site_url();
    $message = str_replace('{{ token }}', '<a href="'.$url.'/wydarzenia?id='.$post_id.'&token='.$token.'">'.$url.'/wydarzenia?id='.$post_id.'&token='.$token.'</a>', get_theme_mod('message', ''));
    $headers = array('Content-Type: text/html; charset=UTF-8');

    wp_mail($to, $subject, $message, $headers);

    return array(
        'status' => 'success',
        'message' => 'Sprawdź swojego maila i kliknij w link aby potwierdzić swoje wydarzenie.'
    );
}

function zhppl_register_rest_post_events()
{
    register_rest_route('wp/v2', '/post-events', array(
        'methods' => 'POST',
        'callback' => 'zhppl_post_events',
        'permission_callback'=>'__return_true'
    ));
}

// none logged users can add new event
add_action('rest_api_init', 'zhppl_register_rest_post_events');
