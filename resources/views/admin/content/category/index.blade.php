@extends('admin.main', ['title' => 'Kategori'])

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Kategori</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
          <li class="breadcrumb-item active">Kategori</li>
        </ol>
      </div>
    </div>
</div><!-- /.container-fluid -->
@endsection

@section('content')

<div class="row">
    <div class="col-12">
    <a href="{{ route('admin.category.create') }}" class="btn btn-primary">Tambah Kategori</a>
    </div>
</div>
<br />
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Kategori</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped projects">
            <thead>
                <tr>
                    <th style="width: 1%">
                    #
                    </th>
                    <th style="width: 5%">
                    Nama Kategori
                    </th>
                    <th style="width: 5%">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>#</td>
                    <td>
                        <a>
                        {{ $category->category_name }}
                        </a>
                        <br />
                        <small>
                        Created {{ \Carbon\Carbon::parse($category->created_at)->format('d.m.Y') }}
                        </small>
                    </td>
                    <td class="project-actions text-right">
                        <form action="{{ route('admin.category.destroy',$category->id) }}" method="POST">
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.category.show',$category->id) }}">
                                <i class="fas fa-folder"></i>
                                View
                            </a>
                            <a class="btn btn-info btn-sm" href="{{ route('admin.category.edit',$category->id) }}">
                                <i class="fas fa-pencil-alt"></i>
                                Edit
                            </a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>    
</div>


@endsection