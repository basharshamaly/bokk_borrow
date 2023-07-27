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
                <h3 class="card-title">edit doctor</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->


              <form>
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label for="name">name</label>
                        <input type="text" value="{{ $doctors->user->name }}" class="form-control"  id="name" name="name" placeholder="name">
                      </div>
                      <div class="form-group">
                        <label for="faculty">faculty</label>
                        <input type="text" value="{{ $doctors->faculty }}" class="form-control" id="faculty" name="faculty" placeholder="faculty">
                      </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" value="{{ $doctors->user->password }}" id="password"  name="password" placeholder="Password">
                  </div>
                
                  <div class="form-group">
                    <label for="mobile">mobile</label>
                    <input type="text" value="{{ $doctors->mobile }}" class="form-control" id="mobile" name="mobile" placeholder="MAX_BORROW_COUNT">
                  </div>
            
                

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="button" onclick="performUpdate({{$doctors->id}})" class="btn btn-primary">Update</button>
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
      
      
        formdata.append('mobile',document.getElementById('mobile').value);
         
         
        storeRoute('/cms/borrow_book/doctors_update/'+id,formdata);

    }
  </script>
@endsection
