<?php

    session_start();

    require_once '../model/db_conn.php';
        $id = 0;
        $name = "";
        $location ="";
    if(isset($_POST['save'])){
        $name       =$_POST['name'];
        $location   =$_POST['location'];

        if(empty($name)){
            $_SESSION['message'] = "User name is required";
            $_SESSION['msg_type']= "danger";
            header("Location:../view/index.php");
            exit();
        }else if(empty($location)){
            $_SESSION['message'] = "Location is required ";
            $_SESSION['msg_type']= "danger";
            header("Location:../view/index.php");
            exit();
        }else{




            $mysqli->query("INSERT INTO data(name,location) VALUES('$name','$location')") or die($mysqli->error);

            $_SESSION['message'] = "Data inserted successfully";
            $_SESSION['msg_type']= "success";

            header("Location:../view/index.php");
            exit();
        }
    }

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $mysqli->query("DELETE FROM data WHERE id='$id'");
        $_SESSION['message'] = "Data deleted successfully";
        $_SESSION['msg_type']= "success";
        header("Location:../view/index.php");
            exit();
    }

    if(isset($_GET['edit'])){

        $id = $_GET['edit'];
        $result = $mysqli->query("SELECT * FROM data WHERE id = '$id'") or die($mysqli->error());
        if(mysqli_num_rows($result)===1){
            $row = $result->fetch_assoc(); 
            $name = $row['name'];
            $location = $row['location'];
        }
    }

    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $location = $_POST['location'];

        $mysqli->query("UPDATE data SET name ='$name', location='$location' WHERE id='$id' ") or die($mysqli->error());
        $_SESSION['message'] = "Record was updated successfully";
        $_SESSION['msg_type']= "warning";
        header("Location:../view/index.php");
        
        exit();
    }