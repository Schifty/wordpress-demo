<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
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
define('AUTH_KEY',         'C-UJL@DqjKqkg2B)b9R!Nb[P+gQ|)l1e<dbHzu}Nqk_-e#t%6uTUS BI6=5@mI=`');
define('SECURE_AUTH_KEY',  ';$k+jIJ(Zspy0+vM$o8zv`jymF_13+X/}Jyr;E%(,3p0;}[bDZaui}|T`b8s@1wb');
define('LOGGED_IN_KEY',    '0+bjnE$G%!ye%oobKX<xuY_+vEvQ+c@,+/X[0ACf7UzM r-GDyi/ze+M|EFn.-?7');
define('NONCE_KEY',        'a66;i,oU.Sjcv_nAZ{Ri=x+Df?i7bNY8<^nx:xctV9,9-<2r9chnVB7ne;8D.U1g');
define('AUTH_SALT',        'YM[}/-C9F17z1it)|+r(Do%>w- Ys:KIF6:+5+w-b.$<}9{Ry!)Sw:N`jtBIo1kF');
define('SECURE_AUTH_SALT', 'Mjy,^wq$ZrNcij6=pi|WACU 8mJa_zts4Bt0s#z$eC+k@X*$K--T;Dlq cz3>Oy(');
define('LOGGED_IN_SALT',   '0yanX&^FvM_es~#>^1Wfq]pbb3/E~l6i~?FlA=+3~;,Y;>h~@N/?ul,JZjW[hY1=');
define('NONCE_SALT',       'v8VMFx~FQ|~ztENp($S,hafX<B2L,_>I<L&-G|:c<iKNgN&kM:,KH^|w{H;`hsQt');

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
