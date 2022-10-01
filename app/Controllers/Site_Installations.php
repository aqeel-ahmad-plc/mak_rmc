<?php namespace App\Controllers;

use App\Models\Sites_model;
use App\Models\Serveys_model;
use App\Models\Site_Installations_model;

use FPDF;

class PDF extends FPDF
{
	var $widths;
	var $aligns;
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
	
	function SetWidths($w)
	{
		//Set the array of column widths
		$this->widths=$w;
	}
	
	function SetAligns($a)
	{
		//Set the array of column alignments
		$this->aligns=$a;
	}
	
	function Row($data)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=5*$nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			//Draw the border
			$this->Rect($x,$y,$w,$h);
			//Print the text
			$this->MultiCell($w,5,$data[$i],0,$a);
			//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
		//Go to the next line
		$this->Ln($h);
	}
	
	function CheckPageBreak($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}
	
	function NbLines($w,$txt)
	{
		//Computes the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$nl=1;
		while($i<$nb)
		{
			$c=$s[$i];
			if($c=="\n")
			{
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
				continue;
			}
			if($c==' ')
				$sep=$i;
			$l+=$cw[$c];
			if($l>$wmax)
			{
				if($sep==-1)
				{
					if($i==$j)
						$i++;
				}
				else
					$i=$sep+1;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}
	
}

class Site_Installations extends BaseController
{
	public function show()
	{
		$site_installation_model  	 = new Site_Installations_model();
        $data['site_installations']  = $site_installation_model->getSiteInstallations();

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('site_installations/show');
		echo view('templates/footer');
	}

	public function approval()
	{
		$data = [];
		$serveys_model = new Serveys_model();
		$data['serveys']  = $serveys_model->getServeys();

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('serveys/approval');
		echo view('templates/footer');
	}

	public function view_site_installation($id)
	{
		$site_installation_model  	= new Site_Installations_model();
        $data['site_installation']  = $site_installation_model->getSiteInstallations($id);

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('site_installations/view_site_installation');
		echo view('templates/footer');
	}

	public function print_installed()
	{
		$data 				= [];
		$site_installation_model  	= new Site_Installations_model();
		$site_installations			= $site_installation_model->getSiteInstallations();
		$data['site_installations']  	= $site_installations;
		
		$pdf = new PDF();
		$pdf->AddPage();
		/*output the result*/

		$pdf->Cell(50 ,3,'',0,1);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(50 ,2,'',0,1);
		$pdf->Cell(20 ,5,'',0,0);
		$pdf->Cell(150 ,10,'SOLAR ELECTRIFICATION OF 4000 MASAJID IN KPK',0,1,'C'); // Package# to be added here
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(50 ,2,'',0,1);
		$pdf->Cell(20 ,5,'',0,0);
		$pdf->Cell(150 ,10,'List of Installed Sites',0,1,'C'); // Package# to be added here
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(20 ,10,'Contractor:',0,0,'L');
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(80 ,10,"MAK Pumps Pvt Ltd",0,0,'L'); //Site ID to be added here
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(40 ,10,'Updated On:',0,0,'R');
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(40 ,10,date('M d, Y'),0,1,'R'); // Date to be added here

		$pdf->SetFont('Arial','B',10);
		/*Heading Of the table*/
		$pdf->Cell(20 ,5,'Sr. No',1,0,'L');
		$pdf->Cell(20 ,5,'Package',1,0,'L');
		$pdf->Cell(20 ,5,'Site ID',1,0,'L');
		$pdf->Cell(30 ,5,'Masjid Name',1,0,'L');
		$pdf->Cell(20 ,5,'District',1,0,'L');
		$pdf->Cell(20 ,5,'Tehsil',1,0,'L');
		$pdf->Cell(40 ,5,'UC/VC Name & No',1,0,'L');
		$pdf->Cell(20 ,5,'NA/PK',1,1,'L');
		/*Heading Of the table end*/
		$pdf->SetFont('Arial','',8);
		$pdf->SetWidths(array(20,20,20,30,20,20,40,20));
		$index  = 1;
		for ($i = 0; $i < sizeof($site_installations); $i++) {
			if($site_installations[$i]['is_installed'] == "1")
			{
				$pdf->Row(array($index,$site_installations[$i]['package'],$site_installations[$i]['siteid'],$site_installations[$i]['masgid'],$site_installations[$i]['district'],$site_installations[$i]['tehsil'],$site_installations[$i]['uc_vc_name_and_no'],$site_installations[$i]['na_pk']));
				$index++;
			}
		}
		if ($index == 0) 
		{
			$pdf->Cell(160, 5, "No Installed Sites found", 1, 1, 'C');
		}

		$pdf->Output('D','Installed_Sites.pdf');
		
		echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('site_installations/show');
		echo view('templates/footer');
	}

    public function manage()
	{
		$data 			= [];
		$sites_model    = new Sites_model();
		$data['sites']  = $sites_model->getSupplyOrdersGeneratedSites();
        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('site_installations/manage');
		echo view('templates/footer');
    }

    public function create($site_id)
	{
		$data 			= [];
		$sites_model    = new Sites_model();
        $data['site']   = $sites_model->getSites($site_id);

		if ($this->request->getMethod() == 'post') {
			$rules = [
                'start_date' => [
						'label' => 'Installation Start Date',
						'rules' => 'required'
				],
                'finish_date' => [
						'label' => 'Installation Finish Date',
						'rules' => 'required'
				],
                'installer_id'               => [
						'label' => 'Installer ID',
						'rules' => 'required|max_length[255]'
				],
                'installer_name'                       => [
						'label' => 'Installer Name',
						'rules' => 'required|max_length[255]'
				],
                'motor_connection'             => [
						'label' => 'Motor Connection',
						'rules' => 'required'
				],
                'pv_module_01_sno'             => [
						'label' => 'PV Module – 01 Serial No',
						'rules' => 'required|max_length[255]'
				],
                'pv_module_02_sno'         => [
						'label' => 'PV Module – 02 Serial No',
						'rules' => 'required|max_length[255]'
				],
                'pv_module_03_sno'         => [
						'label' => 'PV Module – 03 Serial No',
						'rules' => 'required|max_length[255]'
				],
                'pv_module_04_sno'      => [
						'label' => 'PV Module – 04 Serial No',
						'rules' => 'required|max_length[255]'
				],
                'inverter_sno'  => [
						'label' => 'Inverter Serial No',
						'rules' => 'required'
				],
                'battery_sno'       => [
						'label' => 'Battery Serial No',
						'rules' => 'required'
				]

			];

			if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
			}else{
				$site_installation_model = new Site_Installations_model();
                $newData = [
					'start_date'           			=> $this->request->getVar('start_date'),
					'finish_date'           		=> $this->request->getVar('finish_date'),
					'installer_id'           		=> $this->request->getVar('installer_id'),
					'installer_name'           		=> $this->request->getVar('installer_name'),
					'motor_connection'           	=> $this->request->getVar('motor_connection'),
					'pv_module_01_sno'           	=> $this->request->getVar('pv_module_01_sno'),
					'pv_module_02_sno'           	=> $this->request->getVar('pv_module_02_sno'),
					'pv_module_03_sno'           	=> $this->request->getVar('pv_module_03_sno'),
					'pv_module_04_sno'           	=> $this->request->getVar('pv_module_04_sno'),
					'inverter_sno'           		=> $this->request->getVar('inverter_sno'),
					'battery_sno'           		=> $this->request->getVar('battery_sno'),
                    'site_id'                       => $this->request->getVar('site_id'),
                ];

                $site_installation_model->save($newData);
                $site_status = ['is_installed' => 1];
                $sites_model->updateSiteStatus($this->request->getVar('site_id'), $site_status);
				$session = session();
				$session->setFlashdata('success', 'Site Installation Completed Successfully');
				return redirect()->to(base_url().'/site_installations/site_installation_images/'.$this->request->getVar('site_id'));

			}
        }

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('site_installations/create');
		echo view('templates/footer');
	}

	public function site_installation_images($id)
	{
		$data 						= [];
		$site_installation_model  	= new Site_Installations_model();
		$data['site_installation']  = $site_installation_model->getSiteInstallations($id);
		
		if ($this->request->getMethod() == 'post') {

			if(isset($_POST['site_installation_complete']))
			{
				$session = session();
				$session->setFlashdata('success', 'Site Installation Completed');
				return redirect()->to(base_url().'/site_installations/manage');
			}

			$rules = [];

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

			$optional_pic_1_obj = dot_array_search('optional_pic_1.name', $_FILES);
			if($optional_pic_1_obj != ''){
				$img = ['optional_pic_1'  => [
						'label' => 'Optional Pic - 1',
						'rules' => 'uploaded[optional_pic_1]|max_size[optional_pic_1, 1024]|is_image[optional_pic_1]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$optional_pic_2_obj = dot_array_search('optional_pic_2.name', $_FILES);
			if($optional_pic_2_obj != ''){
				$img = ['optional_pic_2'  => [
						'label' => 'Optional Pic - 2',
						'rules' => 'uploaded[optional_pic_2]|max_size[optional_pic_2, 1024]|is_image[optional_pic_2]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$optional_pic_3_obj = dot_array_search('optional_pic_3.name', $_FILES);
			if($optional_pic_3_obj != ''){
				$img = ['optional_pic_3'  => [
						'label' => 'Optional Pic - 3',
						'rules' => 'uploaded[optional_pic_3]|max_size[optional_pic_3, 1024]|is_image[optional_pic_3]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$optional_pic_4_obj = dot_array_search('optional_pic_4.name', $_FILES);
			if($optional_pic_4_obj != ''){
				$img = ['optional_pic_4'  => [
						'label' => 'Optional Pic - 4',
						'rules' => 'uploaded[optional_pic_4]|max_size[optional_pic_4, 1024]|is_image[optional_pic_4]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$optional_pic_5_obj = dot_array_search('optional_pic_5.name', $_FILES);
			if($optional_pic_5_obj != ''){
				$img = ['optional_pic_5'  => [
						'label' => 'Optional Pic - 5',
						'rules' => 'uploaded[optional_pic_5]|max_size[optional_pic_5, 1024]|is_image[optional_pic_5]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
			}else{
				$site_installation_model  	= new Site_Installations_model();

				$newData = [];

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


				if($optional_pic_1_obj != ''){
					$optional_pic_1 = $this->request->getFile('optional_pic_1');
					if($optional_pic_1->isValid())
					{
						$optional_pic_1->move('./assets/uploads');
						$optional_pic_1_name = $optional_pic_1->getName();
						$newData['optional_pic_1'] = $optional_pic_1_name;
					}
					else
					{
						$optional_pic_1_name = "";
					}
				}

				if($optional_pic_2_obj != ''){
					$optional_pic_2 = $this->request->getFile('optional_pic_2');
					if($optional_pic_2->isValid())
					{
						$optional_pic_2->move('./assets/uploads');
						$optional_pic_2_name = $optional_pic_2->getName();
						$newData['optional_pic_2'] = $optional_pic_2_name;
					}
					else
					{
						$optional_pic_2_name = "";
					}
				}

				if($optional_pic_3_obj != ''){
					$optional_pic_3 = $this->request->getFile('optional_pic_3');
					if($optional_pic_3->isValid())
					{
						$optional_pic_3->move('./assets/uploads');
						$optional_pic_3_name = $optional_pic_3->getName();
						$newData['optional_pic_3'] = $optional_pic_3_name;
					}
					else
					{
						$optional_pic_3_name = "";
					}
				}

				if($optional_pic_4_obj != ''){
					$optional_pic_4 = $this->request->getFile('optional_pic_4');
					if($optional_pic_4->isValid())
					{
						$optional_pic_4->move('./assets/uploads');
						$optional_pic_4_name = $optional_pic_4->getName();
						$newData['optional_pic_4'] = $optional_pic_4_name;
					}
					else
					{
						$optional_pic_4_name = "";
					}
				}

				if($optional_pic_5_obj != ''){

					$optional_pic_5 = $this->request->getFile('optional_pic_5');
					if($optional_pic_5->isValid())
					{
						$optional_pic_5->move('./assets/uploads');
						$optional_pic_5_name = $optional_pic_5->getName();
						$newData['optional_pic_5'] = $optional_pic_5_name;
					}
					else
					{
						$optional_pic_5_name = "";
					}
				}

                $site_installation_model->updateSiteInstallation($this->request->getVar('site_id'), $newData);
				$session = session();
				$session->setFlashdata('success', 'Image Uploaded');
				return redirect()->to(base_url().'/site_installations/site_installation_images/'.$this->request->getVar('site_id'));

			}
        }

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('site_installations/site_installation_images');
		echo view('templates/footer');
	}

	public function edit($id)
	{
		$data 						= [];
		$site_installation_model  	= new Site_Installations_model();
		$data['site_installation']  = $site_installation_model->getSiteInstallations($id);
		
		if ($this->request->getMethod() == 'post') {
			$rules = [
                'start_date' => [
						'label' => 'Installation Start Date',
						'rules' => 'required'
				],
				'finish_date' => [
						'label' => 'Installation Finish Date',
						'rules' => 'required'
				],
				'installer_id'               => [
						'label' => 'Installer ID',
						'rules' => 'required|max_length[255]'
				],
				'installer_name'                       => [
						'label' => 'Installer Name',
						'rules' => 'required|max_length[255]'
				],
				'motor_connection'             => [
						'label' => 'Motor Connection',
						'rules' => 'required'
				],
				'pv_module_01_sno'             => [
						'label' => 'PV Module – 01 Serial No',
						'rules' => 'required|max_length[255]'
				],
				'pv_module_02_sno'         => [
						'label' => 'PV Module – 02 Serial No',
						'rules' => 'required|max_length[255]'
				],
				'pv_module_03_sno'         => [
						'label' => 'PV Module – 03 Serial No',
						'rules' => 'required|max_length[255]'
				],
				'pv_module_04_sno'      => [
						'label' => 'PV Module – 04 Serial No',
						'rules' => 'required|max_length[255]'
				],
				'inverter_sno'  => [
						'label' => 'Inverter Serial No',
						'rules' => 'required'
				],
				'battery_sno'       => [
						'label' => 'Battery Serial No',
						'rules' => 'required'
				]

			];

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

			$optional_pic_1_obj = dot_array_search('optional_pic_1.name', $_FILES);
			if($optional_pic_1_obj != ''){
				$img = ['optional_pic_1'  => [
						'label' => 'Optional Pic - 1',
						'rules' => 'uploaded[optional_pic_1]|max_size[optional_pic_1, 1024]|is_image[optional_pic_1]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$optional_pic_2_obj = dot_array_search('optional_pic_2.name', $_FILES);
			if($optional_pic_2_obj != ''){
				$img = ['optional_pic_2'  => [
						'label' => 'Optional Pic - 2',
						'rules' => 'uploaded[optional_pic_2]|max_size[optional_pic_2, 1024]|is_image[optional_pic_2]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$optional_pic_3_obj = dot_array_search('optional_pic_3.name', $_FILES);
			if($optional_pic_3_obj != ''){
				$img = ['optional_pic_3'  => [
						'label' => 'Optional Pic - 3',
						'rules' => 'uploaded[optional_pic_3]|max_size[optional_pic_3, 1024]|is_image[optional_pic_3]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$optional_pic_4_obj = dot_array_search('optional_pic_4.name', $_FILES);
			if($optional_pic_4_obj != ''){
				$img = ['optional_pic_4'  => [
						'label' => 'Optional Pic - 4',
						'rules' => 'uploaded[optional_pic_4]|max_size[optional_pic_4, 1024]|is_image[optional_pic_4]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$optional_pic_5_obj = dot_array_search('optional_pic_5.name', $_FILES);
			if($optional_pic_5_obj != ''){
				$img = ['optional_pic_5'  => [
						'label' => 'Optional Pic - 5',
						'rules' => 'uploaded[optional_pic_5]|max_size[optional_pic_5, 1024]|is_image[optional_pic_5]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
			}else{
				$site_installation_model  	= new Site_Installations_model();

				$newData = [
					'start_date'           			=> $this->request->getVar('start_date'),
					'finish_date'           		=> $this->request->getVar('finish_date'),
					'installer_id'           		=> $this->request->getVar('installer_id'),
					'installer_name'           		=> $this->request->getVar('installer_name'),
					'motor_connection'           	=> $this->request->getVar('motor_connection'),
					'pv_module_01_sno'           	=> $this->request->getVar('pv_module_01_sno'),
					'pv_module_02_sno'           	=> $this->request->getVar('pv_module_02_sno'),
					'pv_module_03_sno'           	=> $this->request->getVar('pv_module_03_sno'),
					'pv_module_04_sno'           	=> $this->request->getVar('pv_module_04_sno'),
					'inverter_sno'           		=> $this->request->getVar('inverter_sno'),
					'battery_sno'           		=> $this->request->getVar('battery_sno'),
                    'site_id'                       => $this->request->getVar('site_id'),
				];

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


				if($optional_pic_1_obj != ''){
					$optional_pic_1 = $this->request->getFile('optional_pic_1');
					if($optional_pic_1->isValid())
					{
						$optional_pic_1->move('./assets/uploads');
						$optional_pic_1_name = $optional_pic_1->getName();
						$newData['optional_pic_1'] = $optional_pic_1_name;
					}
					else
					{
						$optional_pic_1_name = "";
					}
				}

				if($optional_pic_2_obj != ''){
					$optional_pic_2 = $this->request->getFile('optional_pic_2');
					if($optional_pic_2->isValid())
					{
						$optional_pic_2->move('./assets/uploads');
						$optional_pic_2_name = $optional_pic_2->getName();
						$newData['optional_pic_2'] = $optional_pic_2_name;
					}
					else
					{
						$optional_pic_2_name = "";
					}
				}

				if($optional_pic_3_obj != ''){
					$optional_pic_3 = $this->request->getFile('optional_pic_3');
					if($optional_pic_3->isValid())
					{
						$optional_pic_3->move('./assets/uploads');
						$optional_pic_3_name = $optional_pic_3->getName();
						$newData['optional_pic_3'] = $optional_pic_3_name;
					}
					else
					{
						$optional_pic_3_name = "";
					}
				}

				if($optional_pic_4_obj != ''){
					$optional_pic_4 = $this->request->getFile('optional_pic_4');
					if($optional_pic_4->isValid())
					{
						$optional_pic_4->move('./assets/uploads');
						$optional_pic_4_name = $optional_pic_4->getName();
						$newData['optional_pic_4'] = $optional_pic_4_name;
					}
					else
					{
						$optional_pic_4_name = "";
					}
				}

				if($optional_pic_5_obj != ''){

					$optional_pic_5 = $this->request->getFile('optional_pic_5');
					if($optional_pic_5->isValid())
					{
						$optional_pic_5->move('./assets/uploads');
						$optional_pic_5_name = $optional_pic_5->getName();
						$newData['optional_pic_5'] = $optional_pic_5_name;
					}
					else
					{
						$optional_pic_5_name = "";
					}
				}

                $site_installation_model->updateSiteInstallation($this->request->getVar('site_id'), $newData);
				$session = session();
				$session->setFlashdata('success', 'Site Installation Updated Successfully');
				return redirect()->to(base_url().'/site_installations/manage');

			}
        }

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('site_installations/edit');
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
