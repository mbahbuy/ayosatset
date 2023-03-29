@extends('dashboard.layout.main')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="card-title d-flex justify-content-between">
            <h5 class="text-center">Order list</h5>
        </div>

      <!-- Table with hoverable rows -->
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">User</th>
            <th scope="col">Toko</th>
            <th scope="col">Produk</th>
            <th scope="col">Sub total</th>
            <th scope="col">Ongkir</th>
            <th scope="col">Total Harga</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
            @if (sizeof($orders))
                @foreach ($orders as $item)                    
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            
                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#costumer-{{ $loop->iteration }}">
                                <span>Detail Costumer</span>
                            </button>
                            <div class="modal fade" id="costumer-{{ $loop->iteration }}">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama Costumer</th>
                                                    <th scope="col">Alamat Costumer</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $item->user->name }}</td>
                                                    <td>{{ $item->user->alamat->address }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </td>
                        <td>

                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#toko-{{ $loop->iteration }}">
                                <span>Detail Toko</span>
                            </button>
                            <div class="modal fade" id="toko-{{ $loop->iteration }}">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama Toko</th>
                                                    <th scope="col">Alamat Toko</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $item->shop->name }}</td>
                                                    <td>{{ $item->shop->alamat->address }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>                            

                        </td>
                        <td>

                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#detail-{{ $loop->iteration }}">
                                <span>Detail Produk</span>
                            </button>
                            <div class="modal fade" id="detail-{{ $loop->iteration }}">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nama produk</th>
                                                    <th scope="col">Harga produk</th>
                                                    <th scope="col">Pcs</th>
                                                    <th scope="col">Total Harga</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse (json_decode($item->products) as $produk)
                                                    @php
                                                        $product = \App\Models\Product::where('product_hash', $produk->product_hash)->first();
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $product->name }}</td>
                                                        <td>Rp. {{ number_format($product->price,0,',','.') }}</td>
                                                        <td>{{ $produk->pcs }}</td>
                                                        <td>Rp. {{ number_format($product->price * $produk->pcs,0,',','.') }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td>G ada produk</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </td>
                        <td>Rp. {{ number_format($item->sub_total,0,',','.') }}</td>
                        <td>Rp. {{ number_format($item->ongkir,0,',','.') }}</td>
                        <td>Rp. {{ number_format($item->payment,0,',','.') }}</td>
                        <td>
                            <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#order-{{ $loop->iteration }}">
                                Detail
                            </button>

                            <div class="modal fade" id="order-{{ $loop->iteration }}" tabindex="-1">
                                <div class="modal-dialog modal-xl">
                                  <div class="modal-content">
                                    <div class="modal-body">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Code payment</th>
                                                    <th scope="col">No Resi</th>
                                                    <th scope="col">Foto Kurir</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Time</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $item->code }}</td>
                                                    <td>
                                                        {{ $item->no_resi ? $item->no_resi : '-' }}
                                                    </td>
                                                    <td>
                                                        {!! $item->img_kurir ? "<img src='" . asset('assets' . '/' . $item->img_kurir) . "' class='img-fluid'>" : '-' !!}
                                                    </td>
                                                    <td>
                                                        @switch($item->status)
                                                            @case(2)
                                                                <span>Pembayaran terdeteksi</span>
                                                                @break
                                                            @case(3)
                                                                <span>Pembayaran terkonfirmasi</span>
                                                                @break
                                                            @case(4)
                                                                <span>Proses Pengiriman</span>
                                                                @break
                                                            @case(5)
                                                                <span>Barang sampai</span>
                                                                @break
                                                            @case(6)
                                                                <span>-</span>
                                                                @break
                                                            @case(7)
                                                                <span>Perngajuan Pengembalian(return)</span>
                                                                @break
                                                            @default
                                                                <span>Belum ada pembayaran</span>
                                                        @endswitch
                                                    </td>
                                                    <td>{{ Carbon\Carbon::parse($item->created_at)->diffInHours(now()) < 24 ? Carbon\Carbon::parse($item->created_at)->diffForHumans() : Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y') }}</td>
                                                    <td>
                                                        @if ($item->status == 1 )
                                                            <span>menunggu pembayaran</span>
                                                        @elseif ($item->status == 7 )
                                                            <span>konfirmasi pengembalian</span>
                                                        @else
                                                            <span>-</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                  </div>
                                </div>
                            </div><!-- End Modal Dialog Scrollable-->

                        </td>
                    </tr>
                @endforeach
            @else
                <tr><td colspan="10" class="text-center">Belum ada order/payment terdeteksi</td></tr>
            @endif
        </tbody>
      </table>
      <!-- End Table with hoverable rows -->

    </div>
</div>

@endsection
@section('script')
<script>



</script>
@endsection