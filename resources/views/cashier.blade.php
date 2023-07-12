@extends('template')
@section('view')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header pb-0">
                <h5>Cart</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="order-history table-responsive wishlist">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Harga Satuan</th>
                                    <th>Jumlah</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody id="cashier_items">
                                <tr>
                                    <td colspan="6"><button class="btn btn-primary w-75 m-auto" id="tambah_item"><i class="fal fa-plus-circle"></i> Tambah Item</button></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="total-amount">
                                        <h6 class="m-0 text-end"><span class="f-w-600">Total Price :</span></h6>
                                    </td>
                                    <td id="amount"></td>
                                </tr>
                                <tr>
                                    <td class="text-end" colspan="4"><a class="btn btn-secondary cart-btn-transform" href="product.html">continue shopping</a></td>
                                    <td><a class="btn btn-success cart-btn-transform" href="checkout.html">check out</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-xl produk" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Cari Produk</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <div class="col-10">
                    <input class="form-control" name="search_name" placeholder="Masukan Code / Nama Produk untuk mencari">
                </div>
                <div class="col-2">
                    <button class="btn btn-info">Cari Produk</button>
                </div>
                <div class="modal-product row mt-4">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    let assetUrl = "{{ asset('') }}"
    let price = 0;
    let row = 0;

    $("#tambah_item").click(function() {
        $(".produk").modal('show')
    })
    fetchParts();

    function formatRupiah(bilangan) {
        var number_string = bilangan.toString().replace(/[^,\d]/g, ''),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{1,3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return 'Rp. ' + rupiah;
    }

    function addProduct(id) {
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
                    $(".produk").modal('hide')
                    $("#cashier_items").prepend(`
                    <tr id="row_${row}">
                        <td><img src="${assetUrl+response.data.photo}" class="img-fluid img-40"></td>
                        <td>${response.data.name}</td>
                        <td>${formatRupiah(response.data.price)}</td>
                        <td id="price_${row}">1</td>
                        <td>${formatRupiah(response.data.price)}</td>
                    </tr>
                    `)
                    updatePriceCart(response.data.price)
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

    function updatePriceCart(amount) {
        price += amount;
        $("#amount").html(formatRupiah(price));
    }

    function fetchParts(search = null) {
        $.ajax({
            url: "{{ url('data/fetch-sparepart') }}",
            method: "POST", // First change type to method here    
            data: {
                search: search,
                _token: token
            },
            success: function(response) {
                for (let res in response.data) {
                    let html = `<div class="col-sm-3 col-xl-3">
                  <div class="card height-equal">
                    <div class="card-header pb-0">
                        <img src="${assetUrl+response.data[res].photo}" class="img-thumbnail mb-1">
                        <h5 class="text-center">${response.data[res].name}</h5>
                    </div>
                    <div class="card-body">
                      <span><b>Harga    :</b> ${formatRupiah(response.data[res].price)}</span>
                      <button class="btn btn-primary" onclick="addProduct('${response.data[res].id}')">Tambahkan Produk</button>
                    </div>
                  </div>
                </div>`;
                    $(".modal-product").append(html)
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
</script>
@endsection