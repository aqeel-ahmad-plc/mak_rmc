<?php namespace App\Controllers;

use App\Models\Sites_model;

class Sites extends BaseController
{
    public function create()
	{
        $data = [];

		if ($this->request->getMethod() == 'post') {
			$rules = [
				'site_id'           => 'required|max_length[255]|unique_site_id[site_id]',
				'package'           => 'required',
				'client'            => 'required|min_length[3]|max_length[255]',
				'consultant'        => 'required|min_length[3]|max_length[255]',
                'contractor'        => 'required|min_length[3]|max_length[255]',
                'masgid'            => 'required|min_length[3]|max_length[255]',
                'district'          => 'required|min_length[3]|max_length[255]',
                'tehsil'            => 'required|min_length[3]|max_length[255]',
                'uc_vc_name_and_no' => 'required|max_length[255]',
                'na_pk'             => 'required|max_length[255]',
                'focal_person'      => 'required|min_length[3]|max_length[255]',
                'contact'           => 'required|min_length[3]|max_length[255]',

            ];
            $errors =
            [
                'site_id' => [
					'unique_site_id' => 'Site ID must be unique. A record with the entered Site ID already exists'
				]
			];

			if (! $this->validate($rules, $errors)) {
				$data['validation'] = $this->validator;
			}else{
				$model = new Sites_model();

				$newData = [
                    'site_id'           => $this->request->getVar('site_id'),
                    'package'           => $this->request->getVar('package'),
                    'client'            => $this->request->getVar('client'),
                    'consultant'        => $this->request->getVar('consultant'),
                    'contractor'        => $this->request->getVar('contractor'),
                    'masgid'            => $this->request->getVar('masgid'),
                    'district'          => $this->request->getVar('district'),
                    'tehsil'            => $this->request->getVar('tehsil'),
                    'uc_vc_name_and_no' => $this->request->getVar('uc_vc_name_and_no'),
                    'na_pk'             => $this->request->getVar('na_pk'),
                    'focal_person'      => $this->request->getVar('focal_person'),
                    'contact'           => $this->request->getVar('contact'),
                    'slug'              => url_title($this->request->getVar('site_id'))
                ];

                $model->save($newData);
				$session = session();
				$session->setFlashdata('success', 'Created Successfully');
				return redirect()->to(base_url().'/sites/manage');

			}
        }

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('sites/create');
		echo view('templates/footer');
    }

    public function manage()
	{
        $model          = new Sites_model();
        $data['sites']  = $model->getSites();

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('sites/manage');
		echo view('templates/footer');
    }

    public function edit($site_id)
	{
		$data 			= [];
		$model          = new Sites_model();
        $data['site']   = $model->getSites($site_id);

		if ($this->request->getMethod() == 'post') {
			$rules = [
				'site_id'           => 'required|max_length[255]',
				'package'           => 'required',
				'client'            => 'required|min_length[3]|max_length[255]',
				'consultant'        => 'required|min_length[3]|max_length[255]',
                'contractor'        => 'required|min_length[3]|max_length[255]',
                'masgid'            => 'required|min_length[3]|max_length[255]',
                'district'          => 'required|min_length[3]|max_length[255]',
                'tehsil'            => 'required|min_length[3]|max_length[255]',
                'uc_vc_name_and_no' => 'required|max_length[255]',
                'na_pk'             => 'required|max_length[255]',
                'focal_person'      => 'required|min_length[3]|max_length[255]',
                'contact'           => 'required|min_length[3]|max_length[255]',

			];

			if (! $this->validate($rules)) {
				$data['validation'] = $this->validator;
			}else{
				$model = new Sites_model();

				$newData = [
                    'site_id'           => $this->request->getVar('site_id'),
                    'package'           => $this->request->getVar('package'),
                    'client'            => $this->request->getVar('client'),
                    'consultant'        => $this->request->getVar('consultant'),
                    'contractor'        => $this->request->getVar('contractor'),
                    'masgid'            => $this->request->getVar('masgid'),
                    'district'          => $this->request->getVar('district'),
                    'tehsil'            => $this->request->getVar('tehsil'),
                    'uc_vc_name_and_no' => $this->request->getVar('uc_vc_name_and_no'),
                    'na_pk'             => $this->request->getVar('na_pk'),
                    'focal_person'      => $this->request->getVar('focal_person'),
                    'contact'           => $this->request->getVar('contact'),
                    'slug'              => url_title($this->request->getVar('site_id'))
                ];

                $model->updateSite($site_id, $newData);
				$session = session();
				$session->setFlashdata('success', 'Updated Successfully');
				return redirect()->to(base_url().'/sites/manage');

			}
        }

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('sites/edit');
		echo view('templates/footer');
	}

	public function delete($site_id)
	{
		$model          = new Sites_model();
		$model->deleteSite($site_id);
		$session = session();
		$session->setFlashdata('success', 'Deleted Successfully');
		return redirect()->to(base_url().'/sites/manage');
	}
}
