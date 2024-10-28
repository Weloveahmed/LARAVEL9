@extends('main')

@section('titel')
    صفحة الوظائف
@endsection

@section('content')

@if (Session::has('success'))
<div class="alert alert-success" role="alert">
    {{ Session::get('success') }}
</div>
@endif

@if (Session::has('error'))
<div class="alert alert-danger" role="alert">
    {{ Session::get('error') }}
</div>
@endif
<p style="text-align:center;">
<a href="{{ route('languageConverter','ar') }}">AR</a>
<a href="{{ route('languageConverter','en') }}">EN</a>
<a href="{{ route('languageConverter','fr')}}">FR</a>
</p>
<p>
    <a href="{{ route('createjob') }}" class="btn btn-sm btn-info" style="margin: 5%; color:white;">{{__('mycustom.addnew')}}</a>

</p>

<div class="col-md-6">
    <input id="searchbyjobname" class="form-control" type="text" placeholder="Search by job name">
    <br>
</div>

<div id="ajax_search_result">
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Active</th>
                <th>photo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if (!@empty($data))
                @php $i = 1; @endphp
                @foreach ($data as $info)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $info->name }}</td>
                    <td>{{ $info->active == 1 ? 'Online' : 'Offline' }}</td>
                    <td>
                        <a href="{{ route('editjob', $info->id) }}" class="btn btn-sm btn-primary" style="color: white">
                            {{__('mycustom.edit')}}
                        </a>
                        <a href="{{ route('deletejob', $info->id) }}" class="btn btn-sm btn-danger" style="color: white">
                            {{__('mycustom.delete')}}
                        </a>
                    </td>
                    <td>
                        <img src="uploads/{{ $info->photo }}" style="width: 60px; height: 60px;">
                    </td>
                </tr>
                @php $i++; @endphp
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center">No jobs found.</td>
                </tr>
            @endif
        </tbody>
    </table>
    <br>
    {{ $data->links() }}
</div>

@endsection

@section('script')
<script>
$(document).ready(function() {

    // Search by job name
    $(document).on('input', "#searchbyjobname", function() {
        let searchbyjobname = $(this).val();

        $.ajax({
            url: "{{ route('ajax_search_job') }}",
            type: 'post',
            dataType: 'html',
            cache: false,
            data: { searchbyjobname: searchbyjobname, "_token": "{{ csrf_token() }}" },
            success: function(data) {
                $("#ajax_search_result").html(data);
            },
            error: function() {
                console.error('Error fetching search results.');
            }
        });
    });

    // Handle AJAX pagination
    $(document).on('click', "#ajax_search_pagination a", function(e) {
        e.preventDefault();
        let url = $(this).attr("href");
        let searchbyjobname = $("#searchbyjobname").val();

        $.ajax({
            url: url,
            type: 'post',
            dataType: 'html',
            cache: false,
            data: { searchbyjobname: searchbyjobname, "_token": "{{ csrf_token() }}" },
            success: function(data) {
                $("#ajax_search_result").html(data);
            },
            error: function() {
                console.error('Error with pagination.');
            }
        });
    });

});
</script>
@endsection
