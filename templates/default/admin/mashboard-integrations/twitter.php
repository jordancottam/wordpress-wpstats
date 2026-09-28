<?php

defined( 'ABSPATH' ) or exit();

?>

<div id="twitter_3" class="wpstats-card-container">
	<div class="wpstats-card">
		<div class="wpstats-card-header">
			<span class="wpstats-card-drag-icon"></span>
			<h4 class="wpstats-card-heading"><?php _e( 'Twitter', 'wpstats' ); ?></h4>
			<!-- Twitter Settings Icon -->
			<span id="wpstats-twitter-settings-icon" class="wpstats-card-settings wpstats-setting-tool-tip wpstats-tooltip wpstats-disabled" data-tooltip="<?php _e( 'Configure Settings for Twitter', 'wpstats' ); ?>"></span>

			<!-- Twitter Grid Icon -->
			<span id="wpstats-twitter-grid-icon" class="wpstats-card-eye wpstats-select-tool-tip wpstats-tooltip wpstats-disabled" data-tooltip="<?php _e( 'Show/Hide Twitter Data Points', 'wpstats' ); ?>"></span>

			<!-- Twitter Grid Icon Content -->
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
			</div>
		</div>
		<div id="wpstats-twitter-card-content" class="wpstats-card-content">

			<!-- Chart Loading Icon -->
			<div id="wpstats-twitter-loading-container" class="wpstats-loading-container wpstats-chart-loading-container">
				<img class="wpstats-loading-image" src="<?php echo wpstats_TEMPLATE_IMAGES_URL . 'loading-spin.svg'; ?>" width="64" height="64">
			</div>

			<!-- Twitter Settings Tab Data -->
			<div id="wpstats-twitter-settings-content" class="wpstats-settings-tab-settings-content">

				<?php require_once wpstats_API_FUNCTIONS_PATH . 'twitter.php'; ?>
				<?php $twitter_authorization_url = wpstats_api_twitter_get_authorization_url( wpstats_MASHBOARD_PAGE_URL ); ?>

				<!-- Valid Access Token -->
				<div id="wpstats-twitter-settings-valid-access-token-section" class="wpstats-twitter-settings-tab-section wpstats-settings-tab-section">
					<h3><?php _e( 'Valid Access Token', 'wpstats' ); ?></h3>
					<p><?php _e( 'This means everything is working correctly and you haven\'t revoked the wpstats Twitter application\'s access to your Twitter account.', 'wpstats' ); ?></p>
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
				<!-- Deauthorize / Deauthenticate -->
				<div id="wpstats-twitter-settings-deauthorize-section" class="wpstats-twitter-settings-tab-section wpstats-settings-tab-section">
					<div class="wpstats-card-settings-authorize-container">
						<h3><?php _e( 'Deauthorize', 'wpstats' ); ?></h3>
						<p><?php _e( 'Purge all Twitter authentication and cache data from your local install.', 'wpstats' ); ?></p>
						<p><strong><?php _e( 'All data that was collected will also be deleted.', 'wpstats' ); ?></strong></p>
						<?php $twitter_deauthorize_url = esc_attr( wpstats_api_twitter_get_deauthorization_url( wpstats_MASHBOARD_PAGE_URL ) ); ?>
						<a href="<?php echo $twitter_deauthorize_url; ?>" id="wpstats-twitter-deauthorize" class="wpstats-button"><?php _e( 'Deauthorize', 'wpstats' ); ?></a>
					</div>
				</div>
				<!-- Setup / Authorize / Authenticate -->
				<div id="wpstats-twitter-settings-authorize-section" class="wpstats-twitter-settings-tab-section wpstats-settings-tab-section">
					<h3><?php _e( 'Setup', 'wpstats' ); ?></h3>
					<p><?php _e( 'Click the button below to login to Twitter and authorize the application.', 'wpstats' ); ?></p>
					<p><strong><?php _e( 'Note: Full historical data for Twitter is not available. Data will be collected for you each day after you setup the integration and until you deauthorize.', 'wpstats' ); ?></strong></p>
					<a id="wpstats-twitter-authorize" href="<?php echo esc_attr( $twitter_authorization_url ); ?>" class="wpstats-button"><?php _e( 'Setup', 'wpstats' ); ?></a>
				</div>
			</div>

			<!-- Twitter Data Tab Data -->
			<div id="wpstats-twitter-data-tab-content">

				<!-- Twitter Historical Data Notice -->
				<div id="wpstats-twitter-historical-data-notice-container" class="wpstats-error-container">
					<p id="wpstats-twitter-historical-data-notice">
						<?php _e( 'Full historical data not available.', 'wpstats' ); ?>
						<a class="wpstats-read-more" data-tooltip=""><?php _e( 'Read more.', 'wpstats' ); ?></a>
					</p>
				</div>

				<!-- Twitter Chart -->
				<div id="wpstats-twitter-chart-container" class="wpstats-mashboard-chart-container wpstats-chart-container">
					<div id="wpstats-twitter-chart" class="wpstats-mashboard-chart"></div>
				</div>

				<!-- Twitter Data Points -->
				<div id="wpstats-twitter-data-points-container" class="wpstats-data-points-container">

					<!-- Favourites -->
					<div id="wpstats-twitter-favourites-data-point" class="wpstats-mashboard-data-point-column">
						<div class="wpstats-dashboard-data-point-header">
							<span id="wpstats-twitter-favorites-chart-key-icon">&nbsp;</span>
							<span class="wpstats-dashboard-data-point-heading"><?php _e( 'Favorites', 'wpstats' ); ?></span>
							<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Total number of your tweets that have been favorited by other users, during the selected period.', 'wpstats' ); ?>"></span>
						</div>
						<div class="wpstats-dashboard-data-point-content">
							<span id="wpstats-twitter-favourites" class="wpstats-data-point-value"></span>
						</div>
						<div class="wpstats-dashboard-data-point-footer">
							<span id="wpstats-twitter-favourites-change-direction" class="wpstats-data-point-change-direction"></span>
							<span id="wpstats-twitter-favourites-change" class="wpstats-data-point-change"></span>
							<?php $title = __( 'is the amount of times your Tweets have been favorited, by other users, during the previous period.', 'wpstats' ); ?>
							<span id="wpstats-twitter-favourites-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
						</div>
					</div>

					<!-- Mentions -->
					<div id="wpstats-twitter-mentions-data-point" class="wpstats-mashboard-data-point-column">
						<div class="wpstats-dashboard-data-point-header">
							<span id="wpstats-twitter-mentions-chart-key-icon">&nbsp;</span>
							<span class="wpstats-dashboard-data-point-heading"><?php _e( 'Mentions', 'wpstats' ); ?></span>
							<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Total number of times other users have mentioned you in a tweet, during the selected period.', 'wpstats' ); ?>"></span>
						</div>
						<div class="wpstats-dashboard-data-point-content">
							<span id="wpstats-twitter-mentions" class="wpstats-data-point-value"></span>
						</div>
						<div class="wpstats-dashboard-data-point-footer">
							<span id="wpstats-twitter-mentions-change-direction" class="wpstats-data-point-change-direction"></span>
							<span id="wpstats-twitter-mentions-change" class="wpstats-data-point-change"></span>
							<?php $title = __( 'is the amount of times you were mentioned in a tweet, by another user, in the previous period.', 'wpstats' ); ?>
							<span id="wpstats-twitter-mentions-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
						</div>
					</div>

					<!-- Retweets -->
					<div id="wpstats-twitter-retweets-data-point" class="wpstats-mashboard-data-point-column">
						<div class="wpstats-dashboard-data-point-header">
							<span class="wpstats-dashboard-data-point-heading"><?php _e( 'Retweets', 'wpstats' ); ?></span>
							<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Total number of your tweets that have been retweeted by other users, during the selected period.', 'wpstats' ); ?>"></span>
						</div>
						<div class="wpstats-dashboard-data-point-content">
							<span id="wpstats-twitter-retweets" class="wpstats-data-point-value"></span>
						</div>
						<div class="wpstats-dashboard-data-point-footer">
							<span id="wpstats-twitter-retweets-change-direction" class="wpstats-data-point-change-direction"></span>
							<span id="wpstats-twitter-retweets-change" class="wpstats-data-point-change"></span>
							<?php $title = __( 'is the amount of times your tweets were retweeted, by other users, during the previous period.', 'wpstats' ); ?>
							<span id="wpstats-twitter-retweets-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
						</div>
					</div>

					<!-- New Followers -->
					<div id="wpstats-twitter-followers-data-point" class="wpstats-mashboard-data-point-column">
						<div class="wpstats-dashboard-data-point-header">
							<span class="wpstats-dashboard-data-point-heading"><?php _e( 'New Followers', 'wpstats' ); ?></span>
							<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Total number of users who have followed you during the selected period.', 'wpstats' ); ?>"></span>
						</div>
						<div class="wpstats-dashboard-data-point-content">
							<span id="wpstats-twitter-followers" class="wpstats-data-point-value"></span>
						</div>
						<div class="wpstats-dashboard-data-point-footer">
							<span id="wpstats-twitter-followers-change-direction" class="wpstats-data-point-change-direction"></span>
							<span id="wpstats-twitter-followers-change" class="wpstats-data-point-change"></span>
							<?php $title = __( 'people followed you in the previous period.', 'wpstats' ); ?>
							<span id="wpstats-twitter-followers-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
						</div>
					</div>

					<!-- Tweets -->
					<div id="wpstats-twitter-tweets-data-point" class="wpstats-mashboard-data-point-column">
						<div class="wpstats-dashboard-data-point-header">
							<span class="wpstats-dashboard-data-point-heading"><?php _e( 'Tweets', 'wpstats' ); ?></span>
							<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Total number of tweets posted to Twitter, including retweets and replies, during the selected period.', 'wpstats' ); ?>"></span>
						</div>
						<div class="wpstats-dashboard-data-point-content">
							<span id="wpstats-twitter-tweets" class="wpstats-data-point-value"></span>
						</div>
						<div class="wpstats-dashboard-data-point-footer">
							<span id="wpstats-twitter-tweets-change-direction" class="wpstats-data-point-change-direction"></span>
							<span id="wpstats-twitter-tweets-change" class="wpstats-data-point-change"></span>
							<?php $title = __( 'tweets were posted by you in the previous period.', 'wpstats' ); ?>
							<span id="wpstats-twitter-tweets-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
						</div>
					</div>

					<!-- Following -->
					<div id="wpstats-twitter-following-data-point" class="wpstats-mashboard-data-point-column">
						<div class="wpstats-dashboard-data-point-header">
							<span class="wpstats-dashboard-data-point-heading"><?php _e( 'Following', 'wpstats' ); ?></span>
							<span class="wpstats-dashboard-data-point-heading-info wpstats-tooltip" data-tooltip="<?php _e( 'Total number of users you have followed during the selected period.', 'wpstats' ); ?>"></span>
						</div>
						<div class="wpstats-dashboard-data-point-content">
							<span id="wpstats-twitter-following" class="wpstats-data-point-value"></span>
						</div>
						<div class="wpstats-dashboard-data-point-footer">
							<span id="wpstats-twitter-following-change-direction" class="wpstats-data-point-change-direction"></span>
							<span id="wpstats-twitter-following-change" class="wpstats-data-point-change"></span>
							<?php $title = __( 'is the amount of people you followed in the previous period.', 'wpstats' ); ?>
							<span id="wpstats-twitter-following-change-info" class="wpstats-dashboard-data-point-heading-info wpstats-tooltip wpstats-service-data-point-change-percentage-info" data-tooltip-backup="<?php echo $title; ?>" data-tooltip="<?php echo $title; ?>"></span>
						</div>
					</div>
				</div>

				<!-- Details -->
				<div class="wpstats-card-details-container">
					<span class="wpstats-card-details">
						<a class="wpstats-card-details-link wpstats-tooltip" href="<?php echo admin_url( 'admin.php?page=wpstats-twitter' ); ?>" data-tooltip="<?php _e( 'View detailed information about your Twitter account.', 'wpstats' ); ?>">
							<?php _e( 'View Details', 'wpstats' ); ?>
						</a>
					</span>
				</div>
			</div> <!-- #wpstats-twitter-data-tab-content -->
		</div> <!-- #wpstats-twitter-card-content -->
	</div> <!-- .wpstats-card -->
</div> <!-- #twitter_3# -->