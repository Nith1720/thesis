<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherModel extends Model
{
    use HasFactory;

    protected $table = 'teacher';


    static public function getAllRecord()
    {
        return self::get();
    }


    static public function getSingle($id){
        return self::find($id);
    }

     public function getUserName(){
        return $this->belongsTo(DepartmentModel::class, 'department_id');
    }


    public function getTeacherImage()
    {
        if(!empty($this->profile_pic) && file_exists('Image/profile/'.$this->profile_pic))
        {
            return url('Image/profile/'.$this->profile_pic);
        }
    }


}



?>