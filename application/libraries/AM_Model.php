<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class AM_Model extends CI_Model {
    var $table_name;
    var $primary_column_name;

    public function __construct(){
        parent::__construct();
    }

    function init($table_name, $primary_column_name){
        $this->table_name          = $table_name;
        $this->primary_column_name = $primary_column_name;
    }

    function insert($data, $flag = 0){
        $this->db->insert($this->table_name,$data);
        $insert_id = $this->db->insert_id();

        if($insert_id){
            if($flag == 0){
                return $insert_id;
            }
            else{
                return $this->select_id($insert_id);
            }
        }

        return false;
    }

    function delete($id){
        $this->db->where($this->primary_column_name, $id);
        $this->db->delete($this->table_name);

        return true;
    }

    function delete_where($conditions = array()){
        if(!$conditions){
            return false;
        }

        foreach($conditions as $column => $value){
            $this->db->where($column, $value);
        }

        $this->db->delete($this->table_name);

        $this->save_log('delete ' . $this->table_name , json_encode($conditions) );

        return true;
    }

    function update($id, $data){
        $this->db->where($this->primary_column_name, $id);
        $this->db->update($this->table_name, $data);
        return true;
    }

    function update_where($conditions = array(), $data){
        if(!$conditions){
            return false;
        }

        foreach($conditions as $column => $value){
            $this->db->where($column, $value);
        }

        $this->db->update($this->table_name, $data);
        return true;
    }

    function select_id($id){
        $this->db->where($this->primary_column_name, $id);
        $query = $this->db->get($this->table_name);

        if($query->num_rows() == 1)
            return $query->row();
        else
            return false;
    }

    function select($args = array()){
        if(isset($args['column'])){
            $this->db->select($args['column']);
        }
        if(isset($args['order'])){
            if(is_string($args['order']) && strtoupper($args['order']) == 'RAND'){
                $this->db->order_by('rand()');
            } else {
                foreach($args['order'] as $column => $value){
                    if(is_numeric($column)) {
                        $this->db->order_by($value);
                    } else {
                        $this->db->order_by($column, (trim(strtoupper($value)) == 'DESC') ? 'DESC' : 'ASC');
                    }
                }
            }
        }
        if(isset($args['condition'])){
            foreach($args['condition'] as $column => $value){
                $this->db->where($column, $value);
            }
        }
        if(isset($args['limit']) && isset($args['offset'])){
            $this->db->limit($args['limit'], $args['offset']);
        } elseif(isset($args['limit'])) {
            $this->db->limit($args['limit']);
        }
        $query = $this->db->get($this->table_name);

        return $query->result();
    }

    function select_single($args){
        if(isset($args['column'])){
            $this->db->select($args['column']);
        }
        if(isset($args['order'])){
            if(strtoupper($args['order']) == 'RAND'){
                $this->db->order_by('rand()');
            } else {
                foreach($args['order'] as $column => $value){
                    if(is_numeric($column)) {
                        $this->db->order_by($value);
                    } else {
                        $this->db->order_by($column, (trim(strtoupper($value)) == 'DESC') ? 'DESC' : 'ASC');
                    }
                }
            }
        }
        if(isset($args['condition'])){
            foreach($args['condition'] as $column => $value){
                $this->db->where($column, $value);
            }
        }

        $query = $this->db->get($this->table_name);

        if($query->num_rows() == 1)
            return $query->row();
        else
            return false;
    }

    function count_where($conditions = array()){
        $this->db->select('COUNT('.$this->primary_column_name.') as total_rows');

        foreach($conditions as $column => $value){
            $this->db->where($column, $value);
        }

        $query = $this->db->get($this->table_name);

        $result = $query->row();

        return (float)$result['total_rows'];
    }

    function sum_where($column_name, $conditions = array()){
        $this->db->select('SUM('.$column_name.') as total');

        foreach($conditions as $column => $value){
            $this->db->where($column, $value);
        }

        $query = $this->db->get($this->table_name);

        $result = $query->row();

        return (float)$result['total'];
    }
}
?>