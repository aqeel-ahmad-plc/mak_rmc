<?php
namespace App\Validation;
use App\Models\Stocks_model;

class StocksRules
{

  public function item_quantity_exists(string $str, string $fields, array $data){
    
    $stock_model = new Stocks_model();
    $item = $stock_model->getStockItemByName($fields);
    
    if(!$item)
      return false;
    
      return ($item["quantity"] >= $data[$fields]) ? true : false;
  }
}