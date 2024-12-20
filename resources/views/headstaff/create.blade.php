@extends('templates.nav', ['title' => 'Create user Data'])

@section('content-dinamis')
    <div class="m-auto" style="width: 65%">
        <form action="{{ route('data.add.store') }}" class="p-4 mt-2" style="border: 1px solid black" action="" method="POST">
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

            <div>
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">
            </div>
            <div>
                <label for="password" class="form-label">Password</label>
                <input type="text" name="password" id="password" class="form-control" value="{{ old('password') }}">
            </div>

            <button class="btn btn-dark mt-3">Send Data</button>
        </form>
    </div>
@endsection