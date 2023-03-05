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
            <th scope="col">User</th>
            <th scope="col">Toko</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Harga Barang</th>
            <th scope="col">Pcs</th>
            <th scope="col">Total Harga</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
            @if (sizeof($orders))
                @foreach ($orders as $item)                    
                    <tr>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->product->shop->name }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td>Rp. {{ number_format($item->product->price,0,',','.') }}</td>
                        <td>{{ $item->pcs }}</td>
                        <td>Rp. {{ number_format($item->payment,0,',','.') }}</td>
                        <td>
                            <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#order-{{ $loop->iteration }}">
                                Detail
                            </button>

                            <div class="modal fade" id="order-{{ $loop->iteration }}" tabindex="-1">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-body">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Code payment</th>
                                                    <th scope="col">Bukti payment</th>
                                                    <th scope="col">No Resi</th>
                                                    <th scope="col">Foto Resi</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Time</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $item->code }}</td>
                                                    <td>
                                                        image
                                                    </td>
                                                    <td>
                                                        number
                                                    </td>
                                                    <td>
                                                        image
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
                                                            @default
                                                                <span>Belum ada pembayaran</span>
                                                        @endswitch
                                                    </td>
                                                    <td>{{ Carbon\Carbon::parse($item->created_at)->diffInHours(now()) < 24 ? Carbon\Carbon::parse($item->created_at)->diffForHumans() : Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y') }}</td>
                                                    <td>
                                                        @if ($item->status == 1 )
                                                            <span>menunggu pembayaran</span>
                                                        @elseif ($item->status == 2)
                                                            <span>konfirmasi pembayaran</span>
                                                        @elseif ($item->status == 6 )
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