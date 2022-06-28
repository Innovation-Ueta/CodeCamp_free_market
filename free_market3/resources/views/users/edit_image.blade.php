@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <h2>現在の画像</h2>
  {{-- {{ dd($user) }} --}}

  <div>
    
    <a href="{{ route('profile.edit_image', $user) }}">
      <div class="profile_body_main_img">
        @if ($user->image !== '')
          {{-- <img src="{{ asset('storages/storage/' . $item->image) }}"> --}}
          <img src="{{ 'storages'.Storage::url($user->image) }}" alt="">
        @else
          <img src="{{ asset('images/no_image.png') }}" alt="">
        @endif

        <form action="{{ route('profile.update_image', $user) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('patch')
          <label for="image">画像を選択</label>
          <input type="file" name="image">
          <div>
            <input type="submit" value="更新">
          </div>
        </form>

      </div>
    </a>
  </div>

@endsection