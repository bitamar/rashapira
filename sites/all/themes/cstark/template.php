<?php

function cstark_preprocess_node(&$variables) {
  if (user_access('administer nodes')) {
    $variables['edit_link'] =  l(t('Edit'), 'node/' . $variables['nid'] . '/edit');

    if ($variables['type'] == 'painting') {
      $title = $variables['promote'] ? t('Remove from front page') : t('Add to front page');
      $variables['set_as_main_link'] =  l($title, 'set-as-main/' . $variables['nid']);

      // Facebook share.
      $url = url('node/' . $variables['nid'], array('absolute' => TRUE));
      $variables['share_link'] = l(t('Share'), "http://www.facebook.com/sharer.php?u=$url", array('attributes' => array('class' => array('facebook'))));


    }
  }

  if ($variables['type'] == 'painting') {
    $wrapper = entity_metadata_wrapper('node', $variables['nid']);
    if ($image = $wrapper->field_image->value()) {

      $element = array(
        '#tag' => 'meta',
        '#attributes' => array(
          'property' => 'og:image',
          'content' => file_create_url($image['uri']),
        ),
      );
      drupal_add_html_head($element, 'cstark_painting_image');

      $element = array(
        '#tag' => 'meta',
        '#attributes' => array(
          'property' => 'og:title',
          'content' => $wrapper->label(),
        ),
      );
      drupal_add_html_head($element, 'cstark_painting_title');
    }
  }


  if ($variables['type'] == 'painting' && !drupal_is_front_page()) {
    $variables['pager'] = shapira_get_painting_pager($variables['nid']);
  }

  if ($variables['type'] != 'news') {
    $variables['hide_title'] = true;
  }

  if ($variables['type'] == 'painting') {
    if ($variables['field_image']) {
      $info = image_get_info(image_style_path('painting', $variables['field_image'][0]['uri']));
      $variables['node_width'] = $info['width'];
    }
  }
}

function cstark_css_alter(&$css) {
  unset($css['modules/node/node.css']);
  unset($css['sites/all/modules/ctools/css/ctools.css']);
  unset($css['sites/all/modules/panels/css/panels.css']);
  unset($css['modules/system/system.base.css']);
  unset($css['modules/system/system.theme.css']);
  unset($css['modules/field/theme/field.css']);
  unset($css['modules/user/user.css']);
  unset($css['sites/all/modules/views/css/views.css']);
  unset($css['modules/system/system.messages.css']);
  unset($css['modules/system/system.menus.css']);
  unset($css['sites/all/modules/panels/plugins/layouts/onecol/onecol.css']);
}

function cstark_menu_local_task($variables) {
  $link = $variables['element']['#link'];

  if (!$link) {
    return '';
  }

  if (!empty($variables['element']['#active'])) {
    // If the link does not contain HTML already, check_plain() it now.
    // After we set 'html'=TRUE the link will not be sanitized by l().
    if (empty($link['localized_options']['html'])) {
      $link['title'] = check_plain($link['title']);
    }
    $link['localized_options']['html'] = TRUE;
  }

  return '<li' . (!empty($variables['element']['#active']) ? ' class="active"' : '') . '>' . l($link['title'], $link['href'], $link['localized_options']) . "</li>\n";
}

function cstark_menu_item_link($link) {
  // Local tasks for view and edit nodes shouldn't be displayed.
  if ($link['type'] & MENU_LOCAL_TASK && ($link['path'] === 'node/%/edit' || $link['path'] === 'node/%/view')) {
    return '';
  }
  else {
    if (empty($link['localized_options'])) {
      $link['localized_options'] = array();
    }

    return l($link['title'], $link['href'], $link['localized_options']);
  }
}

function cstark_link($variables) {
  if (_cstark_is_term_active($variables['path'])) {
    $variables['options']['attributes']['class'][] = 'active';
  }

  return '<a href="' . check_plain(url($variables['path'], $variables['options'])) . '"' . drupal_attributes($variables['options']['attributes']) . '>' . ($variables['options']['html'] ? $variables['text'] : check_plain($variables['text'])) . '</a>';
}

function cstark_menu_link(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
    if (preg_match('/active/', $sub_menu)) {
      $element['#attributes']['class'][] = 'active-trail';
    }
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

function _cstark_is_term_active($path) {
  // Set terms links as active if a node of their category is viewed.
  if (preg_match('/^taxonomy\/term\//', $path) && $node = menu_get_object()) {
    list(,, $tid) = explode('/', $path);

    $wrapper = entity_metadata_wrapper('node', $node);
    if (isset($wrapper->field_categories) && $wrapper->field_categories->value() && $wrapper->field_categories->tid->value() == $tid) {
      return true;
    }
  }
}
