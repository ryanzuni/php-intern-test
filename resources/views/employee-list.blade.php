<!DOCTYPE html>
<html>
<head>
    <title>Daftar Employees</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">
    <div class="container">
        <h2>Daftar Employee</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Tanggal Lahir</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $emp)
                    <tr>
                        <td>{{ $emp->nomor }}</td>
                        <td>{{ $emp->nama }}</td>
                        <td>{{ $emp->jabatan }}</td>
                        <td>{{ $emp->talahir }}</td>
                        <td>
                            @if($emp->photo_upload_path)
                                <img src="{{ $emp->photo_upload_path }}" width="60">
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="/employee-form" class="btn btn-primary">+ Tambah Baru</a>
    </div>
</body>
</html>
