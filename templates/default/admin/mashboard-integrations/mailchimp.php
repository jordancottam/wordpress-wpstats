<?php

// Prevent direct access
defined( 'ABSPATH' ) or exit();

?>

<div id="mailchimp_8" class="wpstats-card-container">
	<div class="wpstats-card">
		<div class="wpstats-card-header">
			<span class="wpstats-card-drag-icon"></span>
			<h4 class="wpstats-card-heading"><?php _e( 'MailChimp', 'wpstats' ); ?></h4>
			<span id="wpstats-mailchimp-settings-icon" class="wpstats-settings-icon wpstats-setting-tool-tip wpstats-tooltip wpstats-disabled" data-tooltip="<?php _e( 'Configure Settings for MailChimp', 'wpstats' ); ?>">
			</span>
			<span id="wpstats-mailchimp-grid-icon" class="wpstats-grid-icon wpstats-select-tool-tip wpstats-tooltip wpstats-disabled" data-tooltip="<?php _e( 'Show/Hide MailChimp Data Points', 'wpstats' ); ?>">
			</span>
			<div id="wpstats-mailchimp-grid-icon-content" class="wpstats-grid-content">
				<p>
					<label>
						<input type="checkbox" class="wpstats-show-data-point" value="wpstats-mailchimp-unique-opens-data-point" checked>
						<?php _e( 'Opens', 'wpstats' ); ?>
					</label>
				</p>
				<p>
					<label>
						<input type="checkbox" class="wpstats-show-data-point" value="wpstats-mailchimp-unique-clicks-data-point" checked>
						<?php _e( 'Clicks', 'wpstats' ); ?>
					</label>
				</p>
				<p>
					<label>
						<input type="checkbox" class="wpstats-show-data-point" value="wpstats-mailchimp-unsubscribed-data-point" checked>
						<?php _e( 'Unsubscribed', 'wpstats' ); ?>
					</label>
				</p>
				<p>
					<label>
						<input type="checkbox" class="wpstats-show-data-point" value="wpstats-mailchimp-subscribers-data-point" checked>
						<?php _e( 'Subscribers', 'wpstats' ); ?>
					</label>
				</p>
				<p>
					<label>
						<input type="checkbox" class="wpstats-show-data-point" value="wpstats-mailchimp-open-rate-data-point">
						<?php _e( 'Open Rate', 'wpstats' ); ?>
					</label>
				</p>
				<p>
					<label>
						<input type="checkbox" class="wpstats-show-data-point" value="wpstats-mailchimp-click-rate-data-point">
						<?php _e( 'Click Rate', 'wpstats' ); ?>
					</label>
				</p>
			</div>
		</div>
		<div id="wpstats-mailchimp-card-content" class="wpstats-card-content">

			<!-- Integration specific error container -->
			<div id="wpstats-mailchimp-error-container" class="wpstats-integration-error-container">
				<p></p>
			</div>

			<!-- Loading Container -->
			<div id="wpstats-mailchimp-loading-container" class="wpstats-loading-container wpstats-chart-loading-container">
				<img class="wpstats-loading-image" src="<?php echo wpstats_TEMPLATE_IMAGES_URL . 'loading-spin.svg'; ?>" height="64" width="64">
			</div>

			<!-- Settings Content -->
			<div id="wpstats-mailchimp-settings-content">
				<?php require_once wpstats_API_FUNCTIONS_PATH . 'mailchimp.php'; ?>
				<?php $api_authenticate_url = wpstats_api_mailchimp_get_authorization_url( wpstats_MASHBOARD_PAGE_URL ); ?>

				<!-- Valid Access Token -->
				<div id="wpstats-mailchimp-settings-valid-access-token-section" class="wpstats-mailchimp-settings-tab-section wpstats-settings-tab-section">
					<h3><?php _e( 'Valid Access Token', 'wpstats' ); ?></h3>
					<p><?php _e( 'This means everything is working correctly and you haven\'t revoked the wpstats MailChimp application\'s access to your MailChimp account.', 'wpstats' ); ?></p>
					<p><?php _e( 'If you want to go back to your data, click the Settings icon again. If you want to use a different account, you\'ll need to Deauthorize.', 'wpstats' ); ?></p>
				</div>

				<!-- Invalid Access Token -->
				<div id="wpstats-mailchimp-settings-invalid-access-token-section" class="wpstats-mailchimp-settings-tab-section wpstats-settings-tab-section">
					<h3><?php _e( 'Invalid Access Token', 'wpstats' ); ?></h3>
					<p><?php _e( 'This means you have either revoked the wpstats application\'s access to your MailChimp account manually, it was invalidated by MailChimp, or you deauthorized', 'wpstats' ); ?></p>
				</div>

				<!-- Setup / Authorize / Authenticate -->
				<div id="wpstats-mailchimp-settings-authorize-section"  class="wpstats-mailchimp-settings-tab-section wpstats-settings-tab-section">
					<h3><?php _e( 'Setup', 'wpstats' ); ?></h3>
					<p><?php _e( 'Click the button below to login to your MailChimp account and authorize the wpstats application to allow us to display data for your campaigns.', 'wpstats' ); ?></p>
					<a id="wpstats-mailchimp-authorize" href="<?php echo esc_attr( $api_authenticate_url ); ?>" class="wpstats-button"><?php _e( 'Setup', 'wpstats' ); ?></a>
				</div>

				<!-- Deauthorize / Deauthenticate -->
				<div id="wpstats-mailchimp-settings-deauthorize-section" class="wpstats-mailchimp-settings-tab-section wpstats-settings-tab-section">
					<h3><?php _e( 'Deauthorize', 'wpstats' ); ?></h3>
					<p><?php _e( 'Purge all MailChimp authentication and cache data from your local install.', 'wpstats' ); ?></p>
					<?php $ga_deauthorize_url = esc_attr( wpstats_api_mailchimp_get_deauthorization_url( wpstats_MASHBOARD_PAGE_URL ) ); ?>
					<a href="<?php echo $ga_deauthorize_url; ?>" id="wpstats-mailchimp-deauthorize" class="wpstats-button"><?php _e( 'Deauthorize', 'wpstats' ); ?></a>
				</div>
			</div>

			<!-- Data Content (chart & data points) -->
			<div id="wpstats-mailchimp-data-content">

				<!-- Chart -->
				<div id="wpstats-mailchimp-chart-container" class="wpstats-mashboard-chart-container wpstats-chart-container">
					<div id="wpstats-mailchimp-chart" class="wpstats-mashboard-chart"></div>
				</div>

				<!-- Data Points -->
				<div id="wpstats-mailchimp-data-points-container" class="wpstats-data-points-container">

					<!-- Opens (Unique) -->
					<div id="wpstats-mailchimp-unique-opens-data-point" class="wpstats-mashboard-data-point-column wpstats-mashboard-mailchimp-data-point-column">
						<div class="wpstats-dashboard-data-point-header">
							<span id="wpstats-mailchimp-unique-opens-chart-key-icon" class="wpstats-dashboard-data-point-chart-key">&nbsp;</span>
							<span class="wpstats-dashboard-data-point-heading"><?php _e( 'Opens', 'wpstats' ); ?></span>
							<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'The total number of unique subscribers who opened your campaigns during this period.', 'wpstats' ); ?>"></span>
						</div>
						<div class="wpstats-dashboard-data-point-content">
							<span id="wpstats-mailchimp-unique-opens" class="wpstats-data-point-value wpstats-mailchimp-data-point-value"></span>
						</div>
						<div class="wpstats-dashboard-data-point-footer">
							<span id="wpstats-mailchimp-unique-opens-change-direction"></span>
							<span id="wpstats-mailchimp-unique-opens-change" class="wpstats-data-point-change"></span>
							<?php $title = __( 'Opens were made during the previous period.', 'wpstats' ); ?>
							<span id="wpstats-mailchimp-unique-opens-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
						</div>
					</div>

					<!-- Clicks (Unique) -->
					<div id="wpstats-mailchimp-unique-clicks-data-point" class="wpstats-mashboard-data-point-column wpstats-mashboard-mailchimp-data-point-column">
						<div class="wpstats-dashboard-data-point-header">
							<span id="wpstats-mailchimp-unique-clicks-chart-key-icon" class="wpstats-dashboard-data-point-chart-key">&nbsp;</span>
							<span class="wpstats-dashboard-data-point-heading"><?php _e( 'Clicks', 'wpstats' ); ?></span>
							<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'The total number of unique clicks for links across your campaigns during this period.', 'wpstats' ); ?>"></span>
						</div>
						<div class="wpstats-dashboard-data-point-content">
							<span id="wpstats-mailchimp-unique-clicks" class="wpstats-data-point-value wpstats-mailchimp-data-point-value"></span>
						</div>
						<div class="wpstats-dashboard-data-point-footer">
							<span id="wpstats-mailchimp-unique-clicks-change-direction"></span>
							<span id="wpstats-mailchimp-unique-clicks-change" class="wpstats-data-point-change"></span>
							<?php $title = __( 'Clicks were made in the previous period.', 'wpstats' ); ?>
							<span id="wpstats-mailchimp-unique-clicks-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
						</div>
					</div>

					<!-- Unsubscribed -->
					<div id="wpstats-mailchimp-unsubscribed-data-point" class="wpstats-mashboard-data-point-column wpstats-mashboard-mailchimp-data-point-column">
						<div class="wpstats-dashboard-data-point-header">
							<span class="wpstats-dashboard-data-point-heading"><?php _e( 'Unsubscribed', 'wpstats' ); ?></span>
							<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'The total number of users who unsubscribed during this period.', 'wpstats' ); ?>"></span>
						</div>
						<div class="wpstats-dashboard-data-point-content">
							<span id="wpstats-mailchimp-unsubscribed" class="wpstats-data-point-value wpstats-mailchimp-data-point-value"></span>
						</div>
						<div class="wpstats-dashboard-data-point-footer">
							<span id="wpstats-mailchimp-unsubscribed-change-direction"></span>
							<span id="wpstats-mailchimp-unsubscribed-change" class="wpstats-data-point-change"></span>
							<?php $title = __( 'users unsubscribed in the previous period.', 'wpstats' ); ?>
							<span id="wpstats-mailchimp-unsubscribed-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
						</div>
					</div>

					<!-- Subscribers -->
					<div id="wpstats-mailchimp-subscribers-data-point" class="wpstats-mashboard-data-point-column wpstats-mashboard-mailchimp-data-point-column">
						<div class="wpstats-dashboard-data-point-header">
							<span class="wpstats-dashboard-data-point-heading"><?php _e( 'Subscribers', 'wpstats' ); ?></span>
							<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Total number of subscribers your campaigns were sent to during this period (whether successful or not)', 'wpstats' ); ?>"></span>
						</div>
						<div class="wpstats-dashboard-data-point-content">
							<span id="wpstats-mailchimp-subscribers" class="wpstats-data-point-value wpstats-mailchimp-data-point-value"></span>
						</div>
						<div class="wpstats-dashboard-data-point-footer">
							<span id="wpstats-mailchimp-subscribers-change-direction"></span>
							<span id="wpstats-mailchimp-subscribers-change" class="wpstats-data-point-change"></span>
							<?php $title = __( 'was the total number of Subscribers your campaigns were sent to during the previous period.', 'wpstats' ); ?>
							<span id="wpstats-mailchimp-subscribers-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
						</div>
					</div>

					<!-- Open Rate -->
					<div id="wpstats-mailchimp-open-rate-data-point" class="wpstats-mashboard-data-point-column wpstats-mashboard-mailchimp-data-point-column">
						<div class="wpstats-dashboard-data-point-header">
							<span class="wpstats-dashboard-data-point-heading"><?php _e( 'Open Rate', 'wpstats' ); ?></span>
							<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Percentage of successfully delivered campaigns that registered as an open during this period.', 'wpstats' ); ?>"></span>
						</div>
						<div class="wpstats-dashboard-data-point-content">
							<span id="wpstats-mailchimp-open-rate" class="wpstats-data-point-value wpstats-mailchimp-data-point-value  wpstats-data-point-value-percentage"></span>
						</div>
						<div class="wpstats-dashboard-data-point-footer">
							<span id="wpstats-mailchimp-open-rate-change-direction"></span>
							<span id="wpstats-mailchimp-open-rate-change" class="wpstats-data-point-change"></span>
							<?php $title = __( 'was the Open Rate during the previous period.', 'wpstats' ); ?>
							<span id="wpstats-mailchimp-open-rate-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
						</div>
					</div>

					<!-- Click Rate -->
					<div id="wpstats-mailchimp-click-rate-data-point" class="wpstats-mashboard-data-point-column wpstats-mashboard-mailchimp-data-point-column">
						<div class="wpstats-dashboard-data-point-header">
							<span class="wpstats-dashboard-data-point-heading"><?php _e( 'Click Rate', 'wpstats' ); ?></span>
							<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Percentage of successfully delivered campaigns that registered a click during this period.', 'wpstats' ); ?>"></span>
						</div>
						<div class="wpstats-dashboard-data-point-content">
							<span id="wpstats-mailchimp-click-rate" class="wpstats-data-point-value wpstats-mailchimp-data-point-value  wpstats-data-point-value-percentage"></span>
						</div>
						<div class="wpstats-dashboard-data-point-footer">
							<span id="wpstats-mailchimp-click-rate-change-direction"></span>
							<span id="wpstats-mailchimp-click-rate-change" class="wpstats-data-point-change"></span>
							<?php $title = __( 'was the Click Rate during the previous period.', 'wpstats' ); ?>
							<span id="wpstats-mailchimp-click-rate-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
						</div>
					</div>

				</div>

				<!-- MailChimp Details -->
				<div class="wpstats-card-details-container">
					<span class="wpstats-card-details">
						<a class="wpstats-card-details-link wpstats-tooltip" href="<?php echo wpstats_MAILCHIMP_DETAIL_PAGE_URL; ?>" data-tooltip="<?php _e( 'View detailed information about your MailChimp campaigns.', 'wpstats' ); ?>">
							<?php _e( 'View Details', 'wpstats' ); ?>
						</a>
					</span>
				</div>
			</div>
		</div>
	</div>
</div>