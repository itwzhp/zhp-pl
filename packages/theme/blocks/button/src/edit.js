import {
	useBlockProps,
	RichText,
	InspectorControls,
	ColorPalette,
	AlignmentToolbar,
	BlockControls,
} from "@wordpress/block-editor";
import {
	PanelBody,
	SelectControl,
	ToggleControl,
	__experimentalInputControl as InputControl,
	__experimentalText as Text,
} from '@wordpress/components';
import "./editor.scss"
export default function Edit({
	attributes,
	setAttributes,
}) {
	const {to, color, background, label, hasFullWidth, modifier, alignment, textAlignment} = attributes
	const attributesToStyle = (attributes) => {
		const {
			color,
			background,
			modifier,
			alignment,
			textAlignment,
		} = attributes;

		const alignmentMap = {
			center: "0 auto",
			right: "0 0 0 auto"
		}

		const style = {
			'color': color,
			'background': modifier!== 'text' && background,
			'margin': alignment && alignmentMap[alignment],
			'text-align': textAlignment !== 'left' && textAlignment
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
		'wp-block-zhp-button--text': modifier === 'text',
		'wp-block-zhp-button--full': hasFullWidth
	}
	const className = Object.keys(classes).reduce(
		(array, key) =>
			(classes[key] ? [...array, key] : array), []
	)
		.join(' ')
	const blockProps = useBlockProps({className});
	return <>
		<BlockControls>
			<AlignmentToolbar
				value={textAlignment}
				onChange={(textAlignment)=>(setAttributes({textAlignment}))}
			/>
		</BlockControls>
		<InspectorControls>
			<PanelBody>
				<Text variant={"caption"}>Kolor przycisku</Text>
				<ColorPalette
					value={background}
					onChange={(background)=>(setAttributes({background}))}
				/>
				<Text variant={"caption"}>Kolor tesktu</Text>
				<ColorPalette
					value={color}
					onChange={(color)=>(setAttributes({color}))}
				/>
				<InputControl
					type={'url'}
					label={"Link"}
					value={to}
					onChange={(to)=>(setAttributes({to}))}
				/>
				<SelectControl
					label={'Styl przycisku'}
					value={modifier}
					options={[{label: 'Domyśny', value: ''}, {label: 'Tekstowy', value: 'text'}]}
					onChange={(modifier)=>(setAttributes({modifier}))}
				/>
				<ToggleControl
					label={'Pełna szerokość'}
					checked={hasFullWidth}
					onChange={(hasFullWidth)=>{setAttributes({hasFullWidth})}}
				/>
				<SelectControl
					label={'Wyrównanie'}
					value={alignment}
					options={[{label: 'Domyśne', value: ''}, {label: 'Center', value: 'center'}, {label: 'Right', value: 'right'}]}
					onChange={(alignment)=>(setAttributes({alignment}))}
				/>
			</PanelBody>
		</InspectorControls>
		<button {...blockProps} style={style}>
			<RichText withoutInteractiveFormatting allowedFormats={[]} value={label} onChange={(label)=>(setAttributes({label}))}/>
		</button>
	</>
}
