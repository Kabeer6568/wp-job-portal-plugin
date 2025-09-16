<?php

class Job_portal{

    public function __construct(){

        $this->load_dependencies();
        add_action( 'wp_enqueue_scripts', [$this , 'job_portal_public_scripts']);

    }

    private function load_dependencies(){

        // Job Post Type
        require_once JOB_PORTAL_DIR_PATH . 'inc/job_post_type.php';
        // Taxonomies
        require_once JOB_PORTAL_DIR_PATH . 'inc/taxonomy.php';
        // Meta Boxes
        require_once JOB_PORTAL_DIR_PATH . 'inc/metaboxes.php';
        // Shortcodes
        require_once JOB_PORTAL_DIR_PATH . 'inc/shortcode.php';

    }

    public function job_portal_public_scripts(){
        wp_enqueue_style( 'job-portal-public-css', JOB_PORTAL_DIR_URL . 'public/assets/css/style.css', true);
    }

    


    
    





}

new Job_Portal();