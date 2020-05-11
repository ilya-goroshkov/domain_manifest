CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Requirements
 * Recommended modules
 * Installation
 * Configuration
 * API
 * Maintainers


INTRODUCTION
------------

Domain Manifest provides some integration for Web Manifest File to Domain module.


REQUIREMENTS
------------

No special requirements.


RECOMMENDED MODULES
-------------------

 * Domain module is needed.


INSTALLATION
------------

 * Install as you would normally install a contributed Drupal module.
   See: https://www.drupal.org/node/895232 for further information.


CONFIGURATION
-------------

Configuration page is /admin/config/development/domain_manifest


API
-----------

Module provides two hooks:

 * hook_domain_manifest_links_alter() - for the altering of the splash screen images links list
 * hook_domain_manifest_icons_alter() - for the altering of the application icons images list

MAINTAINERS
-----------

Current maintainers:
 * Ilya Goroshkov - https://www.drupal.org/u/ilyagoroshkov
 * Test icon images was downloaded from https://github.com/andrebaltieri/pwa-desktop-test
 * Test splash screens images was downloaded from https://github.com/applification/pwa-splash-screens
