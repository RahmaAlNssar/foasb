<?php
namespace App\Http\Services;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CategoryRequest;



class CategoryService{


    public function handle($request, $id = null)
    {
        try {
         DB::beginTransaction();
        $cat = Category::updateOrCreate(['id' => $id],$request);
       // $user->syncRoles($request['roles'] ?? []);
            DB::commit();
           return $cat;
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
}
