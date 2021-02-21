/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-block-editor/#useBlockProps
 */
import {
	InnerBlocks,
	useBlockProps,
	InspectorControls,
} from '@wordpress/block-editor';
import {
	PanelBody,
	RangeControl,
} from "@wordpress/components"
import { __experimentalNumberControl as NumberControl } from '@wordpress/components';
import './editor.scss';
/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export default function Edit({ attributes, setAttributes }) {
	function setCell(value) {
		setAttributes({cell: value})
	}
	return ([
		<InspectorControls>
			<PanelBody title="Szerokość kolumny">
				<RangeControl
					value={attributes.cell}
					min={1}
					max={12}
					onChange={setCell}
				/>
			</PanelBody>
		</InspectorControls>,
		<div {...useBlockProps()} style={{gridColumn: `span ${attributes.cell}`}}>
			<InnerBlocks templateLock={false}/>
		</div>
	]);
}
