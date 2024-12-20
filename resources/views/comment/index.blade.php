@extends('templates.nav', ['title' => 'Comment'])

@section('content-dinamis')
   <div class="container">
        <img src="{{ asset('storage/' . $reports->first()->image) }}" alt="">
        <h4>{{ $reports->first()->description }}</h4>
        <div>
            <small>{{ $reports->first()->created_at->format('d M Y H:i') }}</small>
            <small>{{ json_decode($reports->first()->province)->name }}</small>
            <small>{{ json_decode($reports->first()->regency)->name }}</small>
            <small>{{ json_decode($reports->first()->subdistrict)->name }}</small>
            <small>{{ json_decode($reports->first()->village)->name }}</small>
        </div>
        <div>
            <button>{{ $reports->first()->type }}</button>
        </div>
        <div>
            <button class="btn voting-btn" data-id="{{ $reports->first()->id }}" data-voted="{{ auth()->id() == $reports->first()->voting ? 'true' : 'false' }}" name="voting" id="voting">
                <i class="fa fa-heart {{ auth()->id(). $reports->first()->voting ? 'text-danger' : '' }}" aria-hidden="true"></i>
                <small id="cote-count" class="d-block text-muted">{{ $reports->first()->voting }} votes</small>
            </button>

            <button class="btn" name="viewers" id="viewers">
                <li class="fa fa-eye" aria-hidden="true"></li>
                <small class="d-block text-muted">{{ $reports->first()->viewers }}views</small>
            </button>
        </div>

        <div class="mt-4">
            <div>
                <p>Komentar</p>
                @if ($comments->isEmpty())
                    <p>Belum ada komentar</p>
                @else
                    <ul>
                        @foreach ($comments as $comment)
                            <li>
                                <b>{{ $comment->user->email }}</b>
                                <p>{{ $comment->comment }}</p>
                                <p><small>Dibuat pada: {{ $comment->created_at->diffForHumans() }}</small></p>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <div>
            <form action="{{ route('comment.store', $reports->first()->id) }}" class="form d-flex flex-column" method="POST">
                @csrf
                <label class="form-label">Tambah komentar:</label>
                <textarea class="form-control" name="comment" id="comment" cols="20" rows="5"></textarea>
                <button type="submit" class="btn btn-success mt-3">Kirim</button>
            </form>
        </div>
   </div>
@endsection