<?php

defined( 'ABSPATH' ) or exit();

?>

<div class="wrap">
	<div id="wpstats-logo-container">
		<?php $mashboard_page_url = esc_attr( admin_url() . 'admin.php?page=wpstats-mashboard' ); ?>
		<?php $brand_logo_image_url = esc_attr( get_option( 'wpstats_brand_logo_image_url' ) ); ?>
		<a class="wpstats-shadowless" href="<?php echo $mashboard_page_url; ?>"><img src="<?php echo $brand_logo_image_url; ?>"></a>
	</div>

	<!-- Google Analytics Query Parameters (Date Range, Frequency) -->
	<div id="wpstats-date-range-container">
		<!-- Start Date & End Date -->
		<label class="wpstats-query-parameter-label" for="start_date"><?php _e( 'Date Range:', 'wpstats' ); ?></label>
		<input class="wpstats-date" type="text" id="start_date" name="start_date" required="required" value="">
		<input class="wpstats-date" type="text" id="end_date" name="end_date" required="required" value="">

		<!-- Chart Plotting Frequency -->
		<label for="frequency" class="wpstats-query-parameter-label"><?php _e( 'Chart Plotting Frequency', 'wpstats' ); ?></label>
		<select class="wpstats-frequency" name="frequency" id="frequency">
			<option value="daily"><?php _e( 'Daily', 'wpstats' ); ?>
			<option value="monthly"><?php _e( 'Monthly', 'wpstats' ); ?></option>
		</select>
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

	<!-- Page Data -->
	<div id="wpstats-google-analytics-data-container" class="wpstats-service-detail-container">

		<!-- Top Container (Header, Icons) -->
		<div class="wpstats-detail-top-container">
			<h3 class="wpstats-detail-header"><?php _e( 'Google Analytics', 'wpstats' ); ?>
				<div class="wpstats-detail-icons">
					<span id="wpstats-google-analytics-settings-icon" class="wpstats-setting-tool-tip wpstats-tooltip wpstats-disabled wpstats-settings-icon wpstats-disabled" data-tooltip="<?php _e( 'Configure Settings for Google Analytics', 'wpstats' ); ?>">
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
								<input type="checkbox" class="wpstats-show-data-point" value="wpstats-google-analytics-pages-per-visit-data-point" checked>
								<?php _e( 'Pages Per Visit', 'wpstats' ); ?>
							</label>
						</p>
						<p>
							<label>
								<input type="checkbox" class="wpstats-show-data-point" value="wpstats-google-analytics-average-visit-duration-data-point" checked>
								<?php _e( 'Average Visit Duration', 'wpstats' ); ?>
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
			</h3>
		</div>

		<!-- Data Loading Icon Container -->
		<div id="wpstats-google-analytics-loading-container" class="wpstats-loading-container">
			<img class="wpstats-loading-image" src="<?php echo wpstats_TEMPLATE_IMAGES_URL . 'loading-spin.svg'; ?>" width="64" height="64">
		</div>

		<!-- Settings Tab & Content -->
		<div id="wpstats-google-analytics-settings-content" class="wpstats-settings-tab-settings-content">
			<?php require_once wpstats_API_FUNCTIONS_PATH . 'google-analytics.php'; ?>
			<?php $api_authenticate_url = wpstats_api_google_analytics_get_authorization_url( wpstats_GOOGLE_ANALYTICS_DETAIL_PAGE_URL ); ?>
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
				<select id="wpstats-google-analytics-google-accounts" class="wpstats-card-settings-profiles" style="transition:none;">
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

		<!-- Chart Key / Figure -->
		<div id="wpstats-detail-chart-key-container" class="wpstats-service-detail-chart-key-container">
			<span class="wpstats-yellow-chart-key-icon wpstats-detail-chart-key-icon">&nbsp;</span>
			<span><?php _e( 'Users', 'wpstats' ); ?></span>
			<span class="wpstats-orange-chart-key-icon wpstats-detail-chart-key-icon">&nbsp;</span>
			<span><?php _e( 'Page Views', 'wpstats' ); ?></span>
		</div>

		<!-- Data Tab & Content -->
		<div id="wpstats-google-analytics-data-content">

			<!-- Chart -->
			<div id="wpstats-google-analytics-chart-container" class="wpstats-detail-chart-container wpstats-chart-container">
				<div id="wpstats-google-analytics-chart" class="wpstats-detail-chart"></div>
			</div>

			<!-- Google Analytics Data Points -->
			<div id="wpstats-google-analytics-data-points-container" class="wpstats-data-points-container">

				<!-- Users / Unique Visitors -->
				<div id="wpstats-google-analytics-users-data-point" class="wpstats-service-detail-data-point-column wpstats-data-point-column">
					<div class="wpstats-service-detail-data-point-column-header">
						<span class="wpstats-service-detail-data-point-column-header-label"><?php _e( 'Users', 'wpstats' ); ?></span>
						<span class="wpstats-tooltip wpstats-data-point-info-icon" data-tooltip="<?php _e( 'Users that have had at least one session within the selected date range. Includes both new and returning users.', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-google-analytics-users-total" class="wpstats-data-point-value"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-footer">
						<span id="wpstats-google-analytics-users-change-direction" class="wpstats-data-point-change-direction"></span>
						<span id="wpstats-google-analytics-users-change" class="wpstats-data-point-change"></span>
						<?php $title = __( 'users visited your website during the previous period.', 'wpstats' ); ?>
						<span id="wpstats-google-analytics-users-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip="<?php echo $title; ?>" data-tooltip-backup="<?php echo $title; ?>"></span>
					</div>
				</div>

				<!-- Page Views -->
				<div id="wpstats-google-analytics-page-views-data-point" class="wpstats-service-detail-data-point-column wpstats-data-point-column">
					<div class="wpstats-service-detail-data-point-column-header">
						<span class="wpstats-service-detail-data-point-column-header-label"><?php _e( 'Page Views', 'wpstats' ); ?></span>
						<span class="wpstats-tooltip wpstats-data-point-info-icon" data-tooltip="<?php _e( 'Total number of page views during this period.', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-google-analytics-page-views-total" class="wpstats-data-point-value"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-footer">
						<span id="wpstats-google-analytics-page-views-change-direction" class="wpstats-data-point-change-direction"></span>
						<span id="wpstats-google-analytics-page-views-change" class="wpstats-data-point-change"></span>
						<?php $title = __( 'page views on your website during the previous period.', 'wpstats' ); ?>
						<span id="wpstats-google-analytics-page-views-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip="<?php echo $title; ?>" data-tooltip-backup="<?php echo $title; ?>"></span>
					</div>
				</div>

				<!-- Pages Per Visit -->
				<div id="wpstats-google-analytics-pages-per-visit-data-point" class="wpstats-service-detail-data-point-column wpstats-data-point-column">
					<div class="wpstats-service-detail-data-point-column-header">
						<span class="wpstats-service-detail-data-point-column-header-label"><?php _e( 'Pages Per Visit', 'wpstats' ); ?></span>
						<span class="wpstats-tooltip wpstats-data-point-info-icon" data-tooltip="<?php _e( 'The average number of pages viewed per session. Repeated page views are also included.', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-google-analytics-pages-per-visit-total" class="wpstats-data-point-value"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-footer">
						<span id="wpstats-google-analytics-pages-per-visit-change-direction" class="wpstats-data-point-change-direction"></span>
						<span id="wpstats-google-analytics-pages-per-visit-change" class="wpstats-data-point-change"></span>
						<?php $title = __( 'was the average of page visits during a session in the previous period.', 'wpstats' ); ?>
						<span id="wpstats-google-analytics-pages-per-visit-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip="<?php echo $title; ?>" data-tooltip-backup="<?php echo $title; ?>"></span>
					</div>
				</div>

				<!-- Average Visit Duration (Minutes: Seconds) -->
				<div id="wpstats-google-analytics-average-visit-duration-data-point" class="wpstats-service-detail-data-point-column wpstats-data-point-column">
					<div class="wpstats-service-detail-data-point-column-header">
						<span class="wpstats-service-detail-data-point-column-header-label"><?php _e( 'Average Visit Duration (min:sec)', 'wpstats' ); ?></span>
						<span class="wpstats-tooltip wpstats-data-point-info-icon" data-tooltip="<?php _e( 'The average duration your website users were actively engaged with your site, during the selected period.', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-google-analytics-average-visit-duration-total" class="wpstats-data-point-value"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-footer">
						<span id="wpstats-google-analytics-average-visit-duration-change-direction" class="wpstats-data-point-change-direction"></span>
						<span id="wpstats-google-analytics-average-visit-duration-change" class="wpstats-data-point-change"></span>
						<?php $title = __( 'was the average visit duration during the previous period.', 'wpstats' ); ?>
						<span id="wpstats-google-analytics-average-visit-duration-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip="<?php echo $title; ?>" data-tooltip-backup="<?php echo $title; ?>"></span>
					</div>
				</div>

				<!-- Bounce Rate -->
				<div id="wpstats-google-analytics-bounce-rate-data-point" class="wpstats-service-detail-data-point-column wpstats-data-point-column">
					<div class="wpstats-service-detail-data-point-column-header">
						<span class="wpstats-service-detail-data-point-column-header-label"><?php _e( 'Bounce Rate', 'wpstats' ); ?></span>
						<span class="wpstats-tooltip wpstats-data-point-info-icon" data-tooltip="<?php _e( 'Bounce Rate is the percentage of single-page visits (i.e. visits in which the person left your site from the entrance page without interacting with the page).', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-google-analytics-bounce-rate-total" class="wpstats-data-point-value wpstats-data-point-value-percentage"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-footer">
						<span id="wpstats-google-analytics-bounce-rate-change-direction" class="wpstats-data-point-change-direction"></span>
						<span id="wpstats-google-analytics-bounce-rate-change" class="wpstats-data-point-change"></span>
						<?php $title = __( 'single-page visits during the previous period.', 'wpstats' ); ?>
						<span id="wpstats-google-analytics-bounce-rate-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip="<?php echo $title; ?>" data-tooltip-backup="<?php echo $title; ?>"></span>
					</div>
				</div>

				<!-- Search Engine Visits -->
				<div id="wpstats-google-analytics-search-engine-visits-data-point" class="wpstats-service-detail-data-point-column wpstats-data-point-column">
					<div class="wpstats-service-detail-data-point-column-header">
						<span class="wpstats-service-detail-data-point-column-header-label"><?php _e( 'Search Engine Visits', 'wpstats' ); ?></span>
						<span class="wpstats-tooltip wpstats-data-point-info-icon" data-tooltip="<?php _e( 'Total number of visits to your website from any search engine.', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-google-analytics-search-engine-visits-total" class="wpstats-data-point-value"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-footer">
						<span id="wpstats-google-analytics-search-engine-visits-change-direction" class="wpstats-data-point-change-direction"></span>
						<span id="wpstats-google-analytics-search-engine-visits-change" class="wpstats-data-point-change"></span>
						<?php $title = __( 'search engine visits to your website during the previous period.', 'wpstats' ); ?>
						<span id="wpstats-google-analytics-search-engine-visits-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip="<?php echo $title; ?>" data-tooltip-backup="<?php echo $title; ?>"></span>
					</div>
				</div>
			</div>

			<!-- Google Analytics Data Tables -->
			<div class="wpstats-service-detail-data-tables-container">

				<div class="wpstats-detail-data-table-row">

					<!-- Top Keywords -->
					<div class="wpstats-service-detail-data-table-column">
						<div id="wpstats-detail-google-analytics-top-keywords-data-table-column-content" class="wpstats-data-table-column-content">
							<h2><?php _e( 'Top 5 Keywords', 'wpstats' ); ?></h2>
							<div id="wpstats-google-analytics-top-keywords-data-error-container" class="wpstats-top-data-error-container">
								<p><?php _e( 'No data available for this period.', 'wpstats' ); ?></p>
							</div>
							<table id="wpstats-google-analytics-top-keywords-data-table" class="wpstats-service-detail-data-table wp-list-table widefat">
								<thead>
								<tr>
									<th><?php _e( 'Keyword', 'wpstats' ); ?></th>
									<th><?php _e( 'Sessions', 'wpstats' ); ?></th>
									<th>%</th>
								</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>

					<!-- Top Search Engine Referrals -->
					<div class="wpstats-service-detail-data-table-column">
						<div id="wpstats-detail-google-analytics-top-search-engine-referrals-data-table-column-content" class="wpstats-data-table-column-content">
							<h2><?php _e( 'Top 5 Search Engine Referrals', 'wpstats' ); ?></h2>
							<div id="wpstats-google-analytics-top-search-engine-referrals-data-error-container" class="wpstats-top-data-error-container">
								<p><?php _e( 'No data available for this period.', 'wpstats' ); ?></p>
							</div>
							<table id="wpstats-google-analytics-top-search-engine-referrals-data-table" class="wpstats-service-detail-data-table wp-list-table widefat">
								<thead>
								<tr>
									<th><?php _e( 'Search Engine', 'wpstats' ); ?></th>
									<th><?php _e( 'Sessions', 'wpstats' ); ?></th>
									<th>%</th>
								</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div> <!-- .wpstats-detail-data-table-row -->

				<div class="wpstats-detail-data-table-row">
					<!-- Top Landing Pages -->
					<div class="wpstats-service-detail-data-table-column">
						<div id="wpstats-detail-google-analytics-top-landing-pages-data-table-column-content" class="wpstats-data-table-column-content">
							<h2><?php _e( 'Top 5 Landing Pages', 'wpstats' ); ?></h2>
							<div id="wpstats-google-analytics-top-landing-pages-data-error-container" class="wpstats-top-data-error-container">
								<p><?php _e( 'No data available for this period.', 'wpstats' ); ?></p>
							</div>
							<table id="wpstats-google-analytics-top-landing-pages-data-table" class="wpstats-service-detail-data-table wp-list-table widefat">
								<thead>
								<tr>
									<th><?php _e( 'URL', 'wpstats' ); ?></th>
									<th><?php _e( 'Sessions', 'wpstats' ); ?></th>
									<th>%</th>
								</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>

					<!-- Visitor Locations -->
					<div class="wpstats-service-detail-data-table-column">
						<div id="wpstats-detail-google-analytics-top-visitor-locations-data-table-column-content" class="wpstats-data-table-column-content">
							<h2><?php _e( 'Top 5 Visitor Locations', 'wpstats' ); ?></h2>
							<div id="wpstats-google-analytics-top-visitor-locations-data-error-container" class="wpstats-top-data-error-container">
								<p><?php _e( 'No data available for this period.', 'wpstats' ); ?></p>
							</div>
							<table id="wpstats-google-analytics-visitor-locations-data-table" class="wpstats-service-detail-data-table wp-list-table widefat">
								<thead>
								<tr>
									<th><?php _e( 'Country', 'wpstats' ); ?></th>
									<th><?php _e( 'Sessions', 'wpstats' ); ?></th>
									<th>%</th>
								</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> <!-- .wrap -->