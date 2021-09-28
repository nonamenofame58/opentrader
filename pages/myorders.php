<?php 

session_start();

if(isset($_SESSION['username'])){
    
}else{
    die();
}

include_once 'inc/db.php';

function getOrders(){
$conn = dbConnection();

    $sql_getMyOrders = 'SELECT * FROM orders WHERE username = "'.$_SESSION['username'].'" GROUP BY orderid';
    $result_getMyOrders = $conn -> query($sql_getMyOrders);
    $fetch_getMyOrders = $result_getMyOrders -> fetch_all(MYSQLI_ASSOC);
    foreach($fetch_getMyOrders as $orderid){
        echo '<p order-id = "'.$orderid['orderid'].'" class = "my-orders-p">'.$orderid['orderid'].'<span style = "color:rgba(255,255,0,1);right:0;margin-right:50px;position:absolute">'.$orderid['status'].'</span></p>';
        echo '<div id = "'.$orderid['orderid'].'" style = "display:none;" class = "orders">';
        echo '<h2 style = "text-align:center">'.$orderid['orderid'].'</h2>';
        echo '<hr>';
        $sql_getOrders = 'SELECT * FROM orders WHERE orderid = "'.$orderid['orderid'].'"';
        $result_getOrders = $conn -> query($sql_getOrders);
        $fetch_getOrders = $result_getOrders -> fetch_all(MYSQLI_ASSOC);
        
        
        $totalQuantity =0;
        $totalPrice = 0;
        
        foreach($fetch_getOrders as $order){
            $sql_getOrderPhoto = 'SELECT * FROM productPhotos WHERE productCode = "'.$order['product'].'"';
            $result_getOrderPhoto = $conn->query($sql_getOrderPhoto);
            $fetch_getOrderPhoto = $result_getOrderPhoto -> fetch_all(MYSQLI_ASSOC);
            $photo = $fetch_getOrderPhoto[0]['productImg'];
            
            $totalQuantity = $totalQuantity + $order['quantity'];
            $totalPrice = $totalPrice + $order['totalPrice'];
            
            
            
            
            echo '<div class = "order">';
            echo  '<div class = "order-headers"><p style = "width:400px">İsim</p><p>Adet</p><p>Beden</p><p>Toplam Fiyat</p><p>Adet Fiyat</p><p>Durum</p></div><hr>';
            echo '<p class = "order-p" style = width:400px>'.$order['label'].'</p>';
            echo '<p class = "order-p">'.$order['quantity'].'</p>';
            echo '<p class = "order-p">'.$order['size'].'</p>';
            echo '<p class = "order-p">'.$order['totalPrice'].' TL</p>';
            echo '<p class = "order-p">'.$order['singlePrice'].' TL</p>';
            echo '<p class = "order-p">'.$order['status'].'</p>';
            echo '<img class = "order-img" style = "width:70px;height:70px;border-radius:15%;display:inline-block" src = "../photos/'.$order['product'].'/'.$photo.'">';
            echo '</div>';
        }
        echo '<p style = "margin-left:20px;font-weight:bold;font-size:20px;">Toplam : '.$totalQuantity.' adet ürün '.$totalPrice.' TL</p>';
        echo '<button class = "cancel-order-button" style = "">İPTAL </button>';
        echo '</div>';
    }
    echo '</div>';
}



?>



<html>
    <body>
        <div class ="main-page">
            <div class = "my-orders">
                <h2 style = "text-align:center">Siparişlerim</h2>
                <hr>
                <?php getOrders();?>
            </div>
        </div>
    </body>
</html>


