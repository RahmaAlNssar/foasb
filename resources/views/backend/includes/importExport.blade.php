
{{-- <div class="row">

    <a href="{{ route('backend.'.getModel().'.export') }}" class="btn btn-outline-success" title="تصدير" style="margin: 10px"><i
        class="fas fa-file-export"></i></a>



<form action="{{ route('backend.'.getModel().'.imports') }}" id="form" method="post" enctype="multipart/form-data">
@csrf
@method('post')

<input type="file" name="file" id="file" onchange="form.submit()"> --}}
 {{-- <button type="submit" id="upload_link" class="btn btn-outline-primary import" title="استيراد" style="margin:10px;text-decoration:none"><i class='fas fa-file-import'></i></button> --}}

{{-- </form>
</div> --}}

<div class="btn-group" role="group" aria-label="Basic example">
    {{-- <a href="{{ route('backend.'.getModel().'.export') }}" type="button" class="btn btn-outline-secondary export">Export </a> --}}
    <form action="{{ route('backend.users.imports') }}" id="form" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <label for="">import xsl</label>
        <input type="file" name="file" id="file" onchange="form.submit()">
         {{-- <button type="submit" id="upload_link" class="btn btn-outline-primary import" title="استيراد" style="margin:10px;text-decoration:none"><i class='fas fa-file-import'></i></button> --}}

         </form>
  </div>
