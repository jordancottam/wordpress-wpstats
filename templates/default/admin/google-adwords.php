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

	<!-- Google Adwords Container -->
	<div id="wpstats-google-adwords-data-container" class="wpstats-service-detail-container">

		<!-- Top Container (Header, Icons) -->
		<div class="wpstats-detail-top-container">
			<h3 class="wpstats-detail-header"><?php _e( 'Google Adwords', 'wpstats' ); ?>
				<div class="wpstats-detail-icons">
					<span id="wpstats-google-adwords-settings-icon" class="wpstats-setting-tool-tip wpstats-tooltip wpstats-settings-icon wpstats-disabled" data-tooltip="<?php _e( 'Configure Settings for Google Adwords', 'wpstats' ); ?>"></span>
					<span id="wpstats-google-adwords-grid-icon" class="wpstats-grid-icon wpstats-select-tool-tip wpstats-tooltip wpstats-disabled" data-tooltip="<?php _e( 'Show/Hide Google Adwords Data Points', 'wpstats' ); ?>"></span>
					<div id="wpstats-google-adwords-grid-icon-content" class="wpstats-grid-content">
						<p>
							<label>
								<input type="checkbox" class="wpstats-show-data-point" value="wpstats-google-adwords-clicks-data-point" checked>
								<?php _e( 'Clicks', 'wpstats' ); ?>
							</label>
						</p>
						<p>
							<label>
								<input type="checkbox" class="wpstats-show-data-point" value="wpstats-google-adwords-avg-cost-per-click-data-point" checked>
								<?php _e( 'Avg. CPC', 'wpstats' ); ?>
							</label>
						</p>
						<p>
							<label>
								<input type="checkbox" class="wpstats-show-data-point" value="wpstats-google-adwords-cost-data-point" checked>
								<?php _e( 'Cost', 'wpstats' ); ?>
							</label>
						</p>
						<p>
							<label>
								<input type="checkbox" class="wpstats-show-data-point" value="wpstats-google-adwords-impressions-data-point" checked>
								<?php _e( 'Impressions', 'wpstats' ); ?>
							</label>
						</p>
						<p>
							<label>
								<input type="checkbox" class="wpstats-show-data-point" value="wpstats-google-adwords-click-through-rate-data-point" checked>
								<?php _e( 'Click Through Rate', 'wpstats' ); ?>
							</label>
						</p>
						<p>
							<label>
								<input type="checkbox" class="wpstats-show-data-point" value="wpstats-google-adwords-conversions-data-point" checked>
								<?php _e( 'Conversions', 'wpstats' ); ?>
							</label>
						</p>
						<p>
							<label>
								<input type="checkbox" class="wpstats-show-data-point" value="wpstats-google-adwords-avg-cost-per-conversion-data-point" checked>
								<?php _e( 'Cost / Conv', 'wpstats' ); ?>
							</label>
						</p>
						<p>
							<label>
								<input type="checkbox" class="wpstats-show-data-point" value="wpstats-google-adwords-bounce-rate-data-point" checked>
								<?php _e( 'Bounce Rate', 'wpstats' ); ?>
							</label>
						</p>
					</div> <!-- #wpstats-google-adwords-grid-icon-content -->
				</div> <!-- .wpstats-detail-icons -->
			</h3>
			<!-- Integration specific error container -->
			<div id="wpstats-google-adwords-error-container" class="wpstats-integration-detail-error-container wpstats-integration-error-container">
				<p></p>
			</div>
		</div> <!-- .wpstats-detail-top-container -->

		<!-- Chart Key / Figure -->
		<div id="wpstats-detail-chart-key-container" class="wpstats-service-detail-chart-key-container">
			<span id="wpstats-google-adwords-clicks-chart-key-icon" class="wpstats-detail-chart-key-icon">&nbsp;</span>
			<span><?php _e( 'Clicks', 'wpstats' ); ?></span>
			<span id="wpstats-google-adwords-avg-cost-per-click-chart-key-icon" class="wpstats-detail-chart-key-icon">&nbsp;</span>
			<span><?php _e( 'Avg. CPC', 'wpstats' ); ?></span>
		</div>

		<!-- Loading Image -->
		<div id="wpstats-google-adwords-loading-container" class="wpstats-loading-container">
			<img class="wpstats-loading-image" src="<?php echo wpstats_TEMPLATE_IMAGES_URL . 'loading-spin.svg'; ?>" width="64" height="64" alt="<?php _e( 'Loading', 'wpstats' ); ?>">
		</div>

		<!-- Google Adwords Settings Tab Content -->
		<div id="wpstats-google-adwords-settings-content" class="wpstats-settings-tab-settings-content">

			<?php require_once wpstats_API_FUNCTIONS_PATH . 'google-adwords.php'; ?>

			<!-- Account Selection -->
			<div id="wpstats-google-adwords-account-selection-section" class="wpstats-google-adwords-settings-tab-section wpstats-settings-tab-section">
				<h3><?php _e( 'Select an Account', 'wpstats' ); ?></h3>
				<p><?php _e( "Select an account from the list below. The account's campaigns will then be loaded for you.", 'wpstats' ); ?></p>
				<select id="wpstats-google-adwords-account-selection" class="wpstats-card-settings-profiles" data-placeholder="<?php _e( 'Select an Account', 'wpstats' ); ?>"></select>
			</div>

			<!-- Campaign Selection -->
			<div id="wpstats-google-adwords-campaign-selection-section" class="wpstats-google-adwords-settings-tab-section wpstats-settings-tab-section">
				<h3><?php _e( 'Select a Campaign', 'wpstats' ); ?></h3>
				<p id="wpstats-google-adwords-select-campaign-description"><?php _e( 'Select a campaign from the list below that you would like to see data for.', 'wpstats' ); ?></p>
				<select id="wpstats-google-adwords-campaign-selection" class="wpstats-card-settings-profiles" style="transition:none;"></select>
				<button id="wpstats-google-adwords-save-campaign" class="wpstats-settings-tab-save-data-button wpstats-button"><?php _e( 'Save', 'wpstats' ); ?></button>
			</div>

			<!-- Setup (Authorize/Authenticate) -->
			<div id="wpstats-google-adwords-settings-authorize-section" class="wpstats-google-adwords-settings-tab-section wpstats-settings-tab-section">
				<div class="wpstats-card-settings-authorize-container">
					<h3><?php _e( 'Setup', 'wpstats' ); ?></h3>
					<p><?php _e( 'Click the button below to login to Google Adwords and authorize the application.', 'wpstats' ); ?></p>
					<?php $google_adwords_authorization_url = wpstats_api_google_adwords_get_authorization_url( wpstats_GOOGLE_ADWORDS_DETAIL_PAGE_URL ); ?>
					<a id="wpstats-google-adwords-authorize" href="<?php echo esc_attr( $google_adwords_authorization_url ); ?>" class="wpstats-button"><?php _e( 'Setup', 'wpstats' ); ?></a>
				</div>
			</div>

			<!-- Deauthorize/Deauthenticate -->
			<div id="wpstats-google-adwords-settings-deauthorize-section" class="wpstats-google-adwords-settings-tab-section wpstats-settings-tab-section">
				<h3><?php _e( 'Deauthorize', 'wpstats' ); ?></h3>
				<p><?php _e( 'Purge all Google Adwords authentication and cache data from your local install.', 'wpstats' ); ?></p>
				<?php $google_adwords_deauthorize_url = esc_attr( wpstats_api_google_adwords_get_deauthorization_url( wpstats_GOOGLE_ADWORDS_DETAIL_PAGE_URL ) ); ?>
				<a href="<?php echo $google_adwords_deauthorize_url; ?>" id="wpstats-google-adwords-deauthorize" class="wpstats-button"><?php _e( 'Deauthorize', 'wpstats' ); ?></a>
			</div>
		</div>

		<!-- Data Tab Content -->
		<div id="wpstats-google-adwords-data-tab-content">

			<!-- Chart -->
			<div id="wpstats-google-adwords-chart-container" class="wpstats-detail-chart-container wpstats-chart-container">
				<div id="wpstats-google-adwords-chart" class="wpstats-detail-chart"></div>
			</div>

			<!-- Data Points -->
			<div id="wpstats-google-adwords-data-points-container" class="wpstats-data-points-container">

				<!-- Clicks -->
				<div id="wpstats-google-adwords-clicks-data-point" class="wpstats-service-detail-data-point-column wpstats-data-point-column">
					<div class="wpstats-service-detail-data-point-column-header">
						<span class="wpstats-service-detail-data-point-column-header-label"><?php _e( 'Clicks', 'wpstats' ); ?></span>
						<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Total number of times this campaign ad\'s have been clicked during this period.', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-google-adwords-clicks" class="wpstats-data-point-value"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-footer">
						<span id="wpstats-google-adwords-clicks-change-direction" class="wpstats-data-point-change-direction"></span>
						<span id="wpstats-google-adwords-clicks-change" class="wpstats-data-point-change"></span>
						<?php $title = __( 'Clicks were made during the previous period.', 'wpstats' ); ?>
						<span id="wpstats-google-adwords-clicks-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
					</div>
				</div>

				<!-- Avg Cost Per Click -->
				<div id="wpstats-google-adwords-avg-cost-per-click-data-point" class="wpstats-service-detail-data-point-column wpstats-data-point-column">
					<div class="wpstats-service-detail-data-point-column-header">
						<span class="wpstats-service-detail-data-point-column-header-label"><?php _e( 'Avg. CPC', 'wpstats' ); ?></span>
						<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Average Cost Per Click (cost ÷ clicks) during this period.', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-google-adwords-avg-cost-per-click-currency" class="wpstats-currency-data-point"></span>
						<span id="wpstats-google-adwords-avg-cost-per-click" class="wpstats-data-point-value"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-footer">
						<span id="wpstats-google-adwords-avg-cost-per-click-change-direction" class="wpstats-data-point-change-direction"></span>
						<span id="wpstats-google-adwords-avg-cost-per-click-change" class="wpstats-data-point-change"></span>
						<?php $title = __( 'was the Average Cost Per Click in the previous period.', 'wpstats' ); ?>
						<span id="wpstats-google-adwords-avg-cost-per-click-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
					</div>
				</div>

				<!-- Cost -->
				<div id="wpstats-google-adwords-cost-data-point" class="wpstats-service-detail-data-point-column wpstats-data-point-column">
					<div class="wpstats-service-detail-data-point-column-header">
						<span class="wpstats-service-detail-data-point-column-header-label"><?php _e( 'Cost', 'wpstats' ); ?></span>
						<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'The total cost of this campaign during this period.', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-google-adwords-cost-currency" class="wpstats-currency-data-point"></span>
						<span id="wpstats-google-adwords-cost" class="wpstats-data-point-value"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-footer">
						<span id="wpstats-google-adwords-cost-change-direction" class="wpstats-data-point-change-direction"></span>
						<span id="wpstats-google-adwords-cost-change" class="wpstats-data-point-change"></span>
						<?php $title = __( 'was the Cost during the previous period.', 'wpstats' ); ?>
						<span id="wpstats-google-adwords-cost-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
					</div>
				</div>

				<!-- Impressions -->
				<div id="wpstats-google-adwords-impressions-data-point" class="wpstats-service-detail-data-point-column wpstats-data-point-column">
					<div class="wpstats-service-detail-data-point-column-header">
						<span class="wpstats-service-detail-data-point-column-header-label"><?php _e( 'Impressions', 'wpstats' ); ?></span>
						<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'The total number of times this campaign\'s ads have been displayed during this period.', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-google-adwords-impressions" class="wpstats-data-point-value"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-footer">
						<span id="wpstats-google-adwords-impressions-change-direction" class="wpstats-data-point-change-direction"></span>
						<span id="wpstats-google-adwords-impressions-change" class="wpstats-data-point-change"></span>
						<?php $title = __( 'Impressions were made in the previous period.', 'wpstats' ); ?>
						<span id="wpstats-google-adwords-impressions-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
					</div>
				</div>

				<!-- Click Through Rate -->
				<div id="wpstats-google-adwords-click-through-rate-data-point" class="wpstats-service-detail-data-point-column wpstats-data-point-column">
					<div class="wpstats-service-detail-data-point-column-header">
						<span class="wpstats-service-detail-data-point-column-header-label"><?php _e( 'Click Through Rate', 'wpstats' ); ?></span>
						<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'A ratio showing how often people who see your ad(s) end up clicking them (clicks ÷ impressions).', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-google-adwords-click-through-rate" class="wpstats-data-point-value wpstats-data-point-value-percentage"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-footer">
						<span id="wpstats-google-adwords-click-through-rate-change-direction" class="wpstats-data-point-change-direction"></span>
						<span id="wpstats-google-adwords-click-through-rate-change" class="wpstats-data-point-change"></span>
						<?php $title = __( 'was the Click Through Rate in the previous period.', 'wpstats' ); ?>
						<span id="wpstats-google-adwords-click-through-rate-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
					</div>
				</div>

				<!-- Conversions -->
				<div id="wpstats-google-adwords-conversions-data-point" class="wpstats-service-detail-data-point-column wpstats-data-point-column">
					<div class="wpstats-service-detail-data-point-column-header">
						<span class="wpstats-service-detail-data-point-column-header-label"><?php _e( 'Conversions', 'wpstats' ); ?></span>
						<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Total number of clicks that have resulted in some action you have defined (e.g. a sale) to your website during this period.', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-google-adwords-conversions" class="wpstats-data-point-value"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-footer">
						<span id="wpstats-google-adwords-conversions-change-direction" class="wpstats-data-point-change-direction"></span>
						<span id="wpstats-google-adwords-conversions-change" class="wpstats-data-point-change"></span>
						<?php $title = __( 'Conversions were made in the previous period.', 'wpstats' ); ?>
						<span id="wpstats-google-adwords-conversions-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
					</div>
				</div>

				<!-- Avg Cost Per Conversion -->
				<div id="wpstats-google-adwords-avg-cost-per-conversion-data-point" class="wpstats-service-detail-data-point-column wpstats-data-point-column">
					<div class="wpstats-service-detail-data-point-column-header">
						<span class="wpstats-service-detail-data-point-column-header-label"><?php _e( 'Cost / Conv', 'wpstats' ); ?></span>
						<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Average Cost Per Conversion during this period (total cost ÷ total conversions).', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-google-adwords-avg-cost-per-conversion-currency" class="wpstats-currency-data-point"></span>
						<span id="wpstats-google-adwords-avg-cost-per-conversion" class="wpstats-data-point-value"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-footer">
						<span id="wpstats-google-adwords-avg-cost-per-conversion-change-direction" class="wpstats-data-point-change-direction"></span>
						<span id="wpstats-google-adwords-avg-cost-per-conversion-change" class="wpstats-data-point-change"></span>
						<?php $title = __( 'was the Average Cost Per Conversion during the previous period.', 'wpstats' ); ?>
						<span id="wpstats-google-adwords-avg-cost-per-conversion-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
					</div>
				</div>

				<!-- Bounce Rate -->
				<div id="wpstats-google-adwords-bounce-rate-data-point" class="wpstats-service-detail-data-point-column wpstats-data-point-column">
					<div class="wpstats-service-detail-data-point-column-header">
						<span class="wpstats-service-detail-data-point-column-header-label"><?php _e( 'Bounce Rate', 'wpstats' ); ?></span>
						<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Bounce Rate is the percentage of single-page sessions (i.e. sessions in which the person left your site from the entrance page without interacting with the page).', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-google-adwords-bounce-rate" class="wpstats-data-point-value wpstats-data-point-value-percentage"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-footer">
						<span id="wpstats-google-adwords-bounce-rate-change-direction" class="wpstats-data-point-change-direction"></span>
						<span id="wpstats-google-adwords-bounce-rate-change" class="wpstats-data-point-change"></span>
						<?php $title = __( 'was the Bounce Rate during the previous period.', 'wpstats' ); ?>
						<span id="wpstats-google-adwords-bounce-rate-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
					</div>
				</div>
			</div> <!-- #wpstats-google-adwords-data-points-container -->

			<!-- Tables -->
			<div class="wpstats-service-detail-data-tables-container">
				<div class="wpstats-detail-data-table-row">

					<!-- Campaigns (account-level) -->
					<div id="wpstats-detail-google-adwords-account-level-campaigns-data-table-column" class="wpstats-service-detail-data-table-column">
						<div id="wpstats-detail-google-adwords-account-level-campaigns-data-table-column-content" class="wpstats-data-table-column-content wpstats-service-detail-data-table-column-content">
							<h2>
								<?php _e( 'Campaigns', 'wpstats' ); ?>
								<span class="wpstats-data-point-heading-info wpstats-data-table-heading-info wpstats-tooltip" title="<?php _e( 'The Bounce Rate over the current period.', 'wpstats' ); ?>"></span>
							</h2>
							<div id="wpstats-google-adwords-account-level-campaigns-data-error-container" class="wpstats-top-data-error-container">
								<p><?php _e( 'No data available for this period.', 'wpstats' ); ?></p>
							</div>
							<table id="wpstats-google-adwords-account-level-campaigns-table" class="wpstats-service-detail-data-table wp-list-table widefat">
								<thead>
								<tr>
									<th><?php _e( 'Campaign Name', 'wpstats' ); ?></th>
									<th><?php _e( 'Clicks', 'wpstats' ); ?></th>
									<th><?php _e( 'Impressions', 'wpstats' ); ?></th>
									<th><?php _e( 'CTR', 'wpstats' ); ?></th>
									<th><?php _e( 'Avg. CPC', 'wpstats' ); ?></th>
									<th><?php _e( 'Cost', 'wpstats' ); ?></th>
									<th><?php _e( 'Conversions', 'wpstats' ); ?></th>
								</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>

					<!-- Top Keyword Performance (account-level) -->
					<div id="wpstats-detail-google-adwords-account-level-top-keyword-performance-data-table-column" class="wpstats-service-detail-data-table-column">
						<div id="wpstats-detail-google-adwords-account-level-top-keyword-performance-data-table-column-content" class="wpstats-data-table-column-content wpstats-service-detail-data-table-column-content">
							<h2>
								<?php _e( 'Top Keyword Performance', 'wpstats' ); ?>
								<span class="wpstats-data-point-heading-info wpstats-data-table-heading-info wpstats-tooltip" title="<?php _e( 'The Bounce Rate over the current period.', 'wpstats' ); ?>"></span>
							</h2>
							<div id="wpstats-google-adwords-account-level-top-keyword-performance-data-error-container" class="wpstats-top-data-error-container">
								<p><?php _e( 'No data available for this period.', 'wpstats' ); ?></p>
							</div>
							<table id="wpstats-google-adwords-account-level-top-keyword-performance-table" class="wpstats-service-detail-data-table wp-list-table widefat">
								<thead>
								<tr>
									<th><?php _e( 'Keyword', 'wpstats' ); ?></th>
									<th><?php _e( 'Campaign Name', 'wpstats' ); ?></th>
									<th><?php _e( 'Clicks', 'wpstats' ); ?></th>
									<th><?php _e( 'Impressions', 'wpstats' ); ?></th>
									<th><?php _e( 'CTR', 'wpstats' ); ?></th>
									<th><?php _e( 'Avg. CPC', 'wpstats' ); ?></th>
									<th><?php _e( 'Cost', 'wpstats' ); ?></th>
									<th><?php _e( 'Conversions', 'wpstats' ); ?></th>
								</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div> <!-- .wpstats-detail-data-table-row -->

				<div class="wpstats-detail-data-table-row">

					<!-- Ad Groups (campaign-level) -->
					<div id="wpstats-detail-google-adwords-campaign-level-ad-groups-data-table-column" class="wpstats-service-detail-data-table-column">
						<div id="wpstats-detail-google-adwords-campaign-level-ad-groups-data-table-column-content" class="wpstats-data-table-column-content wpstats-service-detail-data-table-column-content">
							<h2>
								<?php _e( 'Ad Groups', 'wpstats' ); ?>
								<span class="wpstats-data-point-heading-info wpstats-data-table-heading-info wpstats-tooltip" title="<?php _e( 'The Bounce Rate over the current period.', 'wpstats' ); ?>"></span>
							</h2>
							<div id="wpstats-google-adwords-campaign-level-ad-groups-data-error-container" class="wpstats-top-data-error-container">
								<p><?php _e( 'No data available for this period.', 'wpstats' ); ?></p>
							</div>
							<table id="wpstats-google-adwords-campaign-level-ad-groups-table" class="wpstats-service-detail-data-table wp-list-table widefat">
								<thead>
								<tr>
									<th><?php _e( 'Ad Group Name', 'wpstats' ); ?></th>
									<th><?php _e( 'Clicks', 'wpstats' ); ?></th>
									<th><?php _e( 'Impressions', 'wpstats' ); ?></th>
									<th><?php _e( 'CTR', 'wpstats' ); ?></th>
									<th><?php _e( 'Avg. CPC', 'wpstats' ); ?></th>
									<th><?php _e( 'Cost', 'wpstats' ); ?></th>
									<th><?php _e( 'Conversions', 'wpstats' ); ?></th>
								</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>

					<!-- Top Keyword Performance (campaign-level) -->
					<div id="wpstats-detail-google-adwords-campaign-level-top-keyword-performance-data-table-column" class="wpstats-service-detail-data-table-column">
						<div id="wpstats-detail-google-adwords-campaign-level-top-keyword-performance-data-table-column-content" class="wpstats-data-table-column-content wpstats-service-detail-data-table-column-content">
							<h2>
								<?php _e( 'Top Keyword Performance', 'wpstats' ); ?>
								<span class="wpstats-data-point-heading-info wpstats-data-table-heading-info wpstats-tooltip" title="<?php _e( 'The Bounce Rate over the current period.', 'wpstats' ); ?>"></span>
							</h2>
							<div id="wpstats-google-adwords-campaign-level-top-keyword-performance-data-error-container" class="wpstats-top-data-error-container">
								<p><?php _e( 'No data available for this period.', 'wpstats' ); ?></p>
							</div>
							<table id="wpstats-google-adwords-campaign-level-top-keyword-performance-table" class="wpstats-service-detail-data-table wp-list-table widefat">
								<thead>
								<tr>
									<th><?php _e( 'Keyword', 'wpstats' ); ?></th>
									<th><?php _e( 'Ad Group Name', 'wpstats' ); ?></th>
									<th><?php _e( 'Clicks', 'wpstats' ); ?></th>
									<th><?php _e( 'Impressions', 'wpstats' ); ?></th>
									<th><?php _e( 'CTR', 'wpstats' ); ?></th>
									<th><?php _e( 'Avg. CPC', 'wpstats' ); ?></th>
									<th><?php _e( 'Cost', 'wpstats' ); ?></th>
									<th><?php _e( 'Conversions', 'wpstats' ); ?></th>
								</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div> <!-- .wpstats-detail-data-table-row -->
			</div> <!-- .wpstats-service-detail-data-tables-container -->
		</div> <!-- #wpstats-google-adwords-data-tab-content -->
	</div> <!-- #wpstats-google-adwords-data-container -->
</div> <!-- .wrap -->