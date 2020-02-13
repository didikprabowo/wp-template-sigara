<?php

/**
 * If this file is called directly, abort.
 */
if (!defined('ABSPATH')) {
    die('Direct access is forbidden.');
}
if (!class_exists('WP_Bootstrap_Navwalker')) {

    class WP_Bootstrap_Navwalker extends Walker_Nav_Menu
    {

        /**
         * @since       1.0.0
         * @access      public
         * @var type    bool
         */
        private $dropdown = false;

        public function start_lvl(&$output, $depth = 0, $args = array())
        {
            if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
                $t = '';
                $n = '';
            } else {
                $t = "\t";
                $n = "\n";
            }

            $this->dropdown = true;
            $output         .= $n . str_repeat($t, $depth) . '<div class="dropdown-menu" role="menu">' . $n;
        }


        public function end_lvl(&$output, $depth = 0, $args = array())
        {
            if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
                $t = '';
                $n = '';
            } else {
                $t = "\t";
                $n = "\n";
            }

            $this->dropdown = false;
            $output         .= $n . str_repeat($t, $depth) . '</div>' . $n;
        }

        public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
        {
            if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
                $t = '';
                $n = '';
            } else {
                $t = "\t";
                $n = "\n";
            }

            $indent = str_repeat($t, $depth);

            if (0 === strcasecmp($item->attr_title, 'divider') && $this->dropdown) {
                $output .= $indent . '<div class="dropdown-divider"></div>' . $n;
                return;
            } elseif (0 === strcasecmp($item->title, 'divider') && $this->dropdown) {
                $output .= $indent . '<div class="dropdown-divider"></div>' . $n;
                return;
            }

            $classes   = empty($item->classes) ? array() : (array) $item->classes;
            $classes[] = 'menu-item-' . $item->ID;
            $classes[] = 'nav-item';

            if ($args->walker->has_children) {
                $classes[] = 'dropdown';
            }

            if (0 < $depth) {
                $classes[] = 'dropdown-menu';
            }
            $args = apply_filters('nav_menu_item_args', $args, $item, $depth);

            $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

            $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
            $id = $id ? ' id="' . esc_attr($id) . '"' : '';

            if (!$this->dropdown) {
                $output .= $indent . '<li' . $id . $class_names . '>' . $n . $indent . $t;
            }

            $atts           = array();
            $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
            $atts['target'] = !empty($item->target) ? $item->target : '';
            $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
            $atts['href']   = !empty($item->url) ? $item->url : '';

            $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

            if ($args->walker->has_children) {
                $atts['data-toggle']   = 'dropdown';
                $atts['aria-haspopup'] = 'true';
                $atts['aria-expanded'] = 'false';
            }

            $attributes = '';
            foreach ($atts as $attr => $value) {
                if (!empty($value)) {
                    $value      = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            /** This filter is documented in wp-includes/post-template.php */
            $title = apply_filters('the_title', $item->title, $item->ID);

            $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

            $item_classes = array('nav-link');

            if ($args->walker->has_children) {
                $item_classes[] = 'dropdown-toggle';
            }

            if (0 < $depth) {
                $item_classes = array_diff($item_classes, ['nav-link']);
                $item_classes[] = 'dropdown-item';
            }

            $item_output = $args->before;
            $item_output .= '<a class="' . implode(' ', $item_classes) . '" ' . $attributes . '>';
            $item_output .= $args->link_before . $title . $args->link_after;
            $item_output .= '</a>';

            $item_output .= $args->after;

            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        }

        public function end_el(&$output, $item, $depth = 0, $args = array())
        {
            if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
                $t = '';
                $n = '';
            } else {
                $t = "\t";
                $n = "\n";
            }

            $output .= $this->dropdown ? '' : str_repeat($t, $depth) . '</li>' . $n;
        }

        public static function fallback($args)
        {
            if (current_user_can('edit_theme_options')) {

                $defaults = array(
                    'container'       => 'div',
                    'container_id'    => false,
                    'container_class' => false,
                    'menu_class'      => 'menu',
                    'menu_id'         => false,
                );
                $args     = wp_parse_args($args, $defaults);
                if (!empty($args['container'])) {
                    echo sprintf('<%s id="%s" class="%s">', $args['container'], $args['container_id'], $args['container_class']);
                }
                echo sprintf('<ul id="%s" class="%s">', $args['container_id'], $args['container_class']) .
                    '<li class="nav-item">' .
                    '<a href="' . admin_url('nav-menus.php') . '" class="nav-link">' . __('Add a menu') . '</a>' .
                    '</li></ul>';
                if (!empty($args['container'])) {
                    echo sprintf('</%s>', $args['container']);
                }
            }
        }
    }
}
