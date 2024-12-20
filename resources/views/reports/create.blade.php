@extends('templates.nav', ['title' => 'Buat Keluhan'])

@section('content-dinamis')
    <form action="{{ route('report.create.store') }}" class="form" method="POST" enctype="multipart/form-data">
        <div class="keluhan container mt-4">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    
                    <label for="province">Provinsi</label><br>
            <select name="province" id="province" style="width: 500px; height: 35px; border-radius: 5px;">
                <option value="">Pilih Provinsi</option>
            </select><br><br>

            <label for="regency">Kota/Kabupaten</label><br>
            <select name="regency" id="regency" style="width: 500px; height: 35px; border-radius: 5px;" disabled>
                <option value="">Pilih Kabupaten</option>
            </select><br><br>

            <label for="subdistrict">Kecamatan</label><br>
            <select name="subdistrict" id="subdistrict" style="width: 500px; height: 35px; border-radius: 5px;" disabled>
                <option value="">Pilih Kecamatan</option>
            </select><br><br>

            <label for="village">Desa</label><br>
            <select name="village" id="village" style="width: 500px; height: 35px; border-radius: 5px;" disabled>
                <option value="">Pilih Desa</option>
            </select><br><br>

            <label for="type">Type</label><br>
            <select name="type" id="type" style="width: 500px; height: 35px; border-radius: 5px;">
                <option value="" disabled selected hidden>Pilih Opsi Keluhan</option>
                <option value="kejahatan" {{ old('type') == 'kejahatan' ? 'selected' : '' }}>Kejahatan</option>
                <option value="pembangunan" {{ old('type') == 'pembangunan' ? 'selected' : '' }}>Pembangunan</option>
                <option value="sosial" {{ old('type') == 'sosial' ? 'selected' : '' }}>Sosial</option>
            </select><br><br>

            <label for="description">Deskripsi</label><br>
            <textarea name="description" id="description" style="width: 500px; height: 100px; border-radius: 5px;"></textarea><br><br>

            <label for="image">Unggah Foto</label><br>
            <input type="file" name="image" id="image" style="color: black; border-radius: 5px;"><br><br>

            <div class="checkbox-container">
                <input type="checkbox" name="statement" id="statement">
                <label for="statement">Laporan yang di sampaikan sesuai dengan kebenaran.</label>
            </div>

            <button class="submit" type="submit">Kirim</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
   $.ajax({
    method: "GET",
    url: "https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json",
    dataType: "json",
    success: function(response) {
        response.forEach(function(province) {
            $('#province').append('<option value="' + province.id + '" data-name="' + province.name + '">' + province.name + '</option>');
        });
    },
    error: function() {
        alert("Gagal memuat data provinsi!");
    }
});

$('#province').on('change', function() {
    let provinceId = $(this).val();
    let provinceName = $('#province option:selected').data('name');
    if (provinceId) {
        $('#regency').prop('disabled', false).html('<option value="" disabled selected hidden>Loading...</option>');
        $('#subdistrict, #village').prop('disabled', true).html('<option value="" disabled selected hidden>Pilih Kecamatan/Desa</option>');
        $.ajax({
            method: "GET",
            url: `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`, 
            dataType: "json",
            success: function(response) {
                $('#regency').html('<option value="" disabled selected hidden>Pilih Kabupaten</option>');
                response.forEach(function(regency) {
                    $('#regency').append('<option value="' + regency.id + '" data-name="' + regency.name + '">' + regency.name + '</option>');
                });
            },
            error: function() {
                alert("Gagal memuat data kabupaten!");
            }
        });
    }
});

$('#regency').on('change', function() {
    let regencyId = $(this).val();
    let regencyName = $('#regency option:selected').data('name');
    if (regencyId) {
        $('#subdistrict').prop('disabled', false).html('<option value="" disabled selected hidden>Loading...</option>');
        $('#village').prop('disabled', true).html('<option value="" disabled selected hidden>Pilih Desa</option>');
        $.ajax({
            method: "GET",
            url: `https://www.emsifa.com/api-wilayah-indonesia/api/districts/${regencyId}.json`,  
            dataType: "json",
            success: function(response) {
                $('#subdistrict').html('<option value="" disabled selected hidden>Pilih Kecamatan</option>');
                response.forEach(function(subdistrict) {
                    $('#subdistrict').append('<option value="' + subdistrict.id + '" data-name="' + subdistrict.name + '">' + subdistrict.name + '</option>');
                });
            },
            error: function() {
                alert("Gagal memuat data kecamatan!");
            }
        });
    }
});

$('#subdistrict').on('change', function() {
    let subdistrictId = $(this).val();
    let subdistrictName = $('#subdistrict option:selected').data('name');
    if (subdistrictId) {
        $('#village').prop('disabled', false).html('<option value="" disabled selected hidden>Loading...</option>');
        $.ajax({
            method: "GET",
            url: `https://www.emsifa.com/api-wilayah-indonesia/api/villages/${subdistrictId}.json`,  
            dataType: "json",
            success: function(response) {
                $('#village').html('<option value="" disabled selected hidden>Pilih Desa</option>');
                response.forEach(function(village) {
                    $('#village').append('<option value="' + village.id + '" data-name="' + village.name + '">' + village.name + '</option>');
                });
            },
            error: function() {
                alert("Gagal memuat data desa!");
            }
        });
    }
});

$('form').on('submit', function(e) {
    e.preventDefault(); 

    let provinceId = $('#province').val();
    let regencyId = $('#regency').val();
    let subdistrictId = $('#subdistrict').val();
    let villageId = $('#village').val();

    let provinceName = $('#province option:selected').data('name');
    let regencyName = $('#regency option:selected').data('name');
    let subdistrictName = $('#subdistrict option:selected').data('name');
    let villageName = $('#village option:selected').data('name');


    $('<input>').attr({
        type: 'hidden',
        name: 'province',
        value: JSON.stringify({ id: provinceId, name: provinceName }) 
    }).appendTo('form');

    $('<input>').attr({
        type: 'hidden',
        name: 'regency',
        value: JSON.stringify({ id: regencyId, name: regencyName }) 
    }).appendTo('form');

    $('<input>').attr({
        type: 'hidden',
        name: 'subdistrict',
        value: JSON.stringify({ id: subdistrictId, name: subdistrictName }) 
    }).appendTo('form');

    $('<input>').attr({
        type: 'hidden',
        name: 'village',
        value: JSON.stringify({ id: villageId, name: villageName }) 
    }).appendTo('form');

    this.submit();
});

    </script>
@endsection
