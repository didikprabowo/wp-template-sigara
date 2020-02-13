<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sigara
 */

get_header();
if (is_category() || is_tag() || is_date()) {
	get_template_part("/inc/template-category");
} elseif (is_author()) {
	get_template_part("/inc/template-author");
}
get_footer();
