const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const rename = require('gulp-rename');
const autoprefixer = require('gulp-autoprefixer');

// Caminhos para os arquivos
const paths = {
		styles: {
				src: 'resources/assets/styles/**/*.scss',
				dest: 'public/assets/styles'
		},
		scripts: {
				src: 'resources/assets/scripts/**/*.js',
				dest: 'public/assets/scripts'
		}
};

// Compilar arquivos SCSS em CSS
function styles() {
		return gulp.src(paths.styles.src)
				.pipe(sass().on('error', sass.logError))
				.pipe(autoprefixer())
				.pipe(gulp.dest(paths.styles.dest));
}

// Minificar e concatenar arquivos JavaScript
function scripts() {
		return gulp.src(paths.scripts.src)
				.pipe(uglify())
				.pipe(rename({
						suffix: '.min'
				}))
				.pipe(gulp.dest(paths.scripts.dest));
}

// Monitorar alterações nos arquivos
function watch() {
		gulp.watch(paths.styles.src, styles);
		gulp.watch(paths.scripts.src, scripts);
}

// Tarefas disponíveis para o Gulp
exports.styles = styles;
exports.scripts = scripts;
exports.watch = watch;

// Tarefa padrão
exports.default = gulp.series(styles, scripts, watch);