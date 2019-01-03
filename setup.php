<?php
/* ================================================================ */
/*    GLPI Checking Version - Plugin GLPI - Développé par FleuryK   */
/*      © 2018 - https://github.com/FleuryK/GLPICheckingVersion     */
/* ================================================================ */

define ('PLUGIN_GLPICHECKINGVERSION_VERSION', '1.0.1');

function plugin_init_glpicheckingversion() {
	global $PLUGIN_HOOKS, $CFG_GLPI;

	Plugin::registerClass('PluginGlpicheckingversionGlpicheckingversion');

	$PLUGIN_HOOKS['csrf_compliant']['glpicheckingversion'] = true;
	$PLUGIN_HOOKS['menu_toadd']['glpicheckingversion'] = ['plugins' => 'PluginGlpicheckingversionGlpicheckingversion'];
	// Add to 'admin' menu
	$PLUGIN_HOOKS['config_page']['glpicheckingversion'] = "front/glpicheckingversion.php";
}

function plugin_version_glpicheckingversion() {
	return [
		'name'           => 'GLPI Checking Version',
		'version'        => PLUGIN_GLPICHECKINGVERSION_VERSION,
		'author'         => 'FleuryK',
		'license'        => 'GPLv2+',
		'homepage'       => 'https://github.com/FleuryK/GLPICheckingVersion',
		'requirements'   => [
			'glpi' => [
				'min' => '9.2',
				'dev' => true
			]
		]
	];
}

function plugin_glpicheckingversion_check_prerequisites() {
	$version = rtrim(GLPI_VERSION, '-dev');
	if (version_compare($version, '9.2', 'lt')) {
		echo "This plugin requires GLPI 9.2";
		return false;
	}

	return true;
}

function plugin_glpicheckingversion_check_config($verbose = false) {
	if ($verbose) {
		echo __('Installed / not configured', 'glpicheckingversion');
	}
	return true;
}
?>