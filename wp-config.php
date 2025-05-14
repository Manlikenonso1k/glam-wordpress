<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'keetech_db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '&X-MVF!FzC^$r4voBnerY3{NY3|ct]KOaqBGa-VwY)X{_%T&TlXrA_OO!FAEY~%O' );
define( 'SECURE_AUTH_KEY',  'Btzm3R_.U({LM;S17n5aLW4)eT(`~:4y@QYN@$P%0l:St{_U,@vscZ%T]fK(>`EB' );
define( 'LOGGED_IN_KEY',    'Mw[_de`}-]y=lCw)h(Ro`@:)9<NDg72]t4*97f)X0y,zb/wDU ~q4y;]V5B;bsni' );
define( 'NONCE_KEY',        '+6`Io$+cm4kOKcGzvy1OS}KihD0/QFWw=,N%iUJcw~cFXC6[>|lZ~WN7-JLzS 4Q' );
define( 'AUTH_SALT',        '#cKp:R|h]Ho4y1x:5 )Bp}X|~$r`Dj_>J#}xM)@jXg0/91+#PtRGsF [Aa|5,9Nm' );
define( 'SECURE_AUTH_SALT', '_8xqhw|=4ygkbuHDIg5Hx;~x$xl]gGl{?OW?i=SZ>WuU1SUwKBNXKqjm2IkT:8F^' );
define( 'LOGGED_IN_SALT',   '|]%y/Ob.la:VMP|>!3sv1Jx@Mci1y)o7PQpnvj(|tF2:^^`/i@F< xVtE0b-#Y`x' );
define( 'NONCE_SALT',       '[3=w7-%hyWM*b:z%$mp3^Ar.ovh-[iTA9YaZv8.;gMyGo~-2Z7Cd.Iro2}D n7YW' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */
define('FS_METHOD', 'direct');



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';