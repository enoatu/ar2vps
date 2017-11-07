<!doctype html >
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>XSS対策　es()
    </title>



</head>
<body>
<div>
    <pre>
        <?php
        require_once("lib/util.php");

        $myCode ="<h2>テスト1</h2>";
        $myArray = ["a"=>"<p>赤</p>","b"=>"<script>alert('hello')</script>"];
        echo '$myCodeの値;',es($myCode);
        echo "\n\n";
        echo '$myArrayの値:';
        print_r(es($myArray));
        ?>



    </pre>
</div>


</body>

</html>


<?php
