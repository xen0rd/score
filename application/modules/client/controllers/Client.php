<?php
/**
 *
 * @author Dean Manalo
 * @version Client 1.0.0
 *
 */
class Client extends MX_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->module('auth');
	}
	
	public function index(){
		$this->session->set_flashdata('referrer', current_url());
		render("client.page", "client.template");
	}
	
	public function register(){
		$this->session->set_flashdata('referrer', current_url());
		render("registration.form","default.template");
	}
	
	public function changePassword(){
		if($this->session->userdata('c_username')){
			if($this->input->post(NULL, TRUE)){
				if($this->form_validation->run('change_client_password')){
					$username = $this->session->userdata('c_username');
					$newPassword = $this->input->post('new_password');
					$hashedPassword = $this->bcrypt->hash_password($newPassword);
					if($this->auth_model->updatePassword($username, $hashedPassword)){
						$this->session->set_flashdata('success_message', 'Password change successful');
						redirect('client');
					}
					else{
						$this->session->set_flashdata('error_message', 'A problem occurred while changing your password');
						redirect('client');
					}
				}
				else{
					render('client/change_password.form', 'client.template');
				}
			}
			else{
				render('client/change_password.form', 'client.template');
			}
		}
		else{
			echo "ERROR 403 FORBIDDEN";
		}
	}

	public function profileSettings(){
		if($this->session->userdata('c_username')){
			$username = $this->session->userdata('c_username');
			
			if($this->input->post(NULL, TRUE)){
				if($this->form_validation->run('profile_settings')){
					unset($_POST['first_name']);
					unset($_POST['last_name']);
					unset($_POST['date_of_birth']);
					if($this->auth_model->updateUserInfo($this->input->post(NULL, TRUE), $username)){
						$this->session->set_flashdata('success_message', 'Profile has been successfully updated');
						redirect("client");
					}
					else{
						//$this->session->set_flashdata('error_message', 'An error occurred');
						redirect("client");
					}
				}
				else{
					$data['userInfo'] = $this->auth_model->userInfo($username);
					render('client/profile_settings.form', 'client.template', $data);
				}
			}
			else{
				$data['userInfo'] = $this->auth_model->userInfo($username);
				render('client/profile_settings.form', 'client.template', $data);
			}
		}
		else{
			echo "ERROR 403 FORBIDDEN";
		}	
	}
	
	public function accountSettings(){
		if($this->session->userdata('c_username')){
			$username = $this->session->userdata('c_username');
			
			if($this->input->post(NULL, TRUE)){
				if($this->form_validation->run('account_settings')){
					unset($_POST['username']);
					$currentEmail = $this->auth_model->userInfo($username)->email;
					 
					if($currentEmail == $this->input->post('new_email', TRUE)){
						unset($_POST['new_email']);
						$_POST['security_answer'] = $this->encryption->encrypt($this->input->post('security_answer', TRUE));
						if($this->auth_model->updateUserInfo($this->input->post(NULL, TRUE), $username)){
							$this->session->set_flashdata('success_message', 'Your account has been updated');
							redirect("client");
						}
						else{
							redirect("client");
						}
					}
					else{
						$_POST['security_answer'] = $this->encryption->encrypt($this->input->post('security_answer', TRUE));
						if($this->auth_model->updateUserInfo($this->input->post(NULL, TRUE), $username)){
							$this->auth->sendEmailVerification($username);
							$this->session->set_flashdata('success_message', 'An email has been sent to you, follow the link to verify your new email address');
							redirect("client");
						}
						else{
							redirect("client");
						}
					}
					
				}
				else{
					$data['userInfo'] = $this->auth_model->userInfo($username);
					render('client/account_settings.form', 'client.template', $data);
				}
			}
			else{
				$data['userInfo'] = $this->auth_model->userInfo($username);
				render('client/account_settings.form', 'client.template', $data);
			}
		}
		else{
			echo "ERROR 403 FORBIDDEN";
		}	
	}
	
	public function removePendingEmail(){
		$username = $this->session->userdata('c_username');
		if($this->auth_model->deleteUserPendingEmail($username)){
			$this->session->set_flashdata('success_message', 'Pending email removed');
			redirect("account_settings");
		}else{
			$this->session->set_flashdata('error_message', 'An error occured while trying to remove pending email');
			redirect("account_settings");
		}
	}
	
}
?>