<?php
/**
 * Plugin Name:       No Cookies for YouTube
 * Plugin URI:
 * Description:       Modifies YouTube embeds to use the youtube-nocookie.com domain.
 * Version:           2.0
 * Requires at least: 6.6
 * Tested up to:	  6.7.2
 * Stable Tag:		  2.0
 * Requires PHP:      8.0
 * Author:            bkno
 * Author URI:        https://digitalgarden.co
 * License:           GPL v3 or later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       no-cookies-for-youtube
 */

/*
No Cookies for YouTube is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
any later version.

No Cookies for YouTube is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with No Cookies for YouTube. If not, see https://www.gnu.org/licenses/gpl-3.0.html.
*/

/**
 * Prevent direct access to this file.
 */
defined( 'ABSPATH' ) || exit;

/**
 * Main plugin class.
 */
if ( ! class_exists( 'No_Cookies_for_YouTube' ) ) {

	class No_Cookies_for_YouTube {

		/**
		 * Constructor.
		 */
		public function __construct() {
			add_filter( 'embed_oembed_html', [ $this, 'filter_embed_oembed_html' ] );
			add_filter( 'the_content', [ $this, 'filter_the_content' ], 100 );
		}

		/**
		 * Modify the oEmbed HTMl.
		 */
		public function filter_embed_oembed_html( $html ) {
			if ( str_contains( $html, 'youtube.com' ) ) {
				$html = str_replace( 'youtube.com', 'youtube-nocookie.com', $html );
			}
			return $html;
		}

		/**
		 * Modify the post content.
		 */
		public function filter_the_content( $content ) {
			if ( str_contains( $content, 'youtube.com/embed' ) ) {
				$content = str_replace( 'youtube.com/embed', 'youtube-nocookie.com/embed', $content );
			}
			return $content;
		}

	}

	new No_Cookies_for_YouTube;
}
