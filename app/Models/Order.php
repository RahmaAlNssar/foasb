<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=['status','user_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public const USER_STATUS_ACTIVE = 1;
    public function status(){

           return  $this->status == self::USER_STATUS_ACTIVE
           ? '<a href="'.route('admin.orders.status',$this->id).'"class="btn btn-outline-success btn-sm toggle-class"> <span class="badge bg-success"><i class="fa fa-power-off"></i></span></a>'
           : '<a href="'.route('admin.orders.status',$this->id).'"class="btn btn-outline-success toggle-class">  <span class="badge bg-danger"><i class="fa fa-power-off"></i></span></a>';

      }
}
