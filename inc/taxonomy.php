<?php

// Register Skills Taxonomy/Category
    function register_skills_taxonomy() {
        $labels = array(
            'name'                       => _x('Skills', 'Taxonomy General Name', 'wp-job-portal'),
            'singular_name'              => _x('Skill', 'Taxonomy Singular Name', 'wp-job-portal'),
            'menu_name'                  => __('Skills', 'wp-job-portal'),
            'all_items'                  => __('All Skills', 'wp-job-portal'),
            'parent_item'                => __('Parent Skill', 'wp-job-portal'),
            'parent_item_colon'          => __('Parent Skill:', 'wp-job-portal'),
            'new_item_name'              => __('New Skill Name', 'wp-job-portal'),
            'add_new_item'               => __('Add New Skill', 'wp-job-portal'),
            'edit_item'                  => __('Edit Skill', 'wp-job-portal'),
            'update_item'                => __('Update Skill', 'wp-job-portal'),
            'view_item'                  => __('View Skill', 'wp-job-portal'),
            'search_items'               => __('Search Skills', 'wp-job-portal'),
        );

        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'publicly_queryable'         => true,
            'show_ui'                    => true,
            'show_in_menu'               => true,
            'show_in_nav_menus'          => true,
            'show_in_rest'               => true,
            'rest_base'                  => 'skills',
            'show_tagcloud'              => true,
            'show_in_quick_edit'         => true,
            'show_admin_column'          => true,
        );

        register_taxonomy('skills', ["job_listings"], $args);
    }

    add_action('init','register_skills_taxonomy', 0);
        

    
// Register Tags Taxonomy
    function register_tags_taxonomy() {
        $labels = array(
            'name'                       => _x('Tags', 'Taxonomy General Name', 'wp-job-portal'),
            'singular_name'              => _x('Tag', 'Taxonomy Singular Name', 'wp-job-portal'),
            'menu_name'                  => __('Tags', 'wp-job-portal'),
            'all_items'                  => __('All tags', 'wp-job-portal'),
            'parent_item'                => __('Parent Tag', 'wp-job-portal'),
            'parent_item_colon'          => __('Parent Tag:', 'wp-job-portal'),
            'new_item_name'              => __('New Tag Name', 'wp-job-portal'),
            'add_new_item'               => __('Add New Tag', 'wp-job-portal'),
            'edit_item'                  => __('Edit Tag', 'wp-job-portal'),
            'update_item'                => __('Update Tag', 'wp-job-portal'),
            'view_item'                  => __('View Tag', 'wp-job-portal'),
            'search_items'               => __('Search tags', 'wp-job-portal'),
        );

        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => false,
            'public'                     => true,
            'publicly_queryable'         => true,
            'show_ui'                    => true,
            'show_in_menu'               => true,
            'show_in_nav_menus'          => true,
            'show_in_rest'               => true,
            'rest_base'                  => 'tags',
            'show_tagcloud'              => true,
            'show_in_quick_edit'         => true,
            'show_admin_column'          => true,
        );

        register_taxonomy('tags', ["job_listings"], $args);
    }

    add_action('init', 'register_tags_taxonomy', 0);