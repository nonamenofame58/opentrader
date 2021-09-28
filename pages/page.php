<?php
    if(isset($_SESSION['username'])){
        echo '<script> var login = true </script>';
    }else {
        echo '<script> var login = false </script>';
    }

    $conn = dbConnection();
    
    $allVariants = array();
    if($_GET['com'] == 'getMainCategorieProducts'){
        $_SESSION['showcaseHidden'] = true;
        $spawnCommand = 'mainCategorie';
        $spawnValue = $_GET['categorie'];
    }

    
    if($_GET['com'] == 'getSubCategorieProducts'){
        $_SESSION['showcaseHidden'] = true;
        $spawnCommand = 'subCategorie';
        $spawnValue = $_GET['categorie'];
    }
        if($_GET['com'] == 'getMarkaProducts'){
        $_SESSION['showcaseHidden'] = true;
        $spawnCommand = 'marka';
        $spawnValue = $_GET['marka'];
    }
    
    if($_GET['com'] == ''){
        $_SESSION['showcaseHidden'] = false;
        $spawnCommand = '';
        $spawnValue = '';
        
    }
    
    
  
    
    
    
    
    
    
    
    
    
    
    $sql_getCurrentTime = 'SELECT * FROM showcaseTime';
    $result_getCurrentTime = $conn->query($sql_getCurrentTime);
    $fetch_getCurrentTime = $result_getCurrentTime -> fetch_all(MYSQLI_ASSOC);
    $currentTime = $fetch_getCurrentTime[0]['time'];
    
    # SHOWCASE --------------------------------------------------------------------
    
    
    $sql_getImageLinks = "SELECT * FROM showcase";
    $result_getImageLinks = $conn->query($sql_getImageLinks);
    $fetch_getImageLinks = $result_getImageLinks->fetch_all(MYSQLI_ASSOC);
    $imagesLength = count($fetch_getImageLinks);
    $showcaseHidden = false;
    if(isset($_SESSION['showcaseHidden'])){
        $showcaseHidden = $_SESSION['showcaseHidden'];
    }



function spawnProduct($product,$productPhotos){
    global $allVariants;
    $conn = dbConnection();
    $sql_getProductSpecs = 'SELECT * FROM productSpecs WHERE productCode = "'.$product['code'].'"';
    $result_getProductSpecs = $conn -> query($sql_getProductSpecs);
    $fetch_getProductSpecs = $result_getProductSpecs -> fetch_all(MYSQLI_ASSOC);
    if($fetch_getProductSpecs > 0){
        $productSpecs = $fetch_getProductSpecs;
    }else{
        $productSpecs = 0;
    }
               if($productPhotos > 0){
                    echo '<div id = "'.$product['code'].'" class = "card-main">';
                    echo '<p class = "card-h">'.$product['label'].'</p>';
                    echo '<div class="image-holder">';
                    echo '<img src="imgs/loupe.png" class="zoom-image" value="0">';
                        echo '<img class="showing-image-left" value="0" src="photos/'.$product['code'].'/'.$productPhotos[0]['productImg'].'" draggable="false" cardindex="0" style="cursor: grab; float: right; transition: all 1s ease 0s; width: 100%; border-top-left-radius: 0%; border-bottom-left-radius: 0%;">';
                        echo '<div id="cardDetails" class="card-details" style="height: 0px;">';
                            echo '<p class="card-p">'.$product['price'].' TL </p>';
                            echo '<p class="card-p-details">'.$product['description'].'</p>';
                        echo '</div>';
                    echo '</div>';
                        # IMAGE BUTTONS --------
                        echo '<div class="image-buttons">';
                        echo '</div>';
                        # SPECS ------------
                        echo '<div class="specs">';
                        foreach($productSpecs as $spec){
                            $sql_getSpecImg = 'SELECT img FROM `specs` WHERE id = "'.$spec['specid'].'"';
                            $result_getSpecImg = $conn -> query($sql_getSpecImg);
                            $fetch_getSpecImg = $result_getSpecImg -> fetch_all(MYSQLI_ASSOC);
                            $specImg = $fetch_getSpecImg[0]['img'];
                            echo '<p class="specs-p"><img src="specs/'.$specImg.'">'.$spec['specid'].'</p>';
                            }
                        echo '</div>';
                        
                        echo '<div style = "color:white" class = "all-product-variants">';
                            $sql_getProductVariants = 'SELECT * FROM productVariants WHERE productCode = "'.$product['code'].'"';
                            $result_getProductVariants = $conn -> query($sql_getProductVariants);
                            $fetch_getProductVariants = $result_getProductVariants -> fetch_all(MYSQLI_ASSOC);
                            
                            foreach($fetch_getProductVariants as $variant){
                                echo '<div class = "product-variants" variantName = "'.$variant['variantName'].'" variantValue = "'.$variant['variantValue'].'" code = "'.$product['code'].'"> </div>';
                                array_push($allVariants,$variant['variantValue']);
                            }

                        
                        echo '</div>';
                        
                        $sql_getProductSizes = 'SELECT * FROM productSizes WHERE productCode = "'.$product['code'].'"';
                        $result_getProductSizes = $conn->query($sql_getProductSizes); 
                        $fetch_getProductSizes = $result_getProductSizes -> fetch_all(MYSQLI_ASSOC);
                        
                        echo '<div style = "display:none"; id = "'.$product['code'].'-product-sizes">';
                        foreach($fetch_getProductSizes as $size){
                            echo '<p class = "product-size-name">'.$size['size'].'</p><p class = "product-size-stock">'.$size['stock'].'</p>' ;
                        }
                        
                        echo '</div>';
                        # BUTTONS -------
                        echo '<button value = "'.$product['code'].'" class="card-button-add-cart"> Sepete At </button>';
                        echo '<button class="card-button-go-product" code = "'.$product['code'].'"> Ürüne Git </button>';
                        echo '<div class="img-list" style="display:none;">';
                        $photoCount = 0;
                        foreach($productPhotos as $photo){
                            echo '<img class="l-image" value="'.$photoCount.'" src="photos/'.$product['code'].'/'.$photo['productImg'].'">';
                        $photoCount = $photoCount + 1 ;
                        }
                        echo '</div>';
                        echo '</div>';
                }
}



    
function getAllCards($spawnCommand,$spawnValue){
    $conn = dbConnection();
    $sql_getProducts = 'SELECT * FROM `product`';
    $result_getProducts = $conn -> query($sql_getProducts);
    $fetch_getProducts = $result_getProducts -> fetch_all(MYSQLI_ASSOC);
        foreach($fetch_getProducts as $product){
            if(count($fetch_getProducts) > 0 ){
                $sql_getProductPhotos = 'SELECT * FROM `productPhotos` WHERE productCode = "'.$product['code'].'"';
                $result_getProductPhotos = $conn -> query($sql_getProductPhotos);
                $fetch_getProductPhotos = $result_getProductPhotos -> fetch_all(MYSQLI_ASSOC);
                if($fetch_getProductPhotos > 0 ){
                    $productPhotos = $fetch_getProductPhotos ;
                }else{
                    $productPhotos = 0;
                    }
                    
                # according to main categorie get products ***
                
                if($spawnCommand == 'mainCategorie'){ if($product['mainCategorie'] == $spawnValue){spawnProduct($product,$productPhotos);}}
                
                #according to sub categorie get products ***
                
                if($spawnCommand == 'subCategorie'){ if($product['subCategorie'] == $spawnValue){spawnProduct($product,$productPhotos);}}
                
                #according to markas get products
                if($spawnCommand == 'marka'){ if($product['marka'] == $spawnValue){spawnProduct($product,$productPhotos);}}
                
                # get all products 
                
                if(($spawnCommand == '')){spawnProduct($product,$productPhotos);}else{}
                
            }
        }
}
    

    
    function getVariants(){
        global $allVariants;
        foreach(array_unique($allVariants) as $variant){
            echo '<button class = "variant-buttons" variantvalue = "'.$variant.'">#'.$variant.'</button>';
        }
    }
    
    # -------------------------------------------------------------------------------


?>


    
    <div style = "display:none;" id = "home-page-location"></div>
    
    <div style = "display:none;" id = "carousel" class = "carousel">
        <img id = "carousel-close-button" class = "overlay-close-button"  src = "close.png">
        <div class = "carousel-image-holder">
            <img id = "carousel-big-image" class = "carousel-image-holder-image" src = "https://cdn.shopify.com/s/files/1/0020/8355/3361/products/WWF-LB-09-0794_1440x1800_crop_center@2x.jpg?v=1606414747">
        </div>
        <div id = "carousel-image-list" class ="img-list-carousel"></div>
    </div>
    
    
    
    



<div id = "main-page" class = "main-page">
    


    <?php 
    if($imagesLength<1){$showcaseHidden = true;}
    
    if($showcaseHidden == false){echo '<div style = "display:block" id = "showcase" class = "showcase">';}else{echo '<div style = "display:none" id = "showcase" class = "showcase">';}
        
        echo '
        
            <img id = "showcase-right-button" class = "showcase-right-image" style = "right:0px;" src = "../imgs/right.png">
            <img id = "showcase-left-button" class = "showcase-left-image" style = "left:0px;"  src = "../imgs/left.png">
        ';
        
        $linkCount = 0;
        foreach($fetch_getImageLinks as $image){
            if($linkCount == 0){
                echo '<img showing = "true" id = "'.$linkCount.'"  class = "showcase-show-image" src = "showcase/'.$image['imgLink'].'" style = "max-height:760px;width:100%;display:block;">';
                $linkCount = $linkCount + 1 ;
            }else{
                echo '<img showing = "false" id = "'.$linkCount.'" class = "showcase-show-image" src = "showcase/'.$image['imgLink'].'" style = "max-height:760px;display:none;width:100%;">';
                $linkCount = $linkCount + 1 ;
            }
        }
        echo '<div style = "opacity:1;"id = "all-shows" class = "all-shows">';
        foreach($fetch_getImageLinks as $image){
                echo'<div  class = "all-shows-img"><img style = "width:100%;height:100%;" src = "showcase/'.$image['imgLink'].'"></div>';
        }  
        echo '</div></div>';
    
    ?>

    <div class = "cards">

        <?php
        getAllCards($spawnCommand,$spawnValue);
        ?>
        
        
    </div>

<div style = "display:block;" id = "products-variants" class = "products-variants"> <?php getVariants(); ?> </div>
</div>



<div id = "add-cart" style = "display:none;" class = "add-cart">
  <img id = "add-cart-close-button" class ="add-cart-close-button" src = "imgs/close.png">
  <div class = "add-cart-product-size-holder" id = "add-cart-product-size-holder"> </div>
  <div class="number-input">
  <button id ="add-cart-quantity-decreament" ></button>
  <input id = "add-cart-quantity-input" class="quantity" min="1" max ="2" name="quantity" value="1" type="number">
  <button id="add-cart-quantity-increament" class="plus"></button>
  </div>

<button id = "add-cart-add-button" class = "add-cart-add-button">Ekle</button>    
    
</div>


