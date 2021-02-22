import {
	useBlockProps,
	InspectorControls,
	ColorPalette,
} from "@wordpress/block-editor";
import {
	PanelBody,
	RangeControl,
	SelectControl,
	__experimentalText as Text,
	__experimentalNumberControl as NumberControl
} from '@wordpress/components';
import "./editor.scss"
export default function Edit({
	attributes,
	setAttributes,
}) {
	const {background, width, height, alignment, margin} = attributes
	const blockProps = useBlockProps();
	const attributesToStyle = (attributes) => {
		const {
			background,
			width,
			height,
			alignment,
			margin,
		} = attributes;

		const alignmentMap = {
			center: "0 auto",
			right: "0 0 0 auto"
		}

		const style = {
			'width': `${width}%`,
			'height': `${height}px`,
			'background': background,
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
	return <>
		<InspectorControls>
			<PanelBody>
				<Text variant={"caption"}>Kolor</Text>
				<ColorPalette
					value={background}
					onChange={(background)=>(setAttributes({background}))}
				/>
				<RangeControl
					label={'Szerokość'}
					value={width}
					min={1}
					max={100}
					onChange={(width)=> (setAttributes({width}))}
				/>
				<RangeControl
					label={'Wysokość'}
					value={height}
					min={1}
					max={6}
					onChange={(height)=> (setAttributes({height}))}
				/>
				<SelectControl
					label={'Wyrównanie'}
					value={alignment}
					options={[{label: 'Domyśne', value: ''}, {label: 'Center', value: 'center'}, {label: 'Right', value: 'right'}]}
					onChange={(alignment)=>(setAttributes({alignment}))}
				/>
				<div className={'components-section-boxmodel'}>
					<div className={'components-section-boxmodel__header'}>
						<Text variant={"caption"}>Margin</Text>
						<Text variant={"caption"}>px</Text>
					</div>
					<div className={'components-section-boxmodel__main'}>
						<NumberControl
							label={'Góra'}
							value={margin.top}
							labelPosition={'bottom'}
							className={'components-section-boxmodel__input'}
							onChange={(top)=>{setAttributes({margin: {...margin, top}})}}
						/>
						<NumberControl
							label={'Dół'}
							value={margin.bottom}
							labelPosition={'bottom'}
							className={'components-section-boxmodel__input'}
							onChange={(bottom)=>{setAttributes({margin: {...margin, bottom}})}}
						/>
					</div>
				</div>
			</PanelBody>
		</InspectorControls>
		<div {...blockProps} style={style}></div>
	</>
}
