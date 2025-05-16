<?php

namespace XCurrency\App\Providers;

use XCurrency\WpMVC\Contracts\Provider;
use XCurrency\WpMVC\View\View;

class ShortCodeServiceProvider implements Provider {
    public function boot() {
        add_shortcode( 'x-currency-switcher', [$this, 'view'] );
    }

    /**
     * @param $attr
     */
    public function view( $attr ) {
        if ( isset( $attr['id'] ) ) {
            return self::render( intval( $attr['id'] ) );
        }
    }

    public static function render( $template_id ) {
        return View::get( 'switcher', compact( 'template_id' ) );
    }
}