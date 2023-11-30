<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CVstatus extends Model
{
    use HasFactory;
    protected $table='cv_status';

    protected $fillable = ['status', 'interview_date', 'interviewers_list', 'remarks', 'document'];
}
