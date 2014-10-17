<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title><?php echo "HOMEPAGE";?></title>    
</head>

<body>
<div id="">
    <h1>TIMTHOI PAGE</h1>
</div>
<div id="">
     <?php $linkPagination =base_url()."index/page-"; ?>
    <ul>                                                                                       
        <?php foreach($listDepartment as $key=>$a): ?>
        <li><a href="<?php echo $linkToDepartment[$key];?>"><?php echo $a['name'];?></a></li>     
        <?php endforeach;?> 
    </ul>
</div>   

<div id="">
    <?php
        
        if (isset($listCategory)):                
            $rootPagination = base_url().'index/department/'.$selectedDepartmentName.'-d'.$selectedDepartment; 
            $linkPagination = $rootPagination."\page-"; 
        ?>
    <ul>                                                                                       
        <?php foreach($listCategory as $key=>$a): ?>
        <li><a href="<?php echo $linkToCategory[$key]; ?>">
            <?php echo $a['name'];?></a>
        </li>     
        <?php endforeach;?> 
    </ul>
    <?php endif;?>    
</div>

<div id="">
    <?php if (isset($selectedDepartment) && isset($selectedCategory))
    {         
        $linkPagination =$rootPagination.'/'.$selectedCategoryName.'-d'.$selectedCategory."/page-";
    }
    ?>
    <?php if (isset($listProduct)):?>    
        <?php foreach($listProduct as $p): ?>
            <blockquote>
                <div><?php echo $p['name'];?></div>
                <div><?php echo $p['description'];?></div>
                <div><?php echo $p['price'];?></div>
                <div><?php echo $p['discounted_price'];?></div>
                
                <div>
                     <img src="<?php echo base_url();?>img/<?php echo $p['image']?>" alt="<?php echo $p['image'];?>" style="width:304px;height:228px">                                                                        
                </div>     
                <div>
                    <?php                 
                    $attr = $p['attribute'];        
                    for($i=0;$i<count($p['attribute']);$i++):                            
                        $j=$i;?>
                    <label class=""><?php echo $attr[$i]['attribute_name'];?></label>                                                                       
                    <select name="<?php echo $attr[$i]['attribute_name'];?>">
                        <?php while($attr[$i]['attribute_name']==$attr[$j]['attribute_name'] && $j<count($p['attribute'])):?>
                          <option value="<?php echo $attr[$j]['attribute_value_id'];?>"><?php echo $attr[$j]['attribute_value'];?></option>
                        <?php                                 
                            $j++;
                            endwhile;?>
                    </select>                                                                      
                    <?php $i=--$j; endfor;?>
                </div>                           
            </blockquote>                
        <?php endforeach;?>
                 
        <?php for($i=1;$i<=$totalPage;$i++):?>
            <a href="<?php echo $linkPagination.$i;?>"><?php echo $i;?></a>
            
        <?php endfor;?>
                 
    <?php endif;?>
</div>

 
</body>

</html>


