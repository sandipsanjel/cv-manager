<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CVstatus extends Model
{
    use HasFactory;
    protected $table = 'cv_status'; // This is especially useful if the table name doesn't follow Laravel's naming convention.

    // it is used to massassgined using the methods like create or update
    protected $fillable = ['status', 'interview_date', 'interviewers_list', 'remarks', 'document', 'cv_id'];

    public function cvDetail()
    {
        return $this->belongsTO(UserCV::class);
    }
}
