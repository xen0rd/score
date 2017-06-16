<?php 
class Installer_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function addAdmin($username, $password, $firstName, $lastName, $email): bool{
		$sql = "INSERT INTO user (username, password, first_name, last_name, email, is_active, role_id, department_id, security_question_id, country_code, admin_theme_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$query = $this->db->query($sql, array($username, $password, $firstName, $lastName, $email, 1, 1, 1, 1, "AD", 1));
		return $this->db->affected_rows() > 0 ? TRUE : FALSE;
	}
	
	public function addServerConfig($appName, $smtpHost, $smtpUser, $smtpPass, $smtpPort): bool{
		$sql = "INSERT INTO server_config (app_name, smtp_host, smtp_user, smtp_pass, smtp_port) VALUES (?, ?, ?, ?, ?)";
		$query = $this->db->query($sql, array($appName, $smtpHost, $smtpUser, $smtpPass, $smtpPort));
		return $this->db->affected_rows() > 0 ? TRUE : FALSE;
	}
	
	public function addLicense($license){
		$sql = "INSERT INTO license (license) VALUES (?)";
		$query = $this->db->query($sql, array($license));
		return $this->db->affected_rows() > 0 ? TRUE : FALSE;
	}
	
}
?>