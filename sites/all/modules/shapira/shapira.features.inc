<?php
/**
 * @file
 * shapira.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function shapira_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "field_group" && $api == "field_group") {
    return array("version" => "1");
  }
  if ($module == "page_manager" && $api == "pages_default") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_views_api().
 */
function shapira_views_api($module = NULL, $api = NULL) {
  return array("api" => "3.0");
}

/**
 * Implements hook_fontyourface_features_default_font().
 */
function shapira_fontyourface_features_default_font() {
  return array(
    'Crimson-Roman normal normal' => array(
      'name' => 'Crimson-Roman normal normal',
      'enabled' => 1,
      'url' => 'http://localhost/#846044c476033088a9ba64e049a89366',
      'provider' => 'local_fonts',
      'css_selector' => 'body',
      'css_family' => 'Crimson-Roman',
      'css_style' => 'normal',
      'css_weight' => 'normal',
      'css_fallbacks' => '',
      'foundry' => '',
      'foundry_url' => '',
      'license' => '',
      'license_url' => '',
      'designer' => '',
      'designer_url' => '',
      'metadata' => 'a:2:{s:4:"path";s:76:"public://fontyourface/local_fonts/Crimson_Roman-normal-normal/stylesheet.css";s:8:"font_uri";a:4:{s:3:"eot";s:91:"public://fontyourface/local_fonts/Crimson_Roman-normal-normal/crimsontext-roman-webfont.eot";s:8:"truetype";s:91:"public://fontyourface/local_fonts/Crimson_Roman-normal-normal/crimsontext-roman-webfont.ttf";s:4:"woff";s:92:"public://fontyourface/local_fonts/Crimson_Roman-normal-normal/crimsontext-roman-webfont.woff";s:3:"svg";s:91:"public://fontyourface/local_fonts/Crimson_Roman-normal-normal/crimsontext-roman-webfont.svg";}}',
    ),
  );
}

/**
 * Implements hook_image_default_styles().
 */
function shapira_image_default_styles() {
  $styles = array();

  // Exported image style: large_painting.
  $styles['large_painting'] = array(
    'name' => 'large_painting',
    'effects' => array(
      1 => array(
        'label' => 'Scale',
        'help' => 'Scaling will maintain the aspect-ratio of the original image. If only a single dimension is specified, the other dimension will be calculated.',
        'effect callback' => 'image_scale_effect',
        'dimensions callback' => 'image_scale_dimensions',
        'form callback' => 'image_scale_form',
        'summary theme' => 'image_scale_summary',
        'module' => 'image',
        'name' => 'image_scale',
        'data' => array(
          'width' => 1000,
          'height' => 1000,
          'upscale' => 0,
        ),
        'weight' => 1,
      ),
    ),
    'label' => 'large_painting',
  );

  // Exported image style: painting.
  $styles['painting'] = array(
    'name' => 'painting',
    'label' => 'Painting',
    'effects' => array(
      1 => array(
        'label' => 'Scale',
        'help' => 'Scaling will maintain the aspect-ratio of the original image. If only a single dimension is specified, the other dimension will be calculated.',
        'effect callback' => 'image_scale_effect',
        'dimensions callback' => 'image_scale_dimensions',
        'form callback' => 'image_scale_form',
        'summary theme' => 'image_scale_summary',
        'module' => 'image',
        'name' => 'image_scale',
        'data' => array(
          'width' => 550,
          'height' => 550,
          'upscale' => 0,
        ),
        'weight' => 1,
      ),
    ),
  );

  return $styles;
}

/**
 * Implements hook_node_info().
 */
function shapira_node_info() {
  $items = array(
    'news' => array(
      'name' => t('News'),
      'base' => 'node_content',
      'description' => '',
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
    'page' => array(
      'name' => t('Basic page'),
      'base' => 'node_content',
      'description' => t('Use <em>basic pages</em> for your static content, such as an \'About us\' page.'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
    'painting' => array(
      'name' => t('Painting'),
      'base' => 'node_content',
      'description' => '',
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  return $items;
}
