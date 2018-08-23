<?php
/* ================================================================ */
/*    GLPI Checking Version - Plugin GLPI - Développé par FleuryK   */
/*      © 2018 - https://github.com/FleuryK/GLPICheckingVersion     */
/* ================================================================ */

include ('../../../inc/includes.php');

Session::checkLoginUser();

if (Session::getCurrentInterface() == "central") {
	Html::header("GLPI Checking Version", $_SERVER['PHP_SELF'], "plugins", "pluginglpicheckingversionglpicheckingversion", "");
} else {
	Html::helpHeader("GLPI Checking Version", $_SERVER['PHP_SELF']);
}
?>

<div class="glpi_tabs new_form_tabs">
	<div id="tabspanel" class="center-h"></div>
	<div id="tabs" class="center vertical ui-tabs ui-widget ui-widget-content ui-corner-all ui-tabs-vertical ui-helper-clearfix ui-corner-left">
		<h1><?php echo __("GLPI Checking Version", "glpicheckingversion"); ?></h1>
		<?php
			global $DB;

			$sql_glpi_v = "SELECT value FROM glpi_configs WHERE name = 'version' AND id = 1";
			$rqt_glpi_v = $DB->query($sql_glpi_v);
			$value_glpi_v = $DB->result($rqt_glpi_v,0,'value');

			$context = stream_context_create(
				array(
					"http" => array(
						"header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
					)
				)
			);

			$latest_version_json = file_get_contents("https://api.github.com/repos/glpi-project/glpi/releases", false, $context);
			$glpi_json = json_decode($latest_version_json);

			echo __('Your version:', 'glpicheckingversion').' <b>'.$value_glpi_v.'</b> <span style="margin-right: 50px;"></span> '.__('Latest version:', 'glpicheckingversion').' <b>'.$glpi_json[0]->{"name"}.'</b><br /><br />';

			if($value_glpi_v == $glpi_json[0]->{"name"}) {
				echo '<img src="http://icons.iconarchive.com/icons/paomedia/small-n-flat/128/sign-check-icon.png" alt="No update" /><br />'.__('Your version of GLPI is up to date. You have nothing to do.', 'glpicheckingversion');
			}
			else {
				// https://forge.glpi-project.org/apidoc/source-class-Session.html
				// EN : If you have a solution for groups (if ... else ...). Only super-admins have a download button
				// FR : Si vous avez une solution pour les groupes (if ... else ...). Seul les super-admins ont le bouton de téléchargement
				
				echo '<img src="http://icons.iconarchive.com/icons/paomedia/small-n-flat/128/sign-error-icon.png" alt="Update available" /><br />'.__('Your version of GLPI is not up to date. Please download this update by clicking the button below.', 'glpicheckingversion').'<br /><br /><a href="'.$glpi_json[0]->{"assets"}[0]->{"browser_download_url"}.'" class="vsubmit" onclick="window.open(this.href); return false;">'.__('Download version', 'glpicheckingversion').' '.$glpi_json[0]->{"name"}.' '.__('of GLPI', 'glpicheckingversion').'</a>';

				/* echo '<img src="http://icons.iconarchive.com/icons/paomedia/small-n-flat/128/sign-error-icon.png" alt="Update available" /><br />'.__('Your version of GLPI is not up to date. Please download this update by clicking the button below.', 'glpicheckingversion').'<br /><br />'.__('Sorry, you have not permission to download. Please contact your administrator for download latest version.', 'glpicheckingversion'); */
			}
		?>
		<div style="margin-top: 20px;"></div>
	</div>
</div>

<?php
	Html::footer();
?>