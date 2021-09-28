<?php
include 'panel.php';
include '../inc/db.php';

$conn = dbConnection();


if($conn->connect_error){die('Database Connection Failed : ' . connect_error);}


function alert($message){
    echo '<script> alert("'.$message.'") </script>';
    
}





if($_GET['com'] == 'addMainCategorie'){
    $categorieName = $_GET['categorieName'];
    alert($categorieName);
    $sql_addCat = 'INSERT INTO `mainCategories` (`categories`) VALUES ("'.$categorieName.'")';
    alert($sql_addCat);
    $result_addCat = $conn->query($sql_addCat);
    if($result_addCat){
        echo '<script>document.getElementsByClassName("main-categories-panel")[0].innerHTML = document.getElementsByClassName("main-categories-panel")[0].innerHTML + ' .mainCategoryButton($categorieName) .'   </script>';
    }else{
        echo $categorieName . 'Eklenemedi...';
    }
    
}


if($_GET['com'] == 'deleteMainCategorie'){
    $categorieName = $_GET['categorieName'];
    $sql_deleteCat = 'DELETE FROM `mainCategories` WHERE categories = "'.$categorieName.'"';
    $result_deleteCat = $conn->query($sql_deleteCat);
    if($result_deleteCat){
        $sql_deleteSubCat = ' DROP TABLE `'.$categorieName.'`';
        $resutlt_deleteSubCat = $conn->query($sql_deleteSubCat);
        if($result_deleteSubCat){
            
        }
        
    }
    
    
}

if($_GET['com'] == 'editMainCategorie'){
    $categorieName = $_GET['categorieName'];
    $newCategorieName = $_GET['newCategorieName'];
    $sql_editCat = 'UPDATE `mainCategories` SET `categories`= "'.$newCategorieName.'" WHERE categories = "'.$categorieName.'" ';
    $result_editCat = $conn->query($sql_editCat);
    
    if($result_editCat){
        $sql_changeSub = 'ALTER TABLE `'.$categorieName.'` RENAME `'.$newCategorieName.'`';
        $result_changeSub = $conn->query($sql_changeSub);
        if($result_changeSub){
            
        }
    }
}



if($_GET['com'] == 'addSubCategories'){

    $categorieName = $_GET['subCategorieName'];
    $mainCategorieName = $_GET['mainCategorieName'];
    echo $mainCategorieName;
    $sql_addSubCat = 'INSERT INTO `subCategories` (`mainCategorie`,`subCategorie`) VALUES ("'.$mainCategorieName.'","'.$categorieName.'") ';
    $result_addSubCat = $conn->query($sql_addSubCat);
    
    if($result_addSubCat){
        

        echo 'ok';
    }
    
    
    
}

if($_GET['com'] == 'deleteSubCategories'){
    $categorieName = $_GET['categorieName'];
    $mainCategorieName = $_GET['mainCategorieName'];
    $sql_deleteSubCat = 'DELETE FROM `subCategories` WHERE subCategorie = "'.$categorieName.'" ';
    $result_deleteSubCat = $conn->query($sql_deleteSubCat);
    if($result_deleteSubCat){
        $sql_deleteMarkas = 'DELETE FROM `markas` WHERE  subCategorie = "'.$categorieName.'" ';
        $result_deleteMarkas = $conn->query($sql_deleteMarkas);
        if($result_deleteMarkas){
            echo 'ok';
            
        }

    }
}

if($_GET['com'] == 'editSubCategories'){
    echo 'executed';
    $categorieName = $_GET['categorieName'];
    $newCategorieName = $_GET['newCategorieName'];
    $sql_editSubCat = 'UPDATE `subCategories` SET `subCategorie`= "'.$newCategorieName.'" WHERE subCategorie = "'.$categorieName.'" ';
    $result_editSubCat = $conn->query($sql_editSubCat);
    if($result_editSubCat){
        
        $sql_editMarkas = 'UPDATE `markas` SET `subCategorie`= "'.$newCategorieName.'" WHERE subCategorie = "'.$categorieName.'" ';
        $result_editMarkas = $conn->query($sql_editMarkas);
        if($result_editMarkas){
            echo 'ok';
            
        }else{
            echo 'notok';
        }
        
    }
}

if($_GET['com'] == 'deleteMarkas'){
    $markaName = $_GET['markaName'];
    $subCatName = $_GET['subCatName'];
    $sql_deleteMarka = 'DELETE FROM `markas` WHERE marka = "'.$markaName.'" ';
    $result_deleteMarka = $conn->query($sql_deleteMarka);
    if($result_deleteMarka){
        echo 'ok';
        
    }
}

if($_GET['com'] == 'addMarkas'){
    $markaName = $_GET['markaName'];
    $subCatName = $_GET['subCatName'];
    $sql_addMarka = 'INSERT INTO `markas` (subCategorie,marka) VALUES ("'.$subCatName.'" , "'.$markaName.'") ';
    $result_addMarka = $conn->query($sql_addMarka);
    if($result_addMarka){
        
    }
}


if($_GET['com'] == 'editMarkas'){
    $newMarkaName = $_GET['newMarkaName'];
    $markaName = $_GET['markaName'];
    $sql_editMarka = 'UPDATE `markas` SET `marka` = "'.$newMarkaName.'" WHERE marka = "'.$markaName.'" ';
    $result_editMarka = $conn->query($sql_editMarka);
    if($result_editMarka){
        
    }
}





function mainCategories(){
    
    $conn = dbConnection();
    $sql = 'select * from mainCategories';
    $result = $conn -> query($sql);
    $mainCategories = $result -> fetch_all(MYSQLI_ASSOC);

    foreach($mainCategories as $value){
            $value = $value['categories'];
            $sql_subCat = 'select * from `subCategories` WHERE mainCategorie = "'.$value.'"';
            $res_subCat = $conn->query($sql_subCat);
            
            if($res_subCat){
                $fetchSubCats = $res_subCat -> fetch_all(MYSQLI_ASSOC);
                
                // İF MAİN CAT HAVENT SUB CAT WİLL NOT RETURN MAİN CAT BUTTONS (OR if $res_subCat not return true) -----
                
                echo '<div class="main-categories-button-holder">';
                echo '<button class = "main-categories-button" value = "'.$value.'" > '.$value.' </button>';
                echo '<button class = "main-categories-delete-button" value = "'.$value.'" style = "width:5%;margin:0;display:inline-block;vertical-align:top;"><img style = "width:40%;height:70%;margin:auto;display:block;" src = "../imgs/negative.png"></button>';
                echo '<button class = "main-categories-edit-button" value = "'.$value.'" style = "width:5%;margin:0;display:inline-block;vertical-align:top;"><img style = "width:40%;height:70%;margin:auto;display:block;" src = "../imgs/edit.png"></button>';
                echo '</div>';
                
                
                
                echo '<div id = "'.$value.'" style = "display:none;" class = "sub-cat-panel-hidden">';
                echo '<div id = "'.$value.'" class = "sub-categories">';
                echo '<h3>'.$value. ' - Alt Kategoriler</h3>';
                
                
                
                foreach($fetchSubCats as $subValue){
                    
                        $subValue = $subValue['subCategorie'];
                        if($subValue == ''){}else{
                        echo '<div class = "sub-categories-button-holder">';
                        echo '<button class = "sub-categories-button" value = "'.$subValue.'">'. $subValue . '</button>';
                        echo'<button class = "sub-categories-delete-button" mainCat = "'.$value.'" value ="'.$subValue.'" style = "width:5%;margin:0;display:inline-block;vertical-align:top;"><img style = "width:40%;height:70%;margin:auto;display:block;" src = "../imgs/negative.png"></button>';
                        echo'<button class = "sub-categories-edit-button" mainCat = "'.$value.'" value ="'.$subValue.'" style = "width:5%;margin:0;display:inline-block;vertical-align:top;"><img style = "width:40%;height:70%;margin:auto;display:block;" src = "../imgs/edit.png"></button>';
                        echo '</div>';
                        
                        
                        $sql_markas = 'SELECT * FROM markas WHERE subCategorie = "'.$subValue.'"';
                        $result_markas = $conn->query($sql_markas);
                        
                        if($result_markas){
                            $fetch_markas = $result_markas -> fetch_all(MYSQLI_ASSOC);
                            echo '<div id = "'.$subValue.'" style = "display:none;" class = "marka-panel-hidden">';
                            echo '<div id = "'.$subValue.'" class = "markas">';
                            echo '<h3> '.$subValue.' - Markalar</h3>';
                            foreach($fetch_markas as $markaValue){
                                $markaValue = $markaValue['marka'];
                                echo '<div id = "'.$markaValue.'" class = "marka-button-holder">';
                                echo '<button value = "'.$markaValue.'">'. $markaValue . '</button>';
                                echo'<button class = "marka-delete-button" subCat = "'.$subValue.'" value ="'.$markaValue.'" style = "width:5%;margin:0;display:inline-block;vertical-align:top;"><img style = "width:40%;height:70%;margin:auto;display:block;" src = "../imgs/negative.png"></button>';
                                echo'<button class = "marka-edit-button" subCat = "'.$subValue.'" value ="'.$markaValue.'" style = "width:5%;margin:0;display:inline-block;vertical-align:top;"><img style = "width:40%;height:70%;margin:auto;display:block;" src = "../imgs/edit.png"></button>';
                                echo '</div>';
                            }
                            echo '<div class = "add-markas">';
                            echo  '<input  type = "text" class = "add-markas-text">';
                            echo '<input   subCat = "'.$subValue.'" class = "add-markas-button" type = "submit" value = "Ekle">';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                        
                        
                    }
                }
                echo '<div class = "add-sub-categories">';
                echo '<input class = "add-sub-categorie-text" type="text">';
                echo '<input mainCat = "'.$value.'" class = "add-sub-categorie-button" type="submit" value ="Ekle">';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }else{
                echo '<div class="main-categories-button-holder">';
                echo '<button class = "main-categories-button" value = "'.$value.'" > '.$value.' </button>';
                echo '<button class = "main-categories-delete-button" value="'.$value.'" style = "width:5%;margin:0;display:inline-block;vertical-align:top;"><img style = "width:30%;height:70%;margin:auto;display:block;" src = "negative.png"></button>';
                echo '<button class = "main-categories-edit-button" value="'.$value.'" style = "width:5%;margin:0;display:inline-block;vertical-align:top;"><img style = "width:30%;height:70%;margin:auto;display:block;" src = "edit.png"></button>';
                echo '</div>';
            }
           } 
    }


                        $sql_markass = 'SELECT * FROM `markas` WHERE subCategorie = ""';
                        $result_markass = $conn->query($sql_markass);

                        if($result_markass){
                            $fetch_markass = $result_markass->fetch_all(MYSQLI_ASSOC);
                            foreach($fetch_markass as $markaValue){
                                    $markaValue = $markaValue['marka'];
                                    echo  '<button>'.$markaValue.'</button>';

                                }
                        }
    


?>




<div class = "main-page">
    <div class = "main-categories-panel">
            <h3>Ana Kategoriler</h3>
        <?php  mainCategories();?>
    <div class = "add-main-categories">
        <input name = "com" value = "addCategorie" style="display:none;">
        <input id = "main-cat-add-text" name="categorieName" type="text">
        <input id = "main-cat-add" type="submit" value ="Ekle">
    </div>
    
    </div>
    
    <div id = "sub-cat-panel" class ="sub-cat-panel">
        
    </div>
    
    <div id = "marka-panel" class= "marka-panel">
        
    </div>


</div>

<script>


// MAIN CATEGORIES

var mainButtons = document.getElementsByClassName('main-categories-button')
var markasPanelMain = document.getElementById('marka-panel')

function mainButtonsClick(){
    mainCategoriesEditButtons();
for(i=0;i<mainButtons.length;i++){
        document.getElementsByClassName('main-categories-button')[i].addEventListener('click',function(){
            console.log('xqwexqwe');
            var nameCategorie = this.getAttribute('value');
            var subCatPanel = document.getElementById('sub-cat-panel')
            var hiddenSubCatPanel = document.getElementById(nameCategorie)
            subCatPanel.innerHTML = '';
            markasPanelMain.innerHTML = '';
            subCatPanel.innerHTML = hiddenSubCatPanel.innerHTML;
            subCategoriesDeleteButtons();
            subCategoriesAddButtons();
            subCategoriesEditButtons();
            subButtons();
    
        })
    }
}

document.getElementById('main-cat-add').addEventListener('click' , function(){
    var xmlhttp = new XMLHttpRequest();
    var categorieName = document.getElementById('main-cat-add-text').value
    var encodeCategorieName = encodeURIComponent(categorieName)
    if(categorieName.length>0){
        xmlhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                var response = this.responseText;
                location.reload();
                var mainPanel = document.getElementsByClassName('main-categories-panel')[0]
                mainPanel.innerHTML = mainPanel.innerHTML + '<div class="main-categories-button-holder"><button class = "main-categories-button" value = "'+categorieName+'" > '+categorieName+' </button><button class = "main-categories-delete-button" value="'+categorieName+'" style = "width:5%;margin:0;display:inline-block;vertical-align:top;"><img style = "width:30%;height:70%;margin:auto;display:block;" src = "negative.png"></button><button class = "main-categories-edit-button" value="'+categorieName+'" style = "width:5%;margin:0;display:inline-block;vertical-align:top;"><img style = "width:30%;height:70%;margin:auto;display:block;" src = "edit.png"></button></div>'
            }
        }
    }
    
    xmlhttp.open('GET' , 'categories.php?com=addMainCategorie&categorieName='+encodeCategorieName+'');
    xmlhttp.send();
})







function mainCategoriesDeleteButtons(){
var mainCatDeleteButtons = document.getElementsByClassName('main-categories-delete-button');
    for(i=0;i<mainCatDeleteButtons.length;i++){
        mainCatDeleteButtons[i].setAttribute('buttonIndex' , i);
        mainCatDeleteButtons[i].onclick = function(){
            var buttonIndex = this.getAttribute('buttonIndex')
            var categorieNameDelete = this.getAttribute('value');
            var encodeCategorieNameDelete =encodeURIComponent(categorieNameDelete);
            var xmlhttp = new XMLHttpRequest();
            mainCategoriesDeleteButtons();
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    
                    document.getElementsByClassName('main-categories-button-holder')[buttonIndex].innerHTML = '';
                    document.getElementsByClassName('main-categories-button-holder')[buttonIndex].remove()
                    location.reload();
                }
            }
            xmlhttp.open('GET' , 'categories.php?com=deleteMainCategorie&categorieName='+encodeCategorieNameDelete+'');
            xmlhttp.send();
        }
    }   
}






function mainCategoriesEditButtons(){
    var mainCategoriesEditButtons = document.getElementsByClassName('main-categories-edit-button');
    for(i=0;i<mainCategoriesEditButtons.length;i++){
        mainCategoriesEditButtons[i].setAttribute('buttonIndex' , i);
        mainCategoriesEditButtons[i].onclick = function(){
            
            var buttonIndexEdit = this.getAttribute('buttonIndex');
            var categorieNameEdit = this.getAttribute('value');
            categorieNameEdit = encodeURIComponent(categorieNameEdit);
            var xmlhttp = new XMLHttpRequest();
            var buttonHolder = document.getElementsByClassName('main-categories-button-holder')[buttonIndexEdit];
            
            for(ib=0;ib<document.getElementsByClassName('edit-main-cat').length;ib++){
                document.getElementsByClassName('edit-main-cat')[ib].remove();
            }
            
            buttonHolder.innerHTML = buttonHolder.innerHTML +'<div style="display:block;" class ="edit-main-cat" id = "edit-main-cat-'+buttonIndexEdit+'"><input style="width:80%;margin:10px;" id = "main-categories-edit-text" value = "'+this.getAttribute('value')+'" type=text></input><input id = "main-categories-edit-confirm" value = "Değiştir" type="submit"></div>'
            
            document.getElementById('main-categories-edit-confirm').onclick = function(){
                var newCategorieName = document.getElementById('main-categories-edit-text').value;
                var encodeNewCategorieName = encodeURIComponent(newCategorieName);
                console.log('categories.php?com=editMainCategorie&categorieName='+categorieNameEdit+'&newCategorieName='+newCategorieName+'')
                xmlhttp.onreadystatechange = function(){
                    if(this.readyState = 4 && this.status == 200){
                        mainCategoriesDeleteButtons();
                        for(ii=0;ii<buttonHolder.getElementsByTagName('button').length;ii++){
                            buttonHolder.getElementsByTagName('button')[ii].setAttribute('value',newCategorieName);
                        }
                        document.getElementsByClassName('main-categories-button')[buttonIndexEdit].innerHTML = newCategorieName;
                        document.getElementById('edit-main-cat-'+buttonIndexEdit).style.display = 'none';
                        location.reload();
                    }
                }
                xmlhttp.open('GET','categories.php?com=editMainCategorie&categorieName='+categorieNameEdit+'&newCategorieName='+encodeNewCategorieName+'')
                xmlhttp.send();
            }
            mainButtonsClick();
            
            
        }
    }
}




function subCategoriesAddButtons(){
    var addSubCatButtons = document.getElementsByClassName('add-sub-categorie-button')
    var addSubCatTexts = document.getElementsByClassName('add-sub-categorie-text')
    for(i=0;i<addSubCatButtons.length;i++){

        addSubCatButtons[i].setAttribute('buttonIndex',i)
        addSubCatButtons[i].onclick = function(){

            var subCategorieName = addSubCatTexts[this.getAttribute('buttonIndex')].value;
            var encodeSubCategorieName = encodeURIComponent(subCategorieName);
            var encodeMainCategorieName = encodeURIComponent(this.getAttribute('mainCat'));
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    location.reload();
                    
                }
            }
            xmlhttp.open('GET','categories.php?com=addSubCategories&subCategorieName='+encodeSubCategorieName+'&mainCategorieName='+encodeMainCategorieName+'');
            xmlhttp.send();
        }
    }
    
    
    
}



















function subCategoriesDeleteButtons(){
    var subDeleteButtons = document.getElementsByClassName('sub-categories-delete-button')
    
    for(i=0;i<subDeleteButtons.length;i++){
        subDeleteButtons[i].setAttribute('buttonIndex',i);
        
        subDeleteButtons[i].onclick = function(){

            var subCatHolders = document.getElementsByClassName('sub-categories-button-holder"')
            var subCategorieName = this.getAttribute('value');
            var mainSubCategorieName = this.getAttribute('mainCat')
            
            
            var encodeSubCategorieName = encodeURIComponent(subCategorieName);
            var encodeMainSubCategorieName = encodeURIComponent(mainSubCategorieName)

            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 & this.status == 200){
                    location.reload();
                    
                }
            }
            xmlhttp.open('GET', 'categories.php?com=deleteSubCategories&categorieName='+encodeSubCategorieName+'&mainCategorieName='+encodeMainSubCategorieName+'')
            xmlhttp.send();
            
        }
    }
    
    
}



function subCategoriesEditButtons(){
    var subEditButtons = document.getElementsByClassName('sub-categories-edit-button')
    for(i=0;i<subEditButtons.length;i++){
        
        subEditButtons[i].setAttribute('buttonIndexSubEdit',i)
        
        subEditButtons[i].onclick = function(){
            var editHtmls = document.getElementsByClassName('edit-sub-cat')

            for(ii=0;ii<editHtmls.length;ii++){
                
                editHtmls[ii].remove();
            }
            var buttonIndexSubEdit = this.getAttribute('buttonIndexSubEdit');
            var subButtonEditHtml = '<div style="display:block;" class ="edit-sub-cat" id = "edit-sub-cat-'+buttonIndexSubEdit+'"><input style="width:80%;margin:10px;" id = "sub-categories-edit-text" value = "'+this.getAttribute('value')+'" type=text></input><input id = "sub-categories-edit-confirm" value = "Değiştir" type="submit"></div>'
            var subButtonsHolder = document.getElementsByClassName('sub-categories-button-holder')
            subButtonsHolder[buttonIndexSubEdit].innerHTML = subButtonsHolder[buttonIndexSubEdit].innerHTML + subButtonEditHtml;
            document.getElementById('sub-categories-edit-confirm').onclick = function(){
                var subEditedName = document.getElementById('sub-categories-edit-text').value;
                var encodeSubEditName = encodeURIComponent(subEditedName);
                var encodeSubCategorieName = encodeURIComponent(subButtonsHolder[buttonIndexSubEdit].getElementsByTagName('button')[0].innerHTML);

                xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        location.reload();
                    }
                }
                xmlhttp.open('GET', 'categories.php?com=editSubCategories&newCategorieName='+encodeSubEditName+'&categorieName='+encodeSubCategorieName+'')
                xmlhttp.send();

            }
            
            subCategoriesEditButtons();
            
        }
    }
}



function subButtons(){
var subButtons = document.getElementsByClassName('sub-categories-button');

    for(i=0;i<subButtons.length;i++){
        subButtons[i].onclick = function(){
            var markaPanel = document.getElementById('marka-panel')
            var markasPanel = document.getElementById(this.value)
            markaPanel.innerHTML = '';
            markaPanel.innerHTML = markasPanel.innerHTML ;
            markasAddButtons();
            markasDeleteButtons();
            markasEditButtons();
            
        }
    }
}


function markasAddButtons(){
    var submitButtons = document.getElementsByClassName('add-markas-button');
    var textButtons = document.getElementsByClassName('add-markas-text');

    for(i=0;i<submitButtons.length;i++){
        submitButtons[i].setAttribute('buttonIndexAddMarka',i)

        submitButtons[i].onclick = function(){
            var buttonIndexAddMarka = this.getAttribute('buttonIndexAddMarka');
            var encodeSubCatAddMarka = encodeURIComponent(this.getAttribute('subCat'));
            var subCatNameNewMarka = this.getAttribute('subCat')
            var encodeAddMarkaText = encodeURIComponent(textButtons[buttonIndexAddMarka].value);
            var newMarka = textButtons[buttonIndexAddMarka].value
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    var createMarkaButton = '<div id = "'+newMarka+'" class = "marka-button-holder"><button value = "'+newMarka+'">'+newMarka+'</button><button class="marka-delete-button" subcat="'+subCatNameNewMarka+'" value="'+newMarka+'" style="width:5%;margin:0;display:inline-block;vertical-align:top;"><img style="width:40%;height:70%;margin:auto;display:block;" src="negative.png"></button><button class="marka-edit-button" subcat="'+subCatNameNewMarka+'" value="'+newMarka+'" style="width:5%;margin:0;display:inline-block;vertical-align:top;"><img style="width:40%;height:70%;margin:auto;display:block;" src="edit.png"></button></div>';
                    var markaPanelHolder = document.getElementsByClassName('marka-panel')
                    for(ii=0;ii<markaPanelHolder.length;ii++){
                        markaPanelHolder[ii].innerHTML = markaPanelHolder[ii].innerHTML + createMarkaButton;    
                    }
                    
                    markasDeleteButtons()
                    markasAddButtons()
                    markasEditButtons();
                }
            }
            xmlhttp.open('GET' , 'categories.php?com=addMarkas&markaName='+encodeAddMarkaText+'&subCatName='+encodeSubCatAddMarka+'');
            xmlhttp.send();

            
        }
    }
    
}

function markasDeleteButtons(){
    var markaDeleteButtons = document.getElementsByClassName('marka-delete-button')
    
    for(i=0;i<markaDeleteButtons.length;i++){
        markaDeleteButtons[i].onclick = function(){
            var DeleteSubCatName = this.getAttribute('subCat');
            var encodeDeleteSubCatName = encodeURIComponent(this.getAttribute('subCat'));
            var DeleteMarkaName = this.getAttribute('value');
            var encodeDeleteMarkaName = encodeURIComponent(this.getAttribute('value'));
            var buttonHolders = document.getElementsByClassName('marka-button-holder');
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                for(ii=0;ii<buttonHolders.length;ii++){
                    console.log(buttonHolders[ii]);
                    if(buttonHolders[ii].getAttribute('id')==DeleteMarkaName){

                        buttonHolders[ii].remove();
                    }
                }
               

            }
            
            xmlhttp.open('GET','categories.php?com=deleteMarkas&markaName='+encodeDeleteMarkaName+'&subCatName='+encodeDeleteSubCatName+'')
            xmlhttp.send();
            
        }
        
    }
}




function markasEditButtons(){
    var markaEditButton = document.getElementsByClassName('marka-edit-button') ;
    var markaButtonHolders = document.getElementsByClassName('marka-button-holder')
    for(i=0;i<markaEditButton.length;i++){
        markaEditButton[i].setAttribute('markaEditIndex',i)
        markaEditButton[i].onclick = function(){
        var subCatEditedMarka = markaEditButton[this.getAttribute('markaEditIndex')].getAttribute('subCat');
        var markaNameEditing = this.getAttribute('value')
        var encodeMarkaNameEditing = encodeURIComponent(this.getAttribute('value'))
        
            var editHtmlDiv = document.getElementsByClassName('edit-marka')
            for(ii=0;ii<editHtmlDiv.length;ii++){editHtmlDiv[ii].remove();}
            markasEditButtonsReload();
            
            editorHTML = '<div style="display:block;" class ="edit-marka" id = "edit-marka-'+i+'"><input style="width:80%;margin:10px;" id = "marka-edit-text" value = "'+this.getAttribute('value')+'" type=text></input><input id = "marka-edit-confirm" value = "Değiştir" type="submit"></div>'
            markaButtonHolders[this.getAttribute('markaEditIndex')].innerHTML = markaButtonHolders[this.getAttribute('markaEditIndex')].innerHTML + editorHTML;
            
            var markaIndex = this.getAttribute('markaEditIndex');
            
            document.getElementById('marka-edit-confirm').onclick = function(){
                var editedNameMarka = document.getElementById('marka-edit-text').value;
                var encodeEditedNameMarka = encodeURIComponent(editedNameMarka);
                var encodeEditedSubCatName = encodeURIComponent(subCatEditedMarka);
                xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        holderButtons = document.getElementsByClassName('marka-button-holder')[markaIndex].getElementsByTagName('button')
                        
                        for(iii=0;iii<holderButtons.length;iii++){
                            if(iii==0){
                                holderButtons[iii].innerHTML = editedNameMarka;
                            }
                            holderButtons[iii].setAttribute('value',editedNameMarka);
                        }
                        
                        document.getElementsByClassName('marka-button-holder')[markaIndex].setAttribute('value',editedNameMarka)
                        document.getElementById('marka-edit-text').setAttribute('value',editedNameMarka)
                        encodeMarkaNameEditing =  editedNameMarka;
                        markasEditButtonsReload();
                    }
                }
                xmlhttp.open('GET', 'categories.php?com=editMarkas&markaName='+encodeMarkaNameEditing+'&newMarkaName='+encodeEditedNameMarka+'')
                xmlhttp.send();
            }
            
            
            
        }
    }
    
    
}

function markasEditButtonsReload(){markasEditButtons()};


mainCategoriesDeleteButtons();
mainCategoriesEditButtons();
subCategoriesDeleteButtons();
mainButtonsClick();








</script>


