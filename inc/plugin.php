<?php

class Job_portal{

    public function __construct(){

        $this->load_dependencies();
        add_action( 'wp_enqueue_scripts', [$this , 'job_portal_public_scripts']);
        add_action( 'template_redirect', [$this , 'job_portal_clean_empty_query_vars'] );

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


    function job_portal_clean_empty_query_vars() {
    // Only act on GET requests
    if ( ! empty( $_GET ) ) {
        // If skills exists but is empty string, remove it and redirect to cleaned URL
        if ( array_key_exists( 'skills', $_GET ) && trim( (string) $_GET['skills'] ) === '' ) {
            $clean = $_GET;
            unset( $clean['skills'] );

            // Optional: If you want the search to go to site root instead of current page,
            // use home_url('/'), otherwise use add_query_arg on current URL.
            $redirect_to = add_query_arg( $clean, home_url( '/' ) );

            wp_safe_redirect( esc_url_raw( $redirect_to ) );
            exit;
        }
    }
}

    


    
    





}

new Job_Portal();