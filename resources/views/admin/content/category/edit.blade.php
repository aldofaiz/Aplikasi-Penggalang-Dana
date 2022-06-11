@extends('admin.main', ['title' => 'Kategori'])

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit Kategori</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Kategori</a></li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </div>
    </div>
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">Edit</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <form action="{{ route('admin.category.update',$category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input type="text" name="category_name" value="{{ $category->category_name }}" class="form-control">
                    </div>                               
                </div>            
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Edit Kategori" class="btn btn-success float-right">
                </div>
            </div>     
        </div>
    </form>
    
    <div class="card-footer">
    </div>
</div>

@endsection