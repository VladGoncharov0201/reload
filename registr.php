<?php
$surname = trim(strip_tags($_POST["surname"]));
$name = trim(strip_tags($_POST["name"]));
$father_name = trim(strip_tags($_POST["father_name"]));
$gender = trim(strip_tags($_POST["sex"]));
$birthday = trim(strip_tags($_POST["birthdate"]));
$phone = trim(strip_tags($_POST["phone"]));
if (isset($_POST["email"])) {
    $email = trim(strip_tags($_POST["email"]));
} else {
    $email = "NULL";
}
$city = trim(strip_tags($_POST["city"]));
if (($_POST["check"]) == '') {
    header("location:http://reload/html/registration.html");
    exit;
}
$login = trim(strip_tags($_POST["login"]));
$password = trim(strip_tags($_POST["password"]));

$host = "localhost";
$user = "root";
$pass = "Kate041117";
$db_name = "reload";

// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$link = new mysqli($host, $user, $pass, $db_name);
if (!$link) {
    echo "We have problems. Error code: " . mysqli_errno($link) . ", error name" . mysqli_error($link);
}

$fields = "surname, name, father_name, gender, birthday, phone, email, city, login, password";
$stmt = $link->prepare("INSERT INTO user_data(" . $fields . ") VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param('sssissssss', $surname, $name, $father_name, $gender, $birthday, $phone, $email, $city, $login, $password);
$stmt->execute();
if (!mysqli_error($link)) {
    echo '<p>Данные успешно добавлены в таблицу.</p>';
    echo "Спасибо! Вы успешно зарегистрировались.";
} else {
    echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
}

mysqli_close($link);
