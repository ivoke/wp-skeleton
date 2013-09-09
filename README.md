# WordPress Skeleton

Based on [markjaquith's WordPress-Skeleton](https://github.com/markjaquith/WordPress-Skeleton)

## Plugins

* [Root Relative Urls](http://wordpress.org/plugins/root-relative-urls/)
* [FirePHP](http://wordpress.org/plugins/firephp-firebug-php/)
* [Roots](http://roots.io)

## Assumptions

* WordPress as a Git submodule in `/wp/`
* Roots as Git submodule in `/content/roots`
* Custom content directory in `/content/` (cleaner, and also because it can't be in `/wp/`)
* `wp-config.php` in the root (because it can't be in `/wp/`)
* `media` folder lives in `/`


## Additions
* working redirection via htaccess for
  * theme assets
  * wp-admin assets
* local/staging/production environments

## TBD
* Test Support for wp-stack
