<?php


// function wp_job_listing_shortcode($attr) {

//     global $post;
    
//     $attr = shortcode_atts(
//         array(
//             'count'=> 1,
//         ),
//         $attr,
//         'wp_job_listing'
//     );

//         $arg = array(
//             'post_type' => 'job_listings',
//             'post_per_page'=> $attr['count'],
//             'post_status' => 'publish',
//         );
        
//         $query = new WP_Query($arg);

//         if (!$query->have_posts()) {
//             return  "<p> NO job found</p>";
//         }

//         $output = "<div class='job-listings'>";

//         while ($query->have_posts()) {
//             $query->the_post();
//             $postID = get_the_ID(); 
            
//             $title = get_the_title();

//             $desc = has_excerpt() ? get_the_excerpt() : wp_trim_words( get_the_content(),20 );

//             $thumbnail = get_the_post_thumbnail($postID , 'medium');

//             //Meta Data

//             $position = get_post_meta( $postID, 'position' , true );
//             $Cname = get_post_meta( $postID, 'company_name' , true );
//             $location = get_post_meta( $postID, 'location' , true );
//             $experience = get_post_meta( $postID, 'experience' , true );

//             // $skills = get_object_taxonomies( 'job_listings', 'skills' );

//             //Build single job box

//             $output .= "<div class='job-box'>";
//             $output .= "<h1>{$title}</h1>";
//             $output .= "<div class='thumb'>{$thumbnail}</div>";
//             $output .= "<p>{$desc}</p>";

//             if ($position) {
//                 $output .= "<p>{$position}</p>";
//             }
//             if ($Cname) {
//                 $output .= "<p>{$Cname}</p>";
//             }
//             if ($location) {
//                 $output .= "<p>{$location}</p>";
//             }
//             if ($experience) {
//                 $output .= "<p>{$experience}</p>";
//             }
//             $taxonomies = get_object_taxonomies('job_listings', 'skills');
//             foreach ($taxonomies as $taxonomy) {
//                 $terms = get_the_terms($post->ID, $taxonomy);
//                 if (!empty($terms) && !is_wp_error($terms)) {
//                     echo '<p><strong>' . ucfirst($taxonomy) . ':</strong> ';
//                     $term_names = wp_list_pluck($terms, 'skills');
//                     echo esc_html(implode(', ', $term_names));
//                     echo '</p>';
//                 }
//             }

//             $output .= "</div>";

//         }

//         $output .= "</div>";

//         wp_reset_postdata();

//         return $output;


// }


function wp_job_listing_shortcode($attr) {
    // normalize attributes
    $attr = shortcode_atts( array(
        'count' => 1,
    ), $attr, 'wp_job_listing' );

    // CORRECT ARG NAME: posts_per_page (you had post_per_page)
    $args = array(
        'post_type'      => 'job_listings',
        'posts_per_page' => intval( $attr['count'] ),
        'post_status'    => 'publish',
    );

    $query = new WP_Query( $args );

    // If no posts, reset and return message
    if ( ! $query->have_posts() ) {
        wp_reset_postdata();
        return '<p>No jobs found.</p>';
    }

    $output = "<div class='job-listings'>";

    while ( $query->have_posts() ) {
        $query->the_post();
        $postID    = get_the_ID();
        $title     = get_the_title();
        $desc      = has_excerpt() ? get_the_excerpt() : wp_trim_words( get_the_content(), 20 );
        $thumbnail = get_the_post_thumbnail( $postID, 'medium' );

        // meta fields
        $position   = get_post_meta( $postID, 'position', true );
        $Cname      = get_post_meta( $postID, 'company_name', true );
        $location   = get_post_meta( $postID, 'location', true );
        $onsite = get_post_meta( $postID, 'onsite', true );
        $remote = get_post_meta( $postID, 'remote', true );
        $fulltime = get_post_meta( $postID, 'fulltime', true );
        $part_time = get_post_meta( $postID, 'part_time', true );
        $experience = get_post_meta( $postID, 'experience', true );

        $output .= "<div class='job-box'>";
        $output .= "<h2>" . esc_html( $title ) . "</h2>";

        if ( $thumbnail ) {
            // get_the_post_thumbnail() returns safe HTML for images
            $output .= "<div class='thumb'>{$thumbnail}</div>";
        }

        // allow basic HTML in excerpt/content, otherwise escape
        $output .= "<div class='job-desc'>" . wp_kses_post( $desc ) . "</div>";

        if ( $position ) {
            $output .= "<p><strong>Position:</strong> " . esc_html( $position ) . "</p>";
        }
        if ( $Cname ) {
            $output .= "<p><strong>Company:</strong> " . esc_html( $Cname ) . "</p>";
        }
        if ( $location ) {
            $output .= "<p><strong>Location:</strong> " . esc_html( $location ) . "</p>";
        }
        if ( $experience ) {
            $output .= "<p><strong>Experience:</strong> " . esc_html( $experience ) . "</p>";
        }
        if ($remote) {
            $output .= "<p><strong>Remote:</strong> Yes</p>";
        }
        if ($fulltime) {
            $output .= "<p><strong>Full Time:</strong> Yes</p>";
        }
        if ($part_time) {
            $output .= "<p><strong>Part Time:</strong> Yes</p>";
        }
        if ($onsite) {
            $output .= "<p><strong>Onsite:</strong> Yes</p>";
        }

        // — TAXONOMIES: get only taxonomies attached to the post type
        $taxonomies = get_object_taxonomies( 'job_listings', 'names' ); 
        foreach ( $taxonomies as $taxonomy ) {
            $terms = get_the_terms( $postID, $taxonomy );
            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                $term_links = array();
                foreach ( $terms as $term ) {
                    // link each term to its archive:
                    $term_links[] = '<a href="' . esc_url( get_term_link( $term ) ) . '">' . esc_html( $term->name ) . '</a>';
                }
                $output .= '<p><strong>' . esc_html( ucfirst( $taxonomy ) ) . ':</strong> ' . implode( ', ', $term_links ) . '</p>';
            }
        }

        $output .= "</div>"; // .job-box
    }

    $output .= "</div>"; // .job-listings

    wp_reset_postdata();
    return $output;
}
add_shortcode( 'job_listings', 'wp_job_listing_shortcode' );


add_shortcode('wp_job_listing', 'wp_job_listing_shortcode');