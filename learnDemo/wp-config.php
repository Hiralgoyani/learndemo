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
define( 'DB_NAME', 'learnDemo' );

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
define( 'AUTH_KEY',         'YY[{_sHon2g[nt:|^f0y`EendU4Sjp!hH)Q)V+#FGx;Yg^w]5|`2]wa/Y:<t&IkZ' );
define( 'SECURE_AUTH_KEY',  'YhnT,?i_C0pbXUVI=~267oge6?6V,T<V/u~}o[F4`3tb*AUs`}jKP{QwL19aXn j' );
define( 'LOGGED_IN_KEY',    'zy;[5wh1&I[iX>31<viS*WWZJ:.ieewW;O}$s{3!@MLLdQ{fpy]<ikGy_oj+XRna' );
define( 'NONCE_KEY',        '2fUTAxj$h^2gq}lgmq0.{TQ[[Ho:z,H:Lr1LT-~-)n,PYEfu<Sd.jYh;k)H04tN9' );
define( 'AUTH_SALT',        '.Hz_Y/pg^0:&az{(nv7<Z5.m&~gV+ZqnnzAH/^`` tKf8hv*m!Ev<_VrirE?w/fb' );
define( 'SECURE_AUTH_SALT', '4V_9dA7f),BH5GI]7[$Ir@wwh.x_%/h6z=lp(U9joLa_?RxID#Bm_*C=scfiG}+.' );
define( 'LOGGED_IN_SALT',   '3.)d!|NXj96%:}XCw2K3V^DMJ.bz8X.e1ciGOvh4c@Kcx(37ch4;g^!5k&OZlCT0' );
define( 'NONCE_SALT',       ')GzY*.}2T7Ar$se-T-[!G; W!*g(08;W3bHr[$kmD1Juq&;Cy>H]FSx7UlzT(VN1' );

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
