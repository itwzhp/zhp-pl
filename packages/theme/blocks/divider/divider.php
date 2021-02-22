<?php
function create_block_divider_block_init() {
	$dir = __DIR__;

	$script_asset_path = "$dir/build/index.asset.php";
	if ( ! file_exists( $script_asset_path ) ) {
		throw new Error(
			'You need to run `npm start` or `npm run build` for the "create-block/divider" block first.'
		);
	}
	$index_js     = '/blocks/divider/build/index.js';
	$script_asset = require( $script_asset_path );
	wp_register_script(
		'create-block-divider-block-editor',
		get_template_directory_uri().$index_js,
		$script_asset['dependencies'],
		$script_asset['version']
	);
	$editor_css = '/blocks/divider/build/index.css';
	wp_register_style(
		'create-block-divider-block-editor',
		get_template_directory_uri().$editor_css,
		array(),
		filemtime( "$dir/build/index.css" )
	);
	register_block_type(
		'zhp/divider',
		array(
			'editor_script' => 'create-block-divider-block-editor',
			'editor_style' => 'create-block-divider-block-editor'
		)
	);
}
add_action( 'init', 'create_block_divider_block_init' );
