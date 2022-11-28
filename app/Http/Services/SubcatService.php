<?php
namespace App\Http\Services;
use App\Models\Subcat;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;



class SubcatService{


    public function handle($request, $id = null)
    {
        try {
         DB::beginTransaction();
        $subcat = Subcat::updateOrCreate(['id' => $id],$request);
       // $user->syncRoles($request['roles'] ?? []);
            DB::commit();
           return $subcat;
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
}
