/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-block-editor/#useBlockProps
 */
import { InnerBlocks, useBlockProps } from '@wordpress/block-editor';

/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into `post_content`.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-edit-save/#save
 *
 * @return {WPElement} Element to render.
 */
export default function save({attributes}) {
	const {thumbnail, title, description, to, hasOverlay} = attributes
	const classes = {
		'z-card--overlayed': hasOverlay,
		'z-card--pictured': hasOverlay
	}
	const className = Object.keys(classes).reduce(
		(array, key) =>
			(classes[key] ? [...array, key] : array), []
	)
		.join(' ')
	return (
		<z-card to={to} title={title} description={description} thumbnail={thumbnail} className={className}/>
	);
}
