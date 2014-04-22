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
define('AUTH_KEY',         '?nds-9PkLL5b*+)xCf5jK2`M^0Kn![2<Pkh*7T MnUe3Ok|>u8+PySIwzL f ^Y#');
define('SECURE_AUTH_KEY',  'c8I6|NcIxwQT)-3%a+f~y@AnB*CP0,3`vhyj{U>O|#>,9!kWJv&H&nQ|4FBa^Vm^');
define('LOGGED_IN_KEY',    '|0d5 TN%<wn|h);@vpQ<ry7-U9qg{_@atOw!lcIg867ElIMcVWyh?p~/-zWm&obG');
define('NONCE_KEY',        'Wf?$pE*82A,RLbFz~|hIrjt7f5+?-[NS{hhrT7,&w_]C_lYb;@xjZU+DGsopC@dR');
define('AUTH_SALT',        '&4SSl|$[ViLG{UMxw[#c]|b-}w]x]1+3<uVN!Ew6]`.o!>Ug7<(s4Y/t>_8bXCpn');
define('SECURE_AUTH_SALT', 'VQ1k4kFDc-O71~(ZF5A HD-((7uDN:<?E1{]fU6z.-#v%#-]+ztMB<XTVopKf!i1');
define('LOGGED_IN_SALT',   'WIstSBY%K$gZ-aSYmi~>HU0NFRelp/5YI<PC%O,HH abe|dz)*tm.)#R-VD-2rWt');
define('NONCE_SALT',       'n`/;q+z lYP.%qq=i;p`|-H73[VB.|PR*uHT*ox;rq4c7=|hzav&cpUC^4-aC{$K');

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
