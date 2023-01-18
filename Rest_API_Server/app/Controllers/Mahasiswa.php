<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Mahasiswa extends ResourceController
{
    use ResponseTrait;
    // all users
    public function index()
    {
        $model = new MahasiswaModel();
        $data['mahasiswa'] = $model->orderBy('id', 'DESC')->findAll();
        return $this->respond($data);
    }
    // create
    public function create()
    {
        $model = new MahasiswaModel();
        $data = [
            'npm' => $this->request->getVar('npm'),
            'nama_mhs'  => $this->request->getVar('nama_mhs'),
            'jurusan_mhs'  => $this->request->getVar('jurusan_mhs'),
            'jenis_kelamin'  => $this->request->getVar('jenis_kelamin'),
            'created_at'  => $this->request->getVar('created_at'),
        ];
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Mahasiswa Berhasil ditemukan.'
            ]
        ];
        return $this->respondCreated($response);
    }
    // single user
    public function show($id = null)
    {
        $model = new MahasiswaModel();
        $data = $model->where('id', $id)->first();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Mahasiswa tidak ditemukan.');
        }
    }
    // update
    public function update($id = null)
    {
        $model = new MahasiswaModel();
        $id = $this->request->getVar('id');
        $data = [
            'npm_mhs' => $this->request->getVar('npm_mhs'),
            'nama_mhs'  => $this->request->getVar('nama_mhs'),
            'jurusan_mhs'  => $this->request->getVar('jurusan_mhs'),
            'jenis_kelamin'  => $this->request->getVar('jenis_kelamin'),
            'created_at'  => $this->request->getVar('created_at'),
        ];
        $model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Mahasiswa berhasil diubah.'
            ]
        ];
        return $this->respond($response);
    }
    // delete
    public function delete($id = null)
    {
        $model = new MahasiswaModel();
        $data = $model->where('id', $id)->delete($id);
        if ($data) {
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Mahasiswa berhasil dihapus.'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Data Mahasiswa tidak ditemukan.');
        }
    }
}
