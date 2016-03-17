var gulp = require('gulp');
var jshint = require('gulp-jshint');
var sass = require('gulp-sass');
var watch = require('gulp-watch');
var minifycss = require('gulp-minify-css');
var rename = require('gulp-rename');
var gzip = require('gulp-gzip');
var livereload = require('gulp-livereload');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');

var gzip_options = {
    threshold: '1kb',
    gzipOptions: {
        level: 9
    }
};

/* Compile Our Sass */
gulp.task('sass', function() {
    return gulp.src('scss/*.scss')
        .pipe(sass())
        .pipe(gulp.dest('web/css'))
        .pipe(rename({suffix: '.min'}))
        .pipe(minifycss())
        .pipe(gulp.dest('web/css'))
        .pipe(gzip(gzip_options))
        .pipe(gulp.dest('web/css'))
        .pipe(livereload());
});

gulp.task('jshint', function() {
	return gulp.src([
			'assets/**/*.js'
		])
		.pipe(jshint())
		.pipe(jshint.reporter('default'))
});

gulp.task('scripts', function() {
	return gulp.src([
			'bower_components/jquery/dist/jquery.js',
			'bower_components/foundation/js/foundation/foundation.js',
			'bower_components/foundation/js/foundation/foundation.equalizer.js',
			'assets/**/*.js'
		])
		.pipe(concat('main.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest('web/js'));
});

/* Watch Files For Changes */
gulp.task('watch', function() {
    livereload.listen();
    gulp.watch('scss/*.scss', ['sass']);
	gulp.watch('src/**/*.js', ['scripts']);
});

gulp.task('default', ['jshint', 'scripts', 'sass', 'watch']);
