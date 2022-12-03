<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model{

    protected $DBGroup          = 'default';
    protected $table            = 'usuarios';
    protected $primaryKey       = 'idusuarios';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nombre', 'telefono', 'email', 'direccion', 'password', 'cedula', 'idroles','logged', 'user'
    ];

    // Dates
    protected $useTimestamps = true;
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

    function _getUsuario($usuario){
        $result = NULL;
        $builder = $this->db->table('usuarios');
        $builder->select('*')->where('user', $usuario['user'])->where('password', md5($usuario['password']));
        $builder->join('roles', 'roles.idroles=usuarios.idroles');
        $query = $builder->get();
        if ($query->getResult() != null) {
            foreach ($query->getResult() as $row) {
                $result = $row;
            }
        }
        //echo $this->db->getLastQuery();
        return $result;
    }

    function _getUsuarioInstructor($result = NULL){
        $result = NULL;
        $builder = $this->db->table('usuarios');
        $builder->select('idusuarios, nombre, cedula, usuarios.idroles as rol');
        $builder->where('usuarios.idroles', 2);
        $builder->join('roles', 'roles.idroles=usuarios.idroles');
        $query = $builder->get();
        if ($query->getResult() != null) {
            foreach ($query->getResult() as $row) {
                $result[] = $row;
            }
        }
        //echo $this->db->getLastQuery();
        return $result;
    }

    function _getUsuarioCedula($cedula){
        $result = NULL;
        $builder = $this->db->table('usuarios');
        $builder->select('idusuarios');
        $builder->where('cedula', $cedula);
        $builder->where('usuarios.idroles', 2);
        $builder->join('roles', 'roles.idroles=usuarios.idroles');
        $query = $builder->get();
        if ($query->getResult() != null) {
            foreach ($query->getResult() as $row) {
                $result = $row->idusuarios;
            }
        }
        //echo $this->db->getLastQuery();
        return $result;
    }

    function _getNameUserCedula($cedula){
        $result = NULL;
        $builder = $this->db->table('usuarios');
        $builder->select('nombre');
        $builder->where('cedula', $cedula);
        //$builder->where('usuarios.idroles', 2);
        $builder->join('roles', 'roles.idroles=usuarios.idroles');
        $query = $builder->get();
        if ($query->getResult() != null) {
            foreach ($query->getResult() as $row) {
                $result = $row->nombre;
            }
        }
        //echo $this->db->getLastQuery();
        return $result;
    }
}