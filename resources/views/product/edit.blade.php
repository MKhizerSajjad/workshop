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
            <h3 class="card-title">Edit Product
            </h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          
          <form action="{{  route('product.update', $product->id)}}" method="POST">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Manufacturer</label>
                <input type="text" name="manufacturer" class="form-control" id="exampleInputEmail1" placeholder="Enter Manufacturer" value="{{ $product->id }}">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Model</label>
                <input type="text" name="model" class="form-control" id="exampleInputEmail1" placeholder="Enter Model" value="{{ $product->model }}">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Color</label>
                <input type="text" name="color" class="form-control" id="exampleInputEmail1" placeholder="Enter color" value="{{ $product->color }}">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Year</label>
                <input type="text" name="year" class="form-control" id="exampleInputEmail1" placeholder="Enter year" value="{{ $product->year }}">
              </div>
              <div class="form-group">
                <label for="category">Select Category</label>
                <select name="category_id" class="form-control" id="category">
                    <option value="">Select a category</option>
                    @foreach($categories as  $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
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