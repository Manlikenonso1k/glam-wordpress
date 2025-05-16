<?php

namespace XCurrency\App;

defined( 'ABSPATH' ) || exit;

class Stylesheet {
    private $devices = [];

    private $rules = [];

    private $responsive_rules = [];

    private $css_text = '';

    public function add_device( $name, $max_width ) {
        $this->devices[$name] = $max_width;
    }

    public function add_css( $css_text ) {
        $this->css_text .= $css_text;
    }

    public function add_rule( $selector, $rule, $options = null ) {
        if ( $options ) {
            $this->responsive_rules[] = ['selector' => $selector, 'rule' => $rule, 'options' => $options];
        } else {
            $this->rules[] = ['selector' => $selector, 'rule' => $rule];
        }
    }

    public static function parse_dimension_value( array $values ) {
        return "{$values['top']} {$values['right']} {$values['bottom']} {$values['left']}";
    }

    public static function parse_border_value( array $values ) {
        return "
            border-color: {$values['color']};
            border-style: {$values['style']};
            border-width: " . static::parse_dimension_value( $values['width'] ) . ";
            border-radius: " . static::parse_dimension_value( $values['radius'] ) . ";
        ";
    }
    
    public function clear() {
        $this->devices          = [];
        $this->rules            = [];
        $this->responsive_rules = [];
        $this->css_text         = '';
    }

    public function output() {
        $css = $this->css_text;
        foreach ( $this->rules as $rule ) {
            $css .= "{$rule['selector']} { {$rule['rule']} }";
        }
        foreach ( $this->responsive_rules as $rule ) {
            $media_query = '@media ';
            if ( isset( $rule['options']['min'] ) ) {
                $media_query .= "(min-width: {$this->devices[$rule['options']['min']]}px)";
            }
            if ( isset( $rule['options']['max'] ) ) {
                $media_query .= "(max-width: {$this->devices[$rule['options']['max']]}px)";
            }
            $css .= "$media_query { {$rule['selector']} { {$rule['rule']} } }";
        }
        return $css;
    }
}
