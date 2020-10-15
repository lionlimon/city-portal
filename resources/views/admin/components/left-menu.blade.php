<div class="main-sidebar">
  <div class="nav flex-column nav-pills">
    <a class="nav-link{{ Request::routeIs('admin.application') ? ' active' : '' }}" href="{{ route('admin.application') }}" role="tab">Заявки</a>
    <a class="nav-link{{ Request::routeIs('admin.category') ? ' active' : '' }}" href="{{ route('admin.category') }}" role="tab">Категории</a>
    <a class="nav-link{{ Request::routeIs('admin.status') ? ' active' : '' }}" href="{{ route('admin.status') }}" role="tab">Статусы</a>
  </div>
</div>