import '@fortawesome/fontawesome-free/js/brands.min';
import '@fortawesome/fontawesome-free/js/solid.min'
import '@fortawesome/fontawesome-free/js/fontawesome.min';
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
	RangeControl,
	__experimentalInputControl as InputControl,
	__experimentalText as Text,
} from '@wordpress/components';
import "./editor.scss"
export default function Edit({
	attributes,
	setAttributes,
}) {
	const {color, alignment, icon, size} = attributes
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
	const blockProps = useBlockProps();
	return <>
		<InspectorControls>
			<PanelBody>
				<InputControl
					type={'text'}
					label={"Ikona"}
					value={icon}
					onChange={(icon)=>(setAttributes({icon}))}
				/>
				<Text variant={"caption"}>Kolor</Text>
				<ColorPalette
					value={color}
					onChange={(color)=>(setAttributes({color}))}
				/>
				<RangeControl
					label={'Rozmiar'}
					value={size}
					min={1}
					max={52}
					onChange={(size)=>(setAttributes({size}))}
				/>
				<SelectControl
					label={'Wyrównanie'}
					value={alignment}
					options={[{label: 'Domyśne', value: ''}, {label: 'Center', value: 'center'}, {label: 'Right', value: 'right'}]}
					onChange={(alignment)=>(setAttributes({alignment}))}
				/>
			</PanelBody>
		</InspectorControls>
		<div {...blockProps} style={style}>
			<i className={icon}/>
		</div>

	</>
}
