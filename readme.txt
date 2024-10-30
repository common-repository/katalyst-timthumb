=== Plugin Name ===
Contributors: Keiser Media
Donate link: http://keisermedia.com/projects/katalyst-timthumb/
Tags: images, resize, timthumb
Requires at least: 3.0.0
Tested up to: 3.3.2
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Automatically converts post thumbnails to the theme default dimension settings.

== Description ==

Automatically converts post thumbnails to the theme default dimension settings.

== Installation ==

1. Upload the `katalyst-timthumb` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= Why am I receiving the error "NOTICE: wp-content/plugins/k-timthumb/k-timthumb.php:65 - 'post-thumbnail' image size not set. Add WordPress function: add_image_size() to theme file "functions.php" to ensure proper functionality of Katalyst TimThumb."? =

This notice is not an error on behalf of Katalyst TimThumb. It is notifying you that a image size is being called within the theme that is not defined in 'functions.php' of the theme. To remedy this, add the function 'add_image_size('post-thumbnail', 150, 150, 1);' to 'functions.php' in your theme directory, where 'post-thumbnail' is the name being called in the notice.

== Changelog ==

= 1.0 =
* Release version.