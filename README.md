# CiviCRM Enforce Sender Domain

This is a CiviCRM extension that makes it possible to enforce the use of a particular email address for any outgoing email from CiviCRM. This is particularly useful when looking to improve/maintain email sender reputations. In some cases ensuring that From: addresses adhere to a particualr convention is necessary to ensure mail delivery (eg. when using Amazon's Simple Email Service).

## Getting Started

git clone this extension and install it in your CiviCRM extensions directory. Then go to the CiviCRM Modules administration screen and install and enable the extension. 

### Prerequisites

None.

### Installing

Clone the repository to your extensions directory.

```
git clone git@github.com/australiangreens/au.org.greens.enforcesenderdomain.git
```

Navigate to the CiviCRM administration menu.

```
Administer -> Customize Data and Screens -> Extensions
```

Install and enable the module.

## Configuration

Head to https://<your_civicrm_installation>/civicrm/enforcesender/settings.

Configure the extension with the required information:
- From: address - the address to use when rewriting the sending domain 
- Exempt domain - Emails that use this domain (or its subdomains) in their From: address  won't have their From: address rewritten
- Enforce sender domains - A checkbox that lets you (de)activate enforcement as desired 

## To-Do

- Add navigation menu item
- Validate extension properly rewrites CiviMail (bulk) emails
- Validate extension properly rewrites template-based emails

## Built With

* [civix](https://github.com/totten/civix) - The CiviCRM Extension Builder tool

## Authors

* **John Twyman** - *Initial work*

## License

This project is licensed under the AGPL-3.0 License.

