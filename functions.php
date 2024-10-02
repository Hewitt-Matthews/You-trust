<?php 

add_filter('acf/settings/remove_wp_meta_box', '__return_false');

function partner_logo_admin_notice(){
    $screen = get_current_screen();
	
    if ( $screen->id == 'edit-partner-logos' ) {
         echo '<div class="notice notice-warning is-dismissible">
             <p>In order to display these logos on a page, put the following shortcode inside a text module: [partnerLogos]. This will grab all of the below logos and put them in a handy swiper so users can browse through them.</p>
         </div>';
    }
}
add_action('admin_notices', 'partner_logo_admin_notice');

function trustees_admin_notice(){
    $screen = get_current_screen();
	
    if ( $screen->id == 'edit-trustees' ) {
         echo '<div class="notice notice-warning is-dismissible">
             <p>In order to display these trustees on a page, put the following shortcode inside a text module: [trusteesLoop category="insert-category-slug-here"]. This will grab all of the below trustees from the specified category and put them in a handy swiper so users can browse through them. Please note, if no category is specified, the slider will show all Trustees regardless of category (as long as they have a category specified).</p>
         </div>';
    }
}
add_action('admin_notices', 'trustees_admin_notice');


add_action( 'wp_enqueue_scripts', 'my_enqueue_assets' ); 

function my_enqueue_assets() { 
     
    wp_enqueue_script( 'menu_scroll', get_stylesheet_directory_uri() . '/js/menu-scroll.js', array(), '1.0.0', true );
	//wp_enqueue_script( 'hero_divider', get_stylesheet_directory_uri() . '/js/hero-divider.js' );
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' ); 
	wp_enqueue_script( 'global_js', get_stylesheet_directory_uri() . '/js/all-pages.js', array(), '1.0.0', true);
	
	if( is_page( 1056 ) ) {
		// wp_enqueue_style( 'vacancies_parent_page_styles', get_stylesheet_directory_uri() . '/css/vacancies-parent-styles.css');
	} elseif( is_page( 899 ) ) {
		wp_enqueue_style( 'domiciliary_care_styles', get_stylesheet_directory_uri() . '/css/domiciliary-care-styles.css');
	} elseif( is_page( 899 ) ) {
		wp_enqueue_style( 'domiciliary_care_styles', get_stylesheet_directory_uri() . '/css/domiciliary-care-styles.css');
	} elseif( is_page( 1454 ) ) {
		wp_enqueue_style( 'contact_styles', get_stylesheet_directory_uri() . '/css/contact-page-styles.css');
		wp_enqueue_script( 'contact_form_tabs', get_stylesheet_directory_uri() . '/js/contact-form-tabs.js', array(), '1.0.0', true );
	} elseif( is_singular( 'vacancies' ) ) {
		 wp_enqueue_style( 'contact_form_styles', get_stylesheet_directory_uri() . '/css/contact-form-styles.css');
		 wp_enqueue_style( 'vacancies_child_styles', get_stylesheet_directory_uri() . '/css/vacancies-child-styles.css');
		 wp_enqueue_script( 'vacancies_child_script', get_stylesheet_directory_uri() . '/js/vacancies.js', );
	}
	
	if(is_user_logged_in()) {
		wp_enqueue_script( 'logged_in_nav', get_stylesheet_directory_uri() . '/js/logged-in-nav.js', );
	}

	global $post;
	
	$my_post_meta = get_post_meta($post->ID, 'page_colour', true);
	
	if ($my_post_meta && is_page( 1717 )) {
		wp_enqueue_script( 'page_colour_change', get_stylesheet_directory_uri() . '/js/page-colour-change-srassac.js', array(), '1.0.0', true );
	} else {
		wp_enqueue_script( 'page_colour_change', get_stylesheet_directory_uri() . '/js/page-colour-change.js', array(), '1.0.0', true );
	}

	
} 


// Call in needed scripts if certain shortcodes are used
function trustee_slider_scripts() {
    global $post;
	
    if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'trusteesLoopOLD') ) {
        wp_enqueue_script( 'slick', get_stylesheet_directory_uri() . '/slick/slick.min.js', array(), $my_js_ver, true );
		wp_enqueue_script( 'slick-options', get_stylesheet_directory_uri() . '/slick/slick-options.js', array('jquery'), $my_js_ver, true );
		wp_enqueue_style( 'slick_styles', get_stylesheet_directory_uri() . '/slick/slick.css');
		wp_enqueue_style( 'slick_theme_styles', get_stylesheet_directory_uri() . '/slick/slick-theme.css');
		wp_enqueue_style( 'trustee_styles', get_stylesheet_directory_uri() . '/css/trustees-loops-styles.css');
		wp_enqueue_script( 'show_trustee_modal', get_stylesheet_directory_uri() . '/js/show-trustee-modal.js', array(), $my_js_ver, true );
    }
}
add_action( 'wp_enqueue_scripts', 'trustee_slider_scripts');

// Call in needed scripts if certain shortcodes are used
function new_trustee_slider_scripts() {
    global $post;
	
    if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'trusteesLoop') ) {
		wp_enqueue_script( 'swiper', get_stylesheet_directory_uri() . '/swiper/swiper-bundle.min.js', array(), '1.0.0', true );
		wp_enqueue_script( 'swiper-options', get_stylesheet_directory_uri() . '/swiper/swiper-options.js', array(), '1.0.0', true );
		wp_enqueue_style( 'swiper_styles', get_stylesheet_directory_uri() . '/swiper/swiper-bundle.css');
		wp_enqueue_style( 'trustee_styles', get_stylesheet_directory_uri() . '/css/trustees-loops-styles.css');
		wp_enqueue_script( 'show_trustee_modal', get_stylesheet_directory_uri() . '/js/show-trustee-modal.js', array(), $my_js_ver, true );
    }
}
add_action( 'wp_enqueue_scripts', 'new_trustee_slider_scripts');

// Call in needed scripts if certain shortcodes are used
function trustee_no_slider_scripts() {
    global $post;
	
    if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'trusteesNoSliderLoop') ) {
		wp_enqueue_style( 'trustee_styles', get_stylesheet_directory_uri() . '/css/trustees-loops-styles.css');
		wp_enqueue_script( 'show_trustee_modal', get_stylesheet_directory_uri() . '/js/show-trustee-modal.js', array(), $my_js_ver, true );
    }
}
add_action( 'wp_enqueue_scripts', 'trustee_no_slider_scripts');


// Call in swiper scripts if certain shortcodes are used that requires it
function swiper_loop_scripts() {
    global $post;
	
    if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'partnerLogos') ) {
		wp_enqueue_script( 'swiper', get_stylesheet_directory_uri() . '/swiper/swiper-bundle.min.js', array(), '1.0.0', true );
		wp_enqueue_script( 'swiper-options', get_stylesheet_directory_uri() . '/swiper/swiper-options.js', array(), '1.0.0', true );
		wp_enqueue_style( 'swiper_styles', get_stylesheet_directory_uri() . '/swiper/swiper-bundle.css');
    } 
}
add_action( 'wp_enqueue_scripts', 'swiper_loop_scripts');

// Call in swiper scripts if certain shortcodes are used that requires it
function swiper_gallery_scripts() {
    global $post;
	
    if ( is_a( $post, 'WP_Post' ) || is_page() && has_shortcode( $post->post_content, 'galleryLoop') ) {
		wp_enqueue_script( 'swiper', get_stylesheet_directory_uri() . '/swiper/swiper-bundle.min.js', array(), '1.0.0', true );
		wp_enqueue_script( 'swiper-options', get_stylesheet_directory_uri() . '/swiper/swiper-options.js', array(), '1.0.0', true );
		wp_enqueue_style( 'swiper_styles', get_stylesheet_directory_uri() . '/swiper/swiper-bundle.css');
		wp_enqueue_style( 'gallery_styles', get_stylesheet_directory_uri() . '/css/gallery-styles.css');
    } 
}
add_action( 'wp_enqueue_scripts', 'swiper_gallery_scripts');

// Call in client logo styles if certain shortcodes are used that requires them
function partner_logo_loop_styles() {
    global $post;
	
    if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'partnerLogos') ) {
		wp_enqueue_style( 'partner_logo_loop_styles', get_stylesheet_directory_uri() . '/css/partner-logo-loop-styles.css');
    }
}
add_action( 'wp_enqueue_scripts', 'partner_logo_loop_styles');


// Call in needed scripts if certain shortcodes are used
function trustee_loop_scripts() {
    global $post;
	
    if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'showTrustees') ) {
		wp_enqueue_style( 'trustee_styles', get_stylesheet_directory_uri() . '/css/trustees-loops-styles.css');
		wp_enqueue_script( 'show_trustee_modal', get_stylesheet_directory_uri() . '/js/show-trustee-modal.js', array(), $my_js_ver, true );
    }
}
add_action( 'wp_enqueue_scripts', 'trustee_loop_scripts');

// Call in needed scripts if certain shortcodes are used
function contact_form_styles() {
    global $post;
	
    if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'contact-form-7') ) {
        wp_enqueue_style( 'contact_form_styles', get_stylesheet_directory_uri() . '/css/contact-form-styles.css');
    }
}
add_action( 'wp_enqueue_scripts', 'contact_form_styles');


// Call in needed scripts if certain shortcodes are used
function vacancies_loop_styles() {
    global $post;
	
    if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'vacanciesLoop') ) {
        wp_enqueue_style( 'vacancies_parent_page_styles', get_stylesheet_directory_uri() . '/css/vacancies-parent-styles.css');
    }
}
add_action( 'wp_enqueue_scripts', 'vacancies_loop_styles');

/**
 * Disable new divi crazy bad code for CPT
 **/
function disable_cptdivi(){
	remove_action( 'wp_enqueue_scripts', 'et_divi_replace_stylesheet', 99999998 );
}
add_action('init', 'disable_cptdivi');


//Build Shortcode to Loop Over featured Client Logos for Logos loop
add_shortcode( 'partnerLogos', 'partner_logos_loop_func' );

function partner_logos_loop_func( $atts ) {
    
	ob_start();
    $query = new WP_Query( array(
        'post_type' => 'partner-logos',
        'posts_per_page' => -1,
    ) );
	
    if ( $query->have_posts() ) { 
		?>	

		<div class="partner-logos-container swiper-container">
			<div class="swiper-wrapper">
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<?php $featuredImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
			    <?php $featuredImgAltText = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ); ?>
				<div class="swiper-slide logo">
			  		<a href="<?= get_the_excerpt(); ?>" target="_blank"><img src="<?= $featuredImg[0] ?>" alt="<?= $featuredImgAltText ?>"></a>
			  	</div>
			<?php endwhile;
			wp_reset_postdata(); ?>
			</div>
		</div>

    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
};





//Build Shortcode to Loop Over Vacancies for loop on vacanices page
add_shortcode( 'vacanciesLoop', 'vacancies_custom_loop_func' );

function vacancies_custom_loop_func( $atts ) {
    
	ob_start();
	
	// Check if category is defined in attributes, if so create array of defined category otherwise create array of all categories
	if ($atts['category']) {
		$custom_cat = $atts['category'];
		$cat_terms[] = get_term_by('slug', $custom_cat, 'vacancies_categories');
	} else {
		$cat_terms = get_terms(
			array('vacancies_categories'),
			array(
					'hide_empty'    => false,
					'orderby'       => 'name',
					'order'         => 'ASC',
				)
		); 
	}

	?>
	
    <?php if ( $cat_terms ) : ?> 
		
		<div id="vacancies-loop">

			<?php foreach($cat_terms as $term) : ?>

			<?php 
			
				$query = new WP_Query( array(
					'post_type' => 'vacancies',
					'posts_per_page' => -1,
					'tax_query' => array(
										array(
											'taxonomy' => 'vacancies_categories',
											'field'    => 'slug',
											'terms'    => $term->slug,
										),
									),
					'order' => 'DESC',
				) ); ?>

				<?php if ( $query->have_posts() ) : ?>	
					
						<?php while ( $query->have_posts() ) : $query->the_post(); ?>
							<?php $closing_date = get_field('closing_date');
									$salary = get_field('salary');
							?>
							<a href="<?php the_permalink(); ?>" class="vacancy <?= $term->slug ?>">
								<p class="category"><span><?= $term->name ?></span></p>
								<h2><?= the_title(); ?></h2>
								<p class="salary"><?= $salary; ?></p>
								<?php if ( $closing_date ) : ?>
									<p>Closing date: <?= $closing_date; ?></p>
								<?php endif; ?>			
								<p><?= get_the_excerpt() ?></p>
							</a>
						<?php endwhile;
						wp_reset_postdata(); ?>
			
				<?php endif; ?>

			<?php endforeach; ?>
		
		</div>
    <?php $myvariable = ob_get_clean();
    return $myvariable; ?>

    <?php endif;
};







//Build Shortcode to Loop Over Trustees for loop on various pages
function trustees_loop_func( $atts ) {
    
	ob_start();
    $query = new WP_Query( array(
        'post_type' => 'trustees',
        'posts_per_page' => -1,
		'order' => 'ASC',
    ) );
	
    if ( $query->have_posts() ) { 
		?>	
			<div class="prev-arrow"></div>
			<div class="trustees-loop">
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<?php $featuredImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); ?>
					<a class="trustee-slide" href="#open-bio">
						<div class="trustee-member">
							<div class="trustee-img" style="background: url(<?= $featuredImg[0] ?>)"></div>
							<h2><?= the_title(); ?></h2>
							<p class="page-bg text-color"><?= get_field('role') ?></p>
						</div>
						<div class="modal">
							<div>											
								<div class="modal-img" style="background: url(<?= $featuredImg[0] ?>)"></div>
								<div class="modal-content">
									<h2><?= the_title(); ?>, <?= get_field('role') ?></h2>
									<p class="quote"><?= get_field('description') ?></p>
								</div>
							</div>	
						</div>
					</a>
				<?php endwhile;
				wp_reset_postdata(); ?>
			</div>
			<div class="next-arrow"></div>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
};

add_shortcode( 'trusteesLoopOLD', 'trustees_loop_func' );

//Build Shortcode to Loop Over Trustees for loop on various pages
add_shortcode( 'trusteesLoop', 'trustees_new_loop_func' );

function trustees_new_loop_func( $atts ) {
	
	ob_start();
	
	// Check if category is defined in attributes, if so create array of defined category otherwise create array of all categories
	if ($atts['category']) {
		$custom_cat = $atts['category'];
		$cat_terms[] = get_term_by('slug', $custom_cat, 'trustees_categories');
	} else {
		$cat_terms = get_terms(
			array('trustees_categories'),
			array(
					'hide_empty'    => false,
					'orderby'       => 'name',
					'order'         => 'ASC',
				)
		); 
	}
	
	?>

    <?php if ( $cat_terms ) : ?>
<!-- 		<?php print_r($cat_terms) ?> -->
		<?php 		
		
		$category_array = [];
		foreach ( $cat_terms as $category) {
			array_push($category_array, $category->slug);
		}

		$query = new WP_Query( array(
			'post_type' => 'trustees',
			'posts_per_page' => -1,
			'order' => 'ASC',
			'tax_query' => array(
							array(
								'taxonomy' => 'trustees_categories',
								'field'    => 'slug',
								'terms'    => $category_array,
							),
						),
		'order' => 'DESC',
		) ); ?>

		<?php if ( $query->have_posts() ) : ?>	
			<?php $number_of_posts = $query->found_posts; ?>
			<div class="trustees-loop-container swiper-container <?php if($number_of_posts < 4) { echo "no-arrows"; } ?>">
				<div class="swiper-wrapper">
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<?php $featuredImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); ?>
						<a class="swiper-slide trustee-slide" href="#open-bio">
							<div class="trustee-member">
								<div class="trustee-img" style="background: url(<?= $featuredImg[0] ?>)"></div>
								<h2><?= the_title(); ?></h2>
								<p class="page-bg text-color"><?= get_field('role') ?></p>
							</div>
							<div class="modal">
								<div>											
									<div class="modal-img" style="background: url(<?= $featuredImg[0] ?>)"></div>
									<div class="modal-content">
										<h2><?= the_title(); ?>, <?= get_field('role') ?></h2>
										<p class="quote"><?= get_field('description') ?></p>
									</div>
								</div>	
							</div>
						</a>
					<?php endwhile;
					wp_reset_postdata(); ?>
				</div>
				<div class="arrows">
					<div class="prev-btn">
								<div class="line long"></div>
								<div class="line top"></div>
								<div class="line bottom"></div>
					</div>
					<div class="next-btn">
								<div class="line long"></div>
								<div class="line top"></div>
								<div class="line bottom"></div>
					</div>
				</div>
			</div>
			
		<?php endif; ?>
		
	<?php endif; ?>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
};

//Build Shortcode to Loop Over Trustees for loop on various pages WITHOUT A SLIDER
add_shortcode( 'trusteesNoSliderLoop', 'trustees_no_slider_loop_func' );

function trustees_no_slider_loop_func( $atts ) {
	
	ob_start();
	
	// Check if category is defined in attributes, if so create array of defined category otherwise create array of all categories
	if ($atts['category']) {
		$custom_cat = $atts['category'];
		$cat_terms[] = get_term_by('slug', $custom_cat, 'trustees_categories');
	} else {
		$cat_terms = get_terms(
			array('trustees_categories'),
			array(
					'hide_empty'    => false,
					'orderby'       => 'name',
					'order'         => 'ASC',
				)
		); 
	}
	
	?>

    <?php if ( $cat_terms ) : ?>
		<?php 		
		
		$category_array = [];
		foreach ( $cat_terms as $category) {
			array_push($category_array, $category->slug);
		}

		$query = new WP_Query( array(
			'post_type' => 'trustees',
			'posts_per_page' => -1,
			'order' => 'ASC',
			'tax_query' => array(
							array(
								'taxonomy' => 'trustees_categories',
								'field'    => 'slug',
								'terms'    => $category_array,
							),
						),
		'order' => 'DESC',
		) ); ?>

		<?php if ( $query->have_posts() ) : ?>	
			<?php $number_of_posts = $query->found_posts; ?>
			<div class="trustees-loop-container <?php if($number_of_posts < 4) { echo "no-arrows"; } ?>">
				<div class="trustees-no-slide-loop-container">
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<?php $featuredImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); ?>
						<a class="trustee-slide" href="#open-bio">
							<div class="trustee-member">
								<div class="trustee-img" style="background: url(<?= $featuredImg[0] ?>)"></div>
								<h2><?= the_title(); ?></h2>
								<p class="page-bg text-color"><?= get_field('role') ?></p>
							</div>
							<div class="modal">
								<div>											
									<div class="modal-img" style="background: url(<?= $featuredImg[0] ?>)"></div>
									<div class="modal-content">
										<h2><?= the_title(); ?>, <?= get_field('role') ?></h2>
										<p class="quote"><?= get_field('description') ?></p>
									</div>
								</div>	
							</div>
						</a>
					<?php endwhile;
					wp_reset_postdata(); ?>
			
		<?php endif; ?>
		
	<?php endif; ?>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
};



//Build Shortcode to Loop Over Trustees for loop on governance page
function show_trustees_func( $atts ) {
    
	ob_start();
    $query = new WP_Query( array(
        'post_type' => 'trustees',
        'posts_per_page' => -1,
		'order' => 'ASC',
    ) );
	
    if ( $query->have_posts() ) { 
		?>	
			<div class="governance-trustees-loop">
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<?php $featuredImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); ?>
					<a class="trustee-slide" href="#open-bio">
						<div class="trustee-member">
							<div class="trustee-img" style="background: url(<?= $featuredImg[0] ?>)"></div>
							<h2><?= the_title(); ?></h2>
							<p class="page-bg text-color"><?= get_post_meta( get_the_ID(), 'Trustee Role', true ); ?></p>
						</div>
						<div class="modal">
							<div>											
								<div class="modal-img" style="background: url(<?= $featuredImg[0] ?>)"></div>
								<div class="modal-content">
									<h2><?= the_title(); ?></h2>
									<p class="current-role page-bg text-color"><?= get_post_meta( get_the_ID(), 'Trustee Role', true ); ?></p>
									<p class="roles"><?= get_the_excerpt(); ?></p>
									<p class="quote"><?= get_the_content(); ?></p>
								</div>
							</div>	
						</div>
					</a>
				<?php endwhile;
				wp_reset_postdata(); ?>
			</div>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
};

add_shortcode( 'showTrustees', 'show_trustees_func' );



class WPImporterUpdate {

	protected $existing_post;

	function __construct() {
		add_filter( 'wp_import_existing_post', [ $this, 'wp_import_existing_post' ], 10, 2 );
		add_filter( 'wp_import_post_data_processed', [ $this, 'wp_import_post_data_processed' ], 10, 2 );
	}

	function wp_import_existing_post( $post_id, $post ) {
		if ( $this->existing_post = $post_id ) {
			$post_id = 0; // force the post to be imported
		}
		return $post_id;
	}

	function wp_import_post_data_processed( $postdata, $post ) {
		if ( $this->existing_post ) {
			// update the existing post
			$postdata['ID'] = $this->existing_post;
		}
		return $postdata;
	}

}
new WPImporterUpdate;







function my_added_social_icons($kkoptions) {
	global $themename, $shortname;
	
	$open_social_new_tab = array( "name" =>esc_html__( "Open Social URLs in New Tab", $themename ),
                   "id" => $shortname . "_show_in_newtab",
                   "type" => "checkbox",
                   "std" => "off",
                   "desc" =>esc_html__( "Set to ON to have social URLs open in new tab. ", $themename ) );
				   
	$replace_array_newtab = array ( $open_social_new_tab );
	
	$show_instagram_icon = array( "name" =>esc_html__( "Show Instagram Icon", $themename ),
                   "id" => $shortname . "_show_instagram_icon",
                   "type" => "checkbox2",
                   "std" => "on",
                   "desc" =>esc_html__( "Here you can choose to display the Instagram Icon on your header or footer. ", $themename ) );
	$show_pinterest_icon = array( "name" =>esc_html__( "Show Pinterest Icon", $themename ),
                   "id" => $shortname . "_show_pinterest_icon",
                   "type" => "checkbox2",
                   "std" => "on",
                   "desc" =>esc_html__( "Here you can choose to display the Pinterest Icon on your header or footer. ", $themename ) );
	$show_tumblr_icon = array( "name" =>esc_html__( "Show Tumblr Icon", $themename ),
                   "id" => $shortname . "_show_tumblr_icon",
                   "type" => "checkbox2",
                   "std" => "on",
                   "desc" =>esc_html__( "Here you can choose to display the Tumblr Icon on your header or footer. ", $themename ) );
	$show_dribbble_icon = array( "name" =>esc_html__( "Show Dribbble Icon", $themename ),
                   "id" => $shortname . "_show_dribbble_icon",
                   "type" => "checkbox2",
                   "std" => "on",
                   "desc" =>esc_html__( "Here you can choose to display the Dribbble Icon on your header or footer. ", $themename ) );
	$show_vimeo_icon = array( "name" =>esc_html__( "Show Vimeo Icon", $themename ),
                   "id" => $shortname . "_show_vimeo_icon",
                   "type" => "checkbox2",
                   "std" => "on",
                   "desc" =>esc_html__( "Here you can choose to display the Vimeo Icon on your header or footer. ", $themename ) );
	$show_linkedin_icon = array( "name" =>esc_html__( "Show LinkedIn Icon", $themename ),
                   "id" => $shortname . "_show_linkedin_icon",
                   "type" => "checkbox2",
                   "std" => "on",
                   "desc" =>esc_html__( "Here you can choose to display the LinkedIn Icon on your header or footer. ", $themename ) );
	$show_myspace_icon = array( "name" =>esc_html__( "Show MySpace Icon", $themename ),
                   "id" => $shortname . "_show_myspace_icon",
                   "type" => "checkbox2",
                   "std" => "on",
                   "desc" =>esc_html__( "Here you can choose to display the MySpace Icon on your header or footer. ", $themename ) );
	$show_skype_icon = array( "name" =>esc_html__( "Show Skype Icon", $themename ),
                   "id" => $shortname . "_show_skype_icon",
                   "type" => "checkbox2",
                   "std" => "on",
                   "desc" =>esc_html__( "Here you can choose to display the Skype Icon on your header or footer. ", $themename ) );
	$show_youtube_icon = array( "name" =>esc_html__( "Show Youtube Icon", $themename ),
                   "id" => $shortname . "_show_youtube_icon",
                   "type" => "checkbox2",
                   "std" => "on",
                   "desc" =>esc_html__( "Here you can choose to display the Youtube Icon on your header or footer. ", $themename ) );
	$show_flickr_icon = array( "name" =>esc_html__( "Show Flickr Icon", $themename ),
                   "id" => $shortname . "_show_flickr_icon",
                   "type" => "checkbox2",
                   "std" => "on",
                   "desc" =>esc_html__( "Here you can choose to display the Flickr Icon on your header or footer. ", $themename ) );
				   
	$repl_array_opt = array( $show_instagram_icon,
							$show_pinterest_icon,
							$show_tumblr_icon,
							$show_dribbble_icon,
							$show_vimeo_icon,
							$show_linkedin_icon,
							$show_myspace_icon,
							$show_skype_icon,
							$show_youtube_icon,
							$show_flickr_icon,
							);
	
	$show_instagram_url =array( "name" =>esc_html__( "Instagram Profile Url", $themename ),
                   "id" => $shortname . "_instagram_url",
                   "std" => "#",
                   "type" => "text",
                   "validation_type" => "url",
				   "desc" =>esc_html__( "Enter the URL of your Instagram Profile. ", $themename ) );
	$show_pinterest_url =array( "name" =>esc_html__( "Pinterest Profile Url", $themename ),
                   "id" => $shortname . "_pinterest_url",
                   "std" => "#",
                   "type" => "text",
                   "validation_type" => "url",
				   "desc" =>esc_html__( "Enter the URL of your Pinterest Profile. ", $themename ) );
	$show_tumblr_url =array( "name" =>esc_html__( "Tumblr Profile Url", $themename ),
                   "id" => $shortname . "_tumblr_url",
                   "std" => "#",
                   "type" => "text",
                   "validation_type" => "url",
				   "desc" =>esc_html__( "Enter the URL of your Tumblr Profile. ", $themename ) );
	$show_dribble_url =array( "name" =>esc_html__( "Dribbble Profile Url", $themename ),
                   "id" => $shortname . "_dribble_url",
                   "std" => "#",
                   "type" => "text",
                   "validation_type" => "url",
				   "desc" =>esc_html__( "Enter the URL of your Dribbble Profile. ", $themename ) );
	$show_vimeo_url =array( "name" =>esc_html__( "Vimeo Profile Url", $themename ),
                   "id" => $shortname . "_vimeo_url",
                   "std" => "#",
                   "type" => "text",
                   "validation_type" => "url",
				   "desc" =>esc_html__( "Enter the URL of your Vimeo Profile. ", $themename ) );
	$show_linkedin_url =array( "name" =>esc_html__( "LinkedIn Profile Url", $themename ),
                   "id" => $shortname . "_linkedin_url",
                   "std" => "#",
                   "type" => "text",
                   "validation_type" => "url",
				   "desc" =>esc_html__( "Enter the URL of your LinkedIn Profile. ", $themename ) );
	$show_myspace_url =array( "name" =>esc_html__( "MySpace Profile Url", $themename ),
                   "id" => $shortname . "_mysapce_url",
                   "std" => "#",
                   "type" => "text",
                   "validation_type" => "url",
				   "desc" =>esc_html__( "Enter the URL of your MySpace Profile. ", $themename ) );
	$show_skype_url =array( "name" =>esc_html__( "Skype Profile Url", $themename ),
                   "id" => $shortname . "_skype_url",
                   "std" => "#",
                   "type" => "text",
                   "validation_type" => "url",
				   "desc" =>esc_html__( "Enter the URL of your Skype Profile. ", $themename ) );
	$show_youtube_url =array( "name" =>esc_html__( "Youtube Profile Url", $themename ),
                   "id" => $shortname . "_youtube_url",
                   "std" => "#",
                   "type" => "text",
                   "validation_type" => "url",
				   "desc" =>esc_html__( "Enter the URL of your Youtube Profile. ", $themename ) );
	$show_flickr_url =array( "name" =>esc_html__( "Flickr Profile Url", $themename ),
                   "id" => $shortname . "_flickr_url",
                   "std" => "#",
                   "type" => "text",
                   "validation_type" => "url",
				   "desc" =>esc_html__( "Enter the URL of your Flickr Profile. ", $themename ) );
				   
	$repl_array_url = array( $show_instagram_url,
							$show_pinterest_url,
							$show_tumblr_url,
							$show_dribble_url,
							$show_vimeo_url,
							$show_linkedin_url,
							$show_myspace_url,
							$show_skype_url,
							$show_youtube_url,
							$show_flickr_url,
							);


	$srch_key = array_column($kkoptions, 'id');
	
	$key = array_search('divi_show_facebook_icon', $srch_key);
	array_splice($kkoptions, $key + 6, 0, $replace_array_newtab);
	
	$key = array_search('divi_show_google_icon', $srch_key);
	array_splice($kkoptions, $key + 8, 0, $repl_array_opt);

	$key = array_search('divi_rss_url', $srch_key);
	array_splice($kkoptions, $key + 17, 0, $repl_array_url);
	
	//print_r($kkoptions);

	return $kkoptions;
}
add_filter('et_epanel_layout_data', 'my_added_social_icons', 99);

define( 'DDPL_DOMAIN', 'my-domain' ); // translation domain
require_once( 'vendor/divi-disable-premade-layouts/divi-disable-premade-layouts.php' );

function bhc_customize_register($wp_customize)
{
    $wp_customize->add_setting("bhc_hamburger_color",[
        'default' => et_builder_accent_color(),
        'transport' => 'refresh',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'bhc_hamburger_color', array(
        'label' => __('Hamburger Color', 'bloody-hamburger-color'),
        'section' => 'et_divi_mobile_menu',
        'settings' => 'bhc_hamburger_color',
    )));
}
add_action('customize_register', 'bhc_customize_register');
function bhc_customize_css()
{
    ?>
         <style type="text/css" id="bloody-hamburger-color">
             .mobile_menu_bar:before { color: <?php echo get_theme_mod('bhc_hamburger_color', et_builder_accent_color()); ?> !important; }
         </style>
    <?php
}
add_action('wp_head', 'bhc_customize_css');

//Build Shortcode to Loop Over featured Posts for news loop on home page
//
add_shortcode( 'galleryLoop', 'gallery_loop_func' );
function gallery_loop_func( $atts ) {
    
	ob_start(); 

	$images = get_field('gallery');
	$size = 'full'; // (thumbnail, medium, large, full or custom size)

	if( $images ): ?>

		  <div id="news-loop" class="news-swiper swiper-container">
			<div class="swiper-wrapper">

			<?php foreach( $images as $image ): ?>

				<?php 
					$background_image = $image['url'];
					$title_text = $image['title'];
					$alt_text = $image['alt'];
				?>

				<div class="swiper-slide news-tile">
					<a style="background: url('<?= $background_image ?>')" alt="<?= $alt_text ?>"></a>
					<div class="benefits-text">
						<p><?= $title_text ?></p>
					</div>
				</div>
			<?php endforeach; 
			wp_reset_postdata(); ?>

			</div>
			  
			<div class="swiper-pagination"></div>

			<div class="news-arrows">
  				<div class="swiper-button-prev">
  					<div class="line top"></div>
    				<div class="line bottom"></div>
 				</div>
  				<div class="swiper-button-next">
   					<div class="line top"></div>
    				<div class="line bottom"></div>
  				</div>
			</div>
			 
		  </div>

	<?php $myvariable = ob_get_clean();
    return $myvariable;
	endif;
    
};

function interactive_map_shortcode($atts) {
    // Buffer the output
    ob_start();

    // Include the template file
    include(get_stylesheet_directory() . '/interactive-map.php');

    // Return the buffered content
    return ob_get_clean();
}

// Register the shortcode
add_shortcode('interactive_map', 'interactive_map_shortcode');

?>