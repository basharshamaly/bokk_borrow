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
                    <th>username</th>
                    <th>MAX_BORROW_COUNT</th>
                    <th>jop_title</th>
                   {{-- <th>title book</th> --}}
               
                    <th>created_at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)


                  <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{  $employee->user->name ?? " "}} </td>
                    <td>{{   $employee->user->username ?? ""}}</td>
                    <td>{{   $employee->user->MAX_BORROW_COUNT ?? ""}}</td>
                   
                    <td>{{  $employee->jop_title ?? ""}}</td>
             
                  
                 


                    {{-- <td>{{   $employee->user_books->books->title ??""}}</td> --}}
                    
                 
                    <td>{{   $employee->created_at ??""}}</td>
                 
                   
                    <td style="display:flex; gap:15px;">
                        <div class="btn-group">
                            <a href="{{route('employees.edit' ,$employee->id)}}" type="button" class="btn btn-success">Edit</a>
                            {{-- <a href="{{ route('employees.show' ,$employee->id) }}"  type="button" class="btn btn-info">Show</a> --}}
                            <button onclick=" performdelete({{$employee->id }},this)"  type="button" class="btn btn-danger">Delete</button>
                          </div>



                    </td>
                  </tr>
                  @endforeach

                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            {{$employees->links()}}
          </div>
          <!-- /.card -->
        </div>
      </div>



      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>

@endsection

<script>
    function performdelete(id,reference){

        confirmDestroy('/cms/borrow_book/employees/'+id, reference);
    }
</script>
