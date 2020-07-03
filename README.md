# acf-wp-theme-skeleton

## requirements
- php
- wordpress plugin "advanced custom forms - pro" (have licence key ready)
- nvm (node version manager)
- nodejs (use nvm to install)
- docker (optional)

## installation
- `nvm use`
- `npm install`

## configuration
- put your acf pro key in `.env`
- edit `config/config.yml`
- - `config.theme.slug`, give your theme a name (also change this in composer.json)
- - `config.release.check`, enable checking for updates of the theme on github
- - `config.release.token`, put your github token here
- - `config.site.create_pages`, enable this to assure pages in pages.yml are being created
- - `config.admin.show_acf`, enable this to show the acf admin-menu entry
- edit `style.css` to put your theme name and info there

## development

### run docker image
- `docker-compose up`
- make sure `config/fieldgroups` is writable (`chmod 777 config fieldgroups`)

### run watch task
- `grunt dev`

### structure

#### config/

- `config.yml`, holds configuration for the theme
- `pages.yml`, holds pagestructure that is used if `config.site.create_pages` is enabled, subpages are possible one level deep, pagetitle is key and needs to be unique
- `fieldgroups/`, holds acf configuration for fieldgroups

#### public/

- `css/`, holds the css compiled stylesheet
- `fonts/`, can be used to put fontfiles
- `img/`, can be used to put images
- `js/`, holds the minified javascript

### resources/javascript/
- `js/functions.js`, holds your javascript functions, will be compiled to `public/app.min.js`
- `js/helper/*.js`, can be used to structure your javascript a bit, will be compiled to `public/helper.min.js`
- `js/vendor/*.js`, put third-party-libraries (like jQuery here), will be compiled to `public/libraries.min.js`

### resources/scss/
- `scss/`, holds a rough [ITCSS](https://www.freecodecamp.org/news/managing-large-s-css-projects-using-the-inverted-triangle-architecture-3c03e4b1e6df/) structure, will be compiled to `public/css/stylesheet.css`
- check the files for more explanation

### resources/templates/
- `menu.php`, holds the wordpress menu, excludes pages that have a "position" of "less than zero"
- `partials/`, holds the html/php for all the customfields created, filename has to be `$acf_field_name`.php

### resources/scripts/
- `.htaccess`, used by docker container to configure apache
- `docker_php_config.ini`, used by docker container to configure php

### resources/src/
- `ACFWrapper.php`, creates a shortcode that allows for inclusion of modules via shortcode `[acf_wrapper partial="textblock"]`
- `Backend.php`, keeps the admin backend functionality of the plugin
- `Shortcode.php`, abstract class for shortcode functionality
- `TemplateEngine.php`, used to render templates, currently plain php, could be twig or whatever
- `Theme.php`, initializes the theme, is called in `functions.php`, put custom hooks and actions here or in `Backend.php`

## release

## build release locally
- `grunt package`
- `ls -a target/`

## build release on github
- `grunt release`
- `git checkout -b release/<versionnumber>`
- `git push`

