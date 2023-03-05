@extends('dashboard.layout.main')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="card-title d-flex justify-content-between">
            <h5 class="text-center">Black Users list</h5>
        </div>

      <!-- Table with hoverable rows -->
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
            @if (sizeof($users))
                @foreach ($users as $item)                    
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <form action="{{ route('user.calm', $item->user_hash) }}" method="post">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-outline-warning"><span>calm</span></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr><td colspan="4" class="text-center">No users damaged</td></tr>
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