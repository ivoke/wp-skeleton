<?php

// ===================================================
// Load database info and parameters
// ===================================================
if ( file_exists( dirname( __FILE__ ) . '/env_local.php' ) ) {

    // Local Environment
    define('WP_ENV', 'local');
    define('WP_DEBUG', true);
    include( dirname( __FILE__ ) . '/env_local.php' );

} elseif ( file_exists( dirname( __FILE__ ) . '/env_staging' ) ) {

    // Staging Environment
    define('WP_ENV', 'staging');
    define('WP_DEBUG', true);
    include( dirname( __FILE__ ) . '/env_staging.php' );

} elseif ( file_exists( dirname( __FILE__ ) . '/env_production' ) ) {

    // Production Environment
    define('WP_ENV', 'production');
    define('WP_DEBUG', false);

    include( dirname( __FILE__ ) . '/env_production.php' );
} else {
    trigger_error("Please provide a config file (env_local.php e.g)", E_USER_ERROR);
}

// ========================
// Custom Content Directory
// ========================
define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/content' );
define( 'WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/content' );

// =================================================================
// Custom Upload Directory
// Define relative to the wp folder
// =================================================================
define( 'UPLOADS', '../media' );

// ================================================
// You almost certainly do not want to change these
// ================================================
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

// ======================================
// Load a Memcached config if we have one
// ======================================
if ( file_exists( dirname( __FILE__ ) . '/memcached.php' ) )
  $memcached_servers = include( dirname( __FILE__ ) . '/memcached.php' );

define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST']);
define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST']);
define('DOMAIN_CURRENT_SITE', $_SERVER['HTTP_HOST']);

// ===========================================================================================
// This can be used to programatically set the stage when deploying (e.g. production, staging)
// ===========================================================================================
define( 'WP_STAGE', '%%WP_STAGE%%' );
define( 'STAGING_DOMAIN', '%%WP_STAGING_DOMAIN%%' ); // Does magic in WP Stack to handle staging domain rewriting

// ===================
// Bootstrap WordPress
// ===================
if ( !defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/wp/' );
require_once( ABSPATH . 'wp-settings.php' );
