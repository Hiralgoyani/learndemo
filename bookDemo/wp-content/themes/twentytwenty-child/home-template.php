<?php
/**
 * Template Name: Home Books Template
 */
// add header
get_header();
?>
<!-- Show books post with filter -->

<div class="row">
	<div class="container">
		<div class="entry-content-cls">
        <div class="wrap">
            <!-- <h1 class="title text-center blog-boxs">Books</h1> -->
            <div class="tag-list">
            <span class="tag-head">Tags : </span>                
                    <?php
                    $tags = get_tags();
                    if ( $tags ) :
                        foreach ( $tags as $tag ) : ?>
                            <span class="tag-span" id="custTagID" dataTagID ="<?php echo  $tag->term_id ; ?>"><?php echo esc_html( $tag->name ); ?></span>
                            <!-- <span><a href="<?php //echo esc_url( get_tag_link( $tag->term_id ) ); ?>" title="<?php //echo esc_attr( $tag->name ); ?>"><?php //echo esc_html( $tag->name ); ?></a></span> -->
                        <?php endforeach; ?>
                    <?php endif; ?>                
            </div>
     <?php

        $count_posts = wp_count_posts( 'books' )->publish;
        $post_cnt = (int)ceil($count_posts/4) - 1;
        // echo "Count : ".$post_cnt;
        echo '<input type="hidden" value="'.$post_cnt.'" id="post_cnt" >';

        $args = array(
            'post_type' => 'books',
            'post_status' => 'publish',
            'posts_per_page' => '4',
            'paged' => 1,
        );
        $books_posts = new WP_Query( $args ); ?>

        <?php if ( $books_posts->have_posts() ) : ?>
            <div class="pcblog-posts pcblog-postss pc-books">
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
            <div class="pcblog-buttons">
                <button class="pcloadmore btn btn-danger">LOAD MORE</button>                
            </div>
        <?php endif; ?>	
 
        </div>
    </div>
	</div>
</div>

<?php
// add footer
get_footer();