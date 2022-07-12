<?php   

    function validate_Str($str)
    {
        $regex = "/^[a-z A-Z 0-9 \- \_\/]{1,}$/";
        if(!preg_match($regex, $str))
        {
            return $error = 'Trường này không được bỏ trống!';
        }
    }

    function validate_Num($num){
        $regex_Null = "/^[a-z 0-9]{1,}$/";
        $regex_Num= "/^[0-9]{1,}$/";
        if(!preg_match($regex_Null, $num))
        {
            return $error = 'Trường này không được bỏ trống!';
        }
        if(!preg_match($regex_Num, $num)){
            return $error = 'Trường này nhận dữ liệu là số!';
        }
    }

    function validate_Email($email){
        $regex_Null = "/^[a-z A-Z 0-9 _ . @]{1,}$/";
        $regex_Email = "/^([a-z0-9_\.-]+)@([a-z.-]+)\.([a-z\.]{2,6})$/";
        if(!preg_match($regex_Null, $email))
        {
            return $error = 'Trường này không được bỏ trống!';
        }
        if(!preg_match($regex_Email, $email))
        {
            return $error = 'Email không hợp lệ!';
        }
    }

    function validate_Phone($num_Phone){
        $regex_Null = "/^[a-z 0-9]{1,}$/";
        $regex_Phone = "/^(0?)^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/";
        if(!preg_match($regex_Null, $num_Phone))
        {
            return $error = 'Trường này không được bỏ trống!';
        }
        else{
            if(!preg_match($regex_Phone, $num_Phone)){
                return $error = 'Số điện thoại không đúng định dạng!';
            }
        }    
    }

    function validate_Date($dateTime){
        $regex = "/^[0-9 \/ -]{1,}$/";
        if(!preg_match($regex, $dateTime))
        {
            return $error = 'Trường này không được bỏ trống!';
        }
    }
?>