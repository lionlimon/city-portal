@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-3">
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link{{ !Request::get('filter') ? ' active' : '' }}" href="{{ route('application.index') }}">Все</a>
            </li>
            <li class="nav-item">
              <a class="nav-link{{ Request::get('filter') == 'new' ? ' active' : '' }}" href="{{ route('application.index', ['filter' => 'new']) }}">Новые</a>
            </li>
            <li class="nav-item">
              <a class="nav-link{{ Request::get('filter') == 'rejected' ? ' active' : '' }}" href="{{ route('application.index', ['filter' => 'rejected']) }}">Отклонены</a>
            </li>
            <li class="nav-item">
              <a class="nav-link{{ Request::get('filter') == 'resolved' ? ' active' : '' }}" href="{{ route('application.index', ['filter' => 'resolved']) }}">Решены</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  @forelse ($applications as $application)
    
    <div class="col-4 mb-3">
      <div class="card main-card">
        @if($application->isNew())
        <button data-toggle="modal" data-target="#application-delete-modal-{{ $application->id }}" type="" class="close card-close" >&times;</button >
        @endif
 
        <div class="card-img-wrap">
          <img class="card-img-top" src="{{ asset($application->problem_img) }}" alt="{{ $application->name }}">
        </div>
        <div class="card-body">
          <span class="badge badge-secondary">{{ $application->status->name }}</span>
          <h5 class="card-title">{{ $application->name }}</h5>
          <p class="card-text">{{ $application->description }}</p>
          <p class="card-text"><small class="text-muted">{{ $application->created_at }}</small></p>
          @if($application->isNew())
          <div class="row">        
            <div class="col">
              <a href="{{ route('application.edit', $application) }}" type="submit" class="btn btn-block btn-secondary">Изменить</a>
            </div>
          </div>
          @endif

          @if($application->isRejected()) 
          <div class="alert alert-info" role="alert">
            {{ $application->result_text }}
          </div>
          @endif
        </div>
      </div>
    </div>
    
    @if($application->isNew())
    <form class="modal" id="application-delete-modal-{{ $application->id }}" tabindex="-1" role="dialog" method="POST" action="{{ route('application.destroy', $application) }}">
      @method('DELETE')
      @csrf
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Удаление заявки</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Вы действительно хотите удалить эту заявку?</p>
          </div>
          <div class="modal-footer">
            <button id="" type="submit" class="btn btn-primary">Удалить</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
          </div>
        </div>
      </div>
    </form>
    @endif
  @empty
    
  <div class="col mb-2">Заявок нет</div>
    
  @endforelse
    
    <div class="col-12">
      <div class="card d-inline-block">
        <div class="card-body">
          <a href="{{ route('application.create') }}" class="btn btn-dark">Создать заявку</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection