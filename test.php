<?php
session_start();
if (isset($_GET['name']) && !empty($_GET['name'])) {
    $path = __DIR__ . '/tests/' . $_GET['name'] . '.json';
    $currentFile = scandir(__DIR__ . '/tests/');

    if (!in_array($_GET['name'] . '.json', $currentFile)) {
        http_response_code(404);
        echo 'Cтраница не найдена!';
        exit(1);
    }

    $currentTest = json_decode(file_get_contents($path), true);

    echo '<form action="" method="POST">';
    echo '<input type="hidden" name="sended" value="1"/>';
    echo '<label>Введите свое имя: <input type="text" name="username" required /></label>';
    foreach ($currentTest as $questionKey => $data) {
        echo '<fieldset>';
        echo '<legend>' . $data['body'] . '</legend>';
        foreach ($data['answers'] as $answerKey => $answer) {
            echo '<label><input type="radio" name="' . $questionKey . '" value="' . $answerKey . '">' . $answer['body'] . '</label>';
        }
        echo '</fieldset>';
    }
    echo '<input type="submit" value="Отправить"></form>';

    if (isset($_POST['sended']) && !empty($_POST['sended'])) {

        $arr = [];
        $arr = $_POST;
        $correctAnswersNumber = 0;
        $correctAnswersQues = [];

        foreach ($arr as $key => $value) {

            if ($currentTest[$key]['answers'][$value]['correct']) {
                $correctAnswersNumber++;
                array_push($correctAnswersQues, $currentTest[$key]['body']);
            }

        }

        $_SESSION = array();
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['correct'] = $correctAnswersNumber;
        $_SESSION['testname'] = $_GET['name'];

        echo '<h4>Кол-во правильных ответов - ' . $correctAnswersNumber . '</h4>';
        echo '<h4>Правильно ответили на вопросы - ' . implode(', ', $correctAnswersQues) . '</h4>';
        echo '<img src="sertificat.php" />';
    }

}
?>
