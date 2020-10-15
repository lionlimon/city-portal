@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-3">
      @include('admin.components.left-menu')
    </div>
    <div class="col">
      <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-3">
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link{{ !Request::get('filter') ? ' active' : '' }}" href="{{ route('admin.application') }}">Все</a>
            </li>
            <li class="nav-item">
              <a class="nav-link{{ Request::get('filter') == 'new' ? ' active' : '' }}" href="{{ route('admin.application', ['filter' => 'new']) }}">Новые</a>
            </li>
            <li class="nav-item">
              <a class="nav-link{{ Request::get('filter') == 'rejected' ? ' active' : '' }}" href="{{ route('admin.application', ['filter' => 'rejected']) }}">Отклонены</a>
            </li>
            <li class="nav-item">
              <a class="nav-link{{ Request::get('filter') == 'resolved' ? ' active' : '' }}" href="{{ route('admin.application', ['filter' => 'resolved']) }}">Решены</a>
            </li>
          </ul>
        </div>
      </nav>
      
      <div class="row">
        @forelse($applications as $application) 
  
        <div class="col-sm-6 col-12 mb-3">
          <div class="card main-card problem-card">
            <div class="card-img-wrap">
              <img src="{{ asset($application->problem_img) }}" alt="{{ $application->name }}" class="card-img-top problem-card-img">
            </div>
            <div class="card-body">
              <span class="badge badge-secondary">{{ $application->status->name }}</span>
              <h5 class="card-title">{{ $application->name }}</h5>
              <p class="card-text">{{ $application->description }}</p>

              @if ($application->isNew())
              <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#app-{{ $application->id }}-resolve">Решена</button>
              <button class="btn btn-secondary btn-block" data-toggle="modal" data-target="#app-{{ $application->id }}-reject">Отклонена</button>
              @endif
              
              @if($application->isRejected()) 
              <div class="alert alert-info" role="alert">
                <h6>Причина отказа:</h6>
                {{ $application->result_text }}
              </div>
              @endif
            </div>
          </div>
        </div>
  
        <div class="modal" id="app-{{ $application->id }}-resolve" tabindex="-1" role="dialog">
          <form method="POST" enctype="multipart/form-data" action="{{ route('admin.applicationResolve', $application) }}" class="modal-dialog" role="document">
            @method('PUT')
            @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Смена статуса задачи</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Приложите изображение решенной проблемы.</p>
                  
                <input type="file" name="result_img" required>             
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Подтвердить</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
              </div>
            </div>
          </form>
        </div>
  
        <div class="modal" id="app-{{ $application->id }}-reject" tabindex="-1" role="dialog">
          <form method="POST" enctype="multipart/form-data" action="{{ route('admin.applicationReject', $application) }}" class="modal-dialog" role="document">
            @method('PUT')
            @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Смена статуса задачи</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Объясните, почему данное обращение отклоняется</p>
                  
                <div class="form-group">
                  <label>Причина</label>
                  <textarea type="password" class="form-control" name="result_text"></textarea>
                </div>           
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Подтвердить</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
              </div>
            </div>
          </form>
        </div>
        @empty 
          <div class="col">
            <div class="card">
              <div class="card-body">
                Заявок нет
              </div>
            </div>
          </div>
        @endforelse
      </div>
      
    </div>
  </div>
</div>
@endsection