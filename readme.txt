=== Link Limits ===
Contributors: jammycakes
Donate link: http://www.jamesmckay.net/code/link-limits/
Tags: comments, comment, spam
Requires at least: 2.0
Tested up to: 2.8
Stable tag: trunk

Rejects comments that contain BBCode or too many hyperlinks.

== Description ==

This plugin rejects outright any comments that contain either (a) BBCode
[url=...] tags or (b) more than a predefined number of hyperlinks. As comments
of this nature are almost exclusively spam, this should cut down drastically on
the amount of detritus that Akismet has to deal with, making it easier to check
for false positives in your spam queue.

== Installation ==

* Copy the file `link-limits.php` to your `/wp-content/plugins` directory.
* Activate the plugin through the "Plugins" menu in the WordPress dashboard.

== Configuration ==

The default settings enforce a limit of two hyperlinks per comment. 
To change this, edit the number in the line just below the copyright notice
which says:

`define('MAX_HYPERLINKS', 2);`
	
If you set it to zero, it will not allow any hyperlinks. To allow unlimited
hyperlinks and only block BBCode, comment out this line.

== Redistribution == 

Copyright (c) 2007 James McKay
http://www.jamesmckay.net/

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, 
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

== Reporting bugs ==

When reporting bugs, please provide me with the following information:

1. Which version of Comment Timeout you are using;
2. Which version of WordPress you are using;
3. The URL of your blog;
4. Which platform (Windows/IIS/PHP or Linux/Apache/MySQL/PHP) your server
   is running, and which versions of Apache and PHP you are using, if you
   know them;
5. The steps that need to be taken to reproduce the bug;
6. If possible, any relevant information on other plugins or configuration
   options that you may think appropriate.
   
See the following blog entry for further guidance on troubleshooting and
reporting problems:

http://www.jamesmckay.net/2007/04/how-to-report-issues-with-wordpress-plugins/

== For more information ==

For more information, please visit the plugin's home page:

http://www.jamesmckay.net/code/link-limits/