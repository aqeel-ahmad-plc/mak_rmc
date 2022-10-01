<?php
namespace App\Validation;
use App\Models\Sites_model;

class SitesRules
{

	public function unique_site_id(string $str, string $fields, array $data)
	{

		$sites_model = new Sites_model();
		$site = $sites_model->getSites($data[$fields]);

		if(!$site)
		{
			return true; 
		}
		else
		{
			return false;
		}
	}
}