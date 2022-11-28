@extends('layouts.admin')
@section('title')
{{ rules() }}
@endsection

@section('content')
<div class="card">
    <?php $var = request()->segment(2)?>
    @if(($var != 'messages') and ($var != 'orders'))
    <div class="btn-group">
        <a href="{{ route('admin.' . rules() . '.delete_all') }}"
        class="btn btn-outline-danger col-lg-2  multi-delete" style="margin: 10px"><i class="fas fa-trash"></i>حذف
        الجميع</a>

        <a href="{{ route('admin.' . rules() . '.create') }}"
        class="btn btn-outline-primary col-lg-2" style="margin: 10px"><i class="fas fa-plus"></i>
        إضافة</a>

    </div>

    @endif
    <div class="card-content collpase show">
        <div class="card-body table-responsive data_table">

            {{ $dataTable->table() }}

        </div>
    </div>
</div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}

@endpush
