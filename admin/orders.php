<?php

include '../inc/db.php';

$conn = dbConnection();





if($_POST['com'] == 'updateOrder'){
    $status = $_POST['status'];
    $orderId = $_POST['orderId'];
    
    $sql_updateOrder = 'UPDATE orders SET status = "'.$status.'"  WHERE orderid = "'.$orderId.'"';
    $result_updateOrder = $conn -> query($sql_updateOrder);
    if($result_updateOrder){
        echo 'Güncellendi !';
        die();
    }else{
        echo 'Sorun Var';
        die();
    }
}

include 'panel.php';






function getOrders(){
    $conn = dbConnection();
    $sql_getOrders = 'SELECT * FROM orders GROUP BY username';
    $result_getOrders = $conn->query($sql_getOrders);
    $fetch_getOrders = $result_getOrders -> fetch_all(MYSQLI_ASSOC);

    foreach($fetch_getOrders as $order){
        echo '<button username = '.$order['username'].' class = "all-orders-user">'.$order['username'].'</button>';
        $sql_getOrderid = 'SELECT * FROM orders WHERE username = "'.$order['username'].'" GROUP BY orderid' ;
        $result_getOrderid = $conn -> query($sql_getOrderid);
        $fetch_getOrderid = $result_getOrderid -> fetch_all(MYSQLI_ASSOC);
        echo '<div style = "display:none" id = "'.$order['username'].'" class = "user-orders">';
        echo '<h2 style = "text-align:center">'.$order['username'].' Siparişler</h2>';
        echo '<hr>';
        foreach($fetch_getOrderid as $orderid){
            echo '<button order-id = "'.$orderid['orderid'].'" username = "'.$order['username'].'" class = "user-orders-button">'.$orderid['orderid'].'<span id = "'.$orderid['orderid'].'-order-status" style = "position:absolute;right:50px;">'.$orderid['status'].'</span></button>';
            $sql_getAllOrdersInOrderid = 'SELECT * FROM orders WHERE orderid = "'.$orderid['orderid'].'"';
            $result_getAllOrdersInOrderid = $conn->query($sql_getAllOrdersInOrderid);
            $fetch_getAllOrdersInOrderid = $result_getAllOrdersInOrderid -> fetch_all(MYSQLI_ASSOC);
            
            echo '<div style = "display:none" id = "'.$orderid['orderid'].'" class = "order-div">';
            echo '<h2 style = "text-align:center">Sipariş : '.$orderid['orderid'].'</h2><hr>';
            echo '<div class ="order-div-headers"><p style = "margin-left:30px">Ürün Kodu</p><p style = "margin-left:125px">İsim</p><p style = "margin-left:95px">Adet</p><p style = "margin-left:20px">Beden</p><p style = "margin-left:10px">Toplam Fiyat</p><p>Adet Fiyat</p><p>Desi</p><p style = "margin-left:40px">Barkod</p></div>';
            $totalQuantity = 0;
            $totalPrice = 0;
            $orderIndex = 0;
            foreach($fetch_getAllOrdersInOrderid as $order){
                $totalQuantity = $totalQuantity + $order['quantity'];
                $totalPrice = $totalPrice + $order['totalPrice'];
                $sql_getPhotoOrder = 'SELECT * FROM productPhotos WHERE productCode = "'.$order['product'].'"';
                $result_getPhotoOrder = $conn -> query($sql_getPhotoOrder);
                $fetch_getPhotoOrder = $result_getPhotoOrder -> fetch_all(MYSQLI_ASSOC);
                $productPhotos = $fetch_getPhotoOrder;
                
                $sql_getProduct = 'SELECT * FROM product WHERE code = "'.$order['product'].'"';
                $result_getProduct = $conn->query($sql_getProduct);
                $fetch_getProduct = $result_getProduct -> fetch_all(MYSQLI_ASSOC);
                $product = $fetch_getProduct[0];
                echo '
                
                <div index = "'.$orderIndex.'" order-id = "'.$orderid['orderid'].'" code = "'.$order['product'].'" class = "order">
                <p style = "width:150px">'.$order['product'].'</p>
                <p style = "width:200px">'.$order['label'].'</p>
                <p style = "width:50px">'.$order['quantity'].'</p>
                <p style = "width:50px">'.$order['size'].'</p>
                <p style = "width:50px;margin-left:20px">'.$order['totalPrice'].'</p>
                <p style = "width:50px;margin-left:30px">'.$order['singlePrice'].'</p>
                <p style = "width:50px">'.$product['desi'].'</p>
                <p style = "width:100px">'.$product['barcode'].'</p>
                <img style = "width:40px;height:40px;padding:10px;border-radius:20%;" src = "../photos/'.$order['product'].'/'.$productPhotos[0]['productImg'].'">
                <button>Kaldır</button>
                </div>
                
                <div style = "display:none" id = "'.$orderid['orderid'].$order['product'].$orderIndex.'-details" class = "order-details">
                <h2 style = "text-align:center">Detaylar</h2>';
            
                $sql_getProductSpecs = 'SELECT * FROM productSpecs WHERE productCode = "'.$product['code'].'"';
                $result_getProductSpecs = $conn -> query($sql_getProductSpecs);
                $fetch_getProductSpecs = $result_getProductSpecs -> fetch_all(MYSQLI_ASSOC);
                foreach($fetch_getProductSpecs as $spec){
                    echo '<p>'.$spec['specid'].'</p>';
                    
                }
                
                $sql_getProductVariants = 'SELECT * FROM productVariants WHERE productCode = "'.$product['code'].'"';
                $result_getProductVariants = $conn -> query($sql_getProductVariants);
                $fetch_getProductVariants = $result_getProductVariants -> fetch_all(MYSQLI_ASSOC);
                foreach($fetch_getProductVariants as $variant){
                    echo '<p>'.$variant['variantName'].' : '.$variant['variantValue'].'</p>';
                }
                
                echo '</div>';
                
                $orderIndex = $orderIndex + 1;
                
            }
            echo '<p style = "font-weight:bold;padding-left:10px">Durum : <select id = "'.$order['orderid'].'-select-input" style = "border-radius:5px;padding:5px;width:200px"><option value = "Beklemede">Beklemede</option><option value = "Onaylandı">Onaylandı</option><option value = "Kargoda">Kargoda</option><option value = "Tamamlandı">Tamamlandı</option><option value = "İptal">İptal</option></select></p>';
            echo '<hr>';
            echo '<p style = "font-size:25px;margin-left:20px;font-weight:bold">Toplam : '.$totalQuantity.' adet ürün '.$totalPrice.' TL </p>';
            echo '<button order-id = "'.$order['orderid'].'" class = "update-order">Güncelle</button>';
            echo '</div>';
        }
        echo '</div>';
    }
}


?>

<style>
.order-details{background:rgba(0,200,0,0.5);margin:20px;padding: 10px;border-radius:5px;}
.order-details p{background:rgba(0,200,120,0.5);padding:10px;border-radius:5px;}
.all-orders-user{width:100%;display:block;height:35px;margin:5px;border:none;transition:1s;border-radius:5px;font-weight:bold;}
.all-orders-user:hover{background:rgba(0,150,0,0.7);}
.all-orders-user:active{background:rgba(0,250,0,1);transition:0s;}
.user-orders{background:rgba(239,239,239,1);margin-left:20px;margin-right:20px;margin-top:0px;padding:20px;}
.user-orders-button{margin:10px;padding:10px;background:rgba(0,255,0,0.5);width:100%;display:block;height:35px;margin:5px;border:none;transition:1s;border-radius:5px;}
.user-orders-button:hover{background:rgba(0,150,0,0.7);}
.order p{display:inline-block;border:solid 0px black;width:130px;padding:10px;overflow:hidden;text-align:center;max-height:15px;font-size:14px;}
.order button{float:right;margin:20px;border-radius:5px;border:none;height:30px;padding-left:7px;padding-right:7px;}
.order{background:rgba(0,100,0,0.5);margin:5px;border-radius:10px;}
.order:hover{background:rgba(0,150,0,0.5);}
.order-div{margin:10px;padding:10px;background:rgba(120,120,120,0.2);border-radius:5px;}
.order-div-headers p{display:inline-block;text-align:center;font-weight:bold;padding:10px;}
.order-div-headers{margin-left:00px;margin:10px;}
.update-order {width:100%;height:40px;border:none;background:rgba(0,0,250,0.7);color:white;border-radius:5px;transition:1s;}
.update-order:hover{background:rgba(0,0,255,0.9);}
.update-order:active{background:rgba(0,255,255,0.5);transition:0s;}
.search-order select{width:200px;height:30px;padding:5px;}
.search-order input{width:200px;height:20px;padding:3px;}
.search-order p{font-weight:bold;}
.search-order{background:rgba(239,239,239,1);padding:20px;}
.search-order button{width:100px;height:30px;margin-left:10px;border:none;background:rgba(0,150,0,1);}
.search-order button:hover{background:rgba(0,170,0,1);}
.search-order button:active{background:rgba(0,250,0,1);}
</style>

<html>
      
    <body>
        <div id = "main-page" style = "width:80%"class = "main-page">
        <h2 style = "text-align:center">Siparişler</h2>
        <div class = "search-order"><p>Sipariş Arama : <select id = "search-order-select"><option value = "Kullanıcı Adı">Kullanıcı Adı</option><option value = "Sipariş Kodu">Sipariş Kodu</option></select> <input id = "search-order-text" type = "text"></input><button id = "search-order">Ara</button> </p></div>

        
        <div class = "all-orders">
            <?php getOrders();?>
        </div>
        </div>
        
        
    </body>
</html>





<script>

    function loading(PageHeight){
        console.log('loading')
        var loader = document.createElement('div')
        loader.setAttribute('class' , 'loader')
        loader.setAttribute('id' , 'loader')
        var loaderPage = document.createElement('div')
        loaderPage.setAttribute('class', 'loader-page')
        loaderPage.setAttribute('id','loader-page')
        loaderPage.style.height = PageHeight;
        loaderPage.appendChild(loader)
        document.getElementById('main-page').insertBefore(loaderPage,document.getElementById('main-page').childNodes[0]);
        
        

    }
    
    function loaded(){
        document.getElementById('loader-page').remove();
    }
    


var searchButton = document.getElementById('search-order')
var searchText = document.getElementById('search-order-text')
var searchSelect = document.getElementById('search-order-select')
var usernameButtons = document.getElementsByClassName('all-orders-user')
var userOrdersButton = document.getElementsByClassName('user-orders-button')
var allOrders = document.getElementsByClassName('user-orders')

searchButton.onclick = function(){
    searchOrder()
    
    
}
searchText.onchange = function(){
    searchOrder();
}

function searchOrder(){
    selectValue = searchSelect.value
    textValue = searchText.value
    for(i=0;i<allOrders.length;i++){
        allOrders[i].style.display = 'none';
        
    }
        if(selectValue == "Kullanıcı Adı"){
            if(textValue.length>0){
            for(i=0;i<usernameButtons.length;i++){
                if(usernameButtons[i].getAttribute('username').search(textValue)>-1){
                    usernameButtons[i].style.display = 'block';
                }else{
                    usernameButtons[i].style.display = 'none';
                }
                
            }
        }
    }
        if(selectValue == "Sipariş Kodu"){
            if(textValue.length>0){
            for(i=0;i<userOrdersButton.length;i++){
                if(userOrdersButton[i].getAttribute('order-id').search(textValue)>-1){
                    
                    for(ii=0;ii<usernameButtons.length;ii++){
                        if(usernameButtons[ii].getAttribute('username') == userOrdersButton[i].getAttribute('username')){
                            usernameButtons[ii].style.display = 'block';
                        }else{
                            usernameButtons[ii].style.display = 'none';
                        }
                    }
                }else{
                    for(ii=0;ii<usernameButtons.length;ii++){
                        if(usernameButtons[ii].getAttribute('username') == userOrdersButton[i].getAttribute('username')){
                            usernameButtons[ii].style.display = 'none';
                        }
                    }
                }
            }
        }
    }
        if(textValue.length==0){
        for(i=0;i<usernameButtons.length;i++){
            usernameButtons[i].style.display = 'block';
        }
    }
    
}







var updateOrdersButtons = document.getElementsByClassName('update-order')


for(i=0;i<updateOrdersButtons.length;i++){
    updateOrdersButtons[i].onclick = function(){
        var orderId = this.getAttribute('order-id')
        var orderStatus = document.getElementById(orderId+'-select-input').value
        xmlhttp = new XMLHttpRequest();
        form = new FormData();
        
        form.append('com' , 'updateOrder')
        form.append('status' , orderStatus)
        form.append('orderId' , orderId)
        
        
        xmlhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                console.log(this.responseText)
                var currentStatusSpan = document.getElementById(orderId+'-order-status')
                currentStatusSpan.innerHTML = orderStatus
                loaded();
            }
        }
        xmlhttp.open('POST' , 'orders.php')
        xmlhttp.send(form)
        loading();
        console.log(orderId + orderStatus)
    }
}



var userOrderButtons = document.getElementsByClassName('all-orders-user')

for(i=0;i<userOrderButtons.length;i++){
    userOrderButtons[i].onclick = function(){
        var username = this.getAttribute('username')
        var order = document.getElementById(username)
        if(order.style.display == 'none'){
            order.style.display = 'block';
        }else{
            order.style.display = 'none';
        }
    }
}




var userOrdersButtons = document.getElementsByClassName('order')

for(i=0;i<userOrdersButtons.length;i++){
    userOrdersButtons[i].onclick = function(){
        console.log(this.getAttribute('code'))
        var orderId = this.getAttribute('order-id')
        var productCode = this.getAttribute('code')
        var orderCount = this.getAttribute('index')
        var orderDetails = document.getElementById(orderId+productCode+orderCount+'-details')
        if(orderDetails.style.display == 'none'){
            orderDetails.style.display = 'block';
        }else{
            orderDetails.style.display = 'none';
        }
        
    }
}


var userOrdersButtons = document.getElementsByClassName('user-orders-button')

for(i=0;i<userOrdersButtons.length;i++){
    userOrdersButtons[i].onclick = function(){
        var orderId = this.getAttribute('order-id')
        var orderDiv = document.getElementById(orderId)
        if(orderDiv.style.display == 'none'){
            orderDiv.style.display = 'block';
        }else{
            orderDiv.style.display = 'none';
        }
    }
}




</script>