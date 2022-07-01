@extends('web.app', ['title' => 'Detail Program'])

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-12">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">&#8249; Kembali</a>
        </div>
    </div>
    <!-- Program Berjalan -->
    <div class="row mt-3"> 
        <div class="col-md-6 d-flex justify-content-center">
            <img src="{{ asset('storage/'.$program->program_poster) }}" alt="Gambar" class="img-thumbnail" style="max-height:400px;">
        </div>
        <div class="col-md-6">
            <h3 class="mb-3">{{ $program->program_title }}</h3>
            <h5>Kategori</h5>
            <p>{{ $category->category_name }}</p>
            <hr>
            <div class="d-flex justify-content-between mb-2">
                <div>Terkumpul</div>
                <div>Target</div>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <div>@currency($program->donations->where('donation_status', 'success')->sum('amount'))</div>
                <div>@currency($program->program_target_funds)</div>
            </div>
            <div class="progress mb-4">
                <div class="progress-bar" style="width: @php
                $collected = $program->donations->where('donation_status', 'success')->sum('amount');
                $target =  $program->program_target_funds;
                echo $collected / $target * 100;
                @endphp%"></div>
            </div>  
            @if($program->program_status == "published")
              <div class="d-flex justify-content-between mb-3">
                <div>Batas Penggalangan Dana</div>
                <div>{{ \Carbon\Carbon::parse($program->program_deadline)->format('d M Y') }}</div>
              </div>
              <a href="{{ url("/donation/{$program->id}") }}" class="btn btn-primary text-center mt-4" style="width:100%;">Donasi</a>
            @elseif($program->program_status == "finished")
              <div class="d-flex justify-content-between mb-3">
                <div>Penggalangan Dana Berakhir pada</div>
                <div>{{ \Carbon\Carbon::parse($program->program_deadline)->format('d M Y') }}</div>
              </div>
            @endif            
        </div>
    </div>    
    <!-- Program Berjalan -->
    <div class="row mt-3">
        <div class="col-md-9">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="detail-tab" data-bs-toggle="tab" data-bs-target="#detail" type="button" role="tab" aria-controls="detail" aria-selected="true">Detail</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="donatur-tab" data-bs-toggle="tab" data-bs-target="#donatur" type="button" role="tab" aria-controls="donatur" aria-selected="false">Donatur</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="proposal-tab" data-bs-toggle="tab" data-bs-target="#proposal" type="button" role="tab" aria-controls="proposal" aria-selected="false">Proposal</button>
            </li>
            @if (!empty($program->program_report_file))
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="laporan-tab" data-bs-toggle="tab" data-bs-target="#laporan" type="button" role="tab" aria-controls="laporan" aria-selected="false">Laporan</button>
            </li>
            @endif
        </ul>
        <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active mt-4" id="detail" role="tabpanel" aria-labelledby="detail-tab">
          {!!$program->program_description!!}
        </div>
        <div class="tab-pane fade mt-2" id="donatur" role="tabpanel" aria-labelledby="donatur-tab">
          <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 1%">
                        #
                        </th>
                        <th>
                        Donasi                                         
                    </tr>
                </thead>
                <tbody>
                    @foreach ($program->donations->where('donation_status', 'success') as $donation)
                    <tr>
                        <td>#</td>
                        <td>
                            <a>
                              @currency($donation->amount) - {{ $donation->donor->user->name }}
                            </a>
                            <br />
                            <small>
                            {{ $donation->note }}
                            </small>                        
                        </td>                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
          </div> 
        </div>
        <div class="tab-pane fade mt-4" id="proposal" role="tabpanel" aria-labelledby="proposal-tab">
          <div class="d-flex justify-content-center">
          <a href="{{ asset('storage/'.$program->program_proposal_file) }}" class="btn btn-dark btn-lg btn-block text-center mt-4 mb-4 " style="width:80%;" target="_blank"><i class="nav-icon fas fa-copy"></i>Buka Proposal</a>
          </div>
        </div>
        @if (!empty($program->program_report_file))
        <div class="tab-pane fade mt-4" id="laporan" role="tabpanel" aria-labelledby="laporan-tab">
          <div class="d-flex justify-content-center">
          <a href="{{ asset('storage/'.$program->program_report_file) }}" class="btn btn-dark btn-lg btn-block text-center mt-4 mb-4 " style="width:80%;" target="_blank"><i class="nav-icon fas fa-copy"></i>Buka Laporan</a>
          </div>
        </div>
        @endif
        </div>
        </div>
        <div class="col-md-3">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Organisasi</span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-center lh-condensed">
                  <div>
                    <h6 class="my-0">{{ $organization->organization_name }}</h6>
                  </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                  <div>
                    <h6 class="my-0">Total</h6>
                  </div>
                  <span class="text-muted">{{ $organization->programs->count() }} Program</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection