<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Node\Block\Document;

class CVstatus extends Model
{
    use HasFactory;
    protected $table = 'cv_status'; 

    //this method is used to dynamically generate the url for resources associated with the model
     protected $appends=['document_url'];

    public function getDocumentUrlAttribute(){ //accessor method allows to calculate the value for document_url

        if(!$this->task){
            return null;

        }
        //if decument attribute is set it returns the url using asset function
        return asset('storage/task'.$this->task);
    }
    protected $fillable = ['status', 'task','interview_date', 'interviewers_list', 'remarks', 'document', 'cv_id'];

    public function cvDetail()
    {
        return $this->belongsTO(UserCV::class);
    }
   
}
