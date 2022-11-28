<?php
namespace App\Http\Services;
use App\Models\Admin;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AdminService{


    public function handle($request, $id = null)
    {
        try {
            DB::beginTransaction();

            if (!empty($request['password'])) {
                $request['password'] = Hash::make($request['password']);
            }else{
                unset($request['password']);
            }
        $admin = Admin::updateOrCreate(['id' => $id],$request);
       // $user->syncRoles($request['roles'] ?? []);
            DB::commit();
           return $admin;
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
}
