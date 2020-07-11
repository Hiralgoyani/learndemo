<?php
//  enqueue parent theme css
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
 	
 	//  enqueue custom css file
 	wp_register_style('custom-theme-css', get_stylesheet_directory_uri() .'/assets/css/custom-css.css');
	wp_enqueue_style('custom-theme-css');

	// enqueue js
	wp_register_script( 'custom-theme-js', get_stylesheet_directory_uri()  . '/assets/js/custom-js.js', array( 'jquery' ) );
	wp_enqueue_script( 'custom-theme-js' );

	// localize sctipt
	$script_data_array = array('ajaxurl' => admin_url( 'admin-ajax.php' ), 'security' => wp_create_nonce( 'load_more_posts' ));
    wp_localize_script( 'custom-theme-js', 'books', $script_data_array );

    // localize script
	// wp_localize_script( 'custom-theme-js', 'admin_ajax1', ['ajax_url' => admin_url('admin-ajax.php')] );	
}

// create custom post type "Books" function
function create_posttype_books() {
 
    register_post_type( 'books',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Books' ),
                'singular_name' => __( 'Book' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'books'),
            'show_in_rest' => true,
 			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
 			'taxonomies' => array('category', 'post_tag'),
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype_books' );


//  code for display books with load more ajax
add_action('wp_ajax_load_pcposts_by_ajax', 'load_pcposts_by_ajax_callback');
add_action('wp_ajax_nopriv_load_pcposts_by_ajax', 'load_pcposts_by_ajax_callback');

function load_pcposts_by_ajax_callback() {
    check_ajax_referer('load_more_posts', 'security');
    $paged = $_POST['page'];
    // echo "page : ".$paged;
    $args = array(
        'post_type' => 'books',
        'post_status' => 'publish',
        'posts_per_page' => '4',
        'paged' => $paged,
    );
    $books_posts = new WP_Query( $args );
   
    if ( $books_posts->have_posts() ) : ?>
            <div class="pcblog-posts">
                <?php 
                    while ( $books_posts->have_posts() ) : $books_posts->the_post(); ?>
	                    <div class="small-12 large-4 columns">
                    	
                    		<?php  
	                            if ( has_post_thumbnail() ) {
		                        ?>
		                            <div class="img"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a></div>    
		                        <?php
		                            }else{
		                        ?>
		                            <div class="img"><a href="<?php the_permalink(); ?>"><img src="http://localhost/bookDemo/wp-content/uploads/2020/04/fffffftextBook.png" alt="blog image"></a></div>
		                        <?php
	                            } 
	                        ?>

	                        <div class="pcblog-boxs">
	                            <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
	                        </div>
	                    </div>
                	<?php 
                    endwhile; ?>
            </div>
        <?php endif;         
 
    die();
}


//  code for display books with load more ajax
add_action('wp_ajax_book_get_by_tag', 'book_get_by_tag');
add_action('wp_ajax_nopriv_book_get_by_tag', 'book_get_by_tag');

function book_get_by_tag() {
	
    $tag_ID = $_POST['dataId'];
	// echo "ID : ".$tag_ID."<br/>";
    $args = array(
		'post_type' => 'books',
		'tax_query' => array(
		    array(
		    'taxonomy' => 'post_tag',
		    'field' => 'term_id',
		    'terms' => $tag_ID,
		     )
		  )
	);
	$books_posts = new WP_Query( $args ); 
	
	if ( $books_posts->have_posts() ) : ?>
            <div class="pcblog-posts">
                <?php 
                    while ( $books_posts->have_posts() ) : $books_posts->the_post(); ?>
	                    <div class="small-12 large-4 columns">
                    	
							<?php  
	                            if ( has_post_thumbnail() ) {
		                        ?>
		                            <div class="img"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a></div>    
		                        <?php
		                            }else{
		                        ?>
		                            <div class="img"><a href="<?php the_permalink(); ?>"><img src="http://localhost/bookDemo/wp-content/uploads/2020/04/fffffftextBook.png" alt="blog image"></a></div>
		                        <?php
	                            } 
	                        ?>   

	                        <div class="pcblog-boxs">
	                            <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
	                        </div>
	                    </div>
                	<?php 
                    endwhile; ?>
            </div>
        <?php endif;  
    die();
}