<?php
/**
 * @file
 * shapira.features.menu_custom.inc
 */

/**
 * Implements hook_menu_default_menu_custom().
 */
function shapira_menu_default_menu_custom() {
  $menus = array();

  // Exported menu: navigation.
  $menus['navigation'] = array(
    'menu_name' => 'navigation',
    'title' => 'Navigation',
    'description' => '',
  );
  // Exported menu: user-menu.
  $menus['user-menu'] = array(
    'menu_name' => 'user-menu',
    'title' => 'User menu',
    'description' => '',
  );
  // Translatables
  // Included for use with string extractors like potx.
  t('Navigation');
  t('User menu');


  return $menus;
}
