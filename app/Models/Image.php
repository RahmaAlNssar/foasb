<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable=['image','status','post_id'];

    public function post(){
        return $this->belongsTo(Post::class,'post_id');
    }

    public function getImageUrlAttributes(){

            return asset('uploads/posts/'.$this->image);


    }

    public const USER_STATUS_ACTIVE = 1;
    public function status(){

           return  $this->status == self::USER_STATUS_ACTIVE
           ? '<a href="'.route('admin.images.status',$this->id).'"class="btn btn-outline-success btn-sm toggle-class"> <span class="badge bg-success"><i class="fa fa-power-off"></i></span></a>'
           : '<a href="'.route('admin.images.status',$this->id).'"class="btn btn-outline-success toggle-class">  <span class="badge bg-danger"><i class="fa fa-power-off"></i></span></a>';

      }
}
