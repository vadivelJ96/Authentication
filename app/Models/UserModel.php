<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id','user_name', 'role', 'status','email','password','profilePicName',
                                  'address1','address2','address3','country_id','state_id','city_id'];

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
    protected $beforeInsert   = ['setDefaultUserStatusAndRole'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected function setDefaultUserStatusAndRole(array $data)
    {
        if (!isset($data['data']['status'])) {
            $data['data']['status'] = 'active';
        }

        if (!isset($data['data']['role'])){
            $data['data']['role'] = 'user';
        }

        return $data;
    }

    public function getUsersWithLocation()
    {
        return $this->select('users.*, country.country_name, state.state_name, city.city_name')
                    ->join('country', 'country.id = users.country_id','left')
                    ->join('state', 'state.id = users.state_id','left')
                    ->join('city', 'city.id = users.city_id','left')
                    ->findAll();
    }

}
