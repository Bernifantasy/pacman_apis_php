<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'email', 'password', 'edad', 'telefono', 'pais'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

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

    public function getUserByMailOrUsername($emailOrUsername)
    {
        return $this->where('email', $emailOrUsername)
            ->orWhere('name', $emailOrUsername)
            ->first();
    }
    public function getUserById($id)
    {
        return $this->where('id', $id)->first();
    }

    public function getTopPlayers()
    {
        return $this->db->table('users')
            ->select('users.id, users.name, SUM(partides.puntuacio) as total_points, COUNT(partides.id) as games_played, SUM(CASE WHEN partides.resultat = 1 THEN 1 ELSE 0 END) as victories, COUNT(partides.id) - SUM(CASE WHEN partides.resultat = 1 THEN 1 ELSE 0 END) as defeats')
            ->join('partides', 'partides.usuari_id = users.id', 'left')
            ->groupBy('users.id')
            ->orderBy('total_points', 'DESC')
            ->limit(10)
            ->get()
            ->getResultArray();
    }
}
