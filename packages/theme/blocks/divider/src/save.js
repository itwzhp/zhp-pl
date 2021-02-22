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
	const attributesToStyle = (attributes) => {
		const {
			background,
			width,
			height,
			alignment,
			margin
		} = attributes;

		const alignmentMap = {
			center: "0 auto",
			right: "0 0 0 auto"
		}

		const style = {
			'--divider-background': background,
			'--divider-width': `${width}%`,
			'--divider-height': `${height}px`,
			'margin': alignment && alignmentMap[alignment],
			'margin-top': margin.top && `${margin.top}px`,
			'margin-bottom': margin.bottom && `${margin.bottom}px`
		}
		const dividerStyle = Object.keys(style).reduce((object,key)=>(
			style[key]
				? {...object, [key]: style[key]}
				: object
		), {})

		return dividerStyle
	}
	const style = attributesToStyle(attributes);
	return (<z-divider style={style}/>);
}
