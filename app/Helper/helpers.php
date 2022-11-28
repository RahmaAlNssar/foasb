<?php

function rules() {
    $url =request()->path();
      if(request()->segment(1) === 'admin' && request()->segment(2) !== ''){
          return request()->segment(2);
      }elseif(request()->segment(2) === 'admin' && request()->segment(3) !== ''){
          return request()->segment(3);
      }else{
          return 'Dashboard';
      }

   }
