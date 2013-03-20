<?php
/**
 * @file
 * Listing bean plugin.
 */

class FTSHighchartsBean extends BeanPlugin {
  /**
   * Declares default block settings.
   */
  public function values() {
    $values = array(
      'settings' => array(
        'appeal' => FALSE,
      ),
    );

    return array_merge(parent::values(), $values);
  }
  /**
   * Builds extra settings for the block edit form.
   */
  public function form($bean, $form, &$form_state) {
    $form = array();
    $form['settings'] = array(
      '#type' => 'fieldset',
      '#tree' => 1,
      '#title' => t('Settings'),
    );
    /*$node_view_modes = array();
    $entity_info = entity_get_info();
    foreach ($entity_info['node']['view modes'] as $key => $value) {
      $node_view_modes[$key] = $value['label'];
    }
    if (!isset($bean->settings['node_view_mode'])) {
      $default_node_view_mode = 'full';
    }
    else {
      $default_node_view_mode = $bean->settings['node_view_mode'];
    }*/
    $form['settings']['appeal'] = array(
      '#type' => 'textfield',
      '#title' => t('Appeal ID'),
      '#required' => TRUE,
    );
    /*if (!$records_shown = $bean->settings['records_shown']) {
      $records_shown = 5;
    }
    $form['settings']['records_shown'] = array(
      '#type' => 'textfield',
      '#title' => t('Records shown'),
      '#size' => 5,
      '#default_value' => $records_shown,
    );
    $form['more_link'] = array(
      '#type' => 'fieldset',
      '#tree' => 1,
      '#title' => t('More link'),
    );
    $form['more_link']['text'] = array(
      '#type' => 'textfield',
      '#title' => t('Link text'),
      '#default_value' => $bean->more_link['text'],
    );
    $form['more_link']['path'] = array(
      '#type' => 'textfield',
      '#title' => t('Link path'),
      '#default_value' => $bean->more_link['path'],
    );*/
    return $form;
  }

  /**
   * Displays the bean.
   */
  public function view($bean, $content, $view_mode = 'default', $langcode = NULL) {
    $options = _fts_highcharts_options($bean->settings['appeal']);
    $attributes = array();
    $content = highcharts_render($options, $attributes);
    return $content;
  }
}
