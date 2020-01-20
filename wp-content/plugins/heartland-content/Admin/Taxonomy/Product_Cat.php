<?php

namespace Heartland\Content\Admin\Taxonomy;

use Heartland\Content\Admin\Helpers;
use Heartland\Content\Main;

class Product_Cat {

	public function __construct() {
		// Add form
		add_action( 'product_cat_add_form_fields', array( $this, 'add_category_fields' ) );
		add_action( 'product_cat_edit_form_fields', array( $this, 'edit_category_fields' ), 10 );
		add_action( 'created_term', array( $this, 'save_category_fields' ), 10, 3 );
		add_action( 'edit_term', array( $this, 'save_category_fields' ), 10, 3 );
	}

	/**
	 * Category background fields.
	 */
	public function add_category_fields() {
		?>
		<div class="form-field term-background-wrap">
			<label><?php _e( 'Background Image', 'woocommerce' ); ?></label>
			<div id="product_cat_background" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( wc_placeholder_img_src() ); ?>" width="60px" height="60px" /></div>
			<div style="line-height: 60px;">
				<input type="hidden" id="product_cat_background_id" name="product_cat_background_id" />
				<button type="button" class="upload_image_button_1 button"><?php _e( 'Upload/Add image', 'woocommerce' ); ?></button>
				<button type="button" class="remove_image_button_1 button"><?php _e( 'Remove image', 'woocommerce' ); ?></button>
			</div>
			<script type="text/javascript">

				// Only show the "remove image" button when needed
				if ( ! jQuery( '#product_cat_background_id' ).val() ) {
					jQuery( '.remove_image_button_1' ).hide();
				}

				// Uploading files
				var file_frame;

				jQuery( document ).on( 'click', '.upload_image_button_1', function( event ) {

					event.preventDefault();

					// If the media frame already exists, reopen it.
					if ( file_frame ) {
						file_frame.open();
						return;
					}

					// Create the media frame.
					file_frame = wp.media.frames.downloadable_file = wp.media({
						title: '<?php _e( "Choose an image", "woocommerce" ); ?>',
						button: {
							text: '<?php _e( "Use image", "woocommerce" ); ?>'
						},
						multiple: false
					});

					// When an image is selected, run a callback.
					file_frame.on( 'select', function() {
						var attachment           = file_frame.state().get( 'selection' ).first().toJSON();
						var attachment_background = attachment.sizes.background || attachment.sizes.full;

						jQuery( '#product_cat_background_id' ).val( attachment.id );
						jQuery( '#product_cat_background' ).find( 'img' ).attr( 'src', attachment_background.url );
						jQuery( '.remove_image_button_1' ).show();
					});

					// Finally, open the modal.
					file_frame.open();
				});

				jQuery( document ).on( 'click', '.remove_image_button_1', function() {
					jQuery( '#product_cat_background' ).find( 'img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
					jQuery( '#product_cat_background_id' ).val( '' );
					jQuery( '.remove_image_button_1' ).hide();
					return false;
				});

				jQuery( document ).ajaxComplete( function( event, request, options ) {
					if ( request && 4 === request.readyState && 200 === request.status
						&& options.data && 0 <= options.data.indexOf( 'action=add-tag' ) ) {

						var res = wpAjax.parseAjaxResponse( request.responseXML, 'ajax-response' );
						if ( ! res || res.errors ) {
							return;
						}
						// Clear Background Image fields on submit
						jQuery( '#product_cat_background' ).find( 'img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
						jQuery( '#product_cat_background_id' ).val( '' );
						jQuery( '.remove_image_button_1' ).hide();
						// Clear Display type field on submit
						jQuery( '#display_type' ).val( '' );
						return;
					}
				} );

			</script>
			<div class="clear"></div>
		</div>
		<?php
	}

	/**
	 * Edit category background field.
	 *
	 * @param mixed $term Term (category) being edited
	 */
	public function edit_category_fields( $term ) {

		$display_type = get_woocommerce_term_meta( $term->term_id, 'display_type', true );
		$background_id = absint( get_woocommerce_term_meta( $term->term_id, 'background_id', true ) );

		if ( $background_id ) {
			$image = wp_get_attachment_thumb_url( $background_id );
		} else {
			$image = wc_placeholder_img_src();
		}
		?>
		<tr class="form-field">
			<th scope="row" valign="top"><label><?php _e( 'Display type', 'woocommerce' ); ?></label></th>
			<td>
				<select id="display_type" name="display_type" class="postform">
					<option value="" <?php selected( '', $display_type ); ?>><?php _e( 'Default', 'woocommerce' ); ?></option>
					<option value="products" <?php selected( 'products', $display_type ); ?>><?php _e( 'Products', 'woocommerce' ); ?></option>
					<option value="subcategories" <?php selected( 'subcategories', $display_type ); ?>><?php _e( 'Subcategories', 'woocommerce' ); ?></option>
					<option value="both" <?php selected( 'both', $display_type ); ?>><?php _e( 'Both', 'woocommerce' ); ?></option>
				</select>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row" valign="top"><label><?php _e( 'Background Image', 'woocommerce' ); ?></label></th>
			<td>
				<div id="product_cat_background" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( $image ); ?>" width="60px" height="60px" /></div>
				<div style="line-height: 60px;">
					<input type="hidden" id="product_cat_background_id" name="product_cat_background_id" value="<?php echo $background_id; ?>" />
					<button type="button" class="upload_image_button_1 button"><?php _e( 'Upload/Add image', 'woocommerce' ); ?></button>
					<button type="button" class="remove_image_button_1 button"><?php _e( 'Remove image', 'woocommerce' ); ?></button>
				</div>
				<script type="text/javascript">

					// Only show the "remove image" button when needed
					if ( '0' === jQuery( '#product_cat_background_id' ).val() ) {
						jQuery( '.remove_image_button_1' ).hide();
					}

					// Uploading files
					var file_frame;

					jQuery( document ).on( 'click', '.upload_image_button_1', function( event ) {

						event.preventDefault();

						// If the media frame already exists, reopen it.
						if ( file_frame ) {
							file_frame.open();
							return;
						}

						// Create the media frame.
						file_frame = wp.media.frames.downloadable_file = wp.media({
							title: '<?php _e( "Choose an image", "woocommerce" ); ?>',
							button: {
								text: '<?php _e( "Use image", "woocommerce" ); ?>'
							},
							multiple: false
						});

						// When an image is selected, run a callback.
						file_frame.on( 'select', function() {
							var attachment           = file_frame.state().get( 'selection' ).first().toJSON();
							var attachment_background = attachment.sizes.background || attachment.sizes.full;

							jQuery( '#product_cat_background_id' ).val( attachment.id );
							jQuery( '#product_cat_background' ).find( 'img' ).attr( 'src', attachment_background.url );
							jQuery( '.remove_image_button_1' ).show();
						});

						// Finally, open the modal.
						file_frame.open();
					});

					jQuery( document ).on( 'click', '.remove_image_button_1', function() {
						jQuery( '#product_cat_background' ).find( 'img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
						jQuery( '#product_cat_background_id' ).val( '' );
						jQuery( '.remove_image_button_1' ).hide();
						return false;
					});

				</script>
				<div class="clear"></div>
			</td>
		</tr>
		<?php
	}

	/**
	 * save_category_fields function.
	 *
	 * @param mixed $term_id Term ID being saved
	 * @param mixed $tt_id
	 * @param string $taxonomy
	 */
	public function save_category_fields( $term_id, $tt_id = '', $taxonomy = '' ) {
		if ( isset( $_POST['display_type'] ) && 'product_cat' === $taxonomy ) {
			update_woocommerce_term_meta( $term_id, 'display_type', esc_attr( $_POST['display_type'] ) );
		}
		if ( isset( $_POST['product_cat_background_id'] ) && 'product_cat' === $taxonomy ) {
			update_woocommerce_term_meta( $term_id, 'background_id', absint( $_POST['product_cat_background_id'] ) );
		}
	}
}
