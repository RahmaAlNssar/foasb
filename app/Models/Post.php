<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title','status','body','subcat_id'];

    public function images(){
        return $this->hasMany(Image::class,'post_id','id');
    }
    public function subcat(){
        return $this->belongsTo(Subcat::class);
    }

    public function getImageUrlAttributes(){
        foreach($this->images as $img){
            return asset('storage/uploads/posts/'.$img->image);
        }

    }

    public const USER_STATUS_ACTIVE = 1;
    public function status(){

           return  $this->status == self::USER_STATUS_ACTIVE
           ? '<a href="'.route('admin.posts.status',[$this->id,'status']).'"class="btn btn-outline-success btn-sm toggle-class" title="تحديث الحالة"> <span class="badge bg-success"><i class="fa fa-power-off"></i></span></a>'
           : '<a href="'.route('admin.posts.status',[$this->id,'status']).'"class="btn btn-outline-success toggle-class" title="تحديث الحالة">  <span class="badge bg-danger"><i class="fa fa-power-off"></i></span></a>';

      }
}
