<?php
class Mdepartment extends CI_Model{

    public function __construct(){
        parent::__construct();
        $this->load->database();                
    }
        
    public function listDepartment()
    {
        $query = $this->db->get("department");
        return $query->result_array();
    }    
    
    public function GetDepartmentDetails($department_id)
    {
        // Build SQL query
        // $query = $this->db->get("department");
        $sql = 'SELECT * FROM department WHERE ?' ;        
        $query = $this->db->query($sql,array($department_id));        
        // Execute the query and return the results
        return $query->result_array();
    }   
}

