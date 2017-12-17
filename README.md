# Spurs WordPress Theme Framework

While you can easily make a child theme for Spurs, we recommend using Spurs to create your next spiffy new theme. Much
like [Underscores](http://underscores.me/) or [Sage](https://roots.io/sage/), Spurs isn't meant to be a child theme.

**Note:** We reserve the right to break backward compatibility at any point, in fact we expect it. Don't expect to 
automatically update the main theme automatically when there are updates.

If you'd like to get email notifications of new updates, please subscribe to our themes mailing list.

## About

Like [Holger Könemann](https://github.com/holger1411), creator of [Understrap](https://understrap.com), I'm a fan of Underscores, 
Bootstrap, Sass, npm, and Gulp.

Spurs is a fork of [Understrap](https://understrap.com) with the goals of:
1. my education and enrichment
1. implement helpful structural theme changes like a [theme wrapper](http://scribu.net/wordpress/theme-wrappers.html) 
to keep code warm and DRY.
1. add some handy functions to make our jobs easier and the WordPress Admin more integrated with the theme.
1. Have a good starter theme to use on new projects.

## Licenses
- Spurs WordPress Theme, *Copyright 2017 Eric Amundson*, [GNU GPLv3](http://www.gnu.org/licenses/gpl.html)
- UnderStrap WordPress Theme, *Copyright 2013-2017 Holger Koenemann*, [GNU GPLv2](http://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html)

## Changelog
See [changelog](CHANGELOG.md)

## Basic Features

- Combines Underscore’s PHP/JS files and Bootstrap’s HTML/CSS/JS.
- Comes with Bootstrap (v4) Sass source files and additional .scss files. 

  Nicely sorted and ready to add your own variables and customize the Bootstrap variables
- Use npm to install build tools like Gulp for compiling, linting, and BrowserSync.
- Uses a single and minified CSS file for all the basic stuff
- [Font Awesome](http://fortawesome.github.io/Font-Awesome/) integration (v4.7.0)
- Jetpack ready
- WooCommerce support
- Contact Form 7 support
- ~~Gravity Forms support~~ _(coming soon)_
- Translation ready

## Starter Theme + HTML Framework = WordPress Theme Framework

The _s theme is a good starting point to develop a WordPress theme. But it is “just” a raw starter theme; it outputs 
solid basic markup and WordPress functions without any layout or design.

Bootstrap 4 provides a well known and supported layout framework providing a solid, clean and responsive foundation.

Font Awesome provides the default icons.

You can easily load custom fonts using either Google Fonts or Typekit.

## How styles are organized

Some basics about the Sass and CSS files that come with UnderStrap:
- The theme uses the `/style.css` file to identify the theme inside of WordPress. The file is not loaded by the theme 
and does not include any styles.
- The `/css/theme.css` file and its minified little brother `/css/theme.min.css` provide all styles. 
It is composed of five different SCSS sets and one variable file loaded through `/sass/theme.scss`:

1. `theme/theme_variables` <----- Your custom variables plus those needed to overwrite Bootstrap or Spurs variables
2. `../src/bootstrap-sass/assets/stylesheets/bootstrap`  <----- Bootstrap vendor stuff **DON'T EDIT!**
3. `spurs/spurs` <----- Basic WordPress styles combining Boostrap and Underscores
4. `../src/fontawesome/scss/font-awesome` <----- Font Awesome Icon styles **DON'T EDIT!**
5. `theme/theme`  <----- Add your styles into this file

* Don’t edit or you won’t be able to update Bootstrap or Font Awesome without overwriting your own work!
- Your design goes into: `/sass/theme`. Add your styles to the `/sass/theme/_theme.scss` file and your variables to the 
`/sass/theme/_theme_variables.scss`. Or add other .scss files into it and `@import` it into `/sass/theme/_theme.scss`.

## Installation

### Classic install
- Download the spurs folder from GitHub
- IMPORTANT: If you download it from GitHub make sure you rename the "spurs-master.zip" file just to "spurs.zip"
- Upload it into your WordPress installation sub-folder here: `/wp-content/themes/`
- Login to your WordPress Admin
- Go to Appearance → Themes
- Activate the Spurs theme

## Developing with npm, Gulp and SASS and Browsersync

### Installing Dependencies
Make sure you have installed:
- [Node.js](https://nodejs.org) with npm 
- [Gulp](https://gulpjs.com/) `npm install -g gulp-cli`
- [Browsersync](http://browsersync.io) `npm install -g browser-sync`

Then open your terminal and browse to the location of your Spurs copy and run: `$ npm install` to install theme dependencies.

### Running
To work and compile your Sass files on the fly start:

`$ gulp watch`

Or, to run with Browsersync:

- First change the browser-sync options to reflect your environment in the file `/gulpfile.js` in the beginning of the file:
```javascript
var browserSyncOptions = {
    proxy: "localhost/theme_test/", <----- CHANGE HERE
    notify: false
};
```
then run: `$ gulp watch-bs`

Check out the `gulpfile.js` file to see the other available Gulp commands.

## How to use the built-in widget slider

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

The `full-width.php` template has full width layout without a sidebar.

### Sidebar Templates

- `left-sidebar.php` - layout with a sidebar `(col-4)` on the left of the content `(col-8)`
- `right-sidebar.php` - layout with a sidebar `(col-4)` on the right of the content `(col-8)`
- `both-sidebars.php` - layout with two slim sidebars `(col-3)` on left and right of main content `(col-6)`

Licenses and Credits
=
- UnderStrap WordPress Theme: https://understrap.com/ GNU GPLv2
- Font Awesome: http://fontawesome.io/license (Font: SIL OFL 1.1, CSS: MIT License)
- Bootstrap: http://getbootstrap.com | https://github.com/twbs/bootstrap/blob/master/LICENSE (Code licensed under MIT documentation under CC BY 3.0.)
and of course
- WP Bootstrap Navwalker by Edward McIntyre: https://github.com/twittem/wp-bootstrap-navwalker | GNU GPL
- Bootstrap Gallery Script based on Roots Sage Gallery: https://github.com/roots/sage/blob/5b9786b8ceecfe717db55666efe5bcf0c9e1801c/lib/gallery.php
- jQuery: https://jquery.org | (Code licensed under MIT)

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sewmyheadon/spurs/badges/quality-score.png?b=development)](https://scrutinizer-ci.com/g/sewmyheadon/spurs/?branch=development) [![Build Status](https://scrutinizer-ci.com/g/sewmyheadon/spurs/badges/build.png?b=development)](https://scrutinizer-ci.com/g/sewmyheadon/spurs/build-status/development) [![Analytics](https://ga-beacon.appspot.com/UA-111251480-1/welcome-page?flat)](https://github.com/sewmyheadon/spurs)