<?php 
class handle_string{
    //chuyển chữ có dấu thành không dấu
    public function toEnglish ($str){        
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
    		'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D'=>'Đ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
    
       foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
       }
       return $str;
    }
    
    //cat cac khaong trang, --, . ? ,
    public function cleanText($string)
    {
        $string=$this->toEnglish($string);
        $not_acceptable_characters_regex = '/[^-a-zA-Z0-9_ ]/';
        $string = preg_replace($not_acceptable_characters_regex, '', $string);
        // Remove all leading and trailing spaces
        $string = trim($string);
        // Change all dashes, underscores and spaces to dashes
        $string = preg_replace('/[-_ ]+/', '-', $string);
        // Return the modified string
        return strtolower($string);    
    }
   //chuoi http://localhost/anhvu/department-name-dxxxx mình sẽ lấy xxxxxxxx
   public function getId($str){
     //tra về 1 là tìm thấy
    //trả về 0 là ko thay
    //false là sai me no ro
    //tra ve` department_id -d
        $pattern = '/-d(\d*)$/';
        if (preg_match($pattern, $str, $matches)==1) return $matches[1];
        else 
            return 0;        	
   }
   public function getName($str){
        $chars = preg_split('/-d(\d*)$/', $str);
        return $chars[0];      	
   }    
       
    public function getPage($str){     
        $pattern = '/page-(\d*)$/';
        if (preg_match($pattern, $str, $matches)==1) return $matches[1];
        else 
            return 0;        	
   }        
}