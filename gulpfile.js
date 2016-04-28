var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');
var jshint = require('gulp-jshint');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var header = require('gulp-header');


// options
var sassOptions = {
  errLogToConsole: true,
  outputStyle: 'compressed' //expanded, nested, compact, compressed
};
var autoprefixerOptions = {
  browsers: ['last 2 versions', '> 5%', 'Firefox ESR']
};



// Lint JS
gulp.task('lint', function() {
	return gulp.src('js/*.js')
		.pipe(jshint())
		.pipe(jshint.reporter('default'));
});


// Concatenate & Minify JS
gulp.task('scripts', function() {
	return gulp.src('js/*.js')
		.pipe(sourcemaps.init())
		.pipe(concat('all.js'))
		.pipe(uglify())
		.pipe(sourcemaps.write('./map'))
		.pipe(gulp.dest('j'));
});


// Process scss into css
gulp.task('styles', function() {
	var pkg = require('./package.json');
	var banner = ['/*',
  'Theme Name: <%= pkg.name %>',
  'Theme URI: <%= pkg.homepage %>',
  'Author: URI',
  'Author URI: http://uri.edu',
  'Description: Description',
  'Version: 1.0.0',
  'License: GNU General Public License v2 or later',
  'License URI: http://www.gnu.org/licenses/gpl-2.0.html',
  'Text Domain: uri2016',
  'Tags:',
  '',
  'This theme, like WordPress, is licensed under the GPL.',
  'Use it to make something cool, have fun, and share what you\'ve learned with others.',
  '',
  'uri2016 is based on Underscores http://underscores.me/, (C) 2012-2015 Automattic, Inc.',
  'Underscores is distributed under the terms of the GNU GPL v2 or later.',

  '',
  'Normalizing styles have been helped along thanks to the fine work of',
  'Nicolas Gallagher and Jonathan Neal http://necolas.github.com/normalize.css/',
  '',
  '@version v<%= pkg.version %>',
  '@author John Pennypacker <jpennypacker@uri.edu>',
  '',
  '*/',
  ''].join('\n')

	gulp.src('sass/**/*.scss')
		.pipe(sourcemaps.init())
		.pipe(sass(sassOptions).on('error', sass.logError))
		.pipe(autoprefixer(autoprefixerOptions))
		.pipe(concat('style.css'))
		.pipe(header(banner, { pkg : pkg } ))
		.pipe(sourcemaps.write('./map'))
		.pipe(gulp.dest('.'));
});



  


// Watch Files For Changes
gulp.task('watch', function() {
	gulp.watch('js/*.js', ['lint', 'scripts']);
	gulp.watch('sass/**/*.scss',['styles']);
});



gulp.task('default', ['lint', 'scripts', 'styles', 'watch']);
