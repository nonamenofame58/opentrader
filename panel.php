<?php
session_start();




if(isset($_SESSION['adminID']) and isset($_SESSION['adminPass'])){

    
}else{
    echo '<script>window.location.href = "adminpanel.php"</script>';
    die();
}

?>

<!DOCTYPE html>

<html>
    <head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <style>
        .left-header-panel{
            position:absolute;
            left:0;
            top:0;
            bottom:0;
            width:15%;
            height:100%;
            background:rgba(32,32,32,1);
            
        }
        
        
        .left-header-panel button{
            width:100%;
            height:30px;
            background:rgb(55,55,55);
            color:white;
            border:none;
            
        }
            
        .left-header-panel button{border:solid;border-top-width:1px;border-bottom-width:1px;border-left-width:0px;border-right-width:0px;margin-top:3px;border:grey;}    
        .left-header-panel button:hover{background:rgba(66,66,66,1);}
        .left-header-panel button:active{background:rgba(77,77,77,1);}
        .left-header-panel button:after{background:rgba(88,88,88,1);}
        .left-header-panel-buttons{margin-top:45px;}
        
        .admin-id{color:white;border:solid;border-top-width:0;border-left-width:0;border-right-width:0;border-bottom-width:1px;border-color:white;padding:10px;}
        
        .main-page{position:relative;left:15%;width:60%;}
        .main-categories-panel {background:rgba(32,32,32,0.1);padding:5px;}
        .main-categories-panel button{display:inline-block;width:90%;height:35px;text-align:left;padding:5;}
        .main-categories-panel h3{background-color:rgba(16,16,16,0.1);text-align:center;padding:6px;}
        .main-categories-button-holder{display:block;width:100%;}
        
        .sub-cat-panel {background:rgba(32,32,32,0.1);padding:5px;margin-top:10px;}
        .sub-cat-panel h3{background-color:rgba(16,16,16,0.1);text-align:center;margin:0;padding:6px;}
        .sub-cat-panel button{width:90%;height:35px;display:inline-block;text-align:left;padding:5;}
        .sub-categories-button-holder{display:block;width:100%;}
        
        .add-main-categories input[type=text]{width:80%;border-color:rgb(16,16,16);border-radius:5px;}
        .add-main-categories input[type=submit]{margin-left:10px;padding:1px;width:10%;border:none;background:rgb(16,16,16);color:white;height:20px;transition:1s;border-radius:5px;}
        .add-main-categories input[type=submit]:hover{background:rgb(65,65,65);border-radius:10%;}
        .add-main-categories{margin:10px;}
        
        .add-sub-categories input[type=text]{width:80%;border-color:rgb(16,16,16);border-radius:5px;}
        .add-sub-categories input[type=submit]{margin-left:10px;padding:1px;width:10%;border:none;background:rgb(16,16,16);color:white;height:20px;transition:1s;border-radius:5px;}
        .add-sub-categories input[type=submit]:hover{background:rgb(65,65,65);border-radius:10%;}
        .add-sub-categories{margin:10px;}
        
        .marka-panel {background:rgba(32,32,32,0.1);padding:5px;margin-top:10px;}
        .marka-panel h3{background-color:rgba(16,16,16,0.1);text-align:center;margin:0;padding:6px;}
        .marka-panel button{width:90%;height:35px;display:inline-block;text-align:left;padding:5;}
        .marka-button-holder{display:block;width:100%;}
        
        .add-markas input[type=text]{width:80%;border-color:rgb(16,16,16);border-radius:5px;}
        .add-markas input[type=submit]{margin-left:10px;padding:1px;width:10%;border:none;background:rgb(16,16,16);color:white;height:20px;transition:1s;border-radius:5px;}
        .add-markas input[type=submit]:hover{background:rgb(65,65,65);border-radius:10%;}
        .add-markas{margin:10px;}
        
        .product-menu{background:rgba(16,16,16,0.8); padding:10px;min-height:20%;position:relative;left:15%;width:60%;}
        .product-menu button{width:100px;border-width:1px;border-radius:3px;padding:5px;transition:0.3s;margin:3px;}
        .product-menu button:hover{border:solid 1px;border-radius:5px;background:rgba(16,16,16,0.5);color:white;}
        .product-menu button:active{background:rgba(255,255,255,1);color:black;}
        
        .product-add{margin-top:10px;background:rgba(16,16,16,1);color:white;}
        .product-add input{width:50%;float:right;border-radius:5px;border:none;height:23px;}
        .product-add h2{text-align:center;color:white;padding:6px;padding-top:21px;}
        .product-add select{width:50.5%;float:right;height:23px;border-radius:5px;border:none;}
        .product-add p{background:rgba(64,64,64,0.5);padding:15px;height:100%;margin:5px;}
        .photo-showcase img{width:90px;height:80px;border:solid 2px;margin:7px;border-radius:10px;padding:5px;display:inline-block;}
        .photo-showcase {background:rgba(16,16,16,0.6);width:100%;height:100%;display:inline-block;padding-bottom:50px;background:rgba(150,130,150,1);}
        .color-photo-holder{width:120px;height:120px;display:inline-block;background:rgba(0,0,0,0.5);margin:5px;margin-bottom:20px;border-top-left-radius:10px;border-top-right-radius:10px;}
        
        .add-specs {background:rgba(16,16,16,1);color:white;padding:10px;margin-top:10px;}
        .add-specs input{width:50%;float:right;}
        .add-specs p {padding:15px;margin:0;background:rgba(64,64,64,0.5);margin:10px;}
        .add-specs h2{text-align:center;padding:10px;margin:0;margin-bottom:10px;}
        .add-specs h7{color:white;text-align:center;}
        .review-spec{width:100%;height:60px;margin-top:25px;margin-left:20px;}
        .review-spec img{margin-bottom:-7px;margin-right:3px;}
        .add-specs button{width:100%;height:25px;}
        .add-specs button:hover{transition:0.3s;background:rgba(255,255,255,0.6);color:white;}
        .add-specs button:active{background:rgba(16,16,16,0.7);color:white;}
        .all-specs {padding:10px;}

        .products{margin-top:10px;}
        .products h2{color:white;padding:7px;text-align:center;margin:0;}
        .product-column {border:solid 1px black; padding:0;display: flex;justify-content: center;margin:5px; }
        .column-ps{width:100%;padding:10px;height:100%;}
        .column-buttons button{display:block;width:100%;margin:3px;padding:5px;}
        .column-buttons{width:auto;background:rgba(128,128,128,0.1);height:100%;}
        .product-column-p-holder {display:inline-block;}
        .product-column-header-p{border:solid 0px grey; border-bottom-width:1px;border-right-width:1px;display:block;text-align:left;overflow:hidden;height:auto;text-align:center;padding:10px;margin:auto;}
        .product-column-value-p{display:block;border:solid 0px grey;border-right-width:1px;text-align:left;overflow:hidden;height:auto;text-align:center;padding:10px;margin:auto;word-break: break-all;}
        .products {background:rgba(16,16,16,1);padding:5px;}
        .product-spec-remove-button{height:100%;float:right;width:10%;margin-left:10px;};
        .product-variant-add-button{margin-left:10px;width:20%};
        .product-variant-tr {margin:5px;padding:1px;background:rgba(180,180,180,0.2)}
        .product-variant-remove-button{width:20%;float:right}
        .product-img-td{padding:5px;background:rgba(16,16,16,0.2);margin:5px;display:inline-block;}
        .loader{
            margin:auto;
            margin-top:10%;
            border: 8px solid #f3f3f3;
            border-radius: 50%;
            border-top: 8px solid rgb(255, 164, 0);
            width: 60px;
            height: 60px;
            -webkit-animation: spin 2s linear infinite; /* Safari */
            animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {0% { -webkit-transform: rotate(0deg); }100% { -webkit-transform: rotate(360deg); }}
        
        @keyframes spin {0% { transform: rotate(0deg); }100% { transform: rotate(360deg); }}

        .loader-page{width:100%;height:100%;background:rgba(16,16,16,0.7);position:absolute;z-index:25;}
        .search-product{border:solid 0px grey;border-bottom-width:1px;margin-bottom:15px;}
        .search-product img{width:30px;height:30px;margin-top:-3px;float:right;margin-right:15px;}
        .search-product input{float:right;margin-right:15px;padding:7px;border-radius:5px;border:none;width:200px;}
        .search-input {height:30px;padding:10px;}
        .search-product select{float:right;width:200px;margin-right:10px;padding:5px;border-radius:5px;}
        
        
        .add-showcase-image{background:rgba(16,16,16,1);color:white;height:auto;}
        .add-showcase-image h2{text-align:center;color:white;padding:10px;}
        .add-showcase-image p{background:rgba(64,64,64,1);padding:15px;}
        .add-showcase-image input{float:right;}

        </style>
    </head>
    <body>
        
        
        <div class = "left-header-panel">
            <div class = "admin-id"> <?php session_start(); echo $_SESSION['adminID']; ?> </div>
            <div class = "left-header-panel-buttons">
                <button id = "categories">Kategoriler</button>
                <button id = "product"> Ürünler </button>
                <button id = "showcase"> Vitrin </button>
                <button id = "users">Kullanıcılar</button>
                <button id = "orders">Siparişler</button>
            </div>
        </div>
        
     
    </body>
    <script>
    document.getElementById('orders').onclick = function(){window.location.href = 'orders.php';}
    document.getElementById('categories').onclick = function(){window.location.href = 'categories.php';}
    document.getElementById('product').onclick = function(){window.location.href = 'product.php';}
    document.getElementById('showcase').onclick = function(){window.location.href = 'showcase.php';}
    document.getElementById('users').onclick = function(){window.location.href = 'users.php'}
    
    
    
    </script>
</html>