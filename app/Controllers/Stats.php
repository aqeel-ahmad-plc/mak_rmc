<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Stats_model;

class Stats extends ResourceController
{
    use ResponseTrait;
    // get all product
    public function index()
    {
        $model = new Stats_model();
        $data = $model->findAll();
        return $this->respond($data);
    }

    // get single product
    public function show($id = null)
    {
        $model = new Stats_model();
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
        $model = new Stats_model();
        $data = [
            'voltage_a' => $this->request->getVar('voltage_a'),
            'voltage_b' => $this->request->getVar('voltage_b'),
            'voltage_c' => $this->request->getVar('voltage_c'),
            'voltage_ab' => $this->request->getVar('voltage_ab'),
            'voltage_bc' => $this->request->getVar('voltage_bc'),
            'voltage_ca' => $this->request->getVar('voltage_ca'),
            'current_a' => $this->request->getVar('current_a'),
            'current_b' => $this->request->getVar('current_b'),
            'current_c' => $this->request->getVar('current_c'),
            'pf_a' => $this->request->getVar('pf_a'),
            'pf_b' => $this->request->getVar('pf_b'),
            'pf_c' => $this->request->getVar('pf_c'),
            'power_a' => $this->request->getVar('power_a'),
            'power_b' => $this->request->getVar('power_b'),
            'power_c' => $this->request->getVar('power_c'),
            'frequency' => $this->request->getVar('frequency'),
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
