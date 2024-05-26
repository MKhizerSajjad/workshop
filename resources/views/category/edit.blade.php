@extends('admin')
@section('addCategory')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit Category
            </h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          
          <form action="{{  route('category.update', $category->id)}}" method="POST">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Enter Name</label>
                <input type="text" name="name" class="form-control" value="{{ $category->name }}" id="exampleInputEmail1" placeholder="Enter Name">
              </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
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

      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
@endsection