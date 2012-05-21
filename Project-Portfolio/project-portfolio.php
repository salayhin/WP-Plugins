<?php
/*
Plugin Name: Project Portfolio
Plugin URI: https://github.com/eftakhairul/set-fav-icon/zipball/master
Description: This plugin will help you to showcase your projects as widget.
Version: 1.0
Author: Eftakhairul Islam, Sirajus Salayhin & Prince Faisal Ahmed
Author URI: http://eftakhairul.com (Eftakhairul), http://salayhin.com (Salayhin)
License: GPL2
*/
include_once('installation_plugin.php');

register_activation_hook(__FILE__, 'esp_favicon_install');
register_deactivation_hook(__FILE__, 'esp_project_portfolio_uninstall');

add_action('admin_menu', 'esp_project_portfolio_create_menu');

//Install Widget
if(is_plugin_active('Project-Portfolio/project-portfolio.php')) {
    include_once('installation-widget.php');
}


function esp_project_portfolio_create_menu()
{
    $main_option_page = __FILE__;
    add_menu_page('Portfolio Setting', 'Portfolio Setting', 'administrator', 'project-portfolio-setting', 'esp_portfolio_setting',plugins_url('/set-fav-icon/images/icon_pref_settings.gif','portfolio-setting'));
}

function esp_portfolio_setting()
{
    include("project_portfolio_setting.php");
}