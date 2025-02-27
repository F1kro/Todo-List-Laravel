<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <!-- 01. Content-->
        <h1 class="text-center mb-4 text-black fw-bold ">SIMPEL TO-DO LIST</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        {{-- jika validasi input task gagal --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <!-- 02. Form input data -->
                        <form id="todo-form" action="{{ route('todo.post') }}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="task" id="todo-input"
                                    placeholder="Tambah task baru" required value="{{ old('task') }}">
                                <button class="btn btn-primary" type="submit">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <!-- 03. Searching -->
                        <form id="todo-form" action="{{ route('todo') }}" method="get">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                    placeholder="masukkan kata kunci">
                                <button class="btn btn-secondary" type="submit">
                                    Cari
                                </button>
                            </div>
                        </form>

                        <ul class="list-group mb-4" id="todo-list">
                            <!-- 04. Display Data -->
                            @foreach ($data as $d)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="task-text">
                                    {{-- ni kalo is_done == 1 / selese bakal di coret text nya , make tag del , make html specialCars --}}
                                    {!! $d->is_done == '1' ? '<del>':'' !!}
                                            {{ $d->task }}
                                        {!! $d->is_done == '1' ? '</del>':'' !!}
                                </span>
                                <input type="text" class="form-control edit-input" style="display: none;"
                                value="{{ $d->task }}">
                                <div class="btn-group">
                                    <form action="{{ route('todo.delete', ['id' => $d->id]) }}" method="POST" onsubmit="return confirm('Task Akan di Hapus, Anda yakin?')">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm delete-btn mx-1">✕</button>
                                    </form>
                                    <button class="btn btn-warning btn-sm edit-btn" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-{{ $loop->index }}" aria-expanded="false">✎</button>
                                </div>
                            </li>
                            <!-- 05. Update Data -->
                            <li class="list-group-item collapse" id="collapse-{{ $loop->index }}">
                                <form action="{{ route('todo.update',['id' => $d->id]) }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <div>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="task" value="{{ $d->task }}">
                                            <button class="btn btn-outline-primary" type="submit">Update</button>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="radio px-2">
                                            <label>
                                                <input type="radio" value="1" name="is_done" {{ $d->is_done == 1 ? 'checked' : '' }}> Selesai
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" value="0" name="is_done" {{ $d->is_done == 0 ? 'checked' : '' }}> Belum
                                            </label>
                                        </div>
                                    </div>
                                </form>
                            </li>
                            @endforeach
                        </ul>
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
