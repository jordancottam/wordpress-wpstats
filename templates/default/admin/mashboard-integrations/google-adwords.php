<?php

// Prevent direct access
defined( 'ABSPATH' ) or exit();

?>

<div id="googleadwords_11" class="wpstats-card-container">
	<div class="wpstats-card">
		<div class="wpstats-card-header">
			<span class="wpstats-card-drag-icon"></span>
			<h4 class="wpstats-card-heading"><?php _e( 'Google Adwords', 'wpstats' ); ?></h4>
			<span id="wpstats-google-adwords-settings-icon" class="wpstats-settings-icon wpstats-setting-tool-tip wpstats-tooltip wpstats-disabled" data-tooltip="<?php _e( 'Configure Settings for Google Adwords', 'wpstats' ); ?>">
			</span>
			<span id="wpstats-google-adwords-grid-icon" class="wpstats-grid-icon wpstats-select-tool-tip wpstats-tooltip wpstats-disabled" data-tooltip="<?php _e( 'Show/Hide Google Adwords Data Points', 'wpstats' ); ?>">
			</span>
			<div id="wpstats-google-adwords-grid-icon-content" class="wpstats-grid-content">
				<p>
					<label>
						<input type="checkbox" class="wpstats-show-data-point" value="wpstats-google-adwords-cost-data-point" checked>
						<?php _e( 'Cost', 'wpstats' ); ?>
					</label>
				</p>
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
						<input type="checkbox" class="wpstats-show-data-point" value="wpstats-google-adwords-conversions-data-point" checked>
						<?php _e( 'Conversions', 'wpstats' ); ?>
					</label>
				</p>
			</div>
		</div>
		<div id="wpstats-google-adwords-card-content" class="wpstats-card-content">

			<!-- Integration specific error container -->
			<div id="wpstats-google-adwords-error-container" class="wpstats-integration-error-container">
				<p></p>
			</div>

			<!-- Loading Container -->
			<div id="wpstats-google-adwords-loading-container" class="wpstats-loading-container wpstats-chart-loading-container">
				<img class="wpstats-loading-image" src="<?php echo wpstats_TEMPLATE_IMAGES_URL . 'loading-spin.svg'; ?>" height="64" width="64">
			</div>

			<!-- Settings Content -->
			<div id="wpstats-google-adwords-settings-content">
				<?php require_once wpstats_API_FUNCTIONS_PATH . 'google-adwords.php'; ?>
				<?php $api_authenticate_url = wpstats_api_google_adwords_get_authorization_url( wpstats_MASHBOARD_PAGE_URL ); ?>

				<!-- Add Account(s) -->
				<div id="wpstats-google-adwords-add-accounts-section" class="wpstats-google-adwords-settings-tab-section wpstats-settings-tab-section">
					<h3><?php _e( 'Add Account(s)', 'wpstats' ); ?></h3>
					<p><?php _e( 'Click the button below to login with a Google Adwords account and make all of the account(s) that you have access to available for selection below.', 'wpstats' ); ?></p>
					<a id="wpstats-google-adwords-add-accounts" href="<?php echo esc_attr( $api_authenticate_url ); ?>" class="wpstats-button"><?php _e( 'Authorize', 'wpstats' ); ?></a>
				</div>

				<!-- Account Selection -->
				<div id="wpstats-google-adwords-account-selection-section" class="wpstats-google-adwords-settings-tab-section wpstats-settings-tab-section">
					<h3><?php _e( 'Select an Account', 'wpstats' ); ?></h3>
					<p><?php _e( "Below are all the account(s) that you have access to through your Google Adwords account(s), or those which have already been added for this license key. Click on any of the accounts in order to be able to select a campaign.", 'wpstats' ); ?></p>
					<select id="wpstats-google-adwords-account-selection" class="wpstats-card-settings-profiles"></select>
				</div>

				<!-- Campaign Selection -->
				<div id="wpstats-google-adwords-campaign-selection-section" class="wpstats-google-adwords-settings-tab-section wpstats-settings-tab-section">
					<h3><?php _e( 'Select a Campaign', 'wpstats' ); ?></h3>
					<p><?php _e( 'Select a campaign from the list below that you would like to see data for.', 'wpstats' ); ?></p>
					<select id="wpstats-google-adwords-campaign-selection" class="wpstats-card-settings-profiles"></select>
					<button id="wpstats-google-adwords-save-campaign" class="wpstats-settings-tab-save-data-button wpstats-button"><?php _e( 'Save', 'wpstats' ); ?></button>
				</div>

				<!-- Setup / Authorize / Authenticate -->
				<div id="wpstats-google-adwords-settings-authorize-section"  class="wpstats-google-adwords-settings-tab-section wpstats-settings-tab-section">
					<h3><?php _e( 'Setup', 'wpstats' ); ?></h3>
					<p><?php _e( 'Click the button below to login to Google and allow the application to access your account(s) and campaign(s). You will then be able to select a campaign to display data for. Please make sure you login with an account that has setup at least one campaign.', 'wpstats' ); ?></p>
					<a id="wpstats-google-adwords-authorize" class="wpstats-button"><?php _e( 'Setup', 'wpstats' ); ?></a>
				</div>

				<!-- Deauthorize / Deauthenticate -->
				<div id="wpstats-google-adwords-settings-deauthorize-section" class="wpstats-google-adwords-settings-tab-section wpstats-settings-tab-section">
					<h3><?php _e( 'Deauthorize Site only', 'wpstats' ); ?></h3>
					<p><?php _e( 'Purge all Google Adwords authentication and cache data from your local install, but allow other sites using the same license key to be able to continue using any accounts that have been authorized using this license key.', 'wpstats' ); ?></p>
					<a href="#" id="wpstats-google-adwords-deauthorize" class="wpstats-button"><?php _e( 'Deauthorize', 'wpstats' ); ?></a>
					<h3><?php _e( 'Deauthorize License-wide', 'wpstats' ); ?></h3>
					<p><?php _e( 'Purge all Google Adwords authentication and cache data from your local install and remove any accounts authorized for this license key. Any sites using the same license key won\'t be able to see data for any of the accounts authorized for this license key unless someone with access to those accounts reauthorizes.', 'wpstats' ); ?></p>
					<a href="#" id="wpstats-google-adwords-deauthorize-license" class="wpstats-button"><?php _e( 'Deauthorize', 'wpstats' ); ?></a>
				</div>
			</div>

			<!-- Data Content (chart & data points) -->
			<div id="wpstats-google-adwords-data-content">

				<!-- Chart -->
				<div id="wpstats-google-adwords-chart-container" class="wpstats-mashboard-chart-container wpstats-chart-container">
					<div id="wpstats-google-adwords-chart" class="wpstats-mashboard-chart"></div>
				</div>

				<!-- Data Points -->
				<div id="wpstats-google-adwords-data-points-container" class="wpstats-data-points-container">

					<!-- Clicks -->
					<div id="wpstats-google-adwords-clicks-data-point" class="wpstats-mashboard-data-point-column wpstats-mashboard-google-adwords-data-point-column">
						<div class="wpstats-dashboard-data-point-header">
							<span id="wpstats-google-adwords-clicks-chart-key-icon" class="wpstats-dashboard-data-point-chart-key">&nbsp;</span>
							<span class="wpstats-dashboard-data-point-heading"><?php _e( 'Clicks', 'wpstats' ); ?></span>
							<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Total number of times this campaign ad\'s have been clicked during this period.', 'wpstats' ); ?>"></span>
						</div>
						<div class="wpstats-dashboard-data-point-content">
							<span id="wpstats-google-adwords-clicks" class="wpstats-data-point-value wpstats-google-adwords-data-point-value"></span>
						</div>
						<div class="wpstats-dashboard-data-point-footer">
							<span id="wpstats-google-adwords-clicks-change-direction"></span>
							<span id="wpstats-google-adwords-clicks-change" class="wpstats-data-point-change"></span>
							<?php $title = __( 'Clicks were made during the previous period.', 'wpstats' ); ?>							<span id="wpstats-google-adwords-clicks-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
						</div>
					</div>

					<!-- Avg Cost Per Click -->
					<div id="wpstats-google-adwords-avg-cost-per-click-data-point" class="wpstats-mashboard-data-point-column wpstats-mashboard-google-adwords-data-point-column">
						<div class="wpstats-dashboard-data-point-header">
							<span id="wpstats-google-adwords-avg-cost-per-click-chart-key-icon" class="wpstats-dashboard-data-point-chart-key">&nbsp;</span>
							<span class="wpstats-dashboard-data-point-heading"><?php _e( 'Avg. CPC', 'wpstats' ); ?></span>
							<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Average Cost Per Click (cost ÷ clicks) during this period.', 'wpstats' ); ?>"></span>
						</div>
						<div class="wpstats-dashboard-data-point-content">
							<span id="wpstats-google-adwords-avg-cost-per-click-currency" class="wpstats-currency-data-point"></span>
							<span id="wpstats-google-adwords-avg-cost-per-click" class="wpstats-data-point-value wpstats-google-adwords-data-point-value"></span>
						</div>
						<div class="wpstats-dashboard-data-point-footer">
							<span id="wpstats-google-adwords-avg-cost-per-click-change-direction"></span>
							<span id="wpstats-google-adwords-avg-cost-per-click-change" class="wpstats-data-point-change"></span>
							<?php $title = __( 'was the Average Cost Per Click in the previous period.', 'wpstats' ); ?>
							<span id="wpstats-google-adwords-avg-cost-per-click-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
						</div>
					</div>

					<!-- Cost -->
					<div id="wpstats-google-adwords-cost-data-point" class="wpstats-mashboard-data-point-column wpstats-mashboard-google-adwords-data-point-column">
						<div class="wpstats-dashboard-data-point-header">
							<span class="wpstats-dashboard-data-point-heading"><?php _e( 'Cost', 'wpstats' ); ?></span>
							<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'The total cost of this campaign during this period.', 'wpstats' ); ?>"></span>
						</div>
						<div class="wpstats-dashboard-data-point-content">
							<span id="wpstats-google-adwords-cost-currency" class="wpstats-currency-data-point"></span>
							<span id="wpstats-google-adwords-cost" class="wpstats-data-point-value wpstats-google-adwords-data-point-value"></span>
						</div>
						<div class="wpstats-dashboard-data-point-footer">
							<span id="wpstats-google-adwords-cost-change-direction"></span>
							<span id="wpstats-google-adwords-cost-change" class="wpstats-data-point-change"></span>
							<?php $title = __( 'was the Cost during the previous period.', 'wpstats' ); ?>
							<span id="wpstats-google-adwords-cost-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
						</div>
					</div>

					<!-- Conversions -->
					<div id="wpstats-google-adwords-conversions-data-point" class="wpstats-mashboard-data-point-column wpstats-mashboard-google-adwords-data-point-column">
						<div class="wpstats-dashboard-data-point-header">
							<span class="wpstats-dashboard-data-point-heading"><?php _e( 'Conversions', 'wpstats' ); ?></span>
							<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Total number of clicks that have resulted in some action you have defined (e.g. a sale) to your website during this period.', 'wpstats' ); ?>"></span>
						</div>
						<div class="wpstats-dashboard-data-point-content">
							<span id="wpstats-google-adwords-conversions" class="wpstats-data-point-value wpstats-google-adwords-data-point-value"></span>
						</div>
						<div class="wpstats-dashboard-data-point-footer">
							<span id="wpstats-google-adwords-conversions-change-direction"></span>
							<span id="wpstats-google-adwords-conversions-change" class="wpstats-data-point-change"></span>
							<?php $title = __( 'Conversions were made in the previous period.', 'wpstats' ); ?>
							<span id="wpstats-google-adwords-conversions-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
						</div>
					</div>
				</div>

				<!-- Google Adwords Details -->
				<div class="wpstats-card-details-container">
					<span class="wpstats-card-details">
						<a class="wpstats-card-details-link wpstats-tooltip" href="<?php echo admin_url( 'admin.php?page=wpstats-google-adwords' ); ?>" data-tooltip="<?php _e( 'View detailed information about your Google Adwords campaign.', 'wpstats' ); ?>">
							<?php _e( 'View Details', 'wpstats' ); ?>
						</a>
					</span>
				</div>
			</div>
		</div>
	</div>
</div>