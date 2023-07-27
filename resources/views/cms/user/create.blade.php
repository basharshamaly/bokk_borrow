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
            <h3 class="card-title">Create user</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->

          <form >

            @csrf

            <div class="card-body">

              <div class="form-group">
                <label for="name">name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="name">
              </div>

              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
              </div>

              <div class="form-group">
                <label for="username">username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="username">
              </div>

              <div class="form-group">
                <label for="MAX_BORROW_COUNT">MAX_BORROW_COUNT</label>
                <input type="number" class="form-control" id="MAX_BORROW_COUNT" name="MAX_BORROW_COUNT" placeholder="MAX_BORROW_COUNT">
              </div>


<div class="hidden-inputs" id="input-container">

    <input type="radio" value="employee" id="employee" name="user" onclick="performStore('employee')">
    <label for="employee">employee</label>

    <input type="radio" value="student" id="student" name="user" onclick="performStore('student')">
    <label for="student">student</label>

    <input type="radio" value="doctor" id="doctor" name="user" onclick="performStore('doctor')">
    <label for="doctor">doctor</label>

    {{-- <input type="radio" value="book" id="book" name="user" onclick="performStore('book')">
    <label for="book">book</label> --}}

    <!-- ... -->

    <div class="form-group" style="display: none" id="employee-group-1">
        <br>
        <label for="jop_title">jop_title</label>
        <input type="text" class="form-control" id="jop_title" name="jop_title" placeholder="jop_title">
      </div>

      {{-- <div class="form-group" style="display: none" id="employee-group-2">
        <br>
        <label>users_name</label>
        <select class="form-control" id="user_id" name="user_id">
          @foreach ($users as $user)
          <option value="{{ $user->id }}">{{ $user->name ?? "Not found name" }}</option>
          @endforeach
        </select>
      </div> --}}

      <div class="form-group" style="display: none" id="student-group-1">
        <br>
        <label for="faculty">faculty</label>
        <input type="text" class="form-control" id="faculty" name="faculty" placeholder="faculty">
      </div>

      <div class="form-group" style="display: none" id="student-group-2">
        <br>
        <label for="university_id">university_id</label>
        <input type="number" class="form-control" id="university_id" name="university_id" placeholder="university_id">

      </div>

     

      <div class="form-group" style="display: none" id="doctor-group-1 ">
        <br>
        <label for="mobile">mobile</label>
        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="mobile">
      </div>

      <div class="form-group" style="display: none" id="doctor-group-3">
        <br>
        <label for="faculty_doc">faculty_doc</label>
        <input type="text" class="form-control" id="faculty_doc" name="faculty_doc" placeholder="faculty_doc">

      </div>




  </div>

  <!-- ... -->

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              {{-- <button type="button" onclick="performStore()" class="btn btn-primary">Store</button> --}}
              <button type="button" onclick="performStore('employee')" class="btn btn-primary">Store as Employee</button>
              <button type="button" onclick="performStore('student')" class="btn btn-primary">Store as student</button>
              <button type="button" onclick="performStore('doctor')" class="btn btn-primary">Store as doctor</button>
              <button type="button" onclick="performStore('book')" class="btn btn-primary">Store as book</button>


            </div>
          </form>
        </div>
        <!-- /.card -->

      </div>
      <!--/.col (left) -->

    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection

@section('scripts')

<script>
    function performStore(userType) {
      var inputContainer = document.getElementById('input-container');
      inputContainer.style.display = 'block';

      var formdata = new FormData();
      formdata.append('name', document.getElementById('name').value);
      formdata.append('username', document.getElementById('username').value);
      formdata.append('password', document.getElementById('password').value);
      formdata.append('MAX_BORROW_COUNT', document.getElementById('MAX_BORROW_COUNT').value);
  
      if (userType === 'employee') {
        document.getElementById('employee-group-1').style.display = 'initial';
        formdata.append('jop_title', document.getElementById('jop_title').value);
        formdata.append('user','employee');
      } else if (userType === 'student') {
        document.getElementById('student-group-1').style.display = 'initial';
        document.getElementById('student-group-2').style.display = 'initial';
   
        formdata.append('faculty', document.getElementById('faculty').value);
        formdata.append('university_id', document.getElementById('university_id').value);
    
        formdata.append('user','student');

      } else if (userType === 'doctor') {
        document.getElementById('doctor-group-1 ').style.display = 'initial';
        document.getElementById('doctor-group-3').style.display = 'initial';
        formdata.append('mobile', document.getElementById('mobile').value);
        formdata.append('faculty_doc', document.getElementById('faculty_doc').value);
        formdata.append('user','doctor');
    
      }
   
      else {
        console.log("Error: Invalid selection");
        return; // Exit the function if the user type is invalid
      }


axios.post('/cms/borrow_book/stor_user/' + userType, formdata)
    .then(function (response) {
        showMessage(response.data);
        clearForm();
        clearAndHideErrors();
    })
    .catch(function (error) {
        if (error.response.data.errors !== undefined) {
            showErrorMessages(error.response.data.errors);
        } else {
            showMessage(error.response.data);
        }
    });



      // store('/cms/borrow_book/stor_user/'+userType, formdata);
    }
    </script>


@endsection
