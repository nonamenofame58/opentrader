<?php




$conn = dbConnection();
$productCode = $_GET['productCode'];


$sql_getProduct = 'SELECT * FROM product WHERE code = "'.$productCode.'"';
$sql_getProductResult = $conn->query($sql_getProduct);
$sql_fetchGetProduct = $sql_getProductResult -> fetch_all(MYSQLI_ASSOC);


$label =  $sql_fetchGetProduct[0]['label'];
$price = $sql_fetchGetProduct[0]['price'];
$marka = $sql_fetchGetProduct[0]['marka'];
$color = $sql_fetchGetProduct[0]['color'];
$desc = $sql_fetchGetProduct[0]['description'];

$sql_getProductPhotos = 'SELECT * FROM productPhotos WHERE productCode = "'.$productCode.'"';
$sql_resultProductPhotos = $conn->query($sql_getProductPhotos);
$sql_resultProductPhotos = $sql_resultProductPhotos -> fetch_all(MYSQLI_ASSOC);

$photos = $sql_resultProductPhotos;

function getAllPhotos(){
    global $photos;
    global $productCode;
    foreach($photos as $photo){
        echo '<img class = "product-all-images-img" style = "width:70px;height:70px;border:1px solid grey;border-radius:10px;margin:5px" src = "../photos/'.$productCode.'/'.$photo['productImg'].'">';
    }
}


function getVariants(){
    $conn = dbConnection();
    global $productCode;
    $sql_getVariants = 'SELECT * FROM productVariants WHERE productCode = "'.$productCode.'"';
    $sql_resultVariants = $conn->query($sql_getVariants);
    $sql_fetchVariants = $sql_resultVariants->fetch_all(MYSQLI_ASSOC);
    foreach($sql_fetchVariants as $variant){
        echo '<p>'.$variant['variantValue'].'</p>';
    }
}


function getSpecs(){
    $conn = dbConnection();
    global $productCode;
    $sql_getSpecs = 'SELECT * FROM productSpecs WHERE productCode = "'.$productCode.'"';
    $sql_resultSpecs = $conn->query($sql_getSpecs);
    $sql_fetchSpecs = $sql_resultSpecs -> fetch_all(MYSQLI_ASSOC);
    
    foreach($sql_fetchSpecs as $specs){
        $sql_getSpecImg = 'SELECT * FROM specs WHERE id = "'.$specs['specid'].'"';
        $sql_resultSpecImg = $conn->query($sql_getSpecImg);
        $sql_fetchSpecImg = $sql_resultSpecImg -> fetch_all(MYSQLI_ASSOC);
        $specImg = $sql_fetchSpecImg[0];
        
        
        echo '<p><img style = "width:30px;height:30px;margin-right:10px;" src = "../specs/'.$specImg['img'].'">'.$specs['specid'].'</p>';
        
    }
}


echo '
<style>
.product{width:100%;height:100%}
.product-image-holder{width:auto;height:auto;display:inline-block;padding:10px}
.product-mains{margin-top:15px;position: absolute;width: auto;margin-left: 30px;display:inline-block;}
.product-image-holder img{width:600px;height:600px;}
.product-all-images{width:600px;margin:auto;}
.product-all-images-img{transition:1s;}
.product-all-images-img:hover{transform:scale(1.3);}
.product-variants{display:inline-block;width:95%;height:auto;background:rgba(239,239,239,0.5);padding:20px;border-radius:5px;}

.product-variants p{font-size:18px;display:inline-block;width:80px;text-align:center;border:0.01em solid grey;margin:3px;border-radius:5px;}
.product-specs{display:inline-block;width:95%;height:auto;background:rgba(239,239,239,0.5);padding:20px;border-radius:5px;margin-top:10px;}
.product-specs p{font-size:18px;display:inline-block;width:auto;text-align:center;border:0.01em solid grey;margin:3px;border-radius:5px;padding:5px;padding-left:10px;padding-right:10px;}
.add-cart-button{width:100%;height:35px;background:rgba(0,175,0,0.7);border:none;border-radius:5px;}
.add-cart-button:hover{background:rgba(0,175,0,1);}
.add-cart-button:focus{outline:none;}
.add-cart-button:active{background:rgba(0,100,0,1);color:white;}
</style>
<div class = "main-page">
<div class = "product">
    <div class = "product-image-holder">
    <img id = "product-main-image" style = "border:1px solid grey;border-radius:10px;" src = "../photos/'.$productCode.'/'.$photos[0]['productImg'].'">
    
    <div style = "margin:3px;" class = "product-all-images">
    ';
    getAllPhotos();
echo    '
    </div>
    
    
    </div>
    
    
    
    
    <div class = "product-mains">
    <h1>'.$label.'</h1>
    <h3>'.$price.' TL<h3>
    <h4>'.$marka.'</h4>
    <hr>
    <h4>'.$desc.'</h4>
        <div class = "product-variants">
        ';
        getVariants();
        
        
        echo '
        </div>
        
        <div class = "product-specs">';
        
        getSpecs();
        
        echo '
        
        
        
        </div>
        
        
        


        </div>
        
        
        <button class = "add-cart-button">Sepete Ekle</button>
    </div>

    
</div>





</div>


';


?>

<script>
var productAllImages = document.getElementsByClassName('product-all-images-img');

for(i=0;i<productAllImages.length;i++){
    productAllImages[i].setAttribute('index' , i);
    productAllImages[i].onclick = function(){
        console.log(this)
        var link = this.src
        document.getElementById('product-main-image').src = link;
    }
}



</script>