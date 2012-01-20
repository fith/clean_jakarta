<?php
// $Id: template.php,v 1.1.2.4 2010/04/11 22:57:47 snufkin Exp $

function phptemplate_comment_form($form) {
   return _phptemplate_callback('comment-form', array('form' => $form));
}


function clean_jakarta_theme(&$existing, $type, $theme, $path) {
  //$hooks = clean_theme($existing, $type, $theme, $path);
  // Add your theme hooks like this:
  /*
  $hooks['hook_name_here'] = array( // Details go here );
  */
 
  $hooks['comment_form'] = array(
    'arguments' => array('form' => NULL),
    // Note: by uncommenting the following line, you can also use a
    // template file named comment-form.tpl.php to control the
    // output of the form. 
    /*'template' => 'comment-form', */
  );
 
  return $hooks;
}


function clean_jakarta_comment_form($form) {
 //print "<pre>".print_r($form,true)."</pre>";
  $form['#parameters']['title'] = "Share your thoughs...";
  unset($form['_author']);
  unset($form['comment_filter']['comment']['#title']);
  unset($form['preview']);

  return drupal_render($form);
}

function phptemplate_username($object) {

  if ($object->uid && $object->name) {
    
    // Shorten the name when it is too long or it will break many tables.
    if (drupal_strlen($object->name) > 20) {
      $name = drupal_substr($object->name, 0, 15) . '...';
    }
    else {
      $name = $object->name;
    }

    if(is_array($user->roles)) {
      $is_team = in_array("team", $user->roles);
    }

    if (user_access('access user profiles') && $is_team) {
      $output = l($name, 'user/' . $object->uid, array('attributes' => array('title' => t('View their profile.'))));
    }
    else {
      $output = check_plain($name);
    }
  }
  else if ($object->name) {
    // Sometimes modules display content composed by people who are
    // not registered members of the site (e.g. mailing list or news
    // aggregator modules). This clause enables modules to display
    // the true author of the content.
    if (!empty($object->homepage)) {
      $output = l($object->name, $object->homepage, array('attributes' => array('rel' => 'nofollow')));
    }
    else {
      $output = check_plain($object->name);
    }

    $output .= ' (' . t('not verified') . ')';
  }
  else {
    $output = check_plain(variable_get('anonymous', t('Anonymous')));
  }
  return $output;
}


/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 */
function clean_jakarta_preprocess_page(&$variables) {
  $header_image_query = "select files.filepath from files, content_field_images where files.fid = content_field_images.field_images_fid order by RAND() ASC limit 1";
  $header_image_queryResult =  db_query($header_image_query);
  $variables['random_header_image'] = db_fetch_object($header_image_queryResult);


  $full_grid_classes = array();
  $main_classes = array();
  $left_classes = array();
  $content_classes = array();
  $right_classes = array();

  // Allow modules and themes to add to the classes. @todo: accept only arrays?
  if ($variables['full_grid_classes']) {
    $full_grid_classes = array($variables['full_grid_classes']);
  }
  if ($variables['main_classes']) {
    $main_classes = array($variables['main_classes']);
  }
  if ($variables['left_classes']) {
    $left_classes = array($variables['left_classes']);
  }
  if ($variables['content_classes']) {
    $content_classes = array($variables['content_classes']);
  }
  if ($variables['right_classes']) {
    $right_classes = array($variables['right_classes']);
  }

  // Dynamic layout classes.
  $columns = theme_get_setting('clean_960gs_columns');

  $full_grid_classes[] = 'column';
  $main_classes[] = 'column';
  $left_classes[] = 'column';
  $content_classes[] = 'column';
  $right_classes[] = 'column';

  // 12 columns.
  if ($columns == 12) {

    drupal_add_css(path_to_theme() .'/css/12cols.css');

    $full_grid_classes[] = 'grid_12';
    $main_classes[] = 'grid_12';

    switch ($variables['layout']) {
      case 'both':
        $left_classes[] = 'grid_3';
        $content_classes[] = 'grid_6';
        $right_classes[] = 'grid_3';
        break;
      case 'none':
        $content_classes[] = 'grid_12';
        break;
      case 'left':
        $left_classes[] = 'grid_3';
        $content_classes[] = 'grid_9';
        break;
      case 'right':
        $content_classes[] = 'grid_9';
        $right_classes[] = 'grid_3';
        break;
    }
  }

  // 16 columns.
  else {

    drupal_add_css(path_to_theme() .'/css/16cols.css');

    $full_grid_classes[] = 'grid_16';
    $main_classes[] = 'grid_16';
    
    switch ($variables['layout']) {
      case 'both':
        $left_classes[] = 'grid_4';
        $content_classes[] = 'grid_8';
        $right_classes[] = 'grid_4';
        break;
      case 'none':
        $content_classes[] = 'grid_16';
        break;
      case 'left':
        $left_classes[] = 'grid_4';
        $content_classes[] = 'grid_12';
        break;
      case 'right':
        $content_classes[] = 'grid_12';
        $right_classes[] = 'grid_4';
        break;
    }
  }

  // Generic classes, unlikey to need changing.
  $main_classes[] = 'clear-block';
  $left_classes[] = 'sidebar';
  $content_classes[] = 'clear-block';
  $right_classes[] = 'sidebar';

  $variables['full_grid_attr']['class'] .= implode(' ', $full_grid_classes);
  $variables['main_attr']['id'] = 'main';
  $variables['main_attr']['class'] .= implode(' ', $main_classes);
  $variables['left_attr']['id'] = 'left';
  $variables['left_attr']['class'] .= implode(' ', $left_classes);
  $variables['content_attr']['id'] = 'content';
  $variables['content_attr']['class'] .= implode(' ', $content_classes);
  $variables['right_attr']['id'] = 'right';
  $variables['right_attr']['class'] .= implode(' ', $right_classes);

  // Rebuild styles variable.
  $variables['styles'] = drupal_get_css(clean_css_stripped());
}

function clean_jakarta_preprocess_node(&$vars, $hook) {
//print_r($vars['node']);
  
}

function clean_jakarta_node_api(&$node, $op, $a3 = NULL, $a4 = NULL) {
 // print_r($node);
  switch ($op) {
    case 'view':
      if(($node->type == "story") ) {
        $node->body .= "\n<p>\n";
        $node->body .= $node->name;
        if($node->name !== "admin") {
          $node->body .= "— " . theme('username', $node) . ", "; 
        }
        $node->body .= format_date($node->created, 'custom', 'F d, Y');
        $node->body .= "</p>";
      }
      break;
  }

}
