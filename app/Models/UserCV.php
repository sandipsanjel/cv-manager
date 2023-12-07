<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCV extends Model
{
    use HasFactory;


    // protected $fillable = [
    //     // 'file_url',
    // ];
    protected $table = "user_c_v_s";
    protected $appends = ["document_url"];
    public function getDocumentUrlAttribute()
    {
        if (!$this->document) {
            return null;
        }
        return asset('storage/cv/' . $this->document);
    }


    public function cvStatus()
    {
        return $this->hasOne(CVstatus::class, 'cv_id', 'id');
    }
}
