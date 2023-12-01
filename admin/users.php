<?php

include '../inc/db.php';

$conn = dbConnection();

function getUsers(){
    $conn = dbConnection();
    $sql_getUsers = "SELECT * FROM User";
    $result_getUsers = $conn->query($sql_getUsers);
    $fetch_getUsers = $result_getUsers->fetch_all(MYSQLI_ASSOC);
    foreach($fetch_getUsers as $user){
        echo '<p>'.$user['Username'].'</p>';
    }
}



include "panel.php";






?>

<style>

.users h2{text-align:center;}
.users {background:rgba(239,239,239,1);}
.users p{margin:10px;}

</style>
<html>
    <div class = "main-page">
        <div class = "users">
            <h2>Kullanıcılar</h2>
            <?php getUsers();?>
            
            
        </div>
    </div>    
    
    
    
</html>