<?php

use CRM_Enforcesenderdomain_ExtensionUtil as E;

/**
 * Form controller class
 *
 * @see https://wiki.civicrm.org/confluence/display/CRMDOC/QuickForm+Reference
 */
class CRM_Enforcesenderdomain_Form_EnforceSenderDomainSettings extends CRM_Core_Form {
  private $_settingFilter = array('group' => 'enforcesenderdomain');
  private $_submittedValues = array();
  private $_settings = array();
  public function buildQuickForm() {
    $settings = $this->getFormSettings();
    foreach ($settings as $name => $setting) {
      if (isset($setting['quick_form_type'])) {
        $add = 'add' . $setting['quick_form_type'];
        if ($add == 'addElement') {
          if (in_array($setting['html_type'], array('Checkbox', 'Textarea'))) {
            $this->$add($setting['html_type'], $name, ts($setting['description']));
          }
          else {
          // $this->$add($setting['html_type'], $name, ts($setting['description']), NULL, CRM_Utils_Array::value('html_attributes', $setting, array ()));
            $this->$add($setting['html_type'], $name, ts($setting['description']), CRM_Utils_Array::value('html_attributes', $setting, array ()), $setting, array ());
          }
        }
        elseif ($setting['html_type'] == 'Select') {
          $optionValues = array();
          if (!empty($setting['pseudoconstant']) && !empty($setting['pseudoconstant']['optionGroupName'])) {
            $optionValues = CRM_Core_OptionGroup::values($setting['pseudoconstant']['optionGroupName'], FALSE, FALSE, FALSE, NULL, 'name');
          }
          $this->add('select', $setting['name'], $setting['title'], $optionValues, FALSE, $setting['html_attributes']);
        }
        else {
          $this->$add($name, ts($setting['title']));
        }
        $this->assign("{$setting['description']}_description", ts('description'));
      }
    }
    $this->addButtons(array(
      array (
        'type' => 'submit',
        'name' => ts('Submit'),
        'isDefault' => TRUE,
      )
    ));
    // export form elements
    $this->assign('elementNames', $this->getRenderableElementNames());
    parent::buildQuickForm();
  }

  public function postProcess() {
    $this->_submittedValues = $this->exportValues();
    $this->saveSettings();
    parent::postProcess();
  }

/**
   * Get the settings we are going to allow to be set on this form.
   *
   * @return array
   */
  function getFormSettings() {
    if (empty($this->_settings)) {
      $settings = civicrm_api3('setting', 'getfields', array('filters' => $this->_settingFilter));
    }
    $extraSettings = civicrm_api3('setting', 'getfields', array('filters' => array('group' => 'accountsync')));
    $settings = $settings['values'] + $extraSettings['values'];
    return $settings;
  }
  /**
   * Get the settings we are going to allow to be set on this form.
   *
   * @return array
   */
  function saveSettings() {
    $settings = $this->getFormSettings();
    if (!array_key_exists('enforcesenderdomain_is_active',$this->_submittedValues)) {
      $this->_submittedValues['enforcesenderdomain_is_active'] = $settings['enforcesenderdomain_is_active'] ? 0 : 1;
    }
    $values = array_intersect_key($this->_submittedValues, $settings);
    civicrm_api3('setting', 'create', $values);
  }
  /**
   * Set defaults for form.
   *
   * @see CRM_Core_Form::setDefaultValues()
   */
  function setDefaultValues() {
    $existing = civicrm_api3('setting', 'get', array('return' => array_keys($this->getFormSettings())));
    $defaults = array();
    $domainID = CRM_Core_Config::domainID();
    foreach ($existing['values'][$domainID] as $name => $value) {
      $defaults[$name] = $value;
    }
    return $defaults;
  }

  /**
   * Get the fields/elements defined in this form.
   *
   * @return array (string)
   */
  public function getRenderableElementNames() {
    // The _elements list includes some items which should not be
    // auto-rendered in the loop -- such as "qfKey" and "buttons".  These
    // items don't have labels.  We'll identify renderable by filtering on
    // the 'label'.
    $elementNames = array();
    foreach ($this->_elements as $element) {
      /** @var HTML_QuickForm_Element $element */
      $label = $element->getLabel();
      if (!empty($label)) {
        $elementNames[] = $element->getName();
      }
    }
    return $elementNames;
  }

}
