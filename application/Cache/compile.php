<!doctype html>
<html>
<head>
    <title>Hello</title>
</head>
<body>

{require: ../../index.php}

{anyVariable}

{php}
$x = 1;
    echo 'Negix';
    if ($x == 'one') {
        echo 'ok';
    }
{/php}

</body>
</html>