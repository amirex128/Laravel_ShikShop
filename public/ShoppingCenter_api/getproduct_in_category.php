<?php

$json= file_get_contents('php://input');
$request = json_decode($json);



$firstprice = $request[1]->first_price;
$second_price = $request[1]->second_price;

if($firstprice == null || $second_price == null){
    $pricefilter = "And products.price BETWEEN 0 AND 999999999";
}else{
   $pricefilter = "And products.price BETWEEN " .$firstprice. " AND " .$second_price ;
}

$orderby = $request[5]->orderby;
$category = $request[5]->category_id;



$brand = get_object_vars($request[0]);
$len = count($brand);
$i = $len-1;
$resbrand = "(";
foreach ($brand as $result) {
    if(!$i == 0){ $resbrand .= $result.","; $i--; }
    else { $resbrand .= $result; }
}
$resbrand .= ")" ;
if($resbrand == "()") { $resbrand = ""; } 
else $resbrand = "And products.brand_id IN " . $resbrand;


$size = get_object_vars($request[2]);
$len = count($size);
$i = $len-1;
$ressize = "(";
foreach ($size as $result) {
    if(!$i == 0){ $ressize .= $result.","; $i--; }
    else { $ressize .= $result; }
}
$ressize .= ")" ;
if($ressize == "()") { $ressize = ""; } 
else $ressize = "AND products.size_id IN " . $ressize;



$design = get_object_vars($request[3]);
$len = count($design);
$i = $len-1;
$resdesign = "(";
foreach ($design as $result) {
    if(!$i == 0){ $resdesign .= $result.","; $i--; }
    else { $resdesign .= $result; }
}
$resdesign .= ")" ;
if($resdesign == "()") { $resdesign = ""; } 
else $resdesign = "And products.design_id IN " . $resdesign;



$color = get_object_vars($request[4]);
$len = count($color);
$i = $len-1;
$rescolor = "(";
foreach ($color as $result) {
    if(!$i == 0){ $rescolor .= $result.","; $i--; }
    else { $rescolor .= $result; }
}
$rescolor .= ")" ;
if($rescolor == "()") { $rescolor = ""; } 
else $rescolor = "And color_product.color_id IN " . $rescolor;




include 'DatabaseManager.php';
$databasemanager = new DatabaseManager();
$databasemanager->getproduct_in_category($category,$orderby,$pricefilter,$resbrand,$ressize,$resdesign,$rescolor);





