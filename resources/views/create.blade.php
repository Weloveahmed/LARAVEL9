@extends('main')
@section('titel')
   Add new job 
@endsection

@section('content')
<form method="POST" enctype="multipart/form-data" action="{{ route('storejob')}}" style="width:80%; margin:0 auto;">
  @csrf
    <div class="form-group">
      <label for="job_name">Job Name</label>
      <input type="text" class="form-control" id="job_name" name="job_name" value="{{old('job_name')}}">
      @error('job_name')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group">
      <label for="job_name">Active Status</label>
      <select class="form-control" name="job_active" id="job_active">
        <option value="">Select Status</option>
        <option @if (old('job_active')==1) selected @endif value="1">Online</option>
        <option @if (old('job_active')==0 and old ('job_active')!='' )selected @endif value="0">Offline</option>
      </select>
      @error('job_active')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group">
      <label for="job_name">Jobs Logo</label>
      <input type="file" class="form-control" name="photo" id="photo">
      @error('photo')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary">Add Job</button>
  </form>
    
@endsection