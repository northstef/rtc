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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '8/V+o1ShVhv0xSZIkYd9DGo1MYi2dZUuoKuCcktc+/sz4TfNsM0kcJKoTeRi7A3foOIeWhh83eFD+y9LdZINJg==');
define('SECURE_AUTH_KEY',  'tbFnUSMgligFmpi9mX3X3HQOMoFHDQsuUO/XvpdtuNRTpSXov1dKOUFk5Wte7L604EVG0JPjVDgmfSvE6HPcLQ==');
define('LOGGED_IN_KEY',    '/8QvHs83xQNWTt3fMlvkzoYvKzrxHFY9Cbi90gOkl+kXQi6VH4RScxLP4z0bVI5tYOQ9o9Cng9RWlyLjzqHF9A==');
define('NONCE_KEY',        '86AsPTF0mn6VHCM8TaCDDo11f4UlW2YfnPXQR5M1ck4kUtOvJCOhi8cwDxDBSzRQGCqjiL6m0fAyWk+I9pSpcw==');
define('AUTH_SALT',        'am9hRu9uaNW65U3SKt+jBRIhA9WHRy6TE/NNAxcFu7r5gycPw8Ke01Obxw9mAUbh8WPMGiT4bTV3gRL3Lg9hyQ==');
define('SECURE_AUTH_SALT', 'vyczdc6YWMPo0H8gDl5drFDxsL54gIDWbubYsqGG42dQ3q39tG2zhZYs1H6eeN957doACmID5tQafUAfjzTC/g==');
define('LOGGED_IN_SALT',   'Rx2i0GZWNtlYfOiTklftfUqJvqJpY1HVZ32qAo3ud1fWDpxtMMsEblBCIsnvlEyZxikKnGZeK2jOeJy1FGkWBQ==');
define('NONCE_SALT',       'CflPNYTGRzsOhcR5T7vFRfb6esYR4Yew7To/wCp+Cw+95VBOYHU1TUOF7oNWcxxn8vGAWMyOosBt8WjG0043KQ==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_pmumguxfgy_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
