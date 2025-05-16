<?php

use XCurrency\App\Stylesheet;

$selected_currency = x_currency_selected();
$template_json     = json_decode( get_post_meta( $template_id, 'template', true ), true );

/**
 * Start generating switcher style 
 */
$sheet = new Stylesheet();
$sheet->add_device( 'mobile', 400 );
$sheet->add_device( 'tablet', 620 );

$css_prefix = ".x-currency-sticky.switcher-{$template_id}";


$sheet->add_css(
    "
    {$css_prefix} {
        position: fixed;
        top: {$template_json['ct_wr_position_vertical']}%;
        {$template_json['ct_wr_position']} : {$template_json['ct_wr_position_horizontal']}px;
        transition: all .25s ease;
        z-index: 99999;
    }

    {$css_prefix}:hover {
        {$template_json['ct_wr_position']} : {$template_json['ct_wr_position_horizontal_hover']}px;
    }

    {$css_prefix} ul {
        display: grid;
        grid-gap: {$template_json['list_space']}px;
        font-size: {$template_json['list_font_size']}px;
        margin: 0;
        padding: 0;
    }

    {$css_prefix} li {
        display: flex; 
        align-items: center; 
        user-select: none;
        background-color: {$template_json['list_bg']};
        color: {$template_json['list_text_color']};
        cursor: pointer;
        transition: all linear .2s;
        position: relative;
        {$template_json['ct_wr_position']}: 0;
        justify-content: " . ( $template_json['ct_wr_position'] === 'left' ? 'right' : 'left' ) . "; 
        column-gap: {$template_json['list_el_space']}px;
        padding:" . Stylesheet::parse_dimension_value( $template_json['list_padding'] ) . ";
        " . Stylesheet::parse_border_value( $template_json['list_border'] ) . ";
    }

    {$css_prefix} li.active {
        background-color: {$template_json['list_bg_active']};
        color: {$template_json['list_text_color_active']};
		" . Stylesheet::parse_border_value( $template_json['list_border_active'] ) . ";
    }

    {$css_prefix} li:hover {
        background-color: {$template_json['list_bg_hover']};
        color: {$template_json['list_text_color_hover']};
        {$template_json['ct_wr_position']}: {$template_json['list_move_x_hover']}px;
		" . Stylesheet::parse_border_value( $template_json['list_border_hover'] ) . ";
    }

    {$css_prefix} img {
        display: inline-block;
        object-fit: cover;
        width: {$template_json['flag_width']}px;
        height: {$template_json['flag_height']}px;
		margin:" . Stylesheet::parse_dimension_value( $template_json['flag_margin'] ) . ";
		" . Stylesheet::parse_border_value( $template_json['flag_border'] ) . ";
    }
"
);

if ( $template_json['ct_show_code'] ) {
    $sheet->add_css(
        "
		{$css_prefix} .code {
            text-align: {$template_json['code_alignment']};
            width: {$template_json['code_width']}px;
            height: {$template_json['code_height']}px;
            line-height: {$template_json['code_height']}px;
            background-color: {$template_json['code_bg']};
            color: {$template_json['code_text_color']};
			" . Stylesheet::parse_border_value( $template_json['code_border'] ) . ";
            font-size: {$template_json['code_font_size']}px;
            transition: all linear .2s;
        }

        {$css_prefix} li.active .code {
            background-color: {$template_json['code_bg_active']};
            color: {$template_json['code_text_color_active']};
			" . Stylesheet::parse_border_value( $template_json['code_border_active'] ) . ";
        }

        {$css_prefix} li:hover .code {
            background-color: {$template_json['code_bg_hover']};
            color: {$template_json['code_text_color_hover']};
			" . Stylesheet::parse_border_value( $template_json['code_border_hover'] ) . ";
        }
    "
    );
}

if ( $template_json['ct_show_name'] ) {
    $sheet->add_css(
        "
		{$css_prefix} .name {
            text-align: {$template_json['name_alignment']};
            width: {$template_json['name_width']}px;
            text-transform: {$template_json['name_text_transform']};
            line-height: 1.3;
        }
    "
    );
}

// Responsive rules
$is_pro = function_exists( 'x_currency_pro' );

if ( $is_pro ) {
    $sheet->add_rule(
        "{$css_prefix} img",
        "
            width: {$template_json['_tablet_flag_width']}px;
            height: {$template_json['_tablet_flag_height']}px;
			" . Stylesheet::parse_border_value( $template_json['_tablet_flag_border'] ) . ";
        ",
        ['max' => 'tablet']
    );

    $sheet->add_rule(
        "{$css_prefix} ul",
        "
            grid-gap: {$template_json['_tablet_list_space']}px;
            font-size: {$template_json['_tablet_list_font_size']}px;
        ",
        ['max' => 'tablet']
    );

    $sheet->add_rule(
        "{$css_prefix}",
        "
            top: {$template_json['_tablet_ct_wr_position_vertical']}%;
            {$template_json['ct_wr_position']}: {$template_json['_tablet_ct_wr_position_horizontal']}px;
        ",
        ['max' => 'tablet']
    );

    $sheet->add_rule(
        "{$css_prefix}:hover",
        "
            {$template_json['ct_wr_position']}: {$template_json['_tablet_ct_wr_position_horizontal_hover']}px;
        ",
        ['max' => 'tablet']
    );

    $sheet->add_rule(
        "{$css_prefix} img",
        "
            width: {$template_json['_mobile_flag_width']}px;
            height: {$template_json['_mobile_flag_height']}px;
			" . Stylesheet::parse_border_value( $template_json['_mobile_flag_border'] ) . ";
        ",
        ['max' => 'mobile']
    );

    $sheet->add_rule(
        "{$css_prefix} ul",
        "
            grid-gap: {$template_json['_mobile_list_space']}px;
            font-size: {$template_json['_mobile_list_font_size']}px;
        ",
        ['max' => 'mobile']
    );

    $sheet->add_rule(
        "{$css_prefix}",
        "
            top: {$template_json['_mobile_ct_wr_position_vertical']}%;
            {$template_json['ct_wr_position']}: {$template_json['_mobile_ct_wr_position_horizontal']}px;
        ",
        ['max' => 'mobile']
    );

    $sheet->add_rule(
        "{$css_prefix}:hover",
        "
            {$template_json['ct_wr_position']}: {$template_json['_mobile_ct_wr_position_horizontal_hover']}px;
        ",
        ['max' => 'mobile']
    );
}

$show_hide = [
    'ct_show_flag'   => '.list-flag',
    'ct_show_symbol' => '.symbol',
    'ct_show_code'   => '.code',
    'ct_show_name'   => '.name',
];

foreach ( $show_hide as $attr => $selector ) {
    $sheet->add_rule(
        $css_prefix . ' ' . $selector,
        "
            display: " . ( $template_json[$attr] ? 'inline-block' : 'none' ) . ";
        "
    );

    if ( $is_pro ) {
        // Pro version
        $sheet->add_rule(
            $css_prefix . ' ' . $selector,
            "
                display: " . ( $template_json["_tablet_$attr"] ? 'inline-block' : 'none' ) . ";
            ",
            ['max' => 'tablet']
        );

        $sheet->add_rule(
            $css_prefix . ' ' . $selector,
            "
                display: " . ( $template_json["_mobile_$attr"] ? 'inline-block' : 'none' ) . ";
            ",
            ['max' => 'mobile']
        );
    }
}

$sheet->add_css( get_post_meta( $template_id, 'custom_css', true ) );
/**
 * End generating switcher style 
 */

if ( wp_is_block_theme() ) {
    $script_handler = "x-currency-switcher-{$template_id}";

    wp_register_style( $script_handler , false );
    wp_enqueue_style( $script_handler );

    global $x_currency_custom_inline_styles;
    $x_currency_custom_inline_styles[$script_handler] = $sheet->output();
} else {
    x_currency_render( "<style>{$sheet->output()}</style>" );
}

?>
<div class="x-currency x-currency-sticky switcher-<?php x_currency_render( $template_id )?>">
    <ul class="dropdown-ul">
        <?php foreach ( $currencies as $currency ) : ?>
            <li class="dropdown-li <?php $selected_currency->id === $currency->id ? x_currency_render( 'active' ) : ''?>" data-code="<?php x_currency_render( $currency->code )?>">
                <?php
                foreach ( $template_json['ct_sort_el'] as $element_id ) :
                    switch ( $element_id ) {
                        case 1:
                            x_currency_render( ' <img class="list-flag" ' . ( $template_json['ct_show_flag'] ? '' : 'style="display:none;"' ) . ' loading="lazy" src="' . $currency->flag_url . '" alt="' . $currency->name . '">' );
                            break;
                        case 2:
                            x_currency_render( '<span class="symbol" ' . ( $template_json['ct_show_symbol'] ? '' : 'style="display:none;"' ) . '>(' . $currency->symbol . ')</span>' );
                            break;
                        case 3:
                            x_currency_render( '<span class="code" ' . ( $template_json['ct_show_code'] ? '' : 'style="display:none;"' ) . '>' . $currency->code . '</span>' );
                            break;
                        case 4:
                            x_currency_render( '<span class="name" ' . ( $template_json['ct_show_name'] ? '' : 'style="display:none;"' ) . '>' . $currency->name . '</span>' );
                            break;
                    }
                    endforeach;
                ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>