<?php

class Users extends Controller
{
	function Users()
	{
		parent::Controller();
		$this->load->model('Post');
		$this->load->model('User');
		$this->header = $this->load->view('header', array('postCount' => 0, 'perPage' => 0), true);
		$this->data['recentPosts'] = $this->Post->getLatestEntries(5);
		$this->data['recentComments'] = $this->Post->getLatestComments(5);
		$this->sidebar = $this->load->view('sidebar', $this->data, true);
	}
	
	function register()
	{
		$data = array('header' => $this->header, 'sidebar' => $this->sidebar, 'errors' => false);
		$this->load->view('users/register', $data);
	}
	
	function create()
	{
		if (!empty($_POST['name']) AND !empty($_POST['email']) AND !empty($_POST['password']))
		{
			$_POST['group'] = 'user';
			$_POST['joindate'] = time();
			$_POST['password'] = md5(md5($_POST['password']) . $_POST['joindate']);
			if ($this->db->insert('user', $_POST))
			{
				redirect(base_url()."users/login");
			}
		}
		else
		{
			$errors = "Please fill all the fields.";
			$data = array('header' => $this->header, 'sidebar' => $this->sidebar, 'errors' => $errors);
			$this->load->view('users/register', $data);
		}
	}
	
	function login()
	{
		if (!empty($_POST))
		{
			// do we have a user with this email?
			$user = $this->User->find_by_email($_POST['email']);
			if ($user)
			{
				// do the passwords match?
				if ($user['password'] == md5(md5($_POST['password']) . $user['joindate']))
				{
					$this->session->set_userdata('user', $user);
					redirect(base_url());
				}
				else
				{
					$errors[] = 'Password is incorrect.';
				}
			}
			else
			{
				$errors[] = 'No user matched.';
			}
			if (!empty($errors))
			{
				$data = array('header' => $this->header, 'sidebar' => $this->sidebar, 'errors' => $errors);
				$this->load->view('user/login', $data);
			}
		}
		else
		{
			$data = array('header' => $this->header, 'sidebar' => $this->sidebar, 'errors' => false);
			$this->load->view('users/login', $data);
		}
	}
	
	function logout()
	{
		if ($this->session->userdata('user'))
		{
			$this->session->unset_userdata('user');
			redirect(base_url());
		}
	}
	
	
}



?>
