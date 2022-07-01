@extends('admin.main', ['title' => 'Program'])

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Detail Program</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin') }}">Admin</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.program.index') }}">Program</a></li>
          <li class="breadcrumb-item active">Detail</li>
        </ol>
      </div>
    </div>
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
<br />
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Detail</h3>
    </div>
    
    <div class="card-body p-0">
        <table class="table table-striped table-bordered">
            <tbody>
                <tr>
                    <th style="width: 20%">Judul Program</th>
                    <td>
                        {{ $program->program_title }}
                    </td>
                </tr>
                <tr>
                    <th>Organisasi</th>
                    <td>
                        <a href="{{ route('admin.organization.show',$organization->id) }}">
                            {{ $organization->organization_name }}
                        </a>
                    </td>
                </tr>
                <tr>
                    <th>Kategori</th>
                    <td>
                        {{ $category->category_name }}
                    </td>
                </tr>
                <tr>
                    <th>Poster</th>
                    <td>
                        <img class="img-fluid" src="{{ asset('storage/'.$program->program_poster) }}" alt="Poster Program" width="200">
                    </td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>
                        {!!$program->program_description!!}
                    </td>
                </tr>
                <tr>
                    <th>Deadline</th>
                    <td>
                        {{ \Carbon\Carbon::parse($program->program_deadline)->format('d M Y') }}
                    </td>
                </tr>
                <tr>
                    <th>Target Dana</th>
                    <td>
                        @currency($program->program_target_funds)
                    </td>
                </tr>
                <tr>
                    <th>Dana Terkumpul</th>
                    <td>
                        @currency($program->donations->where('donation_status', 'success')->sum('amount'))
                    </td>
                </tr>
                <tr>
                    <th>Proposal</th>
                    <td>
                        <a href="{{ asset('storage/'.$program->program_proposal_file) }}" target="_blank">Proposal</a>
                    </td>
                </tr>
                <tr>
                    <th>Laporan</th>
                    <td>
                        @if($program->program_report_file)
                        <a href="{{ asset('storage/'.$program->program_report_file) }}" target="_blank">Laporan</a>
                        @endif 
                    </td>
                </tr>
                <tr>
                    <th>Status Program</th>
                    <td>
                        {{ $program->program_status }}
                    </td>
                </tr>
                <tr>
                    <th>Created_at</th>
                    <td>
                        {{ $program->created_at->diffForHumans() }}
                    </td>
                </tr> 
                <tr>
                    <th>Updated_at</th>
                    <td>
                        {{ $program->updated_at->diffForHumans() }}
                    </td>
                </tr>               
            </tbody>
        </table>
    </div>    
</div>
@endsection

@push('css')    
@endpush

@push('js')    
@endpush