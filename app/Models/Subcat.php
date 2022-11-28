<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcat extends Model
{
    use HasFactory;
    protected $fillable = ['name','status','cat_id'];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function cat(){
        return $this->belongsTo(Category::class);

        }
        public const USER_STATUS_ACTIVE = 1;
        public function status(){

               return  $this->status == self::USER_STATUS_ACTIVE
               ? '<a href="'.route('admin.subcats.status',[$this->id,'status']).'"class="btn btn-outline-success btn-sm toggle-class" title="تحديث الحالة"> <span class="badge bg-success"><i class="fa fa-power-off"></i></span></a>'
               : '<a href="'.route('admin.subcats.status',[$this->id,'status']).'"class="btn btn-outline-success toggle-class" title="تحديث الحالة">  <span class="badge bg-danger"><i class="fa fa-power-off"></i></span></a>';

          }
}
