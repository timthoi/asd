<?php
class Mproduct extends CI_Model{    
   
    public function __construct(){
        parent::__construct();
        $this->load->database();        
    }
    
    public function listProduct()
    {
        // Build SQL query
        $sql = 'SELECT * FROM product';        
        $query=$this->db->query($sql);
        // Execute the query and return the results
        return $query->result_array();            
    }
    
        public function HowManyPages($sql, $countSqlParams)
    {        
    // Verify if we have the query results in cache
     
        $query = $this->db->query($sql,array($countSqlParams));
        $items_count = $query->num_rows();
/*        $a['how_many_pages'] = ceil($items_count / PRODUCTS_PER_PAGE);                                    
        $this->session->set_userdata($a);
*/        
        $how_many_pages = ceil($items_count / PRODUCTS_PER_PAGE);             
            
        return $how_many_pages;
    }
    public function GetProductsInCategory($category_id)
    {
         $sql = 'SELECT * 
                 FROM product INNER JOIN category_product 
                    ON product.product_id = category_product.product_id
                 WHERE category_product.category_id=?';        
        $query=$this->db->query($sql,array($category_id));
        // Execute the query and return the results
        return $query->result_array();        
    }
    
    // Retrieves list of products that belong to a category pagination
    public function GetProductsOnCategory($category_id, $pageNo, &$rHowManyPages)
    {
        // Query that returns the number of products in the category
        $sql ='SELECT * 
               FROM product INNER JOIN category_product 
                  ON product.product_id = category_product.product_id
               WHERE category_product.category_id=?';
        // Build the parameters array      
        // Calculate the number of pages required to display the products
        $rHowManyPages = $this->HowManyPages($sql, $category_id);
        // Calculate the start item
        $start_item = ($pageNo - 1) * PRODUCTS_PER_PAGE;
        // Retrieve the list of products
        $sql .= ' LIMIT ?, ?';
        // Build the parameters array
        $params = array ($category_id,$start_item,PRODUCTS_PER_PAGE);
        $query=$this->db->query($sql,$params);
        // Execute the query and return the results
        return $query->result_array();
    }
    
    public function GetProductsFrontPage($pageNo, &$rHowManyPages)
    {
        // Query that returns the number of products for the front catalog page
        $sql = 'SELECT * FROM product WHERE (display=2 OR display=3)';        
        // Execute the query and return the results        
        // Calculate the number of pages required to display the products
        $rHowManyPages = $this->HowManyPages($sql, NULL);
        // Calculate the start item
        $start_item = ($pageNo - 1) * PRODUCTS_PER_PAGE;
        // Retrieve the list of products
        $sql = 'SELECT * 
                FROM product
                WHERE (display=2 OR display=3)                                   
                LIMIT ?, ?';
        // Build the parameters array
        $params = array ($start_item,PRODUCTS_PER_PAGE);
        $query=$this->db->query($sql,$params);
        // Execute the query and return the results
        return $query->result_array();
    }
    
    public function GetProductsOnDepartment($department_id, $pageNo, &$rHowManyPages)
    {
         $sql = 'SELECT p.product_id,p.name,p.description,price,discounted_price,image,display 
                FROM product p
                INNER JOIN category_product cp 
                    ON p.product_id=cp.product_id
                INNER JOIN category c
                    ON cp.category_id=c.category_id
                WHERE ((p.display=1 OR p.display=3) AND c.department_id=?)';        
        // Execute the query and return the results        
        // Calculate the number of pages required to display the products
        $rHowManyPages = $this->HowManyPages($sql, $department_id);
        // Calculate the start item
        $start_item = ($pageNo - 1) * PRODUCTS_PER_PAGE;
        // Retrieve the list of products
        $sql .=  ' LIMIT ?, ?';
        // Build the parameters array
        $params = array ($department_id,$start_item,PRODUCTS_PER_PAGE);
        $query=$this->db->query($sql,$params);
        // Execute the query and return the results
        return $query->result_array();
    }
    
    public function GetProductAttributes($product_id)
    {
        // Build SQL query
        $sql = 'SELECT a.name AS attribute_name,
                       av.attribute_value_id, av.value AS attribute_value
                FROM attribute_value av
                INNER JOIN attribute a
                    ON av.attribute_id = a.attribute_id
                WHERE av.attribute_value_id IN 
                    (SELECT attribute_value_id 
                     FROM product_attribute
                     WHERE product_id = ?) ORDER BY a.name;';
        // Build the parameters array
        $query=$this->db->query($sql,$product_id);
        // Execute the query and return the results
        return $query->result_array();
    }   
}