@extends('dashboard.layout.main')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="card-title d-flex justify-content-between">
            <h5 class="text-center">Users list</h5>
            +
        </div>

      <!-- Table with hoverable rows -->
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
        </tr>
        </thead>
        <tbody>
            @if (sizeof($users))
                @foreach ($users as $item)                    
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                    </tr>
                @endforeach
            @else
                <td><tr col=2>No users except you</tr></td>
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