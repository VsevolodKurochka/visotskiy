<?php
/**
* Template Name: Лендинг
*/

$context = Timber::get_context();
$post = new TimberPost();

$context['post'] = $post;

Timber::render( array( 'template-landing.twig' ), $context );