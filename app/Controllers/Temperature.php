<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Temperature_model;

class Temperature extends ResourceController
{
    use ResponseTrait;
    // get all product
    public function index()
    {
        $model = new Temperature_model();
        $data = $model->findAll();
        return $this->respond($data);
    }

    // get single product
    public function show($id = null)
    {
        $model = new Temperature_model();
        $data = $model->getLatestRecord();
        if($data){
            return json_encode($data);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }
    }

    // create a product
    public function create()
    {

        $model = new Temperature_model();
        $data = [
            'amb_temperature' => $this->request->getVar('amb_temperature'),
            'motor_temperature' => $this->request->getVar('motor_temperature'),

            'sno' => 1
        ];
        $model->replace($data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Saved'
            ]
        ];
        return $this->respondCreated($response);
    }

    // update product
    // public function update($id = null)
    // {
    //     $model = new ProductModel();
    //     $input = $this->request->getRawInput();
    //     $data = [
    //         'product_name' => $input['product_name'],
    //         'product_price' => $input['product_price']
    //     ];
    //     $model->update($id, $data);
    //     $response = [
    //         'status'   => 200,
    //         'error'    => null,
    //         'messages' => [
    //             'success' => 'Data Updated'
    //         ]
    //     ];
    //     return $this->respond($response);
    // }

    // delete product
    // public function delete($id = null)
    // {
    //     $model = new ProductModel();
    //     $data = $model->find($id);
    //     if($data){
    //         $model->delete($id);
    //         $response = [
    //             'status'   => 200,
    //             'error'    => null,
    //             'messages' => [
    //                 'success' => 'Data Deleted'
    //             ]
    //         ];
    //         return $this->respondDeleted($response);
    //     }else{
    //         return $this->failNotFound('No Data Found with id '.$id);
    //     }
    //
    // }

}
