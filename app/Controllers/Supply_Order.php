<?php namespace App\Controllers;

use App\Models\Sites_model;
use App\Models\Serveys_model;
use App\Models\Stocks_model;
use App\Models\Supply_Order_model;

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
		$this->Cell(50,10,'MAK',0,0,'C');
		$this->Cell(10);
		$this->SetFont('Arial','',25);
		$this->Cell(85 ,15,' Pumps Company (Pvt.) Limited',0,1,'C');
		$this->Line(0, 25, 210, 25);

	}
}

class PDF_1 extends FPDF
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


class Supply_Order extends BaseController
{

	public function manage()
	{
		$data 			= [];
		$sites_model    = new Sites_model();
		$data['sites']  = $sites_model->getApprovedSites();

		echo view('templates/header', $data);
		echo view('templates/sidebar');
		echo view('supply_order/manage');
		echo view('templates/footer');
	}

	public function show()
	{
		$data 			= [];
		$sites_model    = new Sites_model();
		$data['sites']  = $sites_model->getSupplyOrdersGeneratedSites();

		echo view('templates/header', $data);
		echo view('templates/sidebar');
		echo view('supply_order/show');
		echo view('templates/footer');
	}

	public function view_supply_order($id)
	{
		$data = [];
		$supply_order_model    	= new Supply_Order_model();
		$supply_order	  		= $supply_order_model->getSupplyOrders($id);
		$keys 					= array_keys($supply_order[0]);
		$data['keys']			= $keys;
		$data['supply_order'] 	= $supply_order[0];
		// dd($data);
		$labels = [
					['label' => '','unit' => ''],
					[
						'label' => 'PV MODULE ULICA UL-445M-144',
						'unit'	=> 'Nr'
					],
					[
						'label' => 'INVERTER GROWATT SPF 5000TL - HVM',
						'unit'	=> 'Nr'
					],
					[
						'label' => 'LITHIUM BATTER HRESYS VHR TL4875LFP',
						'unit'	=> 'Nr'
					],
					[
						'label' => 'AUTO VOLTAGE STABILIZER 6.0KW',
						'unit'	=> 'Nr'
					],
					[
						'label' => 'MOUNTING RACK WITH BREAKERS AND INTERNAL WIRING',
						'unit'	=> 'Set'
					],
					[
						'label' => 'PV MOUNTING STRUCTURE 2M',
						'unit'	=> 'Set'
					],
					[
						'label' => 'POLE MOUNTED PV MOUNTING STRUCTURE 4M',
						'unit'	=> 'Set'
					],
					[
						'label' => 'SS NUT & BOLT WITH 02 WASHERS 10 X 30',
						'unit'	=> 'Nr'
					],
					[
						'label' => 'SS NUT & BOLT WITH 02 WASHERS 8 X 25',
						'unit'	=> 'Nr'
					],
					[
						'label' => 'RAWL BOLTS 10 X 75',
						'unit'	=> 'Nr'
					],
					[
						'label' => 'DC CABLE 1 X 10 MM.SQ. (RED)',
						'unit'	=> 'Ft'
					],
					[
						'label' => 'DC CABLE 1 X 10 MM.SQ. (BLACK)',
						'unit'	=> 'Ft'
					],
					[
						'label' => 'DC CABLE 1 X 10 MM.SQ. (YELLOW)',
						'unit'	=> 'Ft'
					],
					[
						'label' => 'MC4 Y-BRANCH PAIR (2 PCS)',
						'unit'	=> 'Set'
					],
					[
						'label' => 'MC4 CONNECTOR PAIR (2 PCS)',
						'unit'	=> 'Set'
					],
					[
						'label' => 'HDPE CONDUIT PIPE 1-INCH DIA.',
						'unit'	=> 'Ft'
					],
					[
						'label' => 'HDPE ELBOW 1-INCH DIA.',
						'unit'	=> 'Nr'
					],
					[
						'label' => 'HDPE T-JOINT 1-INCH',
						'unit'	=> 'Nr'
					],
					[
						'label' => 'COPPER THIMBLE 16 X 10',
						'unit'	=> 'Nr'
					],
					[
						'label' => 'PVC SHROUD 16 X 10',
						'unit'	=> 'Nr'
					],
					[
						'label' => 'COPPER EARTHING ROD 5FT',
						'unit'	=> 'Nr'
					],
					[
						'label' => 'Earthing Rod CLAMP',
						'unit'	=> 'Nr'
					],
					[
						'label' => 'JUBLI CLAMP 1.25-INCH',
						'unit'	=> 'Nr'
					],
					[
						'label' => 'NYLON CABLE TIE 6-INCH (Black)',
						'unit'	=> 'Nr'
					],
					[
						'label' => 'CABLE TIE 12-INCH (Black)',
						'unit'	=> 'Nr'
					],
					[
						'label' => 'DUCT PATTI 16 X 25 MM 3 METER LONG',
						'unit'	=> 'Nr'
					],
					[
						'label' => 'PVC COATED GI FLEXIBLE PIPE 0.5-INCH DIA.',
						'unit'	=> 'Ft'
					],
					[
						'label' => 'AC CABLE 7/0.029 (RED)',
						'unit'	=> 'Mtr'
					],
					[
						'label' => 'AC CABLE 7/0.029 (BLACK)',
						'unit'	=> 'Mtr'
					],
					[
						'label' => 'AC CABLE 7/0.036 (RED)',
						'unit'	=> 'Mtr'
					],
					[
						'label' => 'AC CABLE 7/0.036 (BLACK)',
						'unit'	=> 'Mtr'
					],
					[
						'label' => 'E27 LED LIGHT 16W - PakLite',
						'unit'	=> 'Nr'
					],
					[
						'label' => 'E27 LED LIGHT HOLDER With Mounting BASE',
						'unit'	=> 'Nr'
					],
					[
						'label' => 'CEILING FAN 40-50W -Royal Fan',
						'unit'	=> 'Nr'
					],
					[
						'label' => 'SWITCH BOARD WITH BASE 3P',
						'unit'	=> 'Nr'
					],
					[
						'label' => 'SWITCH BOARD WITH BASE 2P',
						'unit'	=> 'Nr'
					],
					[
						'label' => 'ON/OF SWITCH',
						'unit'	=> 'Nr'
					],
					[
						'label' => 'FAN DIMMER',
						'unit'	=> 'Nr'
					],
					[
						'label' => 'STEEL NAIL 1-INCH',
						'unit'	=> 'Nr'
					],
					[
						'label' => 'BLACK SCREW (SODANI) 1.25-INCH',
						'unit'	=> 'Nr'
					],
					[
						'label' => 'RAWAL PLUG',
						'unit'	=> 'Nr'
					]
					,
					[
						'label' => 'BLACK SCREW SODANI 2.5 INCH',
						'unit'	=> 'Nr'
					]
					,
					[
						'label' => 'THREE PIN PLUG',
						'unit'	=> 'Nr'
					]
					,
					[
						'label' => 'INAUGURATION BOARD',
						'unit'	=> 'Nr'
					]

		];
		$data['labels'] = $labels;
        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('supply_order/view_supply_order');
		echo view('templates/footer');
	}

	public function print($id = null)
	{
		$data 			= [];
		$sites_model    = new Sites_model();
		$data['sites']  = $sites_model->getSupplyOrdersGeneratedSites();

		if ($id)
		{
			$sites_model    = new Sites_model();
			$site = $sites_model->getSupplyOrdersGeneratedSites($id);
			$supply_order_model    = new Supply_Order_model();
			$supply_order = $supply_order_model->getSupplyOrders($id);

			$supply_order = $supply_order[0];
			$keys = array_keys($supply_order);

			$labels = [
						['label' => '','unit' => ''],
						[
							'label' => 'PV MODULE ULICA UL-445M-144',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'INVERTER GROWATT SPF 5000TL - HVM',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'LITHIUM BATTER HRESYS VHR TL4875LFP',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'AUTO VOLTAGE STABILIZER 6.0KW',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'MOUNTING RACK WITH BREAKERS AND INTERNAL WIRING',
							'unit'	=> 'Set'
						],
						[
							'label' => 'PV MOUNTING STRUCTURE 2M',
							'unit'	=> 'Set'
						],
						[
							'label' => 'POLE MOUNTED PV MOUNTING STRUCTURE 4M',
							'unit'	=> 'Set'
						],
						[
							'label' => 'SS NUT & BOLT WITH 02 WASHERS 10 X 30',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'SS NUT & BOLT WITH 02 WASHERS 8 X 25',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'RAWL BOLTS 10 X 75',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'DC CABLE 1 X 10 MM.SQ. (RED)',
							'unit'	=> 'Ft'
						],
						[
							'label' => 'DC CABLE 1 X 10 MM.SQ. (BLACK)',
							'unit'	=> 'Ft'
						],
						[
							'label' => 'DC CABLE 1 X 10 MM.SQ. (YELLOW)',
							'unit'	=> 'Ft'
						],
						[
							'label' => 'MC4 Y-BRANCH PAIR (2 PCS)',
							'unit'	=> 'Set'
						],
						[
							'label' => 'MC4 CONNECTOR PAIR (2 PCS)',
							'unit'	=> 'Set'
						],
						[
							'label' => 'HDPE CONDUIT PIPE 1-INCH DIA.',
							'unit'	=> 'Ft'
						],
						[
							'label' => 'HDPE ELBOW 1-INCH DIA.',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'HDPE T-JOINT 1-INCH',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'COPPER THIMBLE 16 X 10',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'PVC SHROUD 16 X 10',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'COPPER EARTHING ROD 5FT',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'Earthing Rod CLAMP',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'JUBLI CLAMP 1.25-INCH',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'NYLON CABLE TIE 6-INCH (Black)',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'CABLE TIE 12-INCH (Black)',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'DUCT PATTI 16 X 25 MM 3 METER LONG',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'PVC COATED GI FLEXIBLE PIPE 0.5-INCH DIA.',
							'unit'	=> 'Ft'
						],
						[
							'label' => 'AC CABLE 7/0.029 (RED)',
							'unit'	=> 'Mtr'
						],
						[
							'label' => 'AC CABLE 7/0.029 (BLACK)',
							'unit'	=> 'Mtr'
						],
						[
							'label' => 'AC CABLE 7/0.036 (RED)',
							'unit'	=> 'Mtr'
						],
						[
							'label' => 'AC CABLE 7/0.036 (BLACK)',
							'unit'	=> 'Mtr'
						],
						[
							'label' => 'E27 LED LIGHT 16W - PakLite',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'E27 LED LIGHT HOLDER With Mounting BASE',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'CEILING FAN 40-50W -Royal Fan',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'SWITCH BOARD WITH BASE 3P',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'SWITCH BOARD WITH BASE 2P',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'ON/OF SWITCH',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'FAN DIMMER',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'STEEL NAIL 1-INCH',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'BLACK SCREW (SODANI) 1.25-INCH',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'RAWAL PLUG',
							'unit'	=> 'Nr'
						]
						,
						[
							'label' => 'BLACK SCREW SODANI 2.5 INCH',
							'unit'	=> 'Nr'
						]
						,
						[
							'label' => 'THREE PIN PLUG',
							'unit'	=> 'Nr'
						]
						,
						[
							'label' => 'INAUGURATION BOARD',
							'unit'	=> 'Nr'
						]

			];
			// dd($supply_order);
			/* Instanciation of inherited class */
			$pdf = new PDF();
			$pdf->AddPage();
			/*output the result*/

			$pdf->Cell(50 ,3,'',0,1);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(20 ,5,'Site ID:',0,0,'L');
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(80 ,5,$site[0]["site_id"],0,0,'L'); //Site ID to be added here
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(20 ,5,'Date:',0,0,'L');
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(80 ,5,date('M d, Y'),0,1,'L'); // Date to be added here
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(50 ,2,'',0,1);
			$pdf->Cell(20 ,5,'',0,0);
			$pdf->Cell(200 ,5,'SOLAR ELECTRIFICATION OF 4000 MASAJID PACKAGE -'.$site[0]['package'].'- PEDO KPK',0,1,'L'); // Package# to be added here
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(50 ,2,'',0,1);
			$pdf->Cell(110 ,5,'SUPPLY ORDER',0,1,'R');
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(40 ,5,'Site Name:',0,0,'L');
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(200 ,5,$site[0]['masgid'].' C/O '.$site[0]['khatib_caretaker_name'],0,1,'L'); //Site Name to be added here
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(40 ,5,'Site Address:',0,0,'L');
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(200 ,5,$site[0]['address'].','.$site[0]['uc_vc_name_and_no'].','.$site[0]['tehsil'].','.$site[0]['district'],0,1,'L'); //Site Address to be added here
			$pdf->Cell(50 ,3,'',0,1);

			$pdf->SetFont('Arial','B',10);
			/*Heading Of the table*/
			$pdf->Cell(20 ,5,'Sr. No',1,0,'L');
			$pdf->Cell(90 ,5,'Item Discription',1,0,'L');
			$pdf->Cell(23 ,5,'Qty',1,0,'L');
			$pdf->Cell(15 ,5,'Unit',1,0,'L');
			$pdf->Cell(40 ,5,'Remarks',1,1,'L');
			/*Heading Of the table end*/
			$pdf->SetFont('Arial','',8);

			$index  = 1;
			for ($i = 1; $i < sizeof($supply_order)-1; $i++) {
				if($site[0]['mounting_type'] == 3)
				{
					if($keys[$i] == "rawl_bolts_1075" || $keys[$i] == "ss_nut_and_bolt_with_two_washers_1030" || $keys[$i] == "pv_mounting_structure_2m")
					{

					}
					else
					{
						$pdf->Cell(20, 4, $index, 1, 0, 'L');
						$pdf->Cell(90, 4, $labels[$i]['label'], 1, 0, 'L');
						$pdf->Cell(23, 4, $supply_order[$keys[$i]], 1, 0, 'L');
						$pdf->Cell(15, 4, $labels[$i]['unit'], 1, 0, 'L');
						$pdf->Cell(40, 4, '', 1, 1, 'L');
						$index++;
					}
				}
				else
				{
					if($keys[$i] == "pole_mounted_pv_mounting_structure_4m")
					{

					}
					else
					{
						$pdf->Cell(20, 4, $index, 1, 0, 'L');
						$pdf->Cell(90, 4, $labels[$i]['label'], 1, 0, 'L');
						$pdf->Cell(23, 4, $supply_order[$keys[$i]], 1, 0, 'L');
						$pdf->Cell(15, 4, $labels[$i]['unit'], 1, 0, 'L');
						$pdf->Cell(40, 4, '', 1, 1, 'L');
						$index++;
					}
				}
			}

			$pdf->Line(10, 245, 100, 245);
			$pdf->Line(110, 245, 200, 245);

			if($index == 41)
			{
				$pdf->Cell(50 ,20,'',0,1);
			}
			else
			{
				$pdf->Cell(50 ,30,'',0,1);
			}

			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(100 ,5,'Prepared By',0,0,'C');
			$pdf->Cell(100 ,5,'Approved By (Director)',0,1,'C'); //Site Address to be added here

			$pdf->Output('D','Supply Order.pdf');
			// dd($supply_order,$site);
		}

		echo view('templates/header', $data);
		echo view('templates/sidebar');
		echo view('supply_order/print');
		echo view('templates/footer');
	}

	public function print_packing_list($id = null)
	{
		$data 			= [];
		$sites_model    = new Sites_model();
		$data['sites']  = $sites_model->getSupplyOrdersGeneratedSites();

		if ($id)
		{
			$sites_model    = new Sites_model();
			$site = $sites_model->getSupplyOrdersGeneratedSites($id);
			$supply_order_model    = new Supply_Order_model();
			$supply_order = $supply_order_model->getSupplyOrders($id);

			$supply_order = $supply_order[0];
			$keys = array_keys($supply_order);

			$labels = [
						['label' => '','unit' => ''],
						[
							'label' => 'PV MODULE ULICA UL-445M-144',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'INVERTER GROWATT SPF 5000TL - HVM',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'LITHIUM BATTER HRESYS VHR TL4875LFP',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'AUTO VOLTAGE STABILIZER 6.0KW',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'MOUNTING RACK WITH BREAKERS AND INTERNAL WIRING',
							'unit'	=> 'Set'
						],
						[
							'label' => 'PV MOUNTING STRUCTURE 2M',
							'unit'	=> 'Set'
						],
						[
							'label' => 'POLE MOUNTED PV MOUNTING STRUCTURE 4M',
							'unit'	=> 'Set'
						],
						[
							'label' => 'SS NUT & BOLT WITH 02 WASHERS 10 X 30',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'SS NUT & BOLT WITH 02 WASHERS 8 X 25',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'RAWL BOLTS 10 X 75',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'DC CABLE 1 X 10 MM.SQ. (RED)',
							'unit'	=> 'Ft'
						],
						[
							'label' => 'DC CABLE 1 X 10 MM.SQ. (BLACK)',
							'unit'	=> 'Ft'
						],
						[
							'label' => 'DC CABLE 1 X 10 MM.SQ. (YELLOW)',
							'unit'	=> 'Ft'
						],
						[
							'label' => 'MC4 Y-BRANCH PAIR (2 PCS)',
							'unit'	=> 'Set'
						],
						[
							'label' => 'MC4 CONNECTOR PAIR (2 PCS)',
							'unit'	=> 'Set'
						],
						[
							'label' => 'HDPE CONDUIT PIPE 1-INCH DIA.',
							'unit'	=> 'Ft'
						],
						[
							'label' => 'HDPE ELBOW 1-INCH DIA.',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'HDPE T-JOINT 1-INCH',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'COPPER THIMBLE 16 X 10',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'PVC SHROUD 16 X 10',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'COPPER EARTHING ROD 5FT',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'Earthing Rod CLAMP',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'JUBLI CLAMP 1.25-INCH',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'NYLON CABLE TIE 6-INCH (Black)',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'CABLE TIE 12-INCH (Black)',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'DUCT PATTI 16 X 25 MM 3 METER LONG',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'PVC COATED GI FLEXIBLE PIPE 0.5-INCH DIA.',
							'unit'	=> 'Ft'
						],
						[
							'label' => 'AC CABLE 7/0.029 (RED)',
							'unit'	=> 'Mtr'
						],
						[
							'label' => 'AC CABLE 7/0.029 (BLACK)',
							'unit'	=> 'Mtr'
						],
						[
							'label' => 'AC CABLE 7/0.036 (RED)',
							'unit'	=> 'Mtr'
						],
						[
							'label' => 'AC CABLE 7/0.036 (BLACK)',
							'unit'	=> 'Mtr'
						],
						[
							'label' => 'E27 LED LIGHT 16W - PakLite',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'E27 LED LIGHT HOLDER With Mounting BASE',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'CEILING FAN 40-50W -Royal Fan',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'SWITCH BOARD WITH BASE 3P',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'SWITCH BOARD WITH BASE 2P',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'ON/OF SWITCH',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'FAN DIMMER',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'STEEL NAIL 1-INCH',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'BLACK SCREW (SODANI) 1.25-INCH',
							'unit'	=> 'Nr'
						],
						[
							'label' => 'RAWAL PLUG',
							'unit'	=> 'Nr'
						]
						,
						[
							'label' => 'BLACK SCREW SODANI 2.5 INCH',
							'unit'	=> 'Nr'
						]
						,
						[
							'label' => 'THREE PIN PLUG',
							'unit'	=> 'Nr'
						]
						,
						[
							'label' => 'INAUGURATION BOARD',
							'unit'	=> 'Nr'
						]
			];
			// dd($supply_order);
			/* Instanciation of inherited class */
			$pdf = new PDF();
			$pdf->AddPage();
			/*output the result*/

			$pdf->Cell(50 ,3,'',0,1);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(20 ,4,'Site ID:',0,0,'L');
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(80 ,4,$site[0]["site_id"],0,0,'L'); //Site ID to be added here
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(20 ,4,'Date:',0,0,'L');
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(80 ,4,date('M d, Y'),0,1,'L'); // Date to be added here
			$pdf->SetFont('Arial','',12);
			$pdf->Cell(50 ,2,'',0,1);
			$pdf->Cell(20 ,4,'',0,0);
			$pdf->Cell(200 ,4,'SOLAR ELECTRIFICATION OF 4000 MASAJID PACKAGE -'.$site[0]['package'].'- PEDO KPK',0,1,'L'); // Package# to be added here
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(50 ,2,'',0,1);
			$pdf->Cell(110 ,4,'Packing List',0,1,'R');
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(40 ,4,'Site Name:',0,0,'L');
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(200 ,4,$site[0]['masgid'].' C/O '.$site[0]['khatib_caretaker_name'],0,1,'L'); //Site Name to be added here
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(40 ,4,'Site Address:',0,0,'L');
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(200 ,4,$site[0]['address'].','.$site[0]['uc_vc_name_and_no'].','.$site[0]['tehsil'].','.$site[0]['district'],0,1,'L'); //Site Address to be added here
			$pdf->Cell(50 ,3,'',0,1);

			$pdf->SetFont('Arial','B',10);
			/*Heading Of the table*/
			$pdf->Cell(20 ,5,'Sr. No',1,0,'L');
			$pdf->Cell(90 ,5,'Item Discription',1,0,'L');
			$pdf->Cell(23 ,5,'Qty',1,0,'L');
			$pdf->Cell(15 ,5,'Unit',1,0,'L');
			$pdf->Cell(40 ,5,'Remarks',1,1,'L');
			/*Heading Of the table end*/
			$pdf->SetFont('Arial','',8);

			$index  = 1;
			for ($i = 1; $i < sizeof($supply_order)-1; $i++) {
				if($site[0]['mounting_type'] == 3)
				{
					if($keys[$i] == "rawl_bolts_1075" || $keys[$i] == "ss_nut_and_bolt_with_two_washers_1030" || $keys[$i] == "pv_mounting_structure_2m")
					{

					}
					else
					{
						$pdf->Cell(20, 3.7, $index, 1, 0, 'L');
						$pdf->Cell(90, 3.7, $labels[$i]['label'], 1, 0, 'L');
						$pdf->Cell(23, 3.7, $supply_order[$keys[$i]], 1, 0, 'L');
						$pdf->Cell(15, 3.7, $labels[$i]['unit'], 1, 0, 'L');
						$pdf->Cell(40, 3.7, '', 1, 1, 'L');
						$index++;
					}
				}
				else
				{
					if($keys[$i] == "pole_mounted_pv_mounting_structure_4m")
					{

					}
					else
					{
						$pdf->Cell(20, 3.7, $index, 1, 0, 'L');
						$pdf->Cell(90, 3.7, $labels[$i]['label'], 1, 0, 'L');
						$pdf->Cell(23, 3.7, $supply_order[$keys[$i]], 1, 0, 'L');
						$pdf->Cell(15, 3.7, $labels[$i]['unit'], 1, 0, 'L');
						$pdf->Cell(40, 3.7, '', 1, 1, 'L');
						$index++;
					}
				}
			}

			$pdf->Line(10, 235, 100, 235);
			$pdf->Line(110, 235, 200, 235);

			if($index == 41)
			{
				$pdf->Cell(50 ,10,'',0,1);
			}
			else
			{
				$pdf->Cell(50 ,20,'',0,1);
			}

			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(100 ,4,'Delivered By',0,0,'C');
			$pdf->Cell(100 ,4,'Received By',0,1,'C'); //Site Address to be added here

			$pdf->SetFont('Arial','',8);
			// $pdf->Cell(10 ,10,'',0,1);
			$pdf->Cell(100 ,7,'Name:',0,0,'L');
			$pdf->Cell(100 ,7,'Name:',0,1,'L'); //Site Address to be added here
			// $pdf->Line(40, 265, 100, 245);
			// $pdf->Line(140, 265, 200, 245);
			$pdf->Cell(100 ,7,'',0,0,'L');
			$pdf->Cell(100 ,7,'CNIC:',0,1,'L');
			// $pdf->Line(130, 250, 200, 250);
			$pdf->Cell(100 ,7,'',0,0,'L');
			$pdf->Cell(40 ,18,'Thumb Impression',1,0,'L');
			$pdf->Cell(40 ,18,'',1,1,'L');
			$pdf->Output('D','Packing List.pdf');
		}

		echo view('templates/header', $data);
		echo view('templates/sidebar');
		echo view('supply_order/print');
		echo view('templates/footer');
	}

	public function print_supplied()
	{
		$data 					= [];
		$supply_order_model  	= new Sites_model();
		$supply_orders			= $supply_order_model->getSupplyOrdersGeneratedSites();
		$data['supply_orders']  = $supply_orders;

		$pdf = new PDF_1();
		$pdf->AddPage();
		/*output the result*/

		$pdf->Cell(50 ,3,'',0,1);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(50 ,2,'',0,1);
		$pdf->Cell(20 ,5,'',0,0);
		$pdf->Cell(150 ,10,'SOLAR ELECTRIFICATION OF 4000 MASAJID IN KPK',0,1,'C'); // Package# to be added here
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(50 ,2,'',0,1);
		$pdf->Cell(20 ,5,'',0,0);
		$pdf->Cell(150 ,10,'List of Supplied Sites',0,1,'C'); // Package# to be added here
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
		for ($i = 0; $i < sizeof($supply_orders); $i++) {
			$pdf->Row(array($index,$supply_orders[$i]['package'],$supply_orders[$i]['site_id'],$supply_orders[$i]['masgid'],$supply_orders[$i]['district'],$supply_orders[$i]['tehsil'],$supply_orders[$i]['uc_vc_name_and_no'],$supply_orders[$i]['na_pk']));
			$index++;
		}
		if ($index == 0)
		{
			$pdf->Cell(160, 5, "No Supplied Sites found", 1, 1, 'C');
		}

		$pdf->Output('D','Supplied_Sites.pdf');

		// echo view('templates/header', $data);
        // echo view('templates/sidebar');
		// echo view('supply_order/show');
		// echo view('templates/footer');
	}

    public function create($id = null)
    {
        $data 			= [];
        $serveys_model  = new Serveys_model();
		$servey 		= $serveys_model->getServeys($id);
		$data['servey'] = $servey;

		if ($this->request->getMethod() == 'post')
		{
			$rules = [
                'pv_module_ulica_ul' => [
						'label' => 'PV MODULE ULICA UL-445M-144',
						'rules' => 'required|item_quantity_exists[pv_module_ulica_ul]'
				],
                'inverter_growatt_spf_5000lt_hvm' => [
                        'label' => 'INVERTER GROWATT SPF 5000TL - HVM',
                        'rules' => 'required|item_quantity_exists[inverter_growatt_spf_5000lt_hvm]'
				],
				'lithium_battery_hresys_vhr_tl4875_lfp' => [
						'label' => 'LITHIUM BATTER HRESYS VHR TL4875LFP',
						'rules' => 'required|item_quantity_exists[lithium_battery_hresys_vhr_tl4875_lfp]'
				],
				'auto_voltage_stabilizer_6_kw' => [
						'label' => 'AUTO VOLTAGE STABILIZER 6.0KW',
						'rules' => 'required|item_quantity_exists[auto_voltage_stabilizer_6_kw]'
				],
				'mounting_rack_with_breakers_and_internal_wiring' => [
						'label' => 'MOUNTING RACK WITH BREAKERS AND INTERNAL WIRING',
						'rules' => 'required|item_quantity_exists[mounting_rack_with_breakers_and_internal_wiring]'
				],
				'pv_mounting_structure_2m' => [
						'label' => 'PV MOUNTING STRUCTURE 2M',
						'rules' => 'item_quantity_exists[pv_mounting_structure_2m]'
				],
				'pole_mounted_pv_mounting_structure_4m' => [
						'label' => 'POLE MOUNTED PV MOUNTING STRUCTURE 4M',
						'rules' => 'item_quantity_exists[pole_mounted_pv_mounting_structure_4m]'
				],
				'ss_nut_and_bolt_with_two_washers_1030' => [
						'label' => 'SS NUT & BOLT WITH 02 WASHERS 10 X 30',
						'rules' => 'item_quantity_exists[ss_nut_and_bolt_with_two_washers_1030]'
				],
				'rawl_bolts_1075' => [
						'label' => 'RAWL BOLTS 10 X 75',
						'rules' => 'item_quantity_exists[rawl_bolts_1075]'
				],
                'ss_nut_and_bolt_with_two_washers_825' => [
                        'label' => 'SS NUT & BOLT WITH 02 WASHERS 8 X 25',
                        'rules' => 'required|item_quantity_exists[ss_nut_and_bolt_with_two_washers_825]'
                ],
                'dc_cable_110_mm_sq_red' => [
                        'label' => 'DC CABLE 1 X 10 MM.SQ. (RED)',
                        'rules' => 'required|item_quantity_exists[dc_cable_110_mm_sq_red]'
                ],
                'dc_cable_110_mm_sq_black' => [
                        'label' => 'DC CABLE 1 X 10 MM.SQ. (BLACK)',
                        'rules' => 'required|item_quantity_exists[dc_cable_110_mm_sq_black]'
                ],
                'dc_cable_110_mm_sq_yellow' => [
                        'label' => 'DC CABLE 1 X 10 MM.SQ. (YELLOW)',
                        'rules' => 'required|item_quantity_exists[dc_cable_110_mm_sq_yellow]'
                ],
                'mc4_y_branch_pair_2_pcs' => [
                        'label' => 'MC4 Y-BRANCH PAIR (2 PCS)',
                        'rules' => 'required|item_quantity_exists[mc4_y_branch_pair_2_pcs]'
                ],
                'mc4_connector_pair_2_pcs' => [
                        'label' => 'MC4 CONNECTOR PAIR (2 PCS)',
                        'rules' => 'required|item_quantity_exists[mc4_connector_pair_2_pcs]'
                ],
                'hdpe_conduit_pipe_1_inch_dia' => [
                        'label' => 'HDPE CONDUIT PIPE 1-INCH DIA.',
                        'rules' => 'required|item_quantity_exists[hdpe_conduit_pipe_1_inch_dia]'
                ],
                'hdpe_elbow_1_inch_dia' => [
                        'label' => 'HDPE ELBOW 1-INCH DIA.',
                        'rules' => 'required|item_quantity_exists[hdpe_elbow_1_inch_dia]'
                ],
                'hdpe_t_joint_1_inch' => [
                        'label' => 'HDPE T-JOINT 1-INCH',
                        'rules' => 'required|item_quantity_exists[hdpe_t_joint_1_inch]'
                ],
                'copper_thimble_1610' => [
                        'label' => 'COPPER THIMBLE 16 X 10',
                        'rules' => 'required|item_quantity_exists[copper_thimble_1610]'
                ],
                'pvc_shroud_1610' => [
                        'label' => 'PVC SHROUD 16 X 10',
                        'rules' => 'required|item_quantity_exists[pvc_shroud_1610]'
                ],
                'copper_earthing_rod_5_ft' => [
                        'label' => 'COPPER EARTHING ROD 5FT',
                        'rules' => 'required|item_quantity_exists[copper_earthing_rod_5_ft]'
                ],
                'jubli_clamp_75_inch' => [
                        'label' => 'JUBLI CLAMP 0.75-INCH',
                        'rules' => 'required|item_quantity_exists[jubli_clamp_75_inch]'
                ],
                'jubli_clamp_125_inch' => [
                        'label' => 'JUBLI CLAMP 1.25-INCH',
                        'rules' => 'required|item_quantity_exists[jubli_clamp_125_inch]'
                ],
                'nylon_cable_tie_6_inch' => [
                        'label' => 'NYLON CABLE TIE 6-INCH',
                        'rules' => 'required|item_quantity_exists[nylon_cable_tie_6_inch]'
                ],
                'cable_tie_812_inch' => [
                        'label' => 'CABLE TIE 8~12-INCH',
                        'rules' => 'required|item_quantity_exists[cable_tie_812_inch]'
                ],
                'duct_patti_1625_mm_3_meter_long' => [
                        'label' => 'DUCT PATTI 16 X 25 MM 3 METER LONG',
                        'rules' => 'required|item_quantity_exists[duct_patti_1625_mm_3_meter_long]'
                ],
                'pvc_coated_gi_flexible_pipe_5_inch_dia' => [
                        'label' => 'PVC COATED GI FLEXIBLE PIPE 0.5-INCH DIA.',
                        'rules' => 'required|item_quantity_exists[pvc_coated_gi_flexible_pipe_5_inch_dia]'
                ],
                'ac_cable_729_red' => [
                        'label' => 'AC CABLE 7/0.029 (RED)',
                        'rules' => 'required|item_quantity_exists[ac_cable_729_red]'
                ],
                'ac_cable_729_black' => [
                        'label' => 'AC CABLE 7/0.029 (BLACK)',
                        'rules' => 'required|item_quantity_exists[ac_cable_729_black]'
                ],
                'ac_cable_736_red' => [
                        'label' => 'AC CABLE 7/0.036 (RED)',
                        'rules' => 'required|item_quantity_exists[ac_cable_736_red]'
                ],
                'ac_cable_736_black' => [
                        'label' => 'AC CABLE 7/0.036 (BLACK)',
                        'rules' => 'required|item_quantity_exists[ac_cable_736_black]'
                ],
                'e27_led_light_14_watt' => [
                        'label' => 'E27 LED LIGHT 14~15W',
                        'rules' => 'required|item_quantity_exists[e27_led_light_14_watt]'
                ],
                'e27_led_light_holder' => [
                        'label' => 'E27 LED LIGHT HOLDER With Mounting BASE',
                        'rules' => 'required|item_quantity_exists[e27_led_light_holder]'
                ],
                'ceiling_fan_40_watt' => [
                        'label' => 'CEILING FAN 40-50W',
                        'rules' => 'required|item_quantity_exists[ceiling_fan_40_watt]'
                ],
                'switch_board_with_base_5p' => [
                        'label' => 'SWITCH BOARD WITH BASE 3P',
                        'rules' => 'required|item_quantity_exists[switch_board_with_base_5p]'
                ],
                'switch_board_with_base_2p' => [
                        'label' => 'SWITCH BOARD WITH BASE 2P',
                        'rules' => 'required|item_quantity_exists[switch_board_with_base_2p]'
                ],
                'on_off_switch' => [
                        'label' => 'ON/OF SWITCH',
                        'rules' => 'required|item_quantity_exists[on_off_switch]'
                ],
                'fan_dimmer' => [
                        'label' => 'FAN DIMMER',
                        'rules' => 'required|item_quantity_exists[fan_dimmer]'
                ],
                'steel_nail_1_inch' => [
                        'label' => 'STEEL NAIL 1-INCH',
                        'rules' => 'required|item_quantity_exists[steel_nail_1_inch]'
                ],
                'black_screw_sodani_125_inch' => [
                        'label' => 'BLACK SCREW (SODANI) 1.25-INCH',
                        'rules' => 'required|item_quantity_exists[black_screw_sodani_125_inch]'
                ],
                'rawal_plug' => [
                        'label' => 'RAWAL PLUG',
                        'rules' => 'required|item_quantity_exists[rawal_plug]'
                ],
                'black_screw_sodani_25_inch' => [
                        'label' => 'blac SCREW SODANI 2.5 INCH',
                        'rules' => 'required|item_quantity_exists[black_screw_sodani_25_inch]'
                ],
                'three_pin_plug' => [
                        'label' => 'THREE PIN PLUG',
                        'rules' => 'required|item_quantity_exists[three_pin_plug]'
                ],
                'inauguration_board' => [
                        'label' => 'INAUGURATION BOARD',
                        'rules' => 'required|item_quantity_exists[inauguration_board]'
                ]
			];

			$errors =
            [
                'pv_module_ulica_ul' => [
					'item_quantity_exists' => 'PV MODULE ULICA UL-445M-144 does not have this quantity in stock'
				],
				'inverter_growatt_spf_5000lt_hvm' => [
					'item_quantity_exists' => 'INVERTER GROWATT SPF 5000TL - HVM does not have this quantity in stock'
				],
				'lithium_battery_hresys_vhr_tl4875_lfp' => [
					'item_quantity_exists' => 'LITHIUM BATTER HRESYS VHR TL4875LFP does not have this quantity in stock'
				],
				'auto_voltage_stabilizer_6_kw' => [
					'item_quantity_exists' => 'AUTO VOLTAGE STABILIZER 6.0KW does not have this quantity in stock'
				],
				'mounting_rack_with_breakers_and_internal_wiring' => [
					'item_quantity_exists' => 'MOUNTING RACK WITH BREAKERS AND INTERNAL WIRING does not have this quantity in stock'
				],
				'pv_mounting_structure_2m' => [
					'item_quantity_exists' => 'PV MOUNTING STRUCTURE 2M does not have this quantity in stock'
				],
				'pole_mounted_pv_mounting_structure_4m' => [
					'item_quantity_exists' => 'POLE MOUNTED PV MOUNTING STRUCTURE 4M does not have this quantity in stock'
				],
				'ss_nut_and_bolt_with_two_washers_1030' => [
					'item_quantity_exists' => 'SS NUT & BOLT WITH 02 WASHERS 10 X 30 does not have this quantity in stock'
				],
				'rawl_bolts_1075' => [
					'item_quantity_exists' => 'RAWL BOLTS 10 X 75 does not have this quantity in stock'
				],
				'ss_nut_and_bolt_with_two_washers_825' => [
					'item_quantity_exists' => 'SS NUT & BOLT WITH 02 WASHERS 8 X 25 does not have this quantity in stock'
				],
				'dc_cable_110_mm_sq_red' => [
					'item_quantity_exists' => 'DC CABLE 1 X 10 MM.SQ. (RED) does not have this quantity in stock'
				],
				'dc_cable_110_mm_sq_black' => [
					'item_quantity_exists' => 'DC CABLE 1 X 10 MM.SQ. (BLACK) does not have this quantity in stock'
				],
				'dc_cable_110_mm_sq_yellow' => [
					'item_quantity_exists' => 'DC CABLE 1 X 10 MM.SQ. (YELLOW) does not have this quantity in stock'
				],
				'mc4_y_branch_pair_2_pcs' => [
					'item_quantity_exists' => 'MC4 Y-BRANCH PAIR (2 PCS) does not have this quantity in stock'
				],
				'mc4_connector_pair_2_pcs' => [
					'item_quantity_exists' => 'MC4 CONNECTOR PAIR (2 PCS) does not have this quantity in stock'
				],
				'hdpe_conduit_pipe_1_inch_dia' => [
					'item_quantity_exists' => 'HDPE CONDUIT PIPE 1-INCH DIA does not have this quantity in stock'
				],
				'hdpe_elbow_1_inch_dia' => [
					'item_quantity_exists' => 'HDPE ELBOW 1-INCH DIA does not have this quantity in stock'
				],
				'hdpe_t_joint_1_inch' => [
					'item_quantity_exists' => 'HDPE T-JOINT 1-INCH does not have this quantity in stock'
				],
				'copper_thimble_1610' => [
					'item_quantity_exists' => 'COPPER THIMBLE 16 X 10 does not have this quantity in stock'
				],
				'pvc_shroud_1610' => [
					'item_quantity_exists' => 'PVC SHROUD 16 X 10 does not have this quantity in stock'
				],
				'copper_earthing_rod_5_ft' => [
					'item_quantity_exists' => 'COPPER EARTHING ROD 5FT does not have this quantity in stock'
				],
				'jubli_clamp_75_inch' => [
					'item_quantity_exists' => 'JUBLI CLAMP 0.75-INCH does not have this quantity in stock'
				],
				'jubli_clamp_125_inch' => [
					'item_quantity_exists' => 'JUBLI CLAMP 1.25-INCH does not have this quantity in stock'
				],
				'nylon_cable_tie_6_inch' => [
					'item_quantity_exists' => 'NYLON CABLE TIE 6-INCH does not have this quantity in stock'
				],
				'cable_tie_812_inch' => [
					'item_quantity_exists' => 'CABLE TIE 8~12-INCH does not have this quantity in stock'
				],
				'duct_patti_1625_mm_3_meter_long' => [
					'item_quantity_exists' => 'DUCT PATTI 16 X 25 MM 3 METER LONG does not have this quantity in stock'
				],
				'pvc_coated_gi_flexible_pipe_5_inch_dia' => [
					'item_quantity_exists' => 'PVC COATED GI FLEXIBLE PIPE 0.5-INCH DIA does not have this quantity in stock'
				],
				'ac_cable_729_red' => [
					'item_quantity_exists' => 'AC CABLE 7/0.029 (RED) does not have this quantity in stock'
				],
				'ac_cable_729_black' => [
					'item_quantity_exists' => 'AC CABLE 7/0.029 (BLACK) does not have this quantity in stock'
				],
				'ac_cable_736_red' => [
					'item_quantity_exists' => 'AC CABLE 7/0.036 (RED) does not have this quantity in stock'
				],
				'ac_cable_736_black' => [
					'item_quantity_exists' => 'AC CABLE 7/0.036 (BLACK) does not have this quantity in stock'
				],
				'e27_led_light_14_watt' => [
					'item_quantity_exists' => 'E27 LED LIGHT 14~15W does not have this quantity in stock'
				],
				'e27_led_light_holder' => [
					'item_quantity_exists' => 'E27 LED LIGHT HOLDER With Mounting BASE does not have this quantity in stock'
				],
				'ceiling_fan_40_watt' => [
					'item_quantity_exists' => 'CEILING FAN 40-50W does not have this quantity in stock'
				],
				'switch_board_with_base_5p' => [
					'item_quantity_exists' => 'SWITCH BOARD WITH BASE 3P does not have this quantity in stock'
				],
				'switch_board_with_base_2p' => [
					'item_quantity_exists' => 'SWITCH BOARD WITH BASE 2P does not have this quantity in stock'
				],
				'on_off_switch' => [
					'item_quantity_exists' => 'ON/OF SWITCH does not have this quantity in stock'
				],
				'fan_dimmer' => [
					'item_quantity_exists' => 'FAN DIMMER does not have this quantity in stock'
				],
				'steel_nail_1_inch' => [
					'item_quantity_exists' => 'STEEL NAIL 1-INCH does not have this quantity in stock'
				],
				'black_screw_sodani_125_inch' => [
					'item_quantity_exists' => 'BLACK SCREW (SODANI) 1.25-INCH does not have this quantity in stock'
				],
				'rawal_plug' => [
					'item_quantity_exists' => 'RAWAL PLUG does not have this quantity in stock'
				],
				'black_screw_sodani_25_inch' => [
					'item_quantity_exists' => 'BLACK SCREW SODANI 2.5 INCH does not have this quantity in stock'
				],
				'three_pin_plug' => [
					'item_quantity_exists' => 'THREE PIN PLUG does not have this quantity in stock'
				],
				'inauguration_board' => [
					'item_quantity_exists' => 'INAUGURATION BOARD does not have this quantity in stock'
				],
				'dc_cable_110_mm_sq_red' => [
					'item_quantity_exists' => 'DC CABLE 1 X 10 MM.SQ. (RED) does not have this quantity in stock'
				],
				'dc_cable_110_mm_sq_red' => [
					'item_quantity_exists' => 'DC CABLE 1 X 10 MM.SQ. (RED) does not have this quantity in stock'
				],
				'dc_cable_110_mm_sq_red' => [
					'item_quantity_exists' => 'DC CABLE 1 X 10 MM.SQ. (RED) does not have this quantity in stock'
				],
				'dc_cable_110_mm_sq_red' => [
					'item_quantity_exists' => 'DC CABLE 1 X 10 MM.SQ. (RED) does not have this quantity in stock'
				],
			];

			if (! $this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
			}else{
				$supply_order_model = new Supply_Order_model();

                $newData = [
                    'pv_module_ulica_ul'                        		=> $this->request->getVar('pv_module_ulica_ul'),
					'inverter_growatt_spf_5000lt_hvm'            		=> $this->request->getVar('inverter_growatt_spf_5000lt_hvm'),
					'lithium_battery_hresys_vhr_tl4875_lfp'            	=> $this->request->getVar('lithium_battery_hresys_vhr_tl4875_lfp'),
					'auto_voltage_stabilizer_6_kw'            			=> $this->request->getVar('auto_voltage_stabilizer_6_kw'),
					'mounting_rack_with_breakers_and_internal_wiring'	=> $this->request->getVar('mounting_rack_with_breakers_and_internal_wiring'),
                    'pv_mounting_structure_2m'                  		=> $this->request->getVar('pv_mounting_structure_2m'),
                    'pole_mounted_pv_mounting_structure_4m'     		=> $this->request->getVar('pole_mounted_pv_mounting_structure_4m'),
                    'ss_nut_and_bolt_with_two_washers_1030'     		=> $this->request->getVar('ss_nut_and_bolt_with_two_washers_1030'),
                    'ss_nut_and_bolt_with_two_washers_825'      		=> $this->request->getVar('ss_nut_and_bolt_with_two_washers_825'),
                    'rawl_bolts_1075'                           		=> $this->request->getVar('rawl_bolts_1075'),
                    'dc_cable_110_mm_sq_red'                    		=> $this->request->getVar('dc_cable_110_mm_sq_red'),
                    'dc_cable_110_mm_sq_black'                  		=> $this->request->getVar('dc_cable_110_mm_sq_black'),
                    'dc_cable_110_mm_sq_yellow'                 		=> $this->request->getVar('dc_cable_110_mm_sq_yellow'),
                    'mc4_y_branch_pair_2_pcs'                   		=> $this->request->getVar('mc4_y_branch_pair_2_pcs'),
                    'mc4_connector_pair_2_pcs'                  		=> $this->request->getVar('mc4_connector_pair_2_pcs'),
                    'hdpe_conduit_pipe_1_inch_dia'              		=> $this->request->getVar('hdpe_conduit_pipe_1_inch_dia'),
                    'hdpe_elbow_1_inch_dia'                     		=> $this->request->getVar('hdpe_elbow_1_inch_dia'),
                    'hdpe_t_joint_1_inch'                       		=> $this->request->getVar('hdpe_t_joint_1_inch'),
                    'copper_thimble_1610'                       		=> $this->request->getVar('copper_thimble_1610'),
                    'pvc_shroud_1610'                           		=> $this->request->getVar('pvc_shroud_1610'),
                    'copper_earthing_rod_5_ft'                  		=> $this->request->getVar('copper_earthing_rod_5_ft'),
                    'jubli_clamp_75_inch'                       		=> $this->request->getVar('jubli_clamp_75_inch'),
                    'jubli_clamp_125_inch'                      		=> $this->request->getVar('jubli_clamp_125_inch'),
                    'nylon_cable_tie_6_inch'                    		=> $this->request->getVar('nylon_cable_tie_6_inch'),
                    'cable_tie_812_inch'                        		=> $this->request->getVar('cable_tie_812_inch'),
                    'duct_patti_1625_mm_3_meter_long'           		=> $this->request->getVar('duct_patti_1625_mm_3_meter_long'),
                    'pvc_coated_gi_flexible_pipe_5_inch_dia'    		=> $this->request->getVar('pvc_coated_gi_flexible_pipe_5_inch_dia'),
                    'ac_cable_729_red'                          		=> $this->request->getVar('ac_cable_729_red'),
                    'ac_cable_729_black'                        		=> $this->request->getVar('ac_cable_729_black'),
                    'ac_cable_736_red'                          		=> $this->request->getVar('ac_cable_736_red'),
                    'ac_cable_736_black'                        		=> $this->request->getVar('ac_cable_736_black'),
                    'e27_led_light_14_watt'                     		=> $this->request->getVar('e27_led_light_14_watt'),
                    'e27_led_light_holder'                      		=> $this->request->getVar('e27_led_light_holder'),
                    'ceiling_fan_40_watt'                       		=> $this->request->getVar('ceiling_fan_40_watt'),
                    'switch_board_with_base_5p'                 		=> $this->request->getVar('switch_board_with_base_5p'),
                    'switch_board_with_base_2p'                 		=> $this->request->getVar('switch_board_with_base_2p'),
                    'on_off_switch'                             		=> $this->request->getVar('on_off_switch'),
                    'fan_dimmer'                                		=> $this->request->getVar('fan_dimmer'),
                    'steel_nail_1_inch'                         		=> $this->request->getVar('steel_nail_1_inch'),
                    'black_screw_sodani_125_inch'               		=> $this->request->getVar('black_screw_sodani_125_inch'),
                    'rawal_plug'                                		=> $this->request->getVar('rawal_plug'),
										'black_screw_sodani_25_inch'                    => $this->request->getVar('black_screw_sodani_25_inch'),
										'three_pin_plug'                                => $this->request->getVar('three_pin_plug'),
										'inauguration_board'                            => $this->request->getVar('inauguration_board'),
                    'site_id'                                   		=> $this->request->getVar('site_id'),
				];

				$stocks_model = new Stocks_model();
				$keys = array_keys($newData);
				for ($i=0; $i < (sizeof($keys) - 1); $i++)
				{
					$item = $stocks_model->getStockItemByName($keys[$i]);
					if($item)
					{
						$stocks_model->updateItemByName($item['name'], ['quantity' => (intval($item['quantity']) - intval($newData[$keys[$i]]))]);
						$item = $stocks_model->getStockItemByName($keys[$i]);
					}
				}

				$supply_order_model->save($newData);;
				$supply_order_status = ['supply_order_status' => 1];
				$serveys_model->updateServeyStatus($servey[0]["id"], $supply_order_status);
				$session = session();
				$session->setFlashdata('success', 'Supply Order Submitted Successfully');
				return redirect()->to(base_url().'/supply_order/manage');

			}
        }

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('supply_order/create');
		echo view('templates/footer');

	}

	public function delete($id)
	{
		$supply_order_model = new Supply_Order_model();
		$supply_order = $supply_order_model->getSupplyOrder($id);
		$keys = array_keys($supply_order[0]);
		$serveys_model  	= new Serveys_model();
		$supply_order_status = ['supply_order_status' => 0];
		$servey 		= $serveys_model->getServeys($id);
		$serveys_model->updateServeyStatus($servey[0]["id"], $supply_order_status);

		$stocks_model = new Stocks_model();
		for ($i = 1; $i < (sizeof($keys) - 1); $i++)
		{
			$item = $stocks_model->getStockItemByName($keys[$i]);
			if($item)
			{
				$stocks_model->updateItemByName($item['name'], ['quantity' => (intval($item['quantity']) + intval($supply_order[0][$keys[$i]]))]);
				$item = $stocks_model->getStockItemByName($keys[$i]);
			}
		}

		$supply_order_model->deleteSupplyOrder($id);

		$session = session();
		$session->setFlashdata('success', 'Deleted Successfully');
		return redirect()->to(base_url().'/supply_order/manage');
	}
}
