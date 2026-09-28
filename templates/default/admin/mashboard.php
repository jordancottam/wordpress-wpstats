<?php

defined( 'ABSPATH' ) or exit();

?>

<div class="wrap">
	<div id="wpstats-logo-container">
		<?php $current_page_url = esc_attr( admin_url() . 'admin.php?page=wpstats-mashboard' ); ?>
		<?php $brand_logo_image_url = esc_attr( get_option( 'wpstats_brand_logo_image_url' ) ); ?>
		<a class="wpstats-shadowless" href="<?php echo $current_page_url; ?>">
			<?php $id = ( wpstats_DEFAULT_LOGO_IMAGE_URL === $brand_logo_image_url ) ?
				'wpstats-default-logo' :
				'';
			?>
			<img id="<?php echo $id; ?>" src="<?php echo $brand_logo_image_url; ?>">
		</a>
	</div>

	<div id="wpstats-date-range-container">
		<div id="wpstats-start-date-container">
			<label class="wpstats-query-parameter-label" id="wpstats-date-range-text" for="start_date"><?php _e( 'Date Range:', 'wpstats' ); ?></label>
			<input class="wpstats-date" type="text" id="start_date" name="start_date" placeholder="<?php _e( 'MM/DD/YYYY', 'wpstats' ); ?>" required="required" value="">
		</div>
		<div id="wpstats-end-date-container">
			<input class="wpstats-date" type="text" id="end_date" name="end_sate" placeholder="<?php _e( 'MM/DD/YYYY', 'wpstats' ); ?>" required="required" value="">
			<button class="wpstats-button wpstats-shadowless" id="date_range" type="submit" name="date_range" value="-1"><?php _e( 'Update', 'wpstats' ); ?></button>
		</div>
	</div>

	<div id="wpstats-page-error-container" class="wpstats-page-error-container wpstats-error-container">
		<p></p>
	</div>

	<!-- Loading Image Container -->
	<div id="wpstats-cards-loading-container">
		<img class="wpstats-loading-image" src="<?php echo wpstats_TEMPLATE_IMAGES_URL . 'loading-spin.svg'; ?>" width="64" height="64">
	</div>

	<div id="dashboard-widgets" class="metabox-holder">

		<?php $mashboard_integrations_path = dirname( __FILE__ ) . '/mashboard-integrations/'; ?>

		<!-- 1st Column -->
		<div id="postbox-container-1" class="postbox-container wpstats-cards-column">

			<?php require_once $mashboard_integrations_path . 'google-analytics.php'; ?>

		</div>

		<!-- 2nd Column -->
		<div id="postbox-container-2" class="postbox-container wpstats-cards-column">

			<?php require_once $mashboard_integrations_path . 'facebook.php'; ?>

		</div>

		<!-- 3rd Column -->
		<div id="postbox-container-3" class="postbox-container wpstats-cards-column">

			<?php require_once $mashboard_integrations_path . 'twitter.php'; ?>

		</div>

		<!-- 4th Column -->
		<div id="postbox-container-4" class="postbox-container wpstats-cards-column">

			<?php

			require_once $mashboard_integrations_path . 'google-adwords.php';

			require_once $mashboard_integrations_path . 'mailchimp.php';

			?>

		</div>
	</div>
</div> <!-- .wrap -->