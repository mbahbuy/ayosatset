@extends('dashboard.layout.main')

@section('content')

<div class="modal fade" id="addCategory" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <h5 class="modal-title text-center">Add Category</h5>
      <div class="modal-body">
        <form action="{{ route('category.store') }}" method="post">
          @csrf
          <input class="form-control" type="text" name="name" placeholder="Enter Category....">
        </form>
      </div>
    </div>
  </div>
</div><!-- End Modal Dialog Scrollable-->

<div class="card">
    <div class="card-body">
      <div class="card-title d-flex justify-content-between">
        <h5>Category</h5>
        <!-- Modal Dialog Scrollable -->
        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addCategory">
          [+]
        </button>
      </div>

      <!-- Table with hoverable rows -->
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Slug</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @if (sizeof($categories))
              @foreach ($categories as $item)                  
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->slug }}</td>
                  <td>
                    <div class="d-flex justify-content-start">
                      <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#updateCategory-{{ $item->slug }}">
                        <i class="bi bi-wrench"></i>
                      </button>
  
                      <div class="modal fade" id="updateCategory-{{ $item->slug }}" tabindex="-1">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <h5 class="modal-title text-center">Update Category</h5>
                            <div class="modal-body">
                              <form action="{{ route('category.update', $item->slug) }}" method="post">
                                @csrf
                                @method('put')
                                <input class="form-control" type="text" name="name" placeholder="Enter Category...." value="{{ $item->name }}">
                              </form>
                            </div>
                          </div>
                        </div>
                      </div><!-- End Modal Dialog Scrollable-->
  
                      <form action="{{ route('category.destroy', $item->slug) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-outline-danger" onclick="return confirm('Anda mau menghapus category(`{{ $item->name }}`)?')"><i class="bi bi-trash"></i></button>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
          @else
              <tr>
                <th scope="row" colspan="4">Belum ada category yang dimasukkan!</th>
              </tr>
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