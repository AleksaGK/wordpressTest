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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'master' );

/** Database username */
define( 'DB_USER', 'Tronovicka' );

/** Database password */
define( 'DB_PASSWORD', 'mynameissadaf' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'pRK^4@1Ha;+fwZ86K.s7|QF(r0~XDZH2tZhJYdQ6K2ypklm$+cigx-oHH1f-5-x4' );
define( 'SECURE_AUTH_KEY',  'm_SyyPvRAuB?JF7.)qb]0$*B{JbDjMZ|lJLz,sUOWl^t*UUhJ{ZPlFh:Al?+i5G ' );
define( 'LOGGED_IN_KEY',    'OKj%cBJ2,F!Q}rCNVT+JD:cIkuwV,?K%Jqt8`*ic7{q?H6pUxg22iCA&3wkwvN<a' );
define( 'NONCE_KEY',        '%1kxPo0>@Kq<TmQ{_1t`yRESNX?ARuQdvBWgm?[A3RVY4ciac% dmS~<wDZ~$qYC' );
define( 'AUTH_SALT',        'al.-XQG&$=:wMg{vUzVX%A7j53e}$1+r0jR)3nEFz$(V}Qm0^Pd-TG?J~Y}cl[|}' );
define( 'SECURE_AUTH_SALT', 'W1(w=YS-u/1a+`o=`lE=f8^{%6YC/y{L`y@zD1Fd)n=E!9nb$`>;mUqR/6NhXE$1' );
define( 'LOGGED_IN_SALT',   '@FXwhRKx* p^i]#lK<,a^>A,PR~r#WM5V+R)2B%A}BI1Moz4pc0Ob:aP&,3izf&_' );
define( 'NONCE_SALT',       'QE@gg.[SiEpBD4vD[=ERMUVTc(`uQ)jf&xzd);hjL%$6h{_Xx2tioXu{ c?t ?;J' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
