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
	$content .= sprintf('<h2>%s: %s</h2>',$label,$wordn);
	return $content;
}
add_filter('the_content','wordcount_count_words');