import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import './editor.scss';
import { PanelBody, SelectControl } from '@wordpress/components';

export default function Edit({attributes, setAttributes}) {

	const { selectedUser } = attributes;

	const onChangeUser = (user) => {
		setAttributes({selectedUser: user})
	}

	return (
		<div { ...useBlockProps() }>

			<InspectorControls>
				<PanelBody title={__('Block Selector', 'multiple-blocks')}>
					<SelectControl
					    label={__('Select User', 'multiple-blocks')}
						value={selectedUser}
						options={[
							{value: 'a', label: 'Option A'},
							{value: 'b', label: 'Option B'},
							{value: 'c', label: 'Option C'},
						]}
						onChange={onChangeUser}
					/>
				</PanelBody>
			</InspectorControls>
			<p>First block</p>
		</div>
	);
}
