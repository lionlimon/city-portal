@if ($application)
<div class="card main-card problem-card">
  {{-- Img --}}
  <div class="card-img-wrap">
    <img src="{{ asset($application->problem_img) }}" alt="{{ $application->name }}" class="card-img-top problem-card-img">

    @if ($application->result_img)
      <img class="card-img-top card-img-top-resolved" src="{{ asset($application->result_img) }}" alt="{{ $application->name }}">
    @endif
  </div>
  {{-- End Img --}}

  <div class="card-body">

    {{-- Main info --}}
    @if ($application->status)
      <span class="badge badge-secondary">{{ $application->status->name }}</span>
    @endif

    <h5 class="card-title">{{ $application->name }}</h5>
    <p class="card-text">{{ $application->description }}</p>
    {{-- End main info --}}
    
    <p class="card-text">
      {{-- User name --}}
      @if ($application->user->name)
        <b class="text-muted">{{ $application->user->name }}</b>
      @endif
      {{-- End user name --}}

      {{-- Date --}}
      @if ($application->isNew())
        <small class="text-muted">{{ $application->created_at->format('d.m.Y') }}</small>
      @else
        <small class="text-muted">{{ $application->updated_at->format('d.m.Y') }}</small>
      @endif
      {{-- End date --}}
    </p>
  
  
    {{-- Rejected text --}}
    @if($application->isRejected()) 
      <div class="alert alert-info" role="alert">
        <h6>Причина отказа:</h6>
        {{ $application->result_text }}
      </div>
    @endif
    {{-- End rejected text --}}

    {{ $body ?? "" }}

  </div>
</div>
@endif