<?php
/**
 * Recipe Hero Welcome Page (on install)
 *
 * @package   Recipe Hero
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Welcome Page Class
 *
 * Shows a feature overview for the new version (major) and credits.
 *
 * Adapted from code in WooCommerce (Copyright (c) 2014, WooThemes), EDD (Copyright (c) 2012, Pippin Williamson) and WP.
 *
 * @package 	Recipe Hero
 * @author 		Captain Theme <info@captaintheme.com>
 * @version     0.9.0
*/

/**
 * Recipe_Hero_Admin_Welcome class.
 */

if ( ! class_exists( 'Recipe_Hero_Admin_Welcome' ) ) {
	class Recipe_Hero_Admin_Welcome {

		private $plugin;

		/**
		 * __construct function.
		 *
		 * @access public
		 * @return void
		 */
		public function __construct() {
			$this->plugin             = 'recipe-hero/recipe-hero.php';

			add_action( 'admin_menu', array( $this, 'admin_menus') );
			add_action( 'admin_head', array( $this, 'admin_head' ) );
			add_action( 'admin_init', array( $this, 'welcome'    ) );
		}

		/**
		 * Add admin menus/screens
		 *
		 * @access public
		 * @return void
		 */
		public function admin_menus() {
			if ( empty( $_GET['page'] ) ) {
				return;
			}

			$welcome_page_name  = __( 'About Recipe Hero', 'recipe-hero' );
			$welcome_page_title = __( 'Welcome to Recipe Hero', 'recipe-hero' );

			switch ( $_GET['page'] ) {
				case 'recipe-hero-about' :
					$page = add_dashboard_page( $welcome_page_title, $welcome_page_name, 'manage_options', 'recipe-hero-about', array( $this, 'about_screen' ) );
					add_action( 'admin_print_styles-'. $page, array( $this, 'admin_css' ) );
				break;
				case 'recipe-hero-credits' :
					$page = add_dashboard_page( $welcome_page_title, $welcome_page_name, 'manage_options', 'recipe-hero-credits', array( $this, 'credits_screen' ) );
					add_action( 'admin_print_styles-'. $page, array( $this, 'admin_css' ) );
				break;
				case 'recipe-hero-translators' :
					$page = add_dashboard_page( $welcome_page_title, $welcome_page_name, 'manage_options', 'recipe-hero-translators', array( $this, 'translators_screen' ) );
					add_action( 'admin_print_styles-'. $page, array( $this, 'admin_css' ) );
				break;
			}
		}

		/**
		 * admin_css function.
		 *
		 * @access public
		 * @return void
		 */
		public function admin_css() {
			wp_enqueue_style( 'recipe-hero-activation', plugins_url( 'assets/css/css/activation.css', __FILE__ ), array(), RECIPE_HERO_VERSION_NUMBER );
		}

		/**
		 * Add styles just for this page, and remove dashboard page links.
		 *
		 * @access public
		 * @return void
		 */
		public function admin_head() {
			remove_submenu_page( 'index.php', 'recipe-hero-about' );
			remove_submenu_page( 'index.php', 'recipe-hero-credits' );
			remove_submenu_page( 'index.php', 'recipe-hero-translators' );

			?>
			<style type="text/css">
				/*<![CDATA[*/
				.recipe-hero-badge:before {
					font-family: WooCommerce !important;
					content: "\e03d";
					color: #fff;
					-webkit-font-smoothing: antialiased;
					-moz-osx-font-smoothing: grayscale;
					font-size: 80px;
					font-weight: normal;
					width: 165px;
					height: 165px;
					line-height: 165px;
					text-align: center;
					position: absolute;
					top: 0;
					<?php echo get_bloginfo( 'text_direction' ) === 'rtl' ? 'right' : 'left'; ?>: 0;
					margin: 0;
					vertical-align: middle;
				}
				.recipe-hero-badge {
					position: relative;;
					background: #9c5d90;
					text-rendering: optimizeLegibility;
					padding-top: 150px;
					height: 52px;
					width: 165px;
					font-weight: 600;
					font-size: 14px;
					text-align: center;
					color: #ddc8d9;
					margin: 5px 0 0 0;
					-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.2);
					box-shadow: 0 1px 3px rgba(0,0,0,.2);
				}
				.about-wrap .recipe-hero-badge {
					position: absolute;
					top: 0;
					<?php echo get_bloginfo( 'text_direction' ) === 'rtl' ? 'left' : 'right'; ?>: 0;
				}
				.about-wrap .recipe-hero-feature {
					overflow: visible !important;
					*zoom:1;
				}
				.about-wrap .recipe-hero-feature:before,
				.about-wrap .recipe-hero-feature:after {
					content: " ";
					display: table;
				}
				.about-wrap .recipe-hero-feature:after {
					clear: both;
				}
				.about-wrap .feature-rest div {
					width: 50% !important;
					padding-<?php echo get_bloginfo( 'text_direction' ) === 'rtl' ? 'left' : 'right'; ?>: 100px;
					-moz-box-sizing: border-box;
					box-sizing: border-box;
					margin: 0 !important;
				}
				.about-wrap .feature-rest div.last-feature {
					padding-<?php echo get_bloginfo( 'text_direction' ) === 'rtl' ? 'right' : 'left'; ?>: 100px;
					padding-<?php echo get_bloginfo( 'text_direction' ) === 'rtl' ? 'left' : 'right'; ?>: 0;
				}
				.about-wrap div.icon {
					width: 0 !important;
					padding: 0;
					margin: 0;
				}
				.about-wrap .feature-rest div.icon:before {
					font-family: WooCommerce !important;
					font-weight: normal;
					width: 100%;
					font-size: 170px;
					line-height: 125px;
					color: #9c5d90;
					display: inline-block;
					position: relative;
					text-align: center;
					speak: none;
					margin: <?php echo get_bloginfo( 'text_direction' ) === 'rtl' ? '0 -100px 0 0' : '0 0 0 -100px'; ?>;
					content: "\e01d";
					-webkit-font-smoothing: antialiased;
					-moz-osx-font-smoothing: grayscale;
				}
				.about-integrations {
					background: #fff;
					margin: 20px 0;
					padding: 1px 20px 10px;
				}
				/*]]>*/
			</style>
			<?php
		}

		/**
		 * Into text/links shown on all about pages.
		 *
		 * @access private
		 * @return void
		 */
		private function intro() {

			// Flush after upgrades
			if ( ! empty( $_GET['recipe-hero-updated'] ) || ! empty( $_GET['recipe-hero-installed'] ) )
				flush_rewrite_rules();

			// Drop minor version if 0
			$major_version = substr( RECIPE_HERO_VERSION_NUMBER, 0, 3 );
			?>
			<h1><?php printf( __( 'Welcome to Recipe Hero %s', 'recipe-hero' ), $major_version ); ?></h1>

			<div class="about-text recipe-hero-about-text">
				<?php
					if ( ! empty( $_GET['recipe-hero-installed'] ) )
						$message = __( 'Thanks, all done!', 'recipe-hero' );
					elseif ( ! empty( $_GET['recipe-hero-updated'] ) )
						$message = __( 'Thank you for updating to the latest version!', 'recipe-hero' );
					else
						$message = __( 'Thanks for installing!', 'recipe-hero' );

					printf( __( '%s Recipe Hero %s is more powerful, stable, and secure than ever before. We hope you enjoy it.', 'recipe-hero' ), $message, $major_version );
				?>
			</div>

			<!--<div class="recipe-hero-badge"><?php // printf( __( 'Version %s', 'recipe-hero' ), WC()->version ); ?></div>-->

			<p class="recipe-hero-actions">
				<a href="<?php echo admin_url('edit.php?post_type=recipe&page=recipe_hero_general_options'); ?>" class="button button-primary"><?php _e( 'Settings', 'recipe-hero' ); ?></a>
				<a class="docs button button-primary" href="<?php echo esc_url( apply_filters( 'recipe_hero_docs_url', 'http://recipehero.com/docs/', 'recipe-hero' ) ); ?>"><?php _e( 'Docs', 'recipe-hero' ); ?></a>
				<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://recipehero.in/" data-text="A free open-source #recipe plugin for #WordPress that makes recipe creation fun again!" data-via="RecipeHeroWP" data-size="large" data-hashtags="RecipeHero">Tweet</a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</p>

			<h2 class="nav-tab-wrapper">
				<a class="nav-tab <?php if ( $_GET['page'] == 'recipe-hero-about' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'recipe-hero-about' ), 'index.php' ) ) ); ?>">
					<?php _e( "What's New", 'recipe-hero' ); ?>
				</a><a class="nav-tab <?php if ( $_GET['page'] == 'recipe-hero-credits' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'recipe-hero-credits' ), 'index.php' ) ) ); ?>">
					<?php _e( 'Credits', 'recipe-hero' ); ?>
				</a><a class="nav-tab <?php if ( $_GET['page'] == 'recipe-hero-translators' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'recipe-hero-translators' ), 'index.php' ) ) ); ?>">
					<?php _e( 'Translators', 'recipe-hero' ); ?>
				</a>
			</h2>
			<?php
		}

		/**
		 * Output the about screen.
		 */
		public function about_screen() {
			?>
			<div class="wrap about-wrap">

				<?php $this->intro(); ?>

				<!--<div class="changelog point-releases"></div>-->

				<div class="changelog">
					<h3><?php _e( 'Improved Ingredients adding that you will &#10084;', 'recipe-hero' ); ?></h3>
					<div class="recipe-hero-feature feature-rest feature-section col three-col">
						<div>
							<h4><?php _e( 'Autocomplete Ingredient Suggestion as you Add or Edit Ingredients', 'recipe-hero' ); ?></h4>
							<p><?php _e( 'Built on top of the WooCommerce API, and targeted directly at developers, the new REST API allows you to get data for <strong>Orders</strong>, <strong>Coupons</strong>, <strong>Customers</strong>, <strong>Products</strong> and <strong>Reports</strong> in both <code>XML</code> and <code>JSON</code> formats.', 'recipe-hero' ); ?></p>
						</div>
						<div class="last-feature">
							<h4><?php _e( 'Easily See the Ingredients of a Recipe Without Opening it', 'recipe-hero' ); ?></h4>
							<p><?php _e( 'Authentication for the REST API is performed using HTTP Basic Auth if you have SSL enabled, or signed according to the <a href="http://tools.ietf.org/html/rfc5849">OAuth 1.0a</a> specification if you don\'t have SSL. Data is only available to authenticated users.', 'recipe-hero' ); ?></p>
						</div>
					</div>
				</div>
				<div class="changelog">
					<h3><?php _e( 'Under the Hood', 'recipe-hero' ); ?></h3>

					<div class="feature-section col three-col">
						<div>
							<h4><?php _e( 'Custom Image Sizes', 'recipe-hero' ); ?></h4>
							<p><?php _e( 'PayPal Data Transfer (PDT) is an alternative for PayPal IPN which sends back the status of an order when a customer returns from PayPal.', 'recipe-hero' ); ?></p>
						</div>

						<div>
							<h4><?php _e( 'Better File Structuring', 'recipe-hero' ); ?></h4>
							<p><?php _e( 'Frontend styles have been split into separate appearance/layout/smallscreen stylesheets to help with selective customisation.', 'recipe-hero' ); ?></p>
						</div>

						<div class="last-feature">
							<h4><?php _e( 'Security Improvements', 'recipe-hero' ); ?></h4>
							<p><?php _e( 'Certain pages such as "Pay", "Order Received" and some account pages are now endpoints rather than pages to make checkout more reliable.', 'recipe-hero' ); ?></p>
						</div>
					</div>
					<div class="feature-section col three-col">

						<div>
							<h4><?php _e( 'Custom Permalinks', 'recipe-hero' ); ?></h4>
							<p><?php _e( 'We\'ve added a standardized, default credit card form for gateways to use if they support <code>default_credit_card_form</code>.', 'recipe-hero' ); ?></p>
						</div>

						<div>
							<h4><?php _e( 'Settings UI / Style Improvements', 'recipe-hero' ); ?></h4>
							<p><?php _e( 'Coupon usage limits can now be set per user (using email + ID) rather than global.', 'recipe-hero' ); ?></p>
						</div>

						<div class="last-feature">
							<h4><?php _e( 'Cleans Up Before Leaving', 'recipe-hero' ); ?></h4>
							<p><?php _e( 'A new <code>uninstall.php</code> file is now included that will trigger on deletion, removing Recipe Hero settings, etc. to keep your database clean.', 'recipe-hero' ); ?></p>
						</div>

					</div>
					<div class="feature-section col three-col">

						<div>
							<h4><?php _e( 'Cuisine / Course Custom Labels', 'recipe-hero' ); ?></h4>
							<p><?php _e( 'Define whether prices should be shown incl. or excl. of tax on the frontend, and add an optional suffix.', 'recipe-hero' ); ?></p>
						</div>

						<div>
							<h4><?php _e( 'Past order linking', 'recipe-hero' ); ?></h4>
							<p><?php _e( 'Admins now have the ability to link past orders to a customer (before they registered) by email address.', 'recipe-hero' ); ?></p>
						</div>

						<div class="last-feature">
							<h4><?php _e( 'Review improvements', 'recipe-hero' ); ?></h4>
							<p><?php _e( 'We\'ve added a new option to restrict reviews to logged in purchasers, and made ratings editable from the backend.', 'recipe-hero' ); ?></p>
						</div>

					</div>
				</div>

				<div class="return-to-dashboard">
					<a href="<?php echo esc_url( admin_url( 'edit.php?post_type=recipe&page=recipe_hero_general_options' ) ); ?>"><?php _e( 'Go to Recipe Hero Settings', 'recipe-hero' ); ?></a>
				</div>
			</div>
			<?php
		}

		/**
		 * Output the credits.
		 */
		public function credits_screen() {
			?>
			<div class="wrap about-wrap">

				<?php $this->intro(); ?>

				<p class="about-description"><?php _e( 'Recipe Hero is developed by <a href="http://bryceadams.com/">Bryce Adams</a> and maintained by a worldwide team of passionate individuals, backed by an awesome developer community. Want to see your name here? <a href="https://github.com/bryceadams/Recipe-Hero/">Contribute to Recipe Hero</a>.', 'recipe-hero' ); ?></p>

				<?php echo $this->contributors(); ?>
			</div>
			<?php
		}

		/**
		 * Output the translators screen
		 */
		public function translators_screen() {
			?>
			<div class="wrap about-wrap">

				<?php $this->intro(); ?>

				<p class="about-description"><?php _e( 'Recipe Hero has been kindly translated into a couple other languages thanks to our translation team. Want to join the lingual club? <a href="https://www.transifex.com/projects/p/recipe-hero/">Translate Recipe Hero</a>.', 'recipe-hero' ); ?></p>

				<p class="wp-credits-list"><a href="http://www.transifex.com/projects/p/recipe-hero/">Get Your Name Here!</a></p>
			</div>
			<?php
		}

		/**
		 * Render Contributors List
		 *
		 * @access public
		 * @return string $contributor_list HTML formatted list of contributors.
		 */
		public function contributors() {
			$contributors = $this->get_contributors();

			if ( empty( $contributors ) )
				return '';

			$contributor_list = '<ul class="wp-people-group">';

			foreach ( $contributors as $contributor ) {
				$contributor_list .= '<li class="wp-person">';
				$contributor_list .= sprintf( '<a href="%s" title="%s">',
					esc_url( 'https://github.com/' . $contributor->login ),
					esc_html( sprintf( __( 'View %s', 'recipe-hero' ), $contributor->login ) )
				);
				$contributor_list .= sprintf( '<img src="%s" width="64" height="64" class="gravatar" alt="%s" />', esc_url( $contributor->avatar_url ), esc_html( $contributor->login ) );
				$contributor_list .= '</a>';
				$contributor_list .= sprintf( '<a class="web" href="%s">%s</a>', esc_url( 'https://github.com/' . $contributor->login ), esc_html( $contributor->login ) );
				$contributor_list .= '</a>';
				$contributor_list .= '</li>';
			}

			$contributor_list .= '</ul>';

			return $contributor_list;
		}

		/**
		 * Retrieve list of contributors from GitHub.
		 *
		 * @access public
		 * @return mixed
		 */
		public function get_contributors() {
			$contributors = get_transient( 'recipe_hero_contributors' );

			if ( false !== $contributors )
				return $contributors;

			$response = wp_remote_get( 'https://api.github.com/repos/bryceadams/Recipe-Hero/contributors', array( 'sslverify' => false ) );

			if ( is_wp_error( $response ) || 200 != wp_remote_retrieve_response_code( $response ) )
				return array();

			$contributors = json_decode( wp_remote_retrieve_body( $response ) );

			if ( ! is_array( $contributors ) )
				return array();

			set_transient( 'recipe_hero_contributors', $contributors, 3600 );

			return $contributors;
		}

		/**
		 * Sends user to the welcome page on first activation
		 */
		public function welcome() {

			// Bail if no activation redirect transient is set
		    if ( ! get_transient( '_recipe_hero_activation_redirect' ) )
				return;

			// Delete the redirect transient
			delete_transient( '_recipe_hero_activation_redirect' );

			// Bail if we are waiting to install or update via the interface update/install links
			if ( get_option( '_wc_needs_update' ) == 1 || get_option( '_wc_needs_pages' ) == 1 )
				return;

			// Bail if activating from network, or bulk, or within an iFrame
			if ( is_network_admin() || isset( $_GET['activate-multi'] ) || defined( 'IFRAME_REQUEST' ) )
				return;

			if ( ( isset( $_GET['action'] ) && 'upgrade-plugin' == $_GET['action'] ) && ( isset( $_GET['plugin'] ) && strstr( $_GET['plugin'], 'recipe-hero.php' ) ) )
				return;

			wp_redirect( admin_url( 'index.php?page=recipe-hero-about' ) );
			exit;
		}

	}

}

new Recipe_Hero_Admin_Welcome();
