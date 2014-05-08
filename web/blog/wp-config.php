<?php
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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wp_omega_blog');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '9(aC#AC6fZoHp<R;qI3ropd//~FtDb_;hN(Tx+6v59 EQEM%J[v1P8d 2x],V^i>');
define('SECURE_AUTH_KEY',  '|6S>@`d2gOiM|d!9XZ5hIiGVE LNiHB`@{P~i0joVMUIEj4/*rEf#TE@HJ@]x<U)');
define('LOGGED_IN_KEY',    'xAE`%QB7=TXKHhku89VXzhdjj#D}g9:)|{1$s|YXe!xq+_#j.XaLriPhx7T~|l7@');
define('NONCE_KEY',        'i|RZl2v86d--}b*9{|=Nqx)^KP-(3<}GUxqG<jYm4&YKa;(k3-`*9&t`qV0xAO;p');
define('AUTH_SALT',        '&^l6%X_u!Q7]3Fc<g6*oFpI87`@)!qC+3Y5Y<IP@+Yg1~Q_xN^KYe2Z+<&CqY-$]');
define('SECURE_AUTH_SALT', 'U?gl7L0Q</Lmdga2|-U8$r>IDMMOkVsqXOj.I*|Hj)CN,wdg$;9djTL)yaMoL8Ha');
define('LOGGED_IN_SALT',   '|L!{7R}eZ4< Tf_2(yvl>,mIAju|AF^xo-|B{YB|chN#[q.7&[[&e,!/UclUP8=[');
define('NONCE_SALT',       ']e8YWlC@]Nxw08+L8.L&(UV ,AB=(;]|Jah>81Pp&{x!,MU*Ukur~:2`H-.mrp1Q');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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

