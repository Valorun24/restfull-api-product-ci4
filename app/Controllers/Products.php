<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use CodeIgniter\API\ResponseTrait;

class Products extends BaseController
{

    use ResponseTrait;

    // get all products
    public function index()
    {
        $model = new ProductModel();
        $data = $model->findAll();
        return $this->respond($data, 200);
    }

    // get single products
    public function show($id = null)
    {
        $model = new ProductModel();
        $data = $model->getWhere(['product_id' => $id])->getResult();
        if($data) {
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound('No data found with ID : '. $id);
        };
    }

    // create a products
    public function create()
    {
        $model = new ProductModel();
        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'product_price' => $this->request->getPost('product_price')
        ];
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Saved'
            ]
        ];
         
        return $this->respondCreated($response, 201);
    }

    // update products
    public function update($id = null)
    {
        $model = new ProductModel();
        $json = $this->request->getJSON();
        if($json) {
            $data = [
                'product_name' => $json->product_name,
                'product_price' => $json->product_price
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'product_name' => $input['product_name'],
                'product_price' => $input['product_price']
            ];
        };
        // insert into DB
        $model->update($id, $data);
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data has been updated'
            ]
        ];
        return $this->respond($response);
    }

    // delete products
    public function delete($id = null)
    {
        $model = new ProductModel();
        $data = $model->find($id);
        if($data) {
            $model->delete($id);
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => 'Data has been deleted'
                ]
            ];

            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('No data found with ID' . $id);
        };
    }
}