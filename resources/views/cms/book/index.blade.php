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
                    <th>title</th>
                    <th>name</th>
                    <th>author</th>
                    <th>publish_year</th>
                    <th>borrowedCopies</th>
                   <th>availableCopies</th>

                    <th>created_at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)


                  <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{  $book->title ?? " "}} </td>
                    <td>{{  $book->name ?? " "}} </td>
                    <td>{{   $book->author ?? ""}}</td>
                    <td>{{   $book->publish_year ?? ""}}</td>

                    <td>{{  $book->borrowedCopies ?? ""}}</td>

                    <td>{{  $book->availableCopies ?? ""}}</td>




                    <td>{{   $book->created_at ??""}}</td>


                    <td style="display:flex; gap:15px;">
                        <div class="btn-group">
                            {{-- <a href="{{route('books.edit',$book->id  ) }}  ?? " type="button" class="btn btn-success">Edit</a> --}}
                            <a href="{{route('books.edit' ,$book->id)}}" type="button" class="btn btn-success">Edit</a>
                            <button onclick='performdelete({{$book->id   }},this)'  type="button" class="btn btn-danger">Delete</button>
                            {{-- <a href="{{route('reseve.book',$book->id  ) }}  ?? " type="button" class="btn btn-success"><i class="fas fa-window-restore"></i></a> --}}
                            <a href="{{ route('create_reseve_books.book') }}"  type="button" class="btn btn-success"><i class="fas fa-window-restore"></i></a>

                        </div>



                    </td>
                  </tr>
                  @endforeach

                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            {{$books->links()}}
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

        confirmDestroy('/cms/borrow_book/books/'+id, reference);
    }
</script>
