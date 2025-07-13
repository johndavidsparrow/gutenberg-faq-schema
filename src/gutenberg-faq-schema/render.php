<?php

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
            <svg width="100%" height="100%" viewBox="0 0 334 200" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;">
                <g id="Vector" transform="matrix(33.3333,0,0,33.3333,-233.333,-300)">
                    <path d="M16,10L12,14L8,10" style="fill:none;fill-rule:nonzero;stroke:black;stroke-width:2px;"/>
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

// Schema: See https://developers.google.com/search/docs/appearance/structured-data/faqpage
add_action( 'wp_head', function() use ($faqs) {
    if ( empty( $faqs ) ) {
        return;
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
    if ( $entities ) { ?>
        <script type="application/ld+json">
        <?php echo(wp_json_encode([
            "@context" => "https://schema.org",
            "@type" => "FAQPage",
            "mainEntity" => $entities,
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)); ?>
        </script>
    <?php }
    
}, 20 );