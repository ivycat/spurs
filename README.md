Travis build: [![Build Status](https://travis-ci.org/holger1411/understrap.svg?branch=master)](https://travis-ci.org/holger1411/understrap) | Start talking: [![Gitter](https://img.shields.io/gitter/room/holger1411/understrap.svg?maxAge=2592000?style=flat-square)](https://gitter.im/holger1411/understrap)

#### See: [Official Demo](https://understrap.com/understrap) | Read: [Official Docs Page](https://understrap.github.io/)

# Spurs WordPress Theme Framework

Website: [https://ivycat.com/wordpress/](https://ivycat.com/wordpress/)

While you can easily make a child theme for Spurs, we recommend using Spurs to create your next spiffy new theme. Much
like [Underscores](http://underscores.me/) or [Sage](https://roots.io/sage/), Spurs isn't meant to be a child theme.

**Note:** We reserve the right to break backward compatibility at any point, in fact we expect it. Don't expect to 
automatically update the main theme automatically when there are updates.

If you'd like to get email notifications of new updates, please subscribe to our themes mailing list.

## About

Like [Holger](https://github.com/holger1411), creator of [Understrap](https://understrap.com), I'm a fan of Underscores, 
Bootstrap, Sass, npm, and Gulp.

Spurs is a fork of [Understrap](https://understrap.com) with the goals of:
1. created and implement some more radical theme changes such as introducing a [theme wrapper](http://scribu.net/wordpress/theme-wrappers.html) 
to keep our code warm and DRY.
2. add some handy functions to make our jobs easier and the WordPress Admin more integrated with the theme.

## Licenses
Spurs WordPress Theme, Copyright 2017 Eric Amundson
UnderStrap WordPress Theme, Copyright 2013-2017 Holger Koenemann
Spurs and UnderStrap are distributed under the terms of the GNU GPL version 2

http://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html

## Changelog
See [changelog](CHANGELOG.md)

## Basic Features

- Combines Underscore’s PHP/JS files and Bootstrap’s HTML/CSS/JS.
- Comes with Bootstrap (v4) Sass source files and additional .scss files. Nicely sorted and ready to add your own 
variables and customize the Bootstrap variables
- Use npm to install build tools like Gulp for compiling, linting, and BrowserSync.
- Uses a single and minified CSS file for all the basic stuff
- [Font Awesome](http://fortawesome.github.io/Font-Awesome/) integration (v4.7.0)
- Jetpack ready
- WooCommerce support
- Contact Form 7 support
- Gravity Forms support _(coming soon)_
- Translation ready

## Starter Theme + HTML Framework = WordPress Theme Framework

The _s theme is a good starting point to develop a WordPress theme. But it is “just” a raw starter theme; it outputs 
solid basic markup and WordPress functions without any layout or design.

Bootstrap 4 provides a well known and supported layout framework providing a solid, clean and responsive foundation.

Font Awesome provides the default icons.

You can easily load custom fonts using either Google Fonts or Typekit.

## Confused by All the CSS and Sass Files?

Some basics about the Sass and CSS files that come with UnderStrap:
- The theme uses the `/style.css` file to identify the theme inside of WordPress. The file is not loaded by the theme 
and does not include any styles.
- The `/css/theme.css` file and its minified little brother `/css/theme.min.css` provide all styles. 
It is composed of five different SCSS sets and one variable file loaded through `/sass/theme.scss`:

1. `theme/theme_variables` <----- Your custom variables plus those needed to overwrite Bootstrap or Spurs variables
2. `../src/bootstrap-sass/assets/stylesheets/bootstrap`  <----- Bootstrap vendor stuff **DON'T EDIT!**
3. `understrap/understrap` <----- Basic WordPress styles combining Boostrap and Underscores
4. `../src/fontawesome/scss/font-awesome` <----- Font Awesome Icon styles **DON'T EDIT!**
5. `theme/theme`  <----- Add your styles into this file

- Don’t edit or you won’t be able to update Bootstrap or Font Awesome without overwriting your own work!
- Your design goes into: `/sass/theme`. Add your styles to the `/sass/theme/_theme.scss` file and your variables to the 
`/sass/theme/_theme_variables.scss`. Or add other .scss files into it and `@import` it into `/sass/theme/_theme.scss`.

## Installation

### Classic install
- Download the understrap folder from GitHub or from [https://understrap.com](https://understrap.com)
- IMPORTANT: If you download it from GitHub make sure you rename the "understrap-master.zip" file just to "understrap.zip" or you might have problems using child themes !!
- Upload it into your WordPress installation subfolder here: `/wp-content/themes/`
- Login to your WordPress backend
- Go to Appearance → Themes
- Activate the UnderStrap theme

## Developing With npm, Gulp and SASS and [Browser Sync][1]

### Installing Dependencies
- Make sure you have installed Node.js and Browser-Sync* (* optional, if you wanna use it) on your computer globally
- Then open your terminal and browse to the location of your UnderStrap copy
- Run: `$ npm install`

### Running
To work and compile your Sass files on the fly start:

`$ gulp watch`

Or, to run with Browser-Sync:

- First change the browser-sync options to reflect your environment in the file `/gulpfile.js` in the beginning of the file:
```javascript
var browserSyncOptions = {
    proxy: "localhost/theme_test/", <----- CHANGE HERE
    notify: false
};
```
then run: `$ gulp watch-bs`

## How to Use the Build-In Widget Slider

The front-page slider is widget driven. Simply add more than one widget to widget position “Hero”.
- Click on Appearance → Widgets.
- Add two, or more, widgets of any kind to widget area “Hero”.
- That’s it.

## RTL styles?
Just add a new file to the themes root folder called rtl.css. Add all alignments to this file according to this description:
https://codex.wordpress.org/Right_to_Left_Language_Support

## Page Templates

### Blank Template

The `blank.php` template is useful when working with various page builders and can be used as a starting blank canvas.

### Empty Template

The `empty.php` template displays a header and a footer only. A good starting point for landing pages.

### Full Width Template

The `fullwidthpage.php` template has full width layout without a sidebar.

[1] Visit [http://browsersync.io](http://browsersync.io) for more information on Browser Sync

Licenses and Credits
=
- UnderStrap WordPress Theme: https://understrap.com/ GNU GPLv2
- Font Awesome: http://fontawesome.io/license (Font: SIL OFL 1.1, CSS: MIT License)
- Bootstrap: http://getbootstrap.com | https://github.com/twbs/bootstrap/blob/master/LICENSE (Code licensed under MIT documentation under CC BY 3.0.)
and of course
- WP Bootstrap Navwalker by Edward McIntyre: https://github.com/twittem/wp-bootstrap-navwalker | GNU GPL
- Bootstrap Gallery Script based on Roots Sage Gallery: https://github.com/roots/sage/blob/5b9786b8ceecfe717db55666efe5bcf0c9e1801c/lib/gallery.php
- jQuery: https://jquery.org | (Code licensed under MIT)


[![Analytics](https://ga-beacon.appspot.com/UA-139292-31/chromeskel_a/readme)](https://github.com/igrigorik/ga-beacon)
