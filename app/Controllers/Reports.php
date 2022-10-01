<?php namespace App\Controllers;

use App\Models\Sites_model;
use App\Models\Serveys_model;
use App\Models\Site_Installations_model;
use App\Models\Fat_model;
use App\Models\Handing_Taking_model;

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

			//Print the text
			$this->Rect($x,$y,$w,$h);
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


class Reports extends BaseController
{
	public function survey_reports()
	{
		$serveys_model  = new Serveys_model();
        $data['serveys']  = $serveys_model->getServeys();

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('reports/survey_reports');
		echo view('templates/footer');
	}

	public function non_feasible_reports()
	{
		$serveys_model  = new Serveys_model();
        $data['serveys']  = $serveys_model->getServeys();

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('reports/non_feasible_reports');
		echo view('templates/footer');
	}

	public function supplied_sites_reports()
	{
		$serveys_model  = new Serveys_model();
        $data['serveys']  = $serveys_model->getServeys();

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('reports/supplied_sites_reports');
		echo view('templates/footer');
	}

	public function installed_sites_reports()
	{
		$serveys_model  = new Serveys_model();
        $data['serveys']  = $serveys_model->getServeys();

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('reports/installed_sites_reports');
		echo view('templates/footer');
	}

	public function final_tested_sites_reports()
	{
		$serveys_model  = new Serveys_model();
        $data['serveys']  = $serveys_model->getServeys();

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('reports/final_tested_sites_reports');
		echo view('templates/footer');
	}

	public function completed_sites_reports()
	{
		$serveys_model  = new Serveys_model();
        $data['serveys']  = $serveys_model->getServeys();

        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('reports/completed_sites_reports');
		echo view('templates/footer');
	}

	public function print_report(){
		$sub_filter = "";
		$serveys_model  = new Serveys_model();
		$data = [];

		if($this->request->getVar('report_filter') == "all")
		{
			$sub_filter = "all";
			$data  = $serveys_model->getServeysReport();
		}
		elseif ($this->request->getVar('report_filter') == "package") 
		{
			$sub_filter = $this->request->getVar('package_sub_filter');
			$data  = $serveys_model->getServeysReport($sub_filter,"package");
		}
		elseif ($this->request->getVar('report_filter') == "district") 
		{
			$sub_filter = $this->request->getVar('district_sub_filter');
			$data  = $serveys_model->getServeysReport($sub_filter,"district");
		}

		// dd($data);

		if($this->request->getVar('print_as') == "pdf"){
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
			for ($i = 0; $i < sizeof($data); $i++) {
				if($data[$i]['is_surveyed'] == "1")
				{
					$pdf->Row(array($index,$data[$i]['package'],$data[$i]['siteid'],$data[$i]['masgid'],$data[$i]['district'],$data[$i]['tehsil'],$data[$i]['uc_vc_name_and_no'],$data[$i]['na_pk']));
					$index++;
				}
			}
			if ($index == 0) 
			{
				$pdf->Cell(160, 5, "No Surveyed Sites found", 1, 1, 'C');
			}
	
			$pdf->Output('D','Surveyed_Report.pdf');
		}
		elseif ($this->request->getVar('print_as') == "csv") {

			$file_name = 'Surveyed_Report.csv'; 
			header("Content-Description: File Transfer"); 
			header("Content-Disposition: attachment; filename=$file_name"); 
			header("Content-Type: application/csv;");

			// file creation 
			$file = fopen('php://output', 'w');
			fputcsv($file, array("","","","SOLAR ELECTRIFICATION OF 4000 MASAJID IN KPK","","","",""));
			fputcsv($file, array("","","","","","","",""));
			fputcsv($file, array("","","","","","","",""));
			fputcsv($file, array("","","","List of Surveyed Sites","","","",""));
			fputcsv($file, array("","","","","","","",""));
			fputcsv($file, array("","","","","","","",""));
			fputcsv($file, array("Contractor: ","MAK Pumps Pvt Ltd","","","","","Updated On: ",date('M d, Y')));
			fputcsv($file, array("","","","","","","",""));
			$header = array("Sr. No","Package","Site ID","Masjid Name","District","Tehsil","UC/VC Name & No","NA/PK"); 
			fputcsv($file, $header);
			$index  = 1;
			for ($i = 0; $i < sizeof($data); $i++) {
				if($data[$i]['is_surveyed'] == "1")
				{
					fputcsv($file, array($index,$data[$i]['package'],$data[$i]['siteid'],$data[$i]['masgid'],$data[$i]['district'],$data[$i]['tehsil'],$data[$i]['uc_vc_name_and_no'],$data[$i]['na_pk'])); 
					$index++;
				}
			}

			fclose($file); 
			exit; 
		}
	}

	public function print_non_feasible_report(){
		$sub_filter = "";
		$serveys_model  = new Serveys_model();
		$data = [];

		if($this->request->getVar('report_filter') == "all")
		{
			$sub_filter = "all";
			$data  = $serveys_model->getServeysReport();
		}
		elseif ($this->request->getVar('report_filter') == "package") 
		{
			$sub_filter = $this->request->getVar('package_sub_filter');
			$data  = $serveys_model->getServeysReport($sub_filter,"package");
		}
		elseif ($this->request->getVar('report_filter') == "district") 
		{
			$sub_filter = $this->request->getVar('district_sub_filter');
			$data  = $serveys_model->getServeysReport($sub_filter,"district");
		}

		// dd($data);

		if($this->request->getVar('print_as') == "pdf"){
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
			$pdf->Cell(150 ,10,'List of Non-Feasible Sites',0,1,'C'); // Package# to be added here
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
			$pdf->Cell(40 ,5,'Remarks',1,0,'L');
			$pdf->Cell(20 ,5,'NA/PK',1,1,'L');
			/*Heading Of the table end*/
			$pdf->SetFont('Arial','',8);
			$pdf->SetWidths(array(20,20,20,30,20,20,40,20));
			$index  = 1;
			for ($i = 0; $i < sizeof($data); $i++) {
				if($data[$i]['site_feasibility'] == "0")
				{
					$pdf->Row(array($index,$data[$i]['package'],$data[$i]['siteid'],$data[$i]['masgid'],$data[$i]['district'],$data[$i]['tehsil'],$data[$i]['remarks'],$data[$i]['na_pk']));
					$index++;
				}
			}
			if ($index == 0) 
			{
				$pdf->Cell(160, 5, "No Non-Feasible Sites found", 1, 1, 'C');
			}
	
			$pdf->Output('D','Non_Feasible_Report.pdf');
		}
		elseif ($this->request->getVar('print_as') == "csv") {

			$file_name = 'Non_Feasible_Report.csv'; 
			header("Content-Description: File Transfer"); 
			header("Content-Disposition: attachment; filename=$file_name"); 
			header("Content-Type: application/csv;");

			// file creation 
			$file = fopen('php://output', 'w');
			fputcsv($file, array("","","","SOLAR ELECTRIFICATION OF 4000 MASAJID IN KPK","","","",""));
			fputcsv($file, array("","","","","","","",""));
			fputcsv($file, array("","","","","","","",""));
			fputcsv($file, array("","","","List of Non_Feasible Sites","","","",""));
			fputcsv($file, array("","","","","","","",""));
			fputcsv($file, array("","","","","","","",""));
			fputcsv($file, array("Contractor: ","MAK Pumps Pvt Ltd","","","","","Updated On: ",date('M d, Y')));
			fputcsv($file, array("","","","","","","",""));
			$header = array("Sr. No","Package","Site ID","Masjid Name","District","Tehsil","Remarks","NA/PK"); 
			fputcsv($file, $header);
			$index  = 1;
			for ($i = 0; $i < sizeof($data); $i++) {
				if($data[$i]['site_feasibility'] == "0")
				{
					fputcsv($file, array($index,$data[$i]['package'],$data[$i]['siteid'],$data[$i]['masgid'],$data[$i]['district'],$data[$i]['tehsil'],$data[$i]['remarks'],$data[$i]['na_pk'])); 
					$index++;
				}
			}

			fclose($file); 
			exit; 
		}
	}


	public function print_supplied_sites_report(){
		$sub_filter = "";
		$serveys_model  = new Serveys_model();
		$data = [];

		if($this->request->getVar('report_filter') == "all")
		{
			$sub_filter = "all";
			$data  = $serveys_model->getServeysReport();
		}
		elseif ($this->request->getVar('report_filter') == "package") 
		{
			$sub_filter = $this->request->getVar('package_sub_filter');
			$data  = $serveys_model->getServeysReport($sub_filter,"package");
		}
		elseif ($this->request->getVar('report_filter') == "district") 
		{
			$sub_filter = $this->request->getVar('district_sub_filter');
			$data  = $serveys_model->getServeysReport($sub_filter,"district");
		}

		// dd($data);

		if($this->request->getVar('print_as') == "pdf"){
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
			for ($i = 0; $i < sizeof($data); $i++) {
				if($data[$i]['supply_order_status'] == "1")
				{
					$pdf->Row(array($index,$data[$i]['package'],$data[$i]['siteid'],$data[$i]['masgid'],$data[$i]['district'],$data[$i]['tehsil'],$data[$i]['uc_vc_name_and_no'],$data[$i]['na_pk']));
					$index++;
				}
			}
			if ($index == 0) 
			{
				$pdf->Cell(160, 5, "No Supplied Sites found", 1, 1, 'C');
			}
	
			$pdf->Output('D','Supplied_Report.pdf');
		}
		elseif ($this->request->getVar('print_as') == "csv") {

			$file_name = 'Supplied_Report.csv'; 
			header("Content-Description: File Transfer"); 
			header("Content-Disposition: attachment; filename=$file_name"); 
			header("Content-Type: application/csv;");

			// file creation 
			$file = fopen('php://output', 'w');
			fputcsv($file, array("","","","SOLAR ELECTRIFICATION OF 4000 MASAJID IN KPK","","","",""));
			fputcsv($file, array("","","","","","","",""));
			fputcsv($file, array("","","","","","","",""));
			fputcsv($file, array("","","","List of Supplied Sites","","","",""));
			fputcsv($file, array("","","","","","","",""));
			fputcsv($file, array("","","","","","","",""));
			fputcsv($file, array("Contractor: ","MAK Pumps Pvt Ltd","","","","","Updated On: ",date('M d, Y')));
			fputcsv($file, array("","","","","","","",""));
			$header = array("Sr. No","Package","Site ID","Masjid Name","District","Tehsil","UC/VC Name & No","NA/PK"); 
			fputcsv($file, $header);
			$index  = 1;
			for ($i = 0; $i < sizeof($data); $i++) {
				if($data[$i]['supply_order_status'] == "1")
				{
					fputcsv($file, array($index,$data[$i]['package'],$data[$i]['siteid'],$data[$i]['masgid'],$data[$i]['district'],$data[$i]['tehsil'],$data[$i]['uc_vc_name_and_no'],$data[$i]['na_pk'])); 
					$index++;
				}
			}

			fclose($file); 
			exit; 
		}
	}

	public function print_installed_report(){
		$sub_filter = "";
		$serveys_model  = new Serveys_model();
		$data = [];

		if($this->request->getVar('report_filter') == "all")
		{
			$sub_filter = "all";
			$data  = $serveys_model->getServeysReport();
		}
		elseif ($this->request->getVar('report_filter') == "package") 
		{
			$sub_filter = $this->request->getVar('package_sub_filter');
			$data  = $serveys_model->getServeysReport($sub_filter,"package");
		}
		elseif ($this->request->getVar('report_filter') == "district") 
		{
			$sub_filter = $this->request->getVar('district_sub_filter');
			$data  = $serveys_model->getServeysReport($sub_filter,"district");
		}

		// dd($data);

		if($this->request->getVar('print_as') == "pdf"){
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
			for ($i = 0; $i < sizeof($data); $i++) {
				if($data[$i]['is_installed'] == "1")
				{
					$pdf->Row(array($index,$data[$i]['package'],$data[$i]['siteid'],$data[$i]['masgid'],$data[$i]['district'],$data[$i]['tehsil'],$data[$i]['uc_vc_name_and_no'],$data[$i]['na_pk']));
					$index++;
				}
			}
			if ($index == 0) 
			{
				$pdf->Cell(160, 5, "No Installed Sites found", 1, 1, 'C');
			}
	
			$pdf->Output('D','Installed_Report.pdf');
		}
		elseif ($this->request->getVar('print_as') == "csv") {

			$file_name = 'Installed_Report.csv'; 
			header("Content-Description: File Transfer"); 
			header("Content-Disposition: attachment; filename=$file_name"); 
			header("Content-Type: application/csv;");

			// file creation 
			$file = fopen('php://output', 'w');
			fputcsv($file, array("","","","SOLAR ELECTRIFICATION OF 4000 MASAJID IN KPK","","","",""));
			fputcsv($file, array("","","","","","","",""));
			fputcsv($file, array("","","","","","","",""));
			fputcsv($file, array("","","","List of Installed Sites","","","",""));
			fputcsv($file, array("","","","","","","",""));
			fputcsv($file, array("","","","","","","",""));
			fputcsv($file, array("Contractor: ","MAK Pumps Pvt Ltd","","","","","Updated On: ",date('M d, Y')));
			fputcsv($file, array("","","","","","","",""));
			$header = array("Sr. No","Package","Site ID","Masjid Name","District","Tehsil","UC/VC Name & No","NA/PK"); 
			fputcsv($file, $header);
			$index  = 1;
			for ($i = 0; $i < sizeof($data); $i++) {
				if($data[$i]['is_installed'] == "1")
				{
					fputcsv($file, array($index,$data[$i]['package'],$data[$i]['siteid'],$data[$i]['masgid'],$data[$i]['district'],$data[$i]['tehsil'],$data[$i]['uc_vc_name_and_no'],$data[$i]['na_pk'])); 
					$index++;
				}
			}

			fclose($file); 
			exit; 
		}
	}

	public function print_final_tested_report(){
		$sub_filter = "";
		$serveys_model  = new Serveys_model();
		$data = [];

		if($this->request->getVar('report_filter') == "all")
		{
			$sub_filter = "all";
			$data  = $serveys_model->getServeysReport();
		}
		elseif ($this->request->getVar('report_filter') == "package") 
		{
			$sub_filter = $this->request->getVar('package_sub_filter');
			$data  = $serveys_model->getServeysReport($sub_filter,"package");
		}
		elseif ($this->request->getVar('report_filter') == "district") 
		{
			$sub_filter = $this->request->getVar('district_sub_filter');
			$data  = $serveys_model->getServeysReport($sub_filter,"district");
		}

		// dd($data);

		if($this->request->getVar('print_as') == "pdf"){
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
			$pdf->Cell(150 ,10,'List of Final Tested Sites',0,1,'C'); // Package# to be added here
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
			for ($i = 0; $i < sizeof($data); $i++) {
				if($data[$i]['fat_status'] == "1")
				{
					$pdf->Row(array($index,$data[$i]['package'],$data[$i]['siteid'],$data[$i]['masgid'],$data[$i]['district'],$data[$i]['tehsil'],$data[$i]['uc_vc_name_and_no'],$data[$i]['na_pk']));
					$index++;
				}
			}
			if ($index == 0) 
			{
				$pdf->Cell(160, 5, "No Final Tested Sites found", 1, 1, 'C');
			}
	
			$pdf->Output('D','Final_Tested_Report.pdf');
		}
		elseif ($this->request->getVar('print_as') == "csv") {

			$file_name = 'Final_Tested_Report.csv'; 
			header("Content-Description: File Transfer"); 
			header("Content-Disposition: attachment; filename=$file_name"); 
			header("Content-Type: application/csv;");

			// file creation 
			$file = fopen('php://output', 'w');
			fputcsv($file, array("","","","SOLAR ELECTRIFICATION OF 4000 MASAJID IN KPK","","","",""));
			fputcsv($file, array("","","","","","","",""));
			fputcsv($file, array("","","","","","","",""));
			fputcsv($file, array("","","","List of Final Tested Sites","","","",""));
			fputcsv($file, array("","","","","","","",""));
			fputcsv($file, array("","","","","","","",""));
			fputcsv($file, array("Contractor: ","MAK Pumps Pvt Ltd","","","","","Updated On: ",date('M d, Y')));
			fputcsv($file, array("","","","","","","",""));
			$header = array("Sr. No","Package","Site ID","Masjid Name","District","Tehsil","UC/VC Name & No","NA/PK"); 
			fputcsv($file, $header);
			$index  = 1;
			for ($i = 0; $i < sizeof($data); $i++) {
				if($data[$i]['fat_status'] == "1")
				{
					fputcsv($file, array($index,$data[$i]['package'],$data[$i]['siteid'],$data[$i]['masgid'],$data[$i]['district'],$data[$i]['tehsil'],$data[$i]['uc_vc_name_and_no'],$data[$i]['na_pk'])); 
					$index++;
				}
			}

			fclose($file); 
			exit; 
		}
	}

	public function print_completed_report(){
		$sub_filter = "";
		$serveys_model  = new Serveys_model();
		$data = [];

		if($this->request->getVar('report_filter') == "all")
		{
			$sub_filter = "all";
			$data  = $serveys_model->getServeysReport();
		}
		elseif ($this->request->getVar('report_filter') == "package") 
		{
			$sub_filter = $this->request->getVar('package_sub_filter');
			$data  = $serveys_model->getServeysReport($sub_filter,"package");
		}
		elseif ($this->request->getVar('report_filter') == "district") 
		{
			$sub_filter = $this->request->getVar('district_sub_filter');
			$data  = $serveys_model->getServeysReport($sub_filter,"district");
		}

		// dd($data);

		if($this->request->getVar('print_as') == "pdf"){
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
			$pdf->Cell(150 ,10,'List of Completed Sites',0,1,'C'); // Package# to be added here
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
			for ($i = 0; $i < sizeof($data); $i++) {
				if($data[$i]['handing_taking_status'] == "1")
				{
					$pdf->Row(array($index,$data[$i]['package'],$data[$i]['siteid'],$data[$i]['masgid'],$data[$i]['district'],$data[$i]['tehsil'],$data[$i]['uc_vc_name_and_no'],$data[$i]['na_pk']));
					$index++;
				}
			}
			if ($index == 0) 
			{
				$pdf->Cell(160, 5, "No Completed Sites found", 1, 1, 'C');
			}
	
			$pdf->Output('D','Completed_Report.pdf');
		}
		elseif ($this->request->getVar('print_as') == "csv") {

			$file_name = 'Completed_Report.csv'; 
			header("Content-Description: File Transfer"); 
			header("Content-Disposition: attachment; filename=$file_name"); 
			header("Content-Type: application/csv;");

			// file creation 
			$file = fopen('php://output', 'w');
			fputcsv($file, array("","","","SOLAR ELECTRIFICATION OF 4000 MASAJID IN KPK","","","",""));
			fputcsv($file, array("","","","","","","",""));
			fputcsv($file, array("","","","","","","",""));
			fputcsv($file, array("","","","List of Completed Sites","","","",""));
			fputcsv($file, array("","","","","","","",""));
			fputcsv($file, array("","","","","","","",""));
			fputcsv($file, array("Contractor: ","MAK Pumps Pvt Ltd","","","","","Updated On: ",date('M d, Y')));
			fputcsv($file, array("","","","","","","",""));
			$header = array("Sr. No","Package","Site ID","Masjid Name","District","Tehsil","UC/VC Name & No","NA/PK"); 
			fputcsv($file, $header);
			$index  = 1;
			for ($i = 0; $i < sizeof($data); $i++) {
				if($data[$i]['handing_taking_status'] == "1")
				{
					fputcsv($file, array($index,$data[$i]['package'],$data[$i]['siteid'],$data[$i]['masgid'],$data[$i]['district'],$data[$i]['tehsil'],$data[$i]['uc_vc_name_and_no'],$data[$i]['na_pk'])); 
					$index++;
				}
			}

			fclose($file); 
			exit; 
		}
	}

	public function print_survey_report($id)
	{
		$serveys_model  = new Serveys_model();
		$survey  		= $serveys_model->getServeys($id);

		$keys = array_keys($survey[0]);
		// dd($keys);
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
		$pdf->Cell(150 ,10,$survey[0]['siteid'].' - Survey Data',0,1,'C'); // Package# to be added here
		$pdf->Cell(50 ,2,'',0,1);
		$pdf->Cell(20 ,5,'',0,0);
		$pdf->Cell(150 ,10,$survey[0]['masgid'].', '.$survey[0]['tehsil'].', '.$survey[0]['district'],0,1,'C'); // Package# to be added here

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
		$pdf->Cell(50 ,5,'Parameter',1,0,'L');
		$pdf->Cell(100 ,5,'Value',1,1,'L');
		/*Heading Of the table end*/
		$pdf->SetFont('Arial','',8);
		$pdf->SetWidths(array(20,50,100));
		$index  = 1;
		for ($i = 0; $i < sizeof($keys); $i++) {

			if(
				(strpos($survey[0][$keys[$i]], ".jpeg") !== false) ||
				(strpos($survey[0][$keys[$i]], ".jpg") !== false) ||
				(strpos($survey[0][$keys[$i]], ".png") !== false)
			)
			{}
			elseif (
				$keys[$i] == "is_surveyed" ||
				$keys[$i] == "is_installed" ||
				$keys[$i] == "fat_status" ||
				$keys[$i] == "handing_taking_status" ||
				$keys[$i] == "id" ||
				$keys[$i] == "supply_order_status" ||
				$keys[$i] == "status" ||
				$keys[$i] == "site_id"
			)
			{}
			else
			{
				if ($keys[$i] == "site_feasibility")
				{
					if ($survey[0][$keys[$i]] == 1)
					{
						$survey[0][$keys[$i]] = "Yes";
					}
					else
					{
						$survey[0][$keys[$i]] = "No";
					}

				}

				if ($keys[$i] == "site_status")
				{
					if ($survey[0][$keys[$i]] == 1)
					{
						$survey[0][$keys[$i]] = "Ready";
					}
					else
					{
						$survey[0][$keys[$i]] = "Not Ready";
					}

				}

				if ($keys[$i] == "roof_top_type")
				{
					if ($survey[0][$keys[$i]] == 0)
					{
						$survey[0][$keys[$i]] = "Bare RCC";
					}
					elseif ($survey[0][$keys[$i]] == 1)
					{
						$survey[0][$keys[$i]] = "RCC with Brick Lining";
					}
					elseif ($survey[0][$keys[$i]] == 2)
					{
						$survey[0][$keys[$i]] = "Mud/ Choka";
					}
					elseif ($survey[0][$keys[$i]] == 3)
					{
						$survey[0][$keys[$i]] = "Shutter roof / Corrugated sheet roof";
					}

				}


				if ($keys[$i] == "mounting_type")
				{
					if ($survey[0][$keys[$i]] == 0)
					{
						$survey[0][$keys[$i]] = "Rooftop Anchored";
					}
					elseif ($survey[0][$keys[$i]] == 1)
					{
						$survey[0][$keys[$i]] = "Rooftop Foundation";
					}
					elseif ($survey[0][$keys[$i]] == 2)
					{
						$survey[0][$keys[$i]] = "Ground Fixed";
					}
					elseif ($survey[0][$keys[$i]] == 3)
					{
						$survey[0][$keys[$i]] = "Ground Pole Mounted";
					}

				}

				if ($keys[$i] == "motor_to_connect")
				{
					if ($survey[0][$keys[$i]] == 0)
					{
						$survey[0][$keys[$i]] = "No";
					}
					elseif ($survey[0][$keys[$i]] == 1)
					{
						$survey[0][$keys[$i]] = "Yes";
					}

				}

				if ($keys[$i] == "existing_wiring_type")
				{
					if ($survey[0][$keys[$i]] == 0)
					{
						$survey[0][$keys[$i]] = "Concealed";
					}
					elseif ($survey[0][$keys[$i]] == 1)
					{
						$survey[0][$keys[$i]] = "Open";
					}

				}
				$key = str_replace('_',' ', $keys[$i]);
				$key = ucwords($key);
				$pdf->Row(array($index,$key,$survey[0][$keys[$i]]));
				$index++;
			}

		}

		$pdf->Output('D','Survey Report.pdf');
	}

	public function print_installation_report($id)
	{
		$serveys_model  = new Site_Installations_model();
		$survey  		= $serveys_model->getSiteInstallations($id);

		$keys = array_keys($survey[0]);
		// dd($keys);
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
		$pdf->Cell(150 ,10,$survey[0]['siteid'].' - Site Installation Data',0,1,'C'); // Package# to be added here
		$pdf->Cell(50 ,2,'',0,1);
		$pdf->Cell(20 ,5,'',0,0);
		$pdf->Cell(150 ,10,$survey[0]['masgid'].', '.$survey[0]['tehsil'].', '.$survey[0]['district'],0,1,'C'); // Package# to be added here

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
		$pdf->Cell(50 ,5,'Parameter',1,0,'L');
		$pdf->Cell(100 ,5,'Value',1,1,'L');
		/*Heading Of the table end*/
		$pdf->SetFont('Arial','',8);
		$pdf->SetWidths(array(20,50,100));
		$index  = 1;
		for ($i = 0; $i < sizeof($keys); $i++) {

			if(
				(strpos($survey[0][$keys[$i]], ".jpeg") !== false) ||
				(strpos($survey[0][$keys[$i]], ".jpg") !== false) ||
				(strpos($survey[0][$keys[$i]], ".png") !== false)
			)
			{}
			elseif (
				$keys[$i] == "is_surveyed" ||
				$keys[$i] == "is_installed" ||
				$keys[$i] == "fat_status" ||
				$keys[$i] == "handing_taking_status" ||
				$keys[$i] == "id" ||
				$keys[$i] == "supply_order_status" ||
				$keys[$i] == "status" ||
				$keys[$i] == "site_id"
			)
			{}
			else
			{
				if ($keys[$i] == "site_feasibility")
				{
					if ($survey[0][$keys[$i]] == 1)
					{
						$survey[0][$keys[$i]] = "Yes";
					}
					else
					{
						$survey[0][$keys[$i]] = "No";
					}

				}

				if ($keys[$i] == "site_status")
				{
					if ($survey[0][$keys[$i]] == 1)
					{
						$survey[0][$keys[$i]] = "Ready";
					}
					else
					{
						$survey[0][$keys[$i]] = "Not Ready";
					}

				}

				if ($keys[$i] == "roof_top_type")
				{
					if ($survey[0][$keys[$i]] == 0)
					{
						$survey[0][$keys[$i]] = "Bare RCC";
					}
					elseif ($survey[0][$keys[$i]] == 1)
					{
						$survey[0][$keys[$i]] = "RCC with Brick Lining";
					}
					elseif ($survey[0][$keys[$i]] == 2)
					{
						$survey[0][$keys[$i]] = "Mud/ Choka";
					}
					elseif ($survey[0][$keys[$i]] == 3)
					{
						$survey[0][$keys[$i]] = "Shutter roof / Corrugated sheet roof";
					}

				}


				if ($keys[$i] == "mounting_type")
				{
					if ($survey[0][$keys[$i]] == 0)
					{
						$survey[0][$keys[$i]] = "Rooftop Anchored";
					}
					elseif ($survey[0][$keys[$i]] == 1)
					{
						$survey[0][$keys[$i]] = "Rooftop Foundation";
					}
					elseif ($survey[0][$keys[$i]] == 2)
					{
						$survey[0][$keys[$i]] = "Ground Fixed";
					}
					elseif ($survey[0][$keys[$i]] == 3)
					{
						$survey[0][$keys[$i]] = "Ground Pole Mounted";
					}

				}

				if ($keys[$i] == "motor_connection")
				{
					if ($survey[0][$keys[$i]] == 0)
					{
						$survey[0][$keys[$i]] = "No";
					}
					elseif ($survey[0][$keys[$i]] == 1)
					{
						$survey[0][$keys[$i]] = "Yes";
					}

				}

				if ($keys[$i] == "existing_wiring_type")
				{
					if ($survey[0][$keys[$i]] == 0)
					{
						$survey[0][$keys[$i]] = "Concealed";
					}
					elseif ($survey[0][$keys[$i]] == 1)
					{
						$survey[0][$keys[$i]] = "Open";
					}

				}
				$key = str_replace('_',' ', $keys[$i]);
				$key = ucwords($key);
				$pdf->Row(array($index,$key,$survey[0][$keys[$i]]));
				$index++;
			}

		}

		$pdf->Output('D','Site Installation Report.pdf');
	}

	public function print_final_testing_report($id)
	{
		$serveys_model  = new Fat_model();
		$survey  		= $serveys_model->getFats($id);

		$keys = array_keys($survey[0]);
		// dd($keys);
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
		$pdf->Cell(150 ,10,$survey[0]['siteid'].' - Site Final Testing Data',0,1,'C'); // Package# to be added here
		$pdf->Cell(50 ,2,'',0,1);
		$pdf->Cell(20 ,5,'',0,0);
		$pdf->Cell(150 ,10,$survey[0]['masgid'].', '.$survey[0]['tehsil'].', '.$survey[0]['district'],0,1,'C'); // Package# to be added here

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
		$pdf->Cell(50 ,5,'Parameter',1,0,'L');
		$pdf->Cell(100 ,5,'Value',1,1,'L');
		/*Heading Of the table end*/
		$pdf->SetFont('Arial','',8);
		$pdf->SetWidths(array(20,50,100));
		$index  = 1;
		for ($i = 0; $i < sizeof($keys); $i++) {

			if(
				(strpos($survey[0][$keys[$i]], ".jpeg") !== false) ||
				(strpos($survey[0][$keys[$i]], ".jpg") !== false) ||
				(strpos($survey[0][$keys[$i]], ".png") !== false)
			)
			{}
			elseif (
				$keys[$i] == "is_surveyed" ||
				$keys[$i] == "is_installed" ||
				$keys[$i] == "fat_status" ||
				$keys[$i] == "handing_taking_status" ||
				$keys[$i] == "id" ||
				$keys[$i] == "supply_order_status" ||
				$keys[$i] == "status" ||
				$keys[$i] == "site_id" ||
				($survey[0][$keys[$i]] == "")
			)
			{}
			else
			{
				if ($keys[$i] == "site_feasibility")
				{
					if ($survey[0][$keys[$i]] == 1)
					{
						$survey[0][$keys[$i]] = "Yes";
					}
					else
					{
						$survey[0][$keys[$i]] = "No";
					}

				}

				if ($keys[$i] == "fat_result")
				{
					if ($survey[0][$keys[$i]] == 1)
					{
						$survey[0][$keys[$i]] = "Passed";
					}
					else
					{
						$survey[0][$keys[$i]] = "Failed";
					}

				}

				if ($keys[$i] == "roof_top_type")
				{
					if ($survey[0][$keys[$i]] == 0)
					{
						$survey[0][$keys[$i]] = "Bare RCC";
					}
					elseif ($survey[0][$keys[$i]] == 1)
					{
						$survey[0][$keys[$i]] = "RCC with Brick Lining";
					}
					elseif ($survey[0][$keys[$i]] == 2)
					{
						$survey[0][$keys[$i]] = "Mud/ Choka";
					}
					elseif ($survey[0][$keys[$i]] == 3)
					{
						$survey[0][$keys[$i]] = "Shutter roof / Corrugated sheet roof";
					}

				}


				if ($keys[$i] == "mounting_type")
				{
					if ($survey[0][$keys[$i]] == 0)
					{
						$survey[0][$keys[$i]] = "Rooftop Anchored";
					}
					elseif ($survey[0][$keys[$i]] == 1)
					{
						$survey[0][$keys[$i]] = "Rooftop Foundation";
					}
					elseif ($survey[0][$keys[$i]] == 2)
					{
						$survey[0][$keys[$i]] = "Ground Fixed";
					}
					elseif ($survey[0][$keys[$i]] == 3)
					{
						$survey[0][$keys[$i]] = "Ground Pole Mounted";
					}

				}

				if ($keys[$i] == "motor_connection")
				{
					if ($survey[0][$keys[$i]] == 0)
					{
						$survey[0][$keys[$i]] = "No";
					}
					elseif ($survey[0][$keys[$i]] == 1)
					{
						$survey[0][$keys[$i]] = "Yes";
					}

				}

				if ($keys[$i] == "existing_wiring_type")
				{
					if ($survey[0][$keys[$i]] == 0)
					{
						$survey[0][$keys[$i]] = "Concealed";
					}
					elseif ($survey[0][$keys[$i]] == 1)
					{
						$survey[0][$keys[$i]] = "Open";
					}

				}
				$key = str_replace('_',' ', $keys[$i]);
				$key = ucwords($key);
				$pdf->Row(array($index,$key,$survey[0][$keys[$i]]));
				$index++;
			}

		}

		$pdf->Output('D','Site Final Testing Report.pdf');
	}

	public function print_completion_report($id)
	{
		$serveys_model  = new Handing_Taking_model();
		$survey  		= $serveys_model->getHandingTakings($id);

		$keys = array_keys($survey[0]);
		// dd($keys);
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
		$pdf->Cell(150 ,10,$survey[0]['siteid'].' - Site Handing/Taking Data',0,1,'C'); // Package# to be added here
		$pdf->Cell(50 ,2,'',0,1);
		$pdf->Cell(20 ,5,'',0,0);
		$pdf->Cell(150 ,10,$survey[0]['masgid'].', '.$survey[0]['tehsil'].', '.$survey[0]['district'],0,1,'C'); // Package# to be added here

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
		$pdf->Cell(50 ,5,'Parameter',1,0,'L');
		$pdf->Cell(100 ,5,'Value',1,1,'L');
		/*Heading Of the table end*/
		$pdf->SetFont('Arial','',8);
		$pdf->SetWidths(array(20,50,100));
		$index  = 1;
		for ($i = 0; $i < sizeof($keys); $i++) {

			if(
				(strpos($survey[0][$keys[$i]], ".jpeg") !== false) ||
				(strpos($survey[0][$keys[$i]], ".jpg") !== false) ||
				(strpos($survey[0][$keys[$i]], ".png") !== false)
			)
			{}
			elseif (
				$keys[$i] == "is_surveyed" ||
				$keys[$i] == "is_installed" ||
				$keys[$i] == "fat_status" ||
				$keys[$i] == "handing_taking_status" ||
				$keys[$i] == "id" ||
				$keys[$i] == "supply_order_status" ||
				$keys[$i] == "status" ||
				$keys[$i] == "site_id" ||
				($survey[0][$keys[$i]] == "")
			)
			{}
			else
			{
				if ($keys[$i] == "site_feasibility")
				{
					if ($survey[0][$keys[$i]] == 1)
					{
						$survey[0][$keys[$i]] = "Yes";
					}
					else
					{
						$survey[0][$keys[$i]] = "No";
					}

				}

				if ($keys[$i] == "fat_result")
				{
					if ($survey[0][$keys[$i]] == 1)
					{
						$survey[0][$keys[$i]] = "Passed";
					}
					else
					{
						$survey[0][$keys[$i]] = "Failed";
					}

				}

				if ($keys[$i] == "roof_top_type")
				{
					if ($survey[0][$keys[$i]] == 0)
					{
						$survey[0][$keys[$i]] = "Bare RCC";
					}
					elseif ($survey[0][$keys[$i]] == 1)
					{
						$survey[0][$keys[$i]] = "RCC with Brick Lining";
					}
					elseif ($survey[0][$keys[$i]] == 2)
					{
						$survey[0][$keys[$i]] = "Mud/ Choka";
					}
					elseif ($survey[0][$keys[$i]] == 3)
					{
						$survey[0][$keys[$i]] = "Shutter roof / Corrugated sheet roof";
					}

				}


				if ($keys[$i] == "mounting_type")
				{
					if ($survey[0][$keys[$i]] == 0)
					{
						$survey[0][$keys[$i]] = "Rooftop Anchored";
					}
					elseif ($survey[0][$keys[$i]] == 1)
					{
						$survey[0][$keys[$i]] = "Rooftop Foundation";
					}
					elseif ($survey[0][$keys[$i]] == 2)
					{
						$survey[0][$keys[$i]] = "Ground Fixed";
					}
					elseif ($survey[0][$keys[$i]] == 3)
					{
						$survey[0][$keys[$i]] = "Ground Pole Mounted";
					}

				}

				if ($keys[$i] == "motor_connection")
				{
					if ($survey[0][$keys[$i]] == 0)
					{
						$survey[0][$keys[$i]] = "No";
					}
					elseif ($survey[0][$keys[$i]] == 1)
					{
						$survey[0][$keys[$i]] = "Yes";
					}

				}

				if ($keys[$i] == "existing_wiring_type")
				{
					if ($survey[0][$keys[$i]] == 0)
					{
						$survey[0][$keys[$i]] = "Concealed";
					}
					elseif ($survey[0][$keys[$i]] == 1)
					{
						$survey[0][$keys[$i]] = "Open";
					}

				}
				$key = str_replace('_',' ', $keys[$i]);
				$key = ucwords($key);
				$pdf->Row(array($index,$key,$survey[0][$keys[$i]]));
				$index++;
			}

		}

		$pdf->Output('D','Site Handing Taking Report.pdf');
	}
}
