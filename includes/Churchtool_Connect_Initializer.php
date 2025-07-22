<?php
namespace ChurchtoolConnect;

/**
 * Churchtool Connect – Zentrale Initialisierung
 *
 * @package Churchtool Connect
 * @author Kai Naumann
 * @license GPL-2.0-or-later
 */
if (!defined('ABSPATH')) exit;

class Churchtool_Connect_Initializer {

    public static function init() {
        // logge, dass das Plugin geladen wurde
          
         error_log('Churchtool Connect Plugin v2 wurde geladen.');
        
        
        // Definiere Plugin-Konstanten
        Churchtool_Connect_Constants::define();

        // Registriere Asset Loader für Frontend
        add_action('wp_enqueue_scripts', array('ChurchtoolConnect\\Churchtool_Connect_Assets', 'enqueue'));

        // Registriere Asset Loader für Admin-Bereich/      
        add_action('admin_enqueue_scripts', array('ChurchtoolConnect\\Churchtool_Connect_Assets', 'enqueue'));

        // Initialisiere die Konfiguration  
        Churchtool_Connect_Config::init();
        Churchtool_Connect_Debug::init();




        
    add_action('init', function () {
        load_plugin_textdomain(
            'churchtool-connect',
            false,
            dirname(plugin_basename(__FILE__)) . '/languages'
        );
    });



    }
}
