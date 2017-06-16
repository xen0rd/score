<?php
/**
 *
 * @author Dean Manalo
 * @version User_model 1.0.0
 *
 */
class User_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function roles(){
		$sql = "SELECT * FROM role";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	public function departments(){
		$sql = "SELECT * FROM department";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	public function adminSkin(string $username){
		$sql = "SELECT admin_theme_id FROM user WHERE username = ?";
		$query = $this->db->query($sql, array($username));
		return $query->num_rows() > 0 ? $query->row() : false;
	}
	
	public function updateSkin(string $username, string $skin){
		$sql = "UPDATE user SET admin_theme_id = ? WHERE username = ?";
		$query = $this->db->query($sql, array($skin, $username));
		return $this->db->affected_rows() > 0 ? TRUE : FALSE;
	}
	
	public function updateSMTPConfig(string $host, string $user, string $pass, int $port): bool{
		$sql = "UPDATE server_config SET smtp_host = ?, smtp_user = ?, smtp_pass = ?, smtp_port = ? WHERE environment = ?";
		$query = $this->db->query($sql, array($host, $user, $pass, $port, _ENVIRONMENT));
		return $this->db->affected_rows() > 0 ? TRUE : FALSE;
	}
	
	public function SMTPConfig(){
		$sql = "SELECT * FROM server_config WHERE environment = ?";
		$query = $this->db->query($sql, array(_ENVIRONMENT));
		return $query->num_rows() > 0 ? $query->row() : FALSE;
	}
	
	public function title(){
		$sql = "SELECT app_name FROM server_config WHERE environment = ?";
		$query = $this->db->query($sql, array(_ENVIRONMENT));
		return $query->num_rows() > 0 ? $query->row() : FALSE;
	}
	
}
?>