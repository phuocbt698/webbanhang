<?php
    function format_time($timestamp, $type = 'd/m/Y'){
        return date($type, strtotime($timestamp));
    }
?>