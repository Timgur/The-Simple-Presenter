<?php
/**
 * The template for displaying the footer.
 *
 */
?>

<?php wp_footer(); ?>
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/lib/html5.js" type="text/javascript"></script>
<![endif]-->
<script src="<?php echo get_template_directory_uri(); ?>/js/lib/jquery-2.0.0.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/lib/jquery.fullscreen.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/lib/TweenMax.min.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/lib/jquery.gsap.min.js" type="text/javascript"></script>
<script type="text/javascript">
	var getSlides = function() {
        return [
		<?php
			$args = array(
				'posts_per_page'   => 1000,
				'offset'           => 0,
				'tag'              => $wp->query_vars[tag],
				'orderby'          => 'post_date',
				'order'            => 'DESC',
				'include'          => '',
				'exclude'          => '',
				'meta_key'         => '',
				'meta_value'       => '',
				'post_type'        => 'post',
				'post_mime_type'   => '',
				'post_parent'      => '',
				'post_status'      => 'publish',
				'suppress_filters' => true );
			global $post;
			$myposts = get_posts( $args );

			foreach ($myposts as $key => $post) : setup_postdata( $post );
			$slidenum = types_render_field("slide-number", array("raw"=>true));
			$template = types_render_field("template-type", array("value"=>true));
			$imageLinks = array(types_render_field("image-links", array("url"=>true, "separator"=>"|")));

			$imageURL = types_render_field("image-url", array("value"=>true));
			$cat = get_the_category($post->ID);
		?>
			{
			  "title": <?php echo json_encode( $post->post_title ); ?>,
			  "content": <?php echo json_encode( $post->post_content ); ?>,
			  "category": <?php echo json_encode( $cat[0]->cat_name ); ?>,
			  "image_links": <?php echo json_encode( ($imageLinks ? $imageLinks : $imageURL) )  ?>,
			  "slide_number": <?php echo $slidenum; ?>,
			  "template": <?php echo json_encode( $template ); ?>
			},
		<?php endforeach; ?>
	    ]
	};
</script>
<script src="<?php echo get_template_directory_uri(); ?>/js/controllers/SlideListCtrl.js" type="text/javascript"></script>
</body>
</html>
