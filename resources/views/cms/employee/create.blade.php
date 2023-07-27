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
                <h3 class="card-title">Create employee</h3>
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

                  <div class="form-group">
                    <label for="password">password</label>
                    <input type="password" class="form-control" id="password"  name="password" placeholder="password">
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

                    <input type="radio" value="employee" id="employee" name="user" onclick="performStore()" value="1">
                    {{-- <input type="radio" value="employee" id="employee" name="user" value="1"> --}}
                    <label for="employee">employee</label>

                    <input type="radio" value="student"  id="student" name="user" onclick="performStore()" value="2">
                    {{-- <input type="radio" value="student"  id="student" name="user"  value="2"> --}}
                    <label for="student">student</label>

                    <input type="radio" value="doctor" id="doctor" name="user" onclick="performStore()" value="3">
                    {{-- <input type="radio" value="doctor" id="doctor" name="user" value="3"> --}}
                    <label for="doctor">doctor</label>




                    <div class="form-group" style="display: none" id="employee-group-1" >
                      <br>
                      <label for="jop_title">jop_title</label>
                      <input type="text" class="form-control"  id="jop_title" name="jop_title" placeholder="jop_title">
                    </div>

                  <div class="form-group" style="display: none" id="employee-group-2">
                    <br>
                    <label>users_name</label>
                    <select class="form-control" id="user_id" name="user_id">
                        @foreach ( $users as $user)

                      <option value="{{$user->id}}">{{ $user->name ?? "Not found name" }}</option>
                      @endforeach
                    </select>
                  </div>



                    <div class="form-group" style="display: none" id="student-group-1" >
                      <br>
                        <label for="faculty">faculty</label>
                        <input type="text" class="form-control" id="faculty"  name="faculty" placeholder="faculty">
                      </div>

                      <div class="form-group" style="display: none" id="student-group-2" >
                        <br>
                        <label for="university_id">university_id</label>
                        <input type="number"  class="form-control" id="university_id" name="university_id" placeholder="university_id">
                      </div>


                     <div class="form-group" style="display: none" id="doctor-group-1">
                      <br>
                        <label for="mobile">mobile</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="mobile">
                      </div>
                   <div class="form-group" style="display: none" id="doctor-group-2">
                    <br>
                        <label for="faculty_doc">faculty_doc</label>
                        <input type="text" class="form-control" id="faculty_doc" name="faculty_doc" placeholder="faculty">
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
        var inputContainer = document.getElementById('input-container');
          inputContainer.style.display = 'block';
        let formdata=new FormData();
        formdata.append('name',document.getElementById('name').value);
         formdata.append('username',document.getElementById('username').value);
        formdata.append('password',document.getElementById('password').value);
        formdata.append('MAX_BORROW_COUNT',document.getElementById('MAX_BORROW_COUNT').value);
        if (document.getElementById('employee').checked) {
         document.getElementById('employee-group-1').style.display = 'initial';
        document.getElementById('employee-group-2').style.display = 'initial';
            formdata.append('jop_title',document.getElementById('jop_title').value);
         formdata.append('user_id',document.getElementById('user_id').value);
       
        }else if (document.getElementById('student').checked) {

        document.getElementById('student-group-1').style.display = 'initial';
        document.getElementById('student-group-2').style.display = 'initial';

        formdata.append('faculty',document.getElementById('faculty').value);
         formdata.append('university_id',document.getElementById('university_id').value);


} else if (document.getElementById('doctor').checked) {

document.getElementById('doctor-group-1').style.display = 'initial';
document.getElementById('doctor-group-2').style.display = 'initial';

formdata.append('mobile',document.getElementById('mobile').value);
     formdata.append('faculty_doc',document.getElementById('faculty_doc').value);



} 

store('/cms/borrow_book/employees',formdata);


// function store('/cms/borrow_book/employees', formdata) {
    // axios.post('/cms/borrow_book/users', formdata)
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
   {{-- <script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
{{-- <script> --}}

    {{-- // function viewcreate() {
    //   var inputContainer = document.getElementById('input-container');
    //   inputContainer.style.display = 'block';
    //   var data_1 = {
    //     name: document.getElementById('name').value,
    //     username: document.getElementById('username').value,
    //     password: document.getElementById('password').value,
    //     MAX_BORROW_COUNT: document.getElementById('MAX_BORROW_COUNT').value
    //   };

    //   if (document.getElementById('employee').checked) {

    //     document.getElementById('employee-group-1').style.display = 'initial';
    //     document.getElementById('employee-group-2').style.display = 'initial';
    //     data_1.jop_title = document.getElementById('jop_title').value;
    //      data_1.user_id = document.getElementById('user_id').value ;

    // } else if (document.getElementById('student').checked) {

//         document.getElementById('student-group-1').style.display = 'initial';
//         document.getElementById('student-group-2').style.display = 'initial';

//         data_1.faculty = document.getElementById('faculty').value;
//          data_1.university_id = document.getElementById('university_id').value;

//     } else if (document.getElementById('doctor').checked) {

//         document.getElementById('doctor-group-1').style.display = 'initial';
//         document.getElementById('doctor-group-2').style.display = 'initial';

//         data_1.mobile = document.getElementById('mobile').value;
//          data_1.faculty_doc = document.getElementById('faculty_doc').value;


//     } else {
//         console.error('Error: Invalid selection');
//         return;
//     }
//       axios.post('/cms/borrow_book/employees/', data_1)
//         .then(function(response) {
//             // console.log(response)
//         //   return response()->json();
//             // console.log("ssq");
//        Swal.fire({
//         // title:response.data.message,
//         title: "succefuly process create  user Done",
//         text: 'Do you want to continue',
//         icon: 'success',
//          confirmButtonText: 'Done'
// })
//         })
//         .catch(function(error) {
//             //   console.log(error);
//             // console.log(error.response.data.message)
//             // console.log("qoqo");
//      Swal.fire({
//   title: "failed process create  user",
// title: error.response.data.message,
//   text: 'Do you want to continue',
//   icon: 'error',
//   confirmButtonText: 'Faild'
// })

//         });
//     }
    // </script> --}}
    @endsection
