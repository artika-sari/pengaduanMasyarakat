<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pengaduan Masyarakat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fontawesome.com/icons/trash?f=classic&s=solids">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
</head>
<body>
  <div class="d-flex hero-section">
    <div class="hero-content">
      <h1 style="font-weight: 700; color: white;">Pengaduan Masyarakat</h1>
      <p style="font-weight: 300; color: white;" >
        Web Pengaduan Masyarakat adalah platform digital yang dirancang untuk memfasilitasi masyarakat dalam menyampaikan keluhan, laporan, atau 
        saran terkait berbagai permasalahan yang mereka hadapi, baik yang berkaitan dengan layanan publik, infrastruktur, maupun isu sosial lainnya.
      </p>
      <a href="{{ route('regis') }}" class="btn btn-dark">Bergabung!</a>
    </div>
    <div class="hero-image">
      <div class="action-buttons">
        <a href="{{ route('login') }}" class="btn btn-warning"><i class="fa fa-user" aria-hidden="true"></i></a>
        <a href="{{ route('reports.artikel') }}" class="btn btn-warning"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></a>
        <a href="{{ route('reports.create') }}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.js"></script>
</body>
</html>
