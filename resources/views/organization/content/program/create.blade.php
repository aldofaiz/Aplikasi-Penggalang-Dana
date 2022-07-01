@extends('organization.main', ['title' => 'Program'])

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Tambah Program</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('organization') }}">Organisasi</a></li>
          <li class="breadcrumb-item"><a href="{{ route('organization.program.index') }}">Program</a></li>
          <li class="breadcrumb-item active">Tambah</li>
        </ol>
      </div>
    </div>
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">Tambah</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <form action="{{ route('organization.program.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" name="organization_id" value="{{ $organization->id }}" class="form-control">
                    <div class="form-group">
                        <label>Judul Program</label>
                        <input type="text" name="program_title" class="form-control">
                    </div> 
                    <div class="form-group">
                        <label>Kategori Program</label>
                        <select name="category_id" class="form-control select2" style="width: 100%;">
                            <option selected disabled>Select one</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>                     
                    <div class="form-group">
                        <label>Poster Program</label>
                        <div class="custom-file">
                            <input name="program_poster" type="file" class="custom-file-input" accept="image/*">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label>Deskripsi Program</label>
                        <textarea id="summernote" name="program_description"></textarea>
                    </div>                
                    <div class="form-group">
                        <label>Target Pendanaan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" name="program_target_funds" class="form-control">
                        </div>                        
                    </div>                    
                    <div class="form-group">
                        <label>Deadline Program</label>
                        <input type="date" name="program_deadline" class="form-control">
                    </div> 
                    <div class="form-group">
                        <label>File Proposal</label>
                        <div class="custom-file">
                            <input type="file" name="program_proposal_file" class="custom-file-input" id="customFile" accept="application/pdf">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="program_status" class="form-control custom-select">
                            <option value="draft">Draft</option>
                            <option value="published">Publish</option>
                        </select>
                    </div>                 
                </div>            
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Buat Program" class="btn btn-success float-right">
                </div>
            </div>     
        </div>
    </form>
    
    <div class="card-footer">
    Pembuatan program hanya dapat dilakukan oleh Organisasi.
    </div>
</div>

@endsection

@push('css')  
<link rel="stylesheet" href="{{ url('/adminlte/plugins/summernote/summernote-bs4.min.css') }}">
@endpush

@push('js')
<script src="{{ url('/adminlte/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script>
    $(function () {
        // Summernote
        $('#summernote').summernote({
            placeholder: 'Deskripsi Program...',
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'video']],
            ]
        });
    })
</script>
@endpush