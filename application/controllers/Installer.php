<?php
/**
 * Synthia v2.0 Installer
 * @author Dean Manalo
 *
 */
class Installer extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->library("session");
		$this->load->library("form_validation");
		$this->load->helper("file");
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		if(!is_dir("tmp")){
			mkdir("tmp");
		}
	}
	
	public function index(){
		$data['checked'] = array();
	 
		$extensions = array("mysqli", "mcrypt", "mbstring", "gd", "PDO", "dom", "curl");
		$enabledExtensions = array_intersect(get_loaded_extensions(), $extensions);
		foreach($enabledExtensions as $val){
			array_push($data['checked'], $val);
		}
		
		(int)phpversion() === 7 ? array_push($data['checked'], "php7") : NULL;
		in_array("mod_php7", apache_get_modules()) ? array_push($data['checked'], "mod_php7") : NULL;
		is_writable(realpath(__DIR__ . '/../config/database.php')) ? array_push($data['checked'], "database") : NULL;
		is_writable(realpath(__DIR__ . '/../config/config.php')) ? array_push($data['checked'], "config") : NULL;
		is_writable(realpath(__DIR__ . '/../config/routes.php')) ? array_push($data['checked'], "routes") : NULL;
		is_writable(realpath(__DIR__ . '/../config/autoload.php')) ? array_push($data['checked'], "autoload") : NULL;
		is_writable(realpath(__DIR__ . '/../../.htaccess')) ? array_push($data['checked'], "htaccess") : NULL;

		$this->load->view('installer', $data);
	}
	
	public function database(){
		$host = $this->input->post("host", TRUE);
		$username = $this->input->post("username", TRUE);
		$password = $this->input->post("password", TRUE);
		$database = $this->input->post("database", TRUE);
		$con = @mysqli_connect($host,$username,$password,$database);
		
		if(!$con){
			@mysqli_close($con);
			echo 0;
		}
		else{
			$config = array("host" => $host,
							"username" => $username,
							"password" => $password,
							"database" => $database);
			
			$fo = fopen('tmp/database', 'w');
			fwrite($fo, json_encode($config));
			fclose($fo);
			
			@mysqli_close($con);
			echo 1;
		}
	}
	
	public function license(){
		$postData = http_build_query($this->input->post(NULL, TRUE));
		/* $url = "";
		
		$init = curl_init();
		curl_setopt($init, CURLOPT_URL, $url);
		curl_setopt($init, CURLOPT_POST, 1);
		curl_setopt($init, CURLOPT_POSTFIELDS, $postData);
		curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec ($init);
		curl_close ($init); */
		$server_output = TRUE;
		if($server_output == TRUE){
			$config = array("username" => $this->input->post("lic_username", TRUE)
							"license_key" => $this->input->post("lic_key", TRUE));
			
			$fo = fopen('tmp/license', 'w');
			fwrite($fo, json_encode($config));
			fclose($fo);
			
			echo 1;
		}
		else{
			echo 0;
		} 
		
	}
	
	public function settings(){
		$config = array("domain" => $this->input->post("set_domain", TRUE),
				"first_name" => $this->input->post("set_first_name", TRUE),
				"last_name" => $this->input->post("set_last_name", TRUE),
				"username" => $this->input->post("set_username", TRUE),
				"password" => $this->input->post("set_password", TRUE),
				"email" => $this->input->post("set_email", TRUE),
				"smtp_user" => $this->input->post("smtp_user", TRUE),
				"smtp_pass" => $this->input->post("smtp_pass", TRUE),
				"smtp_port" => $this->input->post("smtp_port", TRUE),
				"smtp_host" => $this->input->post("smtp_host", TRUE));
			
		$fo = fopen('tmp/settings', 'w');
		fwrite($fo, json_encode($config));
		fclose($fo);
				
		echo $this->completeInstallation();
	}
	
	protected function completeInstallation(): bool{
		if($this->writeDatabaseConfig()){
			if($this->initializeDB() == TRUE && $this->writeModularCore() == TRUE && $this->modifyHTACCESS() == TRUE){
				
				$data = json_decode(file_get_contents("tmp/settings"));
				$this->session->set_flashdata("success_message", sprintf("You have successfully set up %s.", $data->domain));
				
				$this->writeRoutes();
				$this->unlinkInstaller();
			
				return 1;
			}
			else{
				return 0;
			}
		}
		
		return 0;
	}
	
	protected function unlinkInstaller(){
		unlink('./application/controllers/Installer.php');
		unlink('./application/models/Installer_model.php');
		unlink('./application/views/installer.php');
		unlink('./tmp/database');
		unlink('./tmp/license');
		unlink('./tmp/settings');
		unlink('./tmp/install.sql');
		rmdir('./tmp');
	}
	
	protected function writeDatabaseConfig(): bool{
		$db = json_decode(file_get_contents("tmp/database"));
		$dbdata = file_get_contents('./application/config/database.php');
		$dbdata = str_replace('db_name', $db->database, $dbdata);
		$dbdata = str_replace('db_user', $db->username, $dbdata);
		$dbdata = str_replace('db_pass', $db->password, $dbdata);                     
		$dbdata = str_replace('db_host', $db->host, $dbdata);
		return write_file('./application/config/database.php', $dbdata, 'w');
	}
	
	protected function initializeDB(): bool{
		$this->load->database();
		
		$templine = '';
		$lines = file('tmp/install.sql');
		foreach ($lines as $line)
		{
			if (substr($line, 0, 2) == '--' || $line == '')
				continue;
				$templine .= $line;
				if (substr(trim($line), -1, 1) == ';')
				{
					$this->db->query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysqli_error() . '<br /><br />');
					$templine = '';
				}
		
		}
		if($this->createAdmin() == TRUE && $this->serverConfig() == TRUE && $this->addLicense() == TRUE){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	protected function modifyHTACCESS(): bool{
		$subfolder = str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']); 
		if(!empty($subfolder)){
			$data = '<IfModule mod_rewrite.c>
			RewriteEngine On
			RewriteBase '.$subfolder.'
			RewriteCond %{REQUEST_URI} ^system.*
			RewriteRule ^(.*)$ /index.php?/$1 [L]

			RewriteCond %{REQUEST_URI} ^application.*
			RewriteRule ^(.*)$ /index.php?/$1 [L]
									 
			RewriteCond %{REQUEST_FILENAME} !-f
			RewriteCond %{REQUEST_FILENAME} !-d
			RewriteRule ^(.*)$ index.php?/$1 [L]
			</IfModule>
									 
			<IfModule !mod_rewrite.c>
			ErrorDocument 404 /index.php
			</IfModule>';
			return write_file('./.htaccess', $data, 'w');
		}
    }
	
	protected function writeConfig(): bool{
		
	}
	
	protected function writeAutoload(): bool{
		
	}
	
	protected function writeRoutes(): bool{
		$data = file_get_contents('./application/config/routes.php');
		$data = str_replace('installer', 'client', $data);
		return write_file('./application/config/routes.php', $data, 'w');
	}
	
	protected function writeModularCore(): bool{
		$loader = "<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

			/* load the MX_Loader class */
			require APPPATH.'third_party/MX/Loader.php';

			class MY_Loader extends MX_Loader {}";

		$router = "<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

			/* load the MX_Router class */
			require APPPATH.'third_party/MX/Router.php';

			class MY_Router extends MX_Router {}";

		$loaderStatus = write_file('./application/core/MY_Loader.php', $loader, 'w');
		$routerStatus = write_file('./application/core/MY_Router.php', $router, 'w');

		if($loaderStatus == TRUE && $routerStatus == TRUE){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	protected function createAdmin(): bool{
		$data = json_decode(file_get_contents("tmp/settings"));
		$this->load->library("bcrypt");
		$hashedPassword = $this->bcrypt->hash_password($data->password);
		
		$firstName = $data->first_name;
		$lastName = $data->last_name;
		$username = $data->username;
		$password = $hashedPassword;
		$email = $data->email;
		
		$this->load->model("installer_model");
		return $this->installer_model->addAdmin($username, $password, $firstName, $lastName, $email);
	}
	
	protected function serverConfig(): bool{
		$data = json_decode(file_get_contents("tmp/settings"));
		$encryptedPassword = $this->encryption->encrypt($data->smtp_pass);
		
		$appName = $data->domain;
		$smtpHost = $data->smtp_host;
		$smtpUser = $data->smtp_user;
		$smtpPass = $encryptedPassword;
		$smtpPort = $data->smtp_port;
		
		$this->load->model("installer_model");
		return $this->installer_model->addServerConfig($appName, $smtpHost, $smtpUser, $smtpPass, $smtpPort);
	}
	
	protected function addLicense(){
		$data = json_decode(file_get_contents("tmp/license"));
		
		$username = $data->username;
		$key = $data->license_key;
		
		$license = $username . "~" . $key;
		$encryptedLicense = $this->encryption->encrypt($license);
		return $this->installer_model->addLicense($encryptedLicense);
	}
	
	
}
?>
