<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id';
    protected $sallowedFields = ['npm', 'nama_mhs', 'jurusan_mhs', 'jenis_kelamin', 'created_at'];
}
