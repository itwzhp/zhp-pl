/**
 * WordPress dependencies
 */
import { registerBlockType, unstable__bootstrapServerSideBlockDefinitions } from '@wordpress/blocks';

/**
 * Internal dependencies
 */
import Edit from './edit';
import save from './save';

registerBlockType( 'zhp/section', {
	apiVersion: 2,
	title: 'Sekcja',
	description: '',
	category: 'zhp',
	icon: 'align-wide',
	supports: {
		html: false,
	},
	attributes: {
		columns: {
			type: 'number',
			default: 1,
		},
		fullWidth: {
			type: 'boolean',
			default: false,
		},
		heightValue: {
			type: 'string',
			default: '0'
		},
		heightUnit: {
			type: 'string',
			default: 'px'
		},
		verticalAlignment: {
			type: 'string',
			default: ''
		},
		backgroundColor: {
			type: 'string',
			default: ''
		},
		backgroundImageSrc: {
			type: 'string',
			default: ''
		},
		backgroundImageAttachment: {
			type: 'string',
			default: ''
		},
		backgroundImagePosition: {
			type: 'string',
			default: ''
		},
		backgroundImageSize: {
			type: 'string',
			default: ''
		},
		overlayColor: {
			type: 'string',
			default: ''
		},
		overlayOpacity: {
			type: 'number',
			default: 100
		},
		textColor: {
			type: 'string',
			default: ''
		},
		marginDesktop: {
			type: 'object',
			default: {
				top: 0,
				right: 0,
				bottom: 0,
				left: 0
			}
		},
		margin: {
			type: 'object',
			default: {
				top: 0,
				right: 0,
				bottom: 0,
				left: 0
			}
		},
		paddingDesktop: {
			type: 'object',
			default: {
				top: 0,
				right: 0,
				bottom: 0,
				left: 0
			}
		},
		padding: {
			type: 'object',
			default: {
				top: 0,
				right: 0,
				bottom: 0,
				left: 0
			}
		}
	},
	edit: Edit,
	save,
} );
