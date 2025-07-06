<?php
// This file is generated. Do not modify it manually.
return array(
	'gutenberg-faq-schema' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'create-block/gutenberg-faq-schema',
		'version' => '0.1.0',
		'title' => 'Gutenberg Faq Schema',
		'category' => 'widgets',
		'icon' => 'editor-ul',
		'description' => 'FAQ with added SEO-friendly schema.',
		'example' => array(
			
		),
		'attributes' => array(
			'faqs' => array(
				'type' => 'array',
				'default' => array(
					
				)
			)
		),
		'supports' => array(
			'html' => false
		),
		'textdomain' => 'gutenberg-faq-schema',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'viewScript' => 'file:./view.js',
		'render' => 'file:./render.php'
	)
);
