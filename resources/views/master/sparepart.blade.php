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
                                <th>Brand</th>
                                <th>Nama</th>
                                <th>Code</th>
                                <th>Harga</th>
                                <th>Sisa Stok</th>
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
                        <label>Brand</label>
                        <select class="form-select" name="brand">
                            <option value="null">-- Silahkan Pilih --</option>
                            <option value="Yamaha">Yamaha</option>
                            <option value="Honda">Honda</option>
                            <option value="Suzuki">Suzuki</option>
                            <option value="Kawasaki">Kawasaki</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>Nama Produk</label>
                        <input type="text" class="form-control" name="name" placeholder="Masukan Nama Product">
                    </div>
                    <div class="form-group mb-3">
                        <label>Kode Produk</label>
                        <input type="text" class="form-control" name="code" placeholder="Masukan Kode Produk">
                    </div>
                    <div class="form-group mb-3">
                        <label>Harga Produk</label>
                        <input type="text" class="form-control" name="price" placeholder="Masukan Harga Produk">
                    </div>
                    <div class="form-group mb-3">
                        <label>Foto Produk</label>
                        <input type="file" class="form-control" name="photo">
                    </div>
                    <div class="form-group mb-3">
                        <label>Stok Produk</label>
                        <input type="number" class="form-control" name="stock">
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
                        <label>Brand</label>
                        <select class="form-select" id="edit_brand" name="brand">
                            <option value="null">-- Silahkan Pilih --</option>
                            <option value="Yamaha">Yamaha</option>
                            <option value="Honda">Honda</option>
                            <option value="Suzuki">Suzuki</option>
                            <option value="Kawasaki">Kawasaki</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>Nama Produk</label>
                        <input type="text" class="form-control" id="edit_name" name="name" placeholder="Masukan Nama Product">
                    </div>
                    <div class="form-group mb-3">
                        <label>Kode Produk</label>
                        <input type="text" class="form-control" id="edit_code" name="code" placeholder="Masukan Kode Produk">
                    </div>
                    <div class="form-group mb-3">
                        <label>Harga Produk</label>
                        <input type="text" class="form-control" id="edit_price" name="price" placeholder="Masukan Harga Produk">
                    </div>
                    <div class="form-group mb-3">
                        <label>Foto Produk</label>
                        <input type="file" class="form-control" name="photo">
                        <small class="text-danger">*Silahkan Upload jika ingin memperbaharui foto</small>
                    </div>
                    <div class="form-group mb-3">
                        <label>Stok Produk</label>
                        <input type="number" class="form-control" id="edit_stock" name="stock">
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
                        <label>Brand</label>
                        <select class="form-select" disabled id="hapus_brand" name="brand">
                            <option value="null">-- Silahkan Pilih --</option>
                            <option value="Yamaha">Yamaha</option>
                            <option value="Honda">Honda</option>
                            <option value="Suzuki">Suzuki</option>
                            <option value="Kawasaki">Kawasaki</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>Nama Produk</label>
                        <input type="text" class="form-control" readonly id="hapus_name" name="name" placeholder="Masukan Nama Product">
                    </div>
                    <div class="form-group mb-3">
                        <label>Kode Produk</label>
                        <input type="text" class="form-control" readonly id="hapus_code" name="code" placeholder="Masukan Kode Produk">
                    </div>
                    <div class="form-group mb-3">
                        <label>Harga Produk</label>
                        <input type="text" class="form-control" readonly id="hapus_price" name="price" placeholder="Masukan Harga Produk">
                    </div>
                    <div class="form-group mb-3">
                        <label>Foto Produk</label>
                        <input type="file" class="form-control" name="photo">
                        <small class="text-danger">*Foto akan dihapus jika menghapus data</small>
                    </div>
                    <div class="form-group mb-3">
                        <label>Stok Produk</label>
                        <input type="number" class="form-control" id="hapus_stock" name="stock">
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
        ajax: "{{ url('data/sparepart') }}",
        processing: true,
        serverSide: true,
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'brand',
                name: 'brand'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'code',
                name: 'code'
            },
            {
                data: 'price',
                name: 'price'
            },
            {
                data: 'stock',
                name: 'stock'
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
        axios.post(`{{ url('ajax/sparepart') }}`, form)
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
            url: "{{ url('data/sparepart') }}",
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
                    $("#edit_brand").val(response.data.brand);
                    $("#edit_code").val(response.data.code);
                    $("#edit_price").val(response.data.price);
                    $("#edit_stock").val(response.data.stock);
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
        axios.post(`{{ url('ajax/sparepart') }}`, form)
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
            url: "{{ url('data/sparepart') }}",
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
                    $("#hapus_brand").val(response.data.brand);
                    $("#hapus_code").val(response.data.code);
                    $("#hapus_price").val(response.data.price);
                    $("#hapus_stock").val(response.data.stock);
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
        axios.post(`{{ url('ajax/sparepart') }}`, form)
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