@extends('main')
@section('titel')
   Edit job 
@endsection

@section('content')
<form method="POST" action="{{ route('updatejob',$data['id'])}}" style="width:80%; margin:0 auto;">
  @csrf
    <div class="form-group">
      <label for="job_name">Job Name</label>
      <input type="text" class="form-control" id="job_name" name="job_name" value="{{old('job_name', $data['name'])}}">
      @error('job_name')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group">
      <label for="job_name">Active Status</label>
      <select class="form-control" name="job_active" id="job_active">
        <option value="">Select Status</option>
        <option @if (old('job_active' , $data['active']==1)) selected @endif value="1">Online</option>
        <option @if (old('job_active' , $data['active']==0) and old('job_active' , $data['active'])!='') selected @endif value="0">Offline</option>
      </select>
      @error('job_active')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary">Update Job</button>
  </form>
    
@endsection