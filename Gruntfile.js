module.exports = function(grunt) {
     // Project configuration.
     grunt.initConfig({
         watch: {
             sassFiles: {
                 files: './resources/sass/*.scss',
                 tasks: ['sass', 'cssmin']
             }
         },
         sass: {
             dev: {
                 options: {
                     style: 'expanded'
                 },
                 files: {
                     './public/css/main.css': './resources/sass/main.scss',
                 }
             }
         },
         cssmin: {
             target: {
               files: [{
                 expand: true,
                 cwd: 'public/css',
                 src: ['*.css', '!*.min.css'],
                 dest: 'public/css',
                 ext: '.min.css'
               }]
             }
         }
     });
 
     grunt.loadNpmTasks('grunt-contrib-cssmin');
     grunt.loadNpmTasks('grunt-contrib-sass');
     grunt.loadNpmTasks('grunt-contrib-watch');
 
     grunt.registerTask('style', ['sass']);
     grunt.registerTask('minify', ['cssmin']);
     grunt.registerTask('default', ['watch']);
 }