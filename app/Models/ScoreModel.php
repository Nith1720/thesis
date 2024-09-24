<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreModel extends Model
{
    use HasFactory;

    protected $table = 'score';


    static public function getAllRecord()
    {
        return self::get();
    }


    static public function getSingle($id){
        return self::find($id);
    }

     public function studentname(){
        return $this->belongsTo(StudentModel::class, 'student_id');
    }


    public function thesisname(){
        return $this->belongsTo(ThesisModel::class, 'thesis_id');
    }

}



?>