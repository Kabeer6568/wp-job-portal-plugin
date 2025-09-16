<?php

class Job_portal{

    public function __construct(){

        $this->load_dependencies();

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


    
    





}

new Job_Portal();