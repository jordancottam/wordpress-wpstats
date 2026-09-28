<?php

defined( 'ABSPATH' ) or exit();

?>

<div id="facebook_2" class="wpstats-card-container">
	<div class="wpstats-card">
		<div class="wpstats-card-header">
			<span class="wpstats-card-drag-icon"></span>
			<h4 class="wpstats-card-heading"><?php _e( 'Facebook', 'wpstats' ); ?></h4>
			<span id="wpstats-facebook-settings-icon" class="wpstats-card-settings wpstats-setting-tool-tip wpstats-tooltip wpstats-disabled" data-tooltip="<?php _e( 'Configure Settings for Facebook', 'wpstats' ); ?>"></span>
			<span id="wpstats-facebook-grid-icon" class="wpstats-card-eye wpstats-select-tool-tip wpstats-tooltip wpstats-disabled" data-tooltip="<?php _e( 'Show/Hide Facebook Data Points', 'wpstats' ); ?>"></span>
			<div id="wpstats-facebook-grid-icon-content" class="wpstats-grid-content">
				<p>
					<label>
						<input type="checkbox" class="wpstats-show-data-point" value="wpstats-facebook-total-likes-data-point" checked>
						<?php _e( 'Total Likes', 'wpstats' ); ?>
					</label>
				</p>
				<p>
					<label>
						<input type="checkbox" class="wpstats-show-data-point" value="wpstats-facebook-total-reach-data-point" checked>
						<?php _e( 'Total Reach', 'wpstats' ); ?>
					</label>
				</p>
				<p>
					<label>
						<input type="checkbox" class="wpstats-show-data-point" value="wpstats-facebook-page-visits-data-point" checked>
						<?php _e( 'Page Visits', 'wpstats' ); ?>
					</label>
				</p>
				<p>
					<label>
						<input type="checkbox" class="wpstats-show-data-point" value="wpstats-facebook-people-engaged-data-point" checked>
						<?php _e( 'People Engaged', 'wpstats' ); ?>
					</label>
				</p>
			</div>
		</div>
		<div id="wpstats-facebook-card-content" class="wpstats-card-content">

			<!-- Facebook Specific Errors -->
			<div id="wpstats-facebook-error-container" class="wpstats-error-container">
				<p></p>
			</div>

			<div id="wpstats-facebook-range-error-container" class="wpstats-error-container">
				<p id="wpstats-facebook-range-error">
					<?php _e( 'Facebook only returns results within a 91 day period.', 'wpstats' ); ?>
					<a class="wpstats-read-more" data-tooltip=""><?php _e( 'Read more.', 'wpstats' ); ?></a>
				</p>
			</div>

			<!-- Facebook Loading Icon -->
			<div id="wpstats-facebook-loading-container" class="wpstats-loading-container wpstats-chart-loading-container">
				<img class="wpstats-loading-image" src="<?php echo wpstats_TEMPLATE_IMAGES_URL . 'loading-spin.svg'; ?>" width="64" height="64">
			</div>

			<!-- Facebook Settings Content -->
			<div id="wpstats-facebook-settings-content" class="wpstats-settings-tab-settings-content">
				<?php require_once wpstats_API_FUNCTIONS_PATH . 'facebook.php'; ?>
				<?php $api_authenticate_url = esc_attr( wpstats_facebook_get_authentication_url( wpstats_MASHBOARD_PAGE_URL ) ); ?>
				<!-- No Pages -->
				<div id="wpstats-facebook-settings-no-pages-section" class="wpstats-facebook-settings-tab-section wpstats-settings-tab-section">
					<h3><?php _e( 'No Pages Found', 'wpstats' ); ?></h3>
					<p><?php _e( 'No pages found. Please try refreshing the page or deauthorize below then reauthorize with a Facebook account that has access to at least one page\'s insights.', 'wpstats' ); ?></p>
				</div>
				<!-- Page Selection -->
				<div id="wpstats-facebook-settings-page-selection-section" class="wpstats-facebook-settings-tab-section wpstats-settings-tab-section">
					<h3><?php _e( 'Select Page', 'wpstats' ); ?></h3>
					<p><?php _e( 'Select a page from the list below to display data for:', 'wpstats' ); ?></p>
					<select id="wpstats-facebook-page-list" class="wpstats-card-settings-profiles"></select>
					<button id="wpstats-facebook-save-page-id" class="wpstats-settings-tab-save-data-button wpstats-button"><?php _e( 'Save', 'wpstats' ); ?></button>
				</div>
				<!-- Reauthorize / Reauthenticate -->
				<div id="wpstats-facebook-settings-reauthorize-section" class="wpstats-facebook-settings-tab-section wpstats-settings-tab-section">
					<h3><?php _e( 'Reauthorize', 'wpstats' ); ?></h3>
					<p><?php _e( 'Sorry, an error occurred that requires you to reauthorize/reauthenticate with Google. This is likely due to either an expired access token, you removed the application from your account, or you logged out of your account and your session expired. Please click the button below to continue.', 'wpstats' ); ?></p>
					<a id="wpstats-facebook-reauthorize" href="<?php echo $api_authenticate_url; ?>" class="wpstats-button"><?php _e( 'Reauthorize', 'wpstats' ); ?></a>
				</div>
				<!-- Deauthorize / Deauthenticate -->
				<div id="wpstats-facebook-settings-deauthorize-section" class="wpstats-facebook-settings-tab-section wpstats-settings-tab-section">
					<h3><?php _e( 'Deauthorize', 'wpstats' ); ?></h3>
					<p><?php _e( 'Purge all Facebook authentication and cache data from your local install.', 'wpstats' ); ?></p>
					<?php $fb_deauthorize_url = esc_attr( wpstats_api_facebook_get_deauthorize_url( wpstats_MASHBOARD_PAGE_URL ) ); ?>
					<a id="wpstats-facebook-deauthorize" href="<?php echo $fb_deauthorize_url; ?>" class=" wpstats-button"><?php _e( 'Deauthorize', 'wpstats' ); ?></a>
				</div>
				<!-- Setup / Authorize / Authenticate -->
				<div id="wpstats-facebook-settings-authorize-section" class="wpstats-facebook-settings-tab-section wpstats-settings-tab-section">
					<h3><?php _e( 'Setup', 'wpstats' ); ?></h3>
					<p><?php _e( 'Click the button below to Login to Facebook and allow the application to access your page(s) insights. You will then be able to see data for your page(s). Please make sure you login with an account that has access to at least one page\'s insights.', 'wpstats' ); ?></p>
					<a id="wpstats-facebook-authorize" href="<?php echo $api_authenticate_url; ?>" class="wpstats-button"><?php _e( 'Setup', 'wpstats' ); ?></a>
				</div>
			</div>

			<!-- Facebook Data Tab Content -->
			<div id="wpstats-facebook-data-tab-content">

				<!-- Facebook Chart -->
				<div id="wpstats-facebook-chart-container" class="wpstats-mashboard-chart-container wpstats-chart-container">
					<div id="wpstats-facebook-chart" class="wpstats-mashboard-chart"></div>
				</div>

				<!-- Facebook Data Points -->
				<div id="wpstats-facebook-data-points-container" class="wpstats-data-points-container">

					<!-- Facebook Total Likes -->
					<div id="wpstats-facebook-total-likes-data-point" class="wpstats-mashboard-data-point-column">
						<div class="wpstats-dashboard-data-point-header">
							<span id="wpstats-facebook-likes-chart-key-icon">&nbsp;</span>
							<span class="wpstats-dashboard-data-point-heading"><?php _e( 'Total Likes', 'wpstats' ); ?></span>
							<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Total number of people who have liked your page during this period. This metric is updated every 24 hours.', 'wpstats' ); ?>"></span>
						</div>
						<div class="wpstats-dashboard-data-point-content">
							<span id="wpstats-facebook-total-likes-total" class="wpstats-data-point-value"></span>
						</div>
						<div class="wpstats-dashboard-data-point-footer">
							<span id="wpstats-facebook-total-likes-change-direction" class="wpstats-data-point-change-direction"></span>
							<span id="wpstats-facebook-total-likes-change" class="wpstats-data-point-change"></span>
							<?php $title = __( 'total likes at the end of the previous period.', 'wpstats' ); ?>
							<span id="wpstats-facebook-total-likes-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
						</div>
					</div>

					<!-- Facebook Total Reach -->
					<div id="wpstats-facebook-total-reach-data-point" class="wpstats-mashboard-data-point-column">
						<div class="wpstats-dashboard-data-point-header">
							<span id="wpstats-facebook-reach-chart-key-icon">&nbsp;</span>
							<span class="wpstats-dashboard-data-point-heading"><?php _e( 'Total Reach', 'wpstats' ); ?></span>
							<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'The number of people who have seen any content associated with your page during this period. This metric is updated every 24 hours.', 'wpstats' ); ?>"></span>
						</div>
						<div class="wpstats-dashboard-data-point-content">
							<span id="wpstats-facebook-total-reach-total" class="wpstats-data-point-value"></span>
						</div>
						<div class="wpstats-dashboard-data-point-footer">
							<span id="wpstats-facebook-total-reach-change-direction" class="wpstats-data-point-change-direction"></span>
							<span id="wpstats-facebook-total-reach-change" class="wpstats-data-point-change"></span>
							<?php $title = __( 'total reach during the previous period.', 'wpstats' ); ?>
							<span id="wpstats-facebook-total-reach-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
						</div>
					</div>

					<!-- Facebook Page Visits -->
					<div id="wpstats-facebook-page-visits-data-point" class="wpstats-mashboard-data-point-column">
						<div class="wpstats-dashboard-data-point-header">
							<span class="wpstats-dashboard-data-point-heading"><?php _e( 'Page Visits', 'wpstats' ); ?></span>
							<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Total amount of page visits by all users during this period. This metric is updated every 24 hours.', 'wpstats' ); ?>"></span>
						</div>
						<div class="wpstats-dashboard-data-point-content">
							<span id="wpstats-facebook-page-visits-total" class="wpstats-data-point-value"></span>
						</div>
						<div class="wpstats-dashboard-data-point-footer">
							<span id="wpstats-facebook-page-visits-change-direction" class="wpstats-data-point-change-direction"></span>
							<span id="wpstats-facebook-page-visits-change" class="wpstats-data-point-change"></span>
							<?php $title = __( 'page visits during the previous period.', 'wpstats' ); ?>
							<span id="wpstats-facebook-page-visits-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
						</div>
					</div>

					<!-- Facebook People Engaged -->
					<div id="wpstats-facebook-people-engaged-data-point" class="wpstats-mashboard-data-point-column">
						<div class="wpstats-dashboard-data-point-header">
							<span class="wpstats-dashboard-data-point-heading"><?php _e( 'People Engaged', 'wpstats' ); ?></span>
							<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'The unique number of people who liked, commented on, shared, or clicked on your posts during this period. This metric is updated every 24 hours.', 'wpstats' ); ?>"></span>
						</div>
						<div class="wpstats-dashboard-data-point-content">
							<span id="wpstats-facebook-people-engaged-total" class="wpstats-data-point-value"></span>
						</div>
						<div class="wpstats-dashboard-data-point-footer">
							<span id="wpstats-facebook-people-engaged-change-direction" class="wpstats-data-point-change-direction"></span>
							<span id="wpstats-facebook-people-engaged-change" class="wpstats-data-point-change"></span>
							<?php $title = __( 'people were engaged during the previous period.', 'wpstats' ); ?>
							<span id="wpstats-facebook-people-engaged-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
						</div>
					</div>
				</div>

				<!-- Facebook Details -->
				<div class="wpstats-card-details-container">
					<span class="wpstats-card-details">
						<a class="wpstats-card-details-link wpstats-tooltip" href="<?php echo admin_url( 'admin.php?page=wpstats-facebook' ); ?>" data-tooltip="<?php _e( 'View detailed information about your Facebook page.', 'wpstats' ); ?>">
							<?php _e( 'View Details', 'wpstats' ); ?>
						</a>
					</span>
				</div>
			</div> <!-- #wpstats-mashboard-facebook-data-content -->
		</div> <!-- #wpstats-facebook-card-content -->
	</div> <!-- .wpstats-card -->
</div> <!-- #facebook_2.wpstats-card-container -->