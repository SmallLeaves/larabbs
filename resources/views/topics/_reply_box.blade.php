@include('shared._errors')

<div class="reply_box mb-4">
  <form action="{{route('replies.store')}}" method="POST">
    {{csrf_field()}}
    <input type="hidden" name="topic_id" value="{{$topic->id}}">
    <div class="form-group">
      <textarea name="content" rows="3" class="form-control"></textarea>
    </div>
    <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-share mr-1"></i> 回复</button>
  </form>
</div>
