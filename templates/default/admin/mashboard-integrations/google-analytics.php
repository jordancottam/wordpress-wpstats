<?php

// Prevent direct access
defined( 'ABSPATH' ) or exit();

?>

<div id="googleanalytics_1" class="wpstats-card-container">
	<div class="wpstats-card">
		<div class="wpstats-card-header">
			<span class="wpstats-card-drag-icon"></span>
			<h4 class="wpstats-card-heading"><?php _e( 'Google Analytics', 'wpstats' ); ?></h4>
			<span id="wpstats-google-analytics-settings-icon" class="wpstats-settings-icon wpstats-setting-tool-tip wpstats-tooltip wpstats-disabled" data-tooltip="<?php _e( 'Configure Settings for Google Analytics', 'wpstats' ); ?>">
			</span>
			<span id="wpstats-google-analytics-grid-icon" class="wpstats-grid-icon wpstats-select-tool-tip wpstats-tooltip wpstats-disabled" data-tooltip="<?php _e( 'Show/Hide Google Analytics Data Points', 'wpstats' ); ?>">
			</span>
			<div id="wpstats-google-analytics-grid-icon-content" class="wpstats-grid-content">
				<p>
					<label>
						<input type="checkbox" class="wpstats-show-data-point" value="wpstats-google-analytics-users-data-point" checked>
						<?php _e( 'Users', 'wpstats' ); ?>
					</label>
				</p>
				<p>
					<label>
						<input type="checkbox" class="wpstats-show-data-point" value="wpstats-google-analytics-page-views-data-point" checked>
						<?php _e( 'Page Views', 'wpstats' ); ?>
					</label>
				</p>
				<p>
					<label>
						<input type="checkbox" class="wpstats-show-data-point" value="wpstats-google-analytics-bounce-rate-data-point" checked>
						<?php _e( 'Bounce Rate', 'wpstats' ); ?>
					</label>
				</p>
				<p>
					<label>
						<input type="checkbox" class="wpstats-show-data-point" value="wpstats-google-analytics-search-engine-visits-data-point" checked>
						<?php _e( 'Search Engine Visits', 'wpstats' ); ?>
					</label>
				</p>
			</div>
		</div>
		<div id="wpstats-google-analytics-card-content" class="wpstats-card-content">

			<!-- Google Analytics Loading Container -->
			<div id="wpstats-google-analytics-loading-container" class="wpstats-loading-container wpstats-chart-loading-container">
				<img class="wpstats-loading-image" src="<?php echo wpstats_TEMPLATE_IMAGES_URL . 'loading-spin.svg'; ?>" height="64" width="64">
			</div>

			<!-- Google Analytics Settings Content -->
			<div id="wpstats-google-analytics-settings-content">
				<?php require_once wpstats_API_FUNCTIONS_PATH . 'google-analytics.php'; ?>
				<?php $api_authenticate_url = wpstats_api_google_analytics_get_authorization_url( wpstats_MASHBOARD_PAGE_URL ); ?>
				<!-- No profiles -->
				<div id="wpstats-google-analytics-settings-no-profiles-section" class="wpstats-google-analytics-settings-tab-section wpstats-settings-tab-section">
					<h3><?php _e( 'No Views Found', 'wpstats' ); ?></h3>
					<p><?php _e( 'No views found. Please try refreshing the page or deauthorizing below, then reauthorize with a Google Analytics account which has access to at least one view.', 'wpstats' ); ?></p>
				</div>
				<!-- Select a View -->
				<div id="wpstats-google-analytics-settings-profiles-section" class="wpstats-google-analytics-settings-tab-section wpstats-settings-tab-section">
					<h3><?php _e( 'Select a View', 'wpstats' ); ?></h3>
					<p><?php _e( 'Select a view from the list below to display data for. If you see any view named "All Website Data", you can change this from within Google Analytics to make it easier to select a view.', 'wpstats' ); ?></p>
					<select id="ga-profiles" class="wpstats-card-settings-profiles">
						<option value="select"><?php _e( 'Select View', 'wpstats' ); ?></option>
					</select>
					<button id="save_ga_profile" class="wpstats-settings-tab-save-data-button wpstats-button"><?php _e( 'Save', 'wpstats' ); ?></button>
				</div>
				<!-- Setup / Authorize / Authenticate -->
				<div id="wpstats-google-analytics-settings-setup-section"  class="wpstats-google-analytics-settings-tab-section wpstats-settings-tab-section">
					<h3><?php _e( 'Setup', 'wpstats' ); ?></h3>
					<p><?php _e( "Click the button below to setup Google Analytics and choose a Google account you have already authorized or a new Google account. Once you have chosen an account or authorized a new one, you'll be able to select the view that you would like to see data for.", 'wpstats' ); ?></p>
					<a id="wpstats-google-analytics-authorize" href="#" class="wpstats-button"><?php _e( 'Setup', 'wpstats' ); ?></a>
				</div>
				<div id="wpstats-google-analytics-settings-choose-google-account-section"  class="wpstats-google-analytics-settings-tab-section wpstats-settings-tab-section">
					<h3><?php _e( 'Choose Google Account', 'wpstats' ); ?></h3>
					<p><?php _e( "Choose a Google account from the list below that has already been authorized on this license key, or authorize with a new Google Account below.", 'wpstats' ); ?></p>
					<select id="wpstats-google-analytics-google-accounts" class="wpstats-card-settings-profiles">
						<option value="select"><?php _e( 'Select Google Account', 'wpstats' ); ?></option>
					</select>
					<button id="wpstats-google-analytics-save-google-account" class="wpstats-settings-tab-save-data-button wpstats-button"><?php _e( 'Save', 'wpstats' ); ?></button>
				</div>
				<!-- Add Google Account -->
				<div id="wpstats-google-analytics-settings-add-google-account-section"  class="wpstats-google-analytics-settings-tab-section wpstats-settings-tab-section">
					<h3><?php _e( 'Add Google Account', 'wpstats' ); ?></h3>
					<p><?php _e( "Authorize with a new Google account. Please note: you must login with a Google account that has access to at least one view's analytics.", 'wpstats' ); ?></p>
					<a id="wpstats-google-analytics-add-google-account" href="<?php echo esc_attr( $api_authenticate_url ); ?>" class="wpstats-button"><?php _e( 'Authorize', 'wpstats' ); ?></a>
				</div>
				<!-- Reauthorize / Reauthenticate -->
				<div id="wpstats-google-analytics-settings-reauthorize-section"  class="wpstats-google-analytics-settings-tab-section wpstats-settings-tab-section">
					<h3><?php _e( 'Reauthorize', 'wpstats' ); ?></h3>
					<p><?php _e( 'Sorry, an error occurred that requires you to reauthorize/reauthenticate with Google. This is likely due to either an expired access token, you removed the application from your account, or you logged out of your account and your session expired. Please click the button below to continue.', 'wpstats' ); ?></p>
					<a id="wpstats-google-analytics-reauthorize" href="<?php echo esc_attr( $api_authenticate_url ); ?>" class="wpstats-button"><?php _e( 'Reauthorize', 'wpstats' ); ?></a>
				</div>
				<!-- Deauthorize / Deauthenticate -->
				<div id="wpstats-google-analytics-settings-deauthorize-section" class="wpstats-google-analytics-settings-tab-section wpstats-settings-tab-section">
					<h3><?php _e( 'Deauthorize Site Only', 'wpstats' ); ?></h3>
					<p><?php _e( 'This will remove all Google Analytics data from this site only, and will not affect any other sites using the same License Key and Google Account(s).', 'wpstats' ); ?></p>
					<a id="wpstats-google-analytics-deauthorize" class="wpstats-button"><?php _e( 'Deauthorize', 'wpstats' ); ?></a>
					<h3><?php _e( 'Deauthorize Account License-wide', 'wpstats' ); ?></h3>
					<p><?php _e( "Warning: This will remove the current Google Account from this License Key. Any other sites using the same Google Account and License Key will need to reauthorize. This option can be useful for example in cases where you authorize a Google Account that doesn't have access to a view."); ?></p>
					<a id="wpstats-google-analytics-deauthorize-account-license-wide" class="wpstats-button"><?php _e( 'Deauthorize', 'wpstats' ); ?></a>
					<h3><?php _e( 'Deauthorize All Accounts License-wide', 'wpstats' ); ?></h3>
					<p><?php _e( "Warning: This will remove all Google Accounts from this License Key. Any other sites using the same Google Account(s) and License Key will need to reauthorize."); ?></p>
					<a id="wpstats-google-analytics-deauthorize-accounts-license-wide" class="wpstats-button"><?php _e( 'Deauthorize', 'wpstats' ); ?></a>
				</div>
			</div>

			<!-- Google Analytics Data Content (chart & data points) -->
			<div id="wpstats-google-analytics-data-content">
				<!-- Google Analytics Chart -->
				<div id="wpstats-google-analytics-chart-container" class="wpstats-mashboard-chart-container wpstats-chart-container">
					<div id="wpstats-google-analytics-chart" class="wpstats-mashboard-chart"></div>
				</div>

				<!-- Google Analytics Data Points -->
				<div id="wpstats-google-analytics-data-points-container" class="wpstats-data-points-container">

					<!-- Google Analytics Users -->
					<div id="wpstats-google-analytics-users-data-point" class="wpstats-mashboard-data-point-column">
						<div class="wpstats-dashboard-data-point-header">
							<span id="wpstats-google-analytics-users-chart-key" class="wpstats-dashboard-data-point-chart-key">&nbsp;</span>
							<span class="wpstats-dashboard-data-point-heading"><?php _e( 'Users', 'wpstats' ); ?></span>
							<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Users that have had at least one session within the selected date range. Includes both new and returning users.', 'wpstats' ); ?>"></span>
						</div>
						<div class="wpstats-dashboard-data-point-content">
							<span id="wpstats-google-analytics-users-total" class="wpstats-data-point-value"></span>
						</div>
						<div class="wpstats-dashboard-data-point-footer">
							<span id="wpstats-google-analytics-users-change-direction"></span>
							<span id="wpstats-google-analytics-users-change" class="wpstats-data-point-change"></span>
							<?php $title = __( 'users visited your website during the previous period.', 'wpstats' ); ?>
							<span id="wpstats-google-analytics-users-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
						</div>
					</div>

					<!-- Google Analytics Page Views -->
					<div id="wpstats-google-analytics-page-views-data-point" class="wpstats-mashboard-data-point-column">
						<div class="wpstats-dashboard-data-point-header">
							<span id="wpstats-google-analytics-page-views-chart-key" class="wpstats-dashboard-data-point-chart-key">&nbsp;</span>
							<span class="wpstats-dashboard-data-point-heading"><?php _e( 'Page Views', 'wpstats' ); ?></span>
							<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Total number of page views during this period.', 'wpstats' ); ?>"></span>
						</div>
						<div class="wpstats-dashboard-data-point-content">
							<span id="wpstats-google-analytics-page-views-total" class="wpstats-data-point-value"></span>
						</div>
						<div class="wpstats-dashboard-data-point-footer">
							<span id="wpstats-google-analytics-page-views-change-direction"></span>
							<span id="wpstats-google-analytics-page-views-change" class="wpstats-data-point-change"></span>
							<?php $title = __( 'page views on your website during the previous period.', 'wpstats' ); ?>
							<span id="wpstats-google-analytics-page-views-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
						</div>
					</div>

					<!-- Bounce Rate -->
					<div id="wpstats-google-analytics-bounce-rate-data-point" class="wpstats-mashboard-data-point-column">
						<div class="wpstats-dashboard-data-point-header">
							<span class="wpstats-dashboard-data-point-heading"><?php _e( 'Bounce Rate', 'wpstats' ); ?></span>
							<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Bounce Rate is the percentage of single-page visits (i.e. visits in which the person left your site from the entrance page without interacting with the page). The values shown here are rounded to save space. Take a look at the Google Analytics detail page for the precise values.', 'wpstats' ); ?>"></span>
						</div>
						<div id="wpstats-mashboard-google-analytics-bounce-rate-container">
							<div id="wpstats-donut-content">
								<div id="wpstats-google-analytics-bounce-rate" class="wpstats-donut" style="height: 150px;"></div>
							</div>
						</div>
					</div>

					<!-- Search Engine Visits -->
					<div id="wpstats-google-analytics-search-engine-visits-data-point" class="wpstats-mashboard-data-point-column">
						<div class="wpstats-dashboard-data-point-header">
							<span class="wpstats-dashboard-data-point-heading"><?php _e( 'Search Engine Visits', 'wpstats' ); ?></span>
							<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Total number of visits to your website from any search engine.', 'wpstats' ); ?>"></span>
						</div>
						<div class="wpstats-dashboard-data-point-content">
							<span id="wpstats-google-analytics-search-engine-visits-total" class="wpstats-data-point-value"></span>
						</div>
						<div class="wpstats-dashboard-data-point-footer">
							<span id="wpstats-google-analytics-search-engine-visits-change-direction"></span>
							<span id="wpstats-google-analytics-search-engine-visits-change" class="wpstats-data-point-change"></span>
							<?php $title = __( 'search engine visits to your website during the previous period.', 'wpstats' ); ?>
							<span id="wpstats-google-analytics-search-engine-visits-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
						</div>
					</div>
				</div>

				<!-- Google Analytics Details -->
				<div class="wpstats-card-details-container">
					<span class="wpstats-card-details">
						<a class="wpstats-card-details-link wpstats-tooltip" href="<?php echo admin_url( 'admin.php?page=wpstats-google-analytics' ); ?>" data-tooltip="<?php _e( 'View detailed information about your Google Analytics view.', 'wpstats' ); ?>">
							<?php _e( 'View Details', 'wpstats' ); ?>
						</a>
					</span>
				</div>
			</div>
		</div>
	</div>
</div>