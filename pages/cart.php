<?php
session_start();





if(isset($_SESSION['username'])){}else{die();}

include_once '../inc/db.php';
$conn = dbConnection();
    


 
    if($_POST['com'] == 'test'){
        $productCodes = $_POST['productCodes'];
        $productSinglePrices = $_POST['productSinglePrices'];
        $productTotalPrices = $_POST['productTotalPrices'];
        $productLabels = $_POST['labels'];
        $productSizes = $_POST['sizes'];
        $productQuantities = $_POST['quantitys'];
        $orderid = $_POST['orderid'];
        $count = 0;
        foreach($productCodes as $productCode){
            $sql_addToOrder = 'INSERT INTO orders (username,product,label,quantity,size,totalPrice,singlePrice,orderid) VALUES ("'.$_SESSION['username'].'" , "'.$productCode.'" , "'.$productLabels[$count].'","'.$productQuantities[$count].'" , "'.$productSizes[$count].'" , "'.$productTotalPrices[$count].'" , "'.$productSinglePrices[$count].'" , "'.$orderid.'")';
            $result_addToOrder = $conn->query($sql_addToOrder);
            if($result_addToOrder){
                $sql_removeOrderedProduct = 'DELETE FROM carts WHERE username = "'.$_SESSION['username'].'"  AND product = "'.$productCode.'"';
                $result_removeOrderedProduct = $conn -> query($sql_removeOrderedProduct);
                if($result_removeOrderedProduct){
                    
                }else{
                    echo 'Siparişi Verilen ' . $productLabels[$count] . ' sepetten çıkarılamadı bir sorun var gibi';
                }
                $count = $count + 1;
                
            }else{
                foreach($productCodes as $productCode){
                    $sql_revertInsertedProducts = 'DELETE FROM orders WHERE username = "'.$_SESSION['username'].'" AND product = "'.$productCode.'"';
                    $result_revertInsertedProducts = $conn->query($sql_revertInsertedProducts);
                    if($result_revertInsertedProducts){
                        
                    }else{
                        echo 'Sipariş iptal edildi bir sorun var gibi ';
                        die();
                    }
                }
            }
        }
        echo 'Sipariş alındı';
        die();
    }
    
    if($_POST['com'] == 'addCart'){
        $productCode = $_POST['productCode'];
        $productSize = $_POST['productSize'];
        $productQuantity = $_POST['productQuantity'];
        $sql_ctrProduct = 'SELECT * FROM carts WHERE username = "'.$_SESSION['username'].'"  AND product = "'.$productCode.'" AND size = "'.$productSize.'"';
        $result_ctrProduct = $conn -> query($sql_ctrProduct);
        $fetch_ctrProduct = $result_ctrProduct -> fetch_all(MYSQLI_ASSOC);
        if(count($fetch_ctrProduct)>0){
            echo 'ÜRÜN ZATEN VAR !';
            die();
        }else{
            
        
        
            $sql_addProductCart = 'INSERT INTO carts (username,product,quantity,size) VALUES ("'.$_SESSION['username'].'","'.$productCode.'","'.$productQuantity.'","'.$productSize.'")';
            $result_addProductCart = $conn->query($sql_addProductCart);
            if($result_addProductCart){
                echo 'ÜRÜN SEPETTE ! ';
                die();
    
            }
        }
    }
    if($_POST['com'] == 'removeProductFromCart'){
        $productCode = $_POST['productCode'];
        $sql_removeProductFromCart = 'DELETE FROM carts WHERE username = "'.$_SESSION['username'].'" AND product = "'.$productCode.'"';
        $result_removeProductFromCart = $conn -> query($sql_removeProductFromCart);
        if($result_removeProductFromCart){
            echo 'Ürün sepetten kaldırıldı';
            die();
        }else{
            echo 'Bir sorun var ';
            die();
        }
        
    }
    
    
    if($_POST['com'] == 'updateCartProductQuantity'){
        $productCode = $_POST['productCode'];
        $productQuantity = $_POST['productQuantity'];
        $productUser = $_SESSION['username'];
        $sql_updateProductQuantity = 'UPDATE carts SET quantity = "'.$productQuantity.'" WHERE username = "'.$productUser.'" AND product = "'.$productCode.'"';
        $result_updateProductQuantity = $conn->query($sql_updateProductQuantity);
        if($result_upteProductQuantity){
            
        }
    }
    function getCartProducts(){
        
        $conn = dbConnection();
        $sql_getCartProducts = 'SELECT * FROM carts WHERE username = "'.$_SESSION['username'].'"';
        $result_getCartProducts = $conn->query($sql_getCartProducts);
        $fetch_getCartProducts = $result_getCartProducts->fetch_all(MYSQLI_ASSOC);
        if($result_getCartProducts){}
        $productCount = 0;
        $totalPrice = 0;
        foreach($fetch_getCartProducts as $products){
            
            
            $productCode = $products['product'];
            $productSize = $products['size'];
            $productQuantity = $products['quantity'];
            if($productSize=='null'){$productSize = 'Yok';}
            $sql_getProduct = 'SELECT * FROM product WHERE code = "'.$productCode.'"';
            $result_getProduct = $conn->query($sql_getProduct);
            $fetch_getProduct = $result_getProduct -> fetch_all(MYSQLI_ASSOC);
            
            $sql_getProductPhoto = 'SELECT * FROM productPhotos WHERE productCode = "'.$productCode.'"';
            $result_getProductPhoto = $conn->query($sql_getProductPhoto);
            $fetch_getProductPhoto = $result_getProductPhoto -> fetch_all(MYSQLI_ASSOC);
            $productPhotos = $fetch_getProductPhoto;

            
            foreach($fetch_getProduct as $product){
                $bgColor = 'first';
                $color = 'background:rgba(0,255,255,0.1)';
                $productEqual['price'] = $product['price'] * $products['quantity'];
                echo '<div code = "'.$productCode.'" single-price = "'.$product['price'].'" total-price = "'.$productEqual['price'].'" quantity = "'.$products['quantity'].'" label = "'.$product['label'].'" size = "'.$productSize.'" style = "'.$color.'" class = "cart-products-product">';
                echo '<p style = "min-width:400px">'.$product['label'].'</p>
                <p class = "cart-product-price" id = "'.$productCode.'-product-price" price = "'.$product['price'].'" >'.$productEqual['price'].' TL</p>
                <p>'.$productSize.'</p>
                <p><button code = "'.$productCode.'" class = "change-quantity-button-decreament"> - </button><span id = "'.$productCode.'-product-quantity">'.$products['quantity'].'</span><button code =  "'.$productCode.'" class = "change-quantity-button-increament"> + </button></p>
                <p>%'.$product['tax'].'</p>
                <p>%'.$product['discount'].'</p>
                <img src = "photos/'.$productCode.'/'.$productPhotos[0]['productImg'].'">
                <button code = "'.$product['code'].'" class = "remove-product-from-cart">Kaldır</button>';
                echo '</div>';
                if($bgColor == 'first'){$color = 'background:rgba(255,255,0,0.2)';$bgColor = 'end';}else{$color = 'background:rgba(0,255,255,0.2)';$bgColor = 'first';}
                $productCount = $productCount  + $products['quantity'];
                $totalPrice = $totalPrice + $productEqual['price'];
            }

        }
            echo '<div class = "total-products">
            <p style = "font-weight:bold;max-width:300px">Sepetteki toplam ürün : <span id = "total-product-quantity"> '.$productCount.'</span></p>
            <p style = "font-weight:bold;max-width:300px">Toplam Fiyat : <span id = "total-product-price">'.$totalPrice.'</span></p>
            <button id = "order-cart-button">Ödemeye Git </button>
            
            
            </div>';
    }
    
    

    






?>


<div style = "display:none;" id = "cart-page-location"> </div>
    <div style = "margin-left:5%;" id = "main-page" class = "main-page">
        <div id ="cart-products" class = "cart-products">
            <h2 style = "text-align:center">SEPET</h2>
            <hr>
            <div class = "cart-products-headers"><p style = "min-width:400px">İsim</p><p>Fiyat</p><p>Beden</p><p>Adet</p><p>Vergi</p><p>İndirim</p></div>
            <?php getCartProducts(); ?>
        </div>
    </div>



