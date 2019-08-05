@extends('layouts.app')
@section('title',$user->name)
@section('content')
<div class="container">
  <div class="col-md-8 offset-md-2">

    <div class="card">
      <div class="card-header">
        <h4><i class="glyphicon glyphicon-edit">编辑个人资料</i></h4>
      </div>

      <div class="card-body">
        @include('shared._errors')
        <form action="{{route('users.update',$user->id)}}" method="POST" accept-charset="UTF-8">

          <input type="hidden" name="_method" value="PUT">
          {{csrf_field()}}

          <div class="form-group">
            <label for="name-field">用户名</label>
            <input type="text" name="name" id="name-field" class="form-control" value="{{old('name',$user->name)}}">
          </div>

          <div class="form-group">
            <label for="email-field">邮箱</label>
            <input type="text" class="form-control" name="email" id="email-field" value="{{old('email',$user->email)}}">
          </div>

          <div class="form-group">
            <label for="introduction-field">个人简介</label>
            <input type="text" class="form-control" name="introduction" id="introduction-field" value="{{old('introduction',$user->introduction)}}">
          </div>

          <div class="well well-sm">
            <button class="btn btn-primary" type="submit">保存</button>
          </div>

        </form>
      </div>
    </div>

  </div>
</div>
@stop
