<?php
defined('ABSPATH') || exit;

if (PHP_VERSION_ID < 50300) {
    return;
}

class Facebook_Profile_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            false,
            __('Facebook profile', 'prawe-mysli'),
            ['description' => __('Latest posts from Facebook profile', 'prawe-mysli')]
        );
    }

    public function widget($args, $config) {
        echo $args['before_widget'];

        if (!is_array($config)) {
            $config = [];
        }
        // Filters are used for WPML
        if (!empty($config['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $config['title'], $config) . $args['after_title'];
        }

        $block = '';
        if ($config['fb_profile']) {
            $block .= '<div class="fb-page-wrapper">';
            $block .= '<div class="fb-page" data-href="https://www.facebook.com/' .
                esc_attr($config['fb_profile'])  .
                '" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="true">';

            $block .= '<blockquote cite="https://www.facebook.com/' .
                esc_attr($config['fb_profile'])  .
                '" class="fb-xfbml-parse-ignore">';
            $block .= '<a href="https://www.facebook.com/' . esc_attr($config['fb_profile']) . '">' . __('Show in Facebook', 'prawe-mysli') . '</a>';
            $block .= '</blockquote></div></div>';
        }

        echo $block;

        echo $args['after_widget'];
    }

    public function update($new_instance, $old_instance) {
        return $new_instance;
    }

    public function form($config) {
        if (!is_array($config)) {
            $config = [];
        }
        $config = array_merge(
            [
                'title' => '',
                'fb_profile' => ''
            ],
            $config
        );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                <?php echo __('Title:', 'prawe-mysli') ?>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($config['title']); ?>">
            </label>

            <label for="<?php echo $this->get_field_id('fb_profile'); ?>">
                <?php echo __('FB profile name:', 'prawe-mysli') ?>
                <input class="widefat" id="<?php echo $this->get_field_id('fb_profile'); ?>" name="<?php echo $this->get_field_name('fb_profile'); ?>" type="text" value="<?php echo esc_attr($config['fb_profile']); ?>">
                <?php echo __('Use from https://www.facebook.com/FB_PROFILE_NAME', 'prawe-mysli') ?>
            </label>
        </p>
        <?php
    }
}

add_action('widgets_init', static function() {
    return register_widget("Facebook_Profile_Widget");
});
