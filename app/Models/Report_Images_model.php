<?php namespace App\Models;

use CodeIgniter\Model;

class Report_Images_model extends Model{
  protected $table          = 'report_images';
  protected $primaryKey     = 'id';
  protected $allowedFields  = [
                                'logo',
                                'first_title_image',
                                'second_title_image',
                                'third_title_image'
                              ];

      public function getReportImages()
      {
          return $this->findAll();
      }
}
