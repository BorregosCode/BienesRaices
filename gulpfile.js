const { src, dest, watch, series, parallel } = require('gulp');


//CSS
const sass = require('gulp-sass')(require('sass'));
const plumber = require('gulp-plumber');
const autoprefixer = require('autoprefixer');
const postcss = require('gulp-postcss')
const sourcemaps = require('gulp-sourcemaps')
const cssnano = require('cssnano');
// NO SABEMOS
const cache = require('gulp-cache');
const rename = require('gulp-rename');

// IMAGENES
const imagemin = require('gulp-imagemin'); // Minificar imagenes 
const webp = require('gulp-webp');
const clean = require('gulp-clean');
const notify = require('gulp-notify');

//JAVASCRIPT
const terser = require('gulp-terser-js');
const concat = require('gulp-concat');

const paths = {
    scss: 'src/scss/**/*.scss',
    js: 'src/js/**/*.js',
    imagenes: 'src/img/**/*'
}

function css(done) {
    src(paths.scss)
        .pipe(sourcemaps.init())
        .pipe(plumber())
        .pipe(sass())
        .pipe(postcss([autoprefixer(), cssnano()]))
        // .pipe(postcss([autoprefixer()]))
        .pipe(sourcemaps.write('.'))
        .pipe(dest('build/css'));
        done();
}

function javascript(done) {
    src(paths.js)
      .pipe(sourcemaps.init())
      .pipe(concat('bundle.js'))
      .pipe(terser())
      .pipe(sourcemaps.write('.'))
      .pipe(rename({ suffix: '.min' }))
      .pipe(dest('./build/js'))
      done();
}

function imagenes(done) {
    src(paths.imagenes)
        .pipe(cache(imagemin({ optimizationLevel: 3 })))
        .pipe(dest('build/img'))
        // .pipe(notify({ message: 'Imagen Completada' }));
        done();
    }

    function versionWebp(done){
        const opciones = {
            quality: 50
        };
   
        src(paths.imagenes)
           .pipe( webp(opciones) )
        //    .pipe(notify({ message: 'Imagen Completada' }));
        done();
    }



function watchArchivos(done) {
    watch(paths.scss, css);
    watch(paths.js, javascript);
    watch(paths.imagenes, imagenes);
    watch(paths.imagenes, versionWebp);
    done();
}

// function dev(done){
//     // watch("src/scss/app.scss", css); //revisar un archivo SASS especifico
//     watch("src/scss/**/*.scss", css); //revisar todos los archivos SASS
//     watch("src/js/**/*.js", javascript); //revisar todos los archivos JavaScript
//     done();
// }

exports.css = css;
exports.watchArchivos = watchArchivos;
// exports.default = parallel(css, javascript, imagenes, versionWebp, watchArchivos);
exports.default = parallel(css, imagenes, versionWebp,javascript, watchArchivos);