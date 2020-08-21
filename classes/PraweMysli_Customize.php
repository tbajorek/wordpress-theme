<?php

class PraweMysli_Customize
{
    /**
     * Register customizer options.
     *
     * @param WP_Customize_Manager $wp_customize Theme Customizer object.
     */
    public static function register($wp_customize): void {
        $wp_customize->add_section(
            'sharing',
            array(
                'title'      => __('Sharing Options', 'prawe-mysli'),
                'priority'   => 40,
                'capability' => 'edit_theme_options',
            )
        );

        $wp_customize->add_setting(
            'facebook_url',
            [
                'capability' => 'edit_theme_options',
                'default' => 'https://www.facebook.com/sharer/sharer.php?u='
            ]
        );
        $wp_customize->add_control(
            'facebook_url',
            [
                'type'     => 'text',
                'section'  => 'sharing',
                'priority' => 10,
                'label'    => __('Url to share on Facebook:', 'prawe-mysli')
            ]
        );

        $wp_customize->add_setting(
            'twitter_url',
            [
                'capability' => 'edit_theme_options',
                'default' => 'https://twitter.com/intent/tweet?url='
            ]
        );
        $wp_customize->add_control(
            'twitter_url',
            [
                'type'     => 'text',
                'section'  => 'sharing',
                'priority' => 10,
                'label'    => __('Url to share on Twitter:', 'prawe-mysli')
            ]
        );

        $wp_customize->add_setting(
            'wykop_url',
            [
                'capability' => 'edit_theme_options',
                'default' => 'https://www.wykop.pl/remotelink/?url='
            ]
        );
        $wp_customize->add_control(
            'wykop_url',
            [
                'type'     => 'text',
                'section'  => 'sharing',
                'priority' => 10,
                'label'    => __('Url to share on Wykop:', 'prawe-mysli')
            ]
        );
        // front page is defined statically in template
        $wp_customize->remove_section('static_front_page');
    }
}

add_action('customize_register', ['PraweMysli_Customize', 'register']);