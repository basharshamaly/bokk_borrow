@extends('cms.paernt')

@section('content')




    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">

              <div class="card-header">
                <h3 class="card-title">edit book</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->


              <form>


                @csrf

                <div class="card-body">

                    <div class="form-group">
                        <label for="title">title</label>
                        <input type="text" class="form-control" value="{{ $books->title }}"  id="title" name="title" placeholder="title">
                      </div>
                    <div class="form-group">
                        <label for="name">name</label>
                        <input type="text" class="form-control" value="{{ $books->name }}"  id="name" name="name" placeholder="name">
                      </div>

                  {{-- <div class="form-group">
                    <label for="publish_year">publish_year</label>
                    <input type="number" class="form-control" id="publish_year"  name="publish_year" placeholder="publish_year">
                  </div> --}}

                  <div class="form-group">
                    <label for="author">author</label>
                    <input type="text" class="form-control" id="author" value="{{ $books->author }}" name="author" placeholder="author">
                  </div>

                  <div class="form-group">
                    <label for="borrowedCopies">borrowedCopies</label>
                    <input type="number" class="form-control" id="borrowedCopies" value="{{ $books->borrowedCopies }}" name="borrowedCopies" placeholder="borrowedCopies">
                  </div>
                  <div class="form-group">
                    <label for="availableCopies">availableCopies</label>
                    <input type="number" class="form-control" id="availableCopies" name="availableCopies" value="{{ $books->availableCopies }}" placeholder="availableCopies">
                  </div>






                </div>
                {{-- </form> --}}




                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="button" onclick="performUpdate({{ $books->id }})" class="btn btn-primary">Update</button>
                  {{-- <button type="button" onclick="viewedit('')" class="btn btn-primary">view edit</button> --}}


                </div>
              </form>
            </div>
            <!-- /.card -->


            <!-- /.card -->

          </div>
          <!--/.col (left) -->

          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->



@endsection

@section('scripts')

<script>
    function performUpdate(id){

        let formdata=new FormData();
        formdata.append('title',document.getElementById('title').value);
        formdata.append('name',document.getElementById('name').value);
         formdata.append('author',document.getElementById('author').value);
        // formdata.append('publish_year',document.getElementById('publish_year').value);
        formdata.append('borrowedCopies',document.getElementById('borrowedCopies').value);
        formdata.append('availableCopies',document.getElementById('availableCopies').value);



storeRoute('/cms/borrow_book/books_update/'+id,formdata);





}



   </script>

    @endsection
