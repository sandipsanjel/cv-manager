<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Node\Block\Document;

class CVstatus extends Model
{
    use HasFactory;
    protected $table = 'cv_status'; 

     protected $appends=['document_url'];

    public function getDocumentUrlAttribute(){

        if(!$this->task){
            return null;

        }
        return asset('storage/task'.$this->task);
    }
    protected $fillable = ['status', 'task','interview_date', 'interviewers_list', 'remarks', 'document', 'cv_id'];

    public function cvDetail()
    {
        return $this->belongsTO(UserCV::class);
    }
   
}
