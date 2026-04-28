<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table            = 'peminjaman';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kode_pinjam', 'anggota_id', 'buku_id', 'jumlah', 'tgl_pinjam', 
        'tgl_kembali', 'tgl_dikembalikan', 'status', 'petugas_id', 'catatan'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getPeminjamanWithDetail($id = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('peminjaman.*, anggota.nama as nama_anggota, buku.judul as judul_buku, users.nama as nama_petugas');
        $builder->join('anggota', 'anggota.id = peminjaman.anggota_id');
        $builder->join('buku', 'buku.id = peminjaman.buku_id');
        $builder->join('users', 'users.id = peminjaman.petugas_id');
        
        if ($id === null) {
            return $builder->orderBy('peminjaman.created_at', 'DESC')->get()->getResultArray();
        }

        return $builder->where('peminjaman.id', $id)->get()->getRowArray();
    }

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
