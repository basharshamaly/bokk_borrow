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
                    <th>faculty</th>
                    <th>mobile</th>
                    {{-- <th>user_id</th> --}}
                
                    <th>created_at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($doctors as $doctor)


                  <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{  $doctor->users->name}} </td>
                    {{-- <td>{{  $doctor->users->MAX_BORROW_COUNT}}</td> --}}
                    <td>{{  $doctor->users->username}}</td>
                    <td>{{  $doctor->users->MAX_BORROW_COUNT}}</td>
                    <td>{{  $doctor->faculty}}</td>
                    <td>{{  $doctor->mobile}}</td>
                    {{-- <td>{{  $doctor->users->id}} </td> --}}
                    {{-- <td>{{  $doctor->user->user_books->books->name}}</td> --}}

                    <td>{{$doctor->created_at}}</td>
                    <td style="display:flex; gap:15px;">
                        <div class="btn-group">
                            <a href="{{route('doctors.edit' ,$doctor->id)}}" type="button" class="btn btn-success">Edit</a>
                            {{-- <a href="{{ route('users.show' ,$user->id) }}"  type="button" class="btn btn-info">Show</a> --}}
                            {{-- <button onclick=" performdelete({{$doctor->id }},this)"  type="button" class="btn btn-danger">Delete</button> --}}
                          </div>



                    </td>
                  </tr>
                  @endforeach

                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            {{$doctors->links()}}
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

        confirmDestroy('/cms/borrow_book/doctors/'+id, reference);
    }
</script> --}}