<?php

// Register Meta Box
    function add_job_requirements_meta_box() {
        add_meta_box(
            'job_requirements',
            'Job Requirements',
            'job_requirements_meta_box_callback',
            ["job_listings"],
            'normal',
            'default'
        );
    }
    add_action('add_meta_boxes', 'add_job_requirements_meta_box');


    // Meta Box Callback
    function job_requirements_meta_box_callback($post) {
        wp_nonce_field('job_requirements_meta_box', 'job_requirements_meta_box_nonce');
        $values = get_post_meta($post->ID);
        ?>
        <div class="meta-box-container">
            
            <div class="meta-box-field">
                <label for="position">Position</label>
                <input
                    type="text"
                    id="position"
                    name="position"
                    value="<?php echo esc_attr(isset($values['position'][0]) ? $values['position'][0] : ''); ?>"
                />
            </div>
            
            <div class="meta-box-field">
                <label for="company_name">Company Name</label>
                <input
                    type="text"
                    id="company_name"
                    name="company_name"
                    value="<?php echo esc_attr(isset($values['company_name'][0]) ? $values['company_name'][0] : ''); ?>"
                />
            </div>
            <div class="meta-box-field">
                <label for="location">Location</label>
                <input
                    type="text"
                    id="location"
                    name="location"
                    value="<?php echo esc_attr(isset($values['location'][0]) ? $values['location'][0] : ''); ?>"
                />
            </div>
            <div class="meta-box-field">
                <label for="experience">Experience</label>
                <input
                    type="text"
                    id="experience"
                    name="experience"
                    value="<?php echo esc_attr(isset($values['experience'][0]) ? $values['experience'][0] : ''); ?>"
                />
            </div>
            
            <div class="meta-box-field">
                <input type="checkbox" id="remote" name="remote" value="1" 
                    <?php checked( isset($values['remote'][0]) ? $values['remote'][0] : '', '1' ); ?>>
                <label for="remote">Remote</label><br>

                <input type="checkbox" id="fulltime" name="fulltime" value="1"
                    <?php checked( isset($values['fulltime'][0]) ? $values['fulltime'][0] : '', '1' ); ?>>
                <label for="fulltime">Full Time</label><br>

                <input type="checkbox" id="part_time" name="part_time" value="1"
                    <?php checked( isset($values['part_time'][0]) ? $values['part_time'][0] : '', '1' ); ?>>
                <label for="part_time">Part Time</label><br>

                <input type="checkbox" id="onsite" name="onsite" value="1"
                    <?php checked( isset($values['onsite'][0]) ? $values['onsite'][0] : '', '1' ); ?>>
                <label for="onsite">Onsite</label><br>
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

        
        if (isset($_POST['position'])) {
            update_post_meta($post_id, 'position', sanitize_text_field($_POST['position']));
        }
        
        if (isset($_POST['experience'])) {
            update_post_meta($post_id, 'experience', sanitize_text_field($_POST['experience']));
        }

        if (isset($_POST['company_name'])) {
            update_post_meta($post_id, 'company_name', sanitize_text_field($_POST['company_name']));
        }
        
        if (isset($_POST['location'])) {
            update_post_meta($post_id, 'location', sanitize_text_field($_POST['location']));
        }
        
        // Remote
        if ( isset($_POST['remote']) ) {
            update_post_meta($post_id, 'remote', '1');
        } else {
            update_post_meta($post_id, 'remote', '0'); // save unchecked as "0"
        }

        // Full Time
        if ( isset($_POST['fulltime']) ) {
            update_post_meta($post_id, 'fulltime', '1');
        } else {
            update_post_meta($post_id, 'fulltime', '0');
        }

        // Part Time
        if ( isset($_POST['part_time']) ) {
            update_post_meta($post_id, 'part_time', '1');
        } else {
            update_post_meta($post_id, 'part_time', '0');
        }

        // Onsite
        if ( isset($_POST['onsite']) ) {
            update_post_meta($post_id, 'onsite', '1');
        } else {
            update_post_meta($post_id, 'onsite', '0');
        }

    }

    
    add_action('save_post', 'save_job_requirements_meta_box_data');