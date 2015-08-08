<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpressdemo');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'z#aFp%pAz(SJe6>qE(|]bK?my,4uinrCc7fnS~~KCP6a_y2nvrQ*)Y#;0)7Dm3re');
define('SECURE_AUTH_KEY',  '55s$#te|EAn*DI6[/-I-kArOKFY7-w{UGM%i-p@{-*-YNLO#Jnw3_1=ax}3X;Dv#');
define('LOGGED_IN_KEY',    '~$Iygy2bT}U5i--&2V(N>k7dUjCypUq7m#QC+W}}NjBZE}TL2z,{jQ&G)2 _n:<`');
define('NONCE_KEY',        'Z)K*LT$^_LQj<MA(1a.FN7X?VA@ZZ=}V`5{3[Wtb[H+HMIGhc=Cc*BVX~Tei^N*=');
define('AUTH_SALT',        'X`|`hy>R4(x8kOiL`;|F;nhPkpSz#r,c}gG_/2H(ke1A5LPJ{HOo$NJH|K]PNvjY');
define('SECURE_AUTH_SALT', 'Afnjk=VZ4k16zq!ZnBuQ |{[3Gl{_oyJ6b40<r]pZUZBian-_:MFHIvngsYZ^UjZ');
define('LOGGED_IN_SALT',   '?3Ku49bkfiwWxb~XUOO<Tin$bwx!=6wXb`+U;,~TM6pkvb}MR)gew~|THsf&. 0p');
define('NONCE_SALT',       '6@3cUPhJN-I|n!%pLzi8<d7ZmUY?F_22J5W+nb&|jI/hT~Q:DLxsOh-UtMou#ye^');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'demowp_';

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
