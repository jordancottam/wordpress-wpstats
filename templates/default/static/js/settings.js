/*http://www.jslint.com/*/
/*jslint white: true */
/*global jQuery, window, ajaxurl, console, wpstats_settings: true*/
jQuery( window ).ready( function( $ ) {

	$( '#wpstats-settings-accordion' ).accordion({
		animate: 'swing',
		collapsible: true,
		header: 'h3',
		heightStyle: 'content',
		icons: {
			'header': 'wpstats-accordion-header-icon',
			'activeHeader': 'wpstats-accordion-header-active-icon'
		},
		create: function( event, ui ) {
			$( '#wpstats_reports_users_allowed_access' ).chosen({
				width: '100%'
			});
			$( '#wpstats_settings_users_allowed_access').chosen({
				width: '100%'
			});
		}
	});

	/* Validate license automatically with no need to refresh page */
	$( '#validate_license' ).click( function ( e ) {
		e.preventDefault();
		var $loadingIcon = $( '#wpstats-settings-validate-license-loading-container' ),
			$successTarget = $( '#wpstats-successful-license-validation-request' ),
			$errorTarget = $( '#wpstats-unsuccessful-license-validation-request' ),
			$validateTarget = $( this ),
			licenseKey = $( '#license_key' ).val();

		$successTarget.add( $errorTarget ).add( $validateTarget ).fadeOut( 400 ).promise().done( function() {
			$loadingIcon.fadeIn( 400, function() {
				$.get( ajaxurl, {
					action: 'wpstats_ajax_licensing_validate_license',
					license_key: licenseKey
				}, function ( response ) {
					response = $.parseJSON( response );

					if ( 'success' === response[ 'responseType' ] ) {

						// Save license type
						$.post( ajaxurl, {
							action: 'wpstats_ajax_licensing_save_license_type',
							license_type: response[ 'data' ][ 'licenseType' ]
						});

						switch ( response[ 'responseContext' ] ) {
							case 'license_activated':
								$successTarget.html( wpstats_settings[ 'trans' ][ 'licensing' ][ 'license_activated' ] );
								break;
							case 'license_valid':
							default:
								$successTarget.html( wpstats_settings[ 'trans' ][ 'licensing' ][ 'license_valid' ] );
								break;
						}
						$loadingIcon.fadeOut( 400, function () {
							$successTarget.fadeIn();
							$validateTarget.fadeIn();
						});
					} else if ( 'error' === response[ 'responseType' ] ) {
						switch ( response[ 'responseContext' ] ) {
							case 'license_invalid':
								$errorTarget.html( wpstats_settings[ 'trans' ][ 'licensing' ][ 'license_invalid' ] );
								break;
							case 'missing_license_key':
								$errorTarget.html( wpstats_settings[ 'trans' ][ 'licensing' ][ 'missing_license_key' ] );
								break;
							case 'error_initializing_request':
								$errorTarget.html( wpstats_settings[ 'trans' ][ 'licensing' ][ 'error_initializing_request' ] );
								break;
							case 'error_executing_request':
								$errorTarget.html( wpstats_settings[ 'trans' ][ 'licensing' ][ 'error_executing_request' ] );
								break;
							case 'malformed_response':
								$errorTarget.html( wpstats_settings[ 'trans' ][ 'licensing' ][ 'malformed_response' ] );
								break;
							case 'license_site_inactive_no_activations_left':
								$errorTarget.html( wpstats_settings[ 'trans' ][ 'licensing' ][ 'license_site_inactive_no_activations_left' ] );
								break;
							case 'license_site_inactive_activation_error':
								$errorTarget.html( wpstats_settings[ 'trans' ][ 'licensing' ][ 'license_site_inactive_activation_error' ] );
								break;
							case 'license_inactive_no_activations_left':
								$errorTarget.html( wpstats_settings[ 'trans' ][ 'licensing' ][ 'license_inactive_no_activations_left' ] );
								break;
							case 'license_inactive_activation_error':
								$errorTarget.html( wpstats_settings[ 'trans' ][ 'licensing' ][ 'license_inactive_activation_error' ] );
								break;
							case 'license_expired':
								var licenseExpiredMsg = wpstats_settings[ 'trans' ][ 'licensing' ][ 'license_expired' ];
								licenseExpiredMsg = licenseExpiredMsg.replace( '{LICENSE_KEY}', licenseKey );
								$errorTarget.html( licenseExpiredMsg );
								break;
							case 'license_disabled':
								$errorTarget.html( wpstats_settings[ 'trans' ][ 'licensing' ][ 'license_disabled' ] );
								break;
							case 'http_error':
								$errorTarget.html( wpstats_settings[ 'trans' ][ 'licensing' ][ 'http_error' ] );
								break;
							case 'license_unknown_status':
							default:
								$errorTarget.html( wpstats_settings[ 'trans' ][ 'licensing' ][ 'license_unknown_status' ] );
								break;
						}
						$loadingIcon.fadeOut( 400, function () {
							$errorTarget.fadeIn();
							$validateTarget.fadeIn();
						});
					}
				});
			});
		});
	});

	/* Allow images to be uploaded and set automatically */
	var uploadImageInputs = [],
		uploadImageButtons = [],
		uploadImageURLPlaceholders = [];

	$( '.wpstats-upload-image' ).each( function ( i, v ) {

		var $this = $( v ),
			$uploadImgButton = $this.prev(),
			$loadingImg = $( '.wpstats-loading-container' ).first().clone();

		$loadingImg.attr( 'id', '' );
		$loadingImg.attr( 'style', 'margin-top: 10px;' );

		uploadImageInputs[i] = $this;
		uploadImageButtons[i] = $uploadImgButton;
		uploadImageURLPlaceholders[i] = $uploadImgButton.parent().prev().children().first();

		$this.fileupload( {
			dataType: 'json',
			formData: { action: 'wpstats_ajax_upload_image' },
			url: ajaxurl,
			add: function ( e, data ) {
				uploadImageButtons[i].hide();
				$loadingImg.insertAfter( uploadImageButtons[i] );
				$loadingImg.show();
				data.submit();
			},
			done: function ( e, data ) {
				var newImageURL = data.result;
				$loadingImg.remove();
				if ( newImageURL ) {
					uploadImageURLPlaceholders[i].val( newImageURL );
				}
				uploadImageButtons[i].show();
			}
		} );
	} );

	/* Save settings without need for refresh */
	$( '#save_settings' ).click( function( e ) {
		e.preventDefault();
		var mashboardCardsVisibilityStatus = {};
		$( "input[name='wpstats_mashboard_cards_visiblity_status[]' ]").each( function() {
			mashboardCardsVisibilityStatus[ $( this ).val() ] = ( true == this.checked ) ? '1' : '0';
		});
		var $loadingImg = $( '#wpstats-settings-save-settings-loading-container' ),
			$saveSettingsButton = $( this ),
			$saveSettingsResult = $( '#wpstats-save-settings-result' );
		$loadingImg.show();
		console.log($( '#wpstats_settings_users_allowed_access' ).val());
		$saveSettingsButton.add( $saveSettingsResult ).fadeOut( 400 ).promise().done( function() {
			$loadingImg.fadeIn( 400, function() {
				$.post( ajaxurl, {
					action: 'wpstats_ajax_settings_save_settings',
					brand_name: $( '#brand_name' ).val(),
					brand_menu_name: $( '#brand_menu_name' ).val(),
					brand_logo_image_url: $( '#brand_logo_image_url' ).val(),
					brand_background_image_url: $( '#brand_background_image_url' ).val(),
					brand_background_color: $( '#brand_background_color' ).val(),
					wpstats_date_range_label_color: $( '#wpstats_date_range_label_color' ).val(),
					default_dashboard: $( '#default_dashboard' ).val(),
					cache_mode: $( '#cache_mode' ).val(),
					mashboard_cards_visibility_status: mashboardCardsVisibilityStatus,
					wpstats_reports_users_allowed_access: $( '#wpstats_reports_users_allowed_access').val(),
					wpstats_mashboard_menu_name: $( '#wpstats_mashboard_menu_name').val(),
					wpstats_settings_users_allowed_access : $( '#wpstats_settings_users_allowed_access' ).val()
				}, function () {
					$loadingImg.fadeOut( 400, function() {
						$saveSettingsResult.add( $saveSettingsButton ).fadeIn( 400 ).promise().done( function() {} );
					});
				});
			});
		});
	});

	// Use WP native colorpicker on versions 3.5+
	if ( wpstats_settings.wp_version >= '3.5' ) {
		$( '#brand_background_color' ).wpColorPicker();
		$( '#wpstats_date_range_label_color' ).wpColorPicker();
	// Fallback to different colorpicker for versions < 3.5.
	} else {
		$( '#brand_background_color' ).ColorPicker( {
			onChange: function ( hsb, hex, rgb, el ) {
				$( '#brand_background_color' ).val( '#' + hex );
			},
			onSubmit: function ( hsb, hex, rgb, el ) {
				var $el = $( el );
				$el.val( '#' + hex );
				$el.ColorPickerHide();
			}
		} );
		$( '#wpstats_date_range_label_color').ColorPicker( {
			onChange: function ( hsb, hex, rgb, el ) {
				$( '#wpstats_date_range_label_color').val( '#' + hex );
			},
			onSubmit: function ( hsb, hex, rgb, el ) {
				var $el = $( el );
				$el.val( '#' + hex );
				$el.ColorPickerHide();
			}
		});
	}
});