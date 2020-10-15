@extends('layouts.app')

@section('content')

  
  <div class="container">
    <div class="row">
      <div class="col-3">
        @include('admin.components.left-menu')
      </div>
      <div class="col">
        <form id="category" method="POST" action="{{ route('category.store') }}">
          @csrf 
          @method('POST')
          <div class="form-group">
            <label>Название категории</label>
            <input name="name" type="text" class="form-control" placeholder="Введите название категории">
          </div>
          <button type="submit" class="btn btn-primary">Создать</button>
        </form>
        <hr>
        @forelse($categories as $category)
          <div class="card mt-2">
            <div class="card-body row">
              <div class="col-4">
                <form id="category-update" method="POST" action="{{ route('category.destroy', $category->id) }}">
                  <input type="text" name="name" class="form-control d-inline" value="{{ $category->name }}">
          
                  @method('PUT')
                  @csrf
                </form>
              </div>
              <div class="col d-flex justify-content-end">
                <form id="category-delete" class="d-inline-flex align-self-center" action="{{ route('category.destroy', $category->id) }}" method="POST">
                  <button type="sumbit" class="close" >&times;</button >
                  @method('DELETE')
                  @csrf
                </form>
              </div>
            </div>
          </div>
        @empty 
          <div class="card">
            <div class="card-body">Категорий нет</div>
          </div>
        @endforelse
      </div>
    </div>
  </div>
  
@endsection