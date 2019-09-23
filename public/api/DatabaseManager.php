<?php


class DatabaseManager
{
    const LOCALHOST="localhost" ;   
    const DATABASE_NAME="shikshop_shikshop" ;   
    const DATABASE_USERNAME="shikshop_shikuse" ;   
    const DATABASE_PASSWORD="bQWK+VGKpUkA" ;   




    function about_store(){
       $connection=mysqli_connect(DatabaseManager::LOCALHOST,DatabaseManager::DATABASE_USERNAME,DatabaseManager::DATABASE_PASSWORD,DatabaseManager::DATABASE_NAME);  
        $connection->set_charset("utf8");
        
        $sqlQuery="SELECT value FROM options WHERE id in (9,4,5)";
        
        $result=$connection->query($sqlQuery);
        
        $postsArray=array();
        if ($result->num_rows>0){
            for ($i=0;$i<$result->num_rows;$i++){
                $postsArray[$i]=$result->fetch_assoc();
            }
        }
        echo json_encode($postsArray,JSON_UNESCAPED_UNICODE);
    }
    
    
    
    
    function Register($name,$family,$mobilenumber,$email,$password){
        $connection=mysqli_connect(DatabaseManager::LOCALHOST,DatabaseManager::DATABASE_USERNAME,DatabaseManager::DATABASE_PASSWORD,DatabaseManager::DATABASE_NAME);  
        $connection->set_charset("utf8");


        $autoincriment= 0;
        $sql = "SELECT id FROM users ORDER BY id DESC LIMIT 1";
        $result = $connection->query($sql);
        

        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { $autoincriment = $row["id"]; }
        }
        $autoincriment = $autoincriment+1;

        $sqlCommand="INSERT INTO users (id,first_name,last_name,phone,email,password) VALUES ('$autoincriment','$name','$family','$mobilenumber','$email','$password')";
        
        if (mysqli_query($connection, $sqlCommand)) {
            return true;
        } else {
            return false;
        }
    }  
    
    
    
    
    function Login($mobilenumber,$password){
        
        $connection=mysqli_connect(DatabaseManager::LOCALHOST,DatabaseManager::DATABASE_USERNAME,DatabaseManager::DATABASE_PASSWORD,DatabaseManager::DATABASE_NAME);  
        $connection->set_charset("utf8");
        
          $connection->set_charset("utf8");
        $sqlQuery="SELECT first_name,last_name,phone,email FROM users Where phone = $mobilenumber AND password = $password LIMIT 1";
        
        $result=$connection->query($sqlQuery);
        
        $postsArray=array();
        if ($result->num_rows>0){
                $postsArray[0]=$result->fetch_assoc();
        }
        echo json_encode($postsArray[0],JSON_UNESCAPED_UNICODE);
        
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
            if (mysqli_query($connection, $sqlCommand)) { 
                echo json_encode(["success"=>"true"],JSON_UNESCAPED_UNICODE);
                
            } else { 
                echo json_encode(["success"=>"false"],JSON_UNESCAPED_UNICODE);
                
            }
        
    }
    
    
    
    function GetAsk(){
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
    
    
    





    
}