<?php
namespace App\Controllers;

use App\Models\Auth_model;

class Auth extends BaseController
{
    private function setUserSession($user)
    {
		$data = [
			'id' => $user['id'],
			'firstname' => $user['firstname'],
			'lastname' => $user['lastname'],
			'email' => $user['email'],
			'isLoggedIn' => true,
			'role' => $user['role'],
		];

		session()->set($data);
		return true;
    }

	public function index()
	{

        echo view('templates/header');
        echo view('auth/login');
        echo view('templates/footer');
    }

    public function login()
	{
        $data = [];
        if ($this->request->getMethod() == 'post')
        {
            $rules =
            [
				'email' => 'required|min_length[6]|max_length[50]|valid_email',
				'password' => 'required|min_length[8]|max_length[255]|validateUser[email,password]',
			];

            $errors =
            [
                'password' => [
					'validateUser' => 'Email or Password doesn\'t match'
				]
			];

            if (! $this->validate($rules, $errors))
            {
				$data['validation'] = $this->validator;
            }
            else
            {
				$model = new Auth_model();

				$user = $model->where('email', $this->request->getVar('email'))
											->first();

				$this->setUserSession($user);
				return redirect()->to(base_url().'/dashboard');

			}
		}

        echo view('templates/header', $data);
        echo view('auth/login');
        echo view('templates/footer');
	}

	public function logout()
	{
		session()->destroy();
		return redirect()->to(base_url()."/auth/login");
	}
}
