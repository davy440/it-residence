module.exports = function (grunt) {
  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    watch: {
      options: {
        livereload: true
      },
      files: ['**/*.js', '**/*.scss'],
      tasks: ['default']
    },
    sass: {
      dist: {
        options: {
          style: 'expanded',
          update: true,
          sourcemap: false
        },
        files: [
          {
            expand: true,
            cwd: 'assets/theme-styles/scss/',
            src: ['**/*.scss'],
            dest: 'assets/theme-styles/css/',
            ext: '.css'
          }
        ]
      }
    },
    uglify: {
      options: {
        banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n',
        sourceMap: false
      },
      min: {
        files: [
          {
            expand: true,
            cwd: 'assets/js/',
            src: [ '*.js' ],
            dest: 'assets/js/min/',
            ext: '.min.js'
          }
        ]
      }
    },
    cssmin: {
      options: {
        sourceMap: false
      },
      target: {
        files: [
          {
            expand: true,
            cwd: 'assets/theme-styles/css',
            src: [ '*.css', '!*.min.css' ],
            dest: 'assets/theme-styles/css',
            ext: '.min.css'
          }
        ]
      }
    }
  })

  grunt.loadNpmTasks('grunt-contrib-watch')
  grunt.loadNpmTasks('grunt-contrib-sass')
  grunt.loadNpmTasks('grunt-contrib-uglify')
  grunt.loadNpmTasks('grunt-contrib-cssmin')

  grunt.registerTask('default', [ 'sass', 'uglify', 'cssmin' ])
}
