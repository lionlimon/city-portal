@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6 col-12">
      <div class="card shadow">

        @if(file_exists($application->problem_img))
        <img class="card-img-top" src="{{ asset($application->problem_img) }}" alt="{{ $application->name }}">
        @endif      
        
        <div class="card-body">
          <h1 class="card-title">Редактирование заявки</h1>

          <form id="application" method="POST" enctype="multipart/form-data" action="{{ route('application.update', $application) }}">
            @method('PUT')
            <div class="form-group">
              <label>Название</label>
              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $application->name }}">
              @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="form-group">
              <label>Описание</label>
              <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ $application->description }}">
              @error('description')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="form-group">
              <label>Категория</label>
              <select class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                @foreach($categories as $category)
                <option value="{{ $category->id }}"{{$application->category_id == $category->id ? ' selected' : ''}}>{{ $category->name }}</option>
                @endforeach
              </select>
              @error('category_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="form-group">
              <label>Фото (не более 10 МБ)</label> 
              <input type="file" name="problem_img" class="form-control-file @error('problem_img') is-invalid @enderror" value="{{ $application->problem_img }}">
              @error('problem_img')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            @csrf
            <button type="submit" class="btn btn-dark">Сохранить</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection