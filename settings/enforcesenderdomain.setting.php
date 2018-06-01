<?php
/*
 +--------------------------------------------------------------------+
 | CiviCRM version 4.7                                                |
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC (c) 2004-2017                                |
 +--------------------------------------------------------------------+
 | This file is a part of CiviCRM.                                    |
 |                                                                    |
 | CiviCRM is free software; you can copy, modify, and distribute it  |
 | under the terms of the GNU Affero General Public License           |
 | Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
 |                                                                    |
 | CiviCRM is distributed in the hope that it will be useful, but     |
 | WITHOUT ANY WARRANTY; without even the implied warranty of         |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
 | See the GNU Affero General Public License for more details.        |
 |                                                                    |
 | You should have received a copy of the GNU Affero General Public   |
 | License and the CiviCRM Licensing Exception along                  |
 | with this program; if not, contact CiviCRM LLC                     |
 | at info[AT]civicrm[DOT]org. If you have questions about the        |
 | GNU Affero General Public License or the licensing of CiviCRM,     |
 | see the CiviCRM license FAQ at http://civicrm.org/licensing        |
 +--------------------------------------------------------------------+
 */
/**
 *
 * @package CRM
 * @copyright CiviCRM LLC (c) 2004-2017
 * $Id$
 *
 */
/*
 * Settings metadata file
 */

return array(
  'enforcesenderdomain_from_address' => array(
    'group_name' => 'enforcesenderdomain',
    'group' => 'enforcesenderdomain',
    'name' => 'enforcesenderdomain_from_address',
    'filter' => 'enforcesenderdomain',
    'type' => 'String',
    'add' => '1.0',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => ts('From: address used when enforcing the sender domain'),
    'help_text' => ts('You should use an email address that preserves good email reputation'),
    'html_type' => 'Text',
    'quick_form_type' => 'Element',
  ),
  'enforcesenderdomain_match_domain' => array(
    'group_name' => 'enforcesenderdomain',
    'group' => 'enforcesenderdomain',
    'name' => 'enforcesenderdomain_match_domain',
    'filter' => 'enforcesenderdomain',
    'type' => 'String',
    'add' => '1.0',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => ts('Email domain to be excluded from enforcement'),
    'help_text' => ts('All matching subdomains will also be exempt from enforcement'),
    'html_type' => 'Text',
    'quick_form_type' => 'Element',
  ),
  'enforcesenderdomain_is_active' => array(
    'group_name' => 'enforcesenderdomain',
    'group' => 'enforcesenderdomain',
    'name' => 'enforcesenderdomain_is_active',
    'filter' => 'enforcesenderdomain',
    'type' => 'Integer',
    'default' => 0,
    'add' => '1.0',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => ts('Enforce sender domains?'),
    'html_type' => 'Checkbox',
    'quick_form_type' => 'Element',
  ),
);
