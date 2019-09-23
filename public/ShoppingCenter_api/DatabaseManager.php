<?php


class DatabaseManager
{
    const LOCALHOST="localhost" ;   
    const DATABASE_NAME="shikshop_shikshop" ;   
    const DATABASE_USERNAME="shikshop_shikuse" ;   
    const DATABASE_PASSWORD="bQWK+VGKpUkA" ;   

    
    
    
    
       function getcategory(){
       $connection=mysqli_connect(DatabaseManager::LOCALHOST,DatabaseManager::DATABASE_USERNAME,DatabaseManager::DATABASE_PASSWORD,DatabaseManager::DATABASE_NAME);  

        $connection->set_charset("utf8");
        $sqlQuery="SELECT id,title,description,icon FROM categories WHERE parent is NULL";
        
        $result=$connection->query($sqlQuery);
        
        $postsArray=array();
        if ($result->num_rows>0){
            for ($i=0;$i<$result->num_rows;$i++){
                $postsArray[$i]=$result->fetch_assoc();
            }
        }
        echo json_encode($postsArray,JSON_UNESCAPED_UNICODE);
    }



       function hasparent($category_id){
       $connection=mysqli_connect(DatabaseManager::LOCALHOST,DatabaseManager::DATABASE_USERNAME,DatabaseManager::DATABASE_PASSWORD,DatabaseManager::DATABASE_NAME);  

        $connection->set_charset("utf8");
        $sqlQuery="SELECT id,title,description,icon,banner FROM categories WHERE parent = $category_id";
        
        $result=$connection->query($sqlQuery);
        
        $postsArray=array();
        if ($result->num_rows>0){
        echo json_encode(["success"=>true],JSON_UNESCAPED_UNICODE);
        }else{
        echo json_encode(["success"=>false],JSON_UNESCAPED_UNICODE);
        }
    }
    

       function get_category_parent($category_id){
       $connection=mysqli_connect(DatabaseManager::LOCALHOST,DatabaseManager::DATABASE_USERNAME,DatabaseManager::DATABASE_PASSWORD,DatabaseManager::DATABASE_NAME);  

        $connection->set_charset("utf8");
        $sqlQuery="SELECT id,title,description,icon,banner FROM categories WHERE parent = $category_id";
        
        $result=$connection->query($sqlQuery);
        
        $postsArray=array();
        if ($result->num_rows>0){
            for ($i=0;$i<$result->num_rows;$i++){
                $postsArray[$i]=$result->fetch_assoc();
            }
        }
        echo json_encode($postsArray,JSON_UNESCAPED_UNICODE);
    }

    
    

    
    
    
    function AddUser($fullname,$phone,$password,$email){
              $connection=mysqli_connect(DatabaseManager::LOCALHOST,DatabaseManager::DATABASE_USERNAME,DatabaseManager::DATABASE_PASSWORD,DatabaseManager::DATABASE_NAME);  
        $connection->set_charset("utf8");


        $autoincriment= 0;
        $sql = "SELECT id FROM users ORDER BY id DESC LIMIT 1";
        $result = $connection->query($sql);
        

        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { $autoincriment = $row["id"]; }
        }
        $autoincriment = $autoincriment+1;

        $sqlCommand="INSERT INTO users (last_name,phone,password,id,first_name,email) VALUES ('$fullname','$phone','$password','$autoincriment','','$email')";
        
        if (mysqli_query($connection, $sqlCommand)) {
            return true;
        } else {
            return false;
        }
    }  
    





    
     function login($phone,$password) {

        $connection=mysqli_connect(DatabaseManager::LOCALHOST,DatabaseManager::DATABASE_USERNAME,DatabaseManager::DATABASE_PASSWORD,DatabaseManager::DATABASE_NAME);  
        $connection->set_charset("utf8");
        
        //error no connect to database
        if ($conn->connect_error) { return false; $conn->close(); }

        $sql = "SELECT phone,password FROM users WHERE phone  = $phone";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {

        //if mobile number and password valid
        if ($row["password"]==$password) { return true; $conn->close(); } 

        //if pat is un valid
        else { return false; $conn->close(); } 
        }

        //if mobile number un valid
        } else { return false; $conn->close(); }

     }
    
    
    
    
    
    
    function getproduct_topview($count){
        
        $connection=mysqli_connect(DatabaseManager::LOCALHOST,DatabaseManager::DATABASE_USERNAME,DatabaseManager::DATABASE_PASSWORD,DatabaseManager::DATABASE_NAME);  
        $connection->set_charset("utf8");
        
          $connection->set_charset("utf8");
        $sqlQuery="SELECT id,photo,name,price,offer FROM products Where products.status =1 order by views_count DESC limit $count";
        
        $result=$connection->query($sqlQuery);
        
        $postsArray=array();
        if ($result->num_rows>0){
            for ($i=0;$i<$result->num_rows;$i++){
                $postsArray[$i]=$result->fetch_assoc();
            }
        }
        echo json_encode($postsArray,JSON_UNESCAPED_UNICODE);
        
    }
    
    
    
    
    
        function getproduct_special($count){
        
        $connection=mysqli_connect(DatabaseManager::LOCALHOST,DatabaseManager::DATABASE_USERNAME,DatabaseManager::DATABASE_PASSWORD,DatabaseManager::DATABASE_NAME);  
        $connection->set_charset("utf8");
        
          $connection->set_charset("utf8");
        $sqlQuery="SELECT id,photo,name,price,offer FROM products where special =1 And status =1 order by views_count DESC limit $count";
        
        $result=$connection->query($sqlQuery);
        
        $postsArray=array();
        if ($result->num_rows>0){
            for ($i=0;$i<$result->num_rows;$i++){
                $postsArray[$i]=$result->fetch_assoc();
            }
        }
        echo json_encode($postsArray,JSON_UNESCAPED_UNICODE);
        
    }
    
    
    
    
    
            function getproduct_lastproduct($count){
        
        $connection=mysqli_connect(DatabaseManager::LOCALHOST,DatabaseManager::DATABASE_USERNAME,DatabaseManager::DATABASE_PASSWORD,DatabaseManager::DATABASE_NAME);  
        $connection->set_charset("utf8");
        
          $connection->set_charset("utf8");
        $sqlQuery="SELECT id,photo,name,price,offer FROM products  Where status =1 order by created_at DESC limit $count";
        
        $result=$connection->query($sqlQuery);
        
        $postsArray=array();
        if ($result->num_rows>0){
            for ($i=0;$i<$result->num_rows;$i++){
                $postsArray[$i]=$result->fetch_assoc();
            }
        }
        echo json_encode($postsArray,JSON_UNESCAPED_UNICODE);
        
    }
    
    
    
    
    
        function getproduct_in_category($category_id,$orderby,$pricefilter,$resbrand,$ressize,$resdesign,$rescolor){
        
        $connection=mysqli_connect(DatabaseManager::LOCALHOST,DatabaseManager::DATABASE_USERNAME,DatabaseManager::DATABASE_PASSWORD,DatabaseManager::DATABASE_NAME);  
        $connection->set_charset("utf8");
        
        $sqlQuery="SELECT DISTINCT products.id,products.photo,products.name,products.price,products.offer FROM category_product INNER join products on category_product.product_id = products.id INNER JOIN color_product on color_product.product_id = products.id WHERE category_product.category_id = $category_id AND products.status =1 $resbrand $ressize $resdesign $rescolor $pricefilter order by $orderby";
        $result=$connection->query($sqlQuery);
        
        $postsArray=array();
        if ($result->num_rows>0){
            for ($i=0;$i<$result->num_rows;$i++){
                $postsArray[$i]=$result->fetch_assoc();
            }
        }
        echo json_encode($postsArray,JSON_UNESCAPED_UNICODE);
        
    }
    
    
    
    
    
    function getproduct($product_id){
        
        $connection=mysqli_connect(DatabaseManager::LOCALHOST,DatabaseManager::DATABASE_USERNAME,DatabaseManager::DATABASE_PASSWORD,DatabaseManager::DATABASE_NAME);  
        $connection->set_charset("utf8");
        
        $sqlQuery="SELECT products.id,products.name,products.description,products.price,products.offer,products.link,products.photo,brands.title AS brand,sizes.size As size,designs.title As design FROM products LEFT JOIN brands on products.brand_id = brands.id LEFT JOIN sizes on products.size_id = sizes.id LEFT JOIN designs on products.design_id = designs.id WHERE products.id = $product_id LIMIT 1";
        
        $result=$connection->query($sqlQuery);
        
        $postsArray;
        if ($result->num_rows>0){
                $postsArray=$result->fetch_assoc();
        }
        echo json_encode($postsArray,JSON_UNESCAPED_UNICODE);
        
    }
    
    
    
    
    function search($string){
        
        $connection=mysqli_connect(DatabaseManager::LOCALHOST,DatabaseManager::DATABASE_USERNAME,DatabaseManager::DATABASE_PASSWORD,DatabaseManager::DATABASE_NAME);  
        $connection->set_charset("utf8");
        $render = 0;
        $postsArray=array();


        $sqlQuery="SELECT products.id,products.name,'product' AS type FROM products WHERE products.status =1 AND products.name LIKE '%$string%'";
        $result=$connection->query($sqlQuery);
        if ($result->num_rows>0){
            for ($i=0;$i<$result->num_rows;$i++){
                $postsArray[$i]=$result->fetch_assoc();
            }
            $render = $result->num_rows;
        }
        
        
         $sqlQuery="SELECT categories.id,categories.title AS 'name','categorie' AS type FROM categories WHERE categories.title LIKE '%$string%'";
        $result=$connection->query($sqlQuery);
        if ($result->num_rows>0){
            $render2 = $result->num_rows + $render ;
            for ($i=$render;$i<$render2 ;$i++){
                $postsArray[$i]=$result->fetch_assoc();
            }
        }
        echo json_encode($postsArray,JSON_UNESCAPED_UNICODE);
    }
    
    
    
    
    
    function gettable($product_id){
                
        $connection=mysqli_connect(DatabaseManager::LOCALHOST,DatabaseManager::DATABASE_USERNAME,DatabaseManager::DATABASE_PASSWORD,DatabaseManager::DATABASE_NAME);  
        $connection->set_charset("utf8");
        
        $sqlQuery="SELECT specifications.key,specifications.value FROM specifications WHERE product_id = $product_id ORDER BY id";
        
        $result=$connection->query($sqlQuery);

        $postsArray=array();
        if ($result->num_rows>0){
            for ($i=0;$i<$result->num_rows;$i++){
                $postsArray[$i]=$result->fetch_assoc();
            }
        }
        echo json_encode($postsArray,JSON_UNESCAPED_UNICODE);
        
    }
    
    
    
    
    
    function getproduct_in_related($category_id){
        
        $connection=mysqli_connect(DatabaseManager::LOCALHOST,DatabaseManager::DATABASE_USERNAME,DatabaseManager::DATABASE_PASSWORD,DatabaseManager::DATABASE_NAME);  
        $connection->set_charset("utf8");
        
        $sqlQuery="SELECT products.id, products.photo, products.name, products.price ,products.offer FROM category_product inner join categories on category_product.category_id = categories.id INNER join products on category_product.product_id = products.id WHERE categories.id = $category_id AND products.status =1 Limit 20";
        
        $result=$connection->query($sqlQuery);
        
        $postsArray=array();
        if ($result->num_rows>0){
            for ($i=0;$i<$result->num_rows;$i++){
                $postsArray[$i]=$result->fetch_assoc();
            }
        }
        echo json_encode($postsArray,JSON_UNESCAPED_UNICODE);
        
    }
    
    
    
       
    function getcategory_id_by_product_id($product_id){
        
        $connection=mysqli_connect(DatabaseManager::LOCALHOST,DatabaseManager::DATABASE_USERNAME,DatabaseManager::DATABASE_PASSWORD,DatabaseManager::DATABASE_NAME);  
        $connection->set_charset("utf8");
        
        $sqlQuery="SELECT category_id FROM category_product WHERE product_id = $product_id";
        
        $result=$connection->query($sqlQuery);
        
        $postsArray;
        if ($result->num_rows>0){
                $postsArray=$result->fetch_assoc();
        }
        echo json_encode($postsArray,JSON_UNESCAPED_UNICODE);
        
    }
    
    
        function getnews(){
       $connection=mysqli_connect(DatabaseManager::LOCALHOST,DatabaseManager::DATABASE_USERNAME,DatabaseManager::DATABASE_PASSWORD,DatabaseManager::DATABASE_NAME);  

        $connection->set_charset("utf8");
        $sqlQuery="SELECT * FROM articles";
        
        $result=$connection->query($sqlQuery);
        
        $postsArray=array();
        if ($result->num_rows>0){
            for ($i=0;$i<$result->num_rows;$i++){
                $postsArray[$i]=$result->fetch_assoc();
            }
        }
        echo json_encode($postsArray,JSON_UNESCAPED_UNICODE);
    }
    
    
     
     
       function getbrand(){
       $connection=mysqli_connect(DatabaseManager::LOCALHOST,DatabaseManager::DATABASE_USERNAME,DatabaseManager::DATABASE_PASSWORD,DatabaseManager::DATABASE_NAME);  

        $connection->set_charset("utf8");
        $sqlQuery="SELECT id,title FROM brands";
        
        $result=$connection->query($sqlQuery);
        
        $postsArray=array();
        if ($result->num_rows>0){
            for ($i=0;$i<$result->num_rows;$i++){
                $postsArray[$i]=$result->fetch_assoc();
            }
        }
        echo json_encode($postsArray,JSON_UNESCAPED_UNICODE);
    }
    
    
    
    
       function getsize(){
       $connection=mysqli_connect(DatabaseManager::LOCALHOST,DatabaseManager::DATABASE_USERNAME,DatabaseManager::DATABASE_PASSWORD,DatabaseManager::DATABASE_NAME);  

        $connection->set_charset("utf8");
        $sqlQuery="SELECT id,size FROM sizes";
        
        $result=$connection->query($sqlQuery);
        
        $postsArray=array();
        if ($result->num_rows>0){
            for ($i=0;$i<$result->num_rows;$i++){
                $postsArray[$i]=$result->fetch_assoc();
            }
        }
        echo json_encode($postsArray,JSON_UNESCAPED_UNICODE);
    }
    
    
    
    
    
         function getdesign(){
       $connection=mysqli_connect(DatabaseManager::LOCALHOST,DatabaseManager::DATABASE_USERNAME,DatabaseManager::DATABASE_PASSWORD,DatabaseManager::DATABASE_NAME);  

        $connection->set_charset("utf8");
        $sqlQuery="SELECT id,title FROM designs";
        
        $result=$connection->query($sqlQuery);
        
        $postsArray=array();
        if ($result->num_rows>0){
            for ($i=0;$i<$result->num_rows;$i++){
                $postsArray[$i]=$result->fetch_assoc();
            }
        }
        echo json_encode($postsArray,JSON_UNESCAPED_UNICODE);
    }
    
    
    
    
    
      function getcolor(){
       $connection=mysqli_connect(DatabaseManager::LOCALHOST,DatabaseManager::DATABASE_USERNAME,DatabaseManager::DATABASE_PASSWORD,DatabaseManager::DATABASE_NAME);  

        $connection->set_charset("utf8");
        $sqlQuery="SELECT id,name,value FROM colors";
        
        $result=$connection->query($sqlQuery);
        
        $postsArray=array();
        if ($result->num_rows>0){
            for ($i=0;$i<$result->num_rows;$i++){
                $postsArray[$i]=$result->fetch_assoc();
            }
        }
        echo json_encode($postsArray,JSON_UNESCAPED_UNICODE);
    }
    
    
    
    
    
       function getproductgallery($product_id){
       $connection=mysqli_connect(DatabaseManager::LOCALHOST,DatabaseManager::DATABASE_USERNAME,DatabaseManager::DATABASE_PASSWORD,DatabaseManager::DATABASE_NAME);  

        $connection->set_charset("utf8");
        $sqlQuery="SELECT gallery FROM products Where id = $product_id";
    
        $result=$connection->query($sqlQuery);
        $posts = json_decode($result->fetch_assoc()[gallery]);
        
        $len = count($posts);
        $ii = $len-1;

        for($i=0;$i<$len;$i++){
            if(!$ii == 0){  $posts[$i] = "{\"photo\":\"" . $posts[$i]  . "\"},";  $ii--; }
            else { $posts[$i] = "{\"photo\":\"" . $posts[$i]  . "\"}"; }
            }
            echo "[";
        for($i=0;$i<count($posts);$i++){
            echo $posts[$i];
        }
          echo "]";
    }

    
    
    
    
    function AddFavorites($mobilenumber,$product_id) {

        $connection=mysqli_connect(DatabaseManager::LOCALHOST,DatabaseManager::DATABASE_USERNAME,DatabaseManager::DATABASE_PASSWORD,DatabaseManager::DATABASE_NAME);  
        $connection->set_charset("utf8");
        $exist= false;
        $userid= 0;
        
        $sql = "SELECT id FROM users WHERE phone = '$mobilenumber' LIMIT 1";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { $userid = $row["id"]; }
        }
        
        $sql2 = "SELECT user_id,product_id FROM favorites WHERE user_id = '$userid'";
        $result2 = $connection->query($sql2);
        if ($result2->num_rows > 0) {
            while($row2 = $result2->fetch_assoc()) { 
                if ($row2["product_id"]==$product_id) { $exist = false; } else { $exist = true; } 
            }
        } else { $exist = true; }

       if($exist == true){
           $sqlCommand="INSERT INTO favorites (user_id,product_id) VALUES ($userid,$product_id)";
            if (mysqli_query($connection, $sqlCommand)) { return true; } else { return false; }
        } else { return false; }
        
        $connection->close();
     }
     
     
     
     
     
    function GetFavorites($mobilenumber) {
        $connection=mysqli_connect(DatabaseManager::LOCALHOST,DatabaseManager::DATABASE_USERNAME,DatabaseManager::DATABASE_PASSWORD,DatabaseManager::DATABASE_NAME);  
        $connection->set_charset("utf8");
        $userid= 0;
        
        $sql = "SELECT id FROM users WHERE phone = '$mobilenumber' LIMIT 1";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { $userid = $row["id"]; }
        }
        
        $sqlQuery="SELECT products.id,photo,name,price,offer FROM products Inner join favorites on favorites.product_id = products.id where status =1 order by views_count DESC";
        $result=$connection->query($sqlQuery);
        $postsArray=array();
        if ($result->num_rows>0){
            for ($i=0;$i<$result->num_rows;$i++){
                $postsArray[$i]=$result->fetch_assoc();
            }
        }
        echo json_encode($postsArray,JSON_UNESCAPED_UNICODE);
    }
    
    

 function AddVisit($mobilenumber,$product_id) {
     
       $connection=mysqli_connect(DatabaseManager::LOCALHOST,DatabaseManager::DATABASE_USERNAME,DatabaseManager::DATABASE_PASSWORD,DatabaseManager::DATABASE_NAME);  
        $connection->set_charset("utf8");
        $exist= false;
        $userid= 0;
        
        $sql = "SELECT id FROM users WHERE phone = '$mobilenumber' LIMIT 1";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { $userid = $row["id"]; }
        }
        
        $sqlCommand="INSERT INTO last_visits (user_id,product_id) VALUES ($userid,$product_id)";
        mysqli_query($connection, $sqlCommand);
 }
 
 
  function getVisit($mobilenumber) {
     
       $connection=mysqli_connect(DatabaseManager::LOCALHOST,DatabaseManager::DATABASE_USERNAME,DatabaseManager::DATABASE_PASSWORD,DatabaseManager::DATABASE_NAME);  
        $connection->set_charset("utf8");
        $exist= false;
        $userid= 0;
        
        $sql = "SELECT id FROM users WHERE phone = '$mobilenumber' LIMIT 1";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { $userid = $row["id"]; }
        }
        
        
        $sqlQuery="SELECT products.id,photo,name,price,offer FROM products Inner join last_visits on last_visits.product_id = products.id where products.status =1 AND last_visits.user_id = $userid order by views_count DESC LIMIT 15";
        $result=$connection->query($sqlQuery);
        $postsArray=array();
        if ($result->num_rows>0){
            for ($i=0;$i<$result->num_rows;$i++){
                $postsArray[$i]=$result->fetch_assoc();
            }
        }
        echo json_encode($postsArray,JSON_UNESCAPED_UNICODE);
 }
 
 
 
 
         function getAsk(){
       $connection=mysqli_connect(DatabaseManager::LOCALHOST,DatabaseManager::DATABASE_USERNAME,DatabaseManager::DATABASE_PASSWORD,DatabaseManager::DATABASE_NAME);  

        $connection->set_charset("utf8");
        $sqlQuery="SELECT question,answer FROM question_and_answers";
        
        $result=$connection->query($sqlQuery);
        
        $postsArray=array();
        if ($result->num_rows>0){
            for ($i=0;$i<$result->num_rows;$i++){
                $postsArray[$i]=$result->fetch_assoc();
            }
        }
        echo json_encode($postsArray,JSON_UNESCAPED_UNICODE);
    }



  function AddTicket($mobilenumber,$content) {

        $connection=mysqli_connect(DatabaseManager::LOCALHOST,DatabaseManager::DATABASE_USERNAME,DatabaseManager::DATABASE_PASSWORD,DatabaseManager::DATABASE_NAME);  
        $connection->set_charset("utf8");
        $userid= 0;
        
        $sql = "SELECT id FROM users WHERE phone = '$mobilenumber' LIMIT 1";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { $userid = $row["id"]; }
        }
        

        $sqlCommand="INSERT INTO tickets (user_id,message) VALUES ('$userid','$content')";
            if (mysqli_query($connection, $sqlCommand)) { return true; } else { return false; }
        
        
     }


         function GetProductColor($product_id){
       $connection=mysqli_connect(DatabaseManager::LOCALHOST,DatabaseManager::DATABASE_USERNAME,DatabaseManager::DATABASE_PASSWORD,DatabaseManager::DATABASE_NAME);  

        $connection->set_charset("utf8");
        $sqlQuery="SELECT colors.value FROM color_product INNER JOIN colors on colors.id = color_product.color_id WHERE color_product.product_id = $product_id";
        
        $result=$connection->query($sqlQuery);
        
        $postsArray=array();
        if ($result->num_rows>0){
            for ($i=0;$i<$result->num_rows;$i++){
                $postsArray[$i]=$result->fetch_assoc();
            }
        }
        echo json_encode($postsArray,JSON_UNESCAPED_UNICODE);
    }




}