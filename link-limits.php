<?php

/*
Plugin Name: Link Limits
Plugin URI: http://www.jamesmckay.net/code/link-limits/
Description: Places restrictions on the number of hyperlinks or BBCode that can be included in comments.  
Version: 1.0 alpha 1
Author: James McKay
Author URI: http://www.jamesmckay.net/
*/

/* ========================================================================== */

/*
 * Copyright (c) 2007 James McKay
 * http://www.jamesmckay.net/
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, 
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE. 
 */
 
/**
 * Defines the upper limit to the number of hyperlinks allowed in a single comment.
 * Comments with more hyperlinks than this will be rejected.
 * Comment this line out if you want to allow unlimited hyperlinks and only
 * reject BBCode.
 */
 
define ('MAX_HYPERLINKS', 2);
 
// For compatibility with WP 2.0

if (!function_exists('wp_die')) {
	function wp_die($msg) {
		die($msg);
	}
}

function comment_link_limits($comment)
{
	if (preg_match('|\[url(\=.*?)?\]|is', $comment['comment_content'])) {
		do_action('three_strikes', 'link-limits', 'BBCode');
		wp_die('Your comment was rejected because it included a <a href="http://en.wikipedia.org/wiki/BBCode">BBCode</a> hyperlink. ' .
				'This blog does not use BBCode.');
	}
	
	if (defined('MAX_HYPERLINKS')) {
		$linkCount = preg_match_all("|(href\t*?=\t*?['\"]?)?(https?:)?//|i", $comment['comment_content'], $out);
		if ($linkCount > MAX_HYPERLINKS) {
			$msg = 'Your comment was rejected because it contained too many hyperlinks. ';
			if (MAX_HYPERLINKS < 1) {
				$msg .= ' This blog does not allow hyperlinks in comments.';
			}
			elseif(MAX_HYPERLINKS == 1) {
				$msg .= ' This blog has a limit of one hyperlink per comment.';
			}
			else {
				$msg .= ' This blog has a limit of ' . MAX_HYPERLINKS . ' hyperlinks per comment.';
			}
			do_action('three_strikes', 'link-limits', "Links($linkCount)");
			wp_die($msg);
		}
	}
	return $comment;
}

function comment_link_limits_message()
{
	echo '<div class="comment-restrictions">';
	if (MAX_HYPERLINKS < 1) {
		echo 'Comment body must not contain external links.';
		return;
	}
	elseif (MAX_HYPERLINKS == 1) {
		echo 'Maximum one link per comment. ';
	}
	else {
		echo 'Maximum ' . MAX_HYPERLINKS . ' links per comment. ';
	}
	echo 'Do not use <a href="http://en.wikipedia.org/wiki/BBCode">BBCode</a>.</div>';
}

// Needs to be called before Akismet
add_filter('preprocess_comment', 'comment_link_limits', 0);
if (defined('MAX_HYPERLINKS')) {
	add_action('comment_form', 'comment_link_limits_message');
}

?>