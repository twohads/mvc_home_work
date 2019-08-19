<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = "files";
    protected $fillable = ['user_id', 'file'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public static function imageUniqName($imageName)
    {
        if (file_exists("../public/images/$imageName")){
        }
    }

    public static function getByRelations($number)
    {
        $user = File::with('user')->where('user_id', $number)->get()->toArray();
        return $user;
    }

    public static function createFile($user_id, $user_file)
    {
        $file = File::create(['user_id' => $user_id, 'file' => $user_file]);
        return $file;
    }

    public static function getAllFiles()
    {
        $files = File::all()->toArray();
        return $files;
    }

    public static function getAllUserFiles($user_id)
    {
        $user = File::where('user_id', '=', $user_id)
            ->orderBy('id', 'DESC')
            ->get()
            ->toArray();
        return $user;
    }

    public static function getById($id)
    {
        $file = File::find($id);
        return $file;
    }

    public static function getByTest($id)
    {
        $file = File::with('users')->find($id);
        return $file;
    }

}