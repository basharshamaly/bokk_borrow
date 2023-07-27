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
                <h3 class="card-title">edit employee</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->


              <form>
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label for="name">name</label>
                        <input type="text" value="{{ $employees->user->name }}" class="form-control"  id="name" name="name" placeholder="name">
                      </div>
                      {{-- <div class="form-group">
                        <label for="username">username</label>
                        <input type="text" value="{{ $employees->user->username }}" class="form-control" id="username" name="username" placeholder="username">
                      </div> --}}
                  {{-- <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password"  name="password" placeholder="Password">
                  </div> --}}
                  <div class="form-group">
                    <label for="jop_title">jop_title</label>
                    <input type="text" value="{{ $employees->jop_title }}" class="form-control" id="jop_title" name="jop_title" placeholder="jop_title">
                  </div>

                  
                  {{-- <div class="form-group">
                    <label>users_name</label>
                    <select class="form-control" id="user_id" name="user_id">
                        @foreach ( $users as $user)
                   
                      <option   @if($user->id==$employees->user->user_id) selected @endif value="{{$user->id}}">{{ $user->name ?? "Not found name" }}</option>
                      @endforeach
                    </select>
                  </div> --}}
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="button" onclick="performUpdate({{$employees->id}})" class="btn btn-primary">Update</button>
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
        
        //  formdata.append('username',document.getElementById('username').value);
        // formdata.append('password',document.getElementById('password').value);
      
        formdata.append('jop_title',document.getElementById('jop_title').value);
        // formdata.append('user_id',document.getElementById('user_id').value);
         
        storeRoute('/cms/borrow_book/employees_update/'+id,formdata);

    }
  </script>
@endsection
