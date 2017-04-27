<?php
/**
 *
 * @author Dean Manalo
 * @version User 1.0.0
 *
 */
class User extends MX_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->module('auth');
		$this->load->model('user_model');
		
	}
	
	public function index(){
		if(!$this->auth->isUserLoggedIn()){
			render("login", "default.template");
		}
		else{
			$data['menu']['id'] = "dashboard";
			$data['menu']['description'] = "Dashboard";
			
			$data['userInfo'] = $this->auth_model->userInfo($this->session->userdata("u_username"));
			$data['sidebar'] = $this->load->view("sidebar/sidebar.php", $data, TRUE);
			render("dashboard.page", "user.template", $data);
		}
	}
	
	public function tickets(){
		$data['menu']['id'] = "tickets";
		$data['menu']['description'] = "Tickets";
		
		$data['userInfo'] = $this->auth_model->userInfo($this->session->userdata("u_username"));
		$data['sidebar'] = $this->load->view("sidebar/sidebar.php", $data, TRUE);
		render("tickets.page", "user.template", $data);
	}
	
	public function configuration(){
		$data['menu']['id'] = "configuration";
		$data['menu']['description'] = "Configuration";
		$data['userInfo'] = $this->auth_model->userInfo($this->session->userdata("u_username"));
		$page = null;
	
		if($this->uri->segment(3) === "smtp"){
			$page = "smtp_configuration.page";
			
			if($this->input->post(NULL, TRUE)){
				if($this->form_validation->run('smtp_config')){
					$encryptedPassword = $this->encryption->encrypt($this->input->post('smtp_pass', TRUE));
					$host = $this->input->post('smtp_host', TRUE);
					$user = $this->input->post('smtp_user', TRUE);
					$pass = $encryptedPassword;
					$port = $this->input->post('smtp_port', TRUE);
					if($this->user_model->updateSMTPConfig($host, $user, $pass, $port)){
						$this->session->set_flashdata('success_message', 'SMTP configuration updated');
						redirect('admin');
					}
					else{
						redirect("admin");
					}
				}
				else{
					$data['smtp'] = $this->user_model->SMTPConfig();
					$data['subMenu']['id'] = "smtp_configuration";
					$data['subMenu']['description'] = "SMTP configuration";
					$data['sidebar'] = $this->load->view("sidebar/sidebar.php", $data, TRUE);
				}
			}
			else{
				$data['smtp'] = $this->user_model->SMTPConfig();
				$data['subMenu']['id'] = "smtp_configuration";
				$data['subMenu']['description'] = "SMTP configuration";
				$data['sidebar'] = $this->load->view("sidebar/sidebar.php", $data, TRUE);
			}
		}
		else if($this->uri->segment(3) === "theme"){
			$page = "theme.page";
			$data['subMenu']['id'] = "theme";
			$data['subMenu']['description'] = "Theme";
			$data['sidebar'] = $this->load->view("sidebar/sidebar.php", $data, TRUE);
		}
			
		render($page, "user.template", $data);
	}
	
	public function changePassword(){
		if($this->session->userdata('u_username')){
			if($this->input->post(NULL, TRUE)){
				if($this->form_validation->run('change_user_password')){
					$username = $this->session->userdata('u_username');
					$newPassword = $this->input->post('new_password');
					$hashedPassword = $this->bcrypt->hash_password($newPassword);
					if($this->auth_model->updatePassword($username, $hashedPassword)){
						$this->session->set_flashdata('success_message', 'Password change successful');
						redirect('admin');
					}
					else{
						$this->session->set_flashdata('error_message', 'A problem occurred while changing your password');
						redirect('admin');
					}
				}
				else{
					$data['menu']['id'] = "change_password";
					$data['menu']['description'] = "Change Password";
					
					$data['userInfo'] = $this->auth_model->userInfo($this->session->userdata("u_username"));
					$data['sidebar'] = $this->load->view("sidebar/sidebar.php", $data, TRUE);
					render('user/change_password.form', 'user.template', $data);
				}
			}
			else{
				$data['menu']['id'] = "change_password";
				$data['menu']['description'] = "Change Password";
				
				$data['userInfo'] = $this->auth_model->userInfo($this->session->userdata("u_username"));
				$data['sidebar'] = $this->load->view("sidebar/sidebar.php", $data, TRUE);
				render("user/change_password.form", "user.template", $data);
			}
		}
		else{
			echo "ERROR 403 FORBIDDEN";
		}
	}

	public function profileSettings(){
		if($this->session->userdata('u_username')){
			$username = $this->session->userdata('u_username');
			
			if($this->input->post(NULL, TRUE)){
				if($this->form_validation->run('profile_settings')){
					unset($_POST['first_name']);
					unset($_POST['last_name']);
					unset($_POST['date_of_birth']);
					if($this->auth_model->updateUserInfo($this->input->post(NULL, TRUE), $username)){
						$this->session->set_flashdata('success_message', 'Profile has been successfully updated');
						redirect("admin");
					}
					else{
						//$this->session->set_flashdata('error_message', 'An error occurred');
						redirect("admin");
					}
				}
				else{
					$data['menu']['id'] = "profile_settings";
					$data['menu']['description'] = "Profile Settings";
					
					$data['sidebar'] = $this->load->view("sidebar/sidebar.php", $data, TRUE);
					$data['userInfo'] = $this->auth_model->userInfo($username);
					render('user/profile_settings.form', 'user.template', $data);
				}
			}
			else{
				$data['menu']['id'] = "profile_settings";
				$data['menu']['description'] = "Profile Settings";
				
				$data['sidebar'] = $this->load->view("sidebar/sidebar.php", $data, TRUE);
				$data['userInfo'] = $this->auth_model->userInfo($username);
				render('user/profile_settings.form', 'user.template', $data);
			}
		}
		else{
			echo "ERROR 403 FORBIDDEN";
		}	
	}
	
	public function accountSettings(){
		if($this->session->userdata('u_username')){
			$username = $this->session->userdata('u_username');
			
			if($this->input->post(NULL, TRUE)){
				if($this->form_validation->run('account_settings')){
					unset($_POST['username']);
					$currentEmail = $this->auth_model->userInfo($username)->email;
					 
					if($currentEmail == $this->input->post('new_email', TRUE)){
						unset($_POST['new_email']);
						$_POST['security_answer'] = $this->encryption->encrypt($this->input->post('security_answer', TRUE));
						if($this->auth_model->updateUserInfo($this->input->post(NULL, TRUE), $username)){
							$this->session->set_flashdata('success_message', 'Your account has been updated');
							redirect("admin");
						}
						else{
							redirect("admin");
						}
					}
					else{
						$_POST['security_answer'] = $this->encryption->encrypt($this->input->post('security_answer', TRUE));
						if($this->auth_model->updateUserInfo($this->input->post(NULL, TRUE), $username)){
							$this->auth->sendEmailVerification($username);
							$this->session->set_flashdata('success_message', 'An email has been sent to you, follow the link to verify your new email address');
							redirect("admin");
						}
						else{
							redirect("admin");
						}
					}
					
				}
				else{
					$data['menu']['id'] = "account_settings";
					$data['menu']['description'] = "Account Settings";
					
					$data['sidebar'] = $this->load->view("sidebar/sidebar.php", $data, TRUE);
					$data['userInfo'] = $this->auth_model->userInfo($username);
					render('user/account_settings.form', 'user.template', $data);
				}
			}
			else{
				$data['menu']['id'] = "account_settings";
				$data['menu']['description'] = "Account Settings";
				
				$data['sidebar'] = $this->load->view("sidebar/sidebar.php", $data, TRUE);
				$data['userInfo'] = $this->auth_model->userInfo($username);
				render('user/account_settings.form', 'user.template', $data);
			}
		}
		else{
			echo "ERROR 403 FORBIDDEN";
		}	
	}
	
	public function removePendingEmail(){
		$username = $this->session->userdata('u_username');
		if($this->auth_model->deleteUserPendingEmail($username)){
			$this->session->set_flashdata('success_message', 'Pending email removed');
			redirect("admin/account_settings");
		}else{
			$this->session->set_flashdata('error_message', 'An error occured while trying to remove pending email');
			redirect("admin/account_settings");
		}
	}
	
	
	
	public function register(){
		if($this->input->post(NULL, TRUE)){
			if($this->form_validation->run('add_user')){
				unset($_POST['confirm_password']);
				
				$_POST['date_of_birth'] = date_format(new DateTime($this->input->post('date_of_birth')), 'Y-m-d');
				$_POST['password'] = $this->bcrypt->hash_password($this->input->post('password', TRUE));
				$_POST['security_answer'] = $this->encryption->encrypt($this->input->post('security_answer', TRUE));
				if($this->auth_model->addUser($this->input->post(NULL, TRUE))){
					$this->auth->sendEmailVerification($this->input->post('username', TRUE));
					$this->session->set_flashdata("success_message", "Registration successful");
					redirect("admin");
				}
				else{
					$this->session->set_flashdata("error_message", "An error occured while attempting to register user");
					redirect("admin");
				}
			}
			else{
				$data['menu']['id'] = "new_account";
				$data['menu']['description'] = "Create New Account";
				
				$data['sidebar'] = $this->load->view("sidebar/sidebar.php", $data, TRUE);
				$data['roles'] = $this->user_model->roles();
				$data['departments'] = $this->user_model->departments();
				$data['userInfo'] = $this->auth_model->userInfo($this->session->userdata("u_username"));
				render("user/registration.form", "user.template", $data);
			}
		}
		else{
			$data['menu']['id'] = "new_account";
			$data['menu']['description'] = "Create New Account";
			
			$data['sidebar'] = $this->load->view("sidebar/sidebar.php", $data, TRUE);
			$data['roles'] = $this->user_model->roles();
			$data['departments'] = $this->user_model->departments();
			$data['userInfo'] = $this->auth_model->userInfo($this->session->userdata("u_username"));
			render("user/registration.form", "user.template", $data);
		}
	}
	
	public function changeSkin(){
		$username = $this->session->userdata('u_username');
		$skin = $this->input->post('skin_id');
		if($this->user_model->updateSkin($username, $skin)){
			$this->session->set_flashdata('success_message', 'Skin successfully changed');
		}
		else{
			$this->session->set_flashdata('error_message', 'An error occurred while trying to update skin');
		}
		
		redirect('admin');
	}
	
}
?>