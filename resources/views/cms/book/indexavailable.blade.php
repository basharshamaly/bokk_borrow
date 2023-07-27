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
                    {{-- <th>title</th> --}}
                    {{-- <th>author</th> --}}
                    {{-- <th>publish_year</th> --}}
                    {{-- <th>borrowedCopies</th> --}}
                   {{-- <th>users_name</th> --}}
                   {{-- <th>booksname</th> --}}
               
                    <th>deleted_at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($borrowbooks as $borrowbook)
                    

                  <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{  $borrowbook->name ?? " "}} </td>
                    {{-- <td>{{  $borrowbook->title ?? " "}} </td> --}}
                    {{-- <td>{{   $borrowbook->author ?? ""}}</td> --}}
                    {{-- <td>{{   $borrowbook->publish_year ?? ""}}</td> --}}
                   
                    {{-- <td>{{  $borrowbook->borrowedCopies ?? ""}}</td> --}}
                   
                    {{-- <td>{{  $borrowbook->user->name ?? ""}}</td> --}}
                    {{-- <td>{{  $borrowbook->books->name ?? ""}}</td> --}}
             
                 
                    
                 
                    <td>{{   $borrowbook->deleted_at ??" found not deleted"}}</td>
                 
             
                    <td style="display:flex; gap:15px;">
                        <div class="btn-group">
                            {{-- <a href="{{ route('restore_reseve_book.book',$borrowbook->id) }}"  type="button" class="btn btn-success"><i class="fas fa-warehouse"></i></a> --}}
                            {{-- <a href="{{ route('borrowbooks.show' ,$borrowbook->id) }}"  type="button" class="btn btn-info">Show</a> --}}
                          </div>
                          <form method="POST" action="{{ route('destroys.book',$borrowbook->id) }}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                          </form>


                    </td>
                  </tr>
                  @endforeach

                </tbody>
              </table>
            </div>
         
          </div>
          <!-- /.card -->
        </div>
      </div>



      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>

@endsection

{{-- <script>
    function performdelete(id){

        // axios.post(/borrowbooks_delete/'+id)
        // .then(function (response) {
        //     showMessage(response.data);
        //     clearForm();
        //     clearAndHideErrors();

        // })
        // .catch(function (error) {

        //     if (error.response.data.errors !== undefined) {
        //         showErrorMessages(error.response.data.errors);
        //     } else {
        //         showMessage(error.response.data);
        //     }
        // });




        confirmDestroy('/borrowbooks_delete/'+id);


    }
</script> --}}
