<?php

class Job_portal{

    public function __construct(){

        add_action('init', [$this ,'register_job_listings_post_type'], 0);
        add_action('init', [$this ,'register_skills_taxonomy'], 0);
        add_action('init', [$this , 'register_tags_taxonomy'], 0);
        
        add_action('add_meta_boxes', [$this , 'add_job_requirements_meta_box']);
        add_action('save_post', [$this , 'save_job_requirements_meta_box_data']);

    }

    
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

    
    // Register Meta Box
    function add_job_requirements_meta_box() {
        add_meta_box(
            'job_requirements',
            'Job Requirements',
            [$this, 'job_requirements_meta_box_callback'],
            ["job_listings"],
            'normal',
            'default'
        );
    }


    // Meta Box Callback
    function job_requirements_meta_box_callback($post) {
        wp_nonce_field('job_requirements_meta_box', 'job_requirements_meta_box_nonce');
        $values = get_post_meta($post->ID);
        ?>
        <div class="meta-box-container">
            
            <div class="meta-box-field">
                <label for="name">Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="<?php echo esc_attr(isset($values['name'][0]) ? $values['name'][0] : ''); ?>"
                />
            </div>
            
            <div class="meta-box-field">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="<?php echo esc_attr(isset($values['email'][0]) ? $values['email'][0] : ''); ?>"
                />
            </div>
            
            <div class="meta-box-field">
                <label for="contact">Contact.no</label>
                <input
                    type="number"
                    id="contact"
                    name="contact"
                    value="<?php echo esc_attr(isset($values['contact'][0]) ? $values['contact'][0] : ''); ?>"
                />
            </div>
        </div>
        <?php
    }

    // Save Meta Box Data
    function save_job_requirements_meta_box_data($post_id) {
        if (!isset($_POST['job_requirements_meta_box_nonce'])) {
            return;
        }
        if (!wp_verify_nonce($_POST['job_requirements_meta_box_nonce'], 'job_requirements_meta_box')) {
            return;
        }
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        
        if (isset($_POST['name'])) {
            update_post_meta($post_id, 'name', sanitize_text_field($_POST['name']));
        }
        
        if (isset($_POST['email'])) {
            update_post_meta($post_id, 'email', sanitize_text_field($_POST['email']));
        }
        
        if (isset($_POST['contact'])) {
            update_post_meta($post_id, 'contact', sanitize_text_field($_POST['contact']));
        }
    }





}

new Job_Portal();