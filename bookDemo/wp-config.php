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
define( 'DB_NAME', 'bookDemo' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'i(49ynd7>_dj:{]w-!Q !h..pYk)+,BRvo0M7.CE[`UNlV+7;AP^_k0S}W2>t_L(' );
define( 'SECURE_AUTH_KEY',  '71_)P+5J.rT>7DI|gTCNPK:X!jap$|J$:6ul?r&MNW-PYxC qzAA(OR70:GCeKrz' );
define( 'LOGGED_IN_KEY',    'r+SLDr(eh`]nY<>;|VmR)-?z_DFsw:fqFE}*qGQMrwse!MYzH{^`k_l%(ratB?Ga' );
define( 'NONCE_KEY',        'lh>t%EZ4NGo3BWeIw,m q>d7EWg7wdlOc%2>S(M|si1Vw56U4U{9$YZ ,ZHjX`J7' );
define( 'AUTH_SALT',        'aIl$Z]enC`(!NpQ.6bZ;CaT+(HW|4(-a.9A/s*Gqz3[/6nfN%0?a3aqY4%7CB-ry' );
define( 'SECURE_AUTH_SALT', 'pO^<D^h-tG.%:+q%I{HHEHGmgijc&f ~Y!vcJA7hEodV.LBItj$Y[*GFXX]f06Lr' );
define( 'LOGGED_IN_SALT',   '}WEeiBJ1D;>HA&G)]fWzG%2o$K8i(%S:^nR(`>s BO)jfs`<eGA A/Zht!@NF#oZ' );
define( 'NONCE_SALT',       'X3a<5$(iGA:bA:DNH,o@rf,ST@lM(XM[D4Qhr7&_LZY;6J8:_M&j3Jhz;,.(u}#=' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
