@extends('template')
@section('view')
<div class="row">
    <div class="col-sm-12 col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center pb-0">
                <h5>{{ $page }}</h5>
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".modalAdd">Tambah Data</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="display" id="simpletable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modalAdd" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Tambah Data</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="add">
                    <div class="form-group mb-3">
                        <label>Nama Mekanik</label>
                        <input type="text" class="form-control" name="name" placeholder="Masukan Nama Mekanik">
                    </div>
                    <div class="form-group mb-3">
                        <label>Foto Mekanik</label>
                        <input type="file" class="form-control" name="photo">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Tambah Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade modalEdit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Edit Data</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="form-group mb-3">
                        <label>Nama Mekanik</label>
                        <input type="text" class="form-control" id="edit_name" name="name" placeholder="Masukan Nama Mekanik">
                    </div>
                    <div class="form-group mb-3">
                        <label>Foto Mekanik</label>
                        <input type="file" class="form-control" id="edit_photo" name="photo">
                        <small class="text-danger">*Silahkan Upload jika ingin memperbaharui foto</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Edit Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade modalHapus" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Hapus Data</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="hapus" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="hapus">
                    <input type="hidden" name="id" id="hapus_id">
                    <div class="form-group mb-3">
                        <label>Nama Mekanik</label>
                        <input type="text" class="form-control" id="hapus_name" name="name" placeholder="Masukan Nama Mekanik" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label>Foto Mekanik</label>
                        <input type="file" class="form-control" id="hapus_photo" name="photo" disabled>
                        <small class="text-danger">*Foto akan dihapus jika menghapus data</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Hapus Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    var table = $('#simpletable').DataTable({
        ajax: "{{ url('data/mechanic') }}",
        processing: true,
        serverSide: true,
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'photo',
                name: 'photo'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false
            },
        ],
    });
    $("#add").submit(function(e) {
        e.preventDefault();
        let form = new FormData(this);
        form.append('_token', token);
        axios.post(`{{ url('ajax/mechanic') }}`, form)
            .then(result => {
                if (result.data.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: result.data.message,
                    })
                } else {
                    Swal.fire({
                        title: 'Berhasil',
                        text: result.data.message,
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Baik'
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            table.ajax.reload();
                        }
                    });
                }
                $(".modalAdd").modal('hide')
            }).catch(error => {
                $(".modalAdd").modal('hide')
                if (error.response) {
                    const data = error.response.data;
                    var errorAjax = data.errors;
                    let errorMessage = data.message
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        html: errorMessage,
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Server mengalami masalah!',
                    })
                }
            })
    })

    function edit(id) {
        $.ajax({
            url: "{{ url('data/mechanic') }}",
            method: "POST", // First change type to method here    
            data: {
                id: id,
                _token: token
            },
            success: function(response) {
                if (response.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: response.message,
                    })
                } else {
                    $(".modalEdit").modal('show')
                    $("#edit_id").val(response.data.id);
                    $("#edit_name").val(response.data.name);
                }
            },
            error: function(request, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    html: 'Terjadi Kesalahan!',
                })
            }
        });
    }
    $("#edit").submit(function(e) {
        e.preventDefault();
        let form = new FormData(this);
        form.append('_token', token);
        axios.post(`{{ url('ajax/mechanic') }}`, form)
            .then(result => {
                if (result.data.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: result.data.message,
                    })
                } else {
                    Swal.fire({
                        title: 'Berhasil',
                        text: result.data.message,
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Baik'
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            table.ajax.reload();
                        }
                    });
                }
                $(".modalEdit").modal('hide')
            }).catch(error => {
                $(".modalEdit").modal('hide')
                if (error.response) {
                    const data = error.response.data;
                    var errorAjax = data.errors;
                    let errorMessage = data.message
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        html: errorMessage,
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Server mengalami masalah!',
                    })
                }
            })
    })

    function hapus(id) {
        $.ajax({
            url: "{{ url('data/mechanic') }}",
            method: "POST", // First change type to method here    
            data: {
                id: id,
                _token: token
            },
            success: function(response) {
                if (response.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: response.message,
                    })
                } else {
                    $(".modalHapus").modal('show')
                    $("#hapus_id").val(response.data.id);
                    $("#hapus_name").val(response.data.name);
                }
            },
            error: function(request, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    html: 'Terjadi Kesalahan!',
                })
            }
        });
    }
    $("#hapus").submit(function(e) {
        e.preventDefault();
        let form = new FormData(this);
        form.append('_token', token);
        axios.post(`{{ url('ajax/mechanic') }}`, form)
            .then(result => {
                if (result.data.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: result.data.message,
                    })
                } else {
                    Swal.fire({
                        title: 'Berhasil',
                        text: result.data.message,
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Baik'
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            table.ajax.reload();
                        }
                    });
                }
                $(".modalHapus").modal('hide')
            }).catch(error => {
                $(".modalHapus").modal('hide')
                if (error.response) {
                    const data = error.response.data;
                    var errorAjax = data.errors;
                    let errorMessage = data.message
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        html: errorMessage,
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Server mengalami masalah!',
                    })
                }
            })
    })
</script>
@endsection