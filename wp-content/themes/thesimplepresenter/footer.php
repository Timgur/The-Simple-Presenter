<?php
/**
 * The template for displaying the footer.
 *
 */
?>

<?php if(current_user_can('edit_post')) { wp_footer(); } ?>
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
    	return <?php
	        $tag = $wp->query_vars['tag'];
			$args = array(
				'posts_per_page'   => 1000,
				'offset'           => 0,
				'tag'              => $tag,
				'orderby'          => 'post_date',
				'order'            => 'DESC',
				'post_type'        => 'post',
				'post_status'      => 'publish',
				'suppress_filters' => true );
			global $post;

			$myposts = get_posts( $args );
			$slides = array();

			foreach ($myposts as $key => $post) {
				setup_postdata( $post );
				$slidenum = types_render_field("slide-number", array("raw"=>true));
				$template = types_render_field("template-type", array("value"=>true));
				$imageLinks = explode("|",types_render_field("image-links", array("url"=>true, "separator"=>"|")));

				$imageUrls = ($imageLinks[0] == "") ? types_render_field("image-url", array("url"=>true)) : $imageLinks;
				$cat = get_the_category($post->ID);
				$slides[] = array(
					'title'=> $post->post_title,
					'content'=> $post->post_content,
					'category'=> $cat[0]->cat_name,
					'image_links'=> $imageUrls,
					'slide_number'=> $slidenum,
					'template'=> $template
				);
			}

            $content = json_encode($slides);
			echo $content;

			if(current_user_can('edit_post')) {
				$isZip = $_SERVER['QUERY_STRING'] == 'zip';

				if($isZip) {
					require_once 'zip.php';
					$fjson = fopen('wp-content/themes/thesimplepresenter/slides.json', 'w');
					fwrite($fjson, $content);
					fclose($fjson);
					$zip = new Zip($tag);
					$zip->setup_folder();
				}
			}
		?>
	};
</script>
<script src="<?php echo get_template_directory_uri(); ?>/js/controllers/SlideListCtrl.js" type="text/javascript"></script>
</body>
</html>
