<?php

// Porto Tooltip
add_shortcode('porto_tooltip', 'porto_shortcode_tooltip');
add_action('vc_after_init', 'porto_load_tooltip_shortcode');

function porto_shortcode_tooltip($atts, $content = null) {
    ob_start();
    if ($template = porto_shortcode_template('porto_tooltip'))
        include $template;
    return ob_get_clean();
}

function porto_load_tooltip_shortcode() {
    $animation_type = porto_vc_animation_type();
    $animation_duration = porto_vc_animation_duration();
    $animation_delay = porto_vc_animation_delay();
    $custom_class = porto_vc_custom_class();

    vc_map( array(
        'name' => "Porto " . __('Tooltip', 'porto-shortcodes'),
        'base' => 'porto_tooltip',
        'category' => __('Porto', 'porto-shortcodes'),
        'icon' => 'porto_vc_tooltip',
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => __('Prefix', 'porto-shortcodes'),
                'param_name' => 'prefix'
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Text', 'porto-shortcodes'),
                'param_name' => 'text',
                'admin_label' => true,
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Suffix', 'porto-shortcodes'),
                'param_name' => 'suffix'
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Display Type', 'porto-shortcodes' ),
                'param_name' => 'display',
                'value' => array(
                    __( 'Inline', 'porto-shortcodes' )=> '',
                    __( 'Block', 'porto-shortcodes' )=> 'block'
                )
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Text Type', 'porto-shortcodes' ),
                'param_name' => 'type',
                'value' => array(
                    __( 'Link', 'porto-shortcodes' )=> '',
                    __( 'Button Link', 'porto-shortcodes' )=> 'btn-link',
                    __( 'Button', 'porto-shortcodes' )=> 'btn'
                )
            ),
            array(
                "type" => "textfield",
                "heading" => __("Link", 'porto-shortcodes'),
                "param_name" => "link",
                'dependency' => array('element' => 'type', 'value' => array('', 'btn-link'))
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Button Size', 'porto-shortcodes' ),
                'param_name' => 'btn_size',
                'value' => porto_sh_commons('size'),
                'dependency' => array('element' => 'type', 'value' => array('btn', 'btn-link'))
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Button Skin Color', 'porto-shortcodes' ),
                'param_name' => 'btn_skin',
                'value' => porto_sh_commons('colors'),
                'dependency' => array('element' => 'type', 'value' => array('btn', 'btn-link'))
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Button Contextual Class', 'porto-shortcodes' ),
                'param_name' => 'btn_context',
                'value' => porto_sh_commons('contextual'),
                'dependency' => array('element' => 'type', 'value' => array('btn', 'btn-link'))
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Tooltip Text', 'porto-shortcodes'),
                'param_name' => 'tooltip_text',
                'admin_label' => true,
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Tooltip Position', 'porto-shortcodes' ),
                'param_name' => 'tooltip_position',
                'value' => porto_sh_commons('position')
            ),
            $custom_class,
            $animation_type,
            $animation_duration,
            $animation_delay
        )
    ) );

    if (!class_exists('WPBakeryShortCode_Porto_Tooltip')) {
        class WPBakeryShortCode_Porto_Tooltip extends WPBakeryShortCode {
        }
    }
}