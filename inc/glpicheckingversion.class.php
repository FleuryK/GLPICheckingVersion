<?php
/* ================================================================ */
/*    GLPI Checking Version - Plugin GLPI - Développé par FleuryK   */
/*      © 2018 - https://github.com/FleuryK/GLPICheckingVersion     */
/* ================================================================ */

class PluginGlpicheckingversionGlpicheckingversion extends CommonDBTM {
	static function getMenuContent() {
		global $CFG_GLPI;
		$menu = [];

		// get Menu name :
		$tab = plugin_version_glpicheckingversion();
		$menu['title'] = $tab["name"];

		$menu['page']  = '/plugins/glpicheckingversion/front/glpicheckingversion.php';

		if (Session::haveRight($_SESSION["glpi_plugin_glpicheckingversion_profile"], READ)) {
			$menu['options']['model']['title'] = self::getTypeName(1);
			$menu['options']['model']['page'] = Toolbox::getItemTypeSearchUrl('PluginGlpicheckingversionGlpicheckingversion', false);
			$menu['options']['model']['links']['search'] = Toolbox::getItemTypeSearchUrl('PluginGlpicheckingversionGlpicheckingversion', false);

			if (Session::haveRight($_SESSION["glpi_plugin_example_profile"], UPDATE)) {
				$menu['options']['model']['links']['add'] = Toolbox::getItemTypeFormUrl('PluginGlpicheckingversionGlpicheckingversion', false);
			}
		}

		return $menu;
	}
}
?>