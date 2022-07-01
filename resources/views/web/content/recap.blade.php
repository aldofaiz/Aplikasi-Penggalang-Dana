@extends('web.app', ['title' => 'Rekap'])

@section('content')
<div class="container">
    <div class="p-3"></div>
    <div class="jumbotron">
    <div class="row my-3 mt-5">
        <div class="col-md-3">
            <div class="card border-dark mx-sm-1 p-3">
                <div class="card border-dark shadow text-dark text-center p-3 my-card" ><span class="fa fa-book" aria-hidden="true"></span></div>
                <div class="text-dark text-center mt-3"><h4>Program</h4></div>
                <div class="text-dark text-center mt-2">{{ $count_program }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-dark mx-sm-1 p-3">
                <div class="card border-dark shadow text-dark text-center p-3 my-card"><span class="fa fa-eye" aria-hidden="true"></span></div>
                <div class="text-dark text-center mt-3"><h4>Donatur</h4></div>
                <div class="text-dark text-center mt-2">{{ $count_donor }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-dark mx-sm-1 p-3">
                <div class="card border-dark shadow text-dark text-center p-3 my-card" ><span class="fa fa-heart" aria-hidden="true"></span></div>
                <div class="text-dark text-center mt-3"><h4>Penghimpunan</h4></div>
                <div class="text-dark text-center mt-2">@currency($donations->sum('amount'))</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-dark mx-sm-1 p-3">
                <div class="card border-dark shadow text-dark text-center p-3 my-card" ><span class="fa fa-inbox" aria-hidden="true"></span></div>
                <div class="text-dark text-center mt-3"><h4>Penyaluran</h4></div>
                <div class="text-dark text-center mt-2">@currency($distribution)</div>
            </div>
        </div>
    </div>
    </div>
    <div class="p-3"></div>
    <div class="row">
        <table id="donation" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th style="width: 1%">No</th>
                    <th>Program</th>
                    <th>Organisasi</th>
                    <th>Kategori</th>
                    <th>Komentar</th>
                    <th>Jumlah</th>
                    <th style="width: 10%">Status Donasi</th>                                                
                </tr>
            </thead>
            <tbody>
                @foreach ($donations as $donation)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $donation->program->program_title }}</td>
                    <td>{{ $donation->program->organization->organization_name }}</td>
                    <td>{{ $donation->program->category->category_name }}</td>
                    <td>{{ $donation->note }}</td>
                    <td>@currency($donation->amount)</td>
                    <td>{{ $donation->donation_status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
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