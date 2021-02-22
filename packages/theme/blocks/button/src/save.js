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
	const {to, color, background, label, hasFullWidth, modifier} = attributes;
	const attributesToStyle = (attributes) => {
		const {
			color,
			background,
			modifier,
			hasFullWidth,
			alignment,
		} = attributes;

		const alignmentMap = {
			center: "0 auto",
			right: "0 0 0 auto"
		}
		const style = {
			'--button-color': modifier!== 'text' && color,
			'--button-text-color': modifier === 'text' && color,
			'--button-background': modifier!== 'text' && background,
			'margin': alignment && alignmentMap[alignment],
			'--button-display': alignment && 'flex'
		}
		const buttonStyle = Object.keys(style).reduce((object,key)=>(
			style[key]
				? {...object, [key]: style[key]}
				: object
		), {})

		return buttonStyle
	}
	const style = attributesToStyle(attributes);
	const classes = {
		'z-button--text': modifier === 'text',
		'z-button--full': hasFullWidth
	}
	const className = Object.keys(classes).reduce(
		(array, key) =>
			(classes[key] ? [...array, key] : array), []
	)
		.join(' ')
	return (
		<z-button to={to} color={color} background={background} style={style} className={className}>
			{label}
		</z-button>
	);
}
