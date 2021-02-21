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
	MediaUpload,
	ColorPalette,
} from '@wordpress/block-editor';
import {
	PanelBody,
	RangeControl,
	SelectControl,
	Button,
	ToggleControl,
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
	const ALLOWED_BLOCKS = [ 'zhp/column' ];
	const ALLOWED_MEDIA_TYPES = ['image']
	// [...Array(attributes.columns)].map(()=>(['zhp/column']));
	function setColumns(value) {
		setAttributes({columns: value})
	}
	function setBackgroundColor(value) {
		setAttributes({backgroundColor: value})
	}
	function setTextColor(value) {
		setAttributes({textColor: value})
	}
	function setSrc(value) {
		setAttributes({backgroundImage: {...attributes.backgroundImage, src: value.sizes.full.url}})
	}
	function setSize(value) {
		setAttributes({backgroundImage: {...attributes.backgroundImage, size: value}})
	}
	function setPosition(value) {
		setAttributes({backgroundImage: {...attributes.backgroundImage, position: value}})
	}
	function setAttachment(value) {
		setAttributes({backgroundImage: {...attributes.backgroundImage, attachment: value}})
	}
	function setSectionHeight(value) {
		setAttributes({size: {...attributes.size, sectionHeight: {...attributes.size.sectionHeight, value}}})
	}
	function setSectionHeightUnit(value) {
		setAttributes({size: {...attributes.size, sectionHeight: {...attributes.size.sectionHeight, unit: value}}})
	}
	function setSectionWidth(value) {
		setAttributes({size: {...attributes.size, fullWidth: value}})
	}
	function setAlignmentHorizontal(value) {
		setAttributes({alignment: {...attributes.alignment, horizontal: value}})
	}
	function setAlignmentVertical(value) {
		setAttributes({alignment: {...attributes.size, vertical: value}})
	}
	return ([
		<InspectorControls>
			<PanelBody title="Kolumny" initialOpen={ true }>
				<RangeControl
					value={attributes.columns}
					min={1}
					max={12}
					onChange={setColumns}
				/>
			</PanelBody>
			<PanelBody title="Rozmiar" initialOpen={false}>
				<ToggleControl
					label="Pełna szerokość"
					help={attributes.size.fullWidth ? 'Sekcja ma pełną szerokość.' : 'Przełącz, aby sekcja miała pełną szerokość.'}
					checked={attributes.size.fullWidth}
					onChange={setSectionWidth}
				/>
				{/* begin */}
				<NumberControl
				label="Wysokość sekcji"
				value={attributes.size.sectionHeight.value}
				onChange={setSectionHeight}
				/>
				<SelectControl
					value={attributes.size.sectionHeight.unit}
					options={[
						{label: 'px', value: 'px'},
						{label: 'vw', value: 'vw'},
						{label: 'vh', value: 'vh'}
					]}
					onChange={setSectionHeightUnit}
				/>
				{/*	end */}
			</PanelBody>
			<PanelBody title="Wyrównanie" initialOpen={false}>
				<SelectControl
					label="Wyrównanie w poziomie"
					value={attributes.alignment.horizontal}
					options={[
						{label: 'Domyślne', value: ''},
						{label: 'Start', value: 'start'},
						{label: 'End', value: 'end'},
						{label: 'Center', value: 'center'},
						{label: 'Stretch', value: 'stretch'},
						{label: 'Space-around', value: 'space-around'},
						{label: 'Space-between', value: 'space-between'},
						{label: 'Space-evenly', value: 'space-evenly'},
					]}
					onChange={setAlignmentHorizontal}
				/>
				<SelectControl
					label="Wyrównanie w pionie"
					value={attributes.alignment.vertical}
					options={[
						{label: 'Domyślne', value: ''},
						{label: 'Start', value: 'start'},
						{label: 'End', value: 'end'},
						{label: 'Center', value: 'center'},
						{label: 'Stretch', value: 'stretch'}
					]}
					onChange={setAlignmentVertical}
				/>
			</PanelBody>
			<PanelBody title="Kolor tekstu" initialOpen={ false }>
				<ColorPalette
					value={attributes.textColor}
					onChange={setTextColor}
				/>
			</PanelBody>
			<PanelBody title="Kolor tła" initialOpen={ false }>
				<ColorPalette
					value={attributes.backgroundColor}
					onChange={setBackgroundColor}
				/>
			</PanelBody>
			<PanelBody title="Zdjęcie w tle" initialOpen={ false }>
				<MediaUpload
					allowedTypes={ALLOWED_MEDIA_TYPES}
					value={attributes.backgroundImage.src}
					render={({open}) => (
						<Button onClick={open} className="components-button block-editor-media-placeholder__button block-editor-media-placeholder__upload-button is-primary">Biblioteka mediów</Button>
					)}
					onSelect={setSrc}
				/>
				<SelectControl
					label="Rozmiar"
					value={attributes.backgroundImage.size}
					options={[
						{label: 'Default', value: ''},
						{label: 'Cover', value: 'cover'},
						{label: 'Contain', value: 'contain'},
						{label: 'Auto', value: 'auto'}
					]}
					onChange={setSize}
				/>
				<SelectControl
					label="Pozycja"
					value={attributes.backgroundImage.position}
					options={[
						{label: 'Default', value: ''},
						{label: 'Center', value: 'center'},
						{label: 'Top', value: 'top'},
						{label: 'Bottom', value: 'bottom'}
					]}
					onChange={setPosition}
				/>
				<SelectControl
					label="Położenie"
					value={attributes.backgroundImage.attachment}
					options={[
						{label: 'Default', value: ''},
						{label: 'Scroll', value: 'scroll'},
						{label: 'Fixed', value: 'fixed'}
					]}
					onChange={setAttachment}
				/>
			</PanelBody>
		</InspectorControls>,
		<div
			{...useBlockProps()}
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
		>
			<div className='wp-block-zhp-section__content'>
				<InnerBlocks
					key={attributes.columns}
					allowedBlocks={ALLOWED_BLOCKS}
					template={[...Array(attributes.columns)].map(()=>(['zhp/column', {cell: 1}]))}
					templateLock="all"
				/>
			</div>
		</div>
	]);
}
