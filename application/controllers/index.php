<?php
class Index extends CI_Controller{   
    public $mSelectedCategory = 0;
    public $mSelectedCategoryName = '';
    public $mSelectedDepartmentName = '';
    public $mSelectedDepartment = 0;      
    public $mPage = 1;
    public $mrTotalPages=0;        
    
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');        
        $this->load->library("link");  
        $this->load->library("handle_string");  
        $this->load->Model("mdepartment");
        $this->load->Model("mcategory");        
        $this->load->Model("mproduct");                               
    }        
    public function department(){         
         //var_dump($this->uri->uri_string());
         //index/department/May-tinh-p1
         
         // gọi hàm xử lý chuỗi lây departmentId                                
         //echo $this->uri->segment(3);
         //May-tinh-p1\
         //department-name-dxxxx/category-name-dxxx
        
        if ($this->uri->segment(3) !== FALSE)        
        {            
            $this->mSelectedDepartment = $this->handle_string->getId($this->uri->segment(3));
            $this->mSelectedDepartmentName = $this->handle_string->getName($this->uri->segment(3));
        }
        if ($this->uri->segment(4) !== FALSE)        
        {            
            $this->mSelectedCategory = $this->handle_string->getId($this->uri->segment(4));
            $this->mSelectedCategoryName = $this->handle_string->getName($this->uri->segment(4));            
        }                                                                                            
         $this->index();
    }            
    
    public function index(){
       
        $departments=$this->mdepartment->listDepartment();       
       
        //tạo link cho department 
        foreach($departments as $a)
        {
            $department_name = $this->handle_string->toEnglish($a['name']);
            $department_name = $this->handle_string->replaceSpace($department_name);
            //May-tinh-d1                
            $data['linkToDepartment'][]=$this->link->ToDepartment($department_name,$a['department_id']);
        }
        //xử lý page -- get Page_id --- có dùng routes cấu hình trong config
        //if(isset($_GET['page'])) $this->mPage=$_GET['page'];      
        if ($this->uri->segment(2) !== FALSE ||
            $this->uri->segment(4) !== FALSE ||
            $this->uri->segment(5) !== FALSE){
            //thỏa dk hop với pattern page-xxxx
            if($this->handle_string->getPage($this->uri->segment(2))!=0)
            //cái này wan trọng cho phân trang nghen em
                $this->mPage=$this->handle_string->getPage($this->uri->segment(2));
                
             if($this->handle_string->getPage($this->uri->segment(4))!=0)
            //cái này wan trọng cho phân trang nghen em
                $this->mPage=$this->handle_string->getPage($this->uri->segment(4));
            if($this->handle_string->getPage($this->uri->segment(5))!=0)
            //cái này wan trọng cho phân trang nghen em
                $this->mPage=$this->handle_string->getPage($this->uri->segment(5));
        }                   
        
        $data['listDepartment']=$departments;     
        //tao product list khi tren trang front_page 1 
        //front_page1 la` trang moi chi hien department -- chua click vao category
        if($this->mSelectedDepartment ==0)                           
            $mProducts = $this->mproduct->GetProductsFrontPage($this->mPage, $this->mrTotalPages);
        //truy xuất thông tin cho category khi click vào department    
        if($this->mSelectedDepartment >0){
            $data['selectedDepartment'] = $this->mSelectedDepartment;                        
            $data['selectedDepartmentName']=$this->mSelectedDepartmentName;
            $data['listCategory'] = $this->mcategory->GetCategoriesInDepartment($this->mSelectedDepartment);
            //tạo link cho category            
            foreach($data['listCategory'] as $a)
            {
                 $category_name = $this->handle_string->toEnglish($a['name']);
                 $category_name = $this->handle_string->replaceSpace($category_name);
                 //duong dan
                //May-tinh-d1                
                $data['linkToCategory'][]=$this->link->ToCategory($this->mSelectedDepartmentName,$this->mSelectedDepartment,$category_name,$a['category_id']);
            }                                        
            //tao product list khi tren trang frontpage2 
            //front_page2 la` trang hien select department --ds category trg department chua click vao category
            if($this->mSelectedCategory ==0)
                $mProducts = $this->mproduct->GetProductsOnDepartment($this->mSelectedDepartment,$this->mPage, $this->mrTotalPages);
             
             //tao product list khi chọn department--> category`    
            if($this->mSelectedCategory >0){              
                $data['selectedCategory'] = $this->mSelectedCategory;                        
                $data['selectedCategoryName']=$this->mSelectedCategoryName;
                $mProducts = $this->mproduct->GetProductsOnCategory($this->mSelectedCategory,$this->mPage, $this->mrTotalPages);
            }                        
        }                                         

        $data['totalPage']=$this->mrTotalPages;                     
        $data['page']=$this->mPage;
        //có listproduct --> tìm product attribue cho nó        
        for($i=0;$i<count($mProducts);$i++){
            $p['attribute']=$this->mproduct->GetProductAttributes($mProducts[$i]['product_id']);
            $mProducts[$i]['attribute']=$p['attribute'];                                                                
        }                      
                      
        $data['listProduct']=$mProducts;        
        $this->load->view("index_view",$data);                  
    }     
} 

        
/*        
        if(!isset($_GET['department_id']) && !isset($_GET['category_id']))
            $mProduct = $this->mproduct->GetProductsFrontPage($this->mPage, $this->mrTotalPages);
        if(isset($_GET['department_id'])){
            $this->mSelectedDepartment = $_GET['department_id'];
            $data['selectedDepartment'] = $this->mSelectedDepartment; 
                     
            $data['listCategory'] = $this->mcategory->GetCategoriesInDepartment($this->mSelectedDepartment);
            //tạo link cho category
            foreach($data['listCategory'] as $a)
                $data['linkToProduct'][]=$this->link->ToCategory($this->mSelectedDepartment,$a['category_id']);
                                                     
            //tao product list khi tren trang frontpage2 
            //front_page2 la` trang hien select department --ds category trg department chua click vao category
            if(!isset($_GET['category_id']))
                $mProduct = $this->mproduct->GetProductsOnDepartment($this->mSelectedDepartment,$this->mPage, $this->mrTotalPages);
                                                      
        }
        //truy xuất thông tin product khi chọn category`
        if(isset($_GET['category_id']) && isset($_GET['department_id'])){
            $this->mSelectedCategory = $_GET['category_id'];
            $data['selectedCategory'] = $this->mSelectedCategory; 
                               
            $mProduct = $this->mproduct->GetProductsInCategory($this->mSelectedCategory);
            foreach($mProduct as $a)
                $data['linkToProductDetail'][]=$this->link->ToProduct($a['product_id']);                                                     
            //tao product list khi tren trang frontpage3
            //front_page3 la` trang hien select department --ds category trg department 
            //-- select Category -- ds product trong category
            $mProduct = $this->mproduct->GetProductsOnCategory($this->mSelectedCategory,$this->mPage, $this->mrTotalPages);                                                                            
        }
*/        