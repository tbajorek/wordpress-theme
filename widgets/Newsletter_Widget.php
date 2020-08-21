<?php
defined('ABSPATH') || exit;

if (PHP_VERSION_ID < 50300) {
    return;
}

if (!class_exists(Newsletter::class)) {
    return;
}

class Newsletter_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            false,
            __('Themed Newsletter', 'prawe-mysli'),
            ['description' => __('Personalized widget to add a subscription form', 'prawe-mysli')]
        );
    }

    public function widget($args, $config) {
        $newsletter = Newsletter::instance();
        $current_language = $newsletter->get_current_language();

        echo $args['before_widget'];

        if (!is_array($config)) {
            $config = [];
        }
        // Filters are used for WPML
        if (!empty($config['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $config['title'], $config) . $args['after_title'];
        }

        $options_profile = NewsletterSubscription::instance()->get_options('profile', $current_language);

        if (empty($config['button'])) {
            $config['button'] = $options_profile['subscribe'];
        }

        $form = '<p>' .
            __('If you want to receive emails with new posts from here, please add your email address using this form', 'prawe-mysli') .
            '</p>';

        $form .= '<form class="inline-form" action="' . $newsletter->build_action_url('s') . '" method="post" onsubmit="return newsletter_check(this)">';

        if (isset($config['nl']) && is_array($config['nl'])) {
            foreach ($config['nl'] as $a) {
                $form .= "<input type='hidden' name='nl[]' value='" . ((int) trim($a)) . "'>\n";
            }
        }
        // Referrer
        $form .= '<input type="hidden" name="nr" value="widget-minimal"/>';
        $form .= '<input class="input" type="email" name="email" autocomplete="email" placeholder="Podaj email" required aria-labelledby="newsletter" />';
        $form .= '<button type="submit" class="button">' . esc_attr($config['button']) . '</button>';
        $form .= '</form>';

        echo $form;
        echo $args['after_widget'];
    }

    public function update($new_instance, $old_instance) {
        return $new_instance;
    }

    public function form($config) {
        if (!is_array($config)) {
            $config = [];
        }
        $newsletter = Newsletter::instance();
        $current_language = $newsletter->get_current_language();
        $profile_options = NewsletterSubscription::instance()->get_options('profile', $current_language);
        $config = array_merge(
            [
                'title' => '',
                'text' => '',
                'button' => $profile_options['subscribe'],
                'nl' => []
            ],
            $config
        );
        if (!is_array($config['nl'])) {
            $config['nl'] = [];
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                <?php echo __('Title:', 'prawe-mysli') ?>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($config['title']); ?>">
            </label>

            <label for="<?php echo $this->get_field_id('button'); ?>">
                <?php echo __('Button label:', 'prawe-mysli') ?>
                <input class="widefat" id="<?php echo $this->get_field_id('button'); ?>" name="<?php echo $this->get_field_name('button'); ?>" type="text" value="<?php echo esc_attr($config['button']); ?>">
                <?php echo __('Use a short one', 'prawe-mysli') ?>
            </label>
        </p>

        <p>
            <?php echo __('Automatically subscribe to', 'prawe-mysli') ?>
            <br>
            <?php
            $lists = Newsletter::instance()->get_lists_public();
            foreach ($lists as $list) {
                $checked = in_array($list->id, $config['nl'], true);
                ?>
                <label for="nl<?php echo $list->id ?>">
                    <input type="checkbox" value="<?php echo $list->id ?>" name="<?php echo $this->get_field_name('nl[]') ?>" <?php echo $checked ? 'checked' : '' ?>> <?php echo esc_html($list->name) ?>
                </label>
                <br>
            <?php } ?>
        </p>
        <?php
    }
}

add_action('widgets_init', static function() {
    return register_widget("Newsletter_Widget");
});
