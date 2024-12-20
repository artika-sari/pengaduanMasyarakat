<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
    <div class="wrapper hero-section">
        <div class="container-main">
            <div class="row">
                <div class="col-md-6 side-image">
                </div>
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
    
            @if(session('info'))
                <div class="alert alert-info">{{ session('info') }}</div>
            @endif  
                <div class="col-md-6 right">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="input-box">
                            <header>Masuk Akun</header>
                            <div class="input-field">
                                <input type="email" class="input" id="email" name="email" placeholder="Masukkan email" required autocomplete="off" value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-field">
                                <input type="password" class="input" id="password" name="password" placeholder="Masukkan password" required>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-field">
                                <button type="submit" class="submit">Masuk</button>
                            </div>
                            <div class="signin">
                                <span>Belum memiliki akun? <a href="{{ route('regis') }}">Daftar Disini</a></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
