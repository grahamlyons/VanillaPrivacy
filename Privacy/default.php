<?php if (!defined('APPLICATION')) exit();
/*
Copyright 2008, 2009 Vanilla Forums Inc.
This file is part of Garden.
Garden is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
Garden is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
You should have received a copy of the GNU General Public License along with Garden.  If not, see <http://www.gnu.org/licenses/>.
Contact Vanilla Forums Inc. at support [at] vanillaforums [dot] com
*/

// Define the plugin:
$PluginInfo['Privacy'] = array(
   'Description' => 'Adds the ability to control access to profile and activity pages.',
   'Version' => '1.0',
   'RequiredApplications' => FALSE,
   'RequiredTheme' => FALSE,
   'RequiredPlugins' => FALSE, // This is an array of plugin names/versions that this plugin requires
   'HasLocale' => FALSE, // Does this plugin have any locale definitions?
   'RegisterPermissions' => array('Plugins.Privacy.Profiles','Plugins.Privacy.Activity'), // Permissions that should be added to the application. These will be prefixed with "Plugins.PluginName."
   //'SettingsUrl' => '', // Url of the plugin's settings page.
   //'SettingsPermission' => 'Plugins.PrivateProfiles.Manage', // The permission required to view the SettingsUrl.
   //'PluginUrl' => 'http://',
   'Author' => "Graham Lyons",
   'AuthorEmail' => 'graham@grahamlyons.com',
   'AuthorUrl' => 'http://www.grahamlyons.com'
);

class PrivacyPlugin implements Gdn_IPlugin {

    public function ProfileController_Render_Before(&$Sender) {
        $Session = Gdn::Session();
        
        if(!$Session->CheckPermission('Plugins.Privacy.Profiles')) {
            if (!$Session->IsValid()) {
                Redirect(Gdn::Authenticator()->SignInUrl(Gdn_Url::Request()));
            } else {
                Redirect(Gdn::Config('Routes.DefaultPermission'));
            }
        }
    }

    public function ActivityController_Render_Before(&$Sender) {
        $Session = Gdn::Session();

        if(!$Session->CheckPermission('Plugins.Privacy.Activity')) {
            if (!$Session->IsValid()) {
                Redirect(Gdn::Authenticator()->SignInUrl(Gdn_Url::Request()));
            } else {
                Redirect(Gdn::Config('Routes.DefaultPermission'));
            }
        }
    }

    public function Setup() {
      // No setup required.
    }
}
