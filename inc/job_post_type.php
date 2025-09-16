<?php


// Register Custom Post Type
    function register_job_listings_post_type() {
        $labels = array(
            'name'                  => _x('Job Listing', 'Post Type General Name', 'wp-job-portal'),
            'singular_name'         => _x('Job Listing', 'Post Type Singular Name', 'wp-job-portal'),
            'menu_name'            => __('Job Listing', 'wp-job-portal'),
            'all_items'            => __('All Job Listing', 'wp-job-portal'),
            'add_new_item'         => __('Add New Job Listing', 'wp-job-portal'),
            'add_new'              => __('Add New', 'wp-job-portal'),
            'edit_item'            => __('Edit Job Listing', 'wp-job-portal'),
            'update_item'          => __('Update Job Listing', 'wp-job-portal'),
            'search_items'         => __('Search Job Listing', 'wp-job-portal'),
        );

        $args = array(
            'label'                 => __('Job Listing', 'wp-job-portal'),
            'labels'                => $labels,
            'supports'              => ["title","editor","thumbnail","author","revisions","page-attributes","excerpt","comments","custom-fields"],
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_icon'             => 'dashicons-admin-post',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
        );

        register_post_type('job_listings', $args);
    }

    add_action('init','register_job_listings_post_type', 0);