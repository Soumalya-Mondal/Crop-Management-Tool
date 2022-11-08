<?php
    if($_SERVER['REQUEST_METHOD']== 'POST'){
        echo $_POST['adminID'];
        echo $_POST['sadminPASSWORD'];
    }
?>