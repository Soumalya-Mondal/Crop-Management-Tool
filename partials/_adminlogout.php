<?php
    session_start();
    session_unset();
    session_destroy();

    header('Location: /farm/partials/_adminpanel.php?panel=admin');
?>