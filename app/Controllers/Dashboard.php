<?php namespace App\Controllers;

use App\Models\Dashboard_model;
use App\Models\Serveys_model;

class Dashboard extends BaseController
{
	public function index()
	{
		$data = [];
		$dashboard_model = new Dashboard_model();
		$result = $dashboard_model->getDashboardData();

		for($index = 0 ; $index < sizeof($result); $index++)
		{
			$dashboard[$result[$index]['name']] = $result[$index]['value'];
		}

		$data['dashboard'] = $dashboard;
        echo view('templates/header', $data);
        echo view('templates/sidebar');
		echo view('dashboard');
		echo view('templates/footer');
	}

	public function get_sites_info()
	{
		$data = [];
		$dashboard_model = new Dashboard_model();
		$result = $dashboard_model->getDashboardData();

		for($index = 0 ; $index < sizeof($result); $index++)
		{
			$dashboard[$result[$index]['name']] = $result[$index]['value'];
		}
		return json_encode($dashboard);
	}

	public function get_sites()
	{
		$serveys_model = new Serveys_model();
		return json_encode($serveys_model->getServeys());
	}

	//--------------------------------------------------------------------

}
