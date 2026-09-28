<?php

defined( 'ABSPATH' ) or exit();

?>

<div class="wrap">

	<div id="wpstats-logo-container">
		<?php $mashboard_page_url = esc_attr( admin_url() . 'admin.php?page=wpstats-mashboard' ); ?>
		<?php $brand_logo_image_url = esc_attr( get_option( 'wpstats_brand_logo_image_url' ) ); ?>
		<a class="wpstats-shadowless" href="<?php echo $mashboard_page_url; ?>"><img src="<?php echo $brand_logo_image_url; ?>"></a>
	</div>

	<div id="wpstats-date-range-container">
		<!-- Start Date & End Date -->
		<label class="wpstats-query-parameter-label" for="start_date"><?php _e( 'Date Range:', 'wpstats' ); ?></label>
		<input class="wpstats-date" type="text" id="start_date" name="start_date" required="required" value="">
		<input class="wpstats-date" type="text" id="end_date" name="end_date" required="required" value="">
		<button class="wpstats-button" id="date_range" type="submit" name="date_range" value="-1"><?php _e( 'Update', 'wpstats' ); ?></button>
	</div>

	<!-- Page Loading Container -->
	<div id="wpstats-page-loading-container" class="wpstats-loading-container">
		<img class="wpstats-loading-image" src="<?php echo wpstats_TEMPLATE_IMAGES_URL . 'loading-spin.svg'; ?>" width="64" height="64">
	</div>

	<!-- Page Error Container -->
	<div id="wpstats-page-error-container" class="wpstats-page-error-container wpstats-error-container">
		<p></p>
	</div>

	<!-- MailChimp Container -->
	<div id="wpstats-mailchimp-data-container" class="wpstats-service-detail-container">

		<!-- Top Container (Header, Icons) -->
		<div class="wpstats-detail-top-container">
			<h3 class="wpstats-detail-header"><?php _e( 'MailChimp', 'wpstats' ); ?>
				<div class="wpstats-detail-icons">
					<span id="wpstats-mailchimp-settings-icon" class="wpstats-setting-tool-tip wpstats-tooltip wpstats-settings-icon wpstats-disabled" data-tooltip="<?php _e( 'Configure Settings for MailChimp', 'wpstats' ); ?>"></span>
					<span id="wpstats-mailchimp-grid-icon" class="wpstats-grid-icon wpstats-select-tool-tip wpstats-tooltip wpstats-disabled" data-tooltip="<?php _e( 'Show/Hide MailChimp Data Points', 'wpstats' ); ?>"></span>
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
								<input type="checkbox" class="wpstats-show-data-point" value="wpstats-mailchimp-open-rate-data-point" checked>
								<?php _e( 'Open Rate', 'wpstats' ); ?>
							</label>
						</p>
						<p>
							<label>
								<input type="checkbox" class="wpstats-show-data-point" value="wpstats-mailchimp-click-rate-data-point" checked>
								<?php _e( 'Click Rate', 'wpstats' ); ?>
							</label>
						</p>
						<p>
							<label>
								<input type="checkbox" class="wpstats-show-data-point" value="wpstats-mailchimp-industry-average-open-rate-data-point" checked>
								<?php _e( 'Industry Average Open Rate', 'wpstats' ); ?>
							</label>
						</p>
						<p>
							<label>
								<input type="checkbox" class="wpstats-show-data-point" value="wpstats-mailchimp-bounces-data-point" checked>
								<?php _e( 'Bounces', 'wpstats' ); ?>
							</label>
						</p>
					</div> <!-- #wpstats-mailchimp-grid-icon-content -->
				</div> <!-- .wpstats-detail-icons -->
			</h3>
			<!-- Integration specific error container -->
			<div id="wpstats-mailchimp-error-container" class="wpstats-integration-detail-error-container wpstats-integration-error-container">
				<p></p>
			</div>
		</div> <!-- .wpstats-detail-top-container -->

		<!-- Chart Key / Figure -->
		<div id="wpstats-detail-chart-key-container" class="wpstats-service-detail-chart-key-container">
			<span id="wpstats-mailchimp-unique-opens-chart-key-icon" class="wpstats-detail-chart-key-icon">&nbsp;</span>
			<span><?php _e( 'Opens', 'wpstats' ); ?></span>
			<span id="wpstats-mailchimp-unique-clicks-chart-key-icon" class="wpstats-detail-chart-key-icon">&nbsp;</span>
			<span><?php _e( 'Clicks', 'wpstats' ); ?></span>
		</div>

		<!-- Loading Image -->
		<div id="wpstats-mailchimp-loading-container" class="wpstats-loading-container">
			<img class="wpstats-loading-image" src="<?php echo wpstats_TEMPLATE_IMAGES_URL . 'loading-spin.svg'; ?>" width="64" height="64" alt="<?php _e( 'Loading', 'wpstats' ); ?>">
		</div>

		<!-- MailChimp Settings Tab Content -->
		<div id="wpstats-mailchimp-settings-content" class="wpstats-settings-tab-settings-content">

			<?php require_once wpstats_API_FUNCTIONS_PATH . 'mailchimp.php'; ?>

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

			<!-- Setup (Authorize/Authenticate) -->
			<div id="wpstats-mailchimp-settings-authorize-section" class="wpstats-mailchimp-settings-tab-section wpstats-settings-tab-section">
				<div class="wpstats-card-settings-authorize-container">
					<h3><?php _e( 'Setup', 'wpstats' ); ?></h3>
					<p><?php _e( 'Click the button below to login to your MailChimp account and authorize the wpstats application to allow us to display data for your campaigns.', 'wpstats' ); ?></p>
					<?php $mailchimp_authorization_url = wpstats_api_mailchimp_get_authorization_url( wpstats_MAILCHIMP_DETAIL_PAGE_URL ); ?>
					<a id="wpstats-mailchimp-authorize" href="<?php echo esc_attr( $mailchimp_authorization_url ); ?>" class="wpstats-button"><?php _e( 'Setup', 'wpstats' ); ?></a>
				</div>
			</div>

			<!-- Deauthorize/Deauthenticate -->
			<div id="wpstats-mailchimp-settings-deauthorize-section" class="wpstats-mailchimp-settings-tab-section wpstats-settings-tab-section">
				<h3><?php _e( 'Deauthorize', 'wpstats' ); ?></h3>
				<p><?php _e( 'Purge all MailChimp authentication and cache data from your local install.', 'wpstats' ); ?></p>
				<?php $mailchimp_deauthorize_url = esc_attr( wpstats_api_mailchimp_get_deauthorization_url( wpstats_MAILCHIMP_DETAIL_PAGE_URL ) ); ?>
				<a href="<?php echo $mailchimp_deauthorize_url; ?>" id="wpstats-mailchimp-deauthorize" class="wpstats-button"><?php _e( 'Deauthorize', 'wpstats' ); ?></a>
			</div>
		</div>

		<!-- Data Tab Content -->
		<div id="wpstats-mailchimp-data-tab-content">

			<!-- Chart -->
			<div id="wpstats-mailchimp-chart-container" class="wpstats-detail-chart-container wpstats-chart-container">
				<div id="wpstats-mailchimp-chart" class="wpstats-detail-chart"></div>
			</div>

			<!-- Data Points -->
			<div id="wpstats-mailchimp-data-points-container" class="wpstats-data-points-container">

				<!-- Opens (Unique) -->
				<div id="wpstats-mailchimp-unique-opens-data-point" class="wpstats-service-detail-data-point-column wpstats-data-point-column">
					<div class="wpstats-service-detail-data-point-column-header">
						<span class="wpstats-service-detail-data-point-column-header-label"><?php _e( 'Opens', 'wpstats' ); ?></span>
						<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'The total number of unique subscribers who opened your campaigns during this period.', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-mailchimp-unique-opens" class="wpstats-data-point-value"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-footer">
						<span id="wpstats-mailchimp-unique-opens-change-direction" class="wpstats-data-point-change-direction"></span>
						<span id="wpstats-mailchimp-unique-opens-change" class="wpstats-data-point-change"></span>
						<?php $title = __( 'Opens were made during the previous period.', 'wpstats' ); ?>
						<span id="wpstats-mailchimp-unique-opens-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
					</div>
				</div>

				<!-- Clicks (Unique) -->
				<div id="wpstats-mailchimp-unique-clicks-data-point" class="wpstats-service-detail-data-point-column wpstats-data-point-column">
					<div class="wpstats-service-detail-data-point-column-header">
						<span class="wpstats-service-detail-data-point-column-header-label"><?php _e( 'Clicks', 'wpstats' ); ?></span>
						<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'The total number of unique clicks for links across your campaigns during this period.', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-mailchimp-unique-clicks" class="wpstats-data-point-value"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-footer">
						<span id="wpstats-mailchimp-unique-clicks-change-direction" class="wpstats-data-point-change-direction"></span>
						<span id="wpstats-mailchimp-unique-clicks-change" class="wpstats-data-point-change"></span>
						<?php $title = __( 'Clicks were made during the previous period.', 'wpstats' ); ?>
						<span id="wpstats-mailchimp-unique-clicks-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
					</div>
				</div>

				<!-- Unsubscribed -->
				<div id="wpstats-mailchimp-unsubscribed-data-point" class="wpstats-service-detail-data-point-column wpstats-data-point-column">
					<div class="wpstats-service-detail-data-point-column-header">
						<span class="wpstats-service-detail-data-point-column-header-label"><?php _e( 'Unsubscribed', 'wpstats' ); ?></span>
						<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'The total number of users who unsubscribed during this period.', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-mailchimp-unsubscribed" class="wpstats-data-point-value"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-footer">
						<span id="wpstats-mailchimp-unsubscribed-change-direction" class="wpstats-data-point-change-direction"></span>
						<span id="wpstats-mailchimp-unsubscribed-change" class="wpstats-data-point-change"></span>
						<?php $title = __( 'users unsubscribed in the previous period.', 'wpstats' ); ?>
						<span id="wpstats-mailchimp-unsubscribed-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
					</div>
				</div>

				<!-- Subscribers -->
				<div id="wpstats-mailchimp-subscribers-data-point" class="wpstats-service-detail-data-point-column wpstats-data-point-column">
					<div class="wpstats-service-detail-data-point-column-header">
						<span class="wpstats-service-detail-data-point-column-header-label"><?php _e( 'Subscribers', 'wpstats' ); ?></span>
						<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Total number of subscribers your campaigns were sent to during this period (whether successful or not)', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-mailchimp-subscribers" class="wpstats-data-point-value"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-footer">
						<span id="wpstats-mailchimp-subscribers-change-direction" class="wpstats-data-point-change-direction"></span>
						<span id="wpstats-mailchimp-subscribers-change" class="wpstats-data-point-change"></span>
						<?php $title = __( 'Subscribers were made during the previous period.', 'wpstats' ); ?>
						<span id="wpstats-mailchimp-subscribers-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
					</div>
				</div>

				<!-- Open Rate -->
				<div id="wpstats-mailchimp-open-rate-data-point" class="wpstats-service-detail-data-point-column wpstats-data-point-column">
					<div class="wpstats-service-detail-data-point-column-header">
						<span class="wpstats-service-detail-data-point-column-header-label"><?php _e( 'Open Rate', 'wpstats' ); ?></span>
						<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Percentage of successfully delivered campaigns that registered as an open during this period.', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-mailchimp-open-rate" class="wpstats-data-point-value wpstats-data-point-value-percentage"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-footer">
						<span id="wpstats-mailchimp-open-rate-change-direction" class="wpstats-data-point-change-direction"></span>
						<span id="wpstats-mailchimp-open-rate-change" class="wpstats-data-point-change"></span>
						<?php $title = __( 'was the Open Rate during the previous period.', 'wpstats' ); ?>
						<span id="wpstats-mailchimp-open-rate-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
					</div>
				</div>

				<!-- Click Rate -->
				<div id="wpstats-mailchimp-click-rate-data-point" class="wpstats-service-detail-data-point-column wpstats-data-point-column">
					<div class="wpstats-service-detail-data-point-column-header">
						<span class="wpstats-service-detail-data-point-column-header-label"><?php _e( 'Click Rate', 'wpstats' ); ?></span>
						<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Percentage of successfully delivered campaigns that registered a click during this period.', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-mailchimp-click-rate" class="wpstats-data-point-value wpstats-data-point-value-percentage"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-footer">
						<span id="wpstats-mailchimp-click-rate-change-direction" class="wpstats-data-point-change-direction"></span>
						<span id="wpstats-mailchimp-click-rate-change" class="wpstats-data-point-change"></span>
						<?php $title = __( 'was the Click Rate during the previous period.', 'wpstats' ); ?>
						<span id="wpstats-mailchimp-click-rate-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
					</div>
				</div>

				<!-- Industry Average Open Rate -->
				<div id="wpstats-mailchimp-industry-average-open-rate-data-point" class="wpstats-service-detail-data-point-column wpstats-data-point-column">
					<div class="wpstats-service-detail-data-point-column-header">
						<span class="wpstats-service-detail-data-point-column-header-label"><?php _e( 'Industry Avg Open Rate', 'wpstats' ); ?></span>
						<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Average percentage of opens for campaigns in the selected industry set for your account.', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-mailchimp-industry-average-open-rate" class="wpstats-data-point-value wpstats-data-point-value-percentage"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-footer">
						<span id="wpstats-mailchimp-industry-average-open-rate-change-direction" class="wpstats-data-point-change-direction"></span>
						<span id="wpstats-mailchimp-industry-average-open-rate-change" class="wpstats-data-point-change"></span>
						<?php $title = __( 'was the Industry Average Open Rate in the previous period.', 'wpstats' ); ?>
						<span id="wpstats-mailchimp-industry-average-open-rate-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
					</div>
				</div>

				<!-- Bounces -->
				<div id="wpstats-mailchimp-bounces-data-point" class="wpstats-service-detail-data-point-column wpstats-data-point-column">
					<div class="wpstats-service-detail-data-point-column-header">
						<span class="wpstats-service-detail-data-point-column-header-label"><?php _e( 'Bounced', 'wpstats' ); ?></span>
						<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Total number of recipients that registered as a hard or soft bounce for your campaigns during this period.', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-mailchimp-bounces" class="wpstats-data-point-value"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-footer">
						<span id="wpstats-mailchimp-bounces-change-direction" class="wpstats-data-point-change-direction"></span>
						<span id="wpstats-mailchimp-bounces-change" class="wpstats-data-point-change"></span>
						<?php $title = __( 'Bounces were registered during the previous period.', 'wpstats' ); ?>
						<span id="wpstats-mailchimp-bounces-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
					</div>
				</div>
			</div> <!-- #wpstats-mailchimp-data-points-container -->

			<!-- Tables -->
			<div class="wpstats-service-detail-data-tables-container">
				<div class="wpstats-detail-data-table-row">
					<!-- Top Campaigns -->
					<div id="wpstats-detail-mailchimp-top-campaigns-data-table-column" class="wpstats-service-detail-data-table-column">
						<div id="wpstats-detail-mailchimp-top-campaigns-data-table-column-content" class="wpstats-data-table-column-content wpstats-service-detail-data-table-column-content">
							<h2><?php _e( 'Top 5 Campaigns', 'wpstats' ); ?></h2>
							<div id="wpstats-mailchimp-top-campaigns-data-error-container" class="wpstats-top-data-error-container">
								<p><?php _e( 'No data available for this period.', 'wpstats' ); ?></p>
							</div>
							<table id="wpstats-mailchimp-top-campaigns-table" class="wpstats-service-detail-data-table wp-list-table widefat">
								<thead>
									<tr>
										<th><?php _e( 'Campaign Name', 'wpstats' ); ?></th>
										<th><?php _e( 'Opens', 'wpstats' ); ?></th>
										<th><?php _e( 'Clicks', 'wpstats' ); ?></th>
										<th><?php _e( 'Unsubscribed', 'wpstats' ); ?></th>
										<th><?php _e( 'Open Rate', 'wpstats' ); ?></th>
										<th><?php _e( 'Click Rate', 'wpstats' ); ?></th>
										<th><?php _e( 'Date Sent', 'wpstats' ); ?></th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
					<!-- Top Lists -->
					<div id="wpstats-detail-mailchimp-top-lists-data-table-column" class="wpstats-service-detail-data-table-column">
						<div id="wpstats-detail-mailchimp-top-lists-data-table-column-content" class="wpstats-data-table-column-content wpstats-service-detail-data-table-column-content">
							<h2><?php _e( 'Top 5 Lists', 'wpstats' ); ?></h2>
							<div id="wpstats-mailchimp-top-lists-data-error-container" class="wpstats-top-data-error-container">
								<p><?php _e( 'No data available for this period.', 'wpstats' ); ?></p>
							</div>
							<table id="wpstats-mailchimp-top-lists-table" class="wpstats-service-detail-data-table wp-list-table widefat">
								<thead>
									<tr>
										<th><?php _e( 'List Name', 'wpstats' ); ?></th>
										<th><?php _e( 'Avg. Open Rate', 'wpstats' ); ?></th>
										<th><?php _e( 'Avg. Click Rate', 'wpstats' ); ?></th>
										<th><?php _e( 'Subscribers', 'wpstats' ); ?></th>
										<th><?php _e( 'Avg. Subscribe Rate', 'wpstats' ); ?></th>
										<th><?php _e( 'Avg. Unsubscribe Rate', 'wpstats' ); ?></th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div> <!-- .wpstats-detail-data-table-row -->
			</div> <!-- .wpstats-service-detail-data-tables-container -->
		</div> <!-- #wpstats-mailchimp-data-tab-content -->
	</div> <!-- #wpstats-mailchimp-data-container -->
</div> <!-- .wrap -->