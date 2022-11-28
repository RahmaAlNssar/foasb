<?php
namespace App\Http\Services;
use App\Models\Post;
use App\Traits\upload;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;



class PostService{
use upload;

    public function handle($request, $id = null)
    {
        try {
         DB::beginTransaction();
        $post = Post::updateOrCreate(['id' => $id],$request);
        if($file = $request->file('image')) {

            foreach($file as $image)
           {

           $fileData = $this->uploads($image,'uploads/posts/');

             // $new_image = $fileData['fileName'];
             // $this->removeFile($image,'uploads/posts/');
             if(isset($post->images)){
                foreach($post->images as $img){
                    $img->delete();
                }
             }

              $post->images()->create(['image'=>$fileData['fileName']]);
           }

    }
            DB::commit();
           return $post;
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
}
