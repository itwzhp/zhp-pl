import {
	dispatch,
	useDispatch,
	useSelect,
	withDispatch
} from '@wordpress/data';
import {
	useBlockProps,
	InnerBlocks,
	InspectorControls,
	BlockControls,
	BlockVerticalAlignmentToolbar,
	MediaUpload,
	__experimentalBlockVariationPicker as BlockVariationPicker,
	__experimentalUseInnerBlocksProps as useInnerBlocksProps,
	ColorPalette
} from '@wordpress/block-editor';
import {
	createBlock,
	createBlocksFromInnerBlocksTemplate
} from '@wordpress/blocks'
import {
	PanelBody,
	RangeControl,
	Notice,
	ToggleControl,
	SelectControl,
	Button,
	__experimentalText as Text,
	__experimentalNumberControl as NumberControl
} from '@wordpress/components';
import './editor.scss';
import variations from './variations';

const ALLOWED_BLOCKS = [ 'zhp/column' ];
const ALLOWED_MEDIA_TYPES = ['image']

function ColumnsEditContainer({attributes, setAttributes, updateAlignment, clientId}) {
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
		marginDesktop,
		margin,
		paddingDesktop,
		padding,
	} = attributes
	const { count } = useSelect(
		( select ) => {
			return {
				count: select( 'core/block-editor' ).getBlockCount( clientId ),
			};
		},
		[ clientId ]
	);
	const classes = {}
	const className = Object.keys(classes).reduce(
		(array, key) =>
			(classes[key] ? [...array, key] : array), []
		)
		.join(' ')
	const blockProps = useBlockProps({
		className: className,
	});
	const innerBlocksProps = useInnerBlocksProps({}, {
		allowedBlocks: ALLOWED_BLOCKS,
		orientation: 'horizontal',
		renderAppender: false,
	})
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
			padding,
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
			 'padding': Object.values(padding).some((val)=>(val > 0))  && `${padding.top}px ${padding.right}px ${padding.bottom}px ${padding.left}px`,
			 'margin': Object.values(margin).some((val)=>(val > 0))  && `${margin.top}px ${margin.right}px ${margin.bottom}px ${margin.left}px`,
			'color': textColor,
			...sectionBackground
			}
		const sectionStyle = Object.keys(section).reduce((object,key)=>(
			section[key]
				? {...object, [key]: section[key]}
				: object
		), {})

		const content = {
			'min-height': heightValue !== '0' && `${heightValue}${heightUnit}`,
			'align-items': verticalAlignmentMap[verticalAlignment],
			...contentBackground
		}
		const contentStyle = Object.keys(content).reduce((object,key)=>(
			content[key]
				? {...object, [key]: content[key]}
				: object
		), {})

		return {
			section: sectionStyle,
			content: contentStyle
		}
	}
	const style = attributesToStyle(attributes);
	return	(<>
		<BlockControls>
			<BlockVerticalAlignmentToolbar
				onChange={updateAlignment}
				value={verticalAlignment}
			/>
		</BlockControls>
		<InspectorControls>
			{/*<PanelBody>
					<RangeControl
						label={'Kolumny'}
						value={count}
						min={1}
						max={12}
						onChange={(value)=> updateColumns(count, value)}
					/>
					{count > 12 && (
						<Notice status={"warning"} isDismissible={false}>
							Ta liczba kolumn przekracza zalecaną ilość i może spowodować problemy.
						</Notice>
					)}
				</PanelBody>*/}
			<PanelBody title={'Rozmiar'}>
				<ToggleControl
					label={'Pełna szerokość tła'}
					help={fullWidth ? 'Tło sekcji ma pełną szerokość' : 'Przełącz aby tło sekcja zakrywało pełną szerokość.'}
					checked={fullWidth}
					onChange={(fullWidth)=>{setAttributes({fullWidth})}}
				/>
				<div className={'components-section-height'}>
					<NumberControl
						label={'Wysokość sekcji'}
						value={heightValue}
						onChange={(heightValue)=>{setAttributes({heightValue})}}
					/>
					<SelectControl
						value={heightUnit}
						options={[{label:'px', value:'px'}, {label:'vw', value:'vw'}, {label:'vh',value:'vh'}, {label:'%', value: '%'}]}
						className={'components-section-height__select'}
						onChange={(heightUnit)=>(setAttributes({heightUnit}))}
					/>
				</div>
				<div className={'components-section-boxmodel'}>
					<div className={'components-section-boxmodel__header'}>
						<Text variant={"caption"}>Margin</Text>
						<Text variant={"caption"}>px</Text>
					</div>
					<Text variant={"caption"}>Mobile</Text>
					<div className={'components-section-boxmodel__main'}>
						<NumberControl
							label={'Góra'}
							value={margin.top}
							labelPosition={'bottom'}
							className={'components-section-boxmodel__input'}
							onChange={(top)=>{setAttributes({margin: {...margin, top}})}}
						/>
						<NumberControl
							label={'Prawa'}
							value={margin.right}
							labelPosition={'bottom'}
							className={'components-section-boxmodel__input'}
							onChange={(right)=>{setAttributes({margin: {...margin, right}})}}
						/>
						<NumberControl
							label={'Dół'}
							value={margin.bottom}
							labelPosition={'bottom'}
							className={'components-section-boxmodel__input'}
							onChange={(bottom)=>{setAttributes({margin: {...margin, bottom}})}}
						/>
						<NumberControl
							label={'Lewa'}
							value={margin.left}
							labelPosition={'bottom'}
							className={'components-section-boxmodel__input'}
							onChange={(left)=>{setAttributes({margin: {...margin, left}})}}
						/>
					</div>
					<Text variant={"caption"}>Desktop</Text>
					<div className={'components-section-boxmodel__main'}>
						<NumberControl
							label={'Góra'}
							value={marginDesktop.top}
							labelPosition={'bottom'}
							className={'components-section-boxmodel__input'}
							onChange={(top)=>{setAttributes({marginDesktop: {...marginDesktop, top}})}}
						/>
						<NumberControl
							label={'Prawa'}
							value={marginDesktop.right}
							labelPosition={'bottom'}
							className={'components-section-boxmodel__input'}
							onChange={(right)=>{setAttributes({marginDesktop: {...marginDesktop, right}})}}
						/>
						<NumberControl
							label={'Dół'}
							value={marginDesktop.bottom}
							labelPosition={'bottom'}
							className={'components-section-boxmodel__input'}
							onChange={(bottom)=>{setAttributes({marginDesktop: {...marginDesktop, bottom}})}}
						/>
						<NumberControl
							label={'Lewa'}
							value={marginDesktop.left}
							labelPosition={'bottom'}
							className={'components-section-boxmodel__input'}
							onChange={(left)=>{setAttributes({marginDesktop: {...marginDesktop, left}})}}
						/>
					</div>
				</div>
				<div className={'components-section-boxmodel'}>
					<div className={'components-section-boxmodel__header'}>
						<Text variant={"caption"}>Padding</Text>
						<Text variant={"caption"}>px</Text>
					</div>
					<Text variant={"caption"}>Mobile</Text>
					<div className={'components-section-boxmodel__main'}>
						<NumberControl
							label={'Góra'}
							value={padding.top}
							labelPosition={'bottom'}
							className={'components-section-boxmodel__input'}
							onChange={(top)=>{setAttributes({paddingMobile: {...padding, top}})}}
						/>
						<NumberControl
							label={'Prawa'}
							value={padding.right}
							labelPosition={'bottom'}
							className={'components-section-boxmodel__input'}
							onChange={(right)=>{setAttributes({padding: {...padding, right}})}}
						/>
						<NumberControl
							label={'Dół'}
							value={padding.bottom}
							labelPosition={'bottom'}
							className={'components-section-boxmodel__input'}
							onChange={(bottom)=>{setAttributes({padding: {...padding, bottom}})}}
						/>
						<NumberControl
							label={'Lewa'}
							value={padding.left}
							labelPosition={'bottom'}
							className={'components-section-boxmodel__input'}
							onChange={(left)=>{setAttributes({padding: {...padding, left}})}}
						/>
					</div>
					<Text variant={"caption"}>Desktop</Text>
					<div className={'components-section-boxmodel__main'}>
						<NumberControl
							label={'Góra'}
							value={paddingDesktop.top}
							labelPosition={'bottom'}
							className={'components-section-boxmodel__input'}
							onChange={(top)=>{setAttributes({paddingDesktop: {...paddingDesktop, top}})}}
						/>
						<NumberControl
							label={'Prawa'}
							value={paddingDesktop.right}
							labelPosition={'bottom'}
							className={'components-section-boxmodel__input'}
							onChange={(right)=>{setAttributes({paddingDesktop: {...paddingDesktop, right}})}}
						/>
						<NumberControl
							label={'Dół'}
							value={paddingDesktop.bottom}
							labelPosition={'bottom'}
							className={'components-section-boxmodel__input'}
							onChange={(bottom)=>{setAttributes({paddingDesktop: {...paddingDesktop, bottom}})}}
						/>
						<NumberControl
							label={'Lewa'}
							value={paddingDesktop.left}
							labelPosition={'bottom'}
							className={'components-section-boxmodel__input'}
							onChange={(left)=>{setAttributes({paddingDesktop: {...paddingDesktop, left}})}}
						/>
					</div>
				</div>
			</PanelBody>
			<PanelBody title={'Kolor tekstu'} initialOpen={ false }>
				<ColorPalette
					value={textColor}
					onChange={(textColor)=>(setAttributes({textColor}))}
				/>
			</PanelBody>
			<PanelBody title={'Kolor tła'} initialOpen={ false }>
				<ColorPalette
					value={backgroundColor}
					onChange={(backgroundColor)=>(setAttributes({backgroundColor}))}
				/>
			</PanelBody>
			<PanelBody title={'Zdjęcie w tle'} initialOpen={ false }>
				<MediaUpload
					allowedTypes={ALLOWED_MEDIA_TYPES}
					value={backgroundImageSrc}
					render={({open})=>(
						<Button onClick={open} isPrimary >Biblioteka mediów</Button>
					)}
					onSelect={(image)=>(setAttributes({backgroundImageSrc: image.sizes.full.url}))}
				/>
				<SelectControl
					label={'Rozmiar'}
					value={backgroundImageSize}
					options={[{label: 'Domyśny', value: ''}, {label: 'Cover', value: 'cover'}, {label: 'Contain', value: 'contain'}, {label: 'Auto', value: 'auto'}]}
					onChange={(backgroundImageSize)=>(setAttributes({backgroundImageSize}))}
				/>
				<SelectControl
					label={'Pozycja'}
					value={backgroundImagePosition}
					options={[{label: 'Domyśna', value: ''}, {label: 'Top', value: 'top'}, {label: 'Center', value: 'center'}, {label: 'Bottom', value: 'bottom'}]}
					onChange={(backgroundImagePosition)=>(setAttributes({backgroundImagePosition}))}
				/>
				<SelectControl
					label={'Położenie'}
					value={backgroundImageAttachment}
					options={[{label: 'Domyśne', value: ''}, {label: 'Scroll', value: 'scroll'}, {label: 'Fixed', value: 'fixed'}]}
					onChange={(backgroundImageAttachment)=>(setAttributes({backgroundImageAttachment}))}
				/>
			</PanelBody>
			<PanelBody title={'Overlay'} initialOpen={ false }>
				<ColorPalette
					value={overlayColor}
					onChange={(overlayColor)=>(setAttributes({overlayColor}))}
				/>
				<RangeControl
					label={'Krycie'}
					value={overlayOpacity}
					min={0}
					max={100}
					onChange={(overlayOpacity)=> (setAttributes({overlayOpacity}))}
				/>
			{/* procent */}
			</PanelBody>
		</InspectorControls>
		<div {...blockProps} style={style.section}>
			<div { ...innerBlocksProps } className={'wp-block-zhp-section__content'} style={style.content}/>
		</div>
	</>)
}
const ColumnsEditContainerWrapper = withDispatch(
	( dispatch, ownProps, registry ) => ( {
		updateAlignment(verticalAlignment) {
			const {setAttributes} = ownProps;
			setAttributes({verticalAlignment})
		},
		updateColumns( previousColumns, newColumns ) {
			const { clientId } = ownProps;
			const {replaceInnerBlocks} = dispatch('core/block-editor');
			const {getBlocks} = registry.select('core/block-editor');
			let innerBlocks = getBlocks(clientId);
			innerBlocks = [createBlock('zhp/column', {column: 12})]
			replaceInnerBlocks(clientId, innerBlocks)
		},
	} )
)( ColumnsEditContainer );
function Placeholder({clientId, name, setAttributes}) {
	const defaultVariation = variations.filter(({isDefault})=>(isDefault)).shift();
	const {replaceInnerBlocks} = useDispatch('core/block-editor');
	const blockProps = useBlockProps()
	return (<div {...blockProps}>
		<BlockVariationPicker
			className={'wp-block-zhp-section__variation-picker'}
			icon={'align-wide'}
			label={'Sekcja'}
			variations={variations}
			onSelect={(nextVariation = defaultVariation)=>{
				if(nextVariation.innerBlocks) {
					replaceInnerBlocks(
						clientId,
						createBlocksFromInnerBlocksTemplate(
							nextVariation.innerBlocks
						),
						true
					)
				}
			}}
			allowSkip
		/>
	</div>);
}
const ColumnsEdit = (props) => {
	const {clientId} = props;
	const hasInnerBlocks = useSelect(
		( select ) =>
			select( 'core/block-editor' ).getBlocks( clientId ).length > 0,
		[ clientId ]
	)
	const Component = hasInnerBlocks
		? ColumnsEditContainerWrapper
		: Placeholder;
	return <Component {...props }/>
}
export default ColumnsEdit;
