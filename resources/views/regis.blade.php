
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register Page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fontawesome.com/icons/trash?f=classic&s=solids">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    </head>
    <body>
        <div class="wrapper hero-section">
            <div class="container-main">
                <div class="row">
                    <div class="col-md-6 side-image">
                     
                    </div>
                    <div class="col-md-6 right">
                        <form action="{{ route('regis.store') }}" method="POST">
                            @csrf
                            <div class="input-box">
                                <header>Daftarkan Akun</header>
                                <div class="input-field">
                                    <input type="email" class="input" id="email" placeholder="Buat email" required autocomplete="off">
                                </div>
                                <div class="input-field">
                                    <input type="password" class="input" id="password" placeholder="Buat Password" required>
                                </div>
                                <div class="input-field">

                                    <input type="submit" class="submit" value="Daftar">
                                </div>
                                <div class="signin">
                                    <span>Sudah memiliki akun? <a href="{{ route('login.form') }}">Masuk Disini</a></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>                

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js">
        </script>
        
    </body>
    </html>
    
