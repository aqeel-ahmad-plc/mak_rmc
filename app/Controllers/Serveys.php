<?php namespace App\Controllers;

use App\Models\Sites_model;
use App\Models\Serveys_model;

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


class Serveys extends BaseController
{
	public function show()
	{
		$serveys_model  = new Serveys_model();
        $data['serveys']  = $serveys_model->getServeys();

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('serveys/show');
		echo view('templates/footer');
	}

	public function status_and_feasibility()
	{
		$serveys_model  = new Serveys_model();
        $data['serveys']  = $serveys_model->getServeys();

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('serveys/status_and_feasibility');
		echo view('templates/footer');
	}

	public function print_status_and_feasibility($id)
	{
		$data 				= [];
		$serveys_model  	= new Serveys_model();
		$serveys			= $serveys_model->getServeys();
		$data['serveys']  	= $serveys;
		
		if ($id == 1) 
		{	
			$pdf = new PDF();
			$pdf->AddPage();
			/*output the result*/

			$pdf->SetFont('Arial','B',20);
			$pdf->Cell(50 ,5,'',0,1);
			$pdf->Cell(110 ,5,'Not-Ok Sites',0,1,'R');
			$pdf->Cell(50 ,5,'',0,1);
			$pdf->SetFont('Arial','B',10);
			/*Heading Of the table*/
			$pdf->Cell(20 ,5,'Sr. No',1,0,'L');
			$pdf->Cell(40 ,5,'Site ID',1,0,'L');
			$pdf->Cell(40 ,5,'Masjid Name',1,0,'L');
			$pdf->Cell(40 ,5,'District',1,0,'L');
			$pdf->Cell(40 ,5,'Problem Description',1,1,'L');
			/*Heading Of the table end*/
			$pdf->SetFont('Arial','',8);
			$pdf->SetWidths(array(20,40,40,40,40));
			$index  = 0;
			for ($i = 0; $i < sizeof($serveys); $i++) {
				if($serveys[$i]['site_status'] == "0")
				{
					$pdf->Row(array($index,$serveys[$i]['siteid'],$serveys[$i]['masgid'],$serveys[$i]['district'],$serveys[$i]['problem_description']));
					$index++;
				}
			}
			if ($index == 0) 
			{
				$pdf->Cell(160, 5, "No Not-Ok Sites found", 1, 1, 'C');
			}

			$pdf->Output('D','Not_OK_Sites.pdf');
		}
		elseif($id == 2)
		{
			$pdf = new PDF();
			$pdf->AddPage();
			/*output the result*/

			$pdf->SetFont('Arial','B',20);
			$pdf->Cell(50 ,5,'',0,1);
			$pdf->Cell(110 ,5,'Non-Feasible Sites',0,1,'R');
			$pdf->Cell(50 ,5,'',0,1);
			$pdf->SetFont('Arial','B',10);
			/*Heading Of the table*/
			$pdf->Cell(20 ,5,'Sr. No',1,0,'L');
			$pdf->Cell(40 ,5,'Site ID',1,0,'L');
			$pdf->Cell(40 ,5,'Masjid Name',1,0,'L');
			$pdf->Cell(40 ,5,'District',1,0,'L');
			$pdf->Cell(40 ,5,'Remarks',1,1,'L');
			/*Heading Of the table end*/
			$pdf->SetFont('Arial','',8);
			$pdf->SetWidths(array(20,40,40,40,40));
			$index  = 0;
			for ($i = 0; $i < sizeof($serveys); $i++) {
				if($serveys[$i]['site_feasibility'] == "0")
				{
					$pdf->Row(array($index,$serveys[$i]['siteid'],$serveys[$i]['masgid'],$serveys[$i]['district'],$serveys[$i]['remarks']));
					$index++;
				}
			}

			if ($index == 0) 
			{
				$pdf->Cell(160, 5, "No Non-Feasible Sites found", 1, 1, 'C');
			}

			$pdf->Output('D','Non_Feasible_Sites.pdf');
		}
		
		echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('serveys/status_and_feasibility');
		echo view('templates/footer');
	}

	public function print_surveyed()
	{
		$data 				= [];
		$serveys_model  	= new Serveys_model();
		$serveys			= $serveys_model->getServeys();
		$data['serveys']  	= $serveys;
		
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
		$pdf->Cell(150 ,10,'List of Surveyed Sites',0,1,'C'); // Package# to be added here
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
		for ($i = 0; $i < sizeof($serveys); $i++) {
			if($serveys[$i]['is_surveyed'] == "1")
			{
				$pdf->Row(array($index,$serveys[$i]['package'],$serveys[$i]['siteid'],$serveys[$i]['masgid'],$serveys[$i]['district'],$serveys[$i]['tehsil'],$serveys[$i]['uc_vc_name_and_no'],$serveys[$i]['na_pk']));
				$index++;
			}
		}
		if ($index == 0) 
		{
			$pdf->Cell(160, 5, "No Surveyed Sites found", 1, 1, 'C');
		}

		$pdf->Output('D','Surveyed_Sites.pdf');
		
		echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('serveys/show');
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

	public function view_servey($id)
	{
		$serveys_model  = new Serveys_model();
        $data['servey']  = $serveys_model->getServeys($id);

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('serveys/view_servey');
		echo view('templates/footer');
	}

    public function manage()
	{
        $sites_model    = new Sites_model();
		$sites  		= $sites_model->getSites();
		$serveys_model  = new Serveys_model();

		// dd($sites);
		for($i = 0; $i < sizeof($sites) ; $i++)
		{
			$servey = [];
			$servey  = $serveys_model->getServeys($sites[$i]['id']);
			if($servey)
			{
				$sites[$i]['survey_status'] = $servey[0]['status'];
			}
			else
			{
				$sites[$i]['survey_status'] = 0;
			}
		}

		$data['sites'] 	= $sites ;
        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('serveys/manage');
		echo view('templates/footer');
    }

    public function create($site_id)
	{
		$data 			= [];
		$sites_model    = new Sites_model();
        $data['site']   = $sites_model->getSites($site_id);

		if ($this->request->getMethod() == 'post') {
			$rules = [
                'contractor_rep_name' => [
						'label' => 'Contractor Rep. Name',
						'rules' => 'required|max_length[255]'
				],
                'consultant_rep_name' => [
						'label' => 'Consultant Rep. Name',
						'rules' => 'required|max_length[255]'
				],
                'client_rep_name'               => [
						'label' => 'Client Rep. Name',
						'rules' => 'required|max_length[255]'
				],
                'address'                       => [
						'label' => 'Address',
						'rules' => 'required|max_length[255]'
				],
				'gps_coordinates_n_degree'             => [
						'label' => 'GPS Coordinates Degree(N)',
						'rules' => 'required'
				],
				'gps_coordinates_n_minute'             => [
						'label' => 'GPS Coordinates Minutes(N)',
						'rules' => 'required'
				],
				'gps_coordinates_n_second'             => [
						'label' => 'GPS Coordinates Seconds(N)',
						'rules' => 'required'
				],
				'gps_coordinates_e_degree'             => [
						'label' => 'GPS Coordinates Degree(E)',
						'rules' => 'required'
				],
				'gps_coordinates_e_minute'             => [
						'label' => 'GPS Coordinates Minutes(E)',
						'rules' => 'required'
				],
				'gps_coordinates_e_second'             => [
						'label' => 'GPS Coordinates Seconds(E)',
						'rules' => 'required'
				],
                'khatib_caretaker_name'         => [
						'label' => 'Khatib/ Caretaker Name',
						'rules' => 'required|max_length[255]'
				],
                'khatib_caretaker_cnic'         => [
						'label' => 'Khatib/ Caretaker CNIC',
						'rules' => 'required|max_length[255]'
				],
                'khatib_caretaker_cell_no'      => [
						'label' => 'Khatib/ Caretaker Cell No',
						'rules' => 'required|max_length[255]'
				],
                'inverter_pv_modules_distance'  => [
						'label' => 'Distance Between Inverter & PV Modules (ft.)',
						'rules' => 'required'
				],
                'inverter_earth_distance'       => [
						'label' => 'Distance Between Inverter & Earth (ft.)',
						'rules' => 'required'
				],
                'inverter_mdb_distance'         => [
						'label' => 'Distance Between Inverter & MDB (ft.)',
						'rules' => 'required'
				],
                'roof_top_type'                 => [
						'label' => 'Roof Top Type',
						'rules' => 'required'
				],
                'no_of_stories'                 => [
						'label' => 'No. of Stories',
						'rules' => 'required'
				],
                'mounting_type'                 => [
						'label' => 'Mounting Type',
						'rules' => 'required'
				],
                'motor_hp'                      => [
						'label' => 'Motor HP',
						'rules' => 'required'
				],
                'motor_ampere'                  => [
						'label' => 'Motor Ampere (A)',
						'rules' => 'required'
				],
                'motor_input_power'             => [
						'label' => 'Motor Input Power (W)',
						'rules' => 'required'
				],
                'motor_to_connect'              => [
						'label' => 'Motor to Connect',
						'rules' => 'required'
				],
                'existing_no_of_fans'           => [
						'label' => 'Existing Nos. of Fans',
						'rules' => 'required'
				],
                'existing_no_of_lights'         => [
						'label' => 'Existing Nos. of Lights',
						'rules' => 'required'
				],
                'existing_wiring_type'          => [
						'label' => 'Existing Wiring Type',
						'rules' => 'required'
				],
				'line_voltage'                  => [
						'label' => 'Line Voltage',
						'rules' => 'required'
				],
                'site_status'                   => [
						'label' => 'Status of Site',
						'rules' => 'required'
				],
                'site_feasibility'              => [
						'label' => 'Site Feasibility',
						'rules' => 'required'
				],
                'remarks'                       => [
						'label' => 'Remarks',
						'rules' => 'required'
				],

			];

			if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
			}else{
				$servey_model = new Serveys_model();

                $newData = [
                    'contractor_rep_name'           => $this->request->getVar('contractor_rep_name'),
                    'consultant_rep_name'           => $this->request->getVar('consultant_rep_name'),
                    'client_rep_name'               => $this->request->getVar('client_rep_name'),
                    'address'                       => $this->request->getVar('address'),
					'gps_coordinates_n'             => ($this->request->getVar('gps_coordinates_n_degree').' '.$this->request->getVar('gps_coordinates_n_minute').' '.$this->request->getVar('gps_coordinates_n_second')),
					'gps_coordinates_e'             => ($this->request->getVar('gps_coordinates_e_degree').' '.$this->request->getVar('gps_coordinates_e_minute').' '.$this->request->getVar('gps_coordinates_e_second')),
                    'khatib_caretaker_name'         => $this->request->getVar('khatib_caretaker_name'),
                    'khatib_caretaker_cnic'         => $this->request->getVar('khatib_caretaker_cnic'),
                    'khatib_caretaker_cell_no'      => $this->request->getVar('khatib_caretaker_cell_no'),
                    'inverter_pv_modules_distance'  => $this->request->getVar('inverter_pv_modules_distance'),
                    'inverter_earth_distance'       => $this->request->getVar('inverter_earth_distance'),
                    'inverter_mdb_distance'         => $this->request->getVar('inverter_mdb_distance'),
                    'roof_top_type'                 => $this->request->getVar('roof_top_type'),
                    'no_of_stories'                 => $this->request->getVar('no_of_stories'),
                    'mounting_type'                 => $this->request->getVar('mounting_type'),
                    'motor_hp'                      => $this->request->getVar('motor_hp'),
                    'motor_ampere'                  => $this->request->getVar('motor_ampere'),
                    'motor_input_power'             => $this->request->getVar('motor_input_power'),
                    'motor_to_connect'              => $this->request->getVar('motor_to_connect'),
                    'existing_no_of_fans'           => $this->request->getVar('existing_no_of_fans'),
                    'existing_no_of_lights'         => $this->request->getVar('existing_no_of_lights'),
                    'existing_wiring_type'          => $this->request->getVar('existing_wiring_type'),
					'line_voltage'                  => $this->request->getVar('line_voltage'),
                    'site_status'                   => $this->request->getVar('site_status'),
                    'problem_description'           => $this->request->getVar('problem_description'),
                    'site_feasibility'              => $this->request->getVar('site_feasibility'),
                    'remarks'                       => $this->request->getVar('remarks'),
                    'site_id'                       => $this->request->getVar('site_id'),
                ];

                $servey_model->save($newData);
                $site_status = ['status' => 1];
                $sites_model->updateSiteStatus($this->request->getVar('site_id'), $site_status);
				$session = session();
				$session->setFlashdata('success', 'Servey Completed Successfully');
				return redirect()->to(base_url().'/serveys/survey_images/'.$this->request->getVar('site_id'));

			}
        }

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('serveys/create');
		echo view('templates/footer');
	}

	public function survey_images($site_id)
	{
		$data 			= [];
		$serveys_model  = new Serveys_model();
        $data['servey'] = $serveys_model->getServeys($site_id);
		// dd($data);
		if ($this->request->getMethod() == 'post') {
			if(isset($_POST['survey_complete']))
			{
				$session = session();
				$session->setFlashdata('success', 'Survey Completed');
				return redirect()->to(base_url().'/serveys/manage');
			}

			$rules = [];

			$khatib_caretaker_pic = dot_array_search('khatib_caretaker_pic_path.name', $_FILES);
			if($khatib_caretaker_pic != ''){
				$img = ['khatib_caretaker_pic_path'  => [
						'label' => 'Khatib/ Caretaker Pic',
						'rules' => 'uploaded[khatib_caretaker_pic_path]|max_size[khatib_caretaker_pic_path, 1024]|is_image[khatib_caretaker_pic_path]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$site_sketch_pic = dot_array_search('site_sketch_pic_path.name', $_FILES);
			if($site_sketch_pic != ''){
				$img = ['site_sketch_pic_path'  => [
						'label' => 'Site Sketch Pic',
						'rules' => 'uploaded[site_sketch_pic_path]|max_size[site_sketch_pic_path, 1024]|is_image[site_sketch_pic_path]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$roof_top_pic_01 = dot_array_search('roof_top_pic_01_path.name', $_FILES);
			if($roof_top_pic_01 != ''){
				$img = ['roof_top_pic_01_path'  => [
						'label' => 'Roof top Pic - 01',
						'rules' => 'uploaded[roof_top_pic_01_path]|max_size[roof_top_pic_01_path, 1024]|is_image[roof_top_pic_01_path]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$roof_top_pic_02 = dot_array_search('roof_top_pic_02_path.name', $_FILES);
			if($roof_top_pic_02 != ''){
				$img = ['roof_top_pic_02_path'  => [
						'label' => 'Roof top Pic - 02',
						'rules' => 'uploaded[roof_top_pic_02_path]|max_size[roof_top_pic_02_path, 1024]|is_image[roof_top_pic_02_path]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$mdb_pic = dot_array_search('mdb_pic_path.name', $_FILES);
			if($mdb_pic != ''){
				$img = ['mdb_pic_path'  => [
						'label' => 'MDB Pic',
						'rules' => 'uploaded[mdb_pic_path]|max_size[mdb_pic_path, 1024]|is_image[mdb_pic_path]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$inverter_placement_pic = dot_array_search('inverter_placement_pic_path.name', $_FILES);
			if($inverter_placement_pic != ''){
				$img = ['inverter_placement_pic_path'  => [
						'label' => 'Inverter Placement Pic',
						'rules' => 'uploaded[inverter_placement_pic_path]|max_size[inverter_placement_pic_path, 1024]|is_image[inverter_placement_pic_path]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$earth_point_pic = dot_array_search('earth_point_pic_path.name', $_FILES);
			if($earth_point_pic != ''){
				$img = ['earth_point_pic_path'  => [
						'label' => 'Earth Point Pic',
						'rules' => 'uploaded[earth_point_pic_path]|max_size[earth_point_pic_path, 1024]|is_image[earth_point_pic_path]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$motor_pic = dot_array_search('motor_pic_path.name', $_FILES);
			if($motor_pic != ''){
				$img = ['motor_pic_path'  => [
						'label' => 'Motor Pic',
						'rules' => 'uploaded[motor_pic_path]|max_size[motor_pic_path, 1024]|is_image[motor_pic_path]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$internal_wiring_pic = dot_array_search('internal_wiring_pic_path.name', $_FILES);
			if($internal_wiring_pic != ''){
				$img = ['internal_wiring_pic_path'  => [
						'label' => 'Internal Wiring Pic',
						'rules' => 'uploaded[internal_wiring_pic_path]|max_size[internal_wiring_pic_path, 1024]|is_image[internal_wiring_pic_path]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$optional_pic_01 = dot_array_search('optional_pic_01_path.name', $_FILES);
			if($optional_pic_01 != ''){
				$img = ['optional_pic_01_path'  => [
						'label' => 'Optional Pic-01',
						'rules' => 'uploaded[optional_pic_01_path]|max_size[optional_pic_01_path, 1024]|is_image[optional_pic_01_path]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$optional_pic_02 = dot_array_search('optional_pic_02_path.name', $_FILES);
			if($optional_pic_02 != ''){
				$img = ['optional_pic_02_path'  => [
						'label' => 'Optional Pic-02',
						'rules' => 'uploaded[optional_pic_02_path]|max_size[optional_pic_02_path, 1024]|is_image[optional_pic_02_path]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$optional_pic_03 = dot_array_search('optional_pic_03_path.name', $_FILES);
			if($optional_pic_03 != ''){
				$img = ['optional_pic_03_path'  => [
						'label' => 'Optional Pic-03',
						'rules' => 'uploaded[optional_pic_03_path]|max_size[optional_pic_03_path, 1024]|is_image[optional_pic_03_path]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$optional_pic_04 = dot_array_search('optional_pic_04_path.name', $_FILES);
			if($optional_pic_04 != ''){
				$img = ['optional_pic_04_path'  => [
						'label' => 'Optional Pic-04',
						'rules' => 'uploaded[optional_pic_04_path]|max_size[optional_pic_04_path, 1024]|is_image[optional_pic_04_path]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$optional_pic_05 = dot_array_search('optional_pic_05_path.name', $_FILES);
			if($optional_pic_05 != ''){
				$img = ['optional_pic_05_path'  => [
						'label' => 'Optional Pic-05',
						'rules' => 'uploaded[optional_pic_05_path]|max_size[optional_pic_05_path, 1024]|is_image[optional_pic_05_path]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$rep_group_pic = dot_array_search('rep_group_pic_path.name', $_FILES);
			if($rep_group_pic != ''){
				$img = ['rep_group_pic_path'  => [
						'label' => 'Rep. Group Pic',
						'rules' => 'uploaded[rep_group_pic_path]|max_size[rep_group_pic_path, 1024]|is_image[rep_group_pic_path]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
			}else{
				$servey_model = new Serveys_model();

				$newData = [];

				if($khatib_caretaker_pic != ''){
					$khatib_caretaker_pic_path = $this->request->getFile('khatib_caretaker_pic_path');
					$khatib_caretaker_pic_path->move('./assets/uploads');
					$khatib_caretaker_pic_path_name = $khatib_caretaker_pic_path->getName();
					$newData['khatib_caretaker_pic_path'] = $khatib_caretaker_pic_path_name;
				}

				if($site_sketch_pic != ''){
					$site_sketch_pic_path = $this->request->getFile('site_sketch_pic_path');
					$site_sketch_pic_path->move('./assets/uploads');
					$site_sketch_pic_path_name = $site_sketch_pic_path->getName();
					$newData['site_sketch_pic_path'] = $site_sketch_pic_path_name;
				}

				if($roof_top_pic_01 != ''){
					$roof_top_pic_01_path = $this->request->getFile('roof_top_pic_01_path');
					$roof_top_pic_01_path->move('./assets/uploads');
					$roof_top_pic_01_path_name = $roof_top_pic_01_path->getName();
					$newData['roof_top_pic_01_path'] = $roof_top_pic_01_path_name;
				}

				if($roof_top_pic_02 != ''){
					$roof_top_pic_02_path = $this->request->getFile('roof_top_pic_02_path');
					$roof_top_pic_02_path->move('./assets/uploads');
					$roof_top_pic_02_path_name = $roof_top_pic_02_path->getName();
					$newData['roof_top_pic_02_path'] = $roof_top_pic_02_path_name;
				}

				if($mdb_pic != ''){
					$mdb_pic_path = $this->request->getFile('mdb_pic_path');
					$mdb_pic_path->move('./assets/uploads');
					$mdb_pic_path_name = $mdb_pic_path->getName();
					$newData['mdb_pic_path'] = $mdb_pic_path_name;
				}

				if($inverter_placement_pic != ''){
					$inverter_placement_pic_path = $this->request->getFile('inverter_placement_pic_path');
					$inverter_placement_pic_path->move('./assets/uploads');
					$inverter_placement_pic_path_name = $inverter_placement_pic_path->getName();
					$newData['inverter_placement_pic_path'] = $inverter_placement_pic_path_name;
				}

				if($earth_point_pic != ''){
					$earth_point_pic_path = $this->request->getFile('earth_point_pic_path');
					$earth_point_pic_path->move('./assets/uploads');
					$earth_point_pic_path_name = $earth_point_pic_path->getName();
					$newData['earth_point_pic_path'] = $earth_point_pic_path_name;
				}

				if($motor_pic != ''){
					$motor_pic_path = $this->request->getFile('motor_pic_path');
					$motor_pic_path->move('./assets/uploads');
					$motor_pic_path_name = $motor_pic_path->getName();
					$newData['motor_pic_path'] = $motor_pic_path_name;
				}

				if($internal_wiring_pic != ''){
					$internal_wiring_pic_path = $this->request->getFile('internal_wiring_pic_path');
					$internal_wiring_pic_path->move('./assets/uploads');
					$internal_wiring_pic_path_name = $internal_wiring_pic_path->getName();
					$newData['internal_wiring_pic_path'] = $internal_wiring_pic_path_name;
				}

				if($optional_pic_01 != ''){
					$optional_pic_01_path = $this->request->getFile('optional_pic_01_path');
					if($optional_pic_01_path->isValid())
					{
						$optional_pic_01_path->move('./assets/uploads');
						$optional_pic_01_path_name = $optional_pic_01_path->getName();
						$newData['optional_pic_01_path'] = $optional_pic_01_path_name;
					}
					else
					{
						$optional_pic_01_path_name = "";
					}
				}

				if($optional_pic_02 != ''){
					$optional_pic_02_path = $this->request->getFile('optional_pic_02_path');
					if($optional_pic_02_path->isValid())
					{
						$optional_pic_02_path->move('./assets/uploads');
						$optional_pic_02_path_name = $optional_pic_02_path->getName();
						$newData['optional_pic_02_path'] = $optional_pic_02_path_name;
					}
					else
					{
						$optional_pic_02_path_name = "";
					}
				}

				if($optional_pic_03 != ''){
					$optional_pic_03_path = $this->request->getFile('optional_pic_03_path');
					if($optional_pic_03_path->isValid())
					{
						$optional_pic_03_path->move('./assets/uploads');
						$optional_pic_03_path_name = $optional_pic_03_path->getName();
						$newData['optional_pic_03_path'] = $optional_pic_03_path_name;
					}
					else
					{
						$optional_pic_03_path_name = "";
					}
				}

				if($optional_pic_04 != ''){

					$optional_pic_04_path = $this->request->getFile('optional_pic_04_path');
					if($optional_pic_04_path->isValid())
					{
						$optional_pic_04_path->move('./assets/uploads');
						$optional_pic_04_path_name = $optional_pic_04_path->getName();
						$newData['optional_pic_04_path'] = $optional_pic_04_path_name;
					}
					else
					{
						$optional_pic_04_path_name = "";
					}
				}

				if($optional_pic_05 != ''){
					$optional_pic_05_path = $this->request->getFile('optional_pic_05_path');
					if($optional_pic_05_path->isValid())
					{
						$optional_pic_05_path->move('./assets/uploads');
						$optional_pic_05_path_name = $optional_pic_05_path->getName();
						$newData['optional_pic_05_path'] = $optional_pic_05_path_name;
					}
					else
					{
						$optional_pic_05_path_name = "";
					}
				}

				if($rep_group_pic != ''){
					$rep_group_pic_path = $this->request->getFile('rep_group_pic_path');
					$rep_group_pic_path->move('./assets/uploads');
					$rep_group_pic_path_name = $rep_group_pic_path->getName();
					$newData['rep_group_pic_path'] = $rep_group_pic_path_name;
				}

                $servey_model->updateServey($this->request->getVar('site_id'), $newData);
				$session = session();
				$session->setFlashdata('success', 'Image Uploaded');
				return redirect()->to(base_url().'/serveys/survey_images/'.$this->request->getVar('site_id'));
			}
        }

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('serveys/survey_images');
		echo view('templates/footer');
	}

	public function edit($id)
	{
		$data 			= [];
		$serveys_model  = new Serveys_model();
        $data['servey'] = $serveys_model->getServeys($id);
		// dd($data);
		if ($this->request->getMethod() == 'post') {
			$rules = [
                'contractor_rep_name' => [
						'label' => 'Contractor Rep. Name',
						'rules' => 'required|max_length[255]'
				],
                'consultant_rep_name' => [
						'label' => 'Consultant Rep. Name',
						'rules' => 'required|max_length[255]'
				],
                'client_rep_name'               => [
						'label' => 'Client Rep. Name',
						'rules' => 'required|max_length[255]'
				],
                'address'                       => [
						'label' => 'Address',
						'rules' => 'required|max_length[255]'
				],
                'gps_coordinates_n_degree'             => [
						'label' => 'GPS Coordinates Degree(N)',
						'rules' => 'required'
				],
				'gps_coordinates_n_minute'             => [
						'label' => 'GPS Coordinates Minutes(N)',
						'rules' => 'required'
				],
				'gps_coordinates_n_second'             => [
						'label' => 'GPS Coordinates Seconds(N)',
						'rules' => 'required'
				],
                'gps_coordinates_e_degree'             => [
						'label' => 'GPS Coordinates Degree(E)',
						'rules' => 'required'
				],
				'gps_coordinates_e_minute'             => [
						'label' => 'GPS Coordinates Minutes(E)',
						'rules' => 'required'
				],
				'gps_coordinates_e_second'             => [
						'label' => 'GPS Coordinates Seconds(E)',
						'rules' => 'required'
				],
                'khatib_caretaker_name'         => [
						'label' => 'Khatib/ Caretaker Name',
						'rules' => 'required|max_length[255]'
				],
                'khatib_caretaker_cnic'         => [
						'label' => 'Khatib/ Caretaker CNIC',
						'rules' => 'required|max_length[255]'
				],
                'khatib_caretaker_cell_no'      => [
						'label' => 'Khatib/ Caretaker Cell No',
						'rules' => 'required|max_length[255]'
				],
                'inverter_pv_modules_distance'  => [
						'label' => 'Distance Between Inverter & PV Modules (ft.)',
						'rules' => 'required'
				],
                'inverter_earth_distance'       => [
						'label' => 'Distance Between Inverter & Earth (ft.)',
						'rules' => 'required'
				],
                'inverter_mdb_distance'         => [
						'label' => 'Distance Between Inverter & MDB (ft.)',
						'rules' => 'required'
				],
                'roof_top_type'                 => [
						'label' => 'Roof Top Type',
						'rules' => 'required'
				],
                'no_of_stories'                 => [
						'label' => 'No. of Stories',
						'rules' => 'required'
				],
                'mounting_type'                 => [
						'label' => 'Mounting Type',
						'rules' => 'required'
				],
                'motor_hp'                      => [
						'label' => 'Motor HP',
						'rules' => 'required'
				],
                'motor_ampere'                  => [
						'label' => 'Motor Ampere (A)',
						'rules' => 'required'
				],
                'motor_input_power'             => [
						'label' => 'Motor Input Power (W)',
						'rules' => 'required'
				],
                'motor_to_connect'              => [
						'label' => 'Motor to Connect',
						'rules' => 'required'
				],
                'existing_no_of_fans'           => [
						'label' => 'Existing Nos. of Fans',
						'rules' => 'required'
				],
                'existing_no_of_lights'         => [
						'label' => 'Existing Nos. of Lights',
						'rules' => 'required'
				],
                'existing_wiring_type'          => [
						'label' => 'Existing Wiring Type',
						'rules' => 'required'
				],
				'line_voltage'			        => [
						'label' => 'Line Voltage',
						'rules' => 'required'
				],
                'site_status'                   => [
						'label' => 'Status of Site',
						'rules' => 'required'
				],
                'site_feasibility'              => [
						'label' => 'Site Feasibility',
						'rules' => 'required'
				],
                'remarks'                       => [
						'label' => 'Remarks',
						'rules' => 'required'
				],

			];

			$khatib_caretaker_pic = dot_array_search('khatib_caretaker_pic_path.name', $_FILES);
			if($khatib_caretaker_pic != ''){
				$img = ['khatib_caretaker_pic_path'  => [
						'label' => 'Khatib/ Caretaker Pic',
						'rules' => 'uploaded[khatib_caretaker_pic_path]|max_size[khatib_caretaker_pic_path, 1024]|is_image[khatib_caretaker_pic_path]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$site_sketch_pic = dot_array_search('site_sketch_pic_path.name', $_FILES);
			if($site_sketch_pic != ''){
				$img = ['site_sketch_pic_path'  => [
						'label' => 'Site Sketch Pic',
						'rules' => 'uploaded[site_sketch_pic_path]|max_size[site_sketch_pic_path, 1024]|is_image[site_sketch_pic_path]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$roof_top_pic_01 = dot_array_search('roof_top_pic_01_path.name', $_FILES);
			if($roof_top_pic_01 != ''){
				$img = ['roof_top_pic_01_path'  => [
						'label' => 'Roof top Pic - 01',
						'rules' => 'uploaded[roof_top_pic_01_path]|max_size[roof_top_pic_01_path, 1024]|is_image[roof_top_pic_01_path]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$roof_top_pic_02 = dot_array_search('roof_top_pic_02_path.name', $_FILES);
			if($roof_top_pic_02 != ''){
				$img = ['roof_top_pic_02_path'  => [
						'label' => 'Roof top Pic - 02',
						'rules' => 'uploaded[roof_top_pic_02_path]|max_size[roof_top_pic_02_path, 1024]|is_image[roof_top_pic_02_path]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$mdb_pic = dot_array_search('mdb_pic_path.name', $_FILES);
			if($mdb_pic != ''){
				$img = ['mdb_pic_path'  => [
						'label' => 'MDB Pic',
						'rules' => 'uploaded[mdb_pic_path]|max_size[mdb_pic_path, 1024]|is_image[mdb_pic_path]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$inverter_placement_pic = dot_array_search('inverter_placement_pic_path.name', $_FILES);
			if($inverter_placement_pic != ''){
				$img = ['inverter_placement_pic_path'  => [
						'label' => 'Inverter Placement Pic',
						'rules' => 'uploaded[inverter_placement_pic_path]|max_size[inverter_placement_pic_path, 1024]|is_image[inverter_placement_pic_path]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$earth_point_pic = dot_array_search('earth_point_pic_path.name', $_FILES);
			if($earth_point_pic != ''){
				$img = ['earth_point_pic_path'  => [
						'label' => 'Earth Point Pic',
						'rules' => 'uploaded[earth_point_pic_path]|max_size[earth_point_pic_path, 1024]|is_image[earth_point_pic_path]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$motor_pic = dot_array_search('motor_pic_path.name', $_FILES);
			if($motor_pic != ''){
				$img = ['motor_pic_path'  => [
						'label' => 'Motor Pic',
						'rules' => 'uploaded[motor_pic_path]|max_size[motor_pic_path, 1024]|is_image[motor_pic_path]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$internal_wiring_pic = dot_array_search('internal_wiring_pic_path.name', $_FILES);
			if($internal_wiring_pic != ''){
				$img = ['internal_wiring_pic_path'  => [
						'label' => 'Internal Wiring Pic',
						'rules' => 'uploaded[internal_wiring_pic_path]|max_size[internal_wiring_pic_path, 1024]|is_image[internal_wiring_pic_path]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$optional_pic_01 = dot_array_search('optional_pic_01_path.name', $_FILES);
			if($optional_pic_01 != ''){
				$img = ['optional_pic_01_path'  => [
						'label' => 'Optional Pic-01',
						'rules' => 'uploaded[optional_pic_01_path]|max_size[optional_pic_01_path, 1024]|is_image[optional_pic_01_path]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$optional_pic_02 = dot_array_search('optional_pic_02_path.name', $_FILES);
			if($optional_pic_02 != ''){
				$img = ['optional_pic_02_path'  => [
						'label' => 'Optional Pic-02',
						'rules' => 'uploaded[optional_pic_02_path]|max_size[optional_pic_02_path, 1024]|is_image[optional_pic_02_path]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$optional_pic_03 = dot_array_search('optional_pic_03_path.name', $_FILES);
			if($optional_pic_03 != ''){
				$img = ['optional_pic_03_path'  => [
						'label' => 'Optional Pic-03',
						'rules' => 'uploaded[optional_pic_03_path]|max_size[optional_pic_03_path, 1024]|is_image[optional_pic_03_path]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$optional_pic_04 = dot_array_search('optional_pic_04_path.name', $_FILES);
			if($optional_pic_04 != ''){
				$img = ['optional_pic_04_path'  => [
						'label' => 'Optional Pic-04',
						'rules' => 'uploaded[optional_pic_04_path]|max_size[optional_pic_04_path, 1024]|is_image[optional_pic_04_path]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$optional_pic_05 = dot_array_search('optional_pic_05_path.name', $_FILES);
			if($optional_pic_05 != ''){
				$img = ['optional_pic_05_path'  => [
						'label' => 'Optional Pic-05',
						'rules' => 'uploaded[optional_pic_05_path]|max_size[optional_pic_05_path, 1024]|is_image[optional_pic_05_path]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			$rep_group_pic = dot_array_search('rep_group_pic_path.name', $_FILES);
			if($rep_group_pic != ''){
				$img = ['rep_group_pic_path'  => [
						'label' => 'Rep. Group Pic',
						'rules' => 'uploaded[rep_group_pic_path]|max_size[rep_group_pic_path, 1024]|is_image[rep_group_pic_path]'
					]
				];
				$rules = array_merge($rules, $img);
			}

			if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
			}else{
				$servey_model = new Serveys_model();

				$newData = [
                    'contractor_rep_name'           => $this->request->getVar('contractor_rep_name'),
                    'consultant_rep_name'           => $this->request->getVar('consultant_rep_name'),
                    'client_rep_name'               => $this->request->getVar('client_rep_name'),
                    'address'                       => $this->request->getVar('address'),
					'gps_coordinates_n'             => ($this->request->getVar('gps_coordinates_n_degree').' '.$this->request->getVar('gps_coordinates_n_minute').' '.$this->request->getVar('gps_coordinates_n_second')),
					'gps_coordinates_e'             => ($this->request->getVar('gps_coordinates_e_degree').' '.$this->request->getVar('gps_coordinates_e_minute').' '.$this->request->getVar('gps_coordinates_e_second')),
                    'khatib_caretaker_name'         => $this->request->getVar('khatib_caretaker_name'),
                    'khatib_caretaker_cnic'         => $this->request->getVar('khatib_caretaker_cnic'),
                    'khatib_caretaker_cell_no'      => $this->request->getVar('khatib_caretaker_cell_no'),
                    'inverter_pv_modules_distance'  => $this->request->getVar('inverter_pv_modules_distance'),
                    'inverter_earth_distance'       => $this->request->getVar('inverter_earth_distance'),
                    'inverter_mdb_distance'         => $this->request->getVar('inverter_mdb_distance'),
                    'roof_top_type'                 => $this->request->getVar('roof_top_type'),
                    'no_of_stories'                 => $this->request->getVar('no_of_stories'),
                    'mounting_type'                 => $this->request->getVar('mounting_type'),
                    'motor_hp'                      => $this->request->getVar('motor_hp'),
                    'motor_ampere'                  => $this->request->getVar('motor_ampere'),
                    'motor_input_power'             => $this->request->getVar('motor_input_power'),
                    'motor_to_connect'              => $this->request->getVar('motor_to_connect'),
                    'existing_no_of_fans'           => $this->request->getVar('existing_no_of_fans'),
                    'existing_no_of_lights'         => $this->request->getVar('existing_no_of_lights'),
					'existing_wiring_type'          => $this->request->getVar('existing_wiring_type'),
					'line_voltage'          		=> $this->request->getVar('line_voltage'),
                    'site_status'                   => $this->request->getVar('site_status'),
                    'problem_description'           => $this->request->getVar('problem_description'),
                    'site_feasibility'              => $this->request->getVar('site_feasibility'),
					'remarks'                       => $this->request->getVar('remarks'),
					'status'                        => 0,
                    'site_id'                       => $this->request->getVar('site_id'),
				];

				if($khatib_caretaker_pic != ''){
					$khatib_caretaker_pic_path = $this->request->getFile('khatib_caretaker_pic_path');
					$khatib_caretaker_pic_path->move('./assets/uploads');
					$khatib_caretaker_pic_path_name = $khatib_caretaker_pic_path->getName();
					$newData['khatib_caretaker_pic_path'] = $khatib_caretaker_pic_path_name;
				}

				if($site_sketch_pic != ''){
					$site_sketch_pic_path = $this->request->getFile('site_sketch_pic_path');
					$site_sketch_pic_path->move('./assets/uploads');
					$site_sketch_pic_path_name = $site_sketch_pic_path->getName();
					$newData['site_sketch_pic_path'] = $site_sketch_pic_path_name;
				}

				if($roof_top_pic_01 != ''){
					$roof_top_pic_01_path = $this->request->getFile('roof_top_pic_01_path');
					$roof_top_pic_01_path->move('./assets/uploads');
					$roof_top_pic_01_path_name = $roof_top_pic_01_path->getName();
					$newData['roof_top_pic_01_path'] = $roof_top_pic_01_path_name;
				}

				if($roof_top_pic_02 != ''){
					$roof_top_pic_02_path = $this->request->getFile('roof_top_pic_02_path');
					$roof_top_pic_02_path->move('./assets/uploads');
					$roof_top_pic_02_path_name = $roof_top_pic_02_path->getName();
					$newData['roof_top_pic_02_path'] = $roof_top_pic_02_path_name;
				}

				if($mdb_pic != ''){
					$mdb_pic_path = $this->request->getFile('mdb_pic_path');
					$mdb_pic_path->move('./assets/uploads');
					$mdb_pic_path_name = $mdb_pic_path->getName();
					$newData['mdb_pic_path'] = $mdb_pic_path_name;
				}

				if($inverter_placement_pic != ''){
					$inverter_placement_pic_path = $this->request->getFile('inverter_placement_pic_path');
					$inverter_placement_pic_path->move('./assets/uploads');
					$inverter_placement_pic_path_name = $inverter_placement_pic_path->getName();
					$newData['inverter_placement_pic_path'] = $inverter_placement_pic_path_name;
				}

				if($earth_point_pic != ''){
					$earth_point_pic_path = $this->request->getFile('earth_point_pic_path');
					$earth_point_pic_path->move('./assets/uploads');
					$earth_point_pic_path_name = $earth_point_pic_path->getName();
					$newData['earth_point_pic_path'] = $earth_point_pic_path_name;
				}

				if($motor_pic != ''){
					$motor_pic_path = $this->request->getFile('motor_pic_path');
					$motor_pic_path->move('./assets/uploads');
					$motor_pic_path_name = $motor_pic_path->getName();
					$newData['motor_pic_path'] = $motor_pic_path_name;
				}

				if($internal_wiring_pic != ''){
					$internal_wiring_pic_path = $this->request->getFile('internal_wiring_pic_path');
					$internal_wiring_pic_path->move('./assets/uploads');
					$internal_wiring_pic_path_name = $internal_wiring_pic_path->getName();
					$newData['internal_wiring_pic_path'] = $internal_wiring_pic_path_name;
				}

				if($optional_pic_01 != ''){
					$optional_pic_01_path = $this->request->getFile('optional_pic_01_path');
					if($optional_pic_01_path->isValid())
					{
						$optional_pic_01_path->move('./assets/uploads');
						$optional_pic_01_path_name = $optional_pic_01_path->getName();
						$newData['optional_pic_01_path'] = $optional_pic_01_path_name;
					}
					else
					{
						$optional_pic_01_path_name = "";
					}
				}

				if($optional_pic_02 != ''){
					$optional_pic_02_path = $this->request->getFile('optional_pic_02_path');
					if($optional_pic_02_path->isValid())
					{
						$optional_pic_02_path->move('./assets/uploads');
						$optional_pic_02_path_name = $optional_pic_02_path->getName();
						$newData['optional_pic_02_path'] = $optional_pic_02_path_name;
					}
					else
					{
						$optional_pic_02_path_name = "";
					}
				}

				if($optional_pic_03 != ''){
					$optional_pic_03_path = $this->request->getFile('optional_pic_03_path');
					if($optional_pic_03_path->isValid())
					{
						$optional_pic_03_path->move('./assets/uploads');
						$optional_pic_03_path_name = $optional_pic_03_path->getName();
						$newData['optional_pic_03_path'] = $optional_pic_03_path_name;
					}
					else
					{
						$optional_pic_03_path_name = "";
					}
				}

				if($optional_pic_04 != ''){

					$optional_pic_04_path = $this->request->getFile('optional_pic_04_path');
					if($optional_pic_04_path->isValid())
					{
						$optional_pic_04_path->move('./assets/uploads');
						$optional_pic_04_path_name = $optional_pic_04_path->getName();
						$newData['optional_pic_04_path'] = $optional_pic_04_path_name;
					}
					else
					{
						$optional_pic_04_path_name = "";
					}
				}

				if($optional_pic_05 != ''){
					$optional_pic_05_path = $this->request->getFile('optional_pic_05_path');
					if($optional_pic_05_path->isValid())
					{
						$optional_pic_05_path->move('./assets/uploads');
						$optional_pic_05_path_name = $optional_pic_05_path->getName();
						$newData['optional_pic_05_path'] = $optional_pic_05_path_name;
					}
					else
					{
						$optional_pic_05_path_name = "";
					}
				}

				if($rep_group_pic != ''){
					$rep_group_pic_path = $this->request->getFile('rep_group_pic_path');
					$rep_group_pic_path->move('./assets/uploads');
					$rep_group_pic_path_name = $rep_group_pic_path->getName();
					$newData['rep_group_pic_path'] = $rep_group_pic_path_name;
				}

                $servey_model->updateServey($this->request->getVar('site_id'), $newData);
								$session = session();
								$session->setFlashdata('success', 'Servey Updated Successfully');
								return redirect()->to(base_url().'/serveys/manage');

			}
        }

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('serveys/edit');
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
