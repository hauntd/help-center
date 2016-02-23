module.exports = function (grunt) {
    grunt.initConfig({
        less: {
            prod: {
                options: {
                    compress: true
                },
                files: {
                    "web/css/app.min.css": [
                        "web/less/app.less"
                    ]
                }
            }
        },
        uglify: {
            options: {
                mangle: false
            },
            all: {
                files: {
                    'web/js/app.min.js': ['web/js/app.js', 'web/js/management.js'],
                }
            }
        },
        watch: {
            js: {
                files: ['web/js/**/*.js'],
                tasks: ['uglify:all'],
                options: {
                    livereload: true
                }
            },
            less: {
                files: ['web/less/**/*.less'],
                tasks: ['less'],
                options: {
                    livereload: true
                }
            }

        }
    });

    grunt.option('color', false);

    // Plugin loading
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-uglify');

    // Task definition
    grunt.registerTask('build', ['less', 'uglify']);
    grunt.registerTask('default', ['watch']);
};
