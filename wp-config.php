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
define('DB_NAME', 'wp');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'RJ9sWkLHWO,LZ3-(gGt)l_<I>P0W?(w~x=Gd8>MZn6yl2v2*QU]w~mSBB,zg7r4-');
define('SECURE_AUTH_KEY',  '2e8cG*TLyrlvi}le7_;47,<jGX9hA9Y[|g_q6D1K1R^*vB7>t$xVkVG<F!mvHwcv');
define('LOGGED_IN_KEY',    '558ARH?uSN$J.2hipT7_P L m]gDm}fI$ih9UB|{e]{7bu<7c<2K*rxUTL/1Kibq');
define('NONCE_KEY',        '}0cNv~:O_/ijh&pq1wnmuE2HBNEy?rrv59l-F9JaZGC.)vJ/M.a_n/0Y}s#Y$7:8');
define('AUTH_SALT',        '3w=7q^sqLz[.,=}+{Q8LiIDz<)h%gH&{[N]p*w^HVQ~Vy.~zuQ+9RFFk!cD{+N q');
define('SECURE_AUTH_SALT', 'RCLpzv?O3jALhlP-o|J-}4DpSOB<Oi9A<p-_#7s;N3j8M?[%2T{% 7QouAc2ArY_');
define('LOGGED_IN_SALT',   'gT9TEn)X:@G?f.PD<W=$HYXPP;ag?k)&iL.eh+e2KoHU@HkG*[0,7*N8xV]oE6gS');
define('NONCE_SALT',       'nY2Z<#ek| D3m&k}l|[y#WHk? TbM+n`i5a7;V_R<P<Pe0v]=n{w`;@dJQ#R.i1E');

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
define('WP_DEBUG', false);
define('WP_ALLOW_MULTISITE', true);
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
