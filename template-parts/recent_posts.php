unction wpcat_postsbycategory() {

// the query

$the_query = new WP_Query( array( 'category_name' => 'yourcategoryslug', 'posts_per_page' => 10 ) );



// The Loop

if ( $the_query->have_posts() ) {

$string .= '<ul class="postsbycategory widget_recent_entries">';

    while ( $the_query->have_posts() ) {

    $the_query->the_post();

    if ( has_post_thumbnail() ) {

    $string .= '<li>';

        $string .= '<a href="' . get_the_permalink() .'" rel="bookmark">' . get_the_post_thumbnail($post_id, array( 50, 50) ) . get_the_title() .'</a></li>';

    } else {

    // if no featured image is found

    $string .= '<li><a href="' . get_the_permalink() .'" rel="bookmark">' . get_the_title() .'</a></li>';

    }

    }

    } else {

    // no posts found

    }

    $string .= '</ul>';



return $string;



/* Restore original Post Data */

wp_reset_postdata();

}