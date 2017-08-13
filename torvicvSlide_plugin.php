<?php

/*
Plugin Name: Test plugin
Description: A test plugin to demonstrate wordpress functionality
Author: Victor Cabral Vida
Version: 0.1
*/

add_action('wp_print_scripts', 'np_register_scripts');
add_action('wp_print_styles', 'np_register_styles');
add_action( 'admin_enqueue_scripts', 'np_admin_register_script' );


function np_register_scripts(){
    wp_enqueue_script("torvicSlide_pluginJs", plugins_url().'/torvicvSlide_plugin/torvicvSlide_plugin.js', array('jquery'), time(),true);
}
function np_register_styles(){
    wp_enqueue_style("torvicSlideCss", plugins_url('torvicvSlide_plugin/torvicvSlide.css'),array(), time());
    wp_enqueue_style("w3schoolsCss", plugins_url('torvicvSlide_plugin/w3schools.css'),array(), time());
}
function np_admin_register_script(){
    wp_enqueue_script("mediaPlugin", plugins_url().'/torvicvSlide_plugin/scriptMediaWidget.js', array('jquery'), time(), true);
}

class MySettingsPage
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_shortcode( 'baztag', array( $this, 'show_slide' ) );
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin', 
            'My Settings', 
            'manage_options', 
            'my-setting-admin', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'my_option_name' );
        ?>
        <div class="wrap">
            <h1>My Settings</h1>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'my_option_group' );
                do_settings_sections( 'my-setting-admin' );
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'my_option_group', // Option group
            'my_option_name', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'My Custom Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'my-setting-admin' // Page
        );  

        add_settings_field(
            'ruta1', // ID
            'Ruta 1:', // Title 
            array( $this, 'ruta1_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id' // Section           
        );      

        add_settings_field(
            'ruta2', 
            'Ruta 2:', 
            array( $this, 'ruta2_callback' ), 
            'my-setting-admin', 
            'setting_section_id'
        );
        
        add_settings_field(
            'ruta3', // ID
            'Ruta 3:', // Title 
            array( $this, 'ruta3_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id' // Section           
        );
        
        add_settings_field(
            'ruta4', // ID
            'Ruta 4:', // Title 
            array( $this, 'ruta4_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id' // Section           
        );
        
        add_settings_field(
            'ruta5', // ID
            'Ruta 5:', // Title 
            array( $this, 'ruta5_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id' // Section           
        );
        
        add_settings_field(
            'ruta6', // ID
            'Ruta 6:', // Title 
            array( $this, 'ruta6_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id' // Section           
        );
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['ruta1'] ) ){
            $new_input['ruta1'] = sanitize_text_field( $input['ruta1'] );
        }
        if( isset( $input['ruta2'] ) ){
            $new_input['ruta2'] = sanitize_text_field( $input['ruta2'] );
        }
        if( isset( $input['ruta3'] ) ){
            $new_input['ruta3'] = sanitize_text_field( $input['ruta3'] );
        }
        if( isset( $input['ruta4'] ) ){
            $new_input['ruta4'] = sanitize_text_field( $input['ruta4'] );
        }
        if( isset( $input['ruta5'] ) ){
            $new_input['ruta5'] = sanitize_text_field( $input['ruta5'] );
        }
        if( isset( $input['ruta6'] ) ){
            $new_input['ruta6'] = sanitize_text_field( $input['ruta6'] );
        }
        
        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your settings below:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function ruta1_callback()
    {
        printf(
            '<input type="url" id="ruta1" class="upload_image_input" name="my_option_name[ruta1]" value="%s" />'
                . '<button class="upload_image_button">Select image</button>',
            isset( $this->options['ruta1'] ) ? esc_attr( $this->options['ruta1']) : '');
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function ruta2_callback()
    {
        printf(
            '<input type="url" id="ruta2" class="upload_image_input" name="my_option_name[ruta2]" value="%s" />'
                . '<button class="upload_image_button">Select image</button>',
            isset( $this->options['ruta2'] ) ? esc_attr( $this->options['ruta2']) : ''
        );
    }
    
    public function ruta3_callback()
    {
        printf(
            '<input type="url" id="ruta3" class="upload_image_input" name="my_option_name[ruta3]" value="%s" />'
                . '<button class="upload_image_button">Select image</button>',
            isset( $this->options['ruta3'] ) ? esc_attr( $this->options['ruta3']) : ''
        );
    }
    
    public function ruta4_callback()
    {
        printf(
            '<input type="url" id="ruta4" class="upload_image_input" name="my_option_name[ruta4]" value="%s" />'
                . '<button class="upload_image_button">Select image</button>',
            isset( $this->options['ruta4'] ) ? esc_attr( $this->options['ruta4']) : ''
        );
    }
    
    public function ruta5_callback()
    {
        printf(
            '<input type="url" id="ruta5" class="upload_image_input" name="my_option_name[ruta5]" value="%s" />'
                . '<button class="upload_image_button">Select image</button>',
            isset( $this->options['ruta5'] ) ? esc_attr( $this->options['ruta5']) : ''
        );
    }
    
    public function ruta6_callback()
    {
        printf(
            '<input type="url" id="ruta6" class="upload_image_input" name="my_option_name[ruta6]" value="%s" />'
                . '<button class="upload_image_button">Select image</button>',
            isset( $this->options['ruta6'] ) ? esc_attr( $this->options['ruta6']) : ''
        );
    }
    public function show_slide(){
        $myField1 = get_option( 'my_option_name' )['ruta1'];
        $myField2 = get_option( 'my_option_name' )['ruta2'];
        $myField3 = get_option( 'my_option_name' )['ruta3'];
        $myField4 = get_option( 'my_option_name' )['ruta4'];
        $myField5 = get_option( 'my_option_name' )['ruta5'];
        $myField6 = get_option( 'my_option_name' )['ruta6'];
        
        $formato = '<div class="w3-content w3-display-container">
                <img class="mySlides_plugin" style="order: 0;" src=" %s " />
                <img class="mySlides_plugin class2" style="order: 1;" src=" %s " />
                <img class="mySlides_plugin" style="order: 2;" src=" %s " />

                <img class="mySlides_plugin" style="order: 3;" src=" %s " />

                <img class="mySlides_plugin" style="order: 4;" src=" %s " />

                <img class="mySlides_plugin" style="order: 5;" src=" %s " />

                <button class="w3-button w3-black w3-display-left">&#10094;</button>
                <button class="w3-button w3-black w3-display-right">&#10095;</button>
                </div>';
        $ruta1 = esc_attr( $myField1 );
        $ruta2 = esc_attr( $myField2 );
        $ruta3 = esc_attr( $myField3 );
        $ruta4 = esc_attr( $myField4 );
        $ruta5 = esc_attr( $myField5 );
        $ruta6 = esc_attr( $myField6 );

        $mostrar = sprintf($formato, $ruta1, $ruta2, $ruta3, $ruta4, $ruta5, $ruta6);
        return $mostrar;
        
    }
}

if( is_admin() ){
    $my_settings_page = new MySettingsPage();
}else{
    $my_settings_page = new MySettingsPage();
}

