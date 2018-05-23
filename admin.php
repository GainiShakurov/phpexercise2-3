<?php

$uploaddir = __DIR__ . '/tests/';
/* Добавил время к имени, чтобы можно было загружать файлы с одним и тем же именем */
$uploadfile = $uploaddir . basename($_FILES['testfile']['name'], ".json") . '-' . strtotime("now") . '.json';

$redirectLink = 'http://'.$_SERVER['HTTP_HOST'].'/list.php';

if (move_uploaded_file($_FILES['testfile']['tmp_name'], $uploadfile)) {
    header('Location: '.$redirectLink.'');
}
?>
<form enctype="multipart/form-data" action="admin.php" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="30000"/>
    Отправить файл:
    <p><input name="testfile" type="file"/></p>
    <p><input type="submit" value="Загрузить"/></p>
</form>
