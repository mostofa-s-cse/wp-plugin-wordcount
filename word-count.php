<?php
/*
 * Plugin Name:       Word Count
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics Word Count plugin.
 * Version:           1.0.
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Mostofa
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       word-count
 * Domain Path:       /languages
 */


//function register_activation_hook() {}
//register_activation_hook(__FILE__,"wordcount_activate");
//function register_deactivation_hook() {}
//register_deactivation_hook(__FILE__,"wordcount_deactivate");

function wordcount_load_textdomain() {
	load_plugin_textdomain('word-count', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action("plugins_loaded",'wordcount_load_textdomain');


function wordcount_count_words ($content) {
	$stripped_count = strip_tags($content);
	$wordn = str_word_count($stripped_count);
	$label = __('Total Number of Words ', 'word-count');
	$label = apply_filters('wordcount_label', $label);
	$tag = apply_filters('wordcount_tag', 'h2');
	$content .= sprintf('<%s>%s: %s</%s>',$tag,$label,$wordn,$tag);
	return $content;
}
add_filter('the_content','wordcount_count_words');
function philosophy_wordcount_heading($heading) {
//	$heading = strtoupper($heading);
	$heading = strtoupper("Total Count");
	return $heading;
}
add_filter('wordcount_tag','philosophy_wordcount_heading');

function philosophy_wordcount_tag($tag) {
//	$tag = strtoupper($tag);
	$tag = strtoupper('h4');
	return $tag;
}
add_filter('wordcount_tag','philosophy_wordcount_tag');



function wordcount_reading_time($content) {
	$stripped_count = strip_tags($content);
	$wordn = str_word_count($stripped_count);
	$reading_minutes = ceil($wordn / 200);
	$reading_seconds = ceil($wordn % 200 / (200/60));
	$is_visible = apply_filters('wordcount_is_visible',1);
	if($is_visible) {
		$label = __('Total Reading Time', 'word-count');
		$label = apply_filters("wordcount_reading_time_label",$label);
		$tag = apply_filters('wordcount_reading_time_tag', 'h4');
		$content .= sprintf('<%s>%s: %s Minutes, %s seconds </%s>',$tag,$label,$reading_minutes,$reading_seconds,$tag);
	}
	return $content;
}
add_filter('the_content','wordcount_reading_time');


function philosophy_readingtime_tag($tag) {
//	$tag = strtoupper($tag);
	$tag = strtoupper('h6');
	return $tag;
}
add_filter('wordcount_reading_time_tag','philosophy_readingtime_tag');
