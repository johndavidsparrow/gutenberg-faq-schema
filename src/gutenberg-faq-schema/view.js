/**
 * Use this file for JavaScript code that you want to run in the front-end
 * on posts/pages that contain this block.
 *
 * When this file is defined as the value of the `viewScript` property
 * in `block.json` it will be enqueued on the front end of the site.
 *
 * Example:
 *
 * ```js
 * {
 *   "viewScript": "file:./view.js"
 * }
 * ```
 *
 * If you're not making any changes to this file because your project doesn't need any
 * JavaScript running in the front-end, then you should delete this file and remove
 * the `viewScript` property from `block.json`.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#view-script
 */

const faqWrappers = document.querySelectorAll('.wp-block-create-block-gutenberg-faq-schema');

if (faqWrappers && faqWrappers.length) {
    faqWrappers.forEach((wrapper) => {
        const faqItems = wrapper.querySelectorAll('dt');
        if (faqItems && faqItems.length) {
            faqItems.forEach((faqItem) => {
                faqItem.addEventListener('click', (e) => {
                    let target = e.target;
                    target = target.closest('dt');
                    if (target) target.classList.toggle('is-open');

                    // Handle the aria-expanded
                    const expanded = target.getAttribute('aria-expanded') === 'true';
                    target.setAttribute('aria-expanded', expanded ? 'false' : 'true');
                });
                faqItem.addEventListener('keypress', (e) => {
                    let target = e.target;
                    target = target.closest('dt');
                    if (target) target.click();
                });
            });
        }
    });
}