<?php
function create_block_accordion_item_block_init() {
	$dir = __DIR__;

	$script_asset_path = "$dir/build/index.asset.php";
	if ( ! file_exists( $script_asset_path ) ) {
		throw new Error(
			'You need to run `npm start` or `npm run build` for the "create-block/accordion" block first.'
		);
	}
	$index_js     = '/blocks/accordion-item/build/index.js';
	$script_asset = require( $script_asset_path );
	wp_register_script(
		'create-block-accordion-item-block-editor',
		get_template_directory_uri().$index_js,
		$script_asset['dependencies'],
		$script_asset['version']
	);

	register_block_type(
		'zhp/accordion-item',
		array(
			'editor_script' => 'create-block-accordion-item-block-editor'
		)
	);
}
add_action( 'init', 'create_block_accordion_item_block_init' );
