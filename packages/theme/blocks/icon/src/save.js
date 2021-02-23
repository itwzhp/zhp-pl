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
	const {icon} = attributes;
	const attributesToStyle = (attributes) => {
		const {
			color,
			alignment,
			size,
		} = attributes;


		const alignmentMap = {
			center: "center",
			right: "flex-end"
		}

		const style = {
			'color': color,
			'justify-content': alignment && alignmentMap[alignment],
			'font-size': size !== 16 && size
		}
		const iconStyle = Object.keys(style).reduce((object,key)=>(
			style[key]
				? {...object, [key]: style[key]}
				: object
		), {})

		return iconStyle
	}
	const style = attributesToStyle(attributes);
	return (
		<div className={'icon'} style={style}>
			<i className={icon}/>
		</div>
	);
}
