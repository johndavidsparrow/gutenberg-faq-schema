<?php

function escape_schema_text( $text ) {
    return esc_html( str_replace( array( "\r", "\n" ), ' ', $text ) );
}

$faqs = $attributes['faqs'] ?? [];

if ( empty( $faqs ) ) {
    return '';
}

ob_start(); ?>



<?php 

ob_get_clean();