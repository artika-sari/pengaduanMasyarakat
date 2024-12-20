@extends('templates.nav', ['title' => 'Artikel'])

@section('content-dinamis')
    <link rel="stylesheet" href="{{ asset('assets/css/artikel.css') }}">

    <div class="container py-4">
        <div class="row">
            <div class="col-lg-8">
                <form action="{{ route('reports.search') }}" method="POST">
                    @csrf
                    @foreach ($reports as $report)
                        @php
                            $json = json_decode($report->province);
                        @endphp
                    @endforeach
                    <div class="input-group">
                        <select name="search" id="search" class="form-select me-2" style="width: 700px;">
                            <option value="">-- Pilih Provinsi --</option>
                        </select>
                    </div>
                </form>

                <div id="report-container"></div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="info-box">
                            <h5>
                                <div class="info-icon">
                                    <i class="fa fa-info" aria-hidden="true"></i>
                                </div>
                                <b>Informasi Pembuatan Pengaduan</b>
                            </h5>
                            <ol>
                                <li>Pengaduan bisa dibuat hanya jika Anda telah membuat akun sebelumnya.</li>
                                <li>Keseluruhan data pada pengaduan bernilai BENAR dan DAPAT DIPERTANGGUNG JAWABKAN.</li>
                                <li>Seluruh bagian data perlu diisi.</li>
                                <li>Pengaduan Anda akan ditanggapi dalam 2x24 Jam.</li>
                                <li>Periksa tanggapan Kami, pada Dashboard setelah Anda <strong>Login</strong>.</li>
                                <li>Pembuatan pengaduan dapat dilakukan pada halaman berikut: <a href="#">Ikuti
                                        Tautan</a>.</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Fetch provinces and populate the select dropdown
            $.ajax({
                method: "GET",
                url: 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json',
                dataType: "json",
                success: function(response) {
                    // Loop through the provinces and append to dropdown
                    response.forEach(function(province) {
                        $("#search").append('<option value="' + province.id + '" data-name="' +
                            province.name + '">' + province.name + '</option>');
                    });
                },
                error: function() {
                    alert("Failed to load provinces!");
                }
            });

            // When a province is selected, fetch the reports for that province
            $("#search").on('change', function() {
                var provinceId = $(this).val();

                if (provinceId) {
                    $.ajax({
                        url: "{{ route('reports.search') }}",
                        type: "GET",
                        data: {
                            search: provinceId
                        },
                        success: function(response) {
                            $('#report-container').empty();

                            // Check if the response contains reports
                            if (response.length > 0) {
                                response.forEach(function(report) {
                                    // Decode the province data if it's in JSON format
                                    var provinceData = JSON.parse(report.province);

                                    // Extract province name correctly
                                    var provinceName = provinceData.name ||
                                        'Unknown Province';

                                    $('#report-container').append(`
                                <div class="card mb-3 shadow-sm">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-md-4">
                                            <img src="{{ asset('storage') }}/${report.image}" class="img-fluid rounded-start" alt="Report Image">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <a href="/reports/show/${report.id}" class="text-decoration-none text-dark">${report.description.substring(0, 40)}...</a>
                                                </h5>
                                                <p class="text-muted small">${report.description.substring(0, 150)}...</p>
                                                <small id="">${provinceName}</small>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <i class="fa fa-eye"></i> ${report.viewers ?? 0} views
                                                        <button class="btn btn-sm voting-btn" data-id="${report.id}" data-voted="${report.voting ? 'true' : 'false'}">
                                                            <i class="fa fa-heart ${report.voting ? 'text-danger' : ''}"></i>
                                                            <small>${report.voting?.length ?? 0} votes</small>
                                                        </button>
                                                    </div>
                                                    <span class="badge bg-primary">${report.type || 'General'}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `);
                                });
                            } else {
                                $('#report-container').append(
                                    '<p>No reports found for this province.</p>');
                            }
                        },
                        error: function() {
                            alert("Failed to load reports, please try again later.");
                        }
                    });
                } else {
                    $('#report-container').empty();
                }
            });
        });
    </script>
@endpush
