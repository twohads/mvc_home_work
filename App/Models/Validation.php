<?php


namespace App\Models;


class Validation
{
    public $arrError = [];

    public function cleanData($value = "")
    {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);

        return $value;
    }

    public function clean($value = "")
    {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);

        return $value;
    }

    public function badName($imageName)
    {
        if (file_exists("../public/images/$imageName") && $imageName !== null && $imageName !== "") {
            $this->arrError[] = 'Фаил' . " " . $imageName . " " . 'уже существует';
        }

        return [];
    }

    public function fileExist($nameInForm)
    {
        if (!file_exists($image = $_FILES[$nameInForm]['tmp_name'])) {
            $this->arrError[] = "Фаил не прикреплен";
        }
    }

    public function checkLength($value = "", $min, $max, $nameValue)
    {
        if ($result = (mb_strlen($value) < $min || mb_strlen($value) > $max)) {
            $this->arrError[] = "Длинна $nameValue строки меньше $min или больше $max символов";
        }
    }

    public function checkNumber($value = "", $nameValue)
    {
        if (!preg_match("/^[0-9]+$/", $value)) {
            $this->arrError[] = "Поле $nameValue содержит только цифры";
        }
    }

    public function checkEmail($userEmail)
    {
        if (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+.[a-zA-Z.]{2,5}$/", $userEmail)) {
            $this->arrError[] = "$userEmail Не существует";
        };
    }

    public function authMatch($name, $password)
    {
        $checkNameAndPassword = User::getNameAndPassword($name, $password);
        if (!$checkNameAndPassword) {
            $this->arrError[] = "Не найдено имя пользователя или пароль";
        }

        return $checkNameAndPassword;
    }

    public function checkRegistr($name, $email)
    {
        $cheсkNameAndEmail = User::getByNameAndEmail($name, $email);
        if ($cheсkNameAndEmail){
            $this->arrError[] = "Имя пользователя или почтовый адрес уже существуют";
        }
    }
}