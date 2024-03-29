<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-static-top">
  <div class="container">
    <a href="{{url('/')}}" class="navbar-brand">LaraBBS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportContent" aria-controls="navbarSupportContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportContent">
      <!-- Left -->
      <ul class="navbar-nav mr-auto">
        <li class="nav-item {{ active_class((if_route('topics.index'))) }}"><a href="{{route('topics.index')}}" class="nav-link">话题</a></li>
        <li class="nav-item {{ category_nav_active(1) }}"><a href="{{route('categories.show',1)}}" class="nav-link">分享</a></li>
        <li class="nav-item {{ category_nav_active(2) }}"><a href="{{route('categories.show',2)}}" class="nav-link">教程</a></li>
        <li class="nav-item {{ category_nav_active(3) }}"><a href="{{route('categories.show',3)}}" class="nav-link">问答</a></li>
        <li class="nav-item {{ category_nav_active(4) }}"><a href="{{route('categories.show',4)}}" class="nav-link">公告</a></li>
      </ul>
      <!-- Right -->
      <ul class="navbar-nav navbar-right">
        @guest
          <li class="nav-item"><a href="{{route('login')}}" class="nav-link">登录</a></li>
          <li class="nav-item"><a href="{{route('register')}}" class="nav-link">注册</a></li>
        @else
          <li class="nav-item"><a href="{{route('topics.create')}}" class="nav-link mt-1 mr-3 font-weight-bold"><i class="fa fa-plus"></i></a>
          </li>
          <li class="nav-item notification-badge">
            <a href="{{route('notifications.index')}}" class="nav-link mr-3 badge badge-pill badge-{{Auth::user()->notification_count > 0 ? 'hint':'secondary'}} text-white">{{Auth::user()->notification_count}}</a>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="{{Auth::user()->avatar}}" alt="" class="img-responsive img-circle" width="30px" height="30px">
              {{Auth::user()->name}}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              @can('manage_contents')
                <a href="{{url(config('administrator.uri'))}}" class="dropdown-item">
                  <i class="fas fa-tachometer-alt mr-2"></i>
                  管理后台
                </a>
                <div class="dropdown-divider"></div>
              @endcan
              <a href="{{route('users.show',Auth::id())}}" class="dropdown-item">
                <i class="far fa-user mr-2"></i>
              个人中心</a>
              <a href="{{route('users.edit',Auth::id())}}" class="dropdown-item">
                <i class="far fa-edit mr-2"></i>
              编辑资料</a>
              <a href="#" class="dropdown-divider" id="logout">
                <form action="{{route('logout')}}" method="POST" onsubmit="return confirm('您确定要退出吗？');">
                  {{csrf_field()}}
                  <button class="btn btn-block btn-danger" type="submit" name="button">退出</button>
                </form>
              </a>
            </div>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
