@extends('web.app', ['title' => 'Data Donasi'])

@section('content')
<div class="container">
    <div class="row flex-lg-nowrap mt-5">
        <div class="col-12 col-lg-auto mb-3" style="width: 200px;">
            <div class="card p-3">
                <div class="e-navlist e-navlist--active-bg">
                    <ul class="nav">
                        <li class="nav-item"><a class="nav-link px-2 active" href="{{ route('donor.profile') }}"><span>Setting</span></a></li>
                        <li class="nav-item"><a class="nav-link px-2" href="{{ route('donor.data.donation') }}"><span>Donasi Anda</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
      
        <div class="col">
            <div class="row">
                <div class="col mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="e-profile">
                                <div class="row">
                                    <div class="col d-flex flex-column flex-sm-row justify-content-between mb-5">
                                        <div class="text-left text-sm-left mb-2 mb-sm-0">
                                            <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">{{ $user->name }}</h4>
                                            <p class="mb-0">{{ $donor->phone_number }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content pt-3">
                                    <table id="donation" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Program</th>
                                                <th>Organisasi</th>
                                                <th>Kategori</th>
                                                <th>Komentar</th>
                                                <th>Jumlah</th>
                                                <th>Status Donasi</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($donations as $donation)
                                            <tr>
                                                <td>{{ $donation->program_title }}</td>
                                                <td>{{ $donation->organization_name }}</td>
                                                <td>{{ $donation->category_name }}</td>
                                                <td>{{ $donation->note }}</td>
                                                <td>@currency($donation->amount)</td>
                                                <td>{{ $donation->donation_status }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css"> 
@endpush
@push('js')
<!-- data table -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function () {
    $('#donation').DataTable();
});
</script>
@endpush