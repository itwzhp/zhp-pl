import {
	InnerBlocks,
	useBlockProps,
	__experimentalUseInnerBlocksProps as useInnerBlocksProps
} from "@wordpress/block-editor";
import {useDispatch, useSelect} from "@wordpress/data";
import './editor.scss';

export default function Edit({
	attributes: {column, templateLock = false},
	setAttributes,
	clientId
}) {
	const {hasChildBlocks, rootClientId} = useSelect(
		(select) => {
			const {getBlockOrder, getBlockRootClientId} = select('core/block-editor');
			return {
				hasChildBlocks: getBlockOrder(clientId).length > 0,
				rootClientId: getBlockRootClientId(clientId)
			}
		},
		[clientId]
	)
	const { updateBlockAttributes } = useDispatch('core/block-editor');
	const gridColumn = `span ${column}`;
	const blockProps = useBlockProps({
		style: gridColumn ? {gridColumn: gridColumn} : undefined,
	});
	const innerBlockProps = useInnerBlocksProps(blockProps, {
		templateLock,
		renderAppender: hasChildBlocks
		? undefined
			: InnerBlocks.ButtonBlockAppender,
	})
	return (
		<>
			<div {...innerBlockProps}/>
		</>
	)
}
