<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'wordpress' );

/** Database password */
define( 'DB_PASSWORD', 'wordpress' );

/** Database hostname */
define( 'DB_HOST', 'database' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'd+pak GL1:=qD_7 L##t}igy#z`iUViL>(>)vcXI0[EwH MD:e{7x88^tuyr?Wdi' );
define( 'SECURE_AUTH_KEY',  '|P0j8&,4[fdjy~!6Jb^4(bgQoZG_p>BVQXF;V4u%T!m<nn]GLrCTO6D`h#`%V2!b' );
define( 'LOGGED_IN_KEY',    'V-x~r z$KI{#2!L$m3)_E[kJ#hUN-+zT6).j-i:4Gh~dxpEwJ2*3.C-/O%/I-T)O' );
define( 'NONCE_KEY',        'P3_jh(WdPF`ven;qa1Xu7Vfh1P*/,p%5q[)>S[0|9Yn&|[%vyq0THFxv~~x&+;*B' );
define( 'AUTH_SALT',        '$`T[W4cxQOCkv~3l)G#1kC+17BgPu{0%$$y|f01^u:v@JbtR6H]|ybeq|?]7lE@>' );
define( 'SECURE_AUTH_SALT', 'nBW3_bj+.?qE1`ZL!en?C- 5]?{i@Yi<S;JGxw]J^yBN0vB:r:Iif6nn[Z<#Cq@ ' );
define( 'LOGGED_IN_SALT',   '8tGbgQdv>L=`+.aZ#9O5lbE 6[<VBea+` ci=vtZU`*; bNi*JqcL~*t^8EH;}H)' );
define( 'NONCE_SALT',       'p}r |w@!: jkrWj5fyu=U/lOSUDF@>uu:1q?d4FcKugfF)PJsZx7KpBEt1}yxIEm' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'dcs_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
