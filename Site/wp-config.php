<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache



/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */	

if ( strpos($_SERVER['HTTP_HOST'], 'rights') !== false) {
	require_once('db-config/r4g.config.php');
}elseif ( strpos($_SERVER['HTTP_HOST'], 'ag.dev') !== false) {
	require_once('db-config/ag.config.php');
}

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/** File System Method. allows wordpress to manage files. */ 
define('FS_METHOD', 'direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'nUL5|r$o56^|}v# IxLJ@ekC_-9<8<#ms<4?z|IO+{&?tQ,Z/-O~N)F&*j$Q6,D+');
define('SECURE_AUTH_KEY',  'eFyasuj^-eJH=3|=WTp5,l&|ODl/kd^K:;8nOG-Ym<]c)V2N+Eh(Hv_3i_n:ex_G');
define('LOGGED_IN_KEY',    'pp3|7(I;:H|GO^|iL*}`|?)a-^2h6E_rX[fbKR([[u*x}>*Y+_vElA*ODZ%AD[ d');
define('NONCE_KEY',        '4l!9=G9E*DI9 >$dRWY790P^Ms|#pwz|lR%,W`N_q?R4:%+5^VwaPt6y Y|&WCCn');
define('AUTH_SALT',        '4wvKY-q1$Q,9W;rgA+8N:rHy+LWxpkZJ~t_`OY>t9(ZPgO$p)4yNO`CnFGW_US~+');
define('SECURE_AUTH_SALT', 'hIO$S0y_Y++>s,=+<S~+u=jlP:S8M[+&Ebqea4<[m6aoEg!vv Dw9`$Oyk=??l2i');
define('LOGGED_IN_SALT',   'g2YVx1RKJM}N$L^h]8JYUl 5vUB]b4P#$&~a&f87,{{}1ae.!KKA^DA^5!KE`5L,');
define('NONCE_SALT',       '&:$|$binoFCBQ{EhXVaO7_*TJOox~t!U_,=LNFYIe}+#K38*G)/Olo#?!oy3H+ku');

/**#@-*/

/** Move Wp-Content Folder **/
define( 'WP_CONTENT_DIR', dirname(__FILE__) . '/wp-content' );
define( 'WP_CONTENT_URL', '/wp-content' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
