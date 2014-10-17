<?php
class Link{    
    public function __construct(){
        //$this->load->helper('url');
        //sử dụng trong controller view model 
        //muốn sử dụng trong library phải làm như sau
        $CI =& get_instance();
        $CI->load->helper('url');      
    }
    
    public function ToDepartment($department_name,$department_id)
    {
        $link = base_url().'index/department/'.$department_name.'-d'.$department_id;
        return $link;
    }
    
    public function ToCategory($department_name,$department_id,$category_name,$category_id)
    {
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
        if ($page > 1)
            $link = base_url()."index/page-" . $page;
        return $link;
    }      
}