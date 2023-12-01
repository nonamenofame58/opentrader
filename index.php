<?php
session_start();

include 'inc/functions.php';

if (!empty($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
	
}
$page = '';
if (isset($_GET['action'])) {
	if ($_GET['action'] == 'logout') {
		session_unset();
		session_destroy();
	}
}

if($_GET['com'] == 'openMyOrders'){
    if(isset($_SESSION['username'])){
        $page = 'myOrders';
    }
}

if($_GET['com'] == 'openCart'){
    if(isset($_SESSION['username'])){

        $page = 'cart';
    
        
    }
}


if($_GET['com'] == 'openProduct'){
    $page = 'product';
}



?>



<?php include 'pages/header.php'; ?>


<?php
    if($page == 'cart'){
        include 'pages/cart.php';
    }if($page == 'product'){
        include 'pages/product.php';
    }if($page == 'myOrders'){
        include  'pages/myorders.php';
    }if($page == ''){
        include 'pages/page.php';
    }
    
    
?>

<?php include 'footer.php'; ?>

