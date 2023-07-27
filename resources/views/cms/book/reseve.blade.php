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
                <h3 class="card-title">Create book</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->


              <form>


                @csrf

                <div class="card-body">

                    <div class="form-group">
                        <label for="name">name</label>
                        <input type="text" class="form-control"  id="name" name="name" placeholder="name">
                      </div>
                    {{-- <div class="form-group">
                        <label for="title">title</label>
                        <input type="text" class="form-control"  id="title" name="title" placeholder="title">
                      </div> --}}


                  <div class="form-group">
                    <label for="borrowedCopies">borrowedCopies</label>
                    <input type="number" class="form-control" id="borrowedCopies" name="borrowedCopies" placeholder="borrowedCopies">
                  </div>
              
         <div class="form-group">
        <br>
        <label>users_name</label>
        <select class="form-control" id="users" name="users">
          @foreach ($users as $user)
          <option value="{{ $user->id }}">{{ $user->name ?? "Not found name" }}</option>
          @endforeach
        </select>
      </div>
         <div class="form-group">
        <br>
        <label>books_name</label>
        <select class="form-control" id="book_id" name="book_id">
          @foreach ($books as $book)
          <option value="{{ $book->id ?? " " }}">{{ $book->name ?? "Not found name" }}</option>
          @endforeach
        </select>
      </div>


                </div>
                {{-- </form> --}}




                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="button" onclick="performStore()" class="btn btn-primary">Store</button>
                  {{-- <button type="button" onclick="viewcreate('')" class="btn btn-primary">view create</button> --}}


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
    function performStore(){
    
        let formdata=new FormData();
        formdata.append('name',document.getElementById('name').value);
        formdata.append('book_id',document.getElementById('book_id').value);
        //  formdata.append('author',document.getElementById('author').value);
        // formdata.append('publish_year',document.getElementById('publish_year').value);
        formdata.append('borrowedCopies',document.getElementById('borrowedCopies').value);
        formdata.append('users',document.getElementById('users').value);
       
       

store('/reseve_book',formdata);


    // axios.post('/cms/borrow_book/books', formdata)
    // .then(function (response) {
    //     showMessage(response.data);
    //     clearForm();
    //     clearAndHideErrors();
    // })
    // .catch(function (error) {
    //     if (error.response && error.response.data && error.response.data.hasOwnProperty('errors')) {
    //         showErrorMessages(error.response.data.errors);
    //     } else {
    //         showMessage('An error occurred. Please try again later.');
    //     }
    // });


}

    

   </script>
   
    @endsection
