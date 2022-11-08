<?php
    session_start();
    session_unset();
    session_destroy();

    header('Location: /farm/partials/_farmerpanel.php?panel=farmer');
?>