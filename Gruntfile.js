module.exports = function (grunt) {
  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    uglify: {
      options: {
        banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
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

  grunt.loadNpmTasks('grunt-contrib-uglify')
  grunt.loadNpmTasks('grunt-contrib-cssmin')

  grunt.registerTask('default', [ 'uglify', 'cssmin' ])
}
