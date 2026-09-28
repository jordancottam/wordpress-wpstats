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
		<input class="wpstats-date" type="text" id="end_date" name="end_sate" required="required" value="">
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

	<!-- Twitter Container -->
	<div id="wpstats-twitter-data-container" class="wpstats-service-detail-container">

		<!-- Top Container (Header, Icons) -->
		<div class="wpstats-detail-top-container">
			<h3 class="wpstats-detail-header"><?php _e( 'Twitter', 'wpstats' ); ?>
				<div class="wpstats-detail-icons">
					<span id="wpstats-twitter-settings-icon" class="wpstats-setting-tool-tip wpstats-tooltip wpstats-settings-icon wpstats-disabled" data-tooltip="<?php _e( 'Configure Settings for Twitter', 'wpstats' ); ?>"></span>
					<span id="wpstats-twitter-grid-icon" class="wpstats-grid-icon wpstats-select-tool-tip wpstats-tooltip wpstats-disabled" data-tooltip="<?php _e( 'Show/Hide Twitter Data Points', 'wpstats' ); ?>"></span>
					<div id="wpstats-twitter-grid-icon-content" class="wpstats-grid-content">
						<p>
							<label>
								<input type="checkbox" class="wpstats-show-data-point" value="wpstats-twitter-tweets-data-point" checked>
								<?php _e( 'Tweets', 'wpstats' ); ?>
							</label>
						</p>
						<p>
							<label>
								<input type="checkbox" class="wpstats-show-data-point" value="wpstats-twitter-following-data-point" checked>
								<?php _e( 'Following', 'wpstats' ); ?>
							</label>
						</p>
						<p>
							<label>
								<input type="checkbox" class="wpstats-show-data-point" value="wpstats-twitter-followers-data-point" checked>
								<?php _e( 'Followers', 'wpstats' ); ?>
							</label>
						</p>
						<p>
							<label>
								<input type="checkbox" class="wpstats-show-data-point" value="wpstats-twitter-favourites-data-point" checked>
								<?php _e( 'Favorites', 'wpstats' ); ?>
							</label>
						</p>
						<p>
							<label>
								<input type="checkbox" class="wpstats-show-data-point" value="wpstats-twitter-retweets-data-point" checked>
								<?php _e( 'Retweets', 'wpstats' ); ?>
							</label>
						</p>
						<p>
							<label>
								<input type="checkbox" class="wpstats-show-data-point" value="wpstats-twitter-mentions-data-point" checked>
								<?php _e( 'Mentions', 'wpstats' ); ?>
							</label>
						</p>
						<p>
							<label>
								<input type="checkbox" class="wpstats-show-data-point" value="wpstats-twitter-current-tweets-data-point">
								<?php _e( 'Current Tweets', 'wpstats' ); ?>
							</label>
						</p>
						<p>
							<label>
								<input type="checkbox" class="wpstats-show-data-point" value="wpstats-twitter-current-retweets-data-point">
								<?php _e( 'Current Retweets', 'wpstats' ); ?>
							</label>
						</p>
						<p>
							<label>
								<input type="checkbox" class="wpstats-show-data-point" value="wpstats-twitter-current-following-data-point">
								<?php _e( 'Current Following', 'wpstats' ); ?>
							</label>
						</p>
						<p>
							<label>
								<input type="checkbox" class="wpstats-show-data-point" value="wpstats-twitter-current-followers-data-point">
								<?php _e( 'Current Followers', 'wpstats' ); ?>
							</label>
						</p>
						<p>
							<label>
								<input type="checkbox" class="wpstats-show-data-point" value="wpstats-twitter-current-mentions-data-point">
								<?php _e( 'Current Mentions', 'wpstats' ); ?>
							</label>
						</p>
					</div>
				</div>
			</h3>
		</div>

		<!-- Twitter Historical Data Notice -->
		<div id="wpstats-twitter-historical-data-notice-container" class="wpstats-error-container">
			<p id="wpstats-twitter-historical-data-notice">
				<?php _e( 'Full historical data not available.', 'wpstats' ); ?>
				<a class="wpstats-read-more" data-tooltip=""><?php _e( 'Read more.', 'wpstats' ); ?></a>
			</p>
		</div>

		<!-- Chart Key / Figure -->
		<div id="wpstats-detail-chart-key-container" class="wpstats-service-detail-chart-key-container">
			<span id="wpstats-twitter-favorites-chart-key-icon" class="wpstats-detail-chart-key-icon">&nbsp;</span>
			<span><?php _e( 'Favorites', 'wpstats' ); ?></span>
			<span id="wpstats-twitter-mentions-chart-key-icon" class="wpstats-detail-chart-key-icon">&nbsp;</span>
			<span><?php _e( 'Mentions', 'wpstats' ); ?></span>
		</div>

		<!-- Loading Image -->
		<div id="wpstats-twitter-loading-container" class="wpstats-loading-container">
			<img class="wpstats-loading-image" src="<?php echo wpstats_TEMPLATE_IMAGES_URL . 'loading-spin.svg'; ?>" width="64" height="64" alt="<?php _e( 'Loading', 'wpstats' ); ?>">
		</div>

		<!-- Twitter Settings Tab Content -->
		<div id="wpstats-twitter-settings-content" class="wpstats-settings-tab-settings-content">

			<?php require_once wpstats_API_FUNCTIONS_PATH . 'twitter.php'; ?>

			<!-- Valid Access Token -->
			<div id="wpstats-twitter-settings-valid-access-token-section" class="wpstats-twitter-settings-tab-section wpstats-settings-tab-section">
				<h3><?php _e( 'Valid Access Token', 'wpstats' ); ?></h3>
				<p><?php _e( 'This means everything is working successfully and you haven\'t revoked the wpstats Twitter application\'s access to your Twitter account.', 'wpstats' ); ?></p>
				<p><?php _e( 'You don\'t need to deauthorize. Data will continue to be collected for you each day.', 'wpstats' ); ?></p>
			</div>
			<!-- Invalid Access Token -->
			<div id="wpstats-twitter-settings-invalid-access-token-section" class="wpstats-twitter-settings-tab-section wpstats-settings-tab-section">
				<h3><?php _e( 'Invalid Access Token', 'wpstats' ); ?></h3>
				<p><?php _e( 'This means you have either revoked the wpstats Twitter application\'s access to your Twitter account, or your access token has expired. You will need to deauthorize below, to remove all cached data.', 'wpstats' ); ?></p>
			</div>
			<!-- Rate Limit Reached -->
			<div id="wpstats-twitter-settings-rate-limit-reached-section" class="wpstats-twitter-settings-tab-section wpstats-settings-tab-section">
				<h3><?php _e( 'Rate Limit Reached', 'wpstats' ); ?></h3>
				<p><?php _e( 'This means everything is working correctly, but you\'ll need to wait before querying for new results. Please try again. If the problem continues, you\'ll need to wait at least 15 minutes before querying for new results.', 'wpstats' ); ?></p>
			</div>
			<!-- Setup (Authorize/Authenticate) -->
			<div id="wpstats-twitter-settings-authorize-section" class="wpstats-twitter-settings-tab-section wpstats-settings-tab-section">
				<div class="wpstats-card-settings-authorize-container">
					<h3><?php _e( 'Setup', 'wpstats' ); ?></h3>
					<p><?php _e( 'Click the button below to login to Twitter and authorize the application.', 'wpstats' ); ?></p>
					<p><strong><?php _e( 'Note: Full historical data for Twitter is not available. Data will be collected for you each day after you setup the integration and until you deauthorize.', 'wpstats' ); ?></strong></p>
					<?php $twitter_authorization_url = wpstats_api_twitter_get_authorization_url( wpstats_TWITTER_DETAIL_PAGE_URL ); ?>
					<a id="wpstats-twitter-authorize" href="<?php echo esc_attr( $twitter_authorization_url ); ?>" class="wpstats-button"><?php _e( 'Setup', 'wpstats' ); ?></a>
				</div>
			</div>
			<!-- Deauthorize/Deauthenticate -->
			<div id="wpstats-twitter-settings-deauthorize-section" class="wpstats-twitter-settings-tab-section wpstats-settings-tab-section">
				<h3><?php _e( 'Deauthorize', 'wpstats' ); ?></h3>
				<p><?php _e( 'Purge all Twitter authentication and cache data from your local install.', 'wpstats' ); ?></p>
				<p><strong><?php _e( 'All data that was collected will also be deleted.', 'wpstats' ); ?></strong></p>
				<?php $twitter_deauthorize_url = esc_attr( wpstats_api_twitter_get_deauthorization_url( wpstats_TWITTER_DETAIL_PAGE_URL ) ); ?>
				<a href="<?php echo $twitter_deauthorize_url; ?>" id="wpstats-twitter-deauthorize" class="wpstats-button"><?php _e( 'Deauthorize', 'wpstats' ); ?></a>
			</div>
		</div>

		<!-- Twitter Data Tab Content -->
		<div id="wpstats-twitter-data-tab-content">

			<!-- Twitter Chart -->
			<div id="wpstats-twitter-chart-container" class="wpstats-detail-chart-container wpstats-chart-container">
				<div id="wpstats-twitter-chart" class="wpstats-detail-chart"></div>
			</div>

			<!-- Twitter Data Points -->
			<div id="wpstats-twitter-data-points-container" class="wpstats-data-points-container">

				<!-- Favourites -->
				<div id="wpstats-twitter-favourites-data-point" class="wpstats-service-detail-data-point-column wpstats-data-point-column">
					<div class="wpstats-service-detail-data-point-column-header">
						<span class="wpstats-service-detail-data-point-column-header-label"><?php _e( 'Favorites', 'wpstats' ); ?></span>
						<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Total number of your tweets that have been favorited by other users, during the selected period.', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-twitter-favourites" class="wpstats-data-point-value"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-footer">
						<span id="wpstats-twitter-favourites-change-direction" class="wpstats-data-point-change-direction"></span>
						<span id="wpstats-twitter-favourites-change" class="wpstats-data-point-change"></span>
						<?php $title = __( 'is the amount of times your Tweets have been favorited, by other users, during the previous period.', 'wpstats' ); ?>
						<span id="wpstats-twitter-favourites-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
					</div>
				</div>

				<!-- Mentions -->
				<div id="wpstats-twitter-mentions-data-point" class="wpstats-service-detail-data-point-column wpstats-data-point-column">
					<div class="wpstats-service-detail-data-point-column-header">
						<span class="wpstats-service-detail-data-point-column-header-label"><?php _e( 'Mentions', 'wpstats' ); ?></span>
						<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Total number of times other users have mentioned you in a tweet, during the selected period.', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-twitter-mentions" class="wpstats-data-point-value"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-footer">
						<span id="wpstats-twitter-mentions-change-direction" class="wpstats-data-point-change-direction"></span>
						<span id="wpstats-twitter-mentions-change" class="wpstats-data-point-change"></span>
						<?php $title = __( 'is the amount of times you were mentioned in a tweet, by another user, in the previous period.', 'wpstats' ); ?>
						<span id="wpstats-twitter-mentions-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
					</div>
				</div>

				<!-- Retweets -->
				<div id="wpstats-twitter-retweets-data-point" class="wpstats-service-detail-data-point-column wpstats-data-point-column">
					<div class="wpstats-service-detail-data-point-column-header">
						<span class="wpstats-service-detail-data-point-column-header-label"><?php _e( 'Retweets', 'wpstats' ); ?></span>
						<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Total number of your tweets that have been retweeted by other users, during the selected period.', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-twitter-retweets" class="wpstats-data-point-value"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-footer">
						<span id="wpstats-twitter-retweets-change-direction" class="wpstats-data-point-change-direction"></span>
						<span id="wpstats-twitter-retweets-change" class="wpstats-data-point-change"></span>
						<?php $title = __( 'is the amount of times your tweets were retweeted, by other users, during the previous period.', 'wpstats' ); ?>
						<span id="wpstats-twitter-retweets-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
					</div>
				</div>

				<!-- New Followers -->
				<div id="wpstats-twitter-followers-data-point" class="wpstats-service-detail-data-point-column wpstats-data-point-column">
					<div class="wpstats-service-detail-data-point-column-header">
						<span class="wpstats-service-detail-data-point-column-header-label"><?php _e( 'New Followers', 'wpstats' ); ?></span>
						<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Total number of users who have followed you during the selected period.', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-twitter-followers" class="wpstats-data-point-value"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-footer">
						<span id="wpstats-twitter-followers-change-direction" class="wpstats-data-point-change-direction"></span>
						<span id="wpstats-twitter-followers-change" class="wpstats-data-point-change"></span>
						<?php $title = __( 'people followed you in the previous period.', 'wpstats' ); ?>
						<span id="wpstats-twitter-followers-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
					</div>
				</div>

				<!-- Tweets-->
				<div id="wpstats-twitter-tweets-data-point" class="wpstats-service-detail-data-point-column wpstats-data-point-column">
					<div class="wpstats-service-detail-data-point-column-header">
						<span class="wpstats-service-detail-data-point-column-header-label"><?php _e( 'Tweets', 'wpstats' ); ?></span>
						<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Total number of tweets posted to Twitter, including retweets and replies, during the selected period.', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-twitter-tweets" class="wpstats-data-point-value"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-footer">
						<span id="wpstats-twitter-tweets-change-direction" class="wpstats-data-point-change-direction"></span>
						<span id="wpstats-twitter-tweets-change" class="wpstats-data-point-change"></span>
						<?php $title = __( 'tweets were posted by you in the previous period.', 'wpstats' ); ?>
						<span id="wpstats-twitter-tweets-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
					</div>
				</div>

				<!-- Following -->
				<div id="wpstats-twitter-following-data-point" class="wpstats-service-detail-data-point-column wpstats-data-point-column">
					<div class="wpstats-service-detail-data-point-column-header">
						<span class="wpstats-service-detail-data-point-column-header-label"><?php _e( 'Following', 'wpstats' ); ?></span>
						<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Total number of users you have followed during the selected period.', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-twitter-following" class="wpstats-data-point-value"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-footer">
						<span id="wpstats-twitter-following-change-direction" class="wpstats-data-point-change-direction"></span>
						<span id="wpstats-twitter-following-change" class="wpstats-data-point-change"></span>
						<?php $title = __( 'is the amount of people you followed in the previous period.', 'wpstats' ); ?>
						<span id="wpstats-twitter-following-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
					</div>
				</div>

				<!-- Current Tweets -->
				<div id="wpstats-twitter-current-tweets-data-point" class="wpstats-service-detail-data-point-column wpstats-mashboard-data-point-column">
					<div class="wpstats-dashboard-data-point-header">
						<span class="wpstats-dashboard-data-point-heading"><?php _e( 'Current Tweets', 'wpstats' ); ?></span>
						<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Total amount of tweets you have posted.', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-twitter-current-tweets" class="wpstats-data-point-value"></span>
					</div>
				</div>

				<!-- Current Retweets -->
				<div id="wpstats-twitter-current-retweets-data-point" class="wpstats-service-detail-data-point-column wpstats-mashboard-data-point-column">
					<div class="wpstats-dashboard-data-point-header">
						<span class="wpstats-dashboard-data-point-heading"><?php _e( 'Current Retweets', 'wpstats' ); ?></span>
						<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Total amount of retweets you have made.', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-twitter-current-retweets" class="wpstats-data-point-value"></span>
					</div>
				</div>

				<!-- Current Following -->
				<div id="wpstats-twitter-current-following-data-point" class="wpstats-service-detail-data-point-column wpstats-mashboard-data-point-column">
					<div class="wpstats-dashboard-data-point-header">
						<span class="wpstats-dashboard-data-point-heading"><?php _e( 'Current Following', 'wpstats' ); ?></span>
						<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Total amount of users you are following.', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-twitter-current-following" class="wpstats-data-point-value"></span>
					</div>
				</div>

				<!-- Current Followers -->
				<div id="wpstats-twitter-current-followers-data-point" class="wpstats-service-detail-data-point-column wpstats-mashboard-data-point-column">
					<div class="wpstats-dashboard-data-point-header">
						<span class="wpstats-dashboard-data-point-heading"><?php _e( 'Current Followers', 'wpstats' ); ?></span>
						<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Total amount of users who are following you.', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-twitter-current-followers" class="wpstats-data-point-value"></span>
					</div>
				</div>

				<!-- Current Mentions -->
				<div id="wpstats-twitter-current-mentions-data-point" class="wpstats-service-detail-data-point-column wpstats-mashboard-data-point-column">
					<div class="wpstats-dashboard-data-point-header">
						<span class="wpstats-dashboard-data-point-heading"><?php _e( 'Current Mentions', 'wpstats' ); ?></span>
						<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Total amount of times you have been mentioned in a tweet by another user.', 'wpstats' ); ?>"></span>
					</div>
					<div class="wpstats-service-detail-data-point-column-content">
						<span id="wpstats-twitter-current-mentions" class="wpstats-data-point-value"></span>
					</div>
				</div>
			</div>

			<!-- Twitter Data Tables -->
			<div class="wpstats-service-detail-data-tables-container">

				<div class="wpstats-detail-data-table-row">

					<!-- Top 5 Latest Tweets -->
					<div class="wpstats-service-detail-data-table-column">
						<div id="wpstats-detail-twitter-top-posts-data-table-column-content" class="wpstats-data-table-column-content wpstats-service-detail-data-table-column-content">
							<h2>
								<?php _e( 'Top 5 Tweets', 'wpstats' ); ?>
								<span class="wpstats-data-point-heading-info wpstats-data-table-heading-info wpstats-tooltip" title="<?php _e( 'Top 5 latest tweets out of your 200 most recent tweets.', 'wpstats' ); ?>"></span>
							</h2>
							<div id="wpstats-twitter-top-tweets-data-error-container" class="wpstats-top-data-error-container">
								<p><?php _e( 'No data available for this period.', 'wpstats' ); ?></p>
							</div>
							<table id="wpstats-twitter-top-latest-tweets" class="wpstats-service-detail-data-table wp-list-table widefat">
								<thead>
									<tr>
										<th><?php _e( 'Text', 'wpstats' ); ?></th>
										<th><?php _e( 'Retweets', 'wpstats' ); ?></th>
										<th><?php _e( 'Favorites', 'wpstats' ); ?></th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>

					<!-- Top 5 Latest Retweets -->
					<div class="wpstats-service-detail-data-table-column">
						<div id="wpstats-detail-twitter-top-posts-data-table-column-content" class="wpstats-data-table-column-content wpstats-service-detail-data-table-column-content">
							<h2>
								<?php _e( 'Top 5 Retweets', 'wpstats' ); ?>
								<span class="wpstats-data-point-heading-info wpstats-data-table-heading-info wpstats-tooltip" title="<?php _e( 'Top 5 latest retweets out of the 100 most recent retweets of your tweets.', 'wpstats' ); ?>"></span>
							</h2>
							<div id="wpstats-twitter-top-retweets-data-error-container" class="wpstats-top-data-error-container">
								<p><?php _e( 'No data available for this period.', 'wpstats' ); ?></p>
							</div>
							<table id="wpstats-twitter-top-latest-retweets" class="wpstats-service-detail-data-table wp-list-table widefat">
								<thead>
									<tr>
										<th><?php _e( 'Text', 'wpstats' ); ?></th>
										<th><?php _e( 'Retweets', 'wpstats' ); ?></th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>

				<div class="wpstats-detail-data-table-row">

					<!-- Top 5 Latest Mentions -->
					<div class="wpstats-service-detail-data-table-column">
						<div id="wpstats-detail-twitter-top-posts-data-table-column-content" class="wpstats-data-table-column-content wpstats-service-detail-data-table-column-content">
							<h2>
								<?php _e( 'Top 5 Mentions', 'wpstats' ); ?>
								<span class="wpstats-data-point-heading-info wpstats-data-table-heading-info wpstats-tooltip" title="<?php _e( 'Top 5 latest mentions out of the 200 most recent mentions of your screen name.', 'wpstats' ); ?>"></span>
							</h2>
							<div id="wpstats-twitter-top-mentions-data-error-container" class="wpstats-top-data-error-container">
								<p><?php _e( 'No data available for this period.', 'wpstats' ); ?></p>
							</div>
							<table id="wpstats-twitter-top-latest-mentions" class="wpstats-service-detail-data-table wp-list-table widefat">
								<thead>
									<tr>
										<th><?php _e( 'User', 'wpstats' ); ?></th>
										<th><?php _e( 'Text', 'wpstats' ); ?></th>
										<th><?php _e( 'Retweets', 'wpstats' ); ?></th>
										<th><?php _e( 'Favorites', 'wpstats' ); ?></th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>

					<!-- Top 5 Latest Favourites -->
					<div class="wpstats-service-detail-data-table-column">
						<div id="wpstats-detail-twitter-top-posts-data-table-column-content" class="wpstats-data-table-column-content wpstats-service-detail-data-table-column-content">
							<h2>
								<?php _e( 'Top 5 Favorites', 'wpstats' ); ?>
								<span class="wpstats-data-point-heading-info wpstats-data-table-heading-info wpstats-tooltip" title="<?php _e( 'Your top 5 latest favourites out of your 200 most recent favourites.', 'wpstats' ); ?>"></span>
							</h2>
							<div id="wpstats-twitter-top-favourites-data-error-container" class="wpstats-top-data-error-container">
								<p><?php _e( 'No data available for this period.', 'wpstats' ); ?></p>
							</div>
							<table id="wpstats-twitter-top-latest-favourites" class="wpstats-service-detail-data-table wp-list-table widefat">
								<thead>
									<tr>
										<th><?php _e( 'Text', 'wpstats' ); ?></th>
										<th><?php _e( 'Favorites', 'wpstats' ); ?></th>
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
</div>