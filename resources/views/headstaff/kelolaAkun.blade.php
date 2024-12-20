@extends('templates.nav', ['title' => 'User Data'])

@section('content-dinamis')
    <div class="container my-5">
        <div class="d-flex justify-content-between align-item-center mb-3">
            <a href="{{ route('data.add') }}" class="btn btn-dark">+ Add Account</a>
        </div>

        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        <table class="table table-striped text-center" style="cursor: default;">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @if (count($users) == 0)
                    <tr>
                        <td colspan="4">Data Kosong</td>
                    </tr>
                @else
                    @foreach ($users as $item)
                        <tr>
                            <td> {{ $no++ }} </td>
                            <td> {{ $item['email'] }} </td>
                            <td> {{ $item['role'] }} </td>
                            <td class="d-flex justify-content-center">
                                <a href="javascript:void(0)" class="btn btn-primary me-2" onclick="Reset('{{ $item->email }}', {{ $item->id }})">Reset</a>
                                <button type="button" class="btn btn-danger" onclick="showModal('{{ $item->id }}', '{{ $item->email }}')">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    {{-- Modal Reset Password --}}
    <div class="modal fade" id="ResetModal" tabindex="-1" aria-labelledby="ResetModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="form-reset-password" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ResetModalLabel">Reset Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin mereset password untuk <strong id="email"></strong>?
                        <br>
                        Password baru akan di-set dengan 4 karakter pertama dari email.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Reset Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>    

@endsection

@push('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    function showModal(id, name) {
        let action = '{{ route('data.delete', ':id') }}';
        action = action.replace(':id', id);
        $('#form-delete-user').attr('action', action);
        
        $('#name-user').text(name);
        
        $('#exampleModal').modal('show');
    }

    function Reset(email, id) {
        $('#email').text(email);  

        let action = '{{ route('data.reset', ':id') }}';
        action = action.replace(':id', id); 
        $('#form-reset-password').attr('action', action);

        $('#ResetModal').modal('show');
    }
</script>
@endpush
