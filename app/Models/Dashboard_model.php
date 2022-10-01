<?php
namespace App\Models;

use CodeIgniter\Model;

class Dashboard_model extends Model
{
    protected $table            = 'dashboard';
    protected $primaryKey       = 'sno';
    protected $allowedFields    = [];


    public function getDashboardData()
    {
        return $this->findAll();
    }

}
