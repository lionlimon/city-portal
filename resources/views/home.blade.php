@extends('layouts.app')

@section('content')
<div class="jumbotron main-banner" style="background-image: url('{{ asset('public/img/main-banner.jpeg') }}')">
<div class="container">
		<div class="row">
			<div class="col-md-7 col-12">
				<h1>Привет, дорогой друг!</h1>
				<p>
					Вместе мы сможем улучшить наш любимый город. Нам очень сложно узнать обо всех проблемах города, поэтому мы
					предлагаем тебе помочь своему городу!
				</p>
				<p>
					Увидел проблему? Дай нам знать о ней и мы ее решим!
				</p>
				<p>
					<a class="btn btn-success btn-lg" href="{{ route('application.create') }}" role="button">Сообщить о проблеме</a>	
				</p>
			</div>
			<div class="col-md-5 col-12">
				<div class="counts">
					<p class="count-wrap"><b class="count" id="users">{{ $usersCount }}</b> участников</p>
					<p class="count-wrap"><b class="count" id="resolved">{{ $resolvedCount }}</b> решенных проблем</p>
				</div>
				<script>
					document.addEventListener('DOMContentLoaded', function() {
						if ($('.counts').length > 0) {
							let usersCount = $('#users').text();
							let resolvedCount = $('#resolved').text();

							const audio = new Audio('/city-portal/public/audio/message.mp3');

							setInterval(() => {
								$.ajax({
									url: '/city-portal/counters',
									processData: false,
									contentType: false,
									dataType: "json"
								})
								.done((result) => {
									if (resolvedCount != result.resolvedCount) {
										$('#resolved').text(result.resolvedCount);
										resolvedCount++;
										audio.play();
									}

									if (usersCount != result.usersCount) {
										$('#users').text(result.usersCount);
										usersCount++;
										audio.play();
									}
								});
							}, 5000)
						}
					});
				</script>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<h2>Последние решенные проблемы</h2>
	<br>
	<div class="row">
		@forelse ($applications as $application)
		<div class="col-4 mb-3">
      <div class="card main-card">
      
        <div class="card-img-wrap">
          <img class="card-img-top" src="{{ asset($application->problem_img) }}" alt="{{ $application->name }}">
          <img class="card-img-top card-img-top-resolved" src="{{ asset($application->result_img) }}" alt="{{ $application->name }}">
        </div>
        <div class="card-body">
					<span class="badge badge-secondary">{{ $application->status->name }}</span>
          <h5 class="card-title">{{ $application->name }}</h5>
          <p class="card-text">{{ $application->description }}</p>
          <p class="card-text"><small class="text-muted">{{ $application->created_at }}</small></p>
        </div>
      </div>
    </div>	
		@empty
			Пока еще не одной проблемы не было решено
		@endforelse
		
	</div>
</div>
@endsection
