<?php

require_once 'enforcesenderdomain.civix.php';
use CRM_Enforcesenderdomain_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function enforcesenderdomain_civicrm_config(&$config) {
  _enforcesenderdomain_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function enforcesenderdomain_civicrm_install() {
  _enforcesenderdomain_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function enforcesenderdomain_civicrm_enable() {
  _enforcesenderdomain_civix_civicrm_enable();
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *

 // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function enforcesenderdomain_civicrm_navigationMenu(&$menu) {
  _enforcesenderdomain_civix_insert_navigation_menu($menu, NULL, array(
    'label' => E::ts('The Page'),
    'name' => 'the_page',
    'url' => 'civicrm/the-page',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _enforcesenderdomain_civix_navigationMenu($menu);
} // */

/**
 * Validation function for extension setings form
 *
 * Implements hook_civirm_validateForm().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_validateForm/
 *
 */

function enforcesenderdomain_civicrm_validateForm($formName, &$fields, &$files, &$form, &$errors) {
  if ($formName == 'CRM_Enforcesenderdomain_Form_EnforceSenderDomainSettings') {
    if (isset($fields['enforcesenderdomain_is_active']) && $fields['enforcesenderdomain_is_active']) {
      // Check email address
      if (empty($fields['enforcesenderdomain_from_address']) || (!filter_var($fields['enforcesenderdomain_from_address'], FILTER_VALIDATE_EMAIL))) {
        $errors['enforcesenderdomain_from_address'] = ts('Email address is blank or invalid');
      }
      // Check domain format
      if (empty($fields['enforcesenderdomain_match_domain']) || (!filter_var('admin@'.$fields['enforcesenderdomain_match_domain'], FILTER_VALIDATE_EMAIL))) {
        $errors['enforcesenderdomain_match_domain'] = ts('Domain name is blank or invalid');
      }
    }
  }
  return;
}

/**
 * Alter mail parameters if extension is set to be active
 *
 * Implements hook_civicrm_alterMailParams().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterMailParams/
 *
 */

function enforcesenderdomain_civicrm_alterMailParams(&$params, $context) {
  // Exit immediately if this is a CiviMail or CiviMosaico mailing
  if ($context == 'civimail' || $context == 'flexmailer') {
    return;
  }
  // Get extension settings values
  $result = civicrm_api3('Setting', 'get', array(
    'return' => array('enforcesenderdomain_is_active', 'enforcesenderdomain_from_address', 'enforcesenderdomain_match_domain'),
  ));
  // If the extension is active, so we have work to do
  if (isset($result['values'][$result['id']]['enforcesenderdomain_is_active']) && $result['values'][$result['id']]['enforcesenderdomain_is_active']) {
    // Ensure $params['from'] is a string to prevent deprecation warning
    $fromAddress = (string) $params['from'];
    if (!strpos(strtolower($fromAddress),strtolower($result['values'][$result['id']]['enforcesenderdomain_match_domain']))) {
      $params['replyTo'] = $fromAddress;
      if (preg_match('/"([^"]+)"/', $fromAddress, $new_address)) {
        $params['from'] = '"' . $new_address[1] . '" <' . $result['values'][$result['id']]['enforcesenderdomain_from_address'] . '>';
      }
      else {
        $params['from'] = $result['values'][$result['id']]['enforcesenderdomain_from_address'];
      }
    }
  }
  return;
}
