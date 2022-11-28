<?php

namespace App\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait upload{

    public function saveImage($name,$folder){
        $extention=$name->getClientOriginalName();
        $filename=time().'.'.$extention;
        $path=public_path().'/'.$folder;
        $name->move($path,$filename);
        return $filename;
        }

        public function deleteImage($name,$folder){
            $image_path=public_path().'/'.$folder.'/'.$name;
            if($image_path != ''){
                unlink($image_path);
            }

            }
}
