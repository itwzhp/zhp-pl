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
	return (
		<z-section
			style={{
				'--section-content-align-items': attributes.alignment.vertical,
				'--section-content-justify-content': attributes.alignment.horizontal,
				backgroundImage: `url('${attributes.backgroundImage.src}')`,
				backgroundSize: attributes.backgroundImage.size,
				backgroundAttachment: attributes.backgroundImage.attachment,
				backgroundColor: attributes.backgroundColor,
				backgroundPosition: attributes.backgroundImage.position,
				color: attributes.textColor,
				height: attributes.size.sectionHeight.value ? `${attributes.size.sectionHeight.value}${attributes.size.sectionHeight.unit}` : 'auto'
			}}
			className={attributes.size.fullWidth && 'z-section--full'}
		>
			<InnerBlocks.Content />
		</z-section>
	);
}
