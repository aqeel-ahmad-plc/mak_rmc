<?php namespace App\Controllers;

use App\Models\Sites_model;
use App\Models\Serveys_model;
use App\Models\Handing_Taking_model;

class Handing_Taking extends BaseController
{
	public function show()
	{
		$handing_taking_model  	= new Handing_Taking_model();
        $data['handing_takings']   = $handing_taking_model->getHandingTakings();

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('handing_taking/show');
		echo view('templates/footer');
	}

	public function approval()
	{
		$data = [];
		$serveys_model      = new Serveys_model();
		$data['serveys']    = $serveys_model->getServeys();

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('serveys/approval');
		echo view('templates/footer');
	}

	public function view_handing_taking($id)
	{
		$handing_taking_model  	= new Handing_Taking_model();
        $data['handing_taking']    = $handing_taking_model->getHandingTakings($id);

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('handing_taking/view_handing_taking');
		echo view('templates/footer');
	}

    public function manage()
	{
		$data 			= [];
		$sites_model    = new Sites_model();
		$data['sites']  = $sites_model->getFatAcceptedSites();
        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('handing_taking/manage');
		echo view('templates/footer');
    }

    public function create($site_id)
	{
		$data 			= [];
		$sites_model    = new Sites_model();
        $data['site']   = $sites_model->getSites($site_id);

		if ($this->request->getMethod() == 'post') {
			$rules = [
                'handing_over_date' => [
						'label' => 'Handing/Taking Over Date',
						'rules' => 'required'
				],
                'handed_over_by' => [
						'label' => 'Handed Over By (Contractor)',
						'rules' => 'required|max_length[255]'
				],
                'take_over_by'               => [
						'label' => 'Taken Over by (Beneficiary)',
						'rules' => 'required|max_length[255]'
				],
                'beneficiary_cnic'                       => [
						'label' => 'Beneficiary CNIC',
						'rules' => 'required|max_length[255]'
				],
                'beneficiary_pic_pv_module'          => [
						'label' => 'Beneficiary Pic with PV Modules',
						'rules' => 'uploaded[beneficiary_pic_pv_module]|max_size[beneficiary_pic_pv_module, 1024]|is_image[beneficiary_pic_pv_module]'
				],
                'beneficiary_pic_inverter'          => [
						'label' => 'Beneficiary Pic with Inverter',
						'rules' => 'uploaded[beneficiary_pic_inverter]|max_size[beneficiary_pic_inverter, 1024]|is_image[beneficiary_pic_inverter]'
				],
                'beneficiary_pic_fan_lights'                  => [
						'label' => 'Beneficiary Pic with Fan/Lights',
						'rules' => 'uploaded[beneficiary_pic_fan_lights]|max_size[beneficiary_pic_fan_lights, 1024]|is_image[beneficiary_pic_fan_lights]'
				],
				'handing_over_certificate'                  => [
						'label' => 'Handing/Taking Over Certificate Pic',
						'rules' => 'uploaded[handing_over_certificate]|max_size[handing_over_certificate, 1024]|is_image[handing_over_certificate]'
				]

			];

			if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
			}else{
				$handing_taking_model = new Handing_Taking_model();
                
                $beneficiary_pic_pv_module = $this->request->getFile('beneficiary_pic_pv_module');
                $beneficiary_pic_pv_module->move('./assets/uploads');
				$beneficiary_pic_pv_module_name = $beneficiary_pic_pv_module->getName();

                $beneficiary_pic_inverter = $this->request->getFile('beneficiary_pic_inverter');
                $beneficiary_pic_inverter->move('./assets/uploads');
				$beneficiary_pic_inverter_name = $beneficiary_pic_inverter->getName();

                $beneficiary_pic_fan_lights = $this->request->getFile('beneficiary_pic_fan_lights');
                $beneficiary_pic_fan_lights->move('./assets/uploads');
				$beneficiary_pic_fan_lights_name = $beneficiary_pic_fan_lights->getName();

                $handing_over_certificate = $this->request->getFile('handing_over_certificate');
                $handing_over_certificate->move('./assets/uploads');
				$handing_over_certificate_name = $handing_over_certificate->getName();

                $newData = [
					'handing_over_date'           	=> $this->request->getVar('handing_over_date'),
					'handed_over_by'           	=> $this->request->getVar('handed_over_by'),
					'take_over_by'           	=> $this->request->getVar('take_over_by'),
					'beneficiary_cnic'           	=> $this->request->getVar('beneficiary_cnic'),
					'beneficiary_pic_pv_module'     => $beneficiary_pic_pv_module_name,
					'beneficiary_pic_inverter'     => $beneficiary_pic_inverter_name,
					'beneficiary_pic_fan_lights'     => $beneficiary_pic_fan_lights_name,
					'handing_over_certificate'     => $handing_over_certificate_name,
                    'site_id'                       => $this->request->getVar('site_id'),
                ];

                $handing_taking_model->save($newData);
                $handing_taking_status = ['handing_taking_status' => 1];
                $sites_model->updateSiteStatus($this->request->getVar('site_id'), $handing_taking_status);
				$session = session();
				$session->setFlashdata('success', 'Site Handing/Taking Completed Successfully');
				return redirect()->to(base_url().'/handing_taking/manage');

			}
        }

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('handing_taking/create');
		echo view('templates/footer');
	}

	public function edit($id)
	{
		$data 						= [];
		$handing_taking_model  	= new Handing_Taking_model();
		$data['handing_taking']  = $handing_taking_model->getHandingTakings($id);
		
		if ($this->request->getMethod() == 'post') {
			$rules = [
                'handing_over_date' => [
						'label' => 'Handing/Taking Over Date',
						'rules' => 'required'
				],
				'handed_over_by' => [
						'label' => 'Handed Over By (Contractor)',
						'rules' => 'required|max_length[255]'
				],
				'take_over_by'               => [
						'label' => 'Taken Over by (Beneficiary)',
						'rules' => 'required|max_length[255]'
				],
				'beneficiary_cnic'                       => [
						'label' => 'Beneficiary CNIC',
						'rules' => 'required|max_length[255]'
				]
            ];
            
			$beneficiary_pic_pv_module_obj = dot_array_search('beneficiary_pic_pv_module.name', $_FILES);
			if($beneficiary_pic_pv_module_obj != ''){
				$img = ['beneficiary_pic_pv_module'  => [
						'label' => 'Beneficiary Pic with PV Modules',
						'rules' => 'uploaded[beneficiary_pic_pv_module]|max_size[beneficiary_pic_pv_module, 1024]|is_image[beneficiary_pic_pv_module]'
					]
				];
				$rules = array_merge($rules, $img);
            }
            
			$beneficiary_pic_inverter_obj = dot_array_search('beneficiary_pic_inverter.name', $_FILES);
			if($beneficiary_pic_inverter_obj != ''){
				$img = ['beneficiary_pic_inverter'  => [
						'label' => 'Beneficiary Pic with Inverter',
						'rules' => 'uploaded[beneficiary_pic_inverter]|max_size[beneficiary_pic_inverter, 1024]|is_image[beneficiary_pic_inverter]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$beneficiary_pic_fan_lights_obj = dot_array_search('beneficiary_pic_fan_lights.name', $_FILES);
			if($beneficiary_pic_fan_lights_obj != ''){
				$img = ['beneficiary_pic_fan_lights'  => [
						'label' => 'Beneficiary Pic with Fan/Lights',
						'rules' => 'uploaded[beneficiary_pic_fan_lights]|max_size[beneficiary_pic_fan_lights, 1024]|is_image[beneficiary_pic_fan_lights]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$handing_over_certificate_obj = dot_array_search('handing_over_certificate.name', $_FILES);
			if($handing_over_certificate_obj != ''){
				$img = ['handing_over_certificate'  => [
						'label' => 'Handing/Taking Over Certificate Pic',
						'rules' => 'uploaded[handing_over_certificate]|max_size[handing_over_certificate, 1024]|is_image[handing_over_certificate]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
			}else{
				$fat_model  	= new Handing_Taking_model();

				$newData = [
                    'handing_over_date'	=> $this->request->getVar('handing_over_date'),
                    'handed_over_by'    => $this->request->getVar('handed_over_by'),
                    'take_over_by'      => $this->request->getVar('take_over_by'),
                    'beneficiary_cnic'	=> $this->request->getVar('beneficiary_cnic'),
                    'site_id'           => $this->request->getVar('site_id'),
				];

                if($beneficiary_pic_pv_module_obj != ''){
					$beneficiary_pic_pv_module = $this->request->getFile('beneficiary_pic_pv_module');
					$beneficiary_pic_pv_module->move('./assets/uploads');
					$beneficiary_pic_pv_module_name = $beneficiary_pic_pv_module->getName();
					$newData['beneficiary_pic_pv_module'] = $beneficiary_pic_pv_module_name;
                }
                
				if($beneficiary_pic_inverter_obj != ''){
					$beneficiary_pic_inverter = $this->request->getFile('beneficiary_pic_inverter');
					$beneficiary_pic_inverter->move('./assets/uploads');
					$beneficiary_pic_inverter_name = $beneficiary_pic_inverter->getName();
					$newData['beneficiary_pic_inverter'] = $beneficiary_pic_inverter_name;
				}

				if($beneficiary_pic_fan_lights_obj != ''){
					$beneficiary_pic_fan_lights = $this->request->getFile('beneficiary_pic_fan_lights');
					$beneficiary_pic_fan_lights->move('./assets/uploads');
					$beneficiary_pic_fan_lights_name = $beneficiary_pic_fan_lights->getName();
					$newData['beneficiary_pic_fan_lights'] = $beneficiary_pic_fan_lights_name;
				}

				if($handing_over_certificate_obj != ''){
					$handing_over_certificate = $this->request->getFile('handing_over_certificate');
					$handing_over_certificate->move('./assets/uploads');
					$handing_over_certificate_name = $handing_over_certificate->getName();
					$newData['handing_over_certificate'] = $handing_over_certificate_name;
				}

                $handing_taking_model->updateHandingTaking($this->request->getVar('site_id'), $newData);
				$session = session();
				$session->setFlashdata('success', 'Handing/Taking Updated Successfully');
				return redirect()->to(base_url().'/handing_taking/manage');

			}
        }

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('handing_taking/edit');
		echo view('templates/footer');
	}

	public function approve($site_id)
	{
		$serveys_model = new Serveys_model();

		$servey_status = ['status' => 1];
		$serveys_model->updateServeyStatus($site_id, $servey_status);
		$session = session();
		$session->setFlashdata('success', 'Servey Status Updated Successfully');
		return redirect()->to(base_url().'/serveys/approval');
	}

	public function reject($site_id)
	{
		$serveys_model = new Serveys_model();

		$servey_status = ['status' => 2];
		$serveys_model->updateServeyStatus($site_id, $servey_status);
		$session = session();
		$session->setFlashdata('success', 'Servey Status Updated Successfully');
		return redirect()->to(base_url().'/serveys/approval');

	}
}
