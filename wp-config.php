<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'merlinla_production');

/** MySQL database username */
define('DB_USER', 'merlinla_root');

/** MySQL database password */
define('DB_PASSWORD', 'T8%NwkWNCm2b');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('FS_METHOD','direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '0stpxhwajthagevafvylzwobwwl8nbogi7fidjb3kntsyfui5mgtnkjjlsyvljm9');
define('SECURE_AUTH_KEY',  '2lrghjyiskwj3or4e1r9luefpobgsdja7apnxgaagun8acrxyjg1mr8jloouafrq');
define('LOGGED_IN_KEY',    'a4brabmydlraihpfrhrebh5snzni2js6wxji8v1ewteazejdvo8yrx60rjaza4it');
define('NONCE_KEY',        'hpkauh5vnpv3ketslwfgeivfvlgfswrwwxe4cvx8d175ejzt8bea6lmtnv1wbbp6');
define('AUTH_SALT',        'uxkwxuyzmmnzhppnklsitpcrnocy4y1ri0vudootqwkr0aww3l8hphqar4qpl6xa');
define('SECURE_AUTH_SALT', '8cd2ip7oy26kfzz8yighsxjsbxbuuamzktqysuymiq1zu6lvqjjyp5il85pdwvwh');
define('LOGGED_IN_SALT',   'djzhztin5yn6yag8xlflayzasa0jm7stxm0yrostywbcjuqjegqvjwjcaqea8nsy');
define('NONCE_SALT',       'ajqoxkrajsiemy1il1ondm65cnorwwdbulp9i5csj7i63oszyjc6ffmvzogbizy3');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', true);

define('CONCATENATE_SCRIPTS', false );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
