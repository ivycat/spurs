// Defining requirements
var gulp = require('gulp');
var plumber = require('gulp-plumber');
var sass = require('gulp-sass');
var babel = require('gulp-babel');
var postcss = require('gulp-postcss');
var watch = require('gulp-watch');
var rename = require('gulp-rename');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var webp = require('gulp-webp');
var sourcemaps = require('gulp-sourcemaps');
var browserSync = require('browser-sync').create();
var del = require('del');
var cleanCSS = require('gulp-clean-css');
var autoprefixer = require('autoprefixer');

// Configuration file to keep your code DRY
var cfg = require('./gulpconfig.json');
var paths = cfg.paths;

// Run:
// gulp sass
// Compiles SCSS files in CSS and merge into folder_name.css
gulp.task('compile-sass', function(done) {
	return gulp
		.src( paths.sass + '/**/*.scss' )
		.pipe(
			plumber({
				errorHandler: function(err) {
					console.log(err);
					this.emit('end');
				}
			})
		)
		.pipe(sourcemaps.init())
		.pipe(sass({ errLogToConsole: true }))
		.pipe(postcss([autoprefixer()]))
		.pipe(concat('theme.css'))
		.pipe(sourcemaps.write(undefined, { sourceRoot: './' }))
		.pipe(gulp.dest(paths.css))
		.pipe(sourcemaps.init({ loadMaps: true }))
		.pipe(cleanCSS({compatibility: '*'}))
		.pipe(
			plumber({
				errorHandler: function (err) {
					console.log(err);
					this.emit('end');
				}
			})
		)
		.pipe(rename({suffix: '.min'}))
		.pipe(sourcemaps.write(''))
		.pipe(gulp.dest(paths.css));
});

gulp.task('compile-fa', function() {
	return gulp
		.src(`${paths.node}/@fortawesome/**/fontawesome.scss`)
		.pipe(
			plumber({
				errorHandler: function(err) {
					console.log(err);
					this.emit('end');
				}
			})
		)
		.pipe(sourcemaps.init())
		.pipe(sass({ errLogToConsole: true }))
		.pipe(postcss([autoprefixer()]))
		.pipe(concat('fontawesome.css'))
		.pipe(sourcemaps.write(undefined, { sourceRoot: './' }))
		.pipe(gulp.dest(paths.css))
		.pipe(sourcemaps.init({ loadMaps: true }))
		.pipe(cleanCSS({compatibility: '*'}))
		.pipe(
			plumber({
				errorHandler: function (err) {
					console.log(err);
					this.emit('end');
				}
			})
		)
		.pipe(rename({suffix: '.min'}))
		.pipe(sourcemaps.write(''))
		.pipe(gulp.dest(paths.css));
});

// Run:
// gulp watch
// Starts watcher. Watcher runs gulp sass task on changes
gulp.task('watch', function() {
	gulp.watch(`${paths.sass}/**/*.scss`, gulp.series('compile-sass'));
	gulp.watch(
		[
			`${paths.dev}/js/**/*.js`,
			'js/**/*.js',
			'!js/theme.js',
			'!js/theme.min.js'
		],
		gulp.series('compile-scripts')
	);
});

// Run:
// gulp webp
// Converts jpeg/png to webp
gulp.task('webp', function () {
	return gulp.src([

		/*`${paths.uploads}/!**!/!*.jpg`,
		`${paths.uploads}/!**!/!*.jpeg`,
		`${paths.uploads}/!**!/!*.png`,
		`${paths.uploads}/!**!/!*.gif`,*/

		`${paths.img}/**/*.jpg`,
		`${paths.img}/**/*.jpeg`,
		`${paths.img}/**/*.png`,
		`${paths.img}/**/*.gif`,
	])
		.pipe(webp())
		.pipe(gulp.dest(function (file) {
			return file.base;
		}))
});

// Run:
// gulp browser-sync
// Starts browser-sync task for starting the server.
gulp.task('browser-sync', function() {
	browserSync.init(cfg.browserSyncWatchFiles, cfg.browserSyncOptions);
});

// Run:
// gulp scripts.
// Uglifies and concat all JS files into one
gulp.task('compile-scripts', function() {
	var scripts = [
		// Start - All BS4 stuff
		`${paths.dev}/js/bootstrap4/bootstrap.bundle.js`,

		// End - All BS4 stuff

		`${paths.dev}/js/skip-link-focus-fix.js`,
		`${paths.dev}/js/loadmore.js`,

		// Adding currently empty javascript file to add on for your own themes´ customizations
		// Please add any customizations to this .js file only!
		`${paths.dev}/js/custom-javascript.js`
	];
	gulp
		.src(scripts, { allowEmpty: true })
		.pipe(babel(
			{
				presets: ['@babel/preset-env']
			}
		))
		.pipe(concat('theme.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest(paths.js));

	return gulp
		.src(scripts, { allowEmpty: true })
		.pipe(babel())
		.pipe(concat('theme.js'))
		.pipe(gulp.dest(paths.js));
});

// Deleting any file inside the /src folder
gulp.task('clean-source', function() {
	return del(['src/**/*']);
});

// Run:
// gulp watch-bs
// Starts watcher with browser-sync. Browser-sync reloads page automatically on your browser
gulp.task('watch-bs', gulp.parallel('browser-sync', 'watch'));

// Run
// gulp compile
// Compiles the styles and scripts and runs the dist task
gulp.task('compile', gulp.series('compile-sass', 'compile-fa', 'compile-scripts'));

// Run:
// gulp
// Starts watcher (default task)
gulp.task('default', gulp.series('watch'));
