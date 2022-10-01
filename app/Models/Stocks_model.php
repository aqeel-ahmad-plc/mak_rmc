<?php
namespace App\Models;

use CodeIgniter\Model;

class Stocks_model extends Model
{
    protected $table            = 'stocks';
    protected $primaryKey       = 'sno';
    protected $allowedFields    = ['name', 'label', 'quantity'];


    public function getStockItems($sno = null)
    {
        if (!$sno)
        {
            return $this->findAll();
        }

        return $this->asArray()
                    ->where(['sno' => $sno])
                    ->first();
    }

    public function getStockItemByName($name){
        
        return $this->asArray()->where(['name' => $name])->first();
    }

    public function updateItem($sno, $data)
    {
        $this->set($data)->where('sno', $sno)->update();
    }

    public function updateItemByName($name, $data)
    {
        $this->set($data)->where('name', $name)->update();
    }

    public function deleteStockItem($sno)
    {
      $this->where('sno', $sno)->delete();
    }

}
