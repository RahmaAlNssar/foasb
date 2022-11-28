
@if($row->images_count > 0)
<a href="{{ route('admin.posts.gallery',$row->id)}}" type="button" id="modal-images" class="btn btn-primary" data-toggle="modal" data-target="#load-form">
    معرض الصور
    </a>
@else
<a href="#" type="button" id="modal-images" class="btn btn-danger" data-toggle="modal" data-target="#load-form" disabled>
     لا يوجد صور
    </a>
@endif
