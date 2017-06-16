<?php
/**
 *
 * @author Dean Manalo
 * @version Updater 1.0.1
 *
 */
class Updater extends MX_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('updater_model');
		$this->load->library('unzip');
		if(!is_dir("backup")){
			mkdir("backup");
		}
		if(!is_dir("tmp")){
			mkdir("tmp");
		}
	}
	
	public function check(): bool{
		//Get username, password and key from database; It must be encrypted and will be decrypted here.
		//$this->encryption->encrypt(username~key);
		/* $encryptedData = $this->updater_model->accountInfo();
		$decryptedData = $this->encryption->decrypt($encryptedData);
		$dataPart = explode("~", $decryptedData);
		$_POST['username'] = $dataPart[0];
		$_POST['key'] = $dataPart[1];
		
		
		$url = "";
		$init = curl_init();
		curl_setopt($init, CURLOPT_URL, $url);
		curl_setopt($init, CURLOPT_POST, 1);
		curl_setopt($init, CURLOPT_POSTFIELDS, $_POST);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Synthia-Version: ' . _SYNTHIA_VERSION));
		curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec($init);
		curl_close ($init); */
		
		//TEST RETURN
		$server_output = FALSE;
		
		return $server_output;
	}
		
	public function download(){
		$url = "http://192.168.140.2/_assets/update.zip";
		$data = @file_get_contents($url);
		$destination = "tmp/update.zip";
		if($data !== FALSE){
			$file = fopen($destination, "w+");
			fputs($file, $data);
			return fclose($file);
		}
		return FALSE;
	}
	
	public function install(){
		$status = $this->unzip->extract('tmp/update.zip', './');
		if($status){
			$this->session->set_flashdata("success_message", "Updates has been successfully installed. Check logs for more information.");
		}
	}
	
	public function appBackup(){
		$this->recursiveCopy('application', 'backup/app-' . date('mdYHis'));
	}
	
	protected function recursiveCopy($src, $dst) {
		if(file_exists($dst)){
			rmdir($dst);
		}
		if(is_dir($src)){
			mkdir ($dst);
			$files = scandir($src);
			foreach($files as $file)
			if($file != "." && $file != "..")
			$this->recursiveCopy("$src/$file", "$dst/$file");
		}
		else if(file_exists($src)){
			copy($src,$dst);
		}
	}
	
}
	