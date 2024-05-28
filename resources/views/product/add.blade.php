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
            <h3 class="card-title">Add Product
            </h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          
          <form action="{{  route('product.new')}}" method="POST">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Manufacturer</label>
                <input type="text" name="manufacturer" class="form-control" id="exampleInputEmail1" placeholder="Enter Manufacturer">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Model</label>
                <input type="text" name="model" class="form-control" id="exampleInputEmail1" placeholder="Enter Model">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Color</label>
                <input type="text" name="color" class="form-control" id="exampleInputEmail1" placeholder="Enter color">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Year</label>
                <input type="text" name="year" class="form-control" id="exampleInputEmail1" placeholder="Enter year">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Additional Information</label>
                <input type="text" name="year" class="form-control" id="exampleInputEmail1" placeholder="Enter Additional Information">
              </div>
              <div class="form-group">
                <label for="additionalInformation">Description of the problem</label>
                <textarea name="additional_information" class="form-control" id="additionalInformation" placeholder="Enter describe your problem" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label>D you have more parts</label><br>
              <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="option1" name="option1" value="option1">
                  <label class="form-check-label" for="option1">Battery</label>
              </div>
              <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="option2" name="option2" value="option2">
                  <label class="form-check-label" for="option2">Charger</label>
              </div>
            </div> 
            <div class="form-group">
              <label for="additionalInformation">Other Parts</label>
              <input type="text" name="year" class="form-control" id="exampleInputEmail1" placeholder="Enter Other">
            </div>
            <div class="form-group">
              <label>Select Service</label><br>
              <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="option1" name="Diagnostics" value="Diagnostics">
                  <label class="form-check-label" for="option1">Inspection and Diagnostics(35 Eur)</label>
              </div>
              <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="option2" name="option2" value="option2">
                  <label class="form-check-label" for="option2">Without Diagnostics</label>
              </div>
            </div> 
            <div class="form-group">
              <label>Other Service</label><br>
              <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="option1" name="Diagnostics" value="Diagnostics">
                  <label class="form-check-label" for="option1">Tyre change (20)</label>
              </div>
              <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="option2" name="option2" value="option2">
                  <label class="form-check-label" for="option2">Tyre change (on motor) (25)</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="option2" name="option2" value="option2">
                <label class="form-check-label" for="option2">Battery balacing and restoreing (45 to 150)</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="option2" name="option2" value="option2">
                  <label class="form-check-label" for="option2">Break Change (10)</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="option2" name="option2" value="option2">
                <label class="form-check-label" for="option2">Speed limit remove (35)</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="option2" name="option2" value="option2">
              <label class="form-check-label" for="option2">New battery Manufacture (75)</label>
          </div>
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