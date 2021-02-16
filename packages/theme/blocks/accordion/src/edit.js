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
	ToggleControl,
	TextControl
} from "@wordpress/components"

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export default function Edit({ attributes, setAttributes }) {
	const ALLOWED_BLOCKS = [ 'zhp/accordion-item' ];
	function setMultiple(value) {
		setAttributes({multiple: value})
	}
	function setFirstOpen(value) {
		setAttributes({firstOpen: value})
	}
	return ([
		<InspectorControls>
			<PanelBody title="Właściwości">
				<ToggleControl
					label="Wiele zakładek"
					help={attributes.multiple ? 'Dozwolone jest otwieranie wielu zakładek.' : 'Przełącz, aby umożliwić otiweranie wielu zakładek.'}
					checked={attributes.multiple}
					onChange={setMultiple}
				/>
				<TextControl
					label="Otwarta zakładka"
					help="Wpisz tytuł zakładki, która powinna być otwarta po załadowaniu."
					value={attributes.firstOpen}
					onChange={setFirstOpen}
					/>
			</PanelBody>
		</InspectorControls>,
		<div>
			<InnerBlocks
				allowedBlocks={ALLOWED_BLOCKS}
			/>
		</div>
	]);
}
