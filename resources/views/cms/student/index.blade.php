@extends('cms.paernt')


@section('style')



@section('content')

<section class="content">
    <div class="container-fluid">



      <!-- /.row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Responsive Hover Table</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>name</th>
                    <th>MAX_BORROW_COUNT</th>
                    <th>username</th>
                    <th>user_id</th>
                    <th>university_id</th>
                    <th>faculty</th>
                

                    {{-- <th>Name_borrowed_books</th> --}}
                    <th>created_at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)


                  <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{  $student->user->name ?? ""}} </td>
                    <td>{{  $student->user->MAX_BORROW_COUNT ?? ""}}</td>
                    <td>{{  $student->user->username ?? ""}}</td>
                    <td>{{  $student->users->id ?? ""}}</td>
                    <td>{{  $student->university_id ?? ""}}</td>
                    <td>{{  $student->faculty ?? ""}}</td>
                    <td>{{$student->created_at ?? ""}}</td>
                 
                   
                    {{-- <td>{{  $student->user->user_books->books->name}}</td> --}}

           

                    <td style="display:flex; gap:15px;">
                        <div class="btn-group">
                            <a href="{{route('students.edit' ,$student->id)}}" type="button" class="btn btn-success">Edit</a>
                            {{-- <a href="{{ route('users.show' ,$user->id) }}"  type="button" class="btn btn-info">Show</a> --}}
                            {{-- <button onclick=" performdelete({{$student->id }},this)"  type="button" class="btn btn-danger">Delete</button> --}}
                          </div>



                    </td>
                  </tr>
                  @endforeach

                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            {{$students->links()}}
          </div>
          <!-- /.card -->
        </div>
      </div>



      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>

@endsection

{{-- <script>
    function performdelete(id,reference){

        confirmDestroy('/cms/borrow_book/students/'+id, reference);
    }
</script> --}}