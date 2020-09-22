<?php
/**
 * Created by PhpStorm.
 * User: jjzavala
 * Date: 26/06/2020
 * Time: 09:53 AM
 */
    if(!isset($_COOKIE["Usuario"]))
    {
        define('HOMEDIR',__DIR__);

        include 'View/header.php';
        $page   =isset($_GET['page'])?$_GET['page']:'Empleados';
        $folder =isset($_GET['folder'])?$_GET['folder']:'Empleados';
        if(isset($_POST['btnSearch'])){
            $search     =true;
            $dataSearch =$_POST['dataSearch'];
        }
        include 'View/'.$page.'.php';
        include 'View/footer.php';

    }else
    {
        header("Location: login.php");
        exit;
    }