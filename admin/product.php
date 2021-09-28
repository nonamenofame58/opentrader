<?php 
include 'panel.php';
include '../inc/db.php';

$conn = dbConnection();


function getProducts(){
    $conn = dbConnection();
    $sql_getProducts = 'SELECT * FROM `product`';
    $result_getProducts = $conn->query($sql_getProducts);
    $fetch_getProducts = $result_getProducts->fetch_all(MYSQLI_ASSOC);
    $bgColor = 'LightSkyBlue';
    if($result_getProducts){

        echo '<h2 style = "color:white;padding:2px;text-align:center">Ürünler</h2>';
        foreach($fetch_getProducts as $product){
            
            # */*/*/*/*/*/*/*/*/*/*/*/*/*/* SET COLOR EACH COLUMN */*/*/*/*/*/*/*/*/*/*/*/*/*/* 
    
            if($bgColor == 'LightSkyBlue'){$bgColor = 'LightGreen';}else{$bgColor = 'LightSkyBlue';}
            if($product['productStatus'] == 1){$product['productStatus'] = 'Aktif';}else{$product['productStatus'] = 'Pasif';}

            
            
            echo '<div class = "product-column" style = "background-color:'.$bgColor.'" id = "'.$product['code'].'">
                       
            <div class = "column-ps">
            <h3 style = "background:rgba(128,128,128,0.3);width:100%;text-align:center">Ürün</h3>
            <div class = "product-column-p-holder"><p class = "product-column-header-p">Ürün Kodu</p><p product = "code" code = "'.$product['code'].'" class = "product-column-value-p">'.$product['code'].'</p></div>
            <div class = "product-column-p-holder"><p class = "product-column-header-p">Etiket İsmi</p><p product = "label" code = "'.$product['code'].'" class = "product-column-value-p" >'.$product['label'].'</p></div>
            <div class = "product-column-p-holder"><p class = "product-column-header-p">Durum</p><p product = "status" code = "'.$product['code'].'" class = "product-column-value-p" >'.$product['productStatus'].'</p></div>
            <div class = "product-column-p-holder"><p class = "product-column-header-p">Fiyat</p><p product = "price" code = "'.$product['code'].'" class = "product-column-value-p" >'.$product['price'].'</p></div>
            <div class = "product-column-p-holder"><p class = "product-column-header-p">Vergi</p><p product = "tax" code = "'.$product['code'].'" class = "product-column-value-p" >'.$product['tax'].'</p></div>
            <div class = "product-column-p-holder"><p class = "product-column-header-p">Stok</p><p product = "stock" code = "'.$product['code'].'" class = "product-column-value-p" >'.$product['stock'].'</p></div>
            <div class = "product-column-p-holder"><p class = "product-column-header-p">Ana Kategori</p><p product = "mainCategorie" code = "'.$product['code'].'" class = "product-column-value-p" >'.$product['mainCategorie'].'</p></div>
            <div class = "product-column-p-holder"><p class = "product-column-header-p">Alt Kategori</p><p product = "subCategorie" code = "'.$product['code'].'" class = "product-column-value-p" >'.$product['subCategorie'].'</p></div>
            <div class = "product-column-p-holder"><p class = "product-column-header-p">Marka</p><p product = "marka" code = "'.$product['code'].'" class = "product-column-value-p" >'.$product['marka'].'</p></div>
            <div class = "product-column-p-holder"><p class = "product-column-header-p">Barkod</p><p product = "barcode" code = "'.$product['code'].'" class = "product-column-value-p" >'.$product['barcode'].'</p></div>
            <div class = "product-column-p-holder"><p class = "product-column-header-p">İndirim</p><p product = "discount" code = "'.$product['code'].'" class = "product-column-value-p" >'.$product['discount'].'</p></div>
            <div class = "product-column-p-holder"><p class = "product-column-header-p">Desi</p><p product = "desi" code = "'.$product['code'].'" class = "product-column-value-p" >'.$product['desi'].'</p></div>
            <div class = "product-column-p-holder"><p class = "product-column-header-p">Açıklama</p><p product = "description" code = "'.$product['code'].'" class = "product-column-value-p" >'.$product['description'].'</p></div>

            
                <div  class = "column-buttons">
                <h3 style = "background:rgba(128,128,128,0.3);text-align:center">Düzenle</h3>
                    <button code = "'.$product['code'].'" class = "remove-product-button">Sil</button>
                    <button code = "'.$product['code'].'" class = "product-specs-showHide-button">Özellikler</button>
                    <button class = "product-variants-showHide-button" code = "'.$product['code'].'" >Seçenekler</button>
                    <button class= "product-sizes-showHide-button" code = "'.$product['code'].'">Bedenler</button>
                    <button class = "product-photos-showHide-button" code = "'.$product['code'].'" >Fotoğraflar</button>
                </div>
                
                
                
            
            ';
            
            
            $sql_getProductSpecs = 'SELECT * FROM `productSpecs` WHERE productCode = "'.$product['code'].'"';
            $result_getProductSpecs = $conn->query($sql_getProductSpecs);
            $fetch_getProductSpecs = $result_getProductSpecs->fetch_all(MYSQLI_ASSOC);
            echo '<div style = "background-color:'.$bgColor.';padding:10px;display:none;" id = "'.$product['code'].'-specs">
            <div id = "'.$product['code'].'-all-specs" style = "margin-bottom:5px;background:rgba(128,128,128,0.1);padding:2px;">
            <h3  style = "margin-top:0;text-align:center;background:rgba(128,128,128,0.4)"> Özellikler </h3>';
            foreach($fetch_getProductSpecs as $productSpec){
                echo 
                
                '<div class = "product-spec-tr">
                <p style = "padding:10px;margin:5px; background:rgba(222,222,222,0.1)" class = "product-spec-td">'.$productSpec['specid'].'<button spec-id = "'.$productSpec['specid'].'" code = "'.$product['code'].'" class = "product-spec-remove-button" style = "height:100%;float:right;width:10%;margin-left:10px;">Kaldır</button></p>
                </div>
                
                
                ';
            }
            echo '</div>';
            echo '<div style = "background:rgba(128,128,128,0.1);padding:2px;">
            <h3 style = "margin-top:0;text-align:center;background:rgba(128,128,128,0.4)">Ekle</h3>
            <select style = "width:100%;padding:10px;" id = "'.$product['code'].'-add-spec" >';
            getSpecsOptions();
            echo '</select><button code = "'.$product['code'].'" class = "product-spec-add-button" style = " height:30px;margin-top:10px;width:100%">Ekle</button>';
            echo '</div></div>';
             
             
             $sql_getProductVariants = 'SELECT * FROM `productVariants` WHERE productCode = "'.$product['code'].'"';
             $result_getProductVariants = $conn->query($sql_getProductVariants);
             $fetch_getProductVariants = $result_getProductVariants->fetch_all(MYSQLI_ASSOC);
             echo '<div style = "margin:10px;background-color:'.$bgColor.';padding:10px;display:none;" id = "'.$product['code'].'-variants">';
             echo '<div id = "'.$product['code'].'-all-variants" style = "background:rgba(128,128,128,0.1)"><h3 style = "text-align:center;background:rgba(128,128,128,0.3);padding:3px;">Seçenekler</h3>';
             foreach($fetch_getProductVariants as $variants){
                 
                 echo '<div style = "margin:5px;padding:1px;background:rgba(180,180,180,0.2)" class = "product-variant-tr"><p style = "margin:8px;" class = "product-variant-td">'.$variants['variantName'].' : '.$variants['variantValue'].'<button variant-value = "'.$variants['variantValue'].'" code = "'.$product['code'].'" class = "product-variant-remove-button" style = "width:20%;float:right">Kaldır</button></p></div>';

                 
             }
             echo '</div>';
             echo '<div  style = "height:100%;backgorund:rgba(128,128,128,0.2)"><h3 style = "background:rgba(128,128,128,0.3);text-align:center">Seçenek Ekle</h3><label>İsim : </label><select style = "width:100px;" id = "'.$product['code'].'-variant-add-input-name" >';
             getVariantsAsOption();
             echo '</select><label style ="margin-left:10px;" >Değer : </label><input id = "'.$product['code'].'-variant-add-input-value" type = "text"><button code = "'.$product['code'].'" class = "product-variant-add-button" style = "margin-left:10px;width:20%">Ekle</button></div>';
             echo '</div>';
            
            
             $sql_getProductSizes = 'SELECT * FROM `productSizes` WHERE productCode = "'.$product['code'].'"';
             $result_getProductSizes = $conn->query($sql_getProductSizes);
             $fetch_getProductSizes = $result_getProductSizes->fetch_all(MYSQLI_ASSOC);
             echo '<div style = "margin:10px;background-color:'.$bgColor.';padding:10px;display:none;" id = "'.$product['code'].'-sizes">';
             echo '<div id = "'.$product['code'].'-all-sizes" style = "background:rgba(128,128,128,0.1)"><h3 style = "text-align:center;background:rgba(128,128,128,0.3);padding:3px;">Bedenler</h3>';
             foreach($fetch_getProductSizes as $sizes){
                 
                 echo '<div style = "margin:5px;padding:1px;background:rgba(180,180,180,0.2)" class = "product-sizes-tr"><p style = "margin:8px;" class = "product-sizes-td">'.$sizes['size'].' : '.$sizes['stock'].'<button size-value = "'.$sizes['size'].'" code = "'.$product['code'].'" class = "product-size-remove-button" style = "width:20%;float:right">Kaldır</button></p></div>';

                 
             }
             echo '</div>';
             echo '<div  style = "height:100%;backgorund:rgba(128,128,128,0.2)"><h3 style = "background:rgba(128,128,128,0.3);text-align:center">Beden Ekle</h3><label>İsim : </label><select style = "width:100px;" id = "'.$product['code'].'-size-add-input-name" >';
             getSizesAsOption();
             echo '</select><label style ="margin-left:10px;" >Stok : </label><input id = "'.$product['code'].'-size-add-input-value" type = "text"><button code = "'.$product['code'].'" class = "product-size-add-button" style = "margin-left:10px;width:20%">Ekle</button></div>';
             echo '<p style = "text-align:center;width:100%;color:red;font-size:15px;font-weight:bold;padding:10px;">Aynı bedeni tekrar eklerseniz stoğu günceller.</p>';
             echo '</div>';
            
            
            
            
            
            
            
             $sql_getProductImgs = 'SELECT * FROM `productPhotos` WHERE productCode = "'.$product['code'].'"';
             $result_getProductImgs = $conn->query($sql_getProductImgs);
             $fetch_getProductImgs = $result_getProductImgs->fetch_all(MYSQLI_ASSOC);
             echo '
             <div style = "background-color:'.$bgColor.';padding:10px;display:none;" id = "'.$product['code'].'-imgs">
             <div id = "'.$product['code'].'-all-imgs" style = "background:rgba(128,128,128,0.1);height:auto;">
             <h3 style = "text-align:center;padding:3px;background:rgba(128,128,128,0.3)">Fotoğraflar</h3>
             ';
             
             foreach($fetch_getProductImgs as $imgs){
                 echo '<div style = "padding:5px;background:rgba(16,16,16,0.2);margin:5px;display:inline-block;" class = "product-img-td"><img style = "display:block;margin:auto;width:100px;height:100px;" src = "../photos/'.$product['code'].'/'.$imgs['productImg'].'"><button class = "remove-product-photo-button" img-name = "'.$imgs['productImg'].'" img-link = "photos/'.$product['code'].'/'.$imgs['productImg'].'" code = "'.$product['code'].'" style = "display:block;margin-top:8px;width:100px">Kaldır</button></div>';
             }
             echo '</div><div style = "margin-top:10px;background:rgba(128,128,128,0.1);width:100%;">';
             echo '<h3 style = "margin-top:0;text-align:center;padding:5px;background:rgba(128,128,128,0.1)">Fotoğraf Yükle</h3><img id = "'.$product['code'].'-img-show" src="../imgs/loupe.png" style = "display:block;margin:auto;width:100px;height:100px;"><input style = "height:45px;display:block;" code = "'.$product['code'].'" class = "add-product-image-input" id = "'.$product['code'].'-image-input" type = "file"><button class = "add-product-image-button" code = "'.$product['code'].'" style = "height:30px;width:100%;">Yükle</button>';
             echo '</div></div></div></div>';
        }
    
        
    }
}



if($_POST['com'] == 'addSize'){
    $conn = dbConnection();
    $sizeValue = $_POST['sizeValue'];
    $sql_addSize = 'INSERT INTO sizes (size) VALUES ("'.$sizeValue.'")';
    $result_addSize = $conn -> query($sql_addSize);
    if($result_addSize){
        
    }
    
}

if($_POST['com'] == 'addSizeProduct'){
    $conn = dbConnection();
    $productCode = $_POST['productCode'];
    $sizeName = $_POST['sizeName'];
    $sizeStock = $_POST['sizeStock'];
    $sql_ctrSize = 'SELECT * FROM productSizes WHERE size = "'.$sizeName.'" AND  productCode = "'.$productCode.'"';
    $result_ctrSize = $conn -> query($sql_ctrSize);
    $fetch_ctrSize = $result_ctrSize -> fetch_all(MYSQLI_ASSOC);
    if(count($fetch_ctrSize) > 0){
        $sql_updateProductSize = 'UPDATE productSizes SET stock = "'.$sizeStock.'" WHERE productCode = "'.$productCode.'" AND  size = "'.$sizeName.'"';
        $result_updateProductSize = $conn -> query($sql_updateProductSize);
        if($result_updateProductSize){
            
        }
    }else{
        $sql_addProductSize = 'INSERT INTO productSizes (productCode,size,stock) VALUES ("'.$productCode.'","'.$sizeName.'","'.$sizeStock.'")';
        $result_addProductSize = $conn -> query($sql_addProductSize);
        if($result_addProductSize){
            
        }
    }
    
}
if($_POST['com'] == 'removeProductSize'){
    $productCode = $_POST['productCode'];
    $sizeName = $_POST['sizeName'];
    $sql_removeProductSize = 'DELETE FROM productSizes WHERE productCode = "'.$productCode.'" AND size = "'.$sizeName.'"';
    $result_removeProductSize = $conn -> query($sql_removeProductSize);
    if($result_removeProductSize){
        
    }
}

if($_POST['com'] == 'removeSize'){
    $conn = dbConnection();
    $sizeValue = $_POST['sizeValue'];
    $sql_removeSize = 'DELETE FROM sizes WHERE size = "'.$sizeValue.'"';
    $result_removeSize = $conn -> query($sql_removeSize);
    if($result_addSize){
        
    }
    
}
function getSizes(){
    $conn = dbConnection();
    $sql_getSizes = 'SELECT * FROM sizes';
    $result_getSizes = $conn -> query($sql_getSizes);
    $fetch_getSizes = $result_getSizes -> fetch_all(MYSQLI_ASSOC);
    foreach($fetch_getSizes as $size){
        echo '<p>'.$size['size'].'<button value = "'.$size['size'].'" class = "remove-size" >Kaldır</button></p>';
    }
}
function getSizesAsOption(){
    $conn = dbConnection();
    $sql_getSizes = 'SELECT * FROM sizes';
    $result_getSizes = $conn -> query($sql_getSizes);
    $fetch_getSizes = $result_getSizes -> fetch_all(MYSQLI_ASSOC);
    foreach($fetch_getSizes as $size){
        echo '<option value = "'.$size['size'].'" >'.$size['size'].'</option>';
    }
}

if($_POST['com'] == 'changeProductcode'){
    $conn = dbConnection();
    $productCode = $_POST['productCode'];
    $productType = $_POST['productType'];
    $newValue = $_POST['newValue'];
    
    $sql_controlProductCode = 'SELECT * FROM `product` WHERE code = "'.$newValue.'"  ';
    $result_controlProductCode = $conn->query($sql_controlProductCode);
    $fetch_controlProductCode = $result_controlProductCode->fetch_all(MYSQLI_ASSOC);
    echo count($fetch_controlProductCode);
    if(count($fetch_controlProductCode) > 0){
        $_SESSION['error'] = 'true';
        die();
    }else{
        $_SESSION['error'] = 'false';
    }
    
    
    
    
    $sql_updateProduct = 'UPDATE `product` SET code = "'.$newValue.'" WHERE code = "'.$productCode.'" ';
    $result_updateProduct = $conn->query($sql_updateProduct);
    if($result_updateProduct){
        $sql_updateProductSpecs = 'UPDATE `productSpecs` SET productCode = "'.$newValue.'" WHERE productCode = "'.$productCode.'"';
        $result_updateProductSpecs = $conn->query($sql_updateProductSpecs);
        if($result_updateProductSpecs){
            $sql_updateProductVariants ='UPDATE `productVariants` SET productCode = "'.$newValue.'" WHERE productCode = "'.$productCode.'"';
            $result_updateProductVariants = $conn->query($sql_updateProductVariants);
            if($result_updateProductVariants){
                $sql_updateProductPhotos = 'UPDATE `productPhotos` SET productCode = "'.$newValue.'" WHERE productCode = "'.$productCode.'"';
                $result_updateProductPhotos = $conn->query($sql_updateProductPhotos);
                if($result_updateProductPhotos){
                    rename('photos/'.$productCode.'/' , 'photos/'.$newValue.'/');
                    
                }
            }
        }
    }
}



if($_POST['com'] == 'changeProductlabel'){
    $conn = dbConnection();
    $productCode = $_POST['productCode'];
    $productType = $_POST['productType'];
    $newValue = $_POST['newValue'];
    
    $sql_updateProduct = 'UPDATE `product` SET label = "'.$newValue.'" WHERE code = "'.$productCode.'" ';
    $result_updateProduct = $conn->query($sql_updateProduct);
    if($result_updateProduct){
        
    }

    
}
if($_POST['com'] == 'changeProductstatus'){
    $conn = dbConnection();
    $productCode = $_POST['productCode'];
    $productType = $_POST['productType'];
    $newValue = $_POST['newValue'];
    
    $sql_updateProduct = 'UPDATE `product` SET productStatus = "'.$newValue.'" WHERE code = "'.$productCode.'" ';
    $result_updateProduct = $conn->query($sql_updateProduct);
    if($result_updateProduct){
        
    }

    
}
if($_POST['com'] == 'changeProductprice'){
    $conn = dbConnection();
    $productCode = $_POST['productCode'];
    $productType = $_POST['productType'];
    $newValue = $_POST['newValue'];
    
    $sql_updateProduct = 'UPDATE `product` SET price = "'.$newValue.'" WHERE code = "'.$productCode.'" ';
    $result_updateProduct = $conn->query($sql_updateProduct);
    if($result_updateProduct){
        
    }

}

if($_POST['com'] == 'changeProducttax'){
    $conn = dbConnection();
    $productCode = $_POST['productCode'];
    $productType = $_POST['productType'];
    $newValue = $_POST['newValue'];
    
    $sql_updateProduct = 'UPDATE `product` SET tax = "'.$newValue.'" WHERE code = "'.$productCode.'" ';
    $result_updateProduct = $conn->query($sql_updateProduct);
    if($result_updateProduct){
        
    }

    
}

if($_POST['com'] == 'changeProductstock'){
    $conn = dbConnection();
    $productCode = $_POST['productCode'];
    $productType = $_POST['productType'];
    $newValue = $_POST['newValue'];
    
    $sql_updateProduct = 'UPDATE `product` SET stock = "'.$newValue.'" WHERE code = "'.$productCode.'" ';
    $result_updateProduct = $conn->query($sql_updateProduct);
    if($result_updateProduct){
        
    }

    
}

if($_POST['com'] == 'changeProductmainCategorie'){
    $conn = dbConnection();
    $productCode = $_POST['productCode'];
    $productType = $_POST['productType'];
    $newValue = $_POST['newValue'];
    
    $sql_updateProduct = 'UPDATE `product` SET mainCategorie = "'.$newValue.'" WHERE code = "'.$productCode.'" ';
    $result_updateProduct = $conn->query($sql_updateProduct);
    if($result_updateProduct){
        
    }

    
}
if($_POST['com'] == 'changeProductsubCategorie'){
    $conn = dbConnection();
    $productCode = $_POST['productCode'];
    $productType = $_POST['productType'];
    $newValue = $_POST['newValue'];
    
    $sql_updateProduct = 'UPDATE `product` SET subCategorie = "'.$newValue.'" WHERE code = "'.$productCode.'" ';
    $result_updateProduct = $conn->query($sql_updateProduct);
    if($result_updateProduct){
        
    }

    
}

if($_POST['com'] == 'changeProductmarka'){
    $conn = dbConnection();
    $productCode = $_POST['productCode'];
    $productType = $_POST['productType'];
    $newValue = $_POST['newValue'];
    
    $sql_updateProduct = 'UPDATE `product` SET marka = "'.$newValue.'" WHERE code = "'.$productCode.'" ';
    $result_updateProduct = $conn->query($sql_updateProduct);
    if($result_updateProduct){
        
    }
}

if($_POST['com'] == 'changeProductbarcode'){
    $conn = dbConnection();
    $productCode = $_POST['productCode'];
    $productType = $_POST['productType'];
    $newValue = $_POST['newValue'];
    
    $sql_updateProduct = 'UPDATE `product` SET barcode = "'.$newValue.'" WHERE code = "'.$productCode.'" ';
    $result_updateProduct = $conn->query($sql_updateProduct);
    if($result_updateProduct){
        
    }

    
}

if($_POST['com'] == 'changeProductdiscount'){
    $conn = dbConnection();
    $productCode = $_POST['productCode'];
    $productType = $_POST['productType'];
    $newValue = $_POST['newValue'];
    
    $sql_updateProduct = 'UPDATE `product` SET discount = "'.$newValue.'" WHERE code = "'.$productCode.'" ';
    $result_updateProduct = $conn->query($sql_updateProduct);
    if($result_updateProduct){
        
    }
}


if($_POST['com'] == 'changeProductdesi'){
    $conn = dbConnection();
    $productCode = $_POST['productCode'];
    $productType = $_POST['productType'];
    $newValue = $_POST['newValue'];
    
    $sql_updateProduct = 'UPDATE `product` SET desi = "'.$newValue.'" WHERE code = "'.$productCode.'" ';
    $result_updateProduct = $conn->query($sql_updateProduct);
    if($result_updateProduct){}
}

if($_POST['com'] == 'changeProductdescription'){
    $conn = dbConnection();
    $productCode = $_POST['productCode'];
    $productType = $_POST['productType'];
    $newValue = $_POST['newValue'];
    
    $sql_updateProduct = 'UPDATE `product` SET description = "'.$newValue.'" WHERE code = "'.$productCode.'" ';
    $result_updateProduct = $conn->query($sql_updateProduct);
    if($result_updateProduct){}
}



if($_POST['com'] == 'removeProduct'){
    $conn = dbConnection();
    function delTree($dir) {
        $files = array_diff(scandir($dir), array('.','..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }
    $productCode = $_POST['productCode'];
    $sql_removeProductproduct = 'DELETE FROM `product` WHERE code = "'.$productCode.'" ';
    $result_removeProductproduct = $conn->query($sql_removeProductproduct);
    if($result_removeProductproduct){
        $sql_removeProductSpecs = 'DELETE FROM `productSpecs` WHERE productCode = "'.$productCode.'"';
        $result_removeProductSpecs = $conn->query($sql_removeProductSpecs);
        if($result_removeProductSpecs){
            $sql_removeProductPhotos = 'DELETE FROM `productPhotos` WHERE productCode = "'.$productCode.'"';
            $result_removeProductPhotos = $conn->query($sql_removeProductPhotos);
            if($result_removeProductPhotos){
                $productDir = '../photos/'.$productCode.'/';
                delTree($productDir);
                $sql_removeProductVariants = 'DELETE FROM `productVariants` WHERE productCode = "'.$productCode.'"';
                $result_removeProductVariants = $conn->query($sql_removeProductVariants);
                if($result_removeProductVariants){
                    
                }
            }
        }
    }
}


if($_POST['com'] == 'addImageToProduct'){
    $conn = dbConnection();
    $productCode = $_POST['productCode'];
    
    $sql_addImageToProduct = 'INSERT INTO `productPhotos` (productCode,productImg) VALUES ("'.$productCode.'","'.$_FILES['files']['name'].'")';
    $result_addImageToProduct = $conn->query($sql_addImageToProduct);
    
    $target_dir = '../photos/';
    $target_file = $target_dir .$_POST['productCode'].'/'. basename($_FILES["files"]["name"]);
    move_uploaded_file($_FILES['files']["tmp_name"] , $target_file);
    if($result_addImageToProduct){
        
       
        
    }
}

if($_POST['com'] == 'variantRemoveFromProduct'){
    $conn = dbConnection();
    $productCode = $_POST['productCode'];
    
    $variantValue = $_POST['variantValue'];
    $sql_removeVariantFromProduct = 'DELETE FROM `productVariants` WHERE productCode = "'.$productCode.'" AND variantValue = "'.$variantValue.'" ';
    $result_removeVariantFromProduct = $conn->query($sql_removeVariantFromProduct);
    if($result_removeVariantFromProduct){
        
    }
}


if($_POST['com'] == 'removePhotoFromProduct'){
    $conn = dbConnection();
    $productCode = $_POST['productCode'];
    $imgName = $_POST['imgName'];
    $imgLink = $_POST['imgLink'];
    echo $sql_removePhotoFromProduct = 'DELETE FROM `productPhotos` WHERE productCode = "'.$productCode.'" AND productImg = "'.$imgName.'" ';
    $result_removePhotoFromProduct = $conn->query($sql_removePhotoFromProduct);
    if($result_removePhotoFromProduct){
        unlink($imgLink);
    }
}




if($_POST['com'] == 'variantAddToProduct'){
    $conn = dbConnection();
    $productCode = $_POST['productCode'];
    $variantValue = $_POST['variantValue'];
    $variantName = $_POST['variantName'];
    $sql_addVariantToProduct = 'INSERT INTO `productVariants` (productCode,variantName,variantValue ) VALUES ("'.$productCode.'" , "'.$variantName.'", "'.$variantValue.'") ';
    $result_addVariantToProduct = $conn->query($sql_addVariantToProduct);
    if($result_addVariantToProduct){}
}

if($_POST['com'] == 'specAddToProduct'){
    $conn = dbConnection();
    $productCode = $_POST['productCode'];
    $specid = $_POST['specId'];
    $sql_addSpecProduct = 'INSERT INTO `productSpecs` (productCode,specid) VALUES ("'.$productCode.'","'.$specid.'")';
    $result_addSpecProduct = $conn->query($sql_addSpecProduct);
    if($result_addSpecProduct){
        
    }
    
    
}

if($_POST['com'] == 'specRemoveFromProduct'){
    $conn = dbConnection();
    $specid = $_POST['specId'];
    $code = $_POST['productCode'];
    
    echo $sql_removeSpec = 'DELETE FROM `productSpecs` WHERE specId = "'.$specid.'" AND productCode = "'.$code.'"';
    $result_removeSpec = $conn->query($sql_removeSpec);
    if($result_removeSpec){
        
    }
}

if($_POST['com'] == 'addVariant'){
    $conn = dbConnection();
    $type = $_POST['variantType'];
    $sql_addVariant = 'INSERT INTO `variants` (variant) VALUES ("'.$type.'")';
    $result_addVariant = $conn->query($sql_addVariant);
    if($result_addVariant){
        
    }
}


if($_POST['com'] == 'removeVariant'){
    $conn = dbConnection();
    $type = $_POST['variantType'];
    $sql_removeVariant = 'DELETE FROM `variants` WHERE variant = "'.$type.'"';
    $result_removeVariant = $conn->query($sql_removeVariant);
    if($result_removeVariant){
        
    }
}

function getVariants(){
    $conn = dbConnection();
    $sql_getVariants = 'SELECT * FROM `variants`';
    $result_getVariants = $conn->query($sql_getVariants);
    $fetch_getVariants = $result_getVariants->fetch_all(MYSQLI_ASSOC);
    foreach($fetch_getVariants as $variant){
        $variant =  $variant['variant'];
        echo '<p style = "padding:20px;">'.$variant.'<button variantId = "'.$variant.'" class = "remove-variant-button" style = "width:100px;height:25px;float:right">Kaldır</button></p>';
    }
}
function getVariantsAsOption(){
    $conn = dbConnection();
    $sql_getVariants = 'SELECT * FROM `variants`';
    $result_getVariants = $conn->query($sql_getVariants);
    $fetch_getVariants = $result_getVariants->fetch_all(MYSQLI_ASSOC);
    foreach($fetch_getVariants as $variant){
        $variant =  $variant['variant'];
        echo '<option value = "'.$variant.'">'.$variant.'</option>';
    }
}

echo $_POST['com'];
if($_POST['com'] == 'addProduct'){
    echo 'ewqeqweqwer32r3223r23r23r23r32r234e543535345345435353453453453534535353534535345353453453';
    if(isset($_POST['productCode'])){
        $conn = dbConnection();
        $name = $_POST['productName'];
        $code = $_POST['productCode'];
        $status = $_POST['productStatus'];
        $price = $_POST['productPrice'];
        $tax = $_POST['productTax'];
        $stock = $_POST['productStock'];
        $mainCategorie = $_POST['productMainCategorie'];
        $subCategorie = $_POST['productSubCategorie'];
        $markas = $_POST['productMarkas'];
        $barcode = $_POST['productBarcode'];
        $discount = $_POST['productDiscount'];
        $desi = $_POST['productDesi'];
        $desc = $_POST['productDescription'];
        $specs = $_POST['productSpecs'];
        $variantNames = $_POST['variantNames'];
        $variantValues = $_POST['variantValues'];
        $sizeNames = $_POST['sizeNames'];
        $sizeStocks = $_POST['sizeStockValues'];
        $vi = 0;
        $vs = 0;
        
        foreach($sizeNames as $sName){
            $name;
            $value =  $sizeStocks[$vs];
            $sql_addSizes = 'INSERT INTO `productSizes` (productCode,size,stock) VALUES ("'.$code.'","'.$sName.'","'.$value.'")';
            $result_addSizes = $conn->query($sql_addSizes);
            if ($result_addSizes){
                $vs = $vs + 1;
            }
            
            
        }
        foreach($variantNames as $vName){
            $name;
            $value =  $variantValues[$vi];
            $sql_addVariants = 'INSERT INTO `productVariants` (productCode,variantName,variantValue) VALUES ("'.$code.'","'.$vName.'","'.$value.'")';
            $result_addVariants = $conn->query($sql_addVariants);
            if ($result_addVariants){
                $vi = $vi + 1;
            }
            
            
        }
    
        
        $sql_addProduct = 'INSERT INTO `product` (label,code,productStatus,price,tax,stock,mainCategorie,subCategorie ,marka,barcode,discount,desi,description) VALUES ("'.$name.'","'.$code.'","'.$status.'","'.$price.'","'.$tax.'","'.$stock.'","'.$mainCategorie.'","'.$subCategorie.'","'.$markas.'","'.$barcode.'","'.$discount.'","'.$desi.'","'.$desc.'")';
        $result_addProduct = $conn->query($sql_addProduct);
        
        if($result_addProduct){
                foreach($specs as $spec){
                    $sql_addSpecs = 'INSERT INTO `productSpecs` (productCode,specid) VALUES ("'.$code.'","'.$spec.'")';
                    $result_addSpecs = $conn->query($sql_addSpecs);
                    if($result_addSpecs){
                        
                    }
            
                }
            
            
            
        
            $target_dir = "../photos/";
            mkdir($target_dir . $_POST['productCode'],0755,true);
            $a = 0;
            foreach($_FILES['files']['name'] as $file){
        
                $sql_addImage = 'INSERT INTO `productPhotos` (productCode,productImg) VALUES ("'.$code.'","'.basename($_FILES["files"]["name"][$a]) .'" )';
                $result_addImage = $conn->query($sql_addImage);
                if($result_addImage){
                
                    $target_file = $target_dir .$_POST['productCode'].'/'. basename($_FILES["files"]["name"][$a]);
                    move_uploaded_file($_FILES["files"]["tmp_name"][$a], $target_file);
                    $a = $a + 1;
                }
                
            }
        }
        
    }
    
}
        

    



function getSpecs($hidden){
    $conn = dbConnection();
    $sql_getSpecs ='SELECT * FROM `specs`';
    $result_getSpecs =$conn->query($sql_getSpecs);
    $fetch_getSpecs = $result_getSpecs->fetch_all(MYSQLI_ASSOC);
    if($result_getSpecs){
        if($hidden){
            echo '<div  style = "display:none">';
            
            foreach($fetch_getSpecs as $spec){
                echo '<div id = "'.$spec['id'].'" ><div  class = "product-spec" style = "padding:15px;background:rgba(64,64,64,0.5)"><img style = "margin-bottom:-7px;margin-right:3px;width:25px;height:25px;" src = "../specs/'.$spec['img'].'"> '.$spec['id'].' <button style ="width:100px;float:right;" class = "remove-spec-added"> Kaldır </button> </div></div>';
            }
            
            echo '</div>';
        }else{
            foreach($fetch_getSpecs as $spec){
                echo '<div  style = "background:rgba(64,64,64,0.5);margin:5px;padding:15px;"><img style = "margin-bottom:-7px;margin-right:3px;width:25px;height:25px;" src = "../specs/'.$spec['img'].'"> '.$spec['id'].' <button value ="'.$spec['id'].'" style ="width:100px;float:right;" class = "remove-spec"> Kaldır </button> </div>';
            }
        }
        
    }
}

function getSpecsOptions(){
    $conn = dbConnection();
    $sql_getSpecs ='SELECT * FROM `specs`';
    $result_getSpecs =$conn->query($sql_getSpecs);
    $fetch_getSpecs = $result_getSpecs->fetch_all(MYSQLI_ASSOC);
    if($result_getSpecs){

        foreach($fetch_getSpecs as $specOP){
            echo '<option value = "'.$specOP['id'].'">'.$specOP['id'].'</option>';
        }
        
    }
}




if($_GET['com'] == 'removeSpec'){
    $specId = $_GET['specid'];
    $sql_removeSpec = 'DELETE FROM `specs` WHERE id = "'.$specId.'"';
    $result_removeSpec = $conn->query($sql_removeSpec);
    if($result_removeSpec){
        echo 'ok';
    }
}




if($_GET['com'] == 'addSpecs'){
    $specId = $_GET['specid'];
    $specImg = $_GET['specImg'];
    $target_dir = "../specs/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
        move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
        $sql_addSpec = 'INSERT INTO `specs` (id,img) VALUES ("'.$specId.'", "'.$_FILES["file"]["name"].'")';
        $result_addSpec = $conn->query($sql_addSpec);
        if($result_addSpec){echo 'ok';}
        
        
        
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    
    
}


function getMainCategories(){
    $conn = dbConnection();
    $sql_getMainCategories = 'SELECT * FROM `mainCategories`';
    $result_getMainCategories = $conn->query($sql_getMainCategories);
    $fetch_getMainCategories = $result_getMainCategories->fetch_all(MYSQLI_ASSOC);

    if($result_getMainCategories){
        foreach($fetch_getMainCategories as $mainCat){
            $mainCat = $mainCat['categories'];
            echo '<option value = "'.$mainCat.'">'.$mainCat.'</option>';

        }
    }
}


function getSubCategories(){
    $conn = dbConnection();
    $sql_getMainCategories = 'SELECT * FROM `mainCategories`';
    $result_getMainCategories = $conn->query($sql_getMainCategories);
    $fetch_getMainCategories = $result_getMainCategories->fetch_all(MYSQLI_ASSOC);

    if($result_getMainCategories){
        foreach($fetch_getMainCategories as $mainCat){
            $mainCat = $mainCat['categories'];

            echo '<div style = "display:none;" id = "'.$mainCat.'">';
        
            $sql_getSubCategories = 'SELECT * FROM `subCategories` WHERE mainCategorie = "'.$mainCat.'"';
            $result_getSubCategories = $conn->query($sql_getSubCategories);
            $fetch_getSubCategories = $result_getSubCategories->fetch_all(MYSQLI_ASSOC);
            foreach($fetch_getSubCategories as $subCat){
                $subCat = $subCat['subCategorie'];
                if(strlen($subCat) == 0){}else{
                    
                    echo '<option value = "'.$subCat.'">'.$subCat.'</option>';
                }
            }

            echo '</div>';
        }
    }
}


function getMarkas(){
    $conn = dbConnection();
    $sql_getMainCategories = 'SELECT * FROM `mainCategories`';
    $result_getMainCategories = $conn->query($sql_getMainCategories);
    $fetch_getMainCategories = $result_getMainCategories->fetch_all(MYSQLI_ASSOC);

    if($result_getMainCategories){
        foreach($fetch_getMainCategories as $mainCat){
            $mainCat = $mainCat['categories'];

            
            $sql_getSubCategories = 'SELECT * FROM `subCategories` WHERE mainCategorie = "'.$mainCat.'"';
            $result_getSubCategories = $conn->query($sql_getSubCategories);
            $fetch_getSubCategories = $result_getSubCategories->fetch_all(MYSQLI_ASSOC);
            foreach($fetch_getSubCategories as $subCat){
                $subCat = $subCat['subCategorie'];
                
                if(strlen($subCat) == 0){}else{
                    echo '<div style = "display:none;" id = "'.$subCat.'">';
                    $sql_getMarkas = 'SELECT * FROM `markas` WHERE subCategorie = "'.$subCat.'" ';
                    $result_getMarkas = $conn->query($sql_getMarkas);
                    $fetch_getMarkas = $result_getMarkas->fetch_all(MYSQLI_ASSOC);
                    foreach($fetch_getMarkas as $marka){
                        $marka = $marka['marka'];
                        if(strlen($marka)==0){}else{
                            
                            echo '<option value = "'.$marka.'">'.$marka.'</option>';
                        }
                    }
                    echo '</div>';  
                }
            }

            
        }
    }
}



?>

    <div class = "product-menu">
        <button id = "products-button">Ürünler</button>
        <button id = "add-product-button">Ürün Ekle</button>
        <button id = "product-specs-button">Ürün Özelliği</button>
        <button id = "add-variant-button">Seçenekler</button>
        <button id = "add-product-size">Bedenler</button>
    </div>
    
    
<div id = "main-page" class = "main-page">

    
    
    <div id = "product-add" class = "product-add">
        <h2>Ürün Ekle</h2>
        <p>Ürün ismi : <input type = "text" id = "product-name"> </p>
        <p>Ürün Kodu<text style = "font-size:10px">  (Boş ise kendisi otomatik atar)<text> : <input id = "product-id" type = "text"> </p>
        <p>Ürün Durumu : <select id = "product-status"><option value = "active">Aktif</option><option value = "passive">Pasif</option></select></p>
        <p>Ürün Fiyatı : <input type = "number" id = "product-price"> </p>
        <p>Vergi (%999) : <input id = "tax" type = "number" > </p>
        <p>Adet : <input type ="number" id = "product-quantity"></p>
        <p>Kategori : <select id = "mainCategories"> <?php getMainCategories();?></select></p>
        <p >Alt Kategori : <select id = "subCategories" > </select></p>
        <?php getSubCategories();?>
        <p>Marka : <select id = "markas"></select></p>
        <?php getMarkas();?>
        <p>Barkod : <input id ="barcode" type = "text"></p>
        <p>İndirim (%999) : <input maxlength = "3" id = "discount" type = "number"></p>
        <p>Desi : <input id = "desi" type = "number"> </p>
        <div style="background:rgba(150,130,150,1);min-height:250px;margin:5px;" id = "added-photos" class = "added-photos"><h2 style = "margin-top:3px;padding:3px;padding-top:15px;">Fotoğraflar</h2><p>Fotoğraflar : <input id = "product-photo-input" type = "file" multiple> </p>
        <div id = "photo-showcase" class = "photo-showcase"></div>
    </div>
        <div style="background:rgba(150,130,150,1);min-height:250px;margin:5px;padding:10px;" id = "added-specs" class = "added-specs"><h2 style = "margin-top:0px;padding:3px">Özellikler</h2><p style = "padding:20px;">Özellik : <button id = "add-spec-product" style = "padding:5px;float:right;margin-left:10px;">Ekle</button><select id ="spec" style = "height:25px;"><?php getSpecsOptions();?></select></p><?php getSpecs($hidden=true)?></div>
        <div style="background:rgba(150,130,150,1);min-height:250px;margin:5px;padding:10px;" id = "added-variants" class = "added-variants"><h2 style = "margin-top:0px;padding:3px">Seçenekler</h2><p style = "padding:20px">Seçenek : <button id = "add-variant-product" style = "padding:5px;margin-left:10px;margin-right:10px;float:right;">Ekle</button><select style = "height:25px;" id = "product-variants"><?php getVariantsAsOption();?></select></p><div id = "added-variants-case"></div></div>
        
        
        
        <div style="background:rgba(150,130,150,1);min-height:250px;margin:5px;padding:10px;" id = "add-size" class = "add-size">
            <h2 style = "margin-top:0px;padding:3px">Beden</h2>
            <p style = "padding:20px">Bedenler : 
            <button id = "add-size-product" style = "padding:5px;margin-left:10px;margin-right:10px;float:right;">Ekle</button>
            <select style = "height:25px;" id = "product-sizes"><?php getSizesAsOption();?></select></p>
            <div id = "added-sizes">
                <div><h3 style="border:solid 0px black;border-right-width:1px;text-align:center;width:49%;display:inline-block;border-bottom-width:1px">Beden</h3><h3 style = "border:solid 0px black;border-bottom-width:1px;text-align:center;display:inline-block;width:50%;">Stok</h3></div>
            </div>
        </div>
            
            
            
            
            
        <p style = "height:110px;">Açıklama : <textarea id ="description" style = "float:right;min-height:100px;min-width:500px;max-width:700px;max-height:200px;"> </textarea></p><?php getSubCategories();getMarkas();?>
        <button id ="save-product" style = "height:35px;width:100%">Kaydet </button>
    </div>
   
    <div style = "display:none;" id = "add-specs" class = "add-specs">
        <h2>Ürün Özelliği Ekle</h2>
        <p>Özellik : <input id = "spec-id" type = "text"></p>
        <p>Fotoğraf : <input id ="spec-file-input" type = "file"> </p>
        <h2>Önizleme</h2>
        <div class = "review-spec"><img id = "review-spec-img" style = "width:25px;height:25px;" src = "../specs/free-delivery.png"> <h7 id = "review-spec-h7">  Bedava Kargo </h7></div>
        <button id = "spec-add-button"> Ekle </button>
        <hr>
        <div class = "all-specs"><h2>Bütün Özellikler</h2><?php getSpecs($hidden=false); ?> </div>
    </div>
    
    
    <style>
    .add-variant{background:rgba(16,16,16,1);padding:10px;margin:10px;}
    .add-variant h2{text-align:center;color:white;}
    .add-variant p{color:white;margin:10px;background:rgba(64,64,64,0.5);padding:15px;}
    .add-variant input{width:250px;float:right;}
    .add-variant button{width:200px;margin:auto;display:block;height:40px;}
    </style>
       
    <div id = "add-variant" class = "add-variant" style ="display:none;">
        <h2>Seçenek Ekle</h2>
        <p>Seçenek İsmi : <input id = "variant" placeholder ="Seçenek" type = "text"></p>
        <button id = "add-product-variant-button">Ekle</button>
    <hr>
    <div class = "variants"><h2>Seçenekler</h2><?php getVariants();?></div></div>
    
    
    
        <div style = "display:none;" id = "products" class = "products">
            <div class = "search-product">
            <div class = "search-input"> <img src = "../imgs/loupe.png"><input id = "searching-input" type = "text" placeholder = "Arama">
            
            <select id = "searching-select-input">
                <option value = "Ürün Kodu">Ürün Kodu :</option>
                <option value = "Etiket İsmi">Etiket İsmi :</option>
                <option value = "Durum">Durum :</option>
                <option value = "Fiyat">Fiyat :</option>
                <option value = "Vergi">Vergi :</option>
                <option value = "Stok">Stok :</option>
                <option value = "Ana Kategori">Ana Kategori :</option>
                <option value = "Alt Kategori">Alt Kategori :</option>
                <option value = "Barkod">Barkod :</option>
                <option value = "İndirim">İndirim :</option>
                <option value = "Desi">Desi :</option>
                <option value = "Açıklama">Açıklama :</option>
            </select>
            </div>
            </div>
            
            <?php getProducts();?>
        </div>
            
            
            
            <style>
            .sizes {background:rgba(16,16,16,1);color:white;padding:20px;margin-top:10px;}
            .sizes h2{text-align:center;}
            .sizes p{background:rgba(64,64,64,1);padding:15px;font-size:20px;}
            .sizes input{float:right;height:15px;width:80%;padding:5px;border-radius:3px;margin-top:-3px;}
            .sizes button{width:100%;height:35px;}
            .all-sizes button{float:right;width:25%;height:100%;padding:5px;margin-top:-5px;}
            .all-sizes p{text-align:center;}
            .all-sizes {margin-top:50px;}
            </style>
        <div style = "display:none" id = "sizes" class = "sizes">
           <h2>Beden Ekle</h2>
           <p>Beden ismi : <input type = "text" id = "add-size-input" placeholder= "S/M/L/XL/32/33/34 etc..."> </p>
           <button id = "add-size-button">Ekle</button>
           
           
           <div id = "all-sizes" class = "all-sizes">
               <hr style = "margin-top:10px">
               <h2>Bedenler</h2>
               <?php getSizes();?>
           </div>
           
            
            
        </div>  
            
            
            
            
            
            
            
            
            
            
            
    </div>
    
    
    
    
    
    

     
    
    
    
    
    
    <script>
    
    var productSizesRemoveButtons = document.getElementsByClassName('product-size-remove-button')
    for(ir=0;ir<productSizesRemoveButtons.length;ir++){
        productSizesRemoveButtons[ir].onclick = function(){
            var productCode = this.getAttribute('code');
            var sizeName = this.getAttribute('size-value');
            var self = this
            xmlhttp = new XMLHttpRequest();
            form = new FormData();
            form.append('com','removeProductSize')
            form.append('productCode',productCode)
            form.append('sizeName',sizeName)
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    var productSizeDivParent =  self.parentElement
                    productSizeDivParent.parentElement.remove();
                    loaded();
                }
            }
            xmlhttp.open('POST','product.php')
            xmlhttp.send(form)
            loading()
        

        }
    }
    
    var addProductSize = document.getElementsByClassName('product-size-add-button')
    for(i=0;i<addProductSize.length;i++){
        addProductSize[i].onclick = function(){
            var productCode = this.getAttribute('code');
            var sizeName = document.getElementById(productCode+'-size-add-input-name').value
            var sizeStock = document.getElementById(productCode+'-size-add-input-value').value
            var productAllSizes = document.getElementById(productCode+'-all-sizes')
            var productSizesRemoveButtons = document.getElementsByClassName('product-size-remove-button')
            xmlhttp = new XMLHttpRequest();
            form = new FormData();
            form.append('com','addSizeProduct')
            form.append('sizeName',sizeName)
            form.append('sizeStock',sizeStock)
            form.append('productCode',productCode);
            xmlhttp.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    for(ir=0;ir<productSizesRemoveButtons.length;ir++){
                        if(productSizesRemoveButtons[ir].getAttribute('size-value')==sizeName){
                           var productSizeDivParent =  productSizesRemoveButtons[ir].parentElement
                           productSizeDivParent.parentElement.remove();
                        }
                    }

                    var newSizeDiv = document.createElement('div')
                    newSizeDiv.setAttribute('style','margin:5px;padding:1px;background:rgba(180,180,180,0.2)')
                    newSizeDiv.setAttribute('class' , 'product-sizes-tr')
                    var newSizeP = document.createElement('p')
                    newSizeP.style.margin = '8px';
                    newSizeP.setAttribute('class','product-sizes-td')
                    newSizeP.innerHTML = sizeName +' : ' + sizeStock;
                    var newSizeButton = document.createElement('button')
                    newSizeButton.setAttribute('size-value',sizeName)
                    newSizeButton.setAttribute('code',productCode)
                    newSizeButton.setAttribute('class','product-size-remove-button')
                    newSizeButton.setAttribute('style','width:20%;float:right;')
                    newSizeButton.innerHTML = 'Kaldır';
                    newSizeP.appendChild(newSizeButton)
                    newSizeDiv.appendChild(newSizeP)
                    productAllSizes.appendChild(newSizeDiv)
                    
                    
                    loaded();
                }
            }
            xmlhttp.open('POST','product.php')
            xmlhttp.send(form)
            loading();
            
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    var addSizeButton = document.getElementById('add-size-product')
    
    addSizeButton.onclick = function(){
        var sizesValue = document.getElementById('product-sizes').value
        var addingSizeDiv = document.getElementById('added-sizes')
        var aSizeProductInput = document.createElement('input')
        aSizeProductInput.setAttribute('class','size-stock-value')
        aSizeProductInput.setAttribute('size-name',sizesValue)
        var aSizeProductRemoveButton = document.createElement('button')
        aSizeProductRemoveButton.innerHTML = 'Kaldır'
        aSizeProductRemoveButton.style.float = 'right'
        aSizeProductRemoveButton.style.marginTop = '-5px'
        aSizeProductRemoveButton.style.marginLeft = '5px'
        aSizeProductRemoveButton.style.padding = '5px'
        aSizeProductRemoveButton.onclick = function(){this.parentElement.remove();}
        aSizeProductP = document.createElement('p')
        aSizeProductP.innerHTML = sizesValue;
        aSizeProductP.setAttribute('style','text-align:center')
        
        aSizeProductInput.setAttribute('type','number')
        aSizeProductInput.style.width = '40%'
        aSizeProductP.appendChild(aSizeProductRemoveButton)
        aSizeProductP.appendChild(aSizeProductInput)
        
        addingSizeDiv.appendChild(aSizeProductP)
        
        
        
    }
    
    
    
    
function removeSizesButtons(){
    var removeSizeButtons = document.getElementsByClassName('remove-size')
    
    for(i=0;i<removeSizeButtons.length;i++){
        removeSizeButtons[i].onclick = function(){
            var sizeValue = this.getAttribute('value')
            var self = this
            xmlhttp = new XMLHttpRequest();
            form = new FormData();
            form.append('com' , 'removeSize')
            form.append('sizeValue',sizeValue)
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    loaded();
                    self.parentElement.remove();
                }
            }
        
            xmlhttp.open('POST', 'product.php')
            xmlhttp.send(form)
            loading();
            
        }
    }
}
removeSizesButtons();


    var allSizes = document.getElementById('all-sizes')
    var addSizeButton = document.getElementById('add-size-button')
    addSizeButton.onclick = function(){
        var sizeValue = document.getElementById('add-size-input').value
        xmlhttp = new XMLHttpRequest();
        form = new FormData();
        form.append('com' , 'addSize')
        form.append('sizeValue',sizeValue)
        
        xmlhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                var aSize = document.createElement('p')
                aSize.innerHTML = sizeValue
                var aSizeRemoveButton = document.createElement('button')
                aSizeRemoveButton.setAttribute('value',sizeValue)
                aSizeRemoveButton.setAttribute('class','remove-size')
                aSizeRemoveButton.innerHTML = 'Kaldır'
                aSize.appendChild(aSizeRemoveButton)
                allSizes.appendChild(aSize);
                loaded();
                removeSizesButtons();
            }
        }
        
        xmlhttp.open('POST', 'product.php')
        xmlhttp.send(form)
        loading();
        
        
        
    }
    
    var productsP = document.getElementsByClassName('product-column-value-p')
    for (i=0;i<productsP.length;i++){
        productsP[i].ondblclick = function(){
            var productPmain = this
            var parentProductP = this.parentElement;
            var productCode = this.getAttribute('code')
            var productType = this.getAttribute('product')
            var changeInput = document.createElement('input')
            if(productType == 'mainCategorie'){
                changeInput = '';
                changeInput = document.createElement('select')
                changeInput.innerHTML = '"+<?php getMainCategories();?>;+"'
                
            }
            if(productType == 'subCategorie'){
                changeInput = '';
                changeInput = document.createElement('select')
                changeInput.innerHTML = '"+<?php getSubCategories();?>;+"'
            
                
            }
            if(productType == 'marka'){
                changeInput = '';
                changeInput = document.createElement('select')
                changeInput.innerHTML = '"+<?php getMarkas();?>;+"'
            }
            
            if(productType == 'status'){
                changeInput = '';
                changeInput = document.createElement('select')
                changeInput.innerHTML = '<option value = "Aktif">Aktif</option><option value = "Pasif">Pasif</option>'
            
                
            }
            
            
            
            
            
            changeInput.setAttribute('placeholder',productCode)
            changeInput.value = this.innerHTML
            changeInput.setAttribute('style','margin:10px;padding:3px;')
            parentProductP.replaceChild(changeInput,this); 
            
            
            
            
            changeInput.onchange = function(){
                var changedInput = this
                var changedInputValue = this.value
                var form = new FormData()
                form.append('com','changeProduct'+productType)
                form.append('productCode',productCode)
                form.append('productType',productType)
                form.append('newValue' , this.value)
                
                xmlhttp = new XMLHttpRequest();
                
                xmlhttp.onreadystatechange = function(){
                    

                    if(this.readyState == 4 && this.status == 200){
                        if(productType == 'code'){
                            
                            productPmain.setAttribute('code',changedInputValue)
                            productPmain.innerHTML = changedInputValue;
                            parentProductP.replaceChild(productPmain,changedInput); 
                            loaded();
                        }
                        
                        productPmain.innerHTML = changedInputValue;
                        parentProductP.replaceChild(productPmain,changedInput); 
                        loaded();


                        
                    }
                }

                xmlhttp.open('POST', 'product.php')
                xmlhttp.send(form)
                loading();
                console.log('changeProduct'+productType)
                
            }
        }
    }
    
    
    
    
    var search = document.getElementById('searching-input')
    search.onchange = function(){
        var word = this.value;
        var searching = document.getElementById('searching-select-input').value
        var allProducts = document.getElementsByClassName('column-ps')
        for(i=0;i<allProducts.length;i++){
            if(word == ''){allProducts[i].style.display = 'block';}
            var productCodes = allProducts[i].getElementsByTagName('p')[1].innerHTML
            var productLabels = allProducts[i].getElementsByTagName('p')[3].innerHTML
            var productStatus = allProducts[i].getElementsByTagName('p')[5].innerHTML
            var productPrices = allProducts[i].getElementsByTagName('p')[7].innerHTML
            var productTaxes = allProducts[i].getElementsByTagName('p')[9].innerHTML
            var productStocks = allProducts[i].getElementsByTagName('p')[11].innerHTML
            var productMainCategories = allProducts[i].getElementsByTagName('p')[13].innerHTML
            var productSubCategories = allProducts[i].getElementsByTagName('p')[15].innerHTML
            var productMarkas = allProducts[i].getElementsByTagName('p')[17].innerHTML
            var productBarcodes = allProducts[i].getElementsByTagName('p')[19].innerHTML
            var productDiscounts = allProducts[i].getElementsByTagName('p')[21].innerHTML
            var productDesies = allProducts[i].getElementsByTagName('p')[23].innerHTML
            var productDescriptions = allProducts[i].getElementsByTagName('p')[25].innerHTML
            allProducts[i].style.display = 'none';
            if(searching == 'Ürün Kodu'){
                if(productCodes.search(word)>-1){
                    allProducts[i].style.display = 'block';
                }
            }else if (searching == 'Etiket İsmi'){
                console.log(word)
                if(productLabels.search(word)>-1){
                allProducts[i].style.display = 'block';
                }
            }else if (searching == 'Durum'){
                if(productStatus.search(word)>-1){
                allProducts[i].style.display = 'block';
                }
            }else if (searching == 'Fiyat'){
                if(productPrices.search(word)>-1){
                allProducts[i].style.display = 'block';
                }
            }else if (searching == 'Vergi'){
                if(productTaxes.search(word)>-1){
                allProducts[i].style.display = 'block';
                }
            }else if (searching == 'Stok'){
                if(productStocks.search(word)>-1){
                allProducts[i].style.display = 'block';
                }
            }else if (searching == 'Ana Kategori'){
                if(productMainCategories.search(word)>-1){
                allProducts[i].style.display = 'block';
                }
            }else if (searching == 'Alt Kategori'){
                if(productSubCategories.search(word)>-1){
                allProducts[i].style.display = 'block';
                }
            }else if (searching == 'Marka'){
                if(productMarkas.search(word)>-1){
                allProducts[i].style.display = 'block';
                }
            }else if (searching == 'Barkod'){
                if(productBarcodes.search(word)>-1){
                allProducts[i].style.display = 'block';
                }
            }else if (searching == 'İndirim'){
                if(productDiscounts.search(word)>-1){
                allProducts[i].style.display = 'block';
                }
            }else if (searching == 'Desi'){
                if(productDesies.search(word)>-1){
                allProducts[i].style.display = 'block';
                }
            }else if (searching == 'Açıklama'){
                if(productDescriptions.search(word)>-1){
                allProducts[i].style.display = 'block';
                }
            }
            
            
        }
        
    }
    
    
    
    var removeProductButtons = document.getElementsByClassName('remove-product-button')
    
    for(i=0;i<removeProductButtons.length;i++){
        removeProductButtons[i].onclick = function(){
            var productCode = this.getAttribute('code')
            form = new FormData();
            form.append('productCode',productCode)
            form.append('com','removeProduct')
            xmlhttp = new XMLHttpRequest();
            var button = this
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    document.getElementById(button.getAttribute('code')).remove();
                    loaded();
                    
                }
            }
            xmlhttp.onloadend = function(){console.log(this.status)}
            xmlhttp.open('POST','product.php')
            xmlhttp.send(form)
            loading()
        }
    }
    
    
    
    
    
    
    
    
    var addImageToProductButtons  = document.getElementsByClassName('add-product-image-input')
    
    for (i=0;i<addImageToProductButtons.length;i++){
        addImageToProductButtons[i].onchange = function(){
            var imgShow = document.getElementById(this.getAttribute('code')+'-img-show');
            imgShow.src = URL.createObjectURL(this.files[0])
        }
    }
        
    
    
    
    
    var addImageProductButtons = document.getElementsByClassName('add-product-image-button')
    for(i=0;i<addImageProductButtons.length;i++){
        addImageProductButtons[i].onclick = function(){
            var productCode = this.getAttribute('code');
            var imageFile = document.getElementById(productCode+'-image-input').files[0];
            xmlhttp = new XMLHttpRequest();
            form = new FormData();
            form.append('com' , 'addImageToProduct')
            form.append('productCode',productCode)
            form.append('files',imageFile)
            
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    var allImages = document.getElementById(productCode + '-all-imgs')
                    var imageHolder = document.createElement('div');
                    imageHolder.setAttribute('style','padding:5px;background:rgba(16,16,16,0.2);margin:5px;display:inline-block;');
                    imageHolder.setAttribute('class' , 'product-img-td');
                    var image = document.createElement('img')
                    image.setAttribute('style','display:block;margin:auto;width:100px;height:100px;');
                    image.src = URL.createObjectURL(imageFile)
                    var button = document.createElement('button')
                    button.innerHTML = 'Kaldır';
                    button.setAttribute('class', 'remove-product-photo-button')
                    button.setAttribute('img-name', imageFile.name)
                    button.setAttribute('img-link' , URL.createObjectURL(imageFile))
                    button.setAttribute('code' , productCode)
                    button.setAttribute('style' , 'display:block;margin-top:8px;width:100px')
                    imageHolder.appendChild(image)
                    imageHolder.appendChild(button)
                    allImages.appendChild(imageHolder)
                    removeProductsPhotoButtons();
                    loaded();
                    
                }
            }
            
            xmlhttp.open('POST','product.php')
            xmlhttp.send(form)
            loading();
        }
    }
    
    
    
    function removeProductsPhotoButtons(){
    var removeProductPhotoButtons = document.getElementsByClassName('remove-product-photo-button')

        for(i=0;i<removeProductPhotoButtons.length;i++){
            removeProductPhotoButtons[i].onclick = function(){
                var productCode = this.getAttribute('code')
                var imageName = this.getAttribute('img-name')
                var imageLink = this.getAttribute('img-link')
                xmlhttp = new XMLHttpRequest();
                form = new FormData();
                form.append('productCode' ,productCode)
                form.append('imgName',imageName)
                form.append('imgLink',imageLink)
                form.append('com','removePhotoFromProduct')
                var button = this
                xmlhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        button.parentElement.remove();
                        loaded();
                        
                    }
                }
                xmlhttp.open('POST' , 'product.php')
                xmlhttp.send(form);
                loading();
                
            }
            
            
        }
        
    }
    removeProductsPhotoButtons();
    
    var productVariantAddButtons = document.getElementsByClassName('product-variant-add-button')
    
    for(i=0;i<productVariantAddButtons.length;i++){
        productVariantAddButtons[i].onclick = function(){
            var productAddVariantCode = this.getAttribute('code')
            var variantNameToAdd = document.getElementById(productAddVariantCode+'-variant-add-input-name').value;
            var variantValueToAdd = document.getElementById(productAddVariantCode+'-variant-add-input-value').value;
            xmlhttp = new XMLHttpRequest();
            form = new FormData();
            form.append('com','variantAddToProduct')
            form.append('productCode',productAddVariantCode)
            form.append('variantName',variantNameToAdd)
            form.append('variantValue',variantValueToAdd);
            var button = this
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    var allVariantsDiv = document.getElementById(productAddVariantCode+'-all-variants')
                    var mainDivVariant = document.createElement('div');
                    mainDivVariant.setAttribute('class','product-variant-tr');
                    mainDivVariant.setAttribute('style', 'margin:5px;padding:1px;background:rgba(180,180,180,0.2)')
                    mainVariantP = document.createElement('p')
                    mainVariantP.setAttribute('style','margin:8px')
                    mainVariantP.setAttribute('class','product-variant-td')
                    mainVariantP.innerHTML = variantNameToAdd + ' : ' + variantValueToAdd ;
                    var mainVariantButton = document.createElement('button')
                    mainVariantButton.setAttribute('variant-value',variantValueToAdd)
                    mainVariantButton.setAttribute('code',productAddVariantCode)
                    mainVariantButton.setAttribute('class','product-variant-remove-button')
                    mainVariantButton.innerHTML = 'Kaldır';
                    mainDivVariant.appendChild(mainVariantP)
                    mainVariantP.appendChild(mainVariantButton);
                    allVariantsDiv.appendChild(mainDivVariant);
                    productVariantsRemoveButtons();
                    loaded();
                }
            }
            xmlhttp.open('POST','product.php');
            xmlhttp.send(form);
            loading();
        }
    }




    function productVariantsRemoveButtons(){
        var productVariantRemoveButtons = document.getElementsByClassName('product-variant-remove-button')
        for(i=0;i<productVariantRemoveButtons.length;i++){
            productVariantRemoveButtons[i].onclick = function(){
                var productCodeRemoveVariant = this.getAttribute('code');
                var productVariantValue = this.getAttribute('variant-value')
                
                xmlhttp = new XMLHttpRequest();
                var form = new FormData();
                form.append('com','variantRemoveFromProduct');
                form.append('productCode',productCodeRemoveVariant);
                form.append('variantValue',productVariantValue);
                var button = this
                xmlhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        button.parentElement.remove();
                        loaded();
                    }
                }
                xmlhttp.open('POST','product.php');
                xmlhttp.send(form);
                loading();
            }
        }
    }
    
    productVariantsRemoveButtons();
    
    
    
    var productSpecAddButtons = document.getElementsByClassName('product-spec-add-button')
    for(i=0;i<productSpecAddButtons.length;i++){
        productSpecAddButtons[i].onclick = function(){
            var productCodeSpecAdd = this.getAttribute('code');
            var productSpecSelectInputValue = document.getElementById(productCodeSpecAdd+'-add-spec').value
            xmlhttp = new XMLHttpRequest();
            var form = new FormData();
            form.append('com' , 'specAddToProduct')
            form.append('specId',productSpecSelectInputValue)
            form.append('productCode',productCodeSpecAdd)
            
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    var productSpecsDiv = document.getElementById(productCodeSpecAdd+'-all-specs')
                    var mainSpecP = document.createElement('p')
                    mainSpecP.setAttribute('style','padding:10px;margin:5px; background:rgba(222,222,222,0.1)');
                    mainSpecP.innerHTML = productSpecSelectInputValue;
                    var mainSpecButton = document.createElement('button');
                    mainSpecButton.setAttribute('spec-id',productSpecSelectInputValue)
                    mainSpecButton.setAttribute('code',productCodeSpecAdd);
                    mainSpecButton.setAttribute('class', 'product-spec-remove-button')
                    mainSpecButton.innerHTML = 'Kaldır';
                    mainSpecP.appendChild(mainSpecButton)
                    productSpecsDiv.appendChild(mainSpecP)
                    productSpecRemoveButton();
                    
                    loaded();

                }
                
            }
            
            xmlhttp.open('POST' , 'product.php')
            xmlhttp.send(form);
            loading();
        }
    }
    
    
    function productSpecRemoveButton(){
        var productSpecRemoveButtons =  document.getElementsByClassName('product-spec-remove-button')
        for(i=0;i<productSpecRemoveButtons.length;i++){
            productSpecRemoveButtons[i].onclick = function(){
                var code = this.getAttribute('code');
                var specid = this.getAttribute('spec-id')
                var form = new FormData();
                xmlhttp = new XMLHttpRequest();
                form.append('com' , 'specRemoveFromProduct')
                form.append('productCode' ,code)
                form.append('specId' , specid)
                var button = this
                xmlhttp.onreadystatechange = function(){if(this.readyState == 4 && this.status == 200){
                    button.parentElement.remove();
                    loaded();
                }}
                
                xmlhttp.open('POST','product.php')
                xmlhttp.send(form)
                loading();
                
                
            }
        }
    }
    productSpecRemoveButton();
    
    
    
    
    
    
    var showHideVariants = document.getElementsByClassName('product-variants-showHide-button');
    for(i=0;i<showHideVariants.length;i++){
    showHideVariants[i].onclick = function(){
            var code = this.getAttribute('code');
            variantBody = document.getElementById(code+'-variants')
            if(variantBody.style.display == 'none'){
                variantBody.style.display = 'block';
                
            }else{
                variantBody.style.display = 'none';
            }
        }
    }
    
    var showHideSizes = document.getElementsByClassName('product-sizes-showHide-button');
    
    for(i=0;i<showHideSizes.length;i++){
    showHideSizes[i].onclick = function(){
            var code = this.getAttribute('code');
            sizesBody = document.getElementById(code+'-sizes')
            if(sizesBody.style.display == 'none'){
                sizesBody.style.display = 'block';
                
            }else{
                sizesBody.style.display = 'none';
            }
        }
    }
    
    var showHidePhotos = document.getElementsByClassName('product-photos-showHide-button');
    for(i=0;i<showHidePhotos.length;i++){
        showHidePhotos[i].onclick = function(){
            
            var code = this.getAttribute('code');
            photosBody = document.getElementById(code+'-imgs');
            if(photosBody.style.display == 'none'){
                photosBody.style.display = 'block';
            }else{
                photosBody.style.display = 'none';
            }
        }
    }
    
    var showHideSpecs = document.getElementsByClassName('product-specs-showHide-button')
    for(i=0;i<showHideSpecs.length;i++){
            
            showHideSpecs[i].onclick = function(){
                var code = this.getAttribute('code')
            specsBody = document.getElementById(code+'-specs')
            if(specsBody.style.display == 'none'){
                specsBody.style.display = 'block';
            }else{
                specsBody.style.display = 'none';
            }
        }
    }
    var addVariantButton = document.getElementById('add-variant-product')
    addVariantButton.onclick = function(){
        
        var productVariants = document.getElementById('product-variants').value
        var variantsCase = document.getElementById('added-variants-case')
        var addedVariant = document.createElement('p')
        addedVariant.setAttribute('class','all-variants');
        addedVariant.setAttribute('variant-id',productVariants);
        addedVariant.innerHTML = productVariants
        var addedVariantInput = document.createElement('input')
        addedVariant.appendChild(addedVariantInput)
        variantsCase.appendChild(addedVariant)
    }
    
    var addProductVariantButton = document.getElementById('add-product-variant-button')
    addProductVariantButton.onclick = function(){
        var variantType = document.getElementById('variant').value
        xmlhttp = new XMLHttpRequest();
        
        xmlhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                location.reload();
            }
        }
        
        form = new FormData();
        form.append('com','addVariant');
        form.append('variantType', variantType)
        xmlhttp.open('POST', 'product.php')
        xmlhttp.send(form)
        loading();
    
        
    }
    
    var removeVariantButton = document.getElementsByClassName('remove-variant-button')
    for(i=0;i<removeVariantButton.length;i++){
       removeVariantButton[i].onclick = function(){
           var removeVariantType =  this.getAttribute('variantId');
           var button = this
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    console.log('Removed')
                    button.parentElement.remove();
                    loaded();
                }
            }
            form = new FormData();
            form.append('com','removeVariant');
            form.append('variantType', removeVariantType)
            loading();
            xmlhttp.open('POST', 'product.php')
            xmlhttp.send(form)
        
           
        }
    }
    
    var photosGroup = [];
    
    
    function addedSpecsRemove(){
        var removeSpecButtons = document.getElementsByClassName('remove-spec-added')
        for(i=0;i<removeSpecButtons.length;i++){
            removeSpecButtons[i].setAttribute('buttonIndexRemoveSpec',i);
            removeSpecButtons[i].onclick = function(){
                this.parentElement.remove();
                
                                
            }
        }
    }
    
    document.getElementById('add-spec-product').onclick = function(){
        var selectedSpec = document.getElementById('spec').value;
        var selectedSpecDiv = document.getElementById(selectedSpec);
        selectedSpecDiv.setAttribute('specid' ,selectedSpec.value);
        var addedSpecs = document.getElementById('added-specs');
        var specDivRemoveButton = document.createElement('button')

        var specDiv = document.createElement('div')
        specDiv.setAttribute('specid', document.getElementById('spec').value)
        specDiv.setAttribute('class',"product-spec");
        specDiv.setAttribute('style','margin:3px;height:50px;')
        var specDivText = document.createElement('text')
        specDivText.innerHTML = document.getElementById('spec').value
        specDivRemoveButton.setAttribute('class','remove-spec-added')
        specDivRemoveButton.setAttribute('style','float:right;width:100px;');
        specDivRemoveButton.innerHTML = "Kaldır";
        var specImg = document.createElement('img')
        specImg.setAttribute('style', "margin-bottom:-7px;margin-right:3px;width:25px;height:25px;")
        console.log(selectedSpecDiv.getElementsByTagName('img')[0].src)
        specImg.src = selectedSpecDiv.getElementsByTagName('img')[0].src
        specDiv.appendChild(specImg)
        specDiv.appendChild(specDivText)
        specDiv.appendChild(specDivRemoveButton)
        addedSpecs.appendChild(specDiv)
        addedSpecsRemove();
        
    }
    
    
    
    
    var removeSpec = document.getElementsByClassName('remove-spec')
    for(i=0;i<removeSpec.length;i++){
        
            removeSpec[i].onclick = function(){
            
            var specId = this.value;
            specId = encodeURIComponent(specId);
            var button = this
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    button.parentElement.remove()
                    loaded();
                }
            }
            xmlhttp.open('GET' , 'product.php?com=removeSpec&specid='+specId+'');
            xmlhttp.send();
            loading();
        }
    }


    
    
    function specsReview(){
        var specImgInput = document.getElementById('spec-file-input');
        var specIdInput = document.getElementById('spec-id');
        
        specIdInput.onchange = function(){
            document.getElementById('review-spec-h7').innerHTML = this.value;
        }
        
        specImgInput.onchange = function(){
            specImg = URL.createObjectURL(specImgInput.files[0]);
            document.getElementById('review-spec-img').src = specImg;
            
            
        }
    }
    
    var specAddButton = document.getElementById('spec-add-button');
    specAddButton.onclick = function(){
        var specImgInput = document.getElementById('spec-file-input');
        var specIdInput = document.getElementById('spec-id');
        var formData = new FormData();
        
        formData.append('file',specImgInput.files[0])
        formData.append('specid',specIdInput.value)
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                alert('Eklendi');
                location.reload()

            }

        }
        xmlhttp.open('POST', 'product.php?com=addSpecs&specid='+specIdInput.value+'',true)
        xmlhttp.send(formData);
        loading();
    }
    

    
    function colorPhoto(){
        var colorPhotoInput = document.getElementById('product-photo-input')

            colorPhotoInput.onchange = function(){


                var colorNameInput = this.getAttribute('value')

                var photos = this.files
                
                
                var holder = document.createElement('div')
                holder.setAttribute('class','photo-holder')

                for(ii=0;ii<photos.length;ii++){
                    var photoUrl = URL.createObjectURL(photos[ii])
                    var div = document.createElement('div')
                    var imgs = document.createElement('img')
                    var buttn = document.createElement('button')
                    div.setAttribute('class', 'color-photo-holder')
                    imgs.src = photoUrl
                    buttn.style.width = '120px'
                    buttn.setAttribute('img-value',ii)
                    buttn.setAttribute('colorPhotoId',colorNameInput)
                    buttn.setAttribute('class','remove-photo')
                    buttn.innerHTML = 'Kaldır';
                    div.appendChild(imgs)
                    div.appendChild(buttn)
                    holder.appendChild(div)
                    document.getElementById('photo-showcase').appendChild(holder)
                    removePhotoButtons();
                    photosGroup.push(photos[ii])
                    

                    
                    
                    
                    
                }
               
                 
                console.log(photosGroup)
                
            }
    }


function removePhotoButtons(){
    var removePhotoButtons = document.getElementsByClassName('remove-photo')
    for(i=0;i<removePhotoButtons.length;i++){
        removePhotoButtons[i].onclick = function(){
            delete photosGroup[this.getAttribute('img-value')]
            
            this.parentElement.remove()
            console.log(photosGroup);   

            

            
        }
    }
}


        
    colorPhoto();
        
    
    var subCategorieOptions = document.getElementById(document.getElementById('mainCategories').value)
    console.log(subCategorieOptions)
    var subCategorie = document.getElementById('subCategories')
    subCategorie.innerHTML = subCategorieOptions.innerHTML;
    var mainCategoriesSelect = document.getElementById('mainCategories');
    mainCategoriesSelect.onchange = function(){
        var subCategorieOptions = document.getElementById(this.value)
        var subCategorie = document.getElementById('subCategories')
        subCategorie.innerHTML = subCategorieOptions.innerHTML;
        var markaOptions = document.getElementById(document.getElementById('subCategories').value)
        var markas = document.getElementById('markas')
        markas.innerHTML = markaOptions.innerHTML;
        
    }
    
    
    var markaOptions = document.getElementById(document.getElementById('subCategories').value)
    var markas = document.getElementById('markas')
    markas.innerHTML = markaOptions.innerHTML;
    var subCategoriesSelect = document.getElementById('subCategories');
    subCategoriesSelect.onchange = function(){
        var markaOptions = document.getElementById(this.value)
        var markas = document.getElementById('markas')
        markas.innerHTML = markaOptions.innerHTML;
        
    }
    
    
    var specsButton = document.getElementById('product-specs-button')
    var productAdd = document.getElementById('product-add');
    var specsDiv = document.getElementById('add-specs')
    var addVariant = document.getElementById('add-variant')
    var productsButton = document.getElementById('products-button')
    var products = document.getElementById('products')
    var sizes = document.getElementById('sizes')
    var sizesButton = document.getElementById('add-product-size')
    
    
    
    

    sizesButton.onclick = function(){
        productAdd.style.display = 'none';
        addVariant.style.display = 'none';
        specsDiv.style.display = 'none';
        
        
        if(sizes.style.display == 'none'){
            sizes.style.display = 'block';
        }else{
            sizes.style.display = 'none';
        }
    
        
    }
    
    
    
    productsButton.onclick = function(){
        productAdd.style.display = 'none';
        addVariant.style.display = 'none';
        specsDiv.style.display = 'none';
        sizes.style.display = 'none';
        if(products.style.display == 'none'){
            products.style.display = 'block';
        }else{
            products.style.display = 'none';
        }
    }
    
    
    
    specsButton.onclick = function(){
        sizes.style.display = 'none';
        productAdd.style.display = 'none';
        addVariant.style.display = 'none';
        products.style.display = 'none';
        
        if (specsDiv.style.display == 'none'){
            specsDiv.style.display = 'block';
            specsReview();
        }else{
            specsDiv.style.display = 'none';
        }

        
    }
    
    var addProductButton = document.getElementById('add-product-button')
    addProductButton.onclick = function(){
        sizes.style.display = 'none';
        specsDiv.style.display = 'none';
        addVariant.style.display = 'none';
        products.style.display = 'none';
        if(productAdd.style.display == 'none'){
            productAdd.style.display = "block";
        }else{
            productAdd.style.display = 'none';
        }
        
    }
    
    var addVariantButton = document.getElementById('add-variant-button')
        
    addVariantButton.onclick = function(){
        sizes.style.display = 'none';
        specsDiv.style.display = 'none';
        productAdd.style.display = 'none';
        products.style.display = 'none';
        if(addVariant.style.display == 'none'){
            addVariant.style.display = 'block';
        }else{
            addVariant.style.display = 'none';
        }
    }






    
    var saveButton = document.getElementById('save-product')
    saveButton.onclick = function(){
        
        formData = new FormData()
        var productName = document.getElementById('product-name').value
        var productCode = document.getElementById('product-id').value
        var productStatus = document.getElementById('product-status').value
            if(productStatus == 'active'){productStatus = 1;}else{productStatus = 0;}
        var productPrice = document.getElementById('product-price').value
        var productTax = document.getElementById('tax').value
        var productStock = document.getElementById('product-quantity').value
        var productMainCategorie = document.getElementById('mainCategories').value
        var productSubCategorie = document.getElementById('subCategories').value
        var productMarkas = document.getElementById('markas').value
        var productBarcode = document.getElementById('barcode').value
        var productDiscount = document.getElementById('discount').value
        var productDesi = document.getElementById('desi').value
        var productDescription = document.getElementById('description').value
        var productSpecs = document.getElementsByClassName('product-spec')
        var productVariants = document.getElementsByClassName('all-variants')
        var productSizes = document.getElementsByClassName('size-stock-value')
        
        for(is=0;is<productSizes.length;is++){
            var productSizeStockValue = productSizes[is].value 
            var productSizeName = productSizes[is].getAttribute('size-name')
            formData.append('sizeNames[]',productSizeName)
            formData.append('sizeStockValues['+is+']',productSizeStockValue)
            console.log('Name:'+productSizeName + 'Stock :'+ productSizeStockValue)
        }
        
        
        for(iv=0;iv<productVariants.length;iv++){
            formData.append('variantNames[]',productVariants[iv].getAttribute('variant-id'))
            formData.append('variantValues['+iv+']',productVariants[iv].getElementsByTagName('input')[0].value)
        }
        


        if(productCode){}else{
            productCode = '_' + Math.random().toString(36).substr(2, 9);
            productCode = productCode + Math.random().toString(36).substr(2, 9);
            }
        console.log(productCode);
        formData.append('com' ,'addProduct')
        for(i=0;i<photosGroup.length;i++){
            formData.append('files[]',photosGroup[i])
        }
        formData.append('productName',productName)
        formData.append('productCode',productCode)
        formData.append('productStatus',productStatus)
        formData.append('productPrice',productPrice)
        formData.append('productTax',productTax)
        formData.append('productStock',productStock)
        formData.append('productMainCategorie',productMainCategorie)
        formData.append('productSubCategorie',productSubCategorie)
        formData.append('productMarkas',productMarkas)
        formData.append('productBarcode',productBarcode)
        formData.append('productDiscount',productDiscount)
        formData.append('productDesi',productDesi)
        formData.append('productDescription',productDescription)
        for(is=0;is<productSpecs.length;is++){if(productSpecs[is].getAttribute('specid') == null){}else{console.log(productSpecs[is].getAttribute('specid'));formData.append('productSpecs[]',productSpecs[is].getAttribute('specid'))}}
        
        
            

       
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                loaded();
                location.reload();
            }
        }
        
        xmlhttp.open('POST' , 'product.php');
        xmlhttp.send(formData)
        loading()
        
        
    }
    
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
    
    </script>
    
</div>