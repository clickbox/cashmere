<?php
/**
 * @file
 * Contains functions to alter Backdrops's markup for the Cashmere theme.
 *      ████████
*     ███░░▓▓▓▓███
*     █░░░░▓▓▓▓░░█
*    █░░░░▓▓▓▓▓▓░░█
*   ██░░░▓▓░░░░▓▓░██
*   █▓▓▓▓▓░░░░░░▓▓▓█
*   █▓░░▓▓░░░░░░▓▓▓█
*   █░░░░▓░░░░░░▓▓░█
*   █░░░░▓▓░░░░▓▓░░█
*   █▓░░▓▓▓▓▓▓▓▓▓░░█
*   █▓▓▓████████▓▓░█
*    ███░░█░░█░░███
*     █░░░█░░█░░░█
*     █░░░░░░░░░░█
*      █░░░░░░░░█
*       ████████
 *
 * The Cashmere theme is a base theme designed to be easily extended by sub
 * themes. You should not modify this or any other file in the cashmere theme
 * folder. Instead, you should create a sub-theme and make your changes there.
 * In fact, if you're reading this, you may already off on the wrong foot.
 *
 * See the project page for more information:
 *   https://backdropcms.org/guide/themes
 */


//////////////////////////////
// Includes
//////////////////////////////

/**
 * Implements hook_preprocess_maintenance_page().
 */
function cashmere_preprocess_maintenance_page(&$variables) {
  backdrop_add_css(backdrop_get_path('theme', 'cashmere') . '/css/maintenance-page.css');
}

function cashmere_preprocess_page(&$variables) {
  backdrop_add_css('https://fonts.googleapis.com/icon?family=Material+Icons', array('type' => 'external', 'every_page' => TRUE, 'preprocess' => TRUE));
  // backdrop_add_js(backdrop_get_path('theme', 'cashmere') . '/js/scripts.js', array('type' => 'file', 'scope' => 'footer', 'every_page' => TRUE, 'preprocess' => TRUE));
}

/**
 * Implements hook_preprocess_layout().
 */
function cashmere_preprocess_layout(&$variables) {
  if ($variables['content']['header']) {
    $variables['content']['header'] = '<div class="l-header-inner nav-wrapper">' . $variables['content']['header'] . '</div>';
  }
}

/**
 * Implements theme_menu_tree().
**/
function cashmere_menu_tree($variables) {
  return '<ul class="menu clearfix">' . $variables['tree'] . '</ul>';
}

/**
* Override the theme_menu_tree__main_menu().
*/
function cashmere_menu_tree__main_menu(&$variables) {
    return '<nav role="navigation"><a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a><ul class="menu clearfix right hide-on-med-and-down">' . $variables['tree'] . '</ul></nav>';
}

/**
* Override the theme_menu_tree__main_menu().
*/
function cashmere_menu_tree__menu_mobile(&$variables) {
    return '<ul class="menu side-nav" id="mobile-demo">' . $variables['tree'] . '</ul>';
}

/**
 * Implements theme_field__field_type().
 */
function cashmere_field__taxonomy_term_reference($variables) {
  $output = '';

  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    $output .= '<h3 class="field-label">' . $variables['label'] . ': </h3>';
  }

  // Render the items.
  $output .= ($variables['element']['#label_display'] == 'inline') ? '<ul class="links inline">' : '<ul class="links">';
  foreach ($variables['items'] as $delta => $item) {
    $item_attributes = (isset($variables['item_attributes'][$delta])) ? backdrop_attributes($variables['item_attributes'][$delta]) : '';
    $output .= '<li class="taxonomy-term-reference-' . $delta . '"' . $item_attributes . '>' . backdrop_render($item) . '</li>';
  }
  $output .= '</ul>';

  // Render the surrounding DIV with appropriate classes and attributes.
  if (!in_array('clearfix', $variables['classes'])) {
    $variables['classes'][] = 'clearfix';
  }
  $output = '<div class="' . implode(' ', $variables['classes']) . '"' . backdrop_attributes($variables['attributes']) . '>' . $output . '</div>';

  return $output;
}

// function cashmere_css_alter(&$css) {
//   // Remove system.theme.css file.
//   unset($css[backdrop_get_path('module', 'system') . '/css/system.theme.css']);
// }
