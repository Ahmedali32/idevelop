var gulp = require('gulp'),
	watch = require('gulp-watch'),
	sass = require('gulp-sass'),
	autoprefixer = require('gulp-autoprefixer'),
	sourcemaps = require('gulp-sourcemaps');

gulp.task('sass', function () {
	gulp.src('assets/scss/*.scss')
	.pipe(sourcemaps.init())
	.pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
	 .pipe(sourcemaps.write('./'))
	.pipe(gulp.dest(''));
});

gulp.task('autoprefixer', function () {
	return gulp.src('assets/css/style.css')
	.pipe(autoprefixer({
		browsers: ['last 3 versions'],
		cascade: false
	}))
	.pipe(gulp.dest(''));
});

gulp.task('watch', function () {
	gulp.watch('assets/**/*.scss', ['sass']);
	gulp.watch('assets/css/style.css', ['autoprefixer']);
});

gulp.task('default', ['sass', 'watch']);
