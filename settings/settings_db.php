<?php
ob_start();

const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'martech_tender_request';


$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if(!$connection){
    die("Cant connect to database: ") . mysqli_connect_error();
}


$page = $_GET['page'] ?? "";

