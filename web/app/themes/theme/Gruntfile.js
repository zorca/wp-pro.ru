module.exports = function(grunt) {
	require('load-grunt-tasks')(grunt);

	grunt.initConfig({
		pkg: grunt.file.readJSON( 'package.json' ),
		makepot: {
			target: {
				options: {
					domainPath: '/languages',
					potHeaders: {
						poedit: true,                 // Includes common Poedit headers.
						'x-poedit-keywordslist': true // Include a list of all possible gettext functions.
					},                                // Headers to add to the generated POT file.
					type: 'wp-theme',                // Type of project (wp-plugin or wp-theme).
					updateTimestamp: true             // Whether the POT-Creation-Date should be updated without other changes.
				}
			}
		},

		phplint: {
			options : {
				spawn : false
			},
			all: ['**/*.php']
		},

		less: {
			development: {
				options: {
					paths: ["less"],
					sourceMap: true,
				},
				files: {
					"anspress/css/overrides.css": "includes/less/anspress/anspress.less",
					"includes/css/askbug.css": "includes/less/askbug.less",
					"includes/css/rtl.css": "includes/less/rtl.less",
					"includes/css/installer.css": "includes/less/installer.less"
				}
			},
			production: {
				options: {
					paths: ["less"],
					sourceMap: true,
					plugins: [
						new (require('less-plugin-autoprefix'))({browsers: ["last 2 versions"]})
					],
					/*modifyVars: {
						imgPath: '"http://mycdn.com/path/to/images"',
						bgColor: 'red'
					}*/
				},
				files: {
					"anspress/css/overrides.css": "includes/less/anspress/anspress.less",
					"includes/css/askbug.css": "includes/less/askbug.less",
					"includes/css/color.css": "includes/less/color.less"
				}
			}
		},
		copy: {
			main: {
				files: [
				{nonull:true, expand: true, cwd: 'D:\\xampp2\\htdocs\\anspress\\wp-content\\plugins\\anspress-question-answer', src: ['**/*', '!**/.git/**', '!**/.svn/**', '!**/node_modules/**', '!**/bin/**', '!**/docs/**', '!**/tests/**', '!**/vendor/**'], dest: 'D:\\xampp2\\htdocs\\askbug\\wp-content\\plugins\\anspress-question-answer'}
				]
			}
		},

		phplint : {
			options : {
				spawn : false
			},
			all: ['**/*.php']
		},
		version: {
			options: {
				release: 'patch'
			},
			themefiles: {
				options: {
					prefix: 'Version\\:\\s'
				},
				src: [ 'style.css', 'readme.txt' ],
			},
			php: {
				options: {
					prefix: 'define\\( \\\'ASKBUG_VERSION\\\', \\\''
				},
				src: [ 'functions.php' ],
			},
			project: {
				src: ['package.json']
			}
		},

		watch: {
			less: {
				files: ['**/*.less'],
				tasks: ['less'],
			}
		}
	});

	grunt.registerTask( 'build', [ 'makepot', 'less' ] );
}