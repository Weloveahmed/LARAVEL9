<table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Active</th>
       
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
   @if (!@empty($data))
      @php $i=1;  @endphp
       @foreach ($data as $info )
        <tr>
            <td>{{ $i }}</td>
            <td>{{ $info->name }}</td>
            <td> @if ($info->active==1) Online @else Offline @endif</td>
           
            <td>
                <a href="{{ route('editjob',$info->id) }}" style="color: white" class="btn btn-sm btn-primary">Edit</a>
                <a href="{{ route('deletejob',$info->id) }}" style="color: white" class="btn btn-sm btn-danger">Delete</a>
            </td>
        </tr>
        @php $i++;  @endphp
       @endforeach
   @else
       
   @endif
    </tbody>
  </table>
  <br>
  <div class="col-md-12" id="ajax_search_pagination">
    {{ $data->links() }}

  </div>
 