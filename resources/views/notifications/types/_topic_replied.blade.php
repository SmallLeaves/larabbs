<li class="media @if(! $loop->last) border-bottom @endif">
  <div class="media-left">
    <a href="{{route('users.show',$notification->data['user_id'])}}">
      <img src="{{$notification->data['user_avatar']}}" alt="{{$notification->data['user_name']}}" class="media-object img-thumbnail mr-3" width="48" height="48">
    </a>
  </div>

  <div class="media-body">
    <div class="media-heading mt-0 mb-1 text-secondary">
      <a href="{{route('users.show',$notification->data['user_id'])}}">{{$notification->data['user_name']}}</a>
      评论了
      <a href="{{$notification->data['topic_link']}}">{{$notification->data['topic_title']}}</a>

      {{--回复删除按钮--}}
      <span class="meta float-right" title="{{$notification->created_at}}">
        <i class="far fa-clock"></i>
        {{$notification->created_at->diffForHumans()}}
      </span>
    </div>
    <div class="reply_content">
      {!! $notification->data['reply_content'] !!}
    </div>
  </div>
</li>
