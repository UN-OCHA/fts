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
        'type' => 'pie',
        'appeal' => FALSE,
        'groupby' => '',
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
    
    $type_options = array(
      'pie' => t('Pie'),
      'bar' => t('Bar'),
    );
    
    if (!isset($bean->settings['type'])) {
      $default_type = 'pie';
    }
    else {
      $default_type = $bean->settings['type'];
    }
    
    $form['settings']['type'] = array(
      '#type' => 'select',
      '#title' => t('Type'),
      '#options' => $type_options,
      '#default_value' => $default_type,
      '#required' => TRUE,
      '#multiple' => FALSE,
    );
    
    if (!isset($bean->settings['appeal'])) {
      $default_appeal = '';
    }
    else {
      $default_appeal = $bean->settings['appeal'];
    }
    
    $form['settings']['appeal'] = array(
      '#type' => 'textfield',
      '#title' => t('Appeal ID'),
      '#required' => TRUE,
      '#default_value' => $default_appeal,
    );
    
    $groupby_options = array(
      '' => t('None'),
      'cluster' => t('Cluster'),
    );
    
    if (!isset($bean->settings['groupby'])) {
      $default_groupby = '';
    }
    else {
      $default_groupby = $bean->settings['groupby'];
    }
    
    $form['settings']['groupby'] = array(
      '#type' => 'select',
      '#title' => t('Group By'),
      '#options' => $groupby_options,
      '#default_value' => $default_groupby,
      '#required' => FALSE,
      '#multiple' => FALSE,
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
    $options = _fts_highcharts_options($bean->settings['appeal'], $bean->settings['groupby'], $bean->settings['type']);
    $attributes = array();
    $content = highcharts_render($options, $attributes);
    return $content;
  }
}
