<?php

namespace App\Models;

use CodeIgniter\Model;

class MovimientoModel extends Model {

    protected $DBGroup          = 'default';
    protected $table            = 'movimientos';
    protected $primaryKey       = 'idmovimientos';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'idtipomovimiento', 'observacion', 'idmiembros', 'idmembresias', 'idusuarios'
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

    public function _get_all_movements(){
        $result = null;
        //$db = \Config\Database::connect();
        $builder = $this->db->table('movimientos');
        $builder->select(
            'idmovimientos, observacion, movimientos.created_at as fecha, paquete, miembros.nombre as Miembro, 
            miembros.num_documento as Identificacion, tipo_movimiento, usuario.nombre as Usuario');
        $builder->join('membresias', 'membresias.idmembresias=movimientos.idmembresias');
        $builder->join('paquetes', 'paquetes.idpaquete=membresias.idpaquete');
        $builder->join('tipomovimiento', 'tipomovimiento.idtipomovimiento=movimientos.idtipomovimiento');
        $builder->join('miembros', 'miembros.idmiembros=movimientos.idmiembros');
        $builder->join('usuario', 'usuario.idusuario=movimientos.idusuarios');
        $query = $builder->get();
        foreach ($query->getResult() as $row) {
            $result[] = $row;
        }
     
        return $result;
    } 

    function _insert_movimiento($data){
        //echo '<pre>'.var_export($data, true).'</pre>';exit;
        $builder = $this->db->table('movimientos');
        $builder->set('idtipomovimiento', $data['idtipomovimiento']);
        $builder->set('observacion', $data['observacion']);
        $builder->set('idmiembros', $data['idmiembros']);
        $builder->set('idmembresias', $data['idmembresias']);
        $builder->set('idusuarios', $data['idusuarios']);

        $builder->insert();
    }
}
