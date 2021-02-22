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
			verticalAlignment,
			fullWidth,
			heightValue,
			heightUnit,
			textColor,
			backgroundColor,
			overlayColor,
			overlayOpacity,
			backgroundImageSrc,
			backgroundImageAttachment,
			backgroundImagePosition,
			backgroundImageSize,
			margin,
			marginDesktop,
			padding,
			paddingDesktop,
		} = attributes;
		const verticalAlignmentMap = {
			top: 'start',
			center: 'center',
			bottom: 'end'
		}

		const sectionBackground = fullWidth
			? {
				'background': `${backgroundImageSrc ? 'url('+backgroundImageSrc+')' : ''}${backgroundImageSrc && backgroundColor ? ', ' : ''}${backgroundColor ? backgroundColor : ''}`,
				'background-position': backgroundImagePosition,
				'background-size': backgroundImageSize,
				'background-attachment': backgroundImageAttachment
			}
			: {}

		const contentBackground = fullWidth
			? {}
			: {
				'background': `${backgroundImageSrc ? 'url('+backgroundImageSrc+')' : ''}${backgroundImageSrc && backgroundColor ? ', ' : ''}${backgroundColor ? backgroundColor : ''}`,
				'background-position': backgroundImagePosition,
				'background-size': backgroundImageSize,
				'background-attachment': backgroundImageAttachment
			}

		const section = {
			'--section-padding': Object.values(padding).some((val)=>(val > 0))  && `${padding.top}px ${padding.right}px ${padding.bottom}px ${padding.left}px`,
			'--section-desktop-padding': Object.values(paddingDesktop).some((val)=>(val > 0))  && `${paddingDesktop.top}px ${paddingDesktop.right}px ${paddingDesktop.bottom}px ${paddingDesktop.left}px`,
			'--section-margin': Object.values(margin).some((val)=>(val > 0))  && `${margin.top}px ${margin.right}px ${margin.bottom}px ${margin.left}px`,
			'--section-desktop-margin': Object.values(marginDesktop).some((val)=>(val > 0))  && `${marginDesktop.top}px ${marginDesktop.right}px ${marginDesktop.bottom}px ${marginDesktop.left}px`,
			'--section-color': textColor,
			'--section-overlay-background': overlayColor,
			'--section-overlay-opacity': `${overlayOpacity}%`,
			...sectionBackground
		}
		const sectionStyle = Object.keys(section).reduce((object,key)=>(
			section[key]
				? {...object, [key]: section[key]}
				: object
		), {})

		const content = {
			'--section-content-min-height': heightValue !== '0' && `${heightValue}${heightUnit}`,
			'--section-content-align-items': verticalAlignmentMap[verticalAlignment],
			...contentBackground
		}
		const contentStyle = Object.keys(content).reduce((object,key)=>(
			content[key]
				? {...object, [key]: content[key]}
				: object
		), {})

		const initial = {
			'--section-content-min-height': '100%',
			'--section-padding': '0',
			'--section-margin': '0',
			'--section-desktop-padding': '0',
			'--section-desktop-margin': '0',
		}

		return {
			...initial,
			...sectionStyle,
			...contentStyle,
		}
	}
	const style = attributesToStyle(attributes);
	return (
		<z-section tag={'div'} style={style}>
			<InnerBlocks.Content />
		</z-section>
	);
}
