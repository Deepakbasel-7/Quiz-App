<?php 

if( isset( $_GET['item'] )) {


$page = $_GET['item'];

switch( $page ) {
    case 'categories':
        include_once("categories.php");
        break;

    case 'add':
        include_once("dashboard.php");
        break;
}
}