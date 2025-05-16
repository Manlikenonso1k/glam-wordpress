<?php

defined( 'ABSPATH' ) || exit;

use XCurrency\WpMVC\Enqueue\Enqueue;

global $x_currency_custom_inline_styles;

if ( ! empty( $x_currency_custom_inline_styles ) && is_array( $x_currency_custom_inline_styles ) ) {
    foreach ( $x_currency_custom_inline_styles as $handle => $style ) {
        wp_add_inline_style( $handle, $style );
    }
}

Enqueue::script( 'x-currency-shortcode', 'js/x-currency' );
Enqueue::style( 'x-currency-shortcode', 'css/shortcode' );