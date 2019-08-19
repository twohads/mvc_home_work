<?php

namespace App\Models;

use Faker\Provider\Image;
use Illuminate\Database\Eloquent\Model;
use Core\Session;
use Illuminate\Support\Facades\DB;
use Src\ImagesLoad;
use App\Models\Validation;

class User extends Model
{
    protected $table = "users";
    protected $fillable = ['name', 'password', 'email', 'description', 'age'];


    public function file()
    {
        return $this->hasMany('App\Models\File');
    }

    public static function createUser()
    {
        $userPassword = self::getPasswordHash($_POST['password']);
        $user = User::create(['name' => htmlspecialchars($_POST['name']), 'password' => htmlspecialchars($userPassword),
            'email' => htmlspecialchars($_POST['email']), 'description' => htmlspecialchars($_POST['description']),
            'age' => $_POST['age']]);

        return $user;
    }

    public static function getAllUsers()
    {
        $users = User::all()->toArray();
        return $users;
    }

    public static function getAllUsersAgeSort($typeOfSort)
    {
        $users = User::where('age', ">", 1)
            ->orderBy('age', $typeOfSort)
            ->get();
        return $users;
    }

    public static function getByNameAndEmail($name, $email)
    {
        $user = User::where('name', '=', $name)
            ->where('email', '=', $email)
            ->get()->toArray();
        return $user;
    }

    public static function getNameAndPassword($name, $password)
    {
        $passwordHash = self::getPasswordHash($password);
        $user = User::where('name', '=', $name)
            ->where('password', '=', $passwordHash)
            ->get()->toArray();
        return $user;
    }

    public static function getByRelations($number)
    {
        $user = User::with('file')->where('id', '=', $number)->get()->toArray();
        return $user;
    }
    public static function getByTe(int $number)
    {
        $user = User::where('id', '=', $number)->get()->toArray();
        return $user;
    }

    public static function latestUser($db)
    {
        $userId = $db->id;
        return $userId;
    }


    public static function isUserAuthorizated()
    {
        return isset($_SESSION['user_id']);
    }

    public static function getSomUsers($numberOfUsers)
    {
        $user = User::latest()->take($numberOfUsers)->get();
        return $user;
    }

    public function saveUser()
    {
        $user = new Database();
        $user->name = $_POST['name'];
        $user->password = $_POST['password'];
        $user->email = $_POST['email'];
        $user->description = $_POST['description'];
        $user->age = $_POST['age'];
        $user->save();
    }

    public static function getPasswordHash($userPassword)
    {
        return sha1($userPassword . 'rT>,>??xgyuS12??');
    }

    public static function getUserOlder(int $age)
    {
        $user = User::where('age', '<=', $age)->get()->toArray();
        return $user;
    }


}

