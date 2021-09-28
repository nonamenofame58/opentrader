







// HEADER SCRIPT 

var registerButton = document.getElementById('register-submit-button')
registerButton.onclick = function(){
    var username = document.getElementById('r_username').value
    var email = document.getElementById('r_email').value
    var pass = document.getElementById('r_pass').value
    var pass2 = document.getElementById('r_pass_2').value
    var birthDate = document.getElementById('r_date').value
    var photo = document.getElementById('r_photo').files[0]
  
    xmlhttp = new XMLHttpRequest;
    form = new FormData();
    form.append('r_username',username)
    form.append('r_pass',pass)
    form.append('r_email',email)
    form.append('r_pass_2',pass2)
    form.append('r_dateofbirth',birthDate)
    form.append('r_photo',photo)
    form.append('register','register')
    xmlhttp.open('POST', '../user/register.php')
    xmlhttp.send(form)
    
    
}


var homePageButton = document.getElementById('home-page')

homePageButton.onclick = function(){
    window.location.href = 'index.php';
}




var getMainCategorieProducts = document.getElementsByClassName('main-categories-get-all');
for(i=0;i<getMainCategorieProducts.length;i++){
    getMainCategorieProducts[i].onclick = function(){
        var catValue = encodeURIComponent(this.getAttribute('value'))
        window.location.href = 'index.php?com=getMainCategorieProducts&categorie='+catValue+'';
        
    }

    
}

var getSubCategorieProducts = document.getElementsByClassName('sub-categories-get-all')
    for(i=0;i<getSubCategorieProducts.length;i++){
        getSubCategorieProducts[i].onclick = function(){
            var catValue = encodeURIComponent(this.getAttribute('value'))
            window.location.href = 'index.php?com=getSubCategorieProducts&categorie='+catValue+'';
            
        }
    }
var getMarkaProducts = document.getElementsByClassName('marka-button')
    for(i=0;i<getMarkaProducts.length;i++){
        getMarkaProducts[i].onclick = function(){
            var markaValue = encodeURIComponent(this.getAttribute('value'))
            window.location.href = 'index.php?com=getMarkaProducts&marka='+markaValue+'';
            
        }
    }









// COLORS ****************************



// WARNING POPUPS ****************************************

var warnPopupLock = false;
var isMovingImage = false;
var warnPopup = document.getElementsByClassName('warn-popup')[0];
if (warnPopup){
    warnPopup.addEventListener('mouseover',function(){
        this.style.transition = '0s';
        this.style.opacity = '1';
        warnPopupLock = true;
})
    warnPopup.addEventListener('mouseout',function(){
        this.style.transition = '10s';
        this.style.opacity = '0';
        warnPopupLock = false;
        setTimeout(function(){if(warnPopupLock == false){document.getElementsByClassName('warn-popup')[0].style.display = "none";}},20000)
    
})
    
    document.getElementsByClassName('warn-popup')[0].style.transition = '20s';
    document.getElementsByClassName('warn-popup')[0].style.opacity = '0';
    setTimeout(function(){if(warnPopupLock == false){document.getElementsByClassName('warn-popup')[0].style.display = "none";}},20000);
    document.getElementsByClassName('warn-popup')[0].getElementsByTagName('img')[0].addEventListener('click' ,function(){document.getElementsByClassName('warn-popup')[0].style.display = "none"});
}




    // LOGIN LINK ****************************

if(document.getElementsByClassName('login-link')[0]){
    var modal = document.getElementsByClassName('window')[0];
    var modalCloseButton =  document.getElementsByClassName('login-modal-close-button')[0];
    modal.style.display = 'none';
    document.getElementsByClassName('login-link')[0].addEventListener('click' , function(){
        
        
        

        if(modal.style.display == 'none'){
            modal.style.display = 'block';
            modal.style.transition = '1s';
            setTimeout(function(){modal.style.width = '30%';},100)
            setTimeout(function(){modalCloseButton.style.display = 'block';},1000)
        }else{
            modal.style.width = '0';
            modal.style.transition = '1s';
            modalCloseButton.style.display = 'none';
            setTimeout(function(){modal.style.display = 'none'},1000)
        }
    
    })
}

// LOGIN MODAL CLOSE BUTTON ******************

document.getElementsByClassName('login-modal-close-button')[0].addEventListener('click',function(){
   var modal = document.getElementsByClassName('window')[0];
   modal.style.width = '0';
   document.getElementsByClassName('login-modal-close-button')[0].style.display = 'none';
   setTimeout(function(){modal.style.display = 'none'},1000)
})

















// LEFT HEADER ****************************************************** \\

var leftHeader = document.getElementById('leftHeader');
var leftHeaderContent = document.getElementById('leftHeaderContent');
var leftHeaderImg = document.getElementById('menuImgId');
leftHeader.onmouseover = function() {showColon()};
leftHeader.onmouseout = function() {hideColon()};
leftHeaderContent.style.display = "none";

function showColon() {
    
    leftHeader.style.transition = "0.3s";
    leftHeader.style.backgroundColor = "#202020";
    leftHeaderImg.style.maxWidth = '100%';
    leftHeaderImg.style.transition = "1s";
    leftHeaderImg.style.opacity = '0';
    leftHeaderImg.style.pointerEvents = "none";
    leftHeaderContent.style.display = "block";
    leftHeaderImg.style.display = "none;"
    
    if(screen.width < 900){
        leftHeader.style.width = "50%";
    }else if (screen.width < 1000){
        leftHeader.style.width = "35%";
    }else if (screen.width > 1000){
        leftHeader.style.width = "25%";
        
    }
    
}

function hideColon() {
    leftHeader.style.transition = "0.5s";
    if(screen.width < 1400){
        leftHeader.style.width = "10%";
    }else{
        leftHeader.style.width = "5%";
    }
    
    leftHeader.style.backgroundColor = "#101010";
    leftHeaderContent.style.display = "none";
    leftHeaderImg.style.maxWidth = '25px';
    leftHeaderImg.style.opacity = '1';
    


}




// CATEGORIES *****************************-------------



var mainCatButtons = document.getElementsByClassName('main-cat-button')

for(i=0;i<mainCatButtons.length;i++){
    if(mainCatButtons[i].getAttribute('hasCat') == 'true'){
        mainCatButtons[i].addEventListener('click',function(){
            if(document.getElementById(this.getAttribute('value')).style.display == 'none'){

                
                document.getElementById(this.getAttribute('value')).style.display = 'block';
                var subButtons = document.getElementById(this.getAttribute('value')).getElementsByTagName('button')
                for(i=0;i<subButtons.length;i++){subButtons[i].style.background = 'rgba(120,120,120,1)'}

            }else{
                
                document.getElementById(this.getAttribute('value')).style.display = 'none';
            }
            
        })
        
    }else{
        mainCatButtons[i].addEventListener('click',function(){
            console.log(this)
        })
    }
}


var subCatButtons = document.getElementsByClassName('sub-cat-button')

for(i=0;i<subCatButtons.length;i++){
    if(subCatButtons[i].getAttribute('hasCat') == 'true'){
        
        
        subCatButtons[i].addEventListener('click',function(){
            this.style.background = 'rgba(255,0,0,0.1)'
            
            
            if(document.getElementById(this.getAttribute('value')).style.display == 'none'){
                
                document.getElementById(this.getAttribute('value')).style.display = 'block'
                var subButtons = document.getElementById(this.getAttribute('value')).getElementsByTagName('button')
                for(i=0;i<subButtons.length;i++){subButtons[i].style.background = 'rgba(160,160,160,1)'}
                
            }else{
                document.getElementById(this.getAttribute('value')).style.display = 'none';
                this.style.background = ''
            }
            
        })
    }else{
        subCatButtons[i].addEventListener('click',function(){
            
            console.log(this)
        })
    }
}



document.getElementsByClassName('main-cat')[0].style.display = 'none';
document.getElementById('categories-button').addEventListener('click',function(){
    this.style.background = 'rgba(50,50,50,1)';
    
    if(document.getElementsByClassName('main-cat')[0].style.display == 'none'){
        document.getElementsByClassName('main-cat')[0].style.display = 'block';
        document.getElementsByClassName('main-cat')[0].style.height = '100%';
        var buttonsStyle = document.getElementsByClassName('main-cat')[0].getElementsByTagName('button')
        for(i=0;i<buttonsStyle.length;i++){
            buttonsStyle[i].style.background = 'rgba(50,50,50,1)'
        }
        
        


        
    }else{
        
        this.style.background = '';
        document.getElementsByClassName('main-cat')[0].style.display = 'none';
        document.getElementsByClassName('main-cat')[0].style.height = '0%';
                var buttonsStyle = document.getElementsByClassName('main-cat')[0].getElementsByTagName('button')
        for(i=0;i<buttonsStyle.length;i++){
            buttonsStyle[i].style.background = ''
        }
        
       
    }
})




// HEADER SCRIPT END





// PAGE SCRIPT 

var goProductButtons = document.getElementsByClassName('card-button-go-product')

for(i=0;i<goProductButtons.length;i++){
    goProductButtons[i].onclick = function(){
        code = this.getAttribute('code')
        window.location.href = 'index.php?com=openProduct&productCode='+code+'';
        
    }
}


HomePage = document.getElementById('home-page-location')
showcaseTime = 5;

if(HomePage){


var addCardButton = document.getElementById('add-cart-add-button')



if(addCardButton){
        addCardButton.onclick = function(){
        if(login == true){
            
            var productCode = document.getElementById('add-cart').getAttribute('code')
            var productSize = document.getElementById('add-cart').getAttribute('size')
            var quantity = document.getElementById('add-cart-quantity-input').value
            
            xmlhttp = new XMLHttpRequest();
            form = new FormData();
            form.append('productCode',productCode)
            form.append('productSize',productSize)
            form.append('productQuantity',quantity)
            form.append('com','addCart')
            
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    alert(this.responseText)
                    closeAddCart();
                    
                }
            }
            xmlhttp.open('POST','../pages/cart.php')
            xmlhttp.send(form)
        }else{
            alert('Giriş Yapın yada kayıt')
        }
    }

}




var quantityDecreament = document.getElementById('add-cart-quantity-decreament')
var quantityIncreament = document.getElementById('add-cart-quantity-increament')
var quantityInput = document.getElementById('add-cart-quantity-input')
var sizeStock = 0;

// Increase decrease quantity item adding cart

if(quantityDecreament){
    quantityDecreament.onclick = function(){
        var valueInput = parseInt(quantityInput.value);
        if(valueInput > 1){
            quantityInput.value = valueInput - 1;
        }
    }
}


if(quantityIncreament){quantityIncreament.onclick = function(){
        var valueInput = parseInt(quantityInput.value)
        if(valueInput<sizeStock){
            quantityInput.value = valueInput + 1;
        }
    }
}


// Close add cart function
function closeAddCart(){
    addCardDiv = document.getElementById('add-cart');
    addCardDiv.childNodes[0].remove();
    addCardDiv.style.display = 'none';
    var productSizeHolder = document.getElementById('add-cart-product-size-holder')
    productSizeHolder.innerHTML = '';

    
}
var closeAddCartButton = document.getElementById('add-cart-close-button')

// Close Cart Add

if(closeAddCartButton){closeAddCartButton.onclick = function(){closeAddCart();}}



function showAddCart(productCode){
    var addCardDiv = document.getElementById('add-cart')
    addCardDiv.setAttribute('code',productCode)
    var cloneProduct = document.getElementById(productCode).cloneNode(true);
    var productSizes = document.getElementById(productCode+'-product-sizes')
    var productSizesNames = productSizes.getElementsByClassName('product-size-name')
    var productSizesStocks = productSizes.getElementsByClassName('product-size-stock')
    var productSizeHolder = document.getElementById('add-cart-product-size-holder')
    if(addCardDiv.style.display == 'block'){       addCardDiv.childNodes[0].remove();       productSizeHolder.innerHTML = '';    }
    if(productSizesNames.length<1){  sizeStock = 999;}
    for(i=0;i<productSizesNames.length;i++){
        var sizeNameP = document.createElement('button');
        sizeNameP.innerHTML = productSizesNames[i].innerHTML + ':'+ productSizesStocks[i].innerHTML;
        sizeNameP.setAttribute('class','add-cart-product-sizes');
        sizeNameP.setAttribute('stock',productSizesStocks[i].innerHTML)
        sizeNameP.setAttribute('size',productSizesNames[i].innerHTML)
        sizeNameP.onclick = function(){
            sizeStock = this.getAttribute('stock')
            var buttonsStockSize = document.getElementsByClassName('add-cart-product-sizes')
            for(ii=0;ii<buttonsStockSize.length;ii++){
                buttonsStockSize[ii].style.background = 'rgba(239,239,239,1)';
            }
            this.style.background = 'rgb(0,175,0)';
            addCardDiv.setAttribute('size',this.getAttribute('size'))
            quantityInput.value = "1";
        }
        productSizeHolder.appendChild(sizeNameP);
        
    }
    
    cloneProduct.removeChild(cloneProduct.getElementsByClassName('card-button-add-cart')[0])
    cloneProduct.removeChild(cloneProduct.getElementsByClassName('card-button-go-product')[0])
    cloneProduct.style.display = 'block';
    addCardDiv.insertBefore(cloneProduct,addCardDiv.childNodes[0]);
    addCardDiv.style.display = 'block';
    
}


var cardButtons = document.getElementsByClassName('card-button-add-cart')
for(i=0;i<cardButtons.length;i++){
    cardButtons[i].onclick = function(){
        var productCode = this.getAttribute('value')
        console.log(productCode)
        showAddCart(productCode);
    }
}





var mainPage = document.getElementById('main-page')
var cards = document.getElementsByClassName('card-main');
var showcaseLeftButton = document.getElementById('showcase-left-button')
var showcaseRightButton = document.getElementById('showcase-right-button')
var showcaseAllImages = document.getElementById('all-shows')
var showcaseAllImagesDiv = document.getElementsByClassName('all-shows-img')
var showcaseShowingImages = document.getElementsByClassName('showcase-show-image');
var imageButtonColor = "rgba(0, 255, 0,0.3)";


/* VARIANTS VARIABLES */
var productVariants = document.getElementsByClassName('product-variants')
var variantsDiv = document.getElementById('products-variants')
var variantButtons = document.getElementsByClassName('variant-buttons')

mainPage.insertBefore(variantsDiv,mainPage.firstChild)


function showCards(){
    for(i=0;i<cards.length;i++){
        cards[i].style.display = 'block';
    }
}

for(i=0;i<variantButtons.length;i++){
    var defaultColor = 'rgb(239,239,239)'
    variantButtons[i].onclick = function(){
        showing = [];

        for(ic=0;ic<variantButtons.length;ic++){
            variantButtons[ic].style.background = defaultColor;
        }
        if(this.getAttribute('clicked') == 'true'){
            this.setAttribute('clicked','false')
            this.style.background = defaultColor;
            showCards();
        }else{

            for(ic=0;ic<variantButtons.length;ic++){
                variantButtons[ic].setAttribute('clicked','false')
            }
            this.setAttribute('clicked','true')
            this.style.background = 'rgba(255,0,0,0.5)';
            showCards();
            for(i=0;i<cards.length;i++){
                cards[i].style.display = 'none';
            }
            for(ii=0;ii<productVariants.length;ii++){
                if (productVariants[ii].getAttribute('variantvalue') == this.getAttribute('variantvalue')){
                    showing.push(productVariants[ii].getAttribute('code'))
         
                
                }
            }
        }
        showing.forEach(function(item,index){document.getElementById(item).style.display = 'block'})
    }
}


if(showcaseTime == 0 ){
    showcaseTime = 5000;
}else{
    showcaseTime = showcaseTime * 1000;
}
console.log(showcaseTime)
function showcaseTimedChange(){
    var showcaseImages = document.getElementsByClassName('showcase-show-image')
    var currentIndex = 0;
    setTimeout(function(){
        for(i=0;i<showcaseImages.length;i++){
            if(showcaseImages[i].getAttribute('showing') == 'true'){
                currentIndex = parseInt(showcaseImages[i].getAttribute('id'));

            }
        showcaseImages[i].style.display = 'none';
        showcaseImages[i].setAttribute('showing' , 'false')
        }
        currentIndex = currentIndex + 1;

        if(currentIndex > showcaseImages.length - 1){
            
            showcaseImages[0].setAttribute('showing','true');
            showcaseImages[0].style.display  = 'block';
            showcaseImages[0].style.opacity = '0'
            setTimeout(function(){selectShowcaseDiv(0);showcaseImages[0].style.opacity = "1"},100)
            showcaseTimedChange()
        }else{
        
        showcaseImages[currentIndex].setAttribute('showing','true');
        showcaseImages[currentIndex].style.display  = 'block';
        showcaseImages[currentIndex].style.opacity = '0'
        setTimeout(function(){selectShowcaseDiv(currentIndex);showcaseImages[currentIndex].style.opacity = "1"},100)
        showcaseTimedChange()
        }
    },showcaseTime)
}

showcaseTimedChange();







function selectShowcaseDiv(black){
    for(ix=0;ix<showcaseAllImagesDiv.length;ix++){
        showcaseAllImagesDiv[ix].getElementsByTagName('img')[0].style.borderColor = 'white'
    }
    showcaseAllImagesDiv[black].getElementsByTagName('img')[0].style.borderColor = 'black';
}



for(i=0;i<showcaseAllImagesDiv.length;i++){
    showcaseAllImagesDiv[i].setAttribute('index',i)
    showcaseAllImagesDiv[i].onclick = function(){
        var divIndex = this.getAttribute('index')
        
        for(ii=0;ii<showcaseShowingImages.length;ii++){
            showcaseShowingImages[ii].style.display = 'none';
            showcaseShowingImages[ii].style.opacity = '0';
        }

        setTimeout(function(){showcaseShowingImages[divIndex].style.opacity = '1';},100)
        showcaseShowingImages[this.getAttribute('index')].style.display = 'block';
        selectShowcaseDiv(divIndex);
    } 
}

showcaseLeftButton.onclick = function(){
    showcaseShowingImages = document.getElementsByClassName('showcase-show-image');
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

showcaseRightButton.onclick = function(){
    showcaseShowingImages = document.getElementsByClassName('showcase-show-image');
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


var showcase = document.getElementById('showcase')
showcase.onmouseover = function(){
    var allShows = document.getElementById('all-shows')
    
    allShows.style.opacity = "1";
}

showcase.onmouseout = function(){
    var allShows = document.getElementById('all-shows')
    
    allShows.style.opacity = "0";
}





















 // CHANGE IMAGE ******************************
 
 
    var mouseEvent = false;
    var mouseDownPoint = 0;
    var changeTo = 'none';
    var cardIndex = -1;
    var imageValue = -1;
    var widthPoint = 100;
    var isMouseOut = false
    var isMouseUp = true;
    var isChanging = false;
    var lastPoint = 0;
    var changeTo = '';



for (let i = 0; i < cards.length; i++){
    
    var image = cards[i].getElementsByClassName('showing-image-left')[0]
    image.setAttribute('draggable' , 'false');
    
    
    
    
    
    // TOUCH ***************
    
    
    
    var isTouchEnd = false;
    var touchRotation = 'none';
    var xStart = 0;
    var touchWidthPoint = 100;
    
    
    
    
    
    function imageWidthRight(touchWidthPointPercent){
        cards[i].getElementsByClassName('showing-image-left')[0].style.borderTopLeftRadius = '25%'
        cards[i].getElementsByClassName('showing-image-left')[0].style.borderBottomLeftRadius = '25%'
        cards[i].getElementsByClassName('showing-image-left')[0].style.transition = '0.5s';
        cards[i].getElementsByClassName('showing-image-left')[0].style.float = 'right';
        cards[i].getElementsByClassName('showing-image-left')[0].style.width = touchWidthPointPercent
    }
    function imageWidthLeft(touchWidthPointPercent){
        cards[i].getElementsByClassName('showing-image-left')[0].style.borderTopRightRadius = '25%'
        cards[i].getElementsByClassName('showing-image-left')[0].style.borderBottomRightRadius = '25%'
        cards[i].getElementsByClassName('showing-image-left')[0].style.transition = '0.5s';
        cards[i].getElementsByClassName('showing-image-left')[0].style.float = 'left';
        cards[i].getElementsByClassName('showing-image-left')[0].style.width = touchWidthPointPercent
    }
    
    function imageWidthNormalRight(){
        cards[i].getElementsByClassName('showing-image-left')[0].style.borderTopLeftRadius = '0%'
        cards[i].getElementsByClassName('showing-image-left')[0].style.borderBottomLeftRadius = '0%'
        cards[i].getElementsByClassName('showing-image-left')[0].style.transition = '0.5s';
        cards[i].getElementsByClassName('showing-image-left')[0].style.float = 'right';
        cards[i].getElementsByClassName('showing-image-left')[0].style.width = '100%'
    }
    function imageWidthNormalLeft(){
        cards[i].getElementsByClassName('showing-image-left')[0].style.borderTopRightRadius = '0%'
        cards[i].getElementsByClassName('showing-image-left')[0].style.borderBottomRightRadius = '0%'
        cards[i].getElementsByClassName('showing-image-left')[0].style.transition = '0.5s';
        cards[i].getElementsByClassName('showing-image-left')[0].style.float = 'left';
        cards[i].getElementsByClassName('showing-image-left')[0].style.width = '100%'
    }
    

    cards[i].getElementsByClassName('showing-image-left')[0].addEventListener('touchstart',function(event){
        
        isTouchEnd = false;
        xStart = event.touches[0].clientX;
        touchWidthPoint = 100;

    },{passive:true})
    
    cards[i].getElementsByClassName('showing-image-left')[0].addEventListener('touchmove' , function(event){
        var xNow = event.touches[0].clientX;
        if(xNow > xStart){
                if(isTouchEnd == false){
                    touchRotation = 'left';
                    touchWidthPoint = touchWidthPoint - 5
                    touchWidthPointPercent = touchWidthPoint + '%'
                    imageWidthRight(touchWidthPointPercent);
                }

            }else if(xNow < xStart ){
                if(isTouchEnd == false){
                    touchRotation = 'right';
                    touchWidthPoint = touchWidthPoint - 5
                    touchWidthPointPercent = touchWidthPoint + '%'
                    imageWidthLeft(touchWidthPointPercent);
                }
                
            }
            
            
    },{passive:true})
    
    cards[i].getElementsByClassName('showing-image-left')[0].addEventListener('touchend',function(){
        if(touchRotation == 'left'){
            imageWidthNormalRight();
            isTouchEnd = true;
            if(touchWidthPoint < 70 ){
                cardIndex = i;
                changeTo = 'left';
                changeImage(changeTo,cardIndex)
            }
        }else if(touchRotation = 'right'){
            imageWidthNormalLeft();
            isTouchEnd = true;
            if(touchWidthPoint < 70){
                cardIndex = i;
                changeTo = 'right';
                changeImage(changeTo,cardIndex)
            }
        }
    },{passive:true})
    
    
    
    
    
    
    
    
    // MOUSE *************
    


    cards[i].getElementsByClassName('showing-image-left')[0].addEventListener('mousedown' , function(event){
        
        alreadyChanging = false;
        
        

        
        
        
        
        widthPoint = 100;
        isMouseUp = false;
        isMouesOut = false;
        lastPoint = 0;
        isChanging = false;
        mouseEvent = true;
        isMouseOut = false;
        mouseDownPoint = event.x;


        function revertImageSizeRight(){
            cards[i].getElementsByClassName('showing-image-left')[0].style.float = 'right';
            cards[i].getElementsByClassName('showing-image-left')[0].style.width = '100%';
            cards[i].getElementsByClassName('showing-image-left')[0].style.transition = '1s';
            cards[i].getElementsByClassName('showing-image-left')[0].style.borderTopLeftRadius = '0%'
            cards[i].getElementsByClassName('showing-image-left')[0].style.borderBottomLeftRadius = '0%' 
            cards[i].getElementsByClassName('showing-image-left')[0].style.cursor = 'grab';
            widthPoint = 100;
        }
        function revertImageSizeLeft(){
            cards[i].getElementsByClassName('showing-image-left')[0].style.float = 'left';
            cards[i].getElementsByClassName('showing-image-left')[0].style.width = '100%';
            cards[i].getElementsByClassName('showing-image-left')[0].style.transition = '1s'
            cards[i].getElementsByClassName('showing-image-left')[0].style.borderTopRightRadius = '0';
            cards[i].getElementsByClassName('showing-image-left')[0].style.borderBottomRightRadius = '0';
            cards[i].getElementsByClassName('showing-image-left')[0].style.cursor = 'grab';
            widthPoint = 100;
        }

        // Mouse up without move
        image.onmouseup = function(){if(widthPoint == 100){isMouseUp = true}}
        
        cards[i].getElementsByClassName('showing-image-left')[0].onmousemove = function(event){


            
            if(isMouseUp == false){
                cards[i].getElementsByClassName('showing-image-left')[0].style.cursor = 'grabbing';
                cards[i].getElementsByClassName('card-details')[0].style.height = '0';
                    if(event.x > mouseDownPoint + 10 ){
                        if(widthPoint > 0){
                            if(event.x < lastPoint){
                                if(widthPoint < 100){widthPoint = widthPoint + 5}
                                    cards[i].getElementsByClassName('showing-image-left')[0].onmouseout = function(){
                                        if(isMouseUp == false){
                                            if(isChanging == false){
                                                revertImageSizeRight();
                                                isMouseUp = true;
                                                isMouseOut = true;
                                            }
                                        }
                                    }
                                }else{
                                    widthPoint = widthPoint - 5;
                                    lastPoint = event.x
                                    cards[i].getElementsByClassName('showing-image-left')[0].onmouseup = function(){
                                        if(widthPoint < 70){
                                            if(cards[i].getElementsByClassName('showing-image-left')[0].getAttribute('value') > 0) {
                                                if(isMouseOut == false){
                                                    isChanging = true;
                                                    cardIndex = i;
                                                    changeTo = 'left'
                                                    changeImage(changeTo,cardIndex)
                                                    isMouseUp = true
                                                    widthPoint = 100;
                                                    cards[i].getElementsByClassName('showing-image-left')[0].style.cursor = 'grab'
                                                    
                                                    
                                                }else{revertImageSizeRight();isMouseUp = true;console.log(isMouseUp)}
                                            }else{revertImageSizeRight();isMouseUp = true;console.log(isMouseUp)}
                                        }else{revertImageSizeRight();isMouseUp = true;console.log(isMouseUp)}
                                    }
                                    cards[i].getElementsByClassName('showing-image-left')[0].onmouseout = function(){
                                        if(isMouseUp == false){
                                            if(isChanging == false){
                                                revertImageSizeRight();
                                                isMouseUp = true;
                                                isMouseOut = true;
                                            }
                                        }
                                    }
                                }
                            
                            widthStyle = widthPoint + '%'
                    
                    }else{
                        if(widthPoint > 0){ --widthPoint }
                        widthStyle = widthPoint + '%'
                    }
                        cards[i].getElementsByClassName('showing-image-left')[0].style.float = 'right';
                        cards[i].getElementsByClassName('showing-image-left')[0].style.transition = '1s';
                        cards[i].getElementsByClassName('showing-image-left')[0].style.width = widthStyle;
                        cards[i].getElementsByClassName('showing-image-left')[0].style.borderTopLeftRadius = '25%'
                        cards[i].getElementsByClassName('showing-image-left')[0].style.borderBottomLeftRadius = '25%'
    
                }else if(event.x < mouseDownPoint - 10){

                        if(widthPoint > 0){
                            if(event.x < lastPoint){
                                if(widthPoint < 100){widthPoint = widthPoint - 5}
                                    cards[i].getElementsByClassName('showing-image-left')[0].onmouseout = function(){
                                        if(isMouseUp == false){
                                            if(isChanging == false){
                                                revertImageSizeLeft();
                                                isMouseUp = true;
                                                isMouseOut = true;
                                            }
                                        }
                                    }
                                }else{
                                    widthPoint = widthPoint - 5;
                                    lastPoint = event.x
                                    cards[i].getElementsByClassName('showing-image-left')[0].onmouseup = function(){
                                        if(widthPoint < 70){
                                            if(parseInt(cards[i].getElementsByClassName('showing-image-left')[0].getAttribute('value')) + 1 < cards[i].getElementsByClassName('img-list')[0].getElementsByClassName('l-image').length) {
                                                
                                                if(isMouseOut == false){
                                                    isChanging = true;
                                                    cardIndex = i;
                                                    changeTo = 'right'
                                                    changeImage(changeTo,cardIndex)
                                                    isMouseUp = true
                                                    widthPoint = 100;
                                                }else{revertImageSizeLeft();isMouseUp = true;}
                                            }else{revertImageSizeLeft();isMouseUp = true}
                                        }else{revertImageSizeLeft();isMouseUp = true}
                                    }
                                    cards[i].getElementsByClassName('showing-image-left')[0].onmouseout = function(){
                                        if(isMouseUp == false){
                                            if(isChanging == false){
                                                revertImageSizeLeft();
                                                isMouseUp = true;
                                                isMouseOut = true;
                                            }
                                        }
                                    }
                                }
                            
                            widthStyle = widthPoint + '%'
                    
                    }else{
                        if(widthPoint > 0){ --widthPoint }
                        widthStyle = widthPoint + '%'
                    }
                        cards[i].getElementsByClassName('showing-image-left')[0].style.float = 'left';
                        cards[i].getElementsByClassName('showing-image-left')[0].style.transition = '1s';
                        cards[i].getElementsByClassName('showing-image-left')[0].style.width = widthStyle;
                        cards[i].getElementsByClassName('showing-image-left')[0].style.borderTopRightRadius = '25%'
                        cards[i].getElementsByClassName('showing-image-left')[0].style.borderBottomRightRadius = '25%'
    
                }
            }
    
        }
            

    })
    
    

    
    
}


// CHANGE IMAGE FUNCTION ********************************

function changeImage(changeTo,cardIndex){
    

    
    
    card = cards[cardIndex];
    cardImageList = card.getElementsByClassName('img-list')[0].getElementsByClassName('l-image');
    listLength = parseInt(cardImageList.length) - 1;
    cardImage = card.getElementsByClassName('showing-image-left')[0];
    imageValue = cardImage.getAttribute('value');
    imageButtons = cards[cardIndex].getElementsByClassName('image-button');
    cardImage.style.cursor = 'grab'
    
    
    if (changeTo == 'right'){
        imageValue = parseInt(imageValue) + 1;

        if (imageValue <= listLength){
            cardImage.style.float = 'left';
            cardImage.style.width = '0';
            cardImage.style.borderTopRightRadius = '25%';
            cardImage.style.borderBottomRightRadius = '25%';
            cardImage.style.transition = '0.5s';
            cardImage.setAttribute('value',imageValue);
            
            
            for(let i = 0; i < imageButtons.length; i++){imageButtons[i].style.backgroundColor = 'white';}
            imageButtons[imageValue].style.background = imageButtonColor ;

            setTimeout(function(){
                cardImage.setAttribute('src',cardImageList[imageValue].getAttribute('src'));
                for(i=0;i<cards.length;i++){
                    
                cards[i].getElementsByClassName('showing-image-left')[0].style.float = 'right';
                cards[i].getElementsByClassName('showing-image-left')[0].style.width = '100%';
                cards[i].getElementsByClassName('showing-image-left')[0].style.borderTopRightRadius = '0';
                cards[i].getElementsByClassName('showing-image-left')[0].style.borderBottomRightRadius = '0';
                }
                
         
                },500);
        }
            
        



        
    }else if (changeTo == 'left'){
        imageValue = imageValue - 1;
            if (imageValue >= 0){
            cardImage.style.float = 'right';
            cardImage.style.width = '0';
            cardImage.style.borderTopLeftRadius = '25%';
            cardImage.style.borderBottomLeftRadius = '25%';
            cardImage.style.transition = '0.5s';
            cardImage.setAttribute('value',imageValue);
            for(let i = 0; i < imageButtons.length; i++){imageButtons[i].style.backgroundColor = 'white';}
            
            imageButtons[imageValue].style.background = imageButtonColor ;
            setTimeout(function(){
                cardImage.setAttribute('src',cardImageList[imageValue].getAttribute('src'));
                for(i=0;i<cards.length;i++){
                cards[i].getElementsByClassName('showing-image-left')[0].style.float = 'left';
                cards[i].getElementsByClassName('showing-image-left')[0].style.width = '100%';
                cards[i].getElementsByClassName('showing-image-left')[0].style.borderTopLeftRadius = '0';
                cards[i].getElementsByClassName('showing-image-left')[0].style.borderBottomLeftRadius = '0';
                }
                

                },500);
            }


        
    }
    



}




// CREATING IMAGE BUTTONS *******************************

for (let i = 0 ; i < cards.length; i++){
    var cardImages = cards[i].getElementsByClassName('img-list')[0].getElementsByClassName('l-image');
    var cardImageButtons = cards[i].getElementsByClassName('image-buttons')[0];
    for (let ii = 0 ; ii < cardImages.length; ii++){
        if (ii == 0){
            cardImageButtons.innerHTML = cardImageButtons.innerHTML + '<div value = '+i+' class = "image-button" style = "background:' + imageButtonColor + '"> </button>'
        }else{
            cardImageButtons.innerHTML = cardImageButtons.innerHTML + '<div value = '+i+' class = "image-button"> </button>'
        }
            
    }
    
}

for (let i = 0; i<cards.length;i++){
    var cardImageButtons = cards[i].getElementsByClassName('image-buttons')[0]
    var buttons = cardImageButtons.getElementsByClassName('image-button');
    for(let ii = 0; ii<buttons.length;ii++){
        buttons[ii].addEventListener('click' , function(){
        var cardImageButtons = cards[i].getElementsByClassName('image-buttons')[0]
        var buttons = cardImageButtons.getElementsByClassName('image-button');
            for(let ii = 0; ii<buttons.length;ii++){buttons[ii].style.backgroundColor = 'white';}
            this.style.background = imageButtonColor ;
            cardImage = cards[i].getElementsByClassName('showing-image-left')[0];
            cardImageList = cards[i].getElementsByClassName('img-list')[0].getElementsByClassName('l-image');
            cardImage.style.float = 'top';
            cardImage.style.height = '0';
            cardImage.style.width = '100%'
            cardImage.style.borderBottomLeftRadius = '255px';
            cardImage.style.borderBottomRightRadius = '255px';
            cardImage.style.transition = '0.5s';
            cardImage.setAttribute('value', ii);
            setTimeout(function(){
                cardImage.style.height = '100%';
                cardImage.setAttribute('src',cardImageList[ii].getAttribute('src'));
                cardImage.style.borderBottomLeftRadius = '0';
                cardImage.style.borderBottomRightRadius = '0';
                cardImage.style.borderTopLeftRadius = '0';
                cardImage.style.borderTopRightRadius = '0';
                },500);
                



            })
    }
}


/* DETAILS *-------------------------------------------------*/

for (let i = 0; i < cards.length; i++) {
    console.log(i)
    cards[i].getElementsByClassName('card-details')[0].style.height = '0';
    cards[i].getElementsByClassName('showing-image-left')[0].style.cursor = 'grab';
    cards[i].addEventListener('mouseover', function(){cards[i].getElementsByClassName('card-details')[0].style.height = '40%';cards[i].getElementsByClassName('card-details')[0].style.transition = '0.5s'; });
    cards[i].addEventListener('mouseout', function(){cards[i].getElementsByClassName('card-details')[0].style.height = '0';cards[i].getElementsByClassName('card-details')[0].style.transition = '0.5s'; });
    cards[i].getElementsByClassName('showing-image-left')[0].setAttribute('src',cards[i].getElementsByClassName('img-list')[0].getElementsByClassName('l-image')[0].getAttribute('src'));
}



var carouselCloseButton = document.getElementById('carousel-close-button')
carouselCloseButton.onclick = function(){
    this.parentElement.style.display = 'none';
}
var zoomingCardImageButtons = document.getElementsByClassName('zoom-image')

for(i=0;i<zoomingCardImageButtons.length;i++){
    zoomingCardImageButtons[i].setAttribute('index',i)
    zoomingCardImageButtons[i].onclick = function(){
        var carousel = document.getElementById('carousel')
        var carouselBigImage = document.getElementById('carousel-big-image')
        var cardMains = document.getElementsByClassName('card-main')
        var cardMainImage = cardMains[this.getAttribute('index')].getElementsByClassName('showing-image-left')[0].src
        var carouselImageList = document.getElementById('carousel-image-list')
        carouselImageList.innerHTML = '';
        var cardImages = cardMains[this.getAttribute('index')].getElementsByClassName('img-list')[0].getElementsByTagName('img');

        if(carousel.style.display == 'none'){
            carousel.style.display = 'block';
            carouselBigImage.src = cardMainImage;
            for(im=0;im<cardImages.length;im++){
                var smDiv = document.createElement('div')
                smDiv.style.display = 'block';
                smDiv.style.margin = '3px';
                smDiv.setAttribute('style','border-radius:5px;border:solid 1px white;margin:5px;transition:1s;')
                smDiv.onmouseover = function(){this.style.transform = 'scale(1.3)'}
                smDiv.onmouseout = function(){this.style.transform = 'scale(1)'}
                smDiv.onclick = function(){
                    var imageLinkDiv = this.getElementsByTagName('img')[0].src
                    carouselBigImage.style.opacity = 0;
                    carouselBigImage.style.transition = '0.3s';
                    setTimeout(function(){carouselBigImage.style.opacity = 1;carouselBigImage.src = imageLinkDiv},300)
                }
                var smImage = document.createElement('img')
                smImage.src = cardImages[im].src
                smImage.setAttribute('style','border-radius:4px;width:100px;height:100px;') ;
                smDiv.appendChild(smImage)
                carouselImageList.appendChild(smDiv)
            }
        }else{
            carousel.style.display = 'none';
        }
    }
    zoomingCardImageButtons[i].onmouseover = function(){this.style.transform = 'scale(1.3)'}
    zoomingCardImageButtons[i].onmouseout = function(){this.style.transform = 'scale(1.0)'}
}


} // ENDING LOCATING HOME PAGE 
// PAGE SCRIPT END













// ORDERS SCRIPT

allOrders = document.getElementsByClassName('my-orders-p')

for(i=0;i<allOrders.length;i++){
    allOrders[i].onclick = function(){
        var orderid = this.getAttribute('order-id')
        var order = document.getElementById(orderid);
        if(order.style.display == 'none'){
            order.style.display = 'block';
        }else{
            order.style.display = 'none';
        }
    }
}











// CART PHP

cartPage = document.getElementById('cart-page-location')

if(cartPage){
var orderButton = document.getElementById('order-cart-button')

orderButton.onclick = function(){
    var uuid = Math.floor(Math.random() * 1000000000);
    var allProducts = document.getElementsByClassName('cart-products-product')
    products = [];
    form = new FormData();
    xmlhttp = new XMLHttpRequest;
    if(allProducts.length>0){
    for(i=0;i<allProducts.length;i++){
        
        var productCode = allProducts[i].getAttribute('code')
        var singlePrice = allProducts[i].getAttribute('single-price')
        var totalPrice = allProducts[i].getAttribute('total-price')
        var label = allProducts[i].getAttribute('label')
        var size = allProducts[i].getAttribute('size')
        var quantity = allProducts[i].getAttribute('quantity')


        form.append('productCodes['+i+']',productCode)
        form.append('productSinglePrices['+i+']',singlePrice)
        form.append('productTotalPrices['+i+']',totalPrice)
        form.append('labels['+i+']',label)
        form.append('sizes['+i+']',size)
        form.append('quantitys['+i+']',quantity)
        
 

     
        
    }
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status){
            alert(this.responseText)
            loaded();
            location.reload();
        }
    }
    form.append('orderid' , uuid)
    form.append('com','test')
    xmlhttp.open('POST','../pages/cart.php')
    xmlhttp.send(form)
    loading();
}

}

var removeProductCartButtons = document.getElementsByClassName('remove-product-from-cart')


for(i=0;i<removeProductCartButtons.length;i++){
    removeProductCartButtons[i].onclick = function(){
        var productCode = this.getAttribute('code')
        var productPrice = parseInt(document.getElementById(productCode+'-product-price').innerHTML);
        var productCount = parseInt(document.getElementById(productCode+'-product-quantity').innerHTML);
        var xmlhttp = new XMLHttpRequest;
        form = new FormData();
        form.append('productCode',productCode)
        form.append('com', 'removeProductFromCart')
        self = this;
        xmlhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                self.parentElement.remove();
                loaded();
                var totalProductPrice = document.getElementById('total-product-price')
                var totalProductCount = document.getElementById('total-product-quantity')
                var totalPrice = productPrice ;
                totalProductPrice.innerHTML = parseInt(totalProductPrice.innerHTML) - totalPrice ;
                totalProductCount.innerHTML = parseInt(totalProductCount.innerHTML) - productCount;
                
                alert(this.responseText)
            }
        }
        xmlhttp.open('POST', '../pages/cart.php')
        xmlhttp.send(form)
        loading();
    }
}




var increamentQuantityButtons = document.getElementsByClassName('change-quantity-button-increament')
var decreamentQuantityButtons = document.getElementsByClassName('change-quantity-button-decreament')

for(i=0;i<increamentQuantityButtons.length;i++){
    increamentQuantityButtons[i].onclick = function(){
        var productCode = this.getAttribute('code')
        var productQuantity = document.getElementById(productCode+'-product-quantity')
        var productQuantityValue = parseInt(productQuantity.innerHTML)
        var productPriceP = document.getElementById(productCode+'-product-price')
        var productPricePrice = parseInt(productPriceP.getAttribute('price'))
        var totalProductPrice = document.getElementById('total-product-price')
        var totalProductCount = document.getElementById('total-product-quantity')
        productQuantityValue = productQuantityValue + 1;
        productQuantity.innerHTML = productQuantityValue
        productPriceP.innerHTML = productQuantityValue * productPricePrice + ' TL'
        totalProductPrice.innerHTML = parseInt(totalProductPrice.innerHTML) + productPricePrice;
        totalProductCount.innerHTML = parseInt(totalProductCount.innerHTML) + 1;
        xmlhttp = new XMLHttpRequest ;
        form = new FormData();
        form.append('productCode',productCode)
        form.append('productQuantity',productQuantityValue)
        form.append('com','updateCartProductQuantity')
        xmlhttp.open('POST','../pages/cart.php')
        xmlhttp.send(form)
        xmlhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                loaded()
            }
        }
        loading();
    }
}

for(i=0;i<decreamentQuantityButtons.length;i++){
    decreamentQuantityButtons[i].onclick = function(){
        var productCode = this.getAttribute('code')
        var productQuantity = document.getElementById(productCode+'-product-quantity')
        var productQuantityValue = parseInt(productQuantity.innerHTML)
        var productPriceP = document.getElementById(productCode+'-product-price')
        var productPricePrice = parseInt(productPriceP.getAttribute('price'))
        var totalProductPrice = document.getElementById('total-product-price')
        var totalProductCount = document.getElementById('total-product-quantity')
        
        if(productQuantityValue > 1){
            productQuantityValue = productQuantityValue - 1;
            productQuantity.innerHTML = productQuantityValue
            productPriceP.innerHTML = productQuantityValue * productPricePrice + ' TL'
            
            totalProductPrice.innerHTML = parseInt(totalProductPrice.innerHTML) - productPricePrice;
            totalProductCount.innerHTML = parseInt(totalProductCount.innerHTML) - 1;
            xmlhttp = new XMLHttpRequest ;
            form = new FormData();
            form.append('productCode',productCode)
            form.append('productQuantity',productQuantityValue)
            form.append('com','updateCartProductQuantity')
            xmlhttp.open('POST','../pages/cart.php')
            xmlhttp.send(form)
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    loaded()
                }
            }
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

}




// CART END



























$("#registerBtn").click(function(){
	if ($("#resetPassword").hasClass("show")) {
		$("#resetBtn").click();
	}
});

$("#resetBtn").click(function(){
	if ($("#register").hasClass("show")) {
		$("#registerBtn").click();
	}
});

// Show/Hide password
$('.show-pass').click(function() {
	var label = $(this);
	var pass_field = $(this).siblings('input');

	if ($(pass_field).attr('type') === "password") {
		$(pass_field).attr('type','text');
		$(label).text('Hide password');
	} else {
		$(pass_field).attr('type','password');
		$(label).text('Show password');
	}
});

$('#updatePhoto').change(function() {
	if ($(this).get(0).files.length > 0) {
		$('#photoUploaded').show();
	} else {
		$('#photoUploaded').hide();
	}
});

if (window.matchMedia('(max-width: 767px)').matches) {
	$('.profile-photo').click(function() {
		$('.update-photo').toggle();
	});
}

$('#deleteAccount').click(function() {
	if (!confirm("Are you sure you want to delete your account?")) {
		return false;
	}
});


(function() {
	'use strict';
	window.addEventListener('load', function() {
		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		var forms = document.getElementsByClassName('needs-validation');
		// Loop over them and prevent submission
		var validation = Array.prototype.filter.call(forms, function(form) {
			form.addEventListener('submit', function(event) {
				if (form.checkValidity() === false) {
					event.preventDefault();
					event.stopPropagation();
				}
				form.classList.add('was-validated');
			}, false);
		});
	}, false);
})();


$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
