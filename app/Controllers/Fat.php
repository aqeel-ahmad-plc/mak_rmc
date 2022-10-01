<?php namespace App\Controllers;

use App\Models\Sites_model;
use App\Models\Serveys_model;
use App\Models\Fat_model;

use FPDF;

class PDF extends FPDF
{
	/* Page header */
	function Header()
	{
		/* Logo */
		$this->Image(base_url().'/assets/images/logo_2.png',10,6,15);
		/* Move to the right */
		$this->Cell(10);
		$this->SetFont('Arial','B',40);
		$this->Cell(50,15,'MAK',0,0,'C');
		$this->Cell(10);
		$this->SetFont('Arial','',25);
		$this->Cell(85 ,15,' Pumps Company (Pvt.) Limited',0,1,'C');
		$this->Line(0, 25, 210, 25);

	}
}

class Fat extends BaseController
{
	public function show()
	{
		$fat_model  	= new Fat_model();
        $data['fats']   = $fat_model->getFats();

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('fat/show');
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

	public function fat_passed_failed()
	{
		$fat_model  	= new Fat_model();
        $data['fats']   = $fat_model->getFats();

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('fat/fat_passed_failed');
		echo view('templates/footer');
	}
	
	public function print_fat_passed_failed($id)
	{
		$fat_model  	= new Fat_model();
		$fats			= $fat_model->getFats();
        $data['fats']   = $fats;

		$pdf = new PDF();
		$pdf->AddPage();
		/*output the result*/

		if ($id == 1) 
		{
			$pdf->SetFont('Arial','B',20);
			$pdf->Cell(50 ,5,'',0,1);
			$pdf->Cell(110 ,5,'FAT-Failed Sites',0,1,'R');
			$pdf->Cell(50 ,5,'',0,1);
			$pdf->SetFont('Arial','B',10);
			/*Heading Of the table*/
			$pdf->Cell(20 ,5,'Sr. No',1,0,'L');
			$pdf->Cell(40 ,5,'Site ID',1,0,'L');
			$pdf->Cell(60 ,5,'Masjid Name',1,0,'L');
			$pdf->Cell(40 ,5,'District',1,1,'L');
			/*Heading Of the table end*/
			$pdf->SetFont('Arial','',8);
			$index  = 0;
			for ($i = 0; $i < sizeof($fats); $i++) {
				if($fats[$i]['fat_result'] == "0")
				{
					$pdf->Cell(20, 5, $index, 1, 0, 'L');
					$pdf->Cell(40, 5, $fats[$i]['siteid'], 1, 0, 'L');
					$pdf->Cell(60, 5, $fats[$i]['masgid'], 1, 0, 'L');
					$pdf->Cell(40, 5, $fats[$i]['district'], 1, 1, 'L');
					$index++;
				}
			}
			if ($index == 0) 
			{
				$pdf->Cell(160, 5, "No FAT_Failed Sites found", 1, 1, 'C');
			}
	
			$pdf->Output('D','FAT_Failed_Sites.pdf');
		}
		elseif($id == 2)
		{
			$pdf->SetFont('Arial','B',20);
			$pdf->Cell(50 ,5,'',0,1);
			$pdf->Cell(110 ,5,'FAT-Passed Sites',0,1,'R');
			$pdf->Cell(50 ,5,'',0,1);
			$pdf->SetFont('Arial','B',10);
			/*Heading Of the table*/
			$pdf->Cell(20 ,5,'Sr. No',1,0,'L');
			$pdf->Cell(40 ,5,'Site ID',1,0,'L');
			$pdf->Cell(60 ,5,'Masjid Name',1,0,'L');
			$pdf->Cell(40 ,5,'District',1,1,'L');
			/*Heading Of the table end*/
			$pdf->SetFont('Arial','',8);
			$index  = 0;
			for ($i = 0; $i < sizeof($fats); $i++) {
				if($fats[$i]['fat_result'] == "1")
				{
					$pdf->Cell(20, 5, $index, 1, 0, 'L');
					$pdf->Cell(40, 5, $fats[$i]['siteid'], 1, 0, 'L');
					$pdf->Cell(60, 5, $fats[$i]['masgid'], 1, 0, 'L');
					$pdf->Cell(40, 5, $fats[$i]['district'], 1, 1, 'L');
					$index++;
				}
			}
			if ($index == 0) 
			{
				$pdf->Cell(160, 5, "No FAT_Passed Sites found", 1, 1, 'C');
			}
	
			$pdf->Output('D','FAT_Passed_Sites.pdf');
		}

		
		echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('fat/fat_passed_failed');
		echo view('templates/footer');
	}

	public function view_fat($id)
	{
		$fat_model  	= new Fat_model();
        $data['fat']    = $fat_model->getFats($id);

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('fat/view_fat');
		echo view('templates/footer');
	}

    public function manage()
	{
		$data 			= [];
		$sites_model    = new Sites_model();
		$data['sites']  = $sites_model->getInstalledSites();
        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('fat/manage');
		echo view('templates/footer');
    }

    public function create($site_id)
	{
		$data 			= [];
		$sites_model    = new Sites_model();
        $data['site']   = $sites_model->getSites($site_id);

		if ($this->request->getMethod() == 'post') {
			$rules = [
                'final_testing_date' => [
						'label' => 'Final Testing Date',
						'rules' => 'required'
				],
                'contractor_rep_name' => [
						'label' => 'Contractor Rep. Name',
						'rules' => 'required|max_length[255]'
				],
                'consultant_rep_name'               => [
						'label' => 'Consultant Rep. Name',
						'rules' => 'required|max_length[255]'
				],
                'client_rep_name'                       => [
						'label' => 'Client Rep. Name',
						'rules' => 'required|max_length[255]'
				],
                'fat_result'             => [
						'label' => 'FAT Result',
						'rules' => 'required'
				]
			];

			if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
			}else{
				$fat_model = new Fat_model();

                $newData = [
                    'final_testing_date'           	=> $this->request->getVar('final_testing_date'),
                    'contractor_rep_name'           => $this->request->getVar('contractor_rep_name'),
                    'consultant_rep_name'           => $this->request->getVar('consultant_rep_name'),
                    'client_rep_name'           	=> $this->request->getVar('client_rep_name'),
                    'fat_result'           			=> $this->request->getVar('fat_result'),
                    'reason_of_rejection'           => $this->request->getVar('reason_of_rejection'),
                    'site_id'                       => $this->request->getVar('site_id'),
                ];

                $fat_model->save($newData);
                $fat_status = ['fat_status' => 1];
                $sites_model->updateSiteStatus($this->request->getVar('site_id'), $fat_status);
				$session = session();
				$session->setFlashdata('success', 'Site FAT Completed Successfully');
				return redirect()->to(base_url().'/fat/fat_images/'.$this->request->getVar('site_id'));

			}
        }

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('fat/create');
		echo view('templates/footer');
	}

	public function fat_images($id)
	{
		$data 						= [];
		$fat_model  	= new Fat_model();
		$data['fat']  = $fat_model->getFats($id);
		
		if ($this->request->getMethod() == 'post') {

			if(isset($_POST['fat_complete']))
			{
				$session = session();
				$session->setFlashdata('success', 'FAT Completed');
				return redirect()->to(base_url().'/fat/manage');
			}

			$rules = [];
            
			$reason_of_rejection_pic_1_obj = dot_array_search('reason_of_rejection_pic_1.name', $_FILES);
			if($reason_of_rejection_pic_1_obj != ''){
				$img = ['reason_of_rejection_pic_1'  => [
						'label' => 'Reason of Rejection (Pic-1)',
						'rules' => 'uploaded[reason_of_rejection_pic_1]|max_size[reason_of_rejection_pic_1, 1024]|is_image[reason_of_rejection_pic_1]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$reason_of_rejection_pic_2_obj = dot_array_search('reason_of_rejection_pic_2.name', $_FILES);
			if($reason_of_rejection_pic_2_obj != ''){
				$img = ['reason_of_rejection_pic_2'  => [
						'label' => 'Reason of Rejection (Pic-2)',
						'rules' => 'uploaded[reason_of_rejection_pic_2]|max_size[reason_of_rejection_pic_2, 1024]|is_image[reason_of_rejection_pic_2]'
					]
				];
				$rules = array_merge($rules, $img);
			}

            
			$fat_report_pic_obj = dot_array_search('fat_report_pic.name', $_FILES);
			if($fat_report_pic_obj != ''){
				$img = ['fat_report_pic'  => [
						'label' => 'PV Modules Pic',
						'rules' => 'uploaded[fat_report_pic]|max_size[fat_report_pic, 1024]|is_image[fat_report_pic]'
					]
				];
				$rules = array_merge($rules, $img);
            }
            
			$pv_module_pic_obj = dot_array_search('pv_module_pic.name', $_FILES);
			if($pv_module_pic_obj != ''){
				$img = ['pv_module_pic'  => [
						'label' => 'PV Modules Pic',
						'rules' => 'uploaded[pv_module_pic]|max_size[pv_module_pic, 1024]|is_image[pv_module_pic]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$storage_inverter_module_pic_obj = dot_array_search('storage_inverter_module_pic.name', $_FILES);
			if($storage_inverter_module_pic_obj != ''){
				$img = ['storage_inverter_module_pic'  => [
						'label' => 'Storage & Inverter Module Pic',
						'rules' => 'uploaded[storage_inverter_module_pic]|max_size[storage_inverter_module_pic, 1024]|is_image[storage_inverter_module_pic]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$earthing_pic_obj = dot_array_search('earthing_pic.name', $_FILES);
			if($earthing_pic_obj != ''){
				$img = ['earthing_pic'  => [
						'label' => 'Earthing Pic',
						'rules' => 'uploaded[earthing_pic]|max_size[earthing_pic, 1024]|is_image[earthing_pic]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$lights_pic_obj = dot_array_search('lights_pic.name', $_FILES);
			if($lights_pic_obj != ''){
				$img = ['lights_pic'  => [
						'label' => 'Lights Pic',
						'rules' => 'uploaded[lights_pic]|max_size[lights_pic, 1024]|is_image[lights_pic]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$fans_pic_obj = dot_array_search('fans_pic.name', $_FILES);
			if($fans_pic_obj != ''){
				$img = ['fans_pic'  => [
						'label' => 'Fans Pic',
						'rules' => 'uploaded[fans_pic]|max_size[fans_pic, 1024]|is_image[fans_pic]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$distribution_board_pic_obj = dot_array_search('distribution_board_pic.name', $_FILES);
			if($distribution_board_pic_obj != ''){
				$img = ['distribution_board_pic'  => [
						'label' => 'Distribution Boards Pic',
						'rules' => 'uploaded[distribution_board_pic]|max_size[distribution_board_pic, 1024]|is_image[distribution_board_pic]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$dc_wiring_pic_obj = dot_array_search('dc_wiring_pic.name', $_FILES);
			if($dc_wiring_pic_obj != ''){
				$img = ['dc_wiring_pic'  => [
						'label' => 'DC Wiring Pic',
						'rules' => 'uploaded[dc_wiring_pic]|max_size[dc_wiring_pic, 1024]|is_image[dc_wiring_pic]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$ac_wiring_pic_obj = dot_array_search('ac_wiring_pic.name', $_FILES);
			if($ac_wiring_pic_obj != ''){
				$img = ['ac_wiring_pic'  => [
						'label' => 'AC Wiring Pic',
						'rules' => 'uploaded[ac_wiring_pic]|max_size[ac_wiring_pic, 1024]|is_image[ac_wiring_pic]'
					]
				];
				$rules = array_merge($rules, $img);
            }
            
            
			$testing_pic_1_obj = dot_array_search('testing_pic_1.name', $_FILES);
			if($testing_pic_1_obj != ''){
				$img = ['testing_pic_1'  => [
						'label' => 'Testing Pic  - 1',
						'rules' => 'uploaded[testing_pic_1]|max_size[testing_pic_1, 1024]|is_image[testing_pic_1]'
					]
				];
				$rules = array_merge($rules, $img);
            }

            
			$testing_pic_2_obj = dot_array_search('testing_pic_2.name', $_FILES);
			if($testing_pic_2_obj != ''){
				$img = ['testing_pic_2'  => [
						'label' => 'Testing Pic  - 2',
						'rules' => 'uploaded[testing_pic_2]|max_size[testing_pic_2, 1024]|is_image[testing_pic_2]'
					]
				];
				$rules = array_merge($rules, $img);
            }

            
			$testing_pic_3_obj = dot_array_search('testing_pic_3.name', $_FILES);
			if($testing_pic_3_obj != ''){
				$img = ['testing_pic_3'  => [
						'label' => 'Testing Pic  - 3',
						'rules' => 'uploaded[testing_pic_3]|max_size[testing_pic_3, 1024]|is_image[testing_pic_3]'
					]
				];
				$rules = array_merge($rules, $img);
            }

            
			$rep_group_pic_obj = dot_array_search('rep_group_pic.name', $_FILES);
			if($rep_group_pic_obj != ''){
				$img = ['rep_group_pic'  => [
						'label' => 'Rep. Group Pic',
						'rules' => 'uploaded[rep_group_pic]|max_size[rep_group_pic, 1024]|is_image[rep_group_pic]'
					]
				];
				$rules = array_merge($rules, $img);
            }

			if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
			}else{
				$fat_model  	= new Fat_model();

				$newData = [];

                if($reason_of_rejection_pic_1_obj != ''){
					$reason_of_rejection_pic_1 = $this->request->getFile('reason_of_rejection_pic_1');
					if($reason_of_rejection_pic_1->isValid())
					{
						$reason_of_rejection_pic_1->move('./assets/uploads');
						$reason_of_rejection_pic_1_name = $reason_of_rejection_pic_1->getName();
						$newData['reason_of_rejection_pic_1'] = $reason_of_rejection_pic_1_name;
					}
					else
					{
						$reason_of_rejection_pic_1_name = "";
					}
				}

				if($reason_of_rejection_pic_2_obj != ''){
					$reason_of_rejection_pic_2 = $this->request->getFile('reason_of_rejection_pic_2');
					if($reason_of_rejection_pic_2->isValid())
					{
						$reason_of_rejection_pic_2->move('./assets/uploads');
						$reason_of_rejection_pic_2_name = $reason_of_rejection_pic_2->getName();
						$newData['reason_of_rejection_pic_2'] = $reason_of_rejection_pic_2_name;
					}
					else
					{
						$reason_of_rejection_pic_2_name = "";
					}
                }
                
                if($fat_report_pic_obj != ''){
					$fat_report_pic = $this->request->getFile('fat_report_pic');
					$fat_report_pic->move('./assets/uploads');
					$fat_report_pic_name = $fat_report_pic->getName();
					$newData['fat_report_pic'] = $fat_report_pic_name;
                }
                
				if($pv_module_pic_obj != ''){
					$pv_module_pic = $this->request->getFile('pv_module_pic');
					$pv_module_pic->move('./assets/uploads');
					$pv_module_pic_name = $pv_module_pic->getName();
					$newData['pv_module_pic'] = $pv_module_pic_name;
				}

				if($storage_inverter_module_pic_obj != ''){
					$storage_inverter_module_pic = $this->request->getFile('storage_inverter_module_pic');
					$storage_inverter_module_pic->move('./assets/uploads');
					$storage_inverter_module_pic_name = $storage_inverter_module_pic->getName();
					$newData['storage_inverter_module_pic'] = $storage_inverter_module_pic_name;
				}

				if($earthing_pic_obj != ''){
					$earthing_pic = $this->request->getFile('earthing_pic');
					$earthing_pic->move('./assets/uploads');
					$earthing_pic_name = $earthing_pic->getName();
					$newData['earthing_pic'] = $earthing_pic_name;
				}

				if($lights_pic_obj != ''){
					$lights_pic = $this->request->getFile('lights_pic');
					$lights_pic->move('./assets/uploads');
					$lights_pic_name = $lights_pic->getName();
					$newData['lights_pic'] = $lights_pic_name;
				}

				if($fans_pic_obj != ''){
					$fans_pic = $this->request->getFile('fans_pic');
					$fans_pic->move('./assets/uploads');
					$fans_pic_name = $fans_pic->getName();
					$newData['fans_pic'] = $fans_pic_name;
				}

				if($distribution_board_pic_obj != ''){
					$distribution_board_pic = $this->request->getFile('distribution_board_pic');
					$distribution_board_pic->move('./assets/uploads');
					$distribution_board_pic_name = $distribution_board_pic->getName();
					$newData['distribution_board_pic'] = $distribution_board_pic_name;
				}

				if($dc_wiring_pic_obj != ''){
					$dc_wiring_pic = $this->request->getFile('dc_wiring_pic');
					$dc_wiring_pic->move('./assets/uploads');
					$dc_wiring_pic_name = $dc_wiring_pic->getName();
					$newData['dc_wiring_pic'] = $dc_wiring_pic_name;
				}

				if($ac_wiring_pic_obj != ''){
					$ac_wiring_pic = $this->request->getFile('ac_wiring_pic');
					$ac_wiring_pic->move('./assets/uploads');
					$ac_wiring_pic_name = $ac_wiring_pic->getName();
					$newData['ac_wiring_pic'] = $ac_wiring_pic_name;
                }
                
                if($testing_pic_1_obj != ''){
					$testing_pic_1 = $this->request->getFile('testing_pic_1');
					$testing_pic_1->move('./assets/uploads');
					$testing_pic_1_name = $testing_pic_1->getName();
					$newData['testing_pic_1'] = $testing_pic_1_name;
                }
                
                if($testing_pic_2_obj != ''){
					$testing_pic_2 = $this->request->getFile('testing_pic_2');
					$testing_pic_2->move('./assets/uploads');
					$testing_pic_2_name = $testing_pic_2->getName();
					$newData['testing_pic_2'] = $testing_pic_2_name;
                }
                
                if($testing_pic_3_obj != ''){
					$testing_pic_3 = $this->request->getFile('testing_pic_3');
					$testing_pic_3->move('./assets/uploads');
					$testing_pic_3_name = $testing_pic_3->getName();
					$newData['testing_pic_3'] = $testing_pic_3_name;
                }
                
                if($rep_group_pic_obj != ''){
					$rep_group_pic = $this->request->getFile('rep_group_pic');
					$rep_group_pic->move('./assets/uploads');
					$rep_group_pic_name = $rep_group_pic->getName();
					$newData['rep_group_pic'] = $rep_group_pic_name;
				}


                $fat_model->updateFat($this->request->getVar('site_id'), $newData);
				$session = session();
				$session->setFlashdata('success', 'Image Uploaded');
				return redirect()->to(base_url().'/fat/fat_images/'.$this->request->getVar('site_id'));

			}
        }

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('fat/fat_images');
		echo view('templates/footer');
	}

	public function edit($id)
	{
		$data 						= [];
		$fat_model  	= new Fat_model();
		$data['fat']  = $fat_model->getFats($id);
		
		if ($this->request->getMethod() == 'post') {
			$rules = [
                'final_testing_date' => [
                        'label' => 'Final Testing Date',
                        'rules' => 'required'
                ],
                'contractor_rep_name' => [
                        'label' => 'Contractor Rep. Name',
                        'rules' => 'required|max_length[255]'
                ],
                'consultant_rep_name'               => [
                        'label' => 'Consultant Rep. Name',
                        'rules' => 'required|max_length[255]'
                ],
                'client_rep_name'                       => [
                        'label' => 'Client Rep. Name',
                        'rules' => 'required|max_length[255]'
                ],
                'fat_result'             => [
                        'label' => 'FAT Result',
                        'rules' => 'required'
                ]

            ];
            
            
			$reason_of_rejection_pic_1_obj = dot_array_search('reason_of_rejection_pic_1.name', $_FILES);
			if($reason_of_rejection_pic_1_obj != ''){
				$img = ['reason_of_rejection_pic_1'  => [
						'label' => 'Reason of Rejection (Pic-1)',
						'rules' => 'uploaded[reason_of_rejection_pic_1]|max_size[reason_of_rejection_pic_1, 1024]|is_image[reason_of_rejection_pic_1]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$reason_of_rejection_pic_2_obj = dot_array_search('reason_of_rejection_pic_2.name', $_FILES);
			if($reason_of_rejection_pic_2_obj != ''){
				$img = ['reason_of_rejection_pic_2'  => [
						'label' => 'Reason of Rejection (Pic-2)',
						'rules' => 'uploaded[reason_of_rejection_pic_2]|max_size[reason_of_rejection_pic_2, 1024]|is_image[reason_of_rejection_pic_2]'
					]
				];
				$rules = array_merge($rules, $img);
			}

            
			$fat_report_pic_obj = dot_array_search('fat_report_pic.name', $_FILES);
			if($fat_report_pic_obj != ''){
				$img = ['fat_report_pic'  => [
						'label' => 'PV Modules Pic',
						'rules' => 'uploaded[fat_report_pic]|max_size[fat_report_pic, 1024]|is_image[fat_report_pic]'
					]
				];
				$rules = array_merge($rules, $img);
            }
            
			$pv_module_pic_obj = dot_array_search('pv_module_pic.name', $_FILES);
			if($pv_module_pic_obj != ''){
				$img = ['pv_module_pic'  => [
						'label' => 'PV Modules Pic',
						'rules' => 'uploaded[pv_module_pic]|max_size[pv_module_pic, 1024]|is_image[pv_module_pic]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$storage_inverter_module_pic_obj = dot_array_search('storage_inverter_module_pic.name', $_FILES);
			if($storage_inverter_module_pic_obj != ''){
				$img = ['storage_inverter_module_pic'  => [
						'label' => 'Storage & Inverter Module Pic',
						'rules' => 'uploaded[storage_inverter_module_pic]|max_size[storage_inverter_module_pic, 1024]|is_image[storage_inverter_module_pic]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$earthing_pic_obj = dot_array_search('earthing_pic.name', $_FILES);
			if($earthing_pic_obj != ''){
				$img = ['earthing_pic'  => [
						'label' => 'Earthing Pic',
						'rules' => 'uploaded[earthing_pic]|max_size[earthing_pic, 1024]|is_image[earthing_pic]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$lights_pic_obj = dot_array_search('lights_pic.name', $_FILES);
			if($lights_pic_obj != ''){
				$img = ['lights_pic'  => [
						'label' => 'Lights Pic',
						'rules' => 'uploaded[lights_pic]|max_size[lights_pic, 1024]|is_image[lights_pic]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$fans_pic_obj = dot_array_search('fans_pic.name', $_FILES);
			if($fans_pic_obj != ''){
				$img = ['fans_pic'  => [
						'label' => 'Fans Pic',
						'rules' => 'uploaded[fans_pic]|max_size[fans_pic, 1024]|is_image[fans_pic]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$distribution_board_pic_obj = dot_array_search('distribution_board_pic.name', $_FILES);
			if($distribution_board_pic_obj != ''){
				$img = ['distribution_board_pic'  => [
						'label' => 'Distribution Boards Pic',
						'rules' => 'uploaded[distribution_board_pic]|max_size[distribution_board_pic, 1024]|is_image[distribution_board_pic]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$dc_wiring_pic_obj = dot_array_search('dc_wiring_pic.name', $_FILES);
			if($dc_wiring_pic_obj != ''){
				$img = ['dc_wiring_pic'  => [
						'label' => 'DC Wiring Pic',
						'rules' => 'uploaded[dc_wiring_pic]|max_size[dc_wiring_pic, 1024]|is_image[dc_wiring_pic]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$ac_wiring_pic_obj = dot_array_search('ac_wiring_pic.name', $_FILES);
			if($ac_wiring_pic_obj != ''){
				$img = ['ac_wiring_pic'  => [
						'label' => 'AC Wiring Pic',
						'rules' => 'uploaded[ac_wiring_pic]|max_size[ac_wiring_pic, 1024]|is_image[ac_wiring_pic]'
					]
				];
				$rules = array_merge($rules, $img);
            }
            
            
			$testing_pic_1_obj = dot_array_search('testing_pic_1.name', $_FILES);
			if($testing_pic_1_obj != ''){
				$img = ['testing_pic_1'  => [
						'label' => 'Testing Pic  - 1',
						'rules' => 'uploaded[testing_pic_1]|max_size[testing_pic_1, 1024]|is_image[testing_pic_1]'
					]
				];
				$rules = array_merge($rules, $img);
            }

            
			$testing_pic_2_obj = dot_array_search('testing_pic_2.name', $_FILES);
			if($testing_pic_2_obj != ''){
				$img = ['testing_pic_2'  => [
						'label' => 'Testing Pic  - 2',
						'rules' => 'uploaded[testing_pic_2]|max_size[testing_pic_2, 1024]|is_image[testing_pic_2]'
					]
				];
				$rules = array_merge($rules, $img);
            }

            
			$testing_pic_3_obj = dot_array_search('testing_pic_3.name', $_FILES);
			if($testing_pic_3_obj != ''){
				$img = ['testing_pic_3'  => [
						'label' => 'Testing Pic  - 3',
						'rules' => 'uploaded[testing_pic_3]|max_size[testing_pic_3, 1024]|is_image[testing_pic_3]'
					]
				];
				$rules = array_merge($rules, $img);
            }

            
			$rep_group_pic_obj = dot_array_search('rep_group_pic.name', $_FILES);
			if($rep_group_pic_obj != ''){
				$img = ['rep_group_pic'  => [
						'label' => 'Rep. Group Pic',
						'rules' => 'uploaded[rep_group_pic]|max_size[rep_group_pic, 1024]|is_image[rep_group_pic]'
					]
				];
				$rules = array_merge($rules, $img);
            }

			if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
			}else{
				$fat_model  	= new Fat_model();

				$newData = [
                    'final_testing_date'           	=> $this->request->getVar('final_testing_date'),
                    'contractor_rep_name'           => $this->request->getVar('contractor_rep_name'),
                    'consultant_rep_name'           => $this->request->getVar('consultant_rep_name'),
                    'client_rep_name'           	=> $this->request->getVar('client_rep_name'),
                    'fat_result'           			=> $this->request->getVar('fat_result'),
                    'reason_of_rejection'           => $this->request->getVar('reason_of_rejection'),
                    'site_id'                       => $this->request->getVar('site_id'),
				];

                if($reason_of_rejection_pic_1_obj != ''){
					$reason_of_rejection_pic_1 = $this->request->getFile('reason_of_rejection_pic_1');
					if($reason_of_rejection_pic_1->isValid())
					{
						$reason_of_rejection_pic_1->move('./assets/uploads');
						$reason_of_rejection_pic_1_name = $reason_of_rejection_pic_1->getName();
						$newData['reason_of_rejection_pic_1'] = $reason_of_rejection_pic_1_name;
					}
					else
					{
						$reason_of_rejection_pic_1_name = "";
					}
				}

				if($reason_of_rejection_pic_2_obj != ''){
					$reason_of_rejection_pic_2 = $this->request->getFile('reason_of_rejection_pic_2');
					if($reason_of_rejection_pic_2->isValid())
					{
						$reason_of_rejection_pic_2->move('./assets/uploads');
						$reason_of_rejection_pic_2_name = $reason_of_rejection_pic_2->getName();
						$newData['reason_of_rejection_pic_2'] = $reason_of_rejection_pic_2_name;
					}
					else
					{
						$reason_of_rejection_pic_2_name = "";
					}
                }
                
                if($fat_report_pic_obj != ''){
					$fat_report_pic = $this->request->getFile('fat_report_pic');
					$fat_report_pic->move('./assets/uploads');
					$fat_report_pic_name = $fat_report_pic->getName();
					$newData['fat_report_pic'] = $fat_report_pic_name;
                }
                
				if($pv_module_pic_obj != ''){
					$pv_module_pic = $this->request->getFile('pv_module_pic');
					$pv_module_pic->move('./assets/uploads');
					$pv_module_pic_name = $pv_module_pic->getName();
					$newData['pv_module_pic'] = $pv_module_pic_name;
				}

				if($storage_inverter_module_pic_obj != ''){
					$storage_inverter_module_pic = $this->request->getFile('storage_inverter_module_pic');
					$storage_inverter_module_pic->move('./assets/uploads');
					$storage_inverter_module_pic_name = $storage_inverter_module_pic->getName();
					$newData['storage_inverter_module_pic'] = $storage_inverter_module_pic_name;
				}

				if($earthing_pic_obj != ''){
					$earthing_pic = $this->request->getFile('earthing_pic');
					$earthing_pic->move('./assets/uploads');
					$earthing_pic_name = $earthing_pic->getName();
					$newData['earthing_pic'] = $earthing_pic_name;
				}

				if($lights_pic_obj != ''){
					$lights_pic = $this->request->getFile('lights_pic');
					$lights_pic->move('./assets/uploads');
					$lights_pic_name = $lights_pic->getName();
					$newData['lights_pic'] = $lights_pic_name;
				}

				if($fans_pic_obj != ''){
					$fans_pic = $this->request->getFile('fans_pic');
					$fans_pic->move('./assets/uploads');
					$fans_pic_name = $fans_pic->getName();
					$newData['fans_pic'] = $fans_pic_name;
				}

				if($distribution_board_pic_obj != ''){
					$distribution_board_pic = $this->request->getFile('distribution_board_pic');
					$distribution_board_pic->move('./assets/uploads');
					$distribution_board_pic_name = $distribution_board_pic->getName();
					$newData['distribution_board_pic'] = $distribution_board_pic_name;
				}

				if($dc_wiring_pic_obj != ''){
					$dc_wiring_pic = $this->request->getFile('dc_wiring_pic');
					$dc_wiring_pic->move('./assets/uploads');
					$dc_wiring_pic_name = $dc_wiring_pic->getName();
					$newData['dc_wiring_pic'] = $dc_wiring_pic_name;
				}

				if($ac_wiring_pic_obj != ''){
					$ac_wiring_pic = $this->request->getFile('ac_wiring_pic');
					$ac_wiring_pic->move('./assets/uploads');
					$ac_wiring_pic_name = $ac_wiring_pic->getName();
					$newData['ac_wiring_pic'] = $ac_wiring_pic_name;
                }
                
                if($testing_pic_1_obj != ''){
					$testing_pic_1 = $this->request->getFile('testing_pic_1');
					$testing_pic_1->move('./assets/uploads');
					$testing_pic_1_name = $testing_pic_1->getName();
					$newData['testing_pic_1'] = $testing_pic_1_name;
                }
                
                if($testing_pic_2_obj != ''){
					$testing_pic_2 = $this->request->getFile('testing_pic_2');
					$testing_pic_2->move('./assets/uploads');
					$testing_pic_2_name = $testing_pic_2->getName();
					$newData['testing_pic_2'] = $testing_pic_2_name;
                }
                
                if($testing_pic_3_obj != ''){
					$testing_pic_3 = $this->request->getFile('testing_pic_3');
					$testing_pic_3->move('./assets/uploads');
					$testing_pic_3_name = $testing_pic_3->getName();
					$newData['testing_pic_3'] = $testing_pic_3_name;
                }
                
                if($rep_group_pic_obj != ''){
					$rep_group_pic = $this->request->getFile('rep_group_pic');
					$rep_group_pic->move('./assets/uploads');
					$rep_group_pic_name = $rep_group_pic->getName();
					$newData['rep_group_pic'] = $rep_group_pic_name;
				}


                $fat_model->updateFat($this->request->getVar('site_id'), $newData);
				$session = session();
				$session->setFlashdata('success', 'FAT Updated Successfully');
				return redirect()->to(base_url().'/fat/manage');

			}
        }

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('fat/edit');
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
