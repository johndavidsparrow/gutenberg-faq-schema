/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, Button, TextControl, TextareaControl } from '@wordpress/components';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit( { attributes, setAttributes } ) {
	const { faqs = [] } = attributes;

	const updateFAQ = ( index, field, value ) => {
		const updated = [...faqs];
		updated[index][field] = value;
		setAttributes({
			faqs: updated
		});
	};
	const addFAQ = () => {
		setAttributes({
			faqs: [...faqs, {question: '', answer: ''}]
		});
	};

	const removeFAQ = (index) => {
		const updated = [...faqs];
		updated.splice(index, 1);
		setAttributes({
			faqs: updated
		});
	};

	return (
		<div { ...useBlockProps() }>
			<h3>FAQ Block</h3>
			{faqs.map((faq, idx) => (
				<div key={idx} style={{
					border: '1px solid #eee',
					pagging: '1rem',
					marginBottom: '1rem'
				}}>
					
							<TextareaControl
								label="Question"
								value={faq.question}
								onChange={
									val => updateFAQ(idx, 'question', val)
								}
							/>
							<TextareaControl
								label="Answer"
								value={faq.answer}
								onChange={
									val => updateFAQ(idx, 'answer, val')
								}
								style={{
									marginTop: '0.75rem'
								}}
							/>
							<Button isDestructive variant="tertiary" onClick={
								() => removeFAQ(idx)
							}
							>
								Remove FAQ Item
							</Button>
				</div>
			))}
			<Button variant="primary" onClick={addFAQ}>
				Add FAQ Item
			</Button>
		</div>
	);
}
