@extends('admin')
@section('categoriesList')

<section class="content">
    <div class="container-fluid">
      <div class="row">
        @if(Session::has('success'))
        <div class="alert alert-success">
              {{ Session::get('success') }}
          </div>
      @endif
      @if(Session::has('error'))
        <div class="alert alert-error">
              {{ Session::get('error') }}
          </div>
      @endif
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Categories List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th style="width: 20px">#</th>
                    <th style="">name</th>
                    <th style="width: 30px"></th>
                    <th style="width: 30px">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a class="btn btn-md" href="{{ route('category.edit',['categoryId' => $category->id]) }}"><span class="badge bg-success">Edit</span></a>
                        </td>
                        <td>
                            <a class="btn btn-md" href="{{ route('category.delete',['categoryId' => $category->id]) }}"><span class="badge bg-danger">Delete</span></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              
            </div>
            <!-- /.card-body -->
          </div>
      
      
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
@endsection