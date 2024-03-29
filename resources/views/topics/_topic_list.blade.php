@if(count($topics) > 0)
  <ul class="list-unstyled">
    @foreach($topics as $topic)
      <li class="media">
        <div class="media-left">
          <a href="{{route('users.show',$topic->user_id)}}">
            <img class="media-object img-thumbnial mr-3" style="height: 52px;width: 52px;" src="{{$topic->user->avatar}}" title="{{$topic->user->name}}">
          </a>
        </div>

        <div class="media-body mt-0 mb-1">
          <div class="media-heading">
            <a href="{{ $topic->link() }}" title="{{$topic->title}}">
              {{$topic->title}}
            </a>
            <a class="float-right" href="{{ $topic->link() }}">
              <span class="badge badge-secondary badge-pill">
                {{$topic->reply_count}}
              </span>
            </a>
          </div>

          <small class="media-body meta text-secondary">
            <a href="{{route('categories.show',$topic->category_id)}}" class="text-secondary" title="{{$topic->category->name}}">
              <i class="far fa-folder"></i>
              {{$topic->category->name}}
            </a>
            <span>•</span>
            <a class="text-secondary" href="{{route('users.show',$topic->user_id)}}" title="{{$topic->user->name}}"><i class="far fa-user"></i> {{$topic->user->name}}</a>
            <span>•</span>
            <i class="far fa-clock"></i>
            <span title="最后活跃于：{{$topic->updated_at}}">{{$topic->updated_at->diffForHumans()}}</span>
          </small>
        </div>
      </li>

      @if(! $loop->last)
        <hr>
      @endif
    @endforeach
  </ul>
@else
<div class="empty-block">暂无数据</div>
@endif
