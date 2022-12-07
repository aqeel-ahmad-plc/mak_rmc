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
		//Set the array of column widthf
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
	function WordWrap(&$text, $maxwidth)
{
    $text = trim($text);
    if ($text==='')
        return 0;
    $space = $this->GetStringWidth(' ');
    $lines = explode("\n", $text);
    $text = '';
    $count = 0;

    foreach ($lines as $line)
    {
        $words = preg_split('/ +/', $line);
        $width = 0;

        foreach ($words as $word)
        {
            $wordwidth = $this->GetStringWidth($word);
            if ($wordwidth > $maxwidth)
            {
                // Word is too long, we cut it
                for($i=0; $i<strlen($word); $i++)
                {
                    $wordwidth = $this->GetStringWidth(substr($word, $i, 1));
                    if($width + $wordwidth <= $maxwidth)
                    {
                        $width += $wordwidth;
                        $text .= substr($word, $i, 1);
                    }
                    else
                    {
                        $width = $wordwidth;
                        $text = rtrim($text)."\n".substr($word, $i, 1);
                        $count++;
                    }
                }
            }
            elseif($width + $wordwidth <= $maxwidth)
            {
                $width += $wordwidth + $space;
                $text .= $word.' ';
            }
            else
            {
                $width = $wordwidth + $space;
                $text = rtrim($text)."\n".$word.' ';
                $count++;
            }
        }
        $text = rtrim($text)."\n";
        $count++;
    }
    $text = rtrim($text);
    return $count;
}
function LineGraph($w, $h, $data, $options='', $colors=null, $maxVal=0, $nbDiv=4){
        /*******************************************
        Explain the variables:
        $w = the width of the diagram
        $h = the height of the diagram
        $data = the data for the diagram in the form of a multidimensional array
        $options = the possible formatting options which include:
            'V' = Print Vertical Divider lines
            'H' = Print Horizontal Divider Lines
            'kB' = Print bounding box around the Key (legend)
            'vB' = Print bounding box around the values under the graph
            'gB' = Print bounding box around the graph
            'dB' = Print bounding box around the entire diagram
        $colors = A multidimensional array containing RGB values
        $maxVal = The Maximum Value for the graph vertically
        $nbDiv = The number of vertical Divisions
        *******************************************/
        $this->SetDrawColor(0,0,0);
        $this->SetLineWidth(0.2);
        $keys = array_keys($data);
        $ordinateWidth = 10;
        $w -= $ordinateWidth;
        $valX = $this->getX()+$ordinateWidth;
        $valY = $this->getY();
        $margin = 1;
        $titleH = 8;
        $titleW = $w;
        $lineh = 5;
        $keyH = count($data)*$lineh;
        $keyW = $w/5;
        $graphValH = 5;
        $graphValW = $w-$keyW-3*$margin;
        $graphH = $h-(3*$margin)-$graphValH;
        $graphW = $w-(2*$margin)-($keyW+$margin);
        $graphX = $valX+$margin;
        $graphY = $valY+$margin;
        $graphValX = $valX+$margin;
        $graphValY = $valY+2*$margin+$graphH;
        $keyX = $valX+(2*$margin)+$graphW;
        $keyY = $valY+$margin+.5*($h-(2*$margin))-.5*($keyH);
        //draw graph frame border
        if(strstr($options,'gB')){
            $this->Rect($valX,$valY,$w,$h);
        }
        //draw graph diagram border
        if(strstr($options,'dB')){
            $this->Rect($valX+$margin,$valY+$margin,$graphW,$graphH);
        }
        //draw key legend border
        if(strstr($options,'kB')){
            $this->Rect($keyX,$keyY,$keyW,$keyH);
        }
        //draw graph value box
        if(strstr($options,'vB')){
            $this->Rect($graphValX,$graphValY,$graphValW,$graphValH);
        }
        //define colors
        if($colors===null){
            $safeColors = array(0,51,102,153,204,225);
            for($i=0;$i<count($data);$i++){
                $colors[$keys[$i]] = array($safeColors[array_rand($safeColors)],$safeColors[array_rand($safeColors)],$safeColors[array_rand($safeColors)]);
            }
        }
        //form an array with all data values from the multi-demensional $data array
        $ValArray = array();
        foreach($data as $key => $value){
            foreach($data[$key] as $val){
                $ValArray[]=$val;
            }
        }
        //define max value
        if($maxVal<ceil(max($ValArray))){
            $maxVal = ceil(max($ValArray));
        }
        //draw horizontal lines
        $vertDivH = $graphH/$nbDiv;
        if(strstr($options,'H')){
            for($i=0;$i<=$nbDiv;$i++){
                if($i<$nbDiv){
                    $this->Line($graphX,$graphY+$i*$vertDivH,$graphX+$graphW,$graphY+$i*$vertDivH);
                } else{
                    $this->Line($graphX,$graphY+$graphH,$graphX+$graphW,$graphY+$graphH);
                }
            }
        }
        //draw vertical lines
        $horiDivW = floor($graphW/(count($data[$keys[0]])-1));
        if(strstr($options,'V')){
            for($i=0;$i<=(count($data[$keys[0]])-1);$i++){
                if($i<(count($data[$keys[0]])-1)){
                    $this->Line($graphX+$i*$horiDivW,$graphY,$graphX+$i*$horiDivW,$graphY+$graphH);
                } else {
                    $this->Line($graphX+$graphW,$graphY,$graphX+$graphW,$graphY+$graphH);
                }
            }
        }
        //draw graph lines
        foreach($data as $key => $value){
            $this->setDrawColor($colors[$key][0],$colors[$key][1],$colors[$key][2]);
            $this->SetLineWidth(0.8);
            $valueKeys = array_keys($value);
            for($i=0;$i<count($value);$i++){
                if($i==count($value)-2){
                    $this->Line(
                        $graphX+($i*$horiDivW),
                        $graphY+$graphH-($value[$valueKeys[$i]]/$maxVal*$graphH),
                        $graphX+$graphW,
                        $graphY+$graphH-($value[$valueKeys[$i+1]]/$maxVal*$graphH)
                    );
                } else if($i<(count($value)-1)) {
                    $this->Line(
                        $graphX+($i*$horiDivW),
                        $graphY+$graphH-($value[$valueKeys[$i]]/$maxVal*$graphH),
                        $graphX+($i+1)*$horiDivW,
                        $graphY+$graphH-($value[$valueKeys[$i+1]]/$maxVal*$graphH)
                    );
                }
            }
            //Set the Key (legend)
            $this->SetFont('Courier','',10);
            if(!isset($n))$n=0;
            $this->Line($keyX+1,$keyY+$lineh/2+$n*$lineh,$keyX+8,$keyY+$lineh/2+$n*$lineh);
            $this->SetXY($keyX+8,$keyY+$n*$lineh);
            $this->Cell($keyW,$lineh,$key,0,1,'L');
            $n++;
        }
        //print the abscissa values
        foreach($valueKeys as $key => $value){
            if($key==0){
                $this->SetXY($graphValX,$graphValY);
                $this->Cell(30,$lineh,$value,0,0,'L');
            } else if($key==count($valueKeys)-1){
                $this->SetXY($graphValX+$graphValW-30,$graphValY);
                $this->Cell(30,$lineh,$value,0,0,'R');
            } else {
                $this->SetXY($graphValX+$key*$horiDivW-15,$graphValY);
                $this->Cell(30,$lineh,$value,0,0,'C');
            }
        }
        //print the ordinate values
        for($i=0;$i<=$nbDiv;$i++){
            $this->SetXY($graphValX-10,$graphY+($nbDiv-$i)*$vertDivH-3);
            $this->Cell(8,6,sprintf('%.1f',$maxVal/$nbDiv*$i),0,0,'R');
        }
        $this->SetDrawColor(0,0,0);
        $this->SetLineWidth(0.2);
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
				'hitachi_curve' => 'required',
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
					'hitachi_curve' => $this->request->getVar('hitachi_curve'),
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

	public function countLoadTestData($id){


		$load_test_tests_model = new Load_Test_model();
		$load_test_record_count = $load_test_tests_model->countLoadTestData($id);
		echo json_encode($load_test_record_count);

	}

	public function generate_report($id){

		$pdf = new PDF();
		$pdf->AddPage();
		$motor_tests_model = new Motor_Test_model();
		$result = $motor_tests_model->getMotorTestData($id);

		$noload_test_tests_model = new No_Load_Test_model();
		$no_load_test_result = $noload_test_tests_model->getNoLoadTestData($id);

		$load_test_tests_model = new Load_Test_model();
		$load_test_result = $load_test_tests_model->getLoadTestData($id);

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
		$pdf->Cell(10 ,10,$pdf->Image(base_url().'/assets/images/lab1.png',10,75,60),0,1,'R');
		$pdf->Cell(10 ,10,$pdf->Image(base_url().'/assets/images/lab2.png',70,75,60),0,1,'R');
		$pdf->Cell(10 ,10,$pdf->Image(base_url().'/assets/images/lab3.png',130,75,60),0,1,'R');

		$pdf->Ln(20);
    //need uncomment
		$pdf->Cell(10 ,100,$pdf->Image(base_url().'/assets/images/komax_logo.png',70,180,60),0,1,'R');


		//Second page

		$pdf->AddPage();


		/*output the result*/

		$pdf->SetFont('Arial','',12);
		$pdf->Cell(150 ,5,'',0,1);

		//need uncomment
		$pdf->Cell(5 ,5,$pdf->Image(base_url().'/assets/images/komax_logo.png',5,5,20),0,1,'R');


		// Header
		$pdf->Cell(40,6,'TEST REPORT NO.',1,0,'C');
		$pdf->Cell(70,6,$result[0]['test_report_no'],1,0,'C');
		$pdf->Cell(30,6,'DATED',1,0,'LR');
		$pdf->Cell(55,6,$result[0]['test_date'],1,0,'C');
		$pdf->Ln();
		$pdf->Cell(40,6,'MOTOR MODEL',1,0,'LR');
		$pdf->Cell(70,6,$result[0]['motor_model'],1,0,'C');
		$pdf->Cell(30,6,'SR. NO.',1,0,'LR');
		$pdf->Cell(55,6,$result[0]['motor_sno'],1,0,'C');
		$pdf->Ln(10);
		$pdf->SetFont('Arial','B',12);
		$pdf->SetFillColor(0,0,0);
    $pdf->SetTextColor(255,255,255);
		$pdf->Cell(195,6,'1. MOTOR PICTURE(S)',1,0,'C', true);
		$pdf->Ln();

		//need uncomment
		$pdf->Cell(10 ,90,$pdf->Image(base_url().'/public/assets/uploads/'.$result[0]['motor_pic'],70,76,75),0,1,'R');

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


		$slip_in_pu_1 = ((120*($k/$o)) - ($rated_curves['speed_in_rpm_1']))/(120*($k/$o));$slip_in_pu_1 = number_format((float)$slip_in_pu_1, 4, '.', '');
		$slip_in_pu_2 = ((120*($k/$o)) - ($rated_curves['speed_in_rpm_2']))/(120*($k/$o));$slip_in_pu_2 = number_format((float)$slip_in_pu_2, 4, '.', '');
		$slip_in_pu_3 = ((120*($k/$o)) - ($rated_curves['speed_in_rpm_3']))/(120*($k/$o));$slip_in_pu_3 = number_format((float)$slip_in_pu_3, 4, '.', '');
		$slip_in_pu_4 = ((120*($k/$o)) - ($rated_curves['speed_in_rpm_4']))/(120*($k/$o));$slip_in_pu_4 = number_format((float)$slip_in_pu_4, 4, '.', '');
		$slip_in_pu_5 = ((120*($k/$o)) - ($rated_curves['speed_in_rpm_5']))/(120*($k/$o));$slip_in_pu_5 = number_format((float)$slip_in_pu_5, 4, '.', '');
		$slip_in_pu_6 = ((120*($k/$o)) - ($rated_curves['speed_in_rpm_6']))/(120*($k/$o));$slip_in_pu_6 = number_format((float)$slip_in_pu_6, 4, '.', '');
		$slip_in_pu_7 = ((120*($k/$o)) - ($rated_curves['speed_in_rpm_7']))/(120*($k/$o));$slip_in_pu_7 = number_format((float)$slip_in_pu_7, 4, '.', '');


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



    $eff_percent_1 = ($eff_percent_1 < 0) ? 0 : $eff_percent_1;
		$eff_percent_2 = ($eff_percent_2 < 0) ? 0 : $eff_percent_2;
		$eff_percent_3 = ($eff_percent_3 < 0) ? 0 : $eff_percent_3;
		$eff_percent_4 = ($eff_percent_4 < 0) ? 0 : $eff_percent_4;
		$eff_percent_5 = ($eff_percent_5 < 0) ? 0 : $eff_percent_5;
		$eff_percent_6 = ($eff_percent_6 < 0) ? 0 : $eff_percent_6;
		$eff_percent_7 = ($eff_percent_7 < 0) ? 0 : $eff_percent_7;



		$pdf->Cell(5,6,'2',1,0,'LR');
		$pdf->Cell(50,6,'Efficiency, in %',1,0,'C');
		$pdf->Cell(20,6,$eff_percent_1,1,0,'C');
		$pdf->Cell(20,6,$eff_percent_2,1,0,'C');
		$pdf->Cell(20,6,$eff_percent_3,1,0,'C');
		$pdf->Cell(20,6,$eff_percent_4,1,0,'C');
		$pdf->Cell(20,6,$eff_percent_5,1,0,'C');
		$pdf->Cell(20,6,$eff_percent_6,1,0,'C');
		$pdf->Cell(20,6,$eff_percent_7,1,0,'C');

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
		$pdf->Cell(5,6,'4',1,0,'LR');
		$pdf->Cell(50,6,'Min Speed, in RPM',1,0,'C');
		$pdf->Cell(20,6,$min_speed_rpm_1,1,0,'C');
		$pdf->Cell(20,6,$min_speed_rpm_2,1,0,'C');
		$pdf->Cell(20,6,$min_speed_rpm_3,1,0,'C');
		$pdf->Cell(20,6,$min_speed_rpm_4,1,0,'C');
		$pdf->Cell(20,6,$min_speed_rpm_5,1,0,'C');
		$pdf->Cell(20,6,$min_speed_rpm_6,1,0,'C');
		$pdf->Cell(20,6,$min_speed_rpm_7,1,0,'C');

		$pfactor1 = abs(0.167 * (100 - $rated_curves['cos_in_percent_1']));
		$pfactor2 = abs(0.167 * (100 - $rated_curves['cos_in_percent_2']));
		$pfactor3 = abs(0.167 * (100 - $rated_curves['cos_in_percent_3']));
		$pfactor4 = abs(0.167 * (100 - $rated_curves['cos_in_percent_4']));
		$pfactor5 = abs(0.167 * (100 - $rated_curves['cos_in_percent_5']));
		$pfactor6 = abs(0.167 * (100 - $rated_curves['cos_in_percent_6']));
		$pfactor7 = abs(0.167 * (100 - $rated_curves['cos_in_percent_7']));
		$pfactor1 = ($pfactor1 > 7) ? 7 : $pfactor1;
		$pfactor1 = ($pfactor1 < 2) ? 2 : $pfactor1;
		$pfactor2 = ($pfactor2 > 7) ? 7 : $pfactor2;
		$pfactor2 = ($pfactor2 < 2) ? 2 : $pfactor2;
		$pfactor3 = ($pfactor3 > 7) ? 7 : $pfactor3;
		$pfactor3 = ($pfactor3 < 2) ? 2 : $pfactor3;
		$pfactor4 = ($pfactor4 > 7) ? 7 : $pfactor4;
		$pfactor4 = ($pfactor4 < 2) ? 2 : $pfactor4;
		$pfactor5 = ($pfactor5 > 7) ? 7 : $pfactor5;
		$pfactor5 = ($pfactor5 < 2) ? 2 : $pfactor5;
		$pfactor6 = ($pfactor6 > 7) ? 7 : $pfactor6;
		$pfactor6 = ($pfactor6 < 2) ? 2 : $pfactor6;
		$pfactor7 = ($pfactor7 > 7) ? 7 : $pfactor7;
		$pfactor7 = ($pfactor7 < 2) ? 2 : $pfactor7;

		$pdf->Ln();
		$pdf->Cell(5,6,'5',1,0,'LR');
		$pdf->Cell(50,6,'CosØ, in %',1,0,'C');
		$pdf->Cell(20,6,$rated_curves['cos_in_percent_1'] - $pfactor1 ,1,0,'C');
		$pdf->Cell(20,6,$rated_curves['cos_in_percent_2'] - $pfactor2 ,1,0,'C');
		$pdf->Cell(20,6,$rated_curves['cos_in_percent_3'] - $pfactor3 ,1,0,'C');
		$pdf->Cell(20,6,$rated_curves['cos_in_percent_4'] - $pfactor4 ,1,0,'C');
		$pdf->Cell(20,6,$rated_curves['cos_in_percent_5'] - $pfactor5 ,1,0,'C');
		$pdf->Cell(20,6,$rated_curves['cos_in_percent_6'] - $pfactor6 ,1,0,'C');
		$pdf->Cell(20,6,$rated_curves['cos_in_percent_7'] - $pfactor7 ,1,0,'C');

		/******************** 5. TEST INFORMATION ***************************/


		$pdf->Ln();
		$pdf->SetFont('Arial','B',12);
		$pdf->SetFillColor(0,0,0);
		$pdf->SetTextColor(255,255,255);
		$pdf->Cell(195,6,'5. TEST INFORMATION',1,0,'C', true);
		$pdf->Ln(10);

		$pdf->SetFont('Arial','',12);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0,0,0);

		$nb=$pdf->WordWrap($result[0]['test_description'],180);
		$pdf->Write(5,$result[0]['test_description']);

		/******************** 6. NO LOAD DATA (MOTOR UNCOUPLED) ***************************/


		$pdf->AddPage();

		$pdf->SetFont('Arial','',12);
		$pdf->Cell(150 ,5,'',0,1);

		//need uncomment
		$pdf->Cell(5 ,5,$pdf->Image(base_url().'/assets/images/komax_logo.png',5,5,20),0,1,'R');


		// Header
		$pdf->Cell(40,6,'TEST REPORT NO.',1,0,'C');
		$pdf->Cell(70,6,$result[0]['test_report_no'],1,0,'C');
		$pdf->Cell(30,6,'DATED',1,0,'LR');
		$pdf->Cell(55,6,$result[0]['test_date'],1,0,'C');
		$pdf->Ln();
		$pdf->Cell(40,6,'MOTOR MODEL',1,0,'LR');
		$pdf->Cell(70,6,$result[0]['motor_model'],1,0,'C');
		$pdf->Cell(30,6,'SR. NO.',1,0,'LR');
		$pdf->Cell(55,6,$result[0]['motor_sno'],1,0,'C');


		$pdf->Ln();
		$pdf->SetFont('Arial','B',12);
		$pdf->SetFillColor(0,0,0);
		$pdf->SetTextColor(255,255,255);
		$pdf->Cell(195,6,'6. NO LOAD DATA (MOTOR UNCOUPLED)',1,0,'C', true);
		$pdf->Ln(10);

		$pdf->SetFont('Arial','B',14);
		$pdf->SetFillColor(125,125,125);
		$pdf->SetTextColor(0,0,0);

		$pdf->Ln();
		$pdf->Cell(90,6,'Parameter',1,0,'C');
		$pdf->Cell(90,6,'Value',1,0,'C');

		$pdf->SetFont('Arial','B',12);
		$pdf->SetFillColor(0,0,102);
		$pdf->SetTextColor(0,0,0);

		$pdf->Ln();
		$pdf->Cell(90,6,'Frequency, in Hz',1,0,'C');
		$pdf->Cell(90,6,$no_load_test_result[0]['frequency'],1,0,'C');
		$pdf->Ln();
		$pdf->Cell(90,6,'Line-to-Line Voltage, in V',1,0,'C');
		$pdf->Cell(90,6,$no_load_test_result[0]['averge_voltage_phase_to_phase'],1,0,'C');
		$pdf->Ln();
		$pdf->Cell(90,6,'Line Current, in A',1,0,'C');
		$pdf->Cell(90,6,$no_load_test_result[0]['total_current'],1,0,'C');
		$pdf->Ln();
		$pdf->Cell(90,6,'Power Factor, in p.u.',1,0,'C');
		$pdf->Cell(90,6,$no_load_test_result[0]['average_pf'],1,0,'C');
		$pdf->Ln();
		$pdf->Cell(90,6,'Stator Power, in kW',1,0,'C');
		$pdf->Cell(90,6,$no_load_test_result[0]['average_power'],1,0,'C');
		$pdf->Ln();
		$pdf->Cell(90,6,'Observed Speed, in r/min',1,0,'C');
		$pdf->Cell(90,6,$no_load_test_result[0]['rpm_no_load'],1,0,'C');
		$pdf->Ln();
		$pdf->Cell(90,6,'Corrected Speed, in r/min',1,0,'C');
		$pdf->Cell(90,6,$no_load_test_result[0]['rpm_no_load'],1,0,'C');



		/******************** 7. LOAD TEST RESULTS ***************************/


		$pdf->AddPage();

		$pdf->SetFont('Arial','',12);
		$pdf->Cell(150 ,5,'',0,1);

		//need uncomment
		$pdf->Cell(5 ,5,$pdf->Image(base_url().'/assets/images/komax_logo.png',5,5,20),0,1,'R');


		// Header
		$pdf->Cell(40,6,'TEST REPORT NO.',1,0,'C');
		$pdf->Cell(70,6,$result[0]['test_report_no'],1,0,'C');
		$pdf->Cell(30,6,'DATED',1,0,'LR');
		$pdf->Cell(55,6,$result[0]['test_date'],1,0,'C');
		$pdf->Ln();
		$pdf->Cell(40,6,'MOTOR MODEL',1,0,'LR');
		$pdf->Cell(70,6,$result[0]['motor_model'],1,0,'C');
		$pdf->Cell(30,6,'SR. NO.',1,0,'LR');
		$pdf->Cell(55,6,$result[0]['motor_sno'],1,0,'C');


		$pdf->Ln();
		$pdf->SetFont('Arial','B',12);
		$pdf->SetFillColor(0,0,0);
		$pdf->SetTextColor(255,255,255);
		$pdf->Cell(195,6,'7. LOAD TEST RESULTS',1,0,'C', true);
		$pdf->Ln();

		$pdf->SetFont('Arial','B',14);
		$pdf->SetFillColor(125,125,125);
		$pdf->SetTextColor(0,0,0);

		$pdf->Cell(5,6,'#',1,0,'C');
		$pdf->Cell(71,6,'Test Point',1,0,'C');
		$pdf->Cell(17,6,$load_test_result[0]['loading_factor']."%",1,0,'C');
		$pdf->Cell(17,6,$load_test_result[1]['loading_factor']."%",1,0,'C');
		$pdf->Cell(17,6,$load_test_result[2]['loading_factor']."%",1,0,'C');
		$pdf->Cell(17,6,$load_test_result[3]['loading_factor']."%",1,0,'C');
		$pdf->Cell(17,6,$load_test_result[4]['loading_factor']."%",1,0,'C');
		$pdf->Cell(17,6,$load_test_result[5]['loading_factor']."%",1,0,'C');
		$pdf->Cell(17,6,$load_test_result[6]['loading_factor']."%",1,0,'C');
		$pdf->Ln();
		$pdf->SetFont('Arial','',12);
		$pdf->SetFillColor(125,125,125);
		$pdf->SetTextColor(0,0,0);

		$pdf->Cell(5,6,'1',1,0,'C');
		$pdf->Cell(71,6,'Specified temperature, ts, in C',1,0,'LR');
		$pdf->Cell(119,6,$result[0]['specified_temp'],1,0,'C');
		$pdf->Ln();
		$pdf->Cell(5,6,'2',1,0,'C');
		$pdf->Cell(71,6,'Stator Resistance (Cold), in Ohms',1,0,'LR');
		$pdf->Cell(119,6,$result[0]['winding_resistance'],1,0,'C');
		$pdf->Ln();
		$pdf->SetFont('Arial','',10);
		$pdf->SetFillColor(125,125,125);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(5,6,'3',1,0,'C');
		$pdf->Cell(71,6,'Stator Resistance(Cold) measure at Temp C',1,0,'LR');
		$pdf->Cell(119,6,$result[0]['temp_at_which_winding_resistance_measured'],1,0,'C');
		$pdf->Ln();
		$pdf->SetFont('Arial','',12);



		$load_test_col = array(
			"motor_temperature", "amb_temperature", "averge_voltage_phase_to_phase", "frequency",
			"synchronous_speed_rpm","rpm_load","observed_slip_rmin", "observed_slip_pu", "corrected_slip_pu",
			"corrected_speed_rmin","torque","dynamometer_correction","corrected_torque","shaft_power","total_current","average_power",
			"stator_i2r_loss_kw","winding_resistance_ts","stator_i2r_loss_kw_ts","stator_power_correction_kw","corrected_stator_power_correction_kw",
			"efficiency_percentage","power_factor_percentage"
		);
		$load_test_label = array(
			"Stator Winding Temp, tt in C", "Ambient Temperature, in C", "Line-to-Line Voltage, in V", "Frequency, in Hz",
			"Synchronous speed, ns, in RPM","Observed Speed, in r/min","Observed Slip, in r/min", "Observed Slip, in p.u.",
			"Corrected Slip, in p.u.","Corrected Speed, in r/min","Torque, in N-m","Dynamometer Correction, in N-m","Corrected Torque, in N-m",
			"Shaft Power, in kW","Line Current, in A","Stator Power, in kW","Stator I2R Loss, in kW, at tt","Winding Resistance at ts",
			"Stator I2R Loss, in kW, at ts","Stator Power Correction, in kW","Corrected Stator Power, in kW","Efficiency, in %","Power Factor, in %"
		);

		$efficiency_graph = array();
		$shaft_power_graph = array();
		$corrected_speed_rmin_graph = array();
		$total_current_graph = array();
		$power_factor_percentage_graph = array();


		for ($i=0; $i < sizeof($load_test_col); $i++) {

			$pdf->Cell(5,6,$i+4,1,0,'C');
			$pdf->Cell(71,6,$load_test_label[$i],1,0,'LR');


			for ($var = 0; $var < sizeof($load_test_result); $var++) {

				$A = $result[0]['specified_temp'];
				$B = $result[0]['winding_resistance'];
				$C = $result[0]['temp_at_which_winding_resistance_measured'];
				$D = $load_test_result[$var]['motor_temperature'];
				$R = $load_test_result[$var]['total_current'];
				$U = ($B*($A+234.5)/($C+234.5));
				$V = ((1.5*$R*$R*$U)/1000);
				$T = (((1.5*$R*$R*$B*(234.5+$D))/(234.5+$C))/1000);

				if($load_test_col[$i] == 'synchronous_speed_rpm'){
					$load_test_result[$var][$load_test_col[$i]] = (120*$load_test_result[$var]['frequency'])/$result[0]['no_of_poles'];
				}
				if($load_test_col[$i] == 'observed_slip_rmin'){
					$load_test_result[$var][$load_test_col[$i]] = ((120*$load_test_result[$var]['frequency'])/$result[0]['no_of_poles'])-$load_test_result[$var]['rpm_load'];
					$load_test_result[$var][$load_test_col[$i]] = number_format($load_test_result[$var][$load_test_col[$i]], 2);
				}
				if($load_test_col[$i] == 'observed_slip_pu'){
					$h = ((120*$load_test_result[$var]['frequency'])/$result[0]['no_of_poles']);
					$j = ((120*$load_test_result[$var]['frequency'])/$result[0]['no_of_poles'])-$load_test_result[$var]['rpm_load'];
					if($h == 0){
						$load_test_result[$var][$load_test_col[$i]] = '--';
					}else{
					   $load_test_result[$var][$load_test_col[$i]] = number_format($j/$h,2);
					}

				}
				if($load_test_col[$i] == 'corrected_slip_pu'){
					$h = ((120*$load_test_result[$var]['frequency'])/$result[0]['no_of_poles']);
					$j = ((120*$load_test_result[$var]['frequency'])/$result[0]['no_of_poles'])-$load_test_result[$var]['rpm_load'];
					if($h == 0){
						$load_test_result[$var][$load_test_col[$i]] = '--';
					}else{
						$k = $j/$h;
						$load_test_result[$var][$load_test_col[$i]] = number_format(($k * ($A+234.5)/($D+234.5)), 2);
					}
				}
				if($load_test_col[$i] == 'corrected_speed_rmin'){
					$h = ((120*$load_test_result[$var]['frequency'])/$result[0]['no_of_poles']);
					$j = ((120*$load_test_result[$var]['frequency'])/$result[0]['no_of_poles'])-$load_test_result[$var]['rpm_load'];
					if($h == 0){
						$load_test_result[$var][$load_test_col[$i]] = '--';
						array_push($corrected_speed_rmin_graph,0);
					}else{
						$k = $j/$h;
						$L = (($k * ($A+234.5)/($D+234.5)));
						$load_test_result[$var][$load_test_col[$i]] = ceil(((120*($result[0]['motor_rated_frequency']/$result[0]['no_of_poles'])) * (1-$L)));
						array_push($corrected_speed_rmin_graph,$load_test_result[$var][$load_test_col[$i]]);
					}

				}
				if($load_test_col[$i] == 'dynamometer_correction'){
					$load_test_result[$var][$load_test_col[$i]] = 0;
				}
				if($load_test_col[$i] == 'corrected_torque'){
					$load_test_result[$var][$load_test_col[$i]] = 0 + $load_test_result[$var]['torque'];
				}
				if($load_test_col[$i] == 'stator_i2r_loss_kw'){
					$load_test_result[$var][$load_test_col[$i]] = number_format((((1.5*$R*$R*$B*(234.5+$D))/(234.5+$C))/1000),2);
				}
				if($load_test_col[$i] == 'winding_resistance_ts'){
					$load_test_result[$var][$load_test_col[$i]] = number_format(($B*($A+234.5)/($C+234.5)),2);
				}
				if($load_test_col[$i] == 'stator_i2r_loss_kw_ts'){
					$U = ($B*($A+234.5)/($C+234.5));
					$load_test_result[$var][$load_test_col[$i]] = number_format(((1.5*$R*$R*$U)/1000),2);
				}
				if($load_test_col[$i] == 'stator_power_correction_kw'){
					$U = ($B*($A+234.5)/($C+234.5));
					$V = ((1.5*$R*$R*$U)/1000);
					$T = (((1.5*$R*$R*$B*(234.5+$D))/(234.5+$C))/1000);
					$load_test_result[$var][$load_test_col[$i]] = number_format(($V - $T),2);
				}

				if($load_test_col[$i] == 'corrected_stator_power_correction_kw'){
					$W = $V - $T;
					$load_test_result[$var][$load_test_col[$i]] = number_format(($load_test_result[$var]['average_power'] + $W), 2);
				}
				if($load_test_col[$i] == 'efficiency_percentage'){
					$W = $V - $T;
					$X = $load_test_result[$var]['average_power'] + $W;
					$load_test_result[$var][$load_test_col[$i]] = number_format(((100*$load_test_result[$var]['shaft_power'])/$X),2);
					array_push($efficiency_graph,$load_test_result[$var][$load_test_col[$i]]);
				}
				if($load_test_col[$i] == 'power_factor_percentage'){
					$W = $V - $T;
					$X = $load_test_result[$var]['average_power'] + $W;
					$F = $load_test_result[$var]['averge_voltage_phase_to_phase'];
					if($F == 0 && $R == 0){
            $load_test_result[$var][$load_test_col[$i]] = '--';
						array_push($power_factor_percentage_graph,0);
					}else{
						$Z = ((100*$X)/(1.732*$F*$R))*1000;
						$load_test_result[$var][$load_test_col[$i]] = number_format($Z, 2);
						array_push($power_factor_percentage_graph,$load_test_result[$var][$load_test_col[$i]]);
					}

				}
				if($load_test_col[$i] == 'shaft_power'){
					array_push($shaft_power_graph,$load_test_result[$var][$load_test_col[$i]]);
				}
				if($load_test_col[$i] == 'total_current'){
					array_push($total_current_graph,$load_test_result[$var][$load_test_col[$i]]);
				}
				$pdf->Cell(17,6,$load_test_result[$var][$load_test_col[$i]],1,0,'C');
			}
			$pdf->Ln();
		}

		/****************** Efficiency Curve ***************************/




		$pdf->SetFont('Arial','',10);

		$efficiency_data = array(
			  'Hitachi_Curve_Legend' => $result[0]['hitachi_curve'],
				'Hitachi_Curve' => array(
						"hitachi_1" => $rated_curves['efficiency_in_percent_1'],
						"hitachi_2" => $rated_curves['efficiency_in_percent_2'],
						"hitachi_3" => $rated_curves['efficiency_in_percent_3'],
						"hitachi_4" => $rated_curves['efficiency_in_percent_4'],
						"hitachi_5" => $rated_curves['efficiency_in_percent_5'],
						"hitachi_6" => $rated_curves['efficiency_in_percent_6'],
						"hitachi_7" => $rated_curves['efficiency_in_percent_7']
				),
				'Test_Curve' => array(
						"test_curve_1" => $efficiency_graph[0],
						"test_curve_2" => $efficiency_graph[1],
						"test_curve_3" => $efficiency_graph[2],
						"test_curve_4" => $efficiency_graph[3],
						"test_curve_5" => $efficiency_graph[4],
						"test_curve_6" => $efficiency_graph[5],
						"test_curve_7" => $efficiency_graph[6]
				),
				'Min_Allowed' => array(
						"min_allowed_1" => $eff_percent_1,
						"min_allowed_2" => $eff_percent_2,
						"min_allowed_3" => $eff_percent_3,
						"min_allowed_4" => $eff_percent_4,
						"min_allowed_5" => $eff_percent_5,
						"min_allowed_6" => $eff_percent_6,
						"min_allowed_7" => $eff_percent_7
				)
		);

		$myfile = fopen("C:/wamp64/www/mak_rmc/assets/images/efficiency_data.json", "w") or die("Unable to open file!");
		fwrite($myfile, json_encode($efficiency_data));

		/****************** Speed Curve ***************************/


		$speed_data = array(

			'Hitachi_Curve_Legend' => $result[0]['hitachi_curve'],
				'Max_Allowed' => array(
					"max_speed_1" => $max_speed_rpm_1,
					"max_speed_2" => $max_speed_rpm_2,
					"max_speed_3" => $max_speed_rpm_3,
					"max_speed_4" => $max_speed_rpm_4,
					"max_speed_5" => $max_speed_rpm_5,
					"max_speed_6" => $max_speed_rpm_6,
					"max_speed_7" => $max_speed_rpm_7
				),
				'Min_Allowed' => array(
						"min_speed_1" => $min_speed_rpm_1,
						"min_speed_2" => $min_speed_rpm_2,
						"min_speed_3" => $min_speed_rpm_3,
						"min_speed_4" => $min_speed_rpm_4,
						"min_speed_5" => $min_speed_rpm_5,
						"min_speed_6" => $min_speed_rpm_6,
						"min_speed_7" => $min_speed_rpm_7
				),
				'Hitachi_Curve' => array(
						"hitachi_1" => $rated_curves['speed_in_rpm_1'],
						"hitachi_2" => $rated_curves['speed_in_rpm_2'],
						"hitachi_3" => $rated_curves['speed_in_rpm_3'],
						"hitachi_4" => $rated_curves['speed_in_rpm_4'],
						"hitachi_5" => $rated_curves['speed_in_rpm_5'],
						"hitachi_6" => $rated_curves['speed_in_rpm_6'],
						"hitachi_7" => $rated_curves['speed_in_rpm_7']
				),
				'Test_Curve' => array(
						"test_curve_1" => $corrected_speed_rmin_graph[0],
						"test_curve_2" => $corrected_speed_rmin_graph[1],
						"test_curve_3" => $corrected_speed_rmin_graph[2],
						"test_curve_4" => $corrected_speed_rmin_graph[3],
						"test_curve_5" => $corrected_speed_rmin_graph[4],
						"test_curve_6" => $corrected_speed_rmin_graph[5],
						"test_curve_7" => $corrected_speed_rmin_graph[6]
				),
		);

		$myfile = fopen("C:/wamp64/www/mak_rmc/assets/images/speed_data.json", "w") or die("Unable to open file!");
		fwrite($myfile, json_encode($speed_data));





		/****************** 10. CURRENT CURVE ***************************/


		$current_data = array(
			'Hitachi_Curve_Legend' => $result[0]['hitachi_curve'],
				'Hitachi_Curve' => array(
						"hitachi_1" => $rated_curves['current_in_amps_1'],
						"hitachi_2" => $rated_curves['current_in_amps_2'],
						"hitachi_3" => $rated_curves['current_in_amps_3'],
						"hitachi_4" => $rated_curves['current_in_amps_4'],
						"hitachi_5" => $rated_curves['current_in_amps_5'],
						"hitachi_6" => $rated_curves['current_in_amps_6'],
						"hitachi_7" => $rated_curves['current_in_amps_7']
				),
				'Test_Curve' => array(
						"test_curve_1" => $total_current_graph[0],
						"test_curve_2" => $total_current_graph[1],
						"test_curve_3" => $total_current_graph[2],
						"test_curve_4" => $total_current_graph[3],
						"test_curve_5" => $total_current_graph[4],
						"test_curve_6" => $total_current_graph[5],
						"test_curve_7" => $total_current_graph[6]
				),
		);



		$myfile = fopen("C:/wamp64/www/mak_rmc/assets/images/current_data.json", "w") or die("Unable to open file!");
		fwrite($myfile, json_encode($current_data));




		$cos_data = array(
			'Hitachi_Curve_Legend' => $result[0]['hitachi_curve'],
				'Hitachi_Curve' => array(
						"hitachi_1" => $rated_curves['cos_in_percent_1'],
						"hitachi_2" => $rated_curves['cos_in_percent_2'],
						"hitachi_3" => $rated_curves['cos_in_percent_3'],
						"hitachi_4" => $rated_curves['cos_in_percent_4'],
						"hitachi_5" => $rated_curves['cos_in_percent_5'],
						"hitachi_6" => $rated_curves['cos_in_percent_6'],
						"hitachi_7" => $rated_curves['cos_in_percent_7']
				),
				'Test_Curve' => array(
						"test_curve_1" => $power_factor_percentage_graph[0],
						"test_curve_2" => $power_factor_percentage_graph[1],
						"test_curve_3" => $power_factor_percentage_graph[2],
						"test_curve_4" => $power_factor_percentage_graph[3],
						"test_curve_5" => $power_factor_percentage_graph[4],
						"test_curve_6" => $power_factor_percentage_graph[5],
						"test_curve_7" => $power_factor_percentage_graph[6]
				),
				'Min_Allowed' => array(
						"min_allowed_1" => $rated_curves['cos_in_percent_1'] - $pfactor1,
						"min_allowed_2" => $rated_curves['cos_in_percent_2'] - $pfactor2,
						"min_allowed_3" => $rated_curves['cos_in_percent_3'] - $pfactor3,
						"min_allowed_4" => $rated_curves['cos_in_percent_4'] - $pfactor4,
						"min_allowed_5" => $rated_curves['cos_in_percent_5'] - $pfactor5,
						"min_allowed_6" => $rated_curves['cos_in_percent_6'] - $pfactor6,
						"min_allowed_7" => $rated_curves['cos_in_percent_7'] - $pfactor7
				)
		);

		$myfile = fopen("C:/wamp64/www/mak_rmc/assets/images/cos_data.json", "w") or die("Unable to open file!");
		fwrite($myfile, json_encode($cos_data));

		sleep(5);

		/****************** 11. COSØ CURVE ***************************/

		$pdf->AddPage();
		$pdf->SetFont('Arial','B',12);
		$pdf->SetFillColor(0,0,0);
		$pdf->SetTextColor(255,255,255);
		$pdf->Cell(195,6,'8. EFFICIENCY CURVE',1,0,'C', true);
		$pdf->Ln(20);
		$pdf->SetFont('Arial','',12);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(10 ,100,$pdf->Image(base_url().'/assets/images/efficiency_graph.png',10,50,200),0,1,'R');


		$pdf->AddPage();
		$pdf->SetFont('Arial','B',12);
		$pdf->SetFillColor(0,0,0);
		$pdf->SetTextColor(255,255,255);
		$pdf->Cell(195,6,'9. SPEED CURVE',1,0,'C', true);
		$pdf->Ln(20);
		$pdf->SetFont('Arial','',12);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(10 ,100,$pdf->Image(base_url().'/assets/images/speed_graph.png',10,50,200),0,1,'R');

		$pdf->AddPage();
		$pdf->SetFont('Arial','B',12);
		$pdf->SetFillColor(0,0,0);
		$pdf->SetTextColor(255,255,255);
		$pdf->Cell(195,6,'10. CURRENT CURVE',1,0,'C', true);
		$pdf->Ln(20);
		$pdf->SetFont('Arial','',12);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(10 ,100,$pdf->Image(base_url().'/assets/images/current_graph.png',10,50,200),0,1,'R');

		$pdf->AddPage();
		$pdf->SetFont('Arial','B',12);
		$pdf->SetFillColor(0,0,0);
		$pdf->SetTextColor(255,255,255);
		$pdf->Cell(195,6,'11. COSØ CURVE',1,0,'C', true);
		$pdf->Ln(20);
		$pdf->SetFont('Arial','',12);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(10 ,100,$pdf->Image(base_url().'/assets/images/cos_graph.png',10,50,200),0,1,'R');

		$pdf->Output('D','Test_Report.pdf');
  }


}
