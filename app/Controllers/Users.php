<?php namespace App\Controllers;

use App\Models\Users_model;


class Users extends BaseController
{
	public function create(){
		$data = [];

		if ($this->request->getMethod() == 'post') {
			//let's do the validation here
			$rules = [
				'firstname' => 'required|min_length[3]|max_length[20]',
                'lastname' => 'required|min_length[3]|max_length[20]',
                'username' => 'required|min_length[3]|max_length[20]',
				'email' => 'required|min_length[6]|max_length[50]|valid_email',
				'password' => 'required|min_length[8]|max_length[255]',
                'confirm_password' => 'matches[password]',
                'phone' => 'required|min_length[8]|max_length[255]',
				'gender' => 'required',
				'role' => 'required',
			];

			if (! $this->validate($rules)) {
				$data['validation'] = $this->validator;
			}else{
				$model = new Users_model();

				$newData = [
					'firstname' => $this->request->getVar('firstname'),
                    'lastname' => $this->request->getVar('lastname'),
                    'username' => $this->request->getVar('username'),
					'email' => $this->request->getVar('email'),
                    'password' => $this->request->getVar('password'),
                    'phone' => $this->request->getVar('phone'),
					'gender' => $this->request->getVar('gender'),
					'role' => $this->request->getVar('role'),
				];

				$model->insert($newData);
				$session = session();
				$session->setFlashdata('success', 'User created successfully');
				return redirect()->to(base_url().'/users/manage');
			}
		}


        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('users/create');
		echo view('templates/footer');
	}

	public function manage()
	{
		$data 			= [];
        $model          = new Users_model();
        $data['users']  = $model->getUsers();
		
        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('users/manage');
		echo view('templates/footer');
	}

	public function edit($user_id)
	{
		$data 			= [];
		$model          = new Users_model();
        $data['user']  = $model->getUsers($user_id);
		
		if ($this->request->getMethod() == 'post') {
			//let's do the validation here
			$rules = [
				'firstname' => 'required|min_length[3]|max_length[20]',
                'lastname' => 'required|min_length[3]|max_length[20]',
                'username' => 'required|min_length[3]|max_length[20]',
				'email' => 'required|min_length[6]|max_length[50]|valid_email',
				'password' => 'required|min_length[8]|max_length[255]',
                'confirm_password' => 'matches[password]',
                'phone' => 'required|min_length[8]|max_length[255]',
				'gender' => 'required',
				'role' => 'required',
			];

			if (! $this->validate($rules)) {
				$data['validation'] = $this->validator;
			}else{
				$model = new Users_model();

				$newData = [
					'firstname' => $this->request->getVar('firstname'),
                    'lastname' => $this->request->getVar('lastname'),
                    'username' => $this->request->getVar('username'),
					'email' => $this->request->getVar('email'),
                    'password' => $this->request->getVar('password'),
                    'phone' => $this->request->getVar('phone'),
					'gender' => $this->request->getVar('gender'),
					'role' => $this->request->getVar('role'),
				];

				$model->updateUser($user_id, $newData);
				$session = session();
				$session->setFlashdata('success', 'Updated Successfully');
				return redirect()->to(base_url().'/users/manage');
			}
		}

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('users/edit');
		echo view('templates/footer');
	}
	
	public function delete($user_id)
	{
		$model          = new Users_model();
		$model->deleteUser($user_id);
		$session = session();
		$session->setFlashdata('success', 'Deleted Successfully');
		return redirect()->to(base_url().'/users/manage');
	}

}