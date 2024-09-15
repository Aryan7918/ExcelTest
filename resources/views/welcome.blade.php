<x-layout>
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Excel Import Form</h3>
                    </div>
                    <div class="card-body my-2">
                        <form action="{{ route('importExcel') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class=" input-group">
                                <input type="file" name="file" class="form-control" required>
                                <button type="submit" class="btn btn-primary">Import Excel</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Occasion</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($holidays as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->occasion }}</td>
                                    <td>{{ $row->date }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if(session()->has('success'))
        <div class="row mb-4 z-3 fixed-bottom alert alert-dismissible fade show" role="alert">
            <div class="alert alert-success mb-0 ">
                {{ session('success') }}
                <button type="button" class="btn-close m-1" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li class="text-danger mb-0">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <button type="button" class="btn-close m-1" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif
    </div>
</x-layout>