<?php
class Link{    
    private $CI;
    public function __construct(){
        //$this->load->helper('url');
        //sử dụng trong controller view model 
        //muốn sử dụng trong library phải làm như sau
        $this->CI = &get_instance();
        $this->CI ->load->helper('url');
        $this->CI ->load->library('handle_string');      
    }
    
    public function ToDepartment($department_name,$department_id)
    {
        $department_name = $this->CI->handle_string->cleanText($department_name);
        $link = base_url().'index/department/'.$department_name.'-d'.$department_id;
        return $link;
    }
    
    public function ToCategory($department_name,$department_id,$category_name,$category_id)
    {
        $department_name = $this->CI->handle_string->cleanText($department_name);
        $category_name = $this->CI->handle_string->cleanText($category_name);
        $link = base_url().'index/department/'. $department_name.'-d'.$department_id.'/'.$category_name.'-d'.$category_id;
        return $link;
    }
    
     public function ToProduct($product_id)
    {
        $link = base_url().'index?product_id='.$product_id;
        return $link;
    }
    
    public function ToIndex($page = 1)
    {       
        
            $link = base_url()."page-" . $page;
        return $link;
    }      
}