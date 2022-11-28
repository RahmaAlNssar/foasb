<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory,Notifiable;
    protected $guard = "admin";
    protected $fillable = ['username','password','is_super-admin','status','email'];


    public const USER_STATUS_ACTIVE = 1;

    public function status(){

        return  $this->status == self::USER_STATUS_ACTIVE
        ? '<a href="'.route('admin.admins.status',[$this->id,'status']).'"class="btn btn-outline-success btn-sm toggle-class" title="تحديث الحالة"> <span class="badge bg-success"><i class="fa fa-power-off"></i></span></a>'
        : '<a href="'.route('admin.admins.status',[$this->id,'status']).'"class="btn btn-outline-success toggle-class" title="تحديث الحالة">  <span class="badge bg-danger"><i class="fa fa-power-off"></i></span></a>';

       }

}
