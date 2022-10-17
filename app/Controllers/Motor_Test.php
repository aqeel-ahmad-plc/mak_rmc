<?php namespace App\Controllers;

use App\Models\Motor_Test_model;
use App\Models\No_Load_Test_model;
use App\Models\Load_Test_model;


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

				'specified_temp' => 'required',
				'winding_resistance' => 'required',
				'temp_at_which_winding_resistance_measured' => 'required',

			];

			if (! $this->validate($rules)) {
				$data['validation'] = $this->validator;
			}else{
				$model = new Motor_Test_model();

				$rated_curves_array = array(


					"shaft_power_p2_1" => $this->request->getVar("shaft_power_p2_1"),
					"shaft_power_p2_2" => $this->request->getVar("shaft_power_p2_2"),
					"shaft_power_p2_3" => $this->request->getVar("shaft_power_p2_3"),
					"shaft_power_p2_4" => $this->request->getVar("shaft_power_p2_4"),
					"shaft_power_p2_5" => $this->request->getVar("shaft_power_p2_5"),
					"shaft_power_p2_6" => $this->request->getVar("shaft_power_p2_6"),
					"shaft_power_p2_7" => $this->request->getVar("shaft_power_p2_7"),

					"efficiency_in_percent_1" => $this->request->getVar("efficiency_in_percent_1"),
					"efficiency_in_percent_2" => $this->request->getVar("efficiency_in_percent_2"),
					"efficiency_in_percent_3" => $this->request->getVar("efficiency_in_percent_3"),
					"efficiency_in_percent_4" => $this->request->getVar("efficiency_in_percent_4"),
					"efficiency_in_percent_5" => $this->request->getVar("efficiency_in_percent_5"),
					"efficiency_in_percent_6" => $this->request->getVar("efficiency_in_percent_6"),
					"efficiency_in_percent_7" => $this->request->getVar("efficiency_in_percent_7"),


					"speed_in_rpm_1" => $this->request->getVar("speed_in_rpm_1"),
					"speed_in_rpm_2" => $this->request->getVar("speed_in_rpm_2"),
					"speed_in_rpm_3" => $this->request->getVar("speed_in_rpm_3"),
					"speed_in_rpm_4" => $this->request->getVar("speed_in_rpm_4"),
					"speed_in_rpm_5" => $this->request->getVar("speed_in_rpm_5"),
					"speed_in_rpm_6" => $this->request->getVar("speed_in_rpm_6"),
					"speed_in_rpm_7" => $this->request->getVar("speed_in_rpm_7"),

					"current_in_amps_1" => $this->request->getVar("current_in_amps_1"),
					"current_in_amps_2" => $this->request->getVar("current_in_amps_2"),
					"current_in_amps_3" => $this->request->getVar("current_in_amps_3"),
					"current_in_amps_4" => $this->request->getVar("current_in_amps_4"),
					"current_in_amps_5" => $this->request->getVar("current_in_amps_5"),
					"current_in_amps_6" => $this->request->getVar("current_in_amps_6"),
					"current_in_amps_7" => $this->request->getVar("current_in_amps_7"),


					"cos_in_percent_1" => $this->request->getVar("cos_in_percent_1"),
					"cos_in_percent_2" => $this->request->getVar("cos_in_percent_2"),
					"cos_in_percent_3" => $this->request->getVar("cos_in_percent_3"),
					"cos_in_percent_4" => $this->request->getVar("cos_in_percent_4"),
					"cos_in_percent_5" => $this->request->getVar("cos_in_percent_5"),
					"cos_in_percent_6" => $this->request->getVar("cos_in_percent_6"),
					"cos_in_percent_7" => $this->request->getVar("cos_in_percent_7")

				);

				$rated_curves_json = json_encode($rated_curves_array);

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
					'specified_temp' => $this->request->getVar('specified_temp'),
					'winding_resistance' => $this->request->getVar('winding_resistance'),
					'temp_at_which_winding_resistance_measured' => $this->request->getVar('temp_at_which_winding_resistance_measured'),
					'rated_curves' => $rated_curves_json,
					'rated_curves_flag' => ($this->request->getVar('rated_curves_checkbox') == null)? 0 : 1,
					'test_description' => $this->request->getVar('test_description')
				];

				$motor_pic = $this->request->getFile('motor_pic');
				$motor_pic->move('./public/assets/uploads');
				$motor_pic_name = $motor_pic->getName();
				$newData['motor_pic'] = $motor_pic_name;
				// print_r($newData);

				$model->insert($newData);
				$session = session();
				$session->setFlashdata('success', 'Test data entered successfully');
				return redirect()->to(base_url().'/motor_test/manage');
			}
		}


        echo view('templates/header', $data);
        echo view('templates/sidebar');
				echo view('motor_test/create');
				echo view('templates/footer');
	}

	public function manage(){

			$motor_tests_model    = new Motor_Test_model();
			$motor_tests  		= $motor_tests_model->getMotorTest();

			$data['motor_tests'] 	= $motor_tests ;
			echo view('templates/header', $data);
			echo view('templates/sidebar');
			echo view('motor_test/manage');
			echo view('templates/footer');
	}



	public function no_load_test($test_id){

		$motor_tests_model    = new Motor_Test_model();

		if ($this->request->getMethod() == 'post') {
			//let's do the validation here

				$model = new No_Load_Test_model();

				$newData = [
					'rpm_no_load' => $this->request->getVar('rpm_no_load'),
					'torque' => 0,
					'shaft_power' => 0,
					'loading_factor' => 0,
					'motor_size_no_load' => $this->request->getVar('motor_size_no_load'),
					'voltage_a' => $this->request->getVar('voltage_a'),
					'voltage_b' => $this->request->getVar('voltage_b'),
					'voltage_c' => $this->request->getVar('voltage_c'),
					'averge_voltage' => $this->request->getVar('averge_voltage'),
					'voltage_ab' => $this->request->getVar('voltage_ab'),
					'voltage_bc' => $this->request->getVar('voltage_bc'),
					'voltage_ca' => $this->request->getVar('voltage_ca'),
					'averge_voltage_phase_to_phase' => $this->request->getVar('averge_voltage_phase_to_phase'),
					'current_a' => $this->request->getVar('current_a'),
					'current_b' => $this->request->getVar('current_b'),
					'current_c' => $this->request->getVar('current_c'),
					'total_current' => $this->request->getVar('total_current'),
					'pf_a' => $this->request->getVar('pf_a'),
					'pf_b' => $this->request->getVar('pf_b'),
					'pf_c' => $this->request->getVar('pf_c'),
					'average_pf' => $this->request->getVar('average_pf'),
					'power_a' => $this->request->getVar('power_a'),
					'power_b' => $this->request->getVar('power_b'),
					'power_c' => $this->request->getVar('power_c'),
					'average_power' => $this->request->getVar('average_power'),
					'frequency' => $this->request->getVar('frequency'),
					'amb_temperature' => $this->request->getVar('amb_temperature'),
					'motor_temperature' => $this->request->getVar('motor_temperature'),
					'estimated_efficiency' => 0,
					'motor_test_fk' => $this->request->getVar('test_id')
				];



        $test_id = $this->request->getVar('test_id');

//				print_r($newData);


				$model->insert($newData);
				$updateData = [];
				$updateData['test_status'] = 1;

				$motor_tests_model->updateNoLoadTest($this->request->getVar('test_id'), $updateData);
				$session = session();
				$session->setFlashdata('success', 'No load test data saved');
				return redirect()->to(base_url().'/motor_test/load_test/'.$test_id);

		}
		  $data['test_id'] = $test_id;
			echo view('templates/header');
			echo view('templates/sidebar');
			echo view('motor_test/no_load_test', $data);
			echo view('templates/footer');
	}

	public function load_test($test_id){

		if ($this->request->getMethod() == 'post') {
			//let's do the validation here

				$model = new Load_Test_model();

				$newData = [
					'rpm_load' => $this->request->getVar('rpm_load'),
					'torque' => 0,
					'shaft_power' => 0,
					'loading_factor' => 0,
					'motor_size_load' => $this->request->getVar('motor_size_load'),
					'voltage_a' => $this->request->getVar('voltage_a'),
					'voltage_b' => $this->request->getVar('voltage_b'),
					'voltage_c' => $this->request->getVar('voltage_c'),
					'averge_voltage' => $this->request->getVar('averge_voltage'),
					'voltage_ab' => $this->request->getVar('voltage_ab'),
					'voltage_bc' => $this->request->getVar('voltage_bc'),
					'voltage_ca' => $this->request->getVar('voltage_ca'),
					'averge_voltage_phase_to_phase' => $this->request->getVar('averge_voltage_phase_to_phase'),
					'current_a' => $this->request->getVar('current_a'),
					'current_b' => $this->request->getVar('current_b'),
					'current_c' => $this->request->getVar('current_c'),
					'total_current' => $this->request->getVar('total_current'),
					'pf_a' => $this->request->getVar('pf_a'),
					'pf_b' => $this->request->getVar('pf_b'),
					'pf_c' => $this->request->getVar('pf_c'),
					'average_pf' => $this->request->getVar('average_pf'),
					'power_a' => $this->request->getVar('power_a'),
					'power_b' => $this->request->getVar('power_b'),
					'power_c' => $this->request->getVar('power_c'),
					'average_power' => $this->request->getVar('average_power'),
					'frequency' => $this->request->getVar('frequency'),
					'amb_temperature' => $this->request->getVar('amb_temperature'),
					'motor_temperature' => $this->request->getVar('motor_temperature'),
					'estimated_efficiency' => 0,
					'motor_test_fk' => $this->request->getVar('test_id')
				];



				$test_id = $this->request->getVar('test_id');

				$model->insert($newData);
				$session = session();
				$session->setFlashdata('success', 'No load test data saved');
				return redirect()->to(base_url().'/motor_test/load_test/'.$test_id);

		}
			$data['test_id'] = $test_id;
			echo view('templates/header');
			echo view('templates/sidebar');
			echo view('motor_test/load_test', $data);
			echo view('templates/footer');
	}




}
