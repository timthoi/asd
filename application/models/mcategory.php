<?php

//$this không dùng chung với static
class Mcategory extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();        
    }        
    
    // Retrieves list of categories that belong to a department
    public function GetCategoriesInDepartment($department_id)
    {
        $query = $this->db->get_where('category', array('department_id' => $department_id));                    
        return $query->result_array();
    }
    // Truy xuất tất cả sản phẩm có trong category
    public function GetCategoryDetails($category_id)
    {
        // Build SQL query
        $sql = 'SELECT * FROM category WHERE category_id=?';        
        $query=$this->db->query($sql,array($category_id));
        // Execute the query and return the results
        return $query->result_array();            
    }
    
 
                    
}