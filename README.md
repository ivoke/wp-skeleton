# WordPress Skeleton

For your own wp-skeleton please head over to [markjaquith's great WordPress-Skeleton](https://github.com/markjaquith/WordPress-Skeleton). This is just a forkless Customization.

## Plugins

* [Root Relative Urls](http://wordpress.org/plugins/root-relative-urls/)
* [FirePHP](http://wordpress.org/plugins/firephp-firebug-php/)
* [Roots](http://roots.io)

## Assumptions

* WordPress as a Git submodule in `/wp/`
* Roots as Git submodule in `/content/roots`
* Custom content directory in `/content/` (cleaner, and also because it can't be in `/wp/`)
* `wp-config.php` in the root (because it can't be in `/wp/`)
* `media` folder lives in `/content/media`


## Additions
* working redirection via htaccess for
  * theme assets
  * wp-admin assets
* local/staging/production environments

## TBD
* Test Support for wp-stack

## Setup
* Ivoke Mittwald setup
  * log into Mittwald with admin rights
  * switch to **Accountverwaltung**
  * create new account (**Kunden anlegen**) with
    * account description (**Accountbeschreibung**) my_project_name
    * account template (**Accountvorlage**) 'Ivoke Wordpress'
    * plan (**Leistungsvorlage**) 'wp-base'
    * Note: max Password length = 16
    * Please save to KeePass
 * the account needs approx. 15 minutes to setup
 * in your account go to databases (**Datenbanken**) / database users (**Datenbankbenutzer**) and set the password for the export user

* Setup local repo
  * clone it `git clone git@github.com:ivoke/wp-skeleton.git my_project_name`
  * cd into `my_project_name`
  * you will need [rake](https://github.com/jimweirich/rake) and [composer](https://github.com/composer/composer)
  * Install COMPOSER:
    * download `composer` with `curl -sS https://getcomposer.org/installer | php`
    * needs flag `-d detect_unicode=Off` if related errors appear
    * install it with `php composer.phar install`
  * run `rake wp:install`


* configure development env
  * setup a local database my_project_name
  * copy `/env_local.php.sample` -> `/env_local.php`
    * add local_db_name
    * add local_db_user
    * add local_db_password
    * add local_db_host (localhost)
    * copy salts from `https://api.wordpress.org/secret-key/1.1/salt`
    * set `$table_prefix` to `my_project_name` + `_`. Should read `my_project_name_` now.
  * mount repo to local web server e.g. for xampp:
    * `ln -s repo_path htdocs_path/my_project_name`
    * enable `Include etc/extra/httpd-vhosts.conf` in `xampp_path/etc/httpd.conf`
    * add vhost to `xampp_path/etc/extra/httpd-vhosts.conf`

     ```
     <VirtualHost *:80>
         ServerName my_project_name.dev (example)
         DocumentRoot "htdocs_path/my_project_name"
     </VirtualHost>
     ```
    * add subdomain to hosts file `/etc/hosts` `127.0.0.1 my_project_name.dev`


* configure production env
  * copy `/cap/config/config.rb.sample` -> `/cap/config/config.rb`
    * add in `:wpdb :production`
      * `:host => mittwald_database_hostname` (left hand menu: Datenbanken)
      * `:user => mittwald_export_user_name` (left hand menu: Datenbanken -> Datenbankbenutzer -> export user)
      * `:password => mittwald_export_user_password` (If you didnt wait the 15 Minutes, proceed to first paragraph)
      * `:name => mittwald_database_name`
    * add in `:wpdb :staging` (which is used as development)
      * `:host => local_db_host (localhost)`
      * `:user => local_db_user`
      * `:password => local_db_password`
      * `:name => local_db_name`
  * copy `/cap/config/production.rb.sample` -> `/cap/config/production.rb`
    * add `role :web "mittwald_account_name@mittwald_account_url"`
      * account name: click on newly created account (left hand side) -> Account (**pXXXXXX**)
      * account URL: same page as before -> **pXXXXXX.mittwaldserver.info**
  * cd into `my_project_name/cap` and run `cap deploy:setup`
  * run `ssh mittwald_account_name@mittwald_account_url`
    * cd into `/html`
    * remove index.html `rm index.html`
    * cd into `/html/shared/config`
    * open env_production.php `vim env_production.php`
      * press `i` for insert mode
      * copy/paste `env_local.php` content
      * change DB_NAME to mittwald_database_name
      * change DB_USER to mittwald_account_name
      * change DB_PASSWORD to mittwald_account_password
      * change DB_HOST to mittwald_database_host_name
      * press `ESC`, `:wq`, `ENTER`
      * exit ssh session by typing `exit`
  * cd into `my_project_name/cap` and run `cap deploy`


* configure wordpress
  * go to mittwald_account_url and install wordpress
  * login and activate roots theme
  * save all in KeePass

* initial commit
  * log into github
  * change to ivoke (https://github.com/organizations/ivoke)
  * create new repository -> enter stuff -> create repository
  * Follow instructions from **Push an existing repository from the command line**
  * `git remote add origin https://github.com/ivoke/my_project_name.git`
  * `git push -u origin master`
