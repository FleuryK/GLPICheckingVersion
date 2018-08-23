<?php
/* ================================================================ */
/*    GLPI Checking Version - Plugin GLPI - Développé par FleuryK   */
/*      © 2018 - https://github.com/FleuryK/GLPICheckingVersion     */
/* ================================================================ */

function plugin_glpicheckingversion_install() {
	global $DB;
	
	$config = new Config();
	$config->setConfigurationValues('plugin:Glpicheckingversion', ['configuration' => false]);

	return true;
}

function plugin_glpicheckingversion_uninstall() {
	global $DB;
	
	$config = new Config();
	$config->deleteConfigurationValues('plugin:Glpicheckingversion', ['configuration' => false]);

	return true;
}
?>