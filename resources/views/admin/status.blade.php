@extends('layouts.app')

@section('content')
  
  <div class="container">
    <div class="row">
      <div class="col-3">
        @include('admin.components.left-menu')
      </div>
      <div class="col">
        <form id="status" method="POST" action="{{ route('status.store') }}">
          @csrf 
          @method('POST')
          <div class="form-group">
            <label>Название статуса</label>
            <input name="name" type="text" class="form-control" placeholder="Введите название статуса">
          </div>
          <button type="submit" class="btn btn-primary">Создать</button>
        </form>
        <hr>
        @forelse($statuses as $status)
          <div class="card mt-2">
            <div class="card-body row">
              <div class="col-4">
                <form id="status-update" method="POST" action="{{ route('status.destroy', $status->id) }}">
                  <input type="text" name="name" class="form-control d-inline" value="{{ $status->name }}">
          
                  @method('PUT')
                  @csrf
                </form>
              </div>
              <div class="col d-flex justify-content-end">
                <form id="status-delete" class="d-inline-flex align-self-center" action="{{ route('status.destroy', $status->id) }}" method="POST">
                  <button type="sumbit" class="close" >&times;</button >
                  @method('DELETE')
                  @csrf
                </form>
              </div>
            </div>
          </div>
        @empty 
          <div class="card">
            <div class="card-body">Статусов нет</div>
          </div>
        @endforelse
        
      </div>
    </div>
  </div>
  
@endsection