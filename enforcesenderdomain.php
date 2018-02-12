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
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function enforcesenderdomain_civicrm_xmlMenu(&$files) {
  _enforcesenderdomain_civix_civicrm_xmlMenu($files);
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
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function enforcesenderdomain_civicrm_postInstall() {
  _enforcesenderdomain_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function enforcesenderdomain_civicrm_uninstall() {
  _enforcesenderdomain_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function enforcesenderdomain_civicrm_enable() {
  _enforcesenderdomain_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function enforcesenderdomain_civicrm_disable() {
  _enforcesenderdomain_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function enforcesenderdomain_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _enforcesenderdomain_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function enforcesenderdomain_civicrm_managed(&$entities) {
  _enforcesenderdomain_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function enforcesenderdomain_civicrm_caseTypes(&$caseTypes) {
  _enforcesenderdomain_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function enforcesenderdomain_civicrm_angularModules(&$angularModules) {
  _enforcesenderdomain_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function enforcesenderdomain_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _enforcesenderdomain_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function enforcesenderdomain_civicrm_preProcess($formName, &$form) {

} // */

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
  // Get extension settings
  $result = civicrm_api3('Setting', 'get', array(
    'return' => array('enforcesenderdomain_is_active', 'enforcesenderdomain_from_address', 'enforcesenderdomain_match_domain'),
  ));
  // The extension is active, so we have work to do
  if (isset($result['values'][$result['id']]['enforcesenderdomain_is_active']) && $result['values'][$result['id']]['enforcesenderdomain_is_active']) {
    if (!strpos(strtolower($params['from']),strtolower($result['values'][$result['id']]['enforcesenderdomain_match_domain']))) {
      $params['replyTo'] = $params['from'];
      if (preg_match('/"([^"]+)"/', $params['from'],$new_address) {
        $params['from'] = '"' . $new_address . '" <' . $result['values'][$result['id']]['enforcesenderdomain_from_address'] . '>';
      }
      else {
        $params['from'] = $result['values'][$result['id']]['enforcesenderdomain_from_address'];
      }
    }
  }
  return;
}
