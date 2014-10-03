<?php
/***
* Plugin Name: DB Backup
* Description: Plugin for Database Backup.
* Version: 4.2
* Author: Syed Amir Hussain
***/
if ( ! defined('ABSPATH') ) {
	die('Please do not load this file directly.');
}
define('plugin_name', 'DB-Backup');
define('SLASH_N', "--\n");
if(!class_exists('DB_Backup')) {	
	class DB_Backup {
		function __construct() {
			if( is_admin() ) {
				// hook for adding admin menus
				add_action('admin_menu', array( $this, 'am_add_pages' ));
				add_action( 'admin_init', array( $this, 'am_init_css_js' ) );
				// action hook to handle ajax request
				add_action( 'wp_ajax_myAjax', array( $this, 'am_handleRequest' ) );
				// action hook to add option
				register_activation_hook( __FILE__, array( $this, 'am_update_option' ) );
			}
		}
		function am_update_option(){
				$array = wp_upload_dir();
				update_option('am_upload_path', str_replace('\\', '/', $array['basedir']));
		}
		function am_add_pages() {
			// add a new top-level menu
			add_menu_page('DB Backup', 'DB Backup', 'manage_options', 'db-backup', array( &$this, 'am_get_option' ) );
		}
		// action function to include css and js
		function am_init_css_js() {
			wp_register_style( 'style', plugins_url('/css/style.css', __FILE__));
			wp_enqueue_style( 'style' );
			wp_register_script( 'js_', plugins_url('/js/js.js', __FILE__));
			wp_enqueue_script( 'js_' );
		}
		// action function displays the page content for the Make CSV
		function am_get_option() {
			global $wpdb;
			//must check that the user has the required capability 
			if (!current_user_can('manage_options'))
			{
			  wp_die( __('You do not have sufficient permissions to access this page.') );
			}
			$this->am_echo_option( $option );
		}
		function am_get_tables( $exclude_prefix = false ){
			global $wpdb;
			$sql = 'SHOW TABLES LIKE "%"';
			$results = $wpdb->get_results($sql);
			$tables = array();
			foreach($results as $index => $value) {
				foreach($value as $tableName) {
					if( $exclude_prefix ){
						$tableName = str_replace($wpdb->prefix, '', $tableName);
					}
					$tables[] = $tableName;
				}
			}
			if(count( array_filter($tables) )){
				return $tables;
			}
			die('Error! there is no tables in the selected database.');
		}
		// action function to create dropdown of the tables
		function am_echo_option() {
			$option = '<div class="wrap"><h2>DB Backup</h2></div><p class="am_csv_alerts"></p><form name="am_csv" id="am_csv" method="post" class="am_csv" action="handle_req.php" onsubmit="return false;"><div class="am_option_container">
			<div class="am_option_container_left width_13">
			<select name="am_csv_tbl[]" id="am_csv_tbl" size="10" multiple="multiple">';
			$tables = $this->am_get_tables( $exclude_prefix = true );
			foreach($tables as $tableName) {
				$tableName = str_replace( $wpdb->prefix, '', $tableName );
				$val = trim(strtolower($tableName ));
				$tableName = trim( $tableName );
				$option .= '<option value="'.$val.'">'.$tableName.'</option>';
			}
			$option .= '</select></div><div class="am_option_container_left width_16">
							<div class="border am_mb_13"><input type="checkbox" name="csv_comp_bkp" id="csv_comp_bkp" value="comp_bkp">&nbsp;<label for="csv_comp_bkp">Complete Backup</label></div>
							<fieldset class="am_option am_mb_13 width_93">
								<legend>
									<input type="radio" name="am_option" id="am_option_csv" value="make_csv">&nbsp;<label for="am_option_csv">Make CSV for Excel</label>
								</legend>
								<p>
									<input type="checkbox" name="csv_inc_col" id="csv_inc_col" value="include_column">&nbsp;<label for="csv_inc_col">Include Column</label>
								</p>
							</fieldset>
							<fieldset class="am_option width_93">
								<legend>
									<input type="radio" name="am_option" id="am_option_ex" value="export">&nbsp;<label for="am_option_ex">Export</label>
								</legend>
								<p>
									<input type="checkbox" name="ex_struct" id="ex_struct" value="only_structure">&nbsp;<label for="ex_struct">Structure</label>
								</p>
								<p>
									<input type="checkbox" name="ex_data" id="ex_data" value="only_data">&nbsp;<label for="ex_data">Data</label>
								</p>
							</fieldset>
							</div>
					</div>
						<div class="am_option_container">
						<fieldset class="am_saveAs width_24_2 float-left">
							<legend>
							<input type="checkbox" value="save_as" name="am_saveAs_option" clas="am_saveAs_option" id="am_saveAs_option" >&nbsp;<label for="am_saveAs_option">Save As</label>
							</legend>
							<p><div class="width_87px float-left"><label for="am_saveAs_fileName">File Name :</label></div> <input type="text" name="am_saveAs_fileName" class="am_saveAs_fileName" id="am_saveAs_fileName" disabled /></p>
							<p><label for="am_saveAs_zip">Compression :</label> <select id="am_saveAs_zip" name="am_saveAs_zip" disabled ><option value="none">None</option><option value="zipped">zipped</option></select></p>
						</fieldset>
						<p class="w-7 mt_87 float-left" align="right"><input type="submit" name="make_csv" class="button" id="make_csv" value="Backup"></p>
						</div>
						</form>
						<p><form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="ZB42KXQRV72QQ">
<p style="border-top: 1px solid #CCC; padding-top: 10px; width: 450px;">Please donate us to help you better.</p>
<fieldset style="border:1px solid #CCC;; width:182px;">
<legend><input type="hidden" name="on0" value="Donation Amount"><b>Donation Amount</b></legend>
<table>
<tr><td><select name="os0">
	<option value="Tiny">Tiny $1.00 USD</option>
	<option value="Very Small">Very Small $5.00 USD</option>
	<option value="Small">Small $10.00 USD</option>
	<option value="Medium">Medium $20.00 USD</option>
	<option value="Large">Large $25.00 USD</option>
</select> </td></tr>
</table>
<input type="hidden" name="currency_code" value="USD">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
</form>
</fieldset>
</p>
<p>For database management please download : <a href="http://wordpress.org/plugins/wp-dbmyadmin/" target="_blank">WP dbMyAdmin</a></p>
						<div class="am_csv_output"></div>';
			echo $option;	
		}
		function am_handleRequest() {
			parse_str($_POST[data], $_POST);
			if( 'comp_bkp' == $_POST['csv_comp_bkp'] ){
				$tables = $this->am_get_tables( $exclude_prefix = true );
				$_POST['am_csv_tbl'] = array_merge( array(), $tables );
			}
			$func = 'am_'.$_POST[am_option];
			foreach( $_POST[am_csv_tbl] as $tab ):
				$output .= $this->$func( $tab )."\n\n";
			endforeach;
			if( "save_as" == $_POST[am_saveAs_option] ):
				$jsResponse = $this->am_make_download( $output, $ext = $_POST[am_option] );
			else:
				$jsResponse = '<textarea class="am_csv_output_area">'.$output.'</textarea>';
			endif;
			echo $jsResponse;
			die;	
		}
		// action function to make sql query
		function am_export( $tbl ) {
			global $wpdb;
			$result_col = $wpdb->get_results('SHOW COLUMNS FROM '.$wpdb->prefix.$tbl);
			$struct = "";	$data = "";
			if( 'only_structure' == $_POST[ex_struct] ) {
				$struct .= SLASH_N.'-- Table structure for table `'.$wpdb->prefix.$tbl."`\n".SLASH_N.'CREATE TABLE `'.$wpdb->prefix.$tbl."` (\n";
				foreach ($result_col as $row) {
					$null = ($row->Null == 'NO') ? ' NOT NULL' : '';
					$pri = ($row->Key == 'PRI') ? ' PRIMARY KEY' : '';
					$default = ($row->Default != '') ? ' DEFAULT "'.$row->Default.'"' : '';
					$extra = ($row->Extra != '') ? ' '.$row->Extra.' ' : '';
					$struct .= '`'.$row->Field.'` '.$row->Type.$null.$default.$extra.$pri.",\n";
				}
				$struct = rtrim($struct, ",\n");
				$struct .= "\n) ENGINE = MYISAM;\n\n";
			}
			if( 'only_data' == $_POST[ex_data] ) {
				$rs_data = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.$tbl, ARRAY_A);
				if( $rs_data ){
					$fields = "";
					foreach ($result_col as $row) {
						$fields .= '`'.$row->Field.'`, ';
					}
					$fields = rtrim($fields, ', ');
					
					$values = "";
					foreach( $rs_data as $val ){
						$values .= "(";
						foreach( $val as $v ):
							$v = htmlentities(mysql_real_escape_string($v));
							$values .= '"'.$v.'", ';
						endforeach;
						$values = rtrim($values, ', ');
						$values .= "),\n";
					}
					$values = rtrim($values, ",\n");
					$data .= SLASH_N.'-- Dumping data for table `'.$wpdb->prefix.$tbl."`\n".SLASH_N.'INSERT INTO `'.$wpdb->prefix.$tbl.'`( '.$fields." ) VALUES\n".$values.';';
				}
			}
			$query = $struct.$data;
			return $query;
		}
		// action function to make the csv
		function am_make_csv( $tbl ) {
			global $wpdb;
			$data = "";
			if( 'include_column' == $_POST[csv_inc_col] ){
				$result_col = $wpdb->get_results('SHOW COLUMNS FROM '.$wpdb->prefix.$tbl);
				foreach( $result_col as $col ){
					$data .= '"'.$col->Field.'",';
				}
				$data = rtrim($data, ',');
				$data .= "\n";
			}
			$rs_data = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.$tbl, ARRAY_A);
			if( $rs_data ){
				$values = "";
				foreach( $rs_data as $val ){
					foreach( $val as $v ):
						$v = mysql_real_escape_string(htmlentities($v));
						if( empty($v) ){
							$v = 'NULL';
						}
						$values .= '"'.$v.'",';
					endforeach;
					$values = rtrim($values, ',');
					$values .= "\n";
				}
				$data .= $values;
			}
			return $data;
		}
		// action to download export file
		function am_make_download( $content = "", $ext ){
			$fileName = 'am_'.time();
			if( "" != $_POST[am_saveAs_fileName] ) {
				$fileName = $_POST[am_saveAs_fileName].'_'.time();
			}
			$ext = ( $ext == 'make_csv' )?'.csv':'.sql';
			$fileName = $this->am_make_file($fileName, $ext, $content);
			$url = plugins_url(plugin_name.'/download.php');
			$url .= '?file='.content_url().'/uploads/'.$fileName;
			$this->prn_js( $url );
		}
		// action to make file
		function am_make_file( $fileName, $ext, $content ){
			$path = get_option('am_upload_path').'/'.$fileName.$ext;
			$fp = fopen($path, 'w');
			fwrite( $fp, $content);
			fclose($fp);
			# make zip
			if( 'zipped' == $_POST['am_saveAs_zip'] ){
				return $this->am_make_zip( $fileName, $ext );
			}
			return $fileName.$ext;
		}
		function am_make_zip( $fileName, $ext ){
			$zip = new ZipArchive();
			$path = get_option('am_upload_path').'/'.$fileName.$ext;
			$zip_name = $fileName.'.zip';
			$zip_path = get_option('am_upload_path').'/'.$zip_name;
			$zip->open($zip_path, ZipArchive::CREATE);
			$zip->addFromString(basename($path),  file_get_contents($path));
			$zip->close();
			unlink( $path );
			return $zip_name;
		}
		function prn_js( $url ){
			print<<<EOM
				<script>
					window.location.href = "$url";
				</script>
EOM;
		}
	}
	new DB_Backup();
}
?>