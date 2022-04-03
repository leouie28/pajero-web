<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
    $val = 'hello';
    $val2 = 'hi';

    $pl = array($val, $val2);

    foreach($pl as $value)
    {
        echo "$value <br>";
    }
    ?>
    <script>
        // alert('hello');
        // window.location = 'login.php';
    </script>
</body>
</html>