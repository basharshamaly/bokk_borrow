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
                <h3 class="card-title">edit student</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->


              <form>
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label for="name">name</label>
                        <input type="text" value="{{ $students->user->name }}" class="form-control"  id="name" name="name" placeholder="name">
                      </div>
                      <div class="form-group">
                        <label for="faculty">faculty</label>
                        <input type="text" value="{{ $students->faculty }}" class="form-control" id="faculty" name="faculty" placeholder="faculty">
                      </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" value="{{ $students->user->password }}" id="password"  name="password" placeholder="Password">
                  </div>
                  {{-- <div class="form-group">
                    <label for="MAX_BORROW_COUNT">MAX_BORROW_COUNT</label>
                    <input type="number" value="{{ $students->user->MAX_BORROW_COUNT }}" class="form-control" id="MAX_BORROW_COUNT" name="MAX_BORROW_COUNT" placeholder="MAX_BORROW_COUNT">
                  </div> --}}
              
            
               

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="button" onclick="performUpdate({{$students->id}})" class="btn btn-primary">Update</button>
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
        formdata.append('name',document.getElementById('name').value);
        
         formdata.append('faculty',document.getElementById('faculty').value);
        formdata.append('password',document.getElementById('password').value);
      
      
         
        storeRoute('/cms/borrow_book/students_update/'+id,formdata);

    }
  </script>
@endsection
