<?php
/**
 * Plugin Name: Custom meta box in woocommerce order page
 * Description: add custom meta box in woocommerce order page.
 * version: 1.0.0
 * Author: Webkul
 * Domain Path: /languages
 *
 * @package Custom meta box in woocommerce order page
 *
 */


if ( ! function_exists( 'wkmetabox_includes' ) ) {
	/**
	 * Includes function
	 *
	 * @return void
	 */
	function wkmetabox_includes() {
		// Add custom meta box to WooCommerce orders page
		add_action( 'add_meta_boxes', 'custom_order_meta_box' );

		// Save custom meta box data
		add_action( 'save_post_shop_order', 'save_custom_order_meta_box_data' );
	}


	add_action( 'plugins_loaded', 'wkmetabox_includes' );
}


function custom_order_meta_box() {
	add_meta_box(
		'custom-order-meta-box',
		__( 'Custom Meta Box', 'webkul' ),
		'custom_order_meta_box_callback',
		'shop_order',
		'advanced',
		'core'
	);
}

// Callback function for custom meta box
function custom_order_meta_box_callback( $post ) {
	// Get the saved value
	$custom_value = get_post_meta( $post->ID, '_custom_value', true );

	// Output the input field
	echo '<p><label for="custom-value">' . __( 'Custom Value:', 'webkul' ) . '</label> ';
	echo '<input type="text" id="custom-value" name="custom_value" value="' . esc_attr( $custom_value ) . '" /></p>';
}

function save_custom_order_meta_box_data( $post_id ) {
	if ( isset( $_POST['custom_value'] ) ) {
		$custom_value = sanitize_text_field( $_POST['custom_value'] );
		update_post_meta( $post_id, '_custom_value', $custom_value );
	}
}
