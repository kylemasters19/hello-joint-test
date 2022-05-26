=== Hello Joint ===

Contributors: elemntor, KingYes, ariel.k, jzaltzberg, mati1000, bainternet, korvath
Requires at least: 4.7
Tested up to: 5.9
Stable tag: 1.2.0
Version: 1.2.0
Requires PHP: 5.6
License: GNU General Public License v3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Tags: custom-menu, custom-logo, featured-images, rtl-language-support, threaded-comments, translation-ready

A lightweight, plain-vanilla, Joint-powered theme for Elementor page builder.

***Hello Joint*** is based upon Hello Elementor, and is distributed under the terms of the GNU GPL v3 or later.

== Description ==

A basic, plain-vanilla, lightweight theme, best suited for building your site using Elementor page builder with Rank Really High.

This theme resets the WordPress environment and prepares it for smooth operation of Elementor and Joint.

Screenshot's images & icons are licensed under: Creative Commons (CC0), https://creativecommons.org/publicdomain/zero/1.0/legalcode

== Installation ==

1. In your site's admin panel, go to Appearance > Themes and click `Add New`.
2. Click "Upload" and then "Select File".
3. Browse to the location where the zip file is saved, and select it.
4. Install and activate the theme.

== Customizations ==

Most users will not need to edit the files for customizing this theme.
To customize your site's appearance, simply use ***Elementor***.

However, if you have a particular need to adapt this theme, please read on.

= Style & Stylesheets =

All of your site's styles should be handled directly inside ***Elementor***.
You should not need to edit the SCSS files in this theme in ordinary circumstances.

However, if for some reason there is still a need to add or change the site's CSS, please use a child theme.

= Hooks =

To prevent the loading of any of the these settings, use the following as boilerplate and add the code to your child-theme `functions.php`:
```php
add_filter( 'choose-from-the-list-below', '__return_false' );
```

* `hello_joint_enqueue_style`                 enqueue style
* `hello_joint_enqueue_theme_style`           load theme-specific style (default: load)
* `hello_joint_load_textdomain`               load theme's textdomain
* `hello_joint_register_menus`                register the theme's default menu location
* `hello_joint_add_theme_support`             register the various supported features
* `hello_joint_add_woocommerce_support`       register woocommerce features, including product-gallery zoom, swipe & lightbox features
* `hello_joint_register_elementor_locations`  register elementor settings
* `hello_joint_content_width`                 set default content width to 800px
* `hello_joint_page_title`                    show\hide page title (default: show)
* `hello_joint_viewport_content`              modify `content` of `viewport` meta in header

== Frequently Asked Questions ==

**Does this theme support any plugins?**

Hello Joint includes support for WooCommerce.

**Can Font Styles be added thru the theme's css file?**

Yes, ***but*** best practice is to use the styling capabilities in the Elementor plugin.

== Copyright ==

This theme, like WordPress, is licensed under the GPL.
Use it as your springboard to building a site with ***Elementor***.

Hello Elementor bundles the following third-party resources:

Font Awesome icons for theme screenshot
License: SIL Open Font License, version 1.1.
Source: https://fontawesome.com/v4.7.0/

Image for theme screenshot, Copyright Jason Blackeye
License: CC0 1.0 Universal (CC0 1.0)
Source: https://stocksnap.io/photo/4B83RD7BV9
aa

== Changelog ==

= 1.3.0 - 2022-05-26 =
* Squish some bugs.

= 1.2.0 - 2022-05-26 =
* Squish some bugs.

= 1.1.0 - 2022-05-26 =
* Squish some bugs.

= 1.0.0 - 2022-05-26 =
* Initial Release.
