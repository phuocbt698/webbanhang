<?php
    define('doc_Root', $_SERVER['DOCUMENT_ROOT']) ;
    include_once doc_Root . "/database/config.php";

    function exeQuery($sql, $lastID = false)
    {
        $conn = mysqli_connect(HOST_NAME, USER_NAME, PASSWORD, DB_NAME);
        $conn->set_charset('utf-8');
        if(!$conn){
            die("Connection failed:" . mysqli_connect_error());
        }               
        if(mysqli_query($conn, $sql)){
            if($lastID){
                $id = mysqli_insert_id($conn);
                mysqli_close($conn);
                return $id;
            }
            else{
                mysqli_close($conn);
                return true;
            }
        }
        mysqli_close($conn);      
        return false;
    }

    /*
     *
     * Para $sql: Câu truy vấn, $isSingle: true chỉ về mảng một chiều, false chả về mảng 2 chiều 
     * 
     */
    function getData($sql, $isSingle = false){
        $data = null;
        $conn = mysqli_connect(HOST_NAME, USER_NAME, PASSWORD, DB_NAME);
        $conn->set_charset('utf-8');
        if(!$conn){
            die("Connection failed:" . mysqli_connect_error());
        }                
        $result = mysqli_query($conn, $sql);
        if($isSingle){
            $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
        else{
            $data = [];
            while(($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != null){
                $data[] = $row;
            }
        }
        mysqli_close($conn);
        return $data;
    }

    function create_slug($str){
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }
?>