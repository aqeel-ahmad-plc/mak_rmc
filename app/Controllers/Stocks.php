<?php namespace App\Controllers;

use App\Models\Stocks_model;

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


class Stocks extends BaseController
{
    public function add()
    {
        $data = [];
        $model          = new Stocks_model();
        $data['stocks'] = $model->getStockItems();

        if ($this->request->getMethod() == 'post') 
        {
            $rules = [
				'label'             => [
                    'label' => 'Item Label',
                    'rules' => 'required|max_length[255]'
                ],
				'quantity'          => [
                    'label' => 'Item Quantity',
                    'rules' => 'required'
                ],
			];

			if (! $this->validate($rules)) {
				$data['validation'] = $this->validator;
			}else{

				$model = new Stocks_model();
                $item_name = strtolower($this->request->getVar('label'));
                $item_name = str_replace(" ", "_", $item_name);

				$newData = [
                    'name'            => $item_name,
                    'label'           => $this->request->getVar('label'),
                    'quantity'        => $this->request->getVar('quantity'),
                ];

                $model->save($newData);
				$session = session();
				$session->setFlashdata('success', 'Item Added Successfully');
				return redirect()->to(base_url().'/stocks/add');

			}
        }

        echo view('templates/header', $data);
        echo view('templates/sidebar');
        echo view('stocks/add');
        echo view('templates/footer');
    }

    public function update()
    {
        $data   = [];

        if ($this->request->getMethod() == 'post') 
        {
            $model  = new Stocks_model();
            $data   = $model->getStockItems($this->request->getVar('item'));

            $rules = [
				'quantity'          => [
                    'label' => 'Item Quantity',
                    'rules' => 'required'
                ],
			];

			if (! $this->validate($rules)) {
				$data['validation'] = $this->validator;
			}else{

                $model = new Stocks_model();
                
                $newData = ['quantity' => (intval($data["quantity"]) + $this->request->getVar('quantity'))];
                $model->updateItem($data["sno"], $newData);

				$session = session();
				$session->setFlashdata('success', 'Item Updated Successfully');
				return redirect()->to(base_url().'/stocks/add');

			}
        }

    }
    public function print()
	{
		$model          = new Stocks_model();
        $stocks         = $model->getStockItems();

		$pdf = new PDF();
		$pdf->AddPage();
		/*output the result*/
        $pdf->SetFont('Arial','B',20);
        $pdf->Cell(50 ,5,'',0,1);
        $pdf->Cell(110 ,5,'Stock Items',0,1,'R');
        $pdf->Cell(50 ,5,'',0,1);
        $pdf->SetFont('Arial','B',10);
        /*Heading Of the table*/
        $pdf->Cell(20 ,5,'Sr. No',1,0,'L');
        $pdf->Cell(100 ,5,'Name',1,0,'L');
        $pdf->Cell(40 ,5,'Quantity',1,1,'L');
        /*Heading Of the table end*/
        $pdf->SetFont('Arial','',8);
        $index  = 0;
        for ($i = 0; $i < sizeof($stocks); $i++) {

            $pdf->Cell(20, 5, $index, 1, 0, 'L');
            $pdf->Cell(100, 5, $stocks[$i]['label'], 1, 0, 'L');
            $pdf->Cell(40, 5, $stocks[$i]['quantity'], 1, 1, 'L');
            $index++;
        }
        if ($index == 0) 
        {
            $pdf->Cell(160, 5, "No Items Sites found", 1, 1, 'C');
        }

        $pdf->Output('D','Stock_Items.pdf');
	}

    public function show()
    {
        $data = [];

        $model          = new Stocks_model();
        $data['stocks'] = $model->getStockItems();

        echo view('templates/header', $data);
        echo view('templates/sidebar');
        echo view('stocks/show');
        echo view('templates/footer');
    }

    public function get_stocks()
    {
        $data   = [];

        $model  = new Stocks_model();
        $data   = $model->getStockItems();

        return json_encode($data);
    }
}