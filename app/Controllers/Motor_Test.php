<?php namespace App\Controllers;

use App\Models\Motor_Test_model;


class Motor_Test extends BaseController
{
	public function create(){
		$data = [];

		if ($this->request->getMethod() == 'post') {
			//let's do the validation here
			$rules = [
				'test_report_no' => 'required|min_length[2]|max_length[200]',
        'test_date' => 'required',
        'motor_manufacturer' => 'required',
        'motor_model' => 'required',
        'motor_type' => 'required',
        'stator_size' => 'required',


        'number_of_phase' => 'required',
        'motor_rated_kw' => 'required',
        'motor_rated_hp' => 'required',
        'motor_rated_voltage' => 'required',

        'motor_rated_frequency' => 'required',
        'motor_rated_current' => 'required',
        'motor_rated_pf' => 'required',
        'motor_rated_rpm' => 'required',

        'no_of_poles' => 'required',
        'efficiency' => 'required',
        'service_factor' => 'required',
        'insulation_class' => 'required',

        'cooling_class' => 'required',
        'ip_rating' => 'required',
        'connection_type' => 'required',
        'motor_sno' => 'required',
				'motor_pic' => [
						'label' => 'Motor Pic',
						'rules' => 'uploaded[motor_pic]|max_size[motor_pic, 1024]|is_image[motor_pic]'
					]
			];

			if (! $this->validate($rules)) {
				$data['validation'] = $this->validator;
			}else{
				$model = new Motor_Test_model();

				$newData = [
					'test_report_no' => $this->request->getVar('test_report_no'),
          'test_date' => $this->request->getVar('test_date'),
          'motor_manufacturer' => $this->request->getVar('motor_manufacturer'),
          'motor_model' => $this->request->getVar('motor_model'),
          'motor_type' => $this->request->getVar('motor_type'),
          'stator_size' => $this->request->getVar('stator_size'),


          'number_of_phase' => $this->request->getVar('number_of_phase'),
          'motor_rated_kw' => $this->request->getVar('motor_rated_kw'),
          'motor_rated_hp' => $this->request->getVar('motor_rated_hp'),
          'motor_rated_voltage' => $this->request->getVar('motor_rated_voltage'),

          'motor_rated_frequency' => $this->request->getVar('motor_rated_frequency'),
          'motor_rated_current' => $this->request->getVar('motor_rated_current'),
          'motor_rated_pf' => $this->request->getVar('motor_rated_pf'),
          'motor_rated_rpm' => $this->request->getVar('motor_rated_rpm'),

          'no_of_poles' => $this->request->getVar('no_of_poles'),
          'efficiency' => $this->request->getVar('efficiency'),
          'service_factor' => $this->request->getVar('service_factor'),
          'insulation_class' => $this->request->getVar('insulation_class'),

          'cooling_class' => $this->request->getVar('cooling_class'),
          'ip_rating' => $this->request->getVar('ip_rating'),
          'connection_type' => $this->request->getVar('connection_type'),
          'motor_sno' => $this->request->getVar('motor_sno'),

				];

				$motor_pic = $this->request->getFile('motor_pic');
				//$motor_pic->move('./assets/uploads');
				$motor_pic_name = $motor_pic->getName();
				$newData['motor_pic'] = $motor_pic_name;
				// print_r($newData);

				$model->insert($newData);
				$session = session();
				$session->setFlashdata('success', 'Test created successfully');
				return redirect()->to(base_url().'/motor_test/create');
			}
		}


        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('motor_test/create');
		echo view('templates/footer');
	}



}
