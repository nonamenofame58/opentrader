<?php






include 'panel.php';
include '../inc/db.php';

$conn = dbConnection();

$sql_getCurrentTime = 'SELECT * FROM showcaseTime';
$result_getCurrentTime = $conn->query($sql_getCurrentTime);
$fetch_getCurrentTime = $result_getCurrentTime -> fetch_all(MYSQLI_ASSOC);
$currentTime = $fetch_getCurrentTime[0]['time'];




$sql_getImageLinks = "SELECT * FROM showcase";
$result_getImageLinks = $conn->query($sql_getImageLinks);
$fetch_getImageLinks = $result_getImageLinks->fetch_all(MYSQLI_ASSOC);
$imagesLength = count($fetch_getImageLinks);

if($_POST['com'] == 'saveShowcase'){
    $count = 0;
    $unid = uniqid();
    foreach($_FILES['files']['name'] as $photo){
        $target_dir = '../showcase/';
        $target_file = $target_dir .$unid.basename($_FILES['files']['name'][$count] );
        move_uploaded_file($_FILES['files']["tmp_name"][$count] , $target_file);
        
        
        $sql_addShowcasePhoto = 'INSERT INTO showcase (imgLink) VALUES ("'.$unid.$_FILES['files']['name'][$count].'")';
        $result_addShowcasePhoto = $conn->query($sql_addShowcasePhoto);
        if($result_addShowcasePhoto){
            $count = $count + 1;
        }
        
        
    }
}


if($_POST['com'] == 'removeShowcaseItem'){
    $showcaseLinkName = $_POST['name'];
    echo $showcaseLinkName;
    $sql_removeShowcaseItem = 'DELETE FROM `showcase` WHERE imgLink = "'.$showcaseLinkName.'"';
    $result_removeShowcaseItem = $conn ->query($sql_removeShowcaseItem);
    if($result_removeShowcaseItem){
        echo '';
    }
    
    
}

if($_POST['com'] == 'updateShowcaseTime'){
    
    $sql_getCurrentTime = 'SELECT * FROM showcaseTime';
    $result_getCurrentTime = $conn->query($sql_getCurrentTime);
    $fetch_getCurrentTime = $result_getCurrentTime -> fetch_all(MYSQLI_ASSOC);

    
    
    $currentTime = $fetch_getCurrentTime[0]['time'];
    $newTime = $_POST['time'];
    $sql_updateShowcaseTime = 'UPDATE showcaseTime SET time = "'.$newTime.'" WHERE time = "'.$currentTime.'"';
    $result_updateShowcaseTime = $conn->query($sql_updateShowcaseTime);
    if($result_updateShowcaseTime){
        
    }
    
    
    
    
}


echo 

'
<style>
.add-showcase-image{background:rgba(16,16,16,1);padding:10px;}
.add-showcase-image p{border-radius:3px;}
.showcase{border:solid 1px black;margin-top:10px;padding:0;border-radius:5px;position:relative;height:100%;}
.showcase img{transition:1s;}
.showcase:hover{}
.showcase-right-image{width:45px;position:absolute;top:45%;padding:10px;transition:1s;background:rgba(255,255,255,0.5);}
.showcase-left-image{width:45px;position:absolute;top:45%;padding:10px;transition:1s;background:rgba(255,255,255,0.5);}
.showcase-right-image:hover{transform:scale(1.5);}
.showcase-left-image:hover{transform:scale(1.5);}
.all-shows{width:100%;position:absolute;bottom:0;margin:0;display:block;padding-top:10px;padding-bottom:10px;background:rgba(16,16,16,0.5);border-radius:2px;opacity:0;transition:1s;right:0;}
.all-shows-img{width:75px;height:75px;display:inline-block;margin-left:10px;}
.all-shows-img img{border-radius:10px;display:block;border:solid 5px white;transition:1s;}
.all-shows-img img:hover{border-color:black;transform:scale(1.3);}
@media only screen and (max-width:1000px){
    .showcase-right-image{width:40px;top:40%;}
    .showcase-left-image{width:40px;top:40%;}
    
    .all-shows-img {width:35px;height:35px;}
}
@media only screen and (max-width:500px){
    .showcase-right-image{width:30px;top:35%;}
    .showcase-left-image{width:30px;top:35%;}
    .all-shows-img {border-radius:1px;width:15px;height:15px;margin-left:5px;}
    .all-shows-img img{border-radius:1px;border:solid 0.01em white;}
    .all-shows{padding:1px;}
}
</style>

<div id = "main-page" class = "main-page">
    


<div class = "add-showcase-image">


    <h2>Vitrin Önizleme</h2>
    
    <h4 style = "margin-bottom:40px;text-align:center;">Çözünürlük : 2496 × 760 px ( aspect ratio : 312∶95 )</h4>
    
    
    
        <div style = "min-height:270px;" id = "showcase-div" class = "showcase">
';

    
    
    echo '
    
        <img id = "showcase-right-button" class = "showcase-right-image" style = "right:0px;" src = "../imgs/right.png">
        <img id = "showcase-left-button" class = "showcase-left-image" style = "left:0px;"  src = "../imgs/left.png">
        <div  id = "showcase-image-list">
        
        
        
        ';

        $linkCount = 0;
        foreach($fetch_getImageLinks as $imageLink){
            if($linkCount == 0){
                echo '<img showing = "true"  id = "'.$linkCount.'" class = "showcase-show-image" imglink = "'.$imageLink['imgLink'].'" src = "../showcase/'.$imageLink['imgLink'].'"   style = "width:100%;display:block;border-radius:5px;">';
                $linkCount = $linkCount + 1;
            }else{
                echo '<img showing = "false"  id = "'.$linkCount.'" class = "showcase-show-image" imglink = "'.$imageLink['imgLink'].'"  src = "../showcase/'.$imageLink['imgLink'].'"   style = "width:100%;display:none;border-radius:5px;">';
                $linkCount = $linkCount + 1;
            }
            
        }
    echo '
        </div>
        <button id = "remove-showcase-item" style = "width:100%;top:-40px;position:absolute;height:40px;">Kaldır</button>
        <div style = "opacity:1;"id = "all-shows" class = "all-shows">
        ';
        
        
        foreach($fetch_getImageLinks as $imageLink){    
        
            echo '<div  class = "all-shows-img"><img style = "width:100%;height:100%;" src = "../showcase/'.$imageLink['imgLink'].'"></div>';

        
        }
        
    echo '</div>';
    
    


echo '       
        
    </div>

<h2>Vitrin Fotoğraf Yükleme </h2>
    
    <p>Fotoğraf : <input id = "showcase-image-input" type = "file"></p>
    <button id = "save-showcase" style = "width:100%;height:40px">Kaydet</button>
    
<h2>Vitrin Değişme Süresi</h2>

<p>Değişme Süresi ( Şuanki : '.$currentTime.' Saniye ) :<button id = "update-showcase-time" style = "margin-top:-7px;display:block;height:35px;float:right">Kaydet</button> <span style = "margin-right:25px; float:right">Saniye </span> <input id = "update-showcase-time-input" style = "margin-right:5px;width:200px;" type ="number">   </p>
    
    

</div>








</div>


';






?>


<script>


var updateTimeButton = document.getElementById('update-showcase-time');

updateTimeButton.onclick = function(){
    xmlhttp = new XMLHttpRequest();
    form = new FormData();
    form.append('com' , 'updateShowcaseTime')
    form.append('time',document.getElementById('update-showcase-time-input').value)
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            loaded();
        }
    }
    xmlhttp.open('POST','showcase.php');
    xmlhttp.send(form)
    loading();
}


var showcaseLeftButton = document.getElementById('showcase-left-button');
var showcaseRightButton = document.getElementById('showcase-right-button');
var showcaseAllImages = document.getElementById('all-shows');
var showcaseAllImagesDiv = document.getElementsByClassName('all-shows-img');
var showcaseShowingImages = document.getElementsByClassName('showcase-show-image');
var showcase = document.getElementById('showcase-div')

var uploadingPhotos = [];




function showcaseChange(){
    var showcaseLeftButton = document.getElementById('showcase-left-button');
    var showcaseRightButton = document.getElementById('showcase-right-button');
    var showcaseAllImages = document.getElementById('all-shows');
    var showcaseAllImagesDiv = document.getElementsByClassName('all-shows-img');
    var showcaseShowingImages = document.getElementsByClassName('showcase-show-image');
    var showcase = document.getElementById('showcase-div')
    var showcaseImageList = document.getElementById('showcase-image-list').getElementsByTagName('img')


    for(i=0;i<showcaseAllImagesDiv.length;i++){
        showcaseAllImagesDiv[i].setAttribute('index',i)
        showcaseAllImagesDiv[i].onclick = function(){
            var divIndex = this.getAttribute('index')
            console.log(divIndex)
            for(ii=0;ii<showcaseImageList.length;ii++){
                showcaseImageList[ii].style.display = 'none';
                showcaseImageList[ii].style.opacity = '0';
                showcaseImageList[ii].setAttribute('showing','false')
            }
            for(ix=0;ix<showcaseAllImagesDiv.length;ix++){
                showcaseAllImagesDiv[ix].getElementsByTagName('img')[0].style.borderColor = 'white'
                
            }
            setTimeout(function(){showcaseImageList[divIndex].style.opacity = '1';},100)
            showcaseImageList[divIndex].style.display = 'block';
            showcaseImageList[divIndex].setAttribute('showing','true')
            this.getElementsByTagName('img')[0].style.borderColor = 'black';
            
        } 
    }
    
    showcaseLeftButton.onclick = function(){
        
        showcaseShowingImages = document.getElementById('showcase-image-list').getElementsByTagName('img')
        if(showcaseShowingImages.length>1){
            for(i=0;i<showcaseShowingImages.length;i++){
                showcaseShowingImages[i].style.display = 'none';
                showcaseShowingImages[i].style.opacity = '0';
                showcaseAllImages.getElementsByTagName('img')[i].style.borderColor = 'white'
                if(showcaseShowingImages[i].getAttribute('showing') == 'true'){
                    
                    var index = showcaseShowingImages[i].getAttribute('id')
                    showcaseShowingImages[i].setAttribute('showing','false')
                    if(index > 0 ){
                        index = index - 1;
                    }
                }
            }
            showcaseAllImages.getElementsByTagName('img')[index].style.borderColor = 'black';
            setTimeout(function(){showcaseShowingImages[index].style.opacity = '1';},100)
            showcaseShowingImages[index].style.display = 'block';
            showcaseShowingImages[index].setAttribute('showing','true')
            }
        }
    showcaseRightButton.onclick = function(){
        showcaseShowingImages = document.getElementById('showcase-image-list').getElementsByTagName('img')
        if(showcaseShowingImages.length>1){
            for(i=0;i<showcaseShowingImages.length;i++){
                showcaseShowingImages[i].style.opaicty = '0';
                showcaseShowingImages[i].style.display = 'none';
                showcaseAllImages.getElementsByTagName('img')[i].style.borderColor = 'white'
                if(showcaseShowingImages[i].getAttribute('showing') == 'true'){
        
                    var index = parseInt(showcaseShowingImages[i].getAttribute('id'))
                    showcaseShowingImages[i].setAttribute('showing','false')
                    if(index < showcaseShowingImages.length - 1){
                        
                        index = index + 1;
                        
                        
                    }
                }
                
            }
            setTimeout(function(){showcaseShowingImages[index].style.opacity = '1';},100)
            showcaseShowingImages[index].style.display = 'block';
            showcaseAllImages.getElementsByTagName('img')[index].style.borderColor = 'black'
            showcaseShowingImages[index].setAttribute('showing','true')
        }
    }
    
    
    var showcase = document.getElementById('showcase-div')
    showcase.onmouseover = function(){
        var allShows = document.getElementById('all-shows')
        
        allShows.style.opacity = "1";
    }
    
    showcase.onmouseout = function(){
        var allShows = document.getElementById('all-shows')
        
        allShows.style.opacity = "0";
    }
    
    
    
}


showcaseChange()




var showcaseImageList = document.getElementById('showcase-image-list')

var showcaseImageInput = document.getElementById('showcase-image-input')
    showcaseImageInput.onchange = function(){

        
        var showcaseShowingImages = document.getElementsByClassName('showcase-show-image');
        var showcaseImage = document.createElement('img')
        showcaseImage.setAttribute('showing','false')
        showcaseImage.setAttribute('id',showcaseShowingImages.length)
        showcaseImage.src = URL.createObjectURL(this.files[0])
        showcaseImage.setAttribute('class','showcase-show-image')
        showcaseImage.setAttribute('style','display:none;width:100%;border-radius:5px;')
        showcaseImageList.appendChild(showcaseImage)
        showcaseImageSmallDiv = document.createElement('div')
        showcaseImageSmallDiv.setAttribute('class','all-shows-img')
        showcaseImageSmallImg = document.createElement('img')
        showcaseImageSmallImg.setAttribute('style','width:100%;height:100%;')
        showcaseImageSmallImg.src = URL.createObjectURL(this.files[0]);
        showcaseImageSmallDiv.appendChild(showcaseImageSmallImg)
        showcaseAllImages.appendChild(showcaseImageSmallDiv)
        showcaseChange()
        uploadingPhotos.push(this.files[0])
        
        

        
        for(i=0;i<showcaseShowingImages.length;i++){
            showcaseShowingImages[i].style.opaicty = '0';
            showcaseShowingImages[i].style.display = 'none';
            showcaseShowingImages[i].setAttribute('showing' , 'false')
            showcaseAllImages.getElementsByTagName('img')[i].style.borderColor = 'white'

            
        }
        
        showcaseShowingImages = document.getElementsByClassName('showcase-show-image');
        showcaseAllImages = document.getElementById('all-shows');
        console.log(showcaseShowingImages.length)
        showcaseShowingImages[showcaseShowingImages.length-1].style.display = 'block';
        showcaseShowingImages[showcaseShowingImages.length-1].setAttribute('showing' , 'true')
        showcaseAllImages.getElementsByTagName('img')[showcaseAllImages.getElementsByTagName('img').length-1].style.borderColor = 'black'
    
    }
    

var saveShowcase = document.getElementById('save-showcase')

saveShowcase.onclick = function(){
    if(uploadingPhotos.length > 0 ){
    var xmlhttp = new XMLHttpRequest();
    var form = new FormData();
    uploadingPhotos.forEach(function(item,index){form.append('files[]',item)})
    form.append('com','saveShowcase')
    xmlhttp.open('POST' , 'showcase.php')
    xmlhttp.send(form)
    
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            location.reload();
        } 
    }
    loading()
    }else{
        alert('Kaydedilcek Bir Şey Yok')
    }
    
}


var removeShowcaseItemButton  = document.getElementById('remove-showcase-item');

removeShowcaseItemButton.onclick = function(){
    var showcaseShowingImages = document.getElementsByClassName('showcase-show-image');
    for(i=0;i<showcaseShowingImages.length;i++){
        if (showcaseShowingImages[i].getAttribute('showing') == 'true'){
            
            console.log(showcaseShowingImages[i].getAttribute('imglink'))
            var xmlhttp = new XMLHttpRequest();
            var form = new FormData();
            form.append('com' , 'removeShowcaseItem')
            form.append('name',showcaseShowingImages[i].getAttribute('imglink'))
            
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    location.reload();
                }
            }
            
            xmlhttp.open('POST','showcase.php')
            xmlhttp.send(form)
            loading();            
            
            
            
        }
    }
        
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