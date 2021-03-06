<?php
function create_block_icon_block_init() {
	$dir = __DIR__;

	$script_asset_path = "$dir/build/index.asset.php";
	if ( ! file_exists( $script_asset_path ) ) {
		throw new Error(
			'You need to run `npm start` or `npm run build` for the "create-block/icon" block first.'
		);
	}
	$index_js     = '/blocks/icon/build/index.js';
	$script_asset = require( $script_asset_path );
	wp_register_script(
		'create-block-icon-block-editor',
		get_template_directory_uri().$index_js,
		$script_asset['dependencies'],
		$script_asset['version']
	);
	$editor_css = '/blocks/icon/build/index.css';
	wp_register_style(
		'create-block-icon-block-editor',
		get_template_directory_uri().$editor_css,
		array(),
		filemtime( "$dir/build/index.css" )
	);
	register_block_type(
		'zhp/icon',
		array(
			'editor_script' => 'create-block-icon-block-editor',
			'editor_style' => 'create-block-icon-block-editor'
		)
	);
}
add_action( 'init', 'create_block_icon_block_init' );
