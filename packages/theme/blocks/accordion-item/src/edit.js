/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-block-editor/#useBlockProps
 */
import {
	RichText,
	InnerBlocks,
	useBlockProps,
	registerBlockType
} from '@wordpress/block-editor';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export default function Edit({ attributes, setAttributes }) {
	function setTitle(value) {
		setAttributes({title: value})
	}
	return ([
		<div {...useBlockProps()}>
			<RichText key="editable" tagName="p" placeholder="Proszę podać tytuł bloku." value={attributes.title} onChange={setTitle}/>
			<InnerBlocks/>
		</div>
	]);
}
