@extends('templates.nav', ['title' => 'Buat Keluhan'])

@section('content-dinamis')
    <div class="export-button">
      <button>Export (xlsx)</button>
    </div>

    <table>
        <thead>
            <tr>
                <th>Gambar & Pengirim</th>
                <th>Lokasi & Tanggal</th>
                <th>Deskripsi</th>
                <th>Jumlah Vote</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
            <tr>
                <td>
                    <img src="{{ asset('storage/' . $report->image) }}" alt="User Avatar" width="50" height="50"> <br>
                    {{ $report->user->email }} 
                </td>
                <td>{{ $report->province }}, {{ $report->regency }}, {{ $report->subdistrict }}, {{ $report->village }}<br>{{ $report->created_at->format('d F Y') }}</td>
                <td>{{ $report->description }}</td>
                <td>{{ count(json_decode($report->voting ?? '[]')) }}</td>
                <td class="actions">
                    <button>Aksi</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

     <!-- Modal for Image View -->
     <div id="imageModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <img id="modalImage" src="" alt="Full Image">
        </div>
    </div>
@endsection

<script>
      var modal = document.getElementById("imageModal");
        var span = document.getElementsByClassName("close")[0];

        // Get all the thumbnail images
        var imgElements = document.querySelectorAll('.thumbnail');
        var modalImg = document.getElementById("modalImage");

        // Add click event to all thumbnail images
        imgElements.forEach(function(imgElement) {
            imgElement.onclick = function() {
                var imgSrc = imgElement.getAttribute('data-image'); // Get the full-size image URL
                modalImg.src = imgSrc; // Set it to the modal image
                modal.style.display = "block"; // Show the modal
            };
        });

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        };

        // When the user clicks anywhere outside the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
</script>