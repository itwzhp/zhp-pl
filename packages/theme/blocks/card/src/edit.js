import {
	useBlockProps,
	RichText,
	InspectorControls,
	MediaUpload,
} from "@wordpress/block-editor";
import {
	Button,
	PanelBody,
	ToggleControl,
	__experimentalInputControl as InputControl,
} from '@wordpress/components';
import "./editor.scss"

const ALLOWED_MEDIA_TYPES = ['image']

export default function Edit({
	attributes,
	setAttributes,
}) {
	const {thumbnail, title, description, to, hasOverlay} = attributes
	const classes = {
		'wp-block-zhp-card': true,
		'wp-block-zhp-card--overlayed': hasOverlay,
		'wp-block-zhp-card--pictured': hasOverlay
	}
	const className = Object.keys(classes).reduce(
		(array, key) =>
			(classes[key] ? [...array, key] : array), []
	)
		.join(' ')
	const blockProps = useBlockProps({className});
	return <>
		<InspectorControls>
			<PanelBody>
				<ToggleControl
					label={'Tekst na obrazku wyróżniającym'}
					help={hasOverlay ? 'Teks tna obrazku wyróżniającym' : 'Przełącz aby tekst był pod obrazkiem.'}
					checked={hasOverlay}
					onChange={(hasOverlay)=>{setAttributes({hasOverlay})}}
				/>
				<InputControl
					type={'url'}
					label={"Link"}
					value={to}
					onChange={(to)=>(setAttributes({to}))}
				/>
			</PanelBody>
			<PanelBody title="Obrazek wyróżniający">
				<MediaUpload
					allowedTypes={ALLOWED_MEDIA_TYPES}
					value={thumbnail}
					render={({open})=>(
						<Button onClick={open} isPrimary >Biblioteka mediów</Button>
					)}
					onSelect={(image)=>(setAttributes({thumbnail: image.sizes.full.url}))}
				/>
			</PanelBody>
		</InspectorControls>
		<div {...blockProps} className={className}>
			<div className="wp-block-zhp-card__thumbnail">
				<div className="wp-block-zhp-card__image">
					<img src={thumbnail} alt=""/>
				</div>
			</div>
			<div className="wp-block-zhp-card__content">
				<RichText className="wp-block-zhp-card__title" key="editable" tagName="span" placeholder="Proszę podać tytuł bloku." value={title} onChange={(title)=>(setAttributes({title}))} />
				<RichText className="wp-block-zhp-card__description" key="editable" tagName="p" placeholder="Proszę podać opis bloku." value={description} onChange={(description)=>(setAttributes({description}))} />
			</div>
		</div>
	</>
}
