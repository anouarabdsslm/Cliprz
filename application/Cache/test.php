<!doctype html>
<html>
<head>
    <title>Hello</title>
</head>
<body>

<?php require('../../index.php'); ?>

<?php echo ((isset($anyVariable)) ? $anyVariable : 'invalid {anyVariable} variable'); ?>

<?php

$x = 1;
    echo 'Negix';
    if ($x == 'one') {
        echo 'ok';
    }

?>

</body>
</html>