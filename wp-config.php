<?php
// ======================================================
// MDP 3.0 wp-config + .env
// ======================================================

require_once(__DIR__ . '/vendor/autoload.php');
(\Dotenv\Dotenv::create( __DIR__ . '/' ))->load();

ini_set( 'display_errors', 0 );

// =======================================================
// Load database info and development parameters from .env
// =======================================================
// $envs is needed for the wp-stage-switcher

$envs = [
    'local'       => getenv('URL_LOCAL'),
    'staging'     => getenv('URL_STAGING'),
    'production'  => getenv('URL_PRODUCTION')
];

define('WP_ENV', getenv('ENVIRONMENT'));
define('ENVIRONMENTS', $envs );
define('DB_NAME', getenv('DB_NAME'));
define('DB_USER', getenv('DB_USER'));
define('DB_PASSWORD', getenv('DB_PASSWORD'));
define('DB_HOST', getenv('DB_HOST'));
define('WP_HOME', getenv('WP_HOME'));
define('WP_SITEURL', getenv('WP_SITEURL'));
define('WP_DEBUG', getenv('WP_DEBUG') );
define('WP_DEBUG_DISPLAY', getenv('WP_DEBUG_DISPLAY') );
define('WP_DEBUG_LOG', getenv('WP_DEBUG_LOG') );
define('DISALLOW_FILE_EDIT', getenv('DISALLOW_FILE_EDIT') );
define('AUTOMATIC_UPDATER_DISABLED', getenv('AUTOMATIC_UPDATER_DISABLED') );
define('CLIENT_WORKS_ON', getenv( 'CLIENT_WORKS_ON' ) );
define( 'WP_REDIS_DISABLED', getenv( 'WP_REDIS_DISABLED' ) );
define( 'ASWPT_DOCROOT', __DIR__ );

// =======================================================
// Settings for local environment only
// =======================================================
if ( getenv('ENVIRONMENT') == 'local') {
    // See updates
    define('DISALLOW_FILE_MODS', 0 );
    // Allow all file types
    define('ALLOW_UNFILTERED_UPLOADS', true);
} else {
    define('DISALLOW_FILE_MODS', getenv('DISALLOW_FILE_MODS') );
}

// ======================================================
// Spinupwp settings for cache
// ======================================================
define( 'WP_CACHE_KEY_SALT', getenv('URL_PRODUCTION') );
define( 'WP_REDIS_SELECTIVE_FLUSH', true );
define( 'SPINUPWP_CACHE_PATH', '/cache/' . getenv('URL_PRODUCTION') );

// ======================================================
// You almost certainly do not want to change these
// ======================================================
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

// =======================================================
// Load salts from salts.php if file exists
// =======================================================

if( file_exists( __DIR__ . '/salts.php' ) ) {
	require_once __DIR__ . '/salts.php';
	if( ! defined( 'AUTH_KEY' ) || strlen( AUTH_KEY ) == 0 || AUTH_KEY == 'a value' ) {
		echo 'This recipe needs some salt'; die;
	}
} else {
	echo 'This recipe needs some salt'; die;
}

// ========================
// Custom Content Directory
// ========================
define('WP_CONTENT_URL', WP_HOME .  '/wp-content' );
define('WP_CONTENT_DIR', dirname( ABSPATH ) . '/wp-content' );

// =====================================================
// Load WordPress Settings - please change table prefix
// =====================================================
$table_prefix  = 'wp_';
define('WP_POST_REVISIONS', 3);
define('DISABLE_WP_CRON', true );

// ====================================================
// Inserted by Local by Flywheel
// ====================================================
if (isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) {
	$_SERVER['HTTPS'] = 'on';
}

// ====================================================
// Absolute path to the WordPress directory
// ====================================================
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/core' );

// ====================================================
// Sets up WordPress vars and included files
// ====================================================
require_once ABSPATH . 'wp-settings.php';
