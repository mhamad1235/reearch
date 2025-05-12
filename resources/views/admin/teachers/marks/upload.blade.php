@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 mb-3">
            <x-sidebar />
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4 py-3">
                    <h4 class="mb-0">Upload Marks (Excel)</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('teacher.marks.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="marks_file">Choose Excel File</label>
                            <input type="file" name="marks_file" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>

                    @isset($excelData)
                        <hr>
                        <h5>Preview:</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered mt-3">
                                @foreach($excelData as $rowIndex => $row)
                                    <tr>
                                        @foreach($row as $cell)
                                            <td>{{ $cell }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
