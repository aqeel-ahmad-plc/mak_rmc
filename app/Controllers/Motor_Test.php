<?php namespace App\Controllers;

use App\Models\Motor_Test_model;
use App\Models\No_Load_Test_model;
use App\Models\Load_Test_model;

use FPDF;

class PDF extends FPDF
{
	var $widths;
	var $aligns;
	/* Page header */
	function Header()
	{
		/* Logo */
		//$this->Image(base_url().'/assets/images/logo_2.png',10,6,15);
		/* Move to the right */
		$this->Cell(70);
		$this->SetFont('Arial','B',20);
		$this->Cell(50,15,'MOTOR EFFICIENCY TEST REPORT',0,0,'C');
		$this->Ln(10);
		$this->SetFont('Arial','B',12);
		$this->Cell(180 ,15,' IEEE 112 METHOD A',0,1,'C');
		//$this->Line(0, 25, 210, 25);

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

	function ImprovedTable($header, $data)
	{
			// Column widths
			$w = array(40, 35, 40, 45);
			// Header
			for($i=0;$i<count($header);$i++)
					$this->Cell($w[$i],7,$header[$i],1,0,'C');
			$this->Ln();
			// Data
			foreach($data as $row)
			{
					$this->Cell($w[0],6,$row[0],1,0,'LR');
					$this->Cell($w[1],6,$row[1],1,0,'LR');
					$this->Cell($w[2],6,number_format($row[2]),1,0,'R');
					$this->Cell($w[3],6,number_format($row[3]),1,0,'R');
					$this->Ln();
			}
			// Closing line
			$this->Cell(array_sum($w),0,'','T');
	}

}


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

				$motor_tests_model->updateTestStatus($this->request->getVar('test_id'), $updateData);
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
					'rpm_load' => $this->request->getVar('load_test_rpm'),
					'torque' => $this->request->getVar('load_test_torque'),
					'shaft_power' =>  $this->request->getVar('load_test_shaft_power'),
					'loading_factor' => $this->request->getVar('loading_factor_load'),
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
					'estimated_efficiency' => $this->request->getVar('motor_efficiency_load_test'),
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

	// Better table




	public function complete_test($test_id){

		$motor_tests_model = new Motor_Test_model();
		//update motor test status
		$updateData = [];
		$updateData['test_status'] = 2;
		$motor_tests_model->updateTestStatus($test_id, $updateData);
    //get all test data
		$motor_tests  = $motor_tests_model->getMotorTest();

		$data['motor_tests'] 	= $motor_tests ;
		echo view('templates/header', $data);
		echo view('templates/sidebar');
		echo view('motor_test/manage');
		echo view('templates/footer');

	}

	public function generate_report($id){

		$pdf = new PDF();
		$pdf->AddPage();
		$motor_tests_model = new Motor_Test_model();
		$result = $motor_tests_model->getMotorTestData($id);
		// print_r($result[0]['test_report_no']);

		/*output the result*/

		$pdf->SetFont('Arial','B',16);
		// $pdf->Cell(150 ,5,'',0,1);
		$pdf->Ln(10);
		$pdf->Cell(130 ,5,'TEST REPORT NO. '.$result[0]['test_report_no'],0,1,'R');
		$pdf->SetFont('Arial','B',13);
		$pdf->Ln(2);
		$pdf->Cell(110 ,5,date('D', strtotime($result[0]['test_date'])).', '.$result[0]['test_date'],0,1,'R');

		$pdf->Ln(20);

    //need uncomment
		//$pdf->Cell(10 ,10,$pdf->Image(base_url().'/assets/images/lab1.png',10,75,60),0,1,'R');
		//$pdf->Cell(10 ,10,$pdf->Image(base_url().'/assets/images/lab2.png',70,75,60),0,1,'R');
		//$pdf->Cell(10 ,10,$pdf->Image(base_url().'/assets/images/lab3.png',130,75,60),0,1,'R');

		$pdf->Ln(20);
    //need uncomment
		//$pdf->Cell(10 ,100,$pdf->Image(base_url().'/assets/images/komax_logo.png',70,180,60),0,1,'R');


		//Second page

		$pdf->AddPage();
		$motor_tests_model = new Motor_Test_model();
		$result = $motor_tests_model->getMotorTestData($id);

		/*output the result*/

		$pdf->SetFont('Arial','',12);
		$pdf->Cell(150 ,5,'',0,1);

		//need uncomment
		//$pdf->Cell(5 ,5,$pdf->Image(base_url().'/assets/images/komax_logo.png',5,5,20),0,1,'R');


		// Header
		$pdf->Cell(40,6,'TEST REPORT NO.',1,0,'C');
		$pdf->Cell(70,6,$result[0]['test_report_no'],1,0,'C');
		$pdf->Cell(30,6,'DATED',1,0,'LR');
		$pdf->Cell(55,6,$result[0]['test_date'],1,0,'C');
		$pdf->Ln();
		$pdf->Cell(40,6,'MOTOR MODEL',1,0,'LR');
		$pdf->Cell(70,6,$result[0]['test_report_no'],1,0,'C');
		$pdf->Cell(30,6,'SR. NO.',1,0,'LR');
		$pdf->Cell(55,6,$result[0]['test_date'],1,0,'C');
		$pdf->Ln(10);
		$pdf->SetFont('Arial','B',12);
		$pdf->SetFillColor(0,0,0);
    $pdf->SetTextColor(255,255,255);
		$pdf->Cell(195,6,'1. MOTOR PICTURE(S)',1,0,'C', true);
		$pdf->Ln(10);

		//need uncomment
		//$pdf->Cell(10 ,100,$pdf->Image(base_url().'/assets/uploads/'.$result[0]['motor_pic'],70,100,60),0,1,'R');

		$pdf->Cell(195,6,'2. MOTOR NAME PLATE DATA',1,0,'C', true);
		$pdf->Ln(10);

		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0,0,0);




		$pdf->SetFont('Arial','',12);
		$pdf->Cell(70,6,$result[0]['motor_manufacturer'],0,0,'LR');
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(40,6,'MANUFACTURER',0,0,'LR');
    $pdf->Cell(50,6,'',0,0,'LR');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(10,6,$result[0]['motor_rated_pf'],0,0,'LR');
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(10,6,'PF',0,0,'LR');
		$pdf->Ln();
    $pdf->SetFont('Arial','',12);
		$pdf->Cell(70,6,$result[0]['motor_model'],0,0,'LR');
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(40,6,'MODEL',0,0,'LR');
    $pdf->Cell(50,6,'',0,0,'LR');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(10,6,$result[0]['motor_rated_rpm'],0,0,'LR');
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(10,6,'RPM',0,0,'LR');
		$pdf->Ln();
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(70,6,$result[0]['motor_type'],0,0,'LR');
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(40,6,'TYPE',0,0,'LR');
		$pdf->Cell(50,6,'',0,0,'LR');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(10,6,$result[0]['no_of_poles'],0,0,'LR');
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(10,6,'POLE',0,0,'LR');
		$pdf->Ln();
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(70,6,$result[0]['motor_type'],0,0,'LR');
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(40,6,'FRAME',0,0,'LR');
		$pdf->Cell(50,6,'',0,0,'LR');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(10,6,$result[0]['efficiency'],0,0,'LR');
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(10,6,'EFFICIENCY',0,0,'LR');
		$pdf->Ln();
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(70,6,$result[0]['number_of_phase'],0,0,'C');
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(40,6,'PHASE',0,0,'LR');
		$pdf->Cell(50,6,'',0,0,'LR');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(10,6,$result[0]['number_of_phase'],0,0,'C');
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(10,6,'DUTY',0,0,'LR');
		$pdf->Ln();
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(70,6,$result[0]['motor_rated_kw'],0,0,'C');
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(40,6,'KW',0,0,'LR');
		$pdf->Cell(50,6,'',0,0,'LR');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(10,6,$result[0]['insulation_class'],0,0,'C');
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(10,6,'INS. CLASS',0,0,'LR');
		$pdf->Ln();
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(70,6,$result[0]['motor_rated_hp'],0,0,'C');
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(40,6,'HP',0,0,'LR');
		$pdf->Cell(50,6,'',0,0,'LR');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(10,6,$result[0]['insulation_class'],0,0,'C');
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(10,6,'IC',0,0,'LR');

		$pdf->Ln();
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(70,6,$result[0]['motor_rated_voltage'],0,0,'C');
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(40,6,'VOLTS',0,0,'LR');
		$pdf->Cell(50,6,'',0,0,'LR');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(10,6,$result[0]['ip_rating'],0,0,'C');
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(10,6,'IP',0,0,'LR');

		$pdf->Ln();
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(70,6,$result[0]['motor_rated_frequency'],0,0,'C');
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(40,6,'HERTZ',0,0,'LR');
		$pdf->Cell(40,6,'',0,0,'LR');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(20,6,$result[0]['connection_type'],0,0,'C');
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(10,6,'CONNECTION',0,0,'LR');

		$pdf->Ln();
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(70,6,$result[0]['motor_rated_current'],0,0,'C');
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(40,6,'AMPS',0,0,'LR');

		$pdf->SetFont('Arial','',12);
		$pdf->Cell(60,6,$result[0]['motor_sno'],0,0,'C');
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(10,6,'SR. NO.',0,0,'LR');


		$rated_curves = json_decode($result[0]['rated_curves'],true);


		/******************** 3. MOTOR RATED DATA ***************************/




		$pdf->Ln(10);
		$pdf->SetFont('Arial','B',12);
		$pdf->SetFillColor(0,0,0);
		$pdf->SetTextColor(255,255,255);
		$pdf->Cell(195,6,'3. MOTOR RATED DATA',1,0,'C', true);
		$pdf->Ln();

		$pdf->SetFont('Arial','',12);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0,0,0);



		$pdf->Cell(5,6,'1',1,0,'C');
		$pdf->Cell(50,6,'Shaft Power (P2), in kW',1,0,'C');
		$pdf->Cell(20,6,$rated_curves['shaft_power_p2_1'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['shaft_power_p2_2'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['shaft_power_p2_3'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['shaft_power_p2_4'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['shaft_power_p2_5'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['shaft_power_p2_6'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['shaft_power_p2_7'],1,0,'C');

		$pdf->Ln();
		$pdf->Cell(5,6,'2',1,0,'LR');
		$pdf->Cell(50,6,'Efficiency, in %',1,0,'C');
		$pdf->Cell(20,6,$rated_curves['efficiency_in_percent_1'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['efficiency_in_percent_2'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['efficiency_in_percent_3'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['efficiency_in_percent_4'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['efficiency_in_percent_5'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['efficiency_in_percent_6'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['efficiency_in_percent_7'],1,0,'C');

		$pdf->Ln();
		$pdf->Cell(5,6,'3',1,0,'LR');
		$pdf->Cell(50,6,'Speed, in RPM',1,0,'C');
		$pdf->Cell(20,6,$rated_curves['speed_in_rpm_1'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['speed_in_rpm_2'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['speed_in_rpm_3'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['speed_in_rpm_4'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['speed_in_rpm_5'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['speed_in_rpm_6'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['speed_in_rpm_7'],1,0,'C');
		$k = $result[0]['motor_rated_frequency'];
		$o = $result[0]['no_of_poles'];


		$slip_in_pu_1 = ((120*($k/$o)) - ($rated_curves['speed_in_rpm_1']))/(120*($k/$o));$slip_in_pu_1 = number_format((float)$slip_in_pu_1, 2, '.', '');
		$slip_in_pu_2 = ((120*($k/$o)) - ($rated_curves['speed_in_rpm_2']))/(120*($k/$o));$slip_in_pu_2 = number_format((float)$slip_in_pu_2, 2, '.', '');
		$slip_in_pu_3 = ((120*($k/$o)) - ($rated_curves['speed_in_rpm_3']))/(120*($k/$o));$slip_in_pu_3 = number_format((float)$slip_in_pu_3, 2, '.', '');
		$slip_in_pu_4 = ((120*($k/$o)) - ($rated_curves['speed_in_rpm_4']))/(120*($k/$o));$slip_in_pu_4 = number_format((float)$slip_in_pu_4, 2, '.', '');
		$slip_in_pu_5 = ((120*($k/$o)) - ($rated_curves['speed_in_rpm_5']))/(120*($k/$o));$slip_in_pu_5 = number_format((float)$slip_in_pu_5, 2, '.', '');
		$slip_in_pu_6 = ((120*($k/$o)) - ($rated_curves['speed_in_rpm_6']))/(120*($k/$o));$slip_in_pu_6 = number_format((float)$slip_in_pu_6, 2, '.', '');
		$slip_in_pu_7 = ((120*($k/$o)) - ($rated_curves['speed_in_rpm_7']))/(120*($k/$o));$slip_in_pu_7 = number_format((float)$slip_in_pu_7, 2, '.', '');


		$pdf->Ln();
		$pdf->Cell(5,6,'4',1,0,'LR');
		$pdf->Cell(50,6,'Slip, in p.u.',1,0,'C');
		$pdf->Cell(20,6,$slip_in_pu_1,1,0,'C');
		$pdf->Cell(20,6,$slip_in_pu_2,1,0,'C');
		$pdf->Cell(20,6,$slip_in_pu_3,1,0,'C');
		$pdf->Cell(20,6,$slip_in_pu_4,1,0,'C');
		$pdf->Cell(20,6,$slip_in_pu_5,1,0,'C');
		$pdf->Cell(20,6,$slip_in_pu_6,1,0,'C');
		$pdf->Cell(20,6,$slip_in_pu_7,1,0,'C');


		$pdf->Ln();
		$pdf->Cell(5,6,'5',1,0,'LR');
		$pdf->Cell(50,6,'Current, in Amps',1,0,'C');
		$pdf->Cell(20,6,$rated_curves['current_in_amps_1'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['current_in_amps_2'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['current_in_amps_3'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['current_in_amps_4'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['current_in_amps_5'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['current_in_amps_6'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['current_in_amps_7'],1,0,'C');

		$pdf->Ln();
		$pdf->Cell(5,6,'6',1,0,'LR');
		$pdf->Cell(50,6,'CosØ, in %',1,0,'C');
		$pdf->Cell(20,6,$rated_curves['cos_in_percent_1'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['cos_in_percent_2'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['cos_in_percent_3'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['cos_in_percent_4'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['cos_in_percent_5'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['cos_in_percent_6'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['cos_in_percent_7'],1,0,'C');

		$pdf->Ln();

		/******************** 4. MAXIMUM ALLOWED DEVIATION FROM RATED DATA AS PER IEC 60034-1 TABLE-20 ***************************/

		$pdf->SetFont('Arial','B',12);
		$pdf->SetFillColor(0,0,0);
		$pdf->SetTextColor(255,255,255);
		$pdf->Cell(195,6,'4. MAXIMUM ALLOWED DEVIATION FROM RATED DATA AS PER IEC 60034-1 TABLE-20',1,0,'C', true);
		$pdf->Ln();

		$pdf->SetFont('Arial','',12);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0,0,0);



		$pdf->Cell(5,6,'1',1,0,'C');
		$pdf->Cell(50,6,'Shaft Power (P2), in kW',1,0,'C');
		$pdf->Cell(20,6,$rated_curves['shaft_power_p2_1'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['shaft_power_p2_2'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['shaft_power_p2_3'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['shaft_power_p2_4'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['shaft_power_p2_5'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['shaft_power_p2_6'],1,0,'C');
		$pdf->Cell(20,6,$rated_curves['shaft_power_p2_7'],1,0,'C');
    $efactor = 0;
		$pdf->Ln();
		if($result[0]['motor_rated_kw'] > 150){
			$efactor = 0.1;
		}else{
			$efactor = 0.15;
		}


		$eff_percent_1 = ($rated_curves['efficiency_in_percent_1'] - ($efactor * (100 - $rated_curves['efficiency_in_percent_1'])));
    $eff_percent_2 = ($rated_curves['efficiency_in_percent_2'] - ($efactor * (100 - $rated_curves['efficiency_in_percent_2'])));
    $eff_percent_3 = ($rated_curves['efficiency_in_percent_3'] - ($efactor * (100 - $rated_curves['efficiency_in_percent_3'])));
    $eff_percent_4 = ($rated_curves['efficiency_in_percent_4'] - ($efactor * (100 - $rated_curves['efficiency_in_percent_4'])));
    $eff_percent_5 = ($rated_curves['efficiency_in_percent_5'] - ($efactor * (100 - $rated_curves['efficiency_in_percent_5'])));
    $eff_percent_6 = ($rated_curves['efficiency_in_percent_6'] - ($efactor * (100 - $rated_curves['efficiency_in_percent_6'])));
    $eff_percent_7 = ($rated_curves['efficiency_in_percent_7'] - ($efactor * (100 - $rated_curves['efficiency_in_percent_7'])));



		$pdf->Cell(5,6,'2',1,0,'LR');
		$pdf->Cell(50,6,'Efficiency, in %',1,0,'C');
		$pdf->Cell(20,6,($eff_percent_1 < 0) ? 0 : $eff_percent_1,1,0,'C');
		$pdf->Cell(20,6,($eff_percent_2 < 0) ? 0 : $eff_percent_2,1,0,'C');
		$pdf->Cell(20,6,($eff_percent_3 < 0) ? 0 : $eff_percent_3,1,0,'C');
		$pdf->Cell(20,6,($eff_percent_4 < 0) ? 0 : $eff_percent_4,1,0,'C');
		$pdf->Cell(20,6,($eff_percent_5 < 0) ? 0 : $eff_percent_5,1,0,'C');
		$pdf->Cell(20,6,($eff_percent_6 < 0) ? 0 : $eff_percent_6,1,0,'C');
		$pdf->Cell(20,6,($eff_percent_7 < 0) ? 0 : $eff_percent_7,1,0,'C');

		$sfactor = 0;
		if($result[0]['motor_rated_kw'] >= 1){
			$sfactor = 0.2;
		}else{
			$sfactor = 0.3;
		}
    $max_speed_rpm_1 = (120*($k/$o))*(1-($slip_in_pu_1-($slip_in_pu_1 * $sfactor)));
		$max_speed_rpm_2 = (120*($k/$o))*(1-($slip_in_pu_2-($slip_in_pu_2 * $sfactor)));
		$max_speed_rpm_3 = (120*($k/$o))*(1-($slip_in_pu_3-($slip_in_pu_3 * $sfactor)));
		$max_speed_rpm_4 = (120*($k/$o))*(1-($slip_in_pu_4-($slip_in_pu_4 * $sfactor)));
		$max_speed_rpm_5 = (120*($k/$o))*(1-($slip_in_pu_5-($slip_in_pu_5 * $sfactor)));
		$max_speed_rpm_6 = (120*($k/$o))*(1-($slip_in_pu_6-($slip_in_pu_6 * $sfactor)));
		$max_speed_rpm_7 = (120*($k/$o))*(1-($slip_in_pu_7-($slip_in_pu_7 * $sfactor)));

		$pdf->Ln();
		$pdf->Cell(5,6,'3',1,0,'LR');
		$pdf->Cell(50,6,'Max Speed, in RPM',1,0,'C');
		$pdf->Cell(20,6,$max_speed_rpm_1,1,0,'C');
		$pdf->Cell(20,6,$max_speed_rpm_2,1,0,'C');
		$pdf->Cell(20,6,$max_speed_rpm_3,1,0,'C');
		$pdf->Cell(20,6,$max_speed_rpm_4,1,0,'C');
		$pdf->Cell(20,6,$max_speed_rpm_5,1,0,'C');
		$pdf->Cell(20,6,$max_speed_rpm_6,1,0,'C');
		$pdf->Cell(20,6,$max_speed_rpm_7,1,0,'C');

		$min_speed_rpm_1 = (120*($k/$o))*(1-($slip_in_pu_1+($slip_in_pu_1 * $sfactor)));
		$min_speed_rpm_2 = (120*($k/$o))*(1-($slip_in_pu_2+($slip_in_pu_2 * $sfactor)));
		$min_speed_rpm_3 = (120*($k/$o))*(1-($slip_in_pu_3+($slip_in_pu_3 * $sfactor)));
		$min_speed_rpm_4 = (120*($k/$o))*(1-($slip_in_pu_4+($slip_in_pu_4 * $sfactor)));
		$min_speed_rpm_5 = (120*($k/$o))*(1-($slip_in_pu_5+($slip_in_pu_5 * $sfactor)));
		$min_speed_rpm_6 = (120*($k/$o))*(1-($slip_in_pu_6+($slip_in_pu_6 * $sfactor)));
		$min_speed_rpm_7 = (120*($k/$o))*(1-($slip_in_pu_7+($slip_in_pu_7 * $sfactor)));


		$pdf->Ln();
		$pdf->Cell(5,6,'3',1,0,'LR');
		$pdf->Cell(50,6,'Min Speed, in RPM',1,0,'C');
		$pdf->Cell(20,6,$min_speed_rpm_1,1,0,'C');
		$pdf->Cell(20,6,$min_speed_rpm_2,1,0,'C');
		$pdf->Cell(20,6,$min_speed_rpm_3,1,0,'C');
		$pdf->Cell(20,6,$min_speed_rpm_4,1,0,'C');
		$pdf->Cell(20,6,$min_speed_rpm_5,1,0,'C');
		$pdf->Cell(20,6,$min_speed_rpm_6,1,0,'C');
		$pdf->Cell(20,6,$min_speed_rpm_7,1,0,'C');

		$pfactor = abs(0.16 * (100 - $rated_curves['cos_in_percent_1']));
		$pfactor = ($pfactor > 7) ? 7 : $pfactor;
		$pfactor = ($pfactor < 2) ? 2 : $pfactor;





		$pdf->Ln();
		$pdf->Cell(5,6,'6',1,0,'LR');
		$pdf->Cell(50,6,'CosØ, in %',1,0,'C');
		$pdf->Cell(20,6,$rated_curves['cos_in_percent_1'] - $pfactor ,1,0,'C');
		$pdf->Cell(20,6,$rated_curves['cos_in_percent_2'] - $pfactor ,1,0,'C');
		$pdf->Cell(20,6,$rated_curves['cos_in_percent_3'] - $pfactor ,1,0,'C');
		$pdf->Cell(20,6,$rated_curves['cos_in_percent_4'] - $pfactor ,1,0,'C');
		$pdf->Cell(20,6,$rated_curves['cos_in_percent_5'] - $pfactor ,1,0,'C');
		$pdf->Cell(20,6,$rated_curves['cos_in_percent_6'] - $pfactor ,1,0,'C');
		$pdf->Cell(20,6,$rated_curves['cos_in_percent_7'] - $pfactor ,1,0,'C');








		//$pdf->ImprovedTable($header,$data);
		// $pdf->Cell(130 ,5,'TEST REPORT NO. '.$result[0]['test_report_no'],0,1,'R');
		// $pdf->SetFont('Arial','B',13);
		//
		// $pdf->Cell(110 ,5,date('D', strtotime($result[0]['test_date'])).', '.$result[0]['test_date'],0,1,'R');



		//$pdf->Cell(50 ,5,'',0,1);
		// $pdf->SetFont('Arial','B',10);
		// /*Heading Of the table*/
		// $pdf->Cell(20 ,5,'Sr. No',1,0,'L');
		// $pdf->Cell(40 ,5,'Site ID',1,0,'L');
		// $pdf->Cell(40 ,5,'Masjid Name',1,0,'L');
		// $pdf->Cell(40 ,5,'District',1,0,'L');
		// $pdf->Cell(40 ,5,'Problem Description',1,1,'L');
		// /*Heading Of the table end*/
		// $pdf->SetFont('Arial','',8);
		// $pdf->SetWidths(array(20,40,40,40,40));
		// $index  = 0;
		// for ($i = 0; $i < sizeof($serveys); $i++) {
		// 	if($serveys[$i]['site_status'] == "0")
		// 	{
		// 		$pdf->Row(array($index,$serveys[$i]['siteid'],$serveys[$i]['masgid'],$serveys[$i]['district'],$serveys[$i]['problem_description']));
		// 		$index++;
		// 	}
		// }
		// if ($index == 0)
		// {
		// 	$pdf->Cell(160, 5, "No Not-Ok Sites found", 1, 1, 'C');
		// }

		$pdf->Output('D','Test_Report.pdf');
  }


}
