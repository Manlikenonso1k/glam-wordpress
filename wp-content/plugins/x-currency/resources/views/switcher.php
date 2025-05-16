<?php

defined( 'ABSPATH' ) || exit;

use XCurrency\App\Repositories\CurrencyRepository;
use XCurrency\App\Stylesheet;

$query = new \WP_Query(
    [
        'p'           => $template_id,
        'post_type'   => x_currency_config()->get( 'app.switcher_post_type' ),
        'post_status' => 'publish'
    ] 
);

/**
 * Return empty if switcher is not exists.
 */
if ( empty( $query->post ) ) {
    return;
}

$selected_currency = x_currency_selected();

/**
 * @var CurrencyRepository $currency_repository
 */
$currency_repository = x_currency_singleton( CurrencyRepository::class );

$template_json = json_decode( get_post_meta( $template_id, 'template', true ), true );

/**
 * Start generating switcher style 
 */
$sheet = new Stylesheet();

$currency_wrap_width = ! empty( $template_json['st_currency_list_full_width'] ) ? '100%' : $template_json['st_currency_list_wrap_width'] . 'px';
$switcher_full_width = ! empty( $template_json['switcher_full_width'] ) ? '100%' : $template_json['switcher_width'] . 'px';

$css_prefix = ".x-currency-shortcode.switcher-{$template_id}";
$sheet->add_css(
    "
{$css_prefix} {
    z-index: 9999;
}

{$css_prefix} .currency-wrap {
	width: {$currency_wrap_width};
	max-height: " . $template_json['st_currency_list_wrap_width'] . "px;
}

{$css_prefix} .switch {
	width: " . $switcher_full_width . ";
	color: " . $template_json['switcher_text_color'] . ";
	padding: " . Stylesheet::parse_dimension_value( $template_json['switcher_padding'] ) . ";
	margin: " . Stylesheet::parse_dimension_value( $template_json['switcher_margin'] ) . ";
	font-size: " . $template_json['switcher_font_size'] . "px;
	border-radius: " . $template_json['switcher_border_radius'] . "px;
	border: 1px solid " . $template_json['switcher_border_color'] . ";
	background-color: " . $template_json['switcher_bg_color'] . ";
}

{$css_prefix} .switch .switch-elements {
	column-gap: " . $template_json['switcher_item_gap'] . "px;
	justify-content: " . $template_json['button_alignment'] . ";
}

{$css_prefix}.xc-open .switch {
	box-shadow: {$template_json['switcher_shadow_active']['x']}px {$template_json['switcher_shadow_active']['y']}px {$template_json['switcher_shadow_active']['spread']}px {$template_json['switcher_shadow_active']['color']};
	color: {$template_json['switcher_text_color_hover']};
	border-color: {$template_json['switcher_border_color_hover']};
	background-color: {$template_json['switcher_bg_color_hover']};
}

{$css_prefix} .dropdown-li > div {
	column-gap: " . $template_json['st_currency_list_horizontal_gap'] . "px;
}

{$css_prefix} .dropdown-ul {
	grid-gap: " . $template_json['st_currency_list_item_gap'] . "px;
}

{$css_prefix} .dropdown-li {
	padding: " . Stylesheet::parse_dimension_value( $template_json['st_currency_list_item_padding'] ) . ";
	color: " . $template_json['st_currency_list_item_text_color'] . ";
	justify-content: " . $template_json['ct_dropdown_alignment'] . ";
}

{$css_prefix} .dropdown-li  > * {
	font-size: " . $template_json['st_currency_list_item_font_size'] . "px;
}

{$css_prefix} .dropdown-li.active, {$css_prefix} .dropdown-li:hover {
	background:" . $template_json['st_currency_list_item_bg_hover_color'] . ";
	color: " . $template_json['st_currency_list_item_text_hover_color'] . ";
}

{$css_prefix} .dropdown-flag {
	height: " . $template_json['flag_height'] . "px;
	width: " . $template_json['flag_width'] . "px;
	margin: " . Stylesheet::parse_dimension_value( $template_json['flag_margin'] ) . ";
}

{$css_prefix} .currency-wrap {
	border: 1px solid " . $template_json['st_currency_list_wrap_border_color'] . ";
	padding: " . Stylesheet::parse_dimension_value( $template_json['st_currency_list_wrap_padding'] ) . ";
	border-radius: " . Stylesheet::parse_dimension_value( $template_json['st_currency_list_wrap_radius'] ) . ";
	background-color:  " . $template_json['st_currency_list_wrap_bg_color'] . ";
	left: " . $template_json['st_currency_list_wrap_hr_position'] . "px;
}

{$css_prefix}.open-bottom .currency-wrap{
	top: " . $template_json['st_currency_list_wrap_gap_from_button'] . "px;
}

{$css_prefix}.open-top .currency-wrap {
	bottom: " . $template_json['st_currency_list_wrap_gap_from_button'] . "px;
}
"
);

/**
 * Dropdown arrow style
 */
if ( $template_json['ct_dropdown_show_arrow'] ) {
    $sheet->add_css(
        "
	{$css_prefix}.xc-open .dropdown-arrow {
		display: inline-block;
	}

	{$css_prefix} .dropdown-arrow {
		width: {$template_json['drop_arrow_size']}px;
		height: {$template_json['drop_arrow_size']}px;
		background: {$template_json['drop_arrow_color']};
		transform: rotate(45deg);
		left: {$template_json['drop_arrow_horizontial']}px;
	}

	{$css_prefix}.open-bottom .dropdown-arrow {
		top: {$template_json['drop_arrow_vertical']}px;
	}

	{$css_prefix}.open-top .dropdown-arrow {
		bottom: {$template_json['drop_arrow_vertical']}px;
	}"
    );
}

if ( 'Default' === $template_json['content_switcher_style'] ) {
    $sheet->add_rule( "{$css_prefix} .dropdown-li.active", "border-left: 2px solid {$template_json['switcher_bg_color_hover']};" );
} elseif ( 'RadioDropdown' === $template_json['content_switcher_style'] ) { 
    $sheet->add_css(
        "
	{$css_prefix} .dropdown-li .radio {
        --size: {$template_json['st_currency_list_item_font_size']}px;
        --color: {$template_json['st_currency_list_wrap_border_color']};
        min-width: var(--size);
        min-height: var(--size);
        width: var(--size);
        height: var(--size);
        display: inline-block;
        border-radius: 50%;
        border: 1px solid var(--color);
        margin-right: {$template_json['st_currency_list_horizontal_gap']}px;
        position: relative;
    }

    {$css_prefix} .dropdown-li .radio::before {
        width: 70%;
        height: 70%;
        border-radius: 50%;
        display: inline-block;
        content: '';
        background-color: var(--color);
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    {$css_prefix} .dropdown-li.active .radio {
        --color: {$template_json['switcher_bg_color_hover']};
    }"
    );
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
<div class="x-currency x-currency-shortcode switcher-<?php x_currency_render( $template_id )?> open-bottom">
    <button class="switch">
        <div class="switch-elements">
            <?php
            foreach ( $template_json['button_sort_el'] as $element_id ) :
                switch ( $element_id ) {
                    case 1:
                        x_currency_render( ' <img class="dropdown-flag" ' . ( $template_json['button_show_flag'] ? '' : 'style="display:none;"' ) . ' loading="lazy" src="' . $selected_currency->flag_url . '" alt="' . $selected_currency->name . '">' );
                        break;
                    case 2:
                        x_currency_render( '<span class="symbol" ' . ( $template_json['button_show_symbol'] ? '' : 'style="display:none;"' ) . '>(' . $selected_currency->symbol . ')</span>' );
                        break;
                    case 3:
                        x_currency_render( '<span class="code" ' . ( $template_json['button_show_code'] ? '' : 'style="display:none;"' ) . '>' . $selected_currency->code . '</span>' );
                        break;
                    case 4:
                        x_currency_render( '<span class="name" ' . ( $template_json['button_show_name'] ? '' : 'style="display:none;"' ) . '>' . $selected_currency->name . '</span>' );
                        break;
                }
            endforeach;
            ?>
        </div>
        <?php if ( $template_json['button_show_arrow'] ) :?>
        <div class="arrow-element">
            <svg width="15" height="15" x="0" y="0" viewBox="0 0 36.678 36.678">
                <path fill="currentColor" d="M29.696 20.076c.088.16.08.354-.021.51l-10.28 15.863a.502.502 0 01-.407.229h-.015a.5.5 0 01-.403-.205L6.998 20.609a.5.5 0 01.403-.793h21.855a.49.49 0 01.44.26zM7.401 16.865h21.876a.501.501 0 00.316-.888L18.086.205A.534.534 0 0017.668 0a.502.502 0 00-.406.229L6.982 16.094a.507.507 0 00-.021.512.505.505 0 00.44.259z"></path>
            </svg>
        </div>
        <?php endif; ?>
    </button>
    <?php if ( $template_json['button_show_arrow'] ) :?>
        <span class="dropdown-arrow"></span>
    <?php endif; ?>
    <div class="currency-wrap">
        <ul class="dropdown-ul">
            <?php foreach ( $currency_repository->get_geo() as $currency ) : ?>
            <li data-code="<?php x_currency_render( $currency->code )?>" class="dropdown-li <?php $selected_currency->id === $currency->id ? x_currency_render( 'active' ) : ''?>">
                
                <?php
                if ( 'RadioDropdown' === $template_json['content_switcher_style'] ) {
                    x_currency_render( '<span class="radio"></span>' );
                }
                ?>
                <div>
                    <?php
                    foreach ( $template_json['ct_dropdown_sort_el'] as $element_id ) :
                        switch ( $element_id ) {
                            case 1:
                                x_currency_render( ' <img class="dropdown-flag" ' . ( $template_json['ct_dropdown_show_flag'] ? '' : 'style="display:none;"' ) . ' loading="lazy" src="' . $currency->flag_url . '" alt="' . $currency->name . '">' );
                                break;
                            case 2:
                                x_currency_render( '<span class="symbol" ' . ( $template_json['ct_dropdown_show_symbol'] ? '' : 'style="display:none;"' ) . '>(' . $currency->symbol . ')</span>' );
                                break;
                            case 3:
                                x_currency_render( '<span class="code" ' . ( $template_json['ct_dropdown_show_code'] ? '' : 'style="display:none;"' ) . '>' . $currency->code . '</span>' );
                                break;
                            case 4:
                                x_currency_render( '<span class="name" ' . ( $template_json['ct_dropdown_show_name'] ? '' : 'style="display:none;"' ) . '>' . $currency->name . '</span>' );
                                break;
                        }
                    endforeach;
                    ?>
                </div>
            </li>
            <?php endforeach;?>
        </ul>
    </div>
</div>
