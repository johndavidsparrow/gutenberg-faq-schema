<?php

// function escape_schema_text( $text ) {
//     return esc_html( str_replace( array( "\r", "\n" ), ' ', $text ) );
// }

$faqs = $attributes['faqs'] ?? [];

if ( empty( $faqs ) ) {
    return '';
}

$output = '<div ' . get_block_wrapper_attributes() . '>
<dl>';

foreach( $faqs as $faq ) {
    if ( empty( $faq['question'] ) || empty( $faq['answer'] ) ) continue;
    $output .= '<dt>' . wp_kses_post( $faq['question'] ) . '</dt>';
    $output .= '<dd>' . wpautop( wp_kses_post( $faq['answer'] ) ) . '</dd>';
}

$output .= '</dl>
</div>';

echo $output;