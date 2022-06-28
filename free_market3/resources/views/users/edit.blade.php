@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>

  <form action="{{ route('profile.update') }}" method="POST">
    @csrf
    @method('put')
    <div>
      <label>
        名前：
        <input type="text" name="name">
      </label>
    </div>
    
    <div>
      <label>
        プロフィール：
        <textarea name="profile" id="profile" cols="30" rows="10"></textarea>
      </label>
    </div>
    

    <div>
      <input type="submit" value="更新">
    </div>
  </form>
  
@endsection