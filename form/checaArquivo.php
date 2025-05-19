<?php

if (file_exists('../'.$_GET['path']))
    echo 1;
else
    echo 0;
?>