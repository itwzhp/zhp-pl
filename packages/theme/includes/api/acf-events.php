<?php

add_action('rest_api_init', 'register_rest_events');
function register_rest_events()
{
    register_rest_route('wp/v2', '/acf-events', array(
        'methods' => 'GET',
        'callback' => 'zhp_route_get_acf_events',
        'permission_callback'=>'__return_true'
    ));
}
function zhp_route_get_acf_events(WP_REST_Request $request)
{
    // request params
    list(
        'per_page' => $per_page,
        'page' => $page,
        'after' => $after,
        'before' => $before,
        'age_groups' => $age_groups,
        'event_types' => $even_types,
        'localizations' => $localizations,
        'without_outdated' => $without_outdated,
        'event_categories' => $event_categories,
    ) = $request;

    // meta_query -> date from ACF
    $meta_query = array(
        'relation' => 'AND',
        array(
            'key'=> 'date_begin',
            'value' => $after,
            'type' => 'DATE',
            'compare' => '>='
        ),
        array(
            'key'=> 'date_end',
            'value' => $before,
            'type' => 'DATE',
            'compare' => '<='
        )
    );

    // tax_query - can be more generic like now
    $has_tax_query = false;
    $tax_query = array(
        'relation' => 'AND'
    );
    if($age_groups) {
        array_push($tax_query, array(
            'taxonomy' => 'age_group',
            'field' => 'term_id',
            'terms' => explode(',', $age_groups)
        ));
        $has_tax_query = true;
    }
    if($even_types) {
        array_push($tax_query, array(
            'taxonomy' => 'event_type',
            'field' => 'term_id',
            'terms' => explode(',', $even_types)
        ));
        $has_tax_query = true;
    }
    if($localizations) {
        array_push($tax_query, array(
            'taxonomy' => 'localization',
            'field' => 'term_id',
            'terms' => explode(',', $localizations)
        ));
        $has_tax_query = true;
    }
    if($event_categories) {
        array_push($tax_query, array(
            'taxonomy' => 'event_category',
            'field' => 'term_id',
            'terms' => explode(',', $event_categories)
        ));
        $has_tax_query = true;
    }

    // common WP_QUERY args
    $args = array(
        'post_type' => 'event',
        'posts_per_page' => $per_page,
        'paged' => $page ? $page : 1,
        'meta_key' => 'date_begin',
        'orderby' => 'meta_value',
        'order' => 'DESC',
    );

    if($without_outdated) {
        $args['meta_query'] = array(
            array(
                'key' => 'date_end',
                'value' => date('Y-m-d'),
                'compare' => '>=',
                'type' => 'DATE'
            )
        );
    }

    if($after && $before) {
        $args['meta_query'] = $meta_query;
    }

    if($has_tax_query) {
        $args['tax_query'] = $tax_query;
    }

    $query = new WP_Query($args);
    $posts = $query -> get_posts();
    // helpers
    $map_to_posts = function ($object) {
        $get_terms_acf = function ($object) {
            $acf_fields = get_fields($object -> taxonomy . '_' . $object -> term_id);
            return array_merge((array) $object, (array) $acf_fields);
        };
        $map_to_age_groups = function ($object) {
            return $object -> term_id;
        };

        $age_groups = wp_get_post_terms($object -> ID, ['age_group']);
        $terms = wp_get_post_terms($object -> ID, ['event_type', 'localization']);

        $terms_with_acf = array();
        foreach ($terms as $term) {
            $terms_with_acf['rest_' . $term -> taxonomy] = $get_terms_acf($term);
        }

        $common = (object) array(
            'title' => (object) array(
                'rendered' => $object -> post_title
            ),
            'excerpt' => (object) array(
                'rendered' => $object -> post_excerpt
            ),
            'slug' => $object -> post_name,
            'rest_acf' => get_fields($object -> ID),
            'rest_media' => get_the_post_thumbnail_url($object -> ID, 'large'),
            'age_groups' => array_map($map_to_age_groups, $age_groups),
        );

        return (object) array_merge((array) $common, (array) $terms_with_acf);
    };
    $data = array_map($map_to_posts, $posts);
    $total_pages = $query -> max_num_pages;

    $response = new WP_REST_Response($data);
    $response -> header('X-WP-TotalPages', $total_pages);
    $response -> header('X-WP-Args', json_encode($args));

    wp_reset_query();

    return $response;
}