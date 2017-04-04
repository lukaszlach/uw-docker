<pre><?php

goto test2;

test1:
var_dump($_REQUEST);
return;

test2:
phpinfo();
return;

test3:
$pdo = new PDO('mysql:dbname=uw;host=mysql', 'root', 'root');
$sql = 'SHOW VARIABLES';
foreach ($pdo->query($sql) as $row) {
    var_dump($row);
}
return;