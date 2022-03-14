<?php 

// Tasks:

// ----------------------------------------------------

// Develop custom plugin that serves a shortcode for displaying the post with the most
// comments - the title, short description, picture, publication date and the actual
// number of comments must be displayed.

// Respectively:
// 1) deploy wordpress,
// 2) install a plugin that will serve such a shortcode,
// 3) make some page the main (not the list of posts, as by default)
// 4) insert this shortcode into this page, insert 1 paragraph of lorem ipsum text above it

// Additional tasks:
// 1) Do not display posts 0 comments - if nothing was found, do not display anything
// 2) Display a thumbnail of the publication above the title, registering the size of
// 200x100 and uploading the images so that they have this size
// 3) In the widget, when you hover over the picture, make 2 effects:
// - overlay appears on top of the picture with a gradient of light gray to light turquoise
// - the picture is enlarged by 20% (it does not go beyond the original dimensions) and
// rotated 30 degrees clockwise
// - all this happens smoothly for 300 ms

// Supporting materials for the test task:
// https://developer.wordpress.org/plugins/intro/

// ----------------------------------------------------


// Post test shortcode 

	function post_test_shortcode(){
		ob_start();
		?>
			<!-- Development shortcode -->

			
		<ul class="most__commented">
			<?php 

					// Filter 0 comment

						function my_has_comments_filter( $where ) {
							$where .= ' AND comment_count > 0 ';
							return $where;
						}
						add_filter( 'posts_where', 'my_has_comments_filter' );
							// Run WP_Query
							// change posts_per_page value to limit the number of posts
						$query = new WP_Query('orderby=comment_count&posts_per_page=10');		
							// Don't filter future queries.
						remove_filter( 'posts_where', 'my_has_comments_filter' );

					// Filter

				//Post begin loop
				while ($query->have_posts()) : $query->the_post(); ?>

			<li class='post__body'>
				<a class="post__image" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(array(200,100)); ?>
					<div class="cover__bg"></div>
				</a>	
					</br>
    			<a class="post__header" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</br>
    			<a class="post__info" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_excerpt($post->ID); ?></a>
					</br>
    			<a class="post__autor" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_author(); ?></a>
    				</br>
    			<a class="post__data" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_time(' Y-j-m '); ?></a>	
					</br>		
				<span class="wpb-comment-count"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></span>
			</li>
				</br>

				<?php endwhile; 
					// end loop
			?>
		</ul>
			<?php
  
				// Turn off output buffering
 			$output = ob_get_clean(); 
  
				//Return output 
			return $output; 

			?>
		}
		
			<!-- Development shortcode -->
	<?php
		return ob_get_clean();

	}
	
	add_shortcode('post-test-shortcode', 'post_test_shortcode');


