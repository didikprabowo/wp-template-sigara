<?php



function mytheme_customize_register($wp_customize)
{

    //header
    $wp_customize->add_section('header', array(
        'title'      => "Header",
        'priority'   => 30,
    ));
    //All our sections, settings, and controls will be added here
    $wp_customize->add_setting('header_background_color', array(
        'default'     => "#F8F9FA",
        'transport'   => 'refresh',
    ));

    $wp_customize->add_setting('header_text_color', array(
        'default'     => "#777777",
        'transport'   => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_background_color', array(
        'label'        => "Background Color",
        'section'    => 'header',
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_text_color', array(
        'label'        => "Font Color",
        'section'    => 'header',
    )));
    // all_option

    // popuer
    $wp_customize->add_section('all_option', array(
        'title'    => "Theme Option",
        'description' => '',
        'priority' => 120,
    ));

    $wp_customize->add_setting('set_populer', array(
        "default" => 'inline',
        'type'       => 'option',
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'set_populer',
            array(
                'label'          => "Apakah ingin menampilkan Artikel Populer ?",
                'section'        => 'all_option',
                'type'           => 'radio',
                'choices'        => array(
                    'inline'   => "Iya",
                    'none'  => "Tidak"
                )
            )
        )
    );
    //featured
    $wp_customize->add_setting('set_featured', array(
        "default"       => 'inline',
        'type'          => 'option',
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'set_featured',
            array(
                'label'          => "Apakah ingin menampilkan Artikel Fetatured ?",
                'section'        => 'all_option',
                'type'           => 'radio',
                'choices'        => array(
                    'inline'    => "Iya",
                    'none'      => "Tidak"
                )
            )
        )
    );

    // feedbaner
    $wp_customize->add_setting('set_feedbanner', array(
        "default"        => '',
        'type'           => 'option',
        'transport'      => 'refresh',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'set_feedbanner',
            array(
                'label'          => "Masukkan Username Feedbanner",
                'section'        => 'all_option',
                'type'           => 'text',
                'priority'       => 1,
            )
        )
    );

    $wp_customize->add_setting('set_right_sticky', array(
        "default"        => 'sticky',
        'type'           => 'option',
        'transport'      => 'refresh',
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'set_right_sticky',
            array(
                'label'          => "Apakah ingin mengaktifikan Sticky Sidebar ?",
                'section'        => 'all_option',
                'type'           => 'radio',
                'choices'        => array(
                    'sticky'     => "Iya",
                    'relative'   => "Tidak"
                )
            )
        )
    );
}

add_action('customize_register', 'mytheme_customize_register');

function mytheme_customize_css()
{
?>
    <style type="text/css">
        .bg_custom_header {
            background: <?php echo get_theme_mod('header_background_color', "#F8F9FA"); ?>;
        }

        .navbar-light .navbar-nav .nav-link {
            color: <?php echo get_theme_mod('header_text_color', "#777777"); ?>;
        }

        .populer_show {
            display: <?php echo get_option('set_populer'); ?>
        }

        .featured {
            display: <?php echo get_option('set_featured'); ?>
        }
    </style>
<?php
}

function mytheme_customize_js()
{ ?>
    <script>
        document.getElementById("rs").style.position = "<?php echo get_option("set_right_sticky"); ?>";
        <?php
        if (get_option('set_right_sticky') == "relative") { ?>
            document.getElementById("rs").style.top = 0;
        <?php } ?>
    </script>
<?php }

add_action('wp_head', 'mytheme_customize_css');
add_action('wp_footer', 'mytheme_customize_js');
