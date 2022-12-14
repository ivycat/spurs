# Spurs WordPress Theme Framework

While you can easily make a child theme for Spurs, we recommend using Spurs to create your next spiffy new theme. Much
like [Underscores](http://underscores.me/) or [Sage](https://roots.io/sage/), Spurs isn't meant to be a child theme.

**Note:** We reserve the right to break backward compatibility at any point, in fact we expect it. Don't expect to
update the main theme automatically when there are updates.

[Get email notifications of new updates](https://mailchi.mp/ivycat/plugin-theme-updates).

## About

Like [Holger Könemann](https://github.com/holger1411), creator of [Understrap](https://understrap.com), I'm a fan of Underscores,
Bootstrap, Sass, npm, and Gulp.

The \_s theme is a good starting point to develop a WordPress theme. But it is “just” a raw starter theme; it outputs
solid basic markup and WordPress functions without any layout or design.

Bootstrap 4 provides a well known and supported layout framework providing a solid, clean and responsive foundation.

Spurs is a fork of [Understrap](https://understrap.com) with the goals of:

1. my education and enrichment
1. implement helpful structural theme changes like a [theme wrapper](http://scribu.net/wordpress/theme-wrappers.html) and some common sense file reorganization
   to keep code warm and DRY.
1. add some handy functions to make our jobs easier and the WordPress Admin more integrated with the theme.
1. Have a good starter theme to use on new projects.

### Basic Theme Features

- Combines Underscore’s PHP/JS files and Bootstrap’s HTML/CSS/JS.
- Comes with Bootstrap (v4) Sass source files and additional .scss files.
- Nicely sorted and ready to add your own variables and customize the Bootstrap variables
- Use npm to install build tools like Gulp for compiling, linting, and BrowserSync.
- Uses a single and minified CSS file for all the basic stuff
- [Font Awesome](http://fortawesome.github.io/Font-Awesome/) integration (v4.7.0)
- Jetpack ready
- WooCommerce support
- Contact Form 7 support
- ~~Gravity Forms support~~ _(coming soon)_
- Translation ready
- ~~Load custom fonts using Google Fonts or Adobe Fonts (Typekit)~~ _(coming soon)_.

## How files and styles are organized

### CSS / SCSS

Here's how the Sass and CSS files that come with Spurs work:

- The theme's `/style.css` file identifies the theme inside of WordPress but it isn't loaded by the theme and shouldn't include any styles.
- The `/css/theme.css` file and its lighter weight little brother `/css/theme.min.css` provide _all_ of the theme's styles. Just one of these files is loaded in the WordPress theme, depending on your settings.
- These theme files are composed of several different SCSS sets in `/spurs/sass/` loaded through `/spurs/sass/theme.scss`.

  ```// Core files
     @import "theme/variables";      // <--- Add your variables including overrides to Bootstrap or Spurs variables
     @import "assets/bootstrap4";    // <--- Load Bootstrap 4 (Do not tweak)*
     @import "spurs/spurs";          // <--- Loads Spurs defaults

     // Optional files - If you don't use the corresponding scripts/fonts comment them out
     @import "spurs/woocommerce";    // <--- Loads WooCommerce style fixes. Comment out if you aren't using WooCommerce
     @import "assets/font-awesome";  // <--- Font Awesome Icon font (Do not tweak)*
     @import "assets/underscores";   // <--- _s media styles
     @import "theme/contact-form7"; // <-- Contact Form 7 - Bootstrap 4 support

     // Theme-specific and other imports
     @import "theme/theme"; // <------------ Your custom styles go here
  ```

\*Don’t edit or tweak these files or you won’t be able to update Bootstrap or Font Awesome without overwriting your own work!

Your design customizations go into: `/sass/theme`.
Add your styles to the `/sass/theme/_theme.scss` file and your variables to
`/sass/theme/_variables.scss`.

You can remove or comment out files or SCSS sets you don't need. Or @import additional .scss files as needed into a file in `/sass/theme/`.

### Google Fonts

You can add google fonts url inside `sass/theme.scss` file directly.
At the top of the files you can your google fonts url like below.
`@import url("https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap");`

### JavaScript / jQuery

Inside `src/js/` directory, there is a file named `custom-javascript.js` . You need to write all of your JavaScript in this file. Gulp watcher automatcally watch this file when you write any code inside this file.

If you need any other file for JavaScript, you can put that file here in this directory. In that case, you need to add that file name in the `gulpfile.js` inside `script` function. Then gulp will automatically watch this file.

In this way, gulp will concat all the files into a one file and minify that file. In this case it will create `theme.min.js` and `theme.js` inside `js` folder of root directory.

If you don't want to compile and minify your another JavaScript file into a one file, you can simply put your another JavaScript file inside `js` directory and enqueue it directly inside `enqueue.php` file in `inc` folder.

### Page Templates

Page templates are located in `spurs/page-templates/`.

- Blank Template - The `blank.php` template is useful when working with various page builders and can be used as a starting blank canvas.
- Empty Template - The `empty.php` template displays a header and a footer only. A good starting point for landing pages.
- Full Width Template - The `full-width.php` template has full width layout without a sidebar.
- Sidebar Templates -
  - `left-sidebar.php` - layout with a sidebar `(col-4)` on the left of the content `(col-8)`
  - `right-sidebar.php` - layout with a sidebar `(col-4)` on the right of the content `(col-8)`
  - `both-sidebars.php` - layout with two slim sidebars `(col-3)` on left and right of main content `(col-6)`

### Other templates

- Global templates: `spurs/templates/global/`
- Loop templates: `spurs/templates/loop/`
- Sidebar templates: `spurs/templates/sidebar/`

## Start a project with Spurs

Below are the check lists if you start any project with Spurs

1.  Rename the folder name to your theme or site name
2.  Search and replace for spurs to your theme name.
3.  Rename spurs folder name from sass folder and file name inside this folder to your theme name or whatever your add to replace spurs. Also make sure same name is there in theme.scss file
4.  To create any custom post type check `inc/extra.php` and add your custom post details inside `spurs_register_cpts()` function.
5.  If Gutenberg needed to be activated for custom post type - open `inc/custom-cut.php` file. Then add `"show_in_rest" => true` for both post type and taxonomy array.
6.  In order to stop parent menu automatically convert into has link, edit your nav walker.
    Go to inc/bootstrap-wp-navwalker.php and search for `// If item has_children add atts to <a>`.
    Then update href like below.

    ```
    // old
    $atts['href'] = '#';

    // new
    $atts['href'] = ! empty( $item->url ) ? $item->url : '';
    ```

7.  In order to parent menu clickable add below code into your javascript.
    `$(".navbar .dropdown > a").click(function () { location.href = this.href; });`
8.  For the single post class of wrapper check `template-tags.php` file.
9.  For Page structure - look into `wrapper.php` and `inc/theme-wrapper.php`
10. For Sidebar check customizer theme settings panel and page template.
11. Pagination options is also available inside customizer panel.
12. If you wants to add any image in the theme, you can put that inside `images` folder in project root directory.

## Installation

### Classic install

- Download the spurs folder from [GitHub](https://github.com/sewmyheadon/spurs)
- IMPORTANT: If you download it from GitHub make sure you rename the "spurs-master.zip" file just to "spurs.zip"
- Upload it into your WordPress installation sub-folder here: `/wp-content/themes/`
- Login to your WordPress Admin
- Go to Appearance → Themes
- Activate the Spurs theme

## Developing with Spurs

Spurs uses npm, Gulp, Sass, and Browsersync and automatically takes care of compiling, linting, compressing and other nifty automation tasks.

### Installing Dependencies

Make sure you have installed:

- [Node.js](https://nodejs.org) with npm
- [Gulp](https://gulpjs.com/) `npm install -g gulp-cli`
- [Browsersync](http://browsersync.io) `npm install -g browser-sync`

Then open your terminal and browse to the location of your Spurs copy and run: `$ npm install` to install theme dependencies.

### Running

To set up Browsersync, change the `browserSyncOptions` proxy to reflect your environment in the beginning of the `/gulpfile.js` file.

```javascript
{
  "browserSyncOptions" : {
      "proxy": "localhost/theme_test/", // <----- YOUR HOST GOES HERE
      "notify": false
  },
  ...
};
```

`$ gulp watch` - compile your Sass and JS files on the fly
`$ gulp watch-bs` - compile with Browsersync

Check out the `gulpfile.js` file to see the other available Gulp commands.

## How to use the built-in widget slider

The front-page slider is widget driven. Simply add more than one widget to widget position “Hero”.

- Click on _Appearance → Widgets_.
- Add two, or more, widgets of any kind to widget area “Hero”.
- That’s it.

## RTL styles?

Just add a new file to the themes root folder called rtl.css. Add all alignments to [these instructions](https://codex.wordpress.org/Right_to_Left_Language_Support).

## Licenses

- Spurs WordPress Theme, _Copyright 2018-2020 Eric Amundson_, [GNU GPLv2](http://www.gnu.org/licenses/gpl.html)
- UnderStrap WordPress Theme, _Copyright 2013-2020 Holger Koenemann_, [GNU GPLv2](http://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html)

## Changelog

See [changelog](CHANGELOG.md)

## Credits

- UnderStrap WordPress Theme: https://understrap.com/ GNU GPLv2
- Font Awesome: http://fontawesome.io/license (Font: SIL OFL 1.1, CSS: MIT License)
- Bootstrap: http://getbootstrap.com | https://github.com/twbs/bootstrap/blob/master/LICENSE (Code licensed under MIT documentation under CC BY 3.0.)
  and of course
- WP Bootstrap Navwalker by Edward McIntyre: https://github.com/twittem/wp-bootstrap-navwalker | GNU GPL
- Bootstrap Gallery Script based on Roots Sage Gallery: https://github.com/roots/sage/blob/5b9786b8ceecfe717db55666efe5bcf0c9e1801c/lib/gallery.php
- jQuery: https://jquery.org | (Code licensed under MIT)

## Build Stats

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sewmyheadon/spurs/badges/quality-score.png?b=development)](https://scrutinizer-ci.com/g/sewmyheadon/spurs/?branch=development) [![Build Status](https://scrutinizer-ci.com/g/sewmyheadon/spurs/badges/build.png?b=development)](https://scrutinizer-ci.com/g/sewmyheadon/spurs/build-status/development) [![Analytics](https://ga-beacon.appspot.com/UA-111251480-1/welcome-page?flat)](https://github.com/sewmyheadon/spurs)
