<?php

function escape_schema_text( $text ) {
    return esc_html( str_replace( array( "\r", "\n" ), ' ', $text ) );
}

$faqs = $attributes['faqs'] ?? [];

if ( empty( $faqs ) ) {
    return '';
}

$output = '<div ' . get_block_wrapper_attributes() . '>
<dl>';

foreach( $faqs as $faq ) {
    if ( empty( $faq['question'] ) || empty( $faq['answer'] ) ) continue;
    $uniqid = uniqid();
    $output .= '<dt aria-controls="answer-' . $uniqid . '" aria-expanded="false">
        <div class="icon-wrapper">
            <svg viewBox="0 0 320 193" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                <g transform="matrix(1,0,0,1,-0.451473,-191.651)">
                    <path d="M137.4,374.6C149.9,387.1 170.2,387.1 182.7,374.6L310.7,246.6C319.9,237.4 322.6,223.7 317.6,211.7C312.6,199.7 301,191.9 288,191.9L32,192C19.1,192 7.4,199.8 2.4,211.8C-2.6,223.8 0.2,237.5 9.3,246.7L137.3,374.7L137.4,374.6Z" style="fill-rule:nonzero;"/>
                </g>
            </svg>
        </div>
        <div class="content-wrapper">
    ' . wpautop( wp_kses_post( $faq['question'] ) ) . '</div></dt>';
    $output .= '<dd id="answer-' . $uniqid . '"><div>' . wpautop( wp_kses_post( $faq['answer'] ) ) . '</div></dd>';
}

$output .= '</dl>
</div>';

echo $output;


// SCHEMA! See https://developers.google.com/search/docs/appearance/structured-data/faqpage

add_action( 'wp_head', function() use ($faqs) {
    if ( empty( $faqs ) ) {
        return '';
    }
    $entities = [];
    foreach( $faqs as $faq ) {
        if ( empty( $faq['question'] ) || empty( $faq['answer'] ) ) continue;
        $entities[] = [
            "@type" => "Question",
            "name"  => escape_schema_text( $faq['question'] ),
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text"  => escape_schema_text( $faq['answer'] )
            ],
        ];
    }
    
}, 20 );