<?php
/**
 * Plugin Name:       Multiple Blocks
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Sifat
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       multiple-blocks
 *
 * @package CreateBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


function create_block_multiple_blocks_block_init() {
	$blocks = array(
		'first-block',
		'second-block'
	);
	foreach ($blocks as $block) {
		register_block_type( __DIR__ ."/build/{$block}" );
	};
	
	add_action( 'admin_enqueue_scripts', 'multiple_blocks_scripts' );
}
add_action( 'init', 'create_block_multiple_blocks_block_init' );


function multiple_blocks_scripts() {
	$handle = 'create-block/first-block-editor-script';

	$data = get_transient( 'multiple-blocks' );

	if ( ! $data ) {
		$response = wp_remote_get( 'https://jsonplaceholder.typicode.com/users' );
		$data = wp_remote_retrieve_body( $response );
		$data = json_decode( $data );

		set_transient( 'multiple-blocks', $data, 7 * DAY_IN_SECONDS );
	}

	wp_localize_script( $handle, 'multipleBlocksData', $data );
}