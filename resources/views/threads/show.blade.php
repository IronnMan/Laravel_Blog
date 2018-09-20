@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="#">{{ $thread->creator->name }}</a> 发表了：
                        {{ $thread->title }}
                    </div>

                    <div class="panel-body">
                        {{ $thread->body }}
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @foreach($thread->replies as $reply)
                    @include('threads._reply')
                @endforeach
            </div>
        </div>

        @if (auth()->check())  {{-- 已登陆用户才可见 --}}
            <div class="col-md-8 col-md-offset-2" style="padding-left: 5px;padding-right: 5px;">
                <form action="{{ $thread->path() . '/replies' }}" method="post">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <textarea name="body" id="body" class="form-control" placeholder="说点什么吧..." rows="5"></textarea>
                    </div>

                    <button type="submit" class="btn btn-default pull-right">提交</button>
                </form>
            </div>
        @else
            <p class="text-center">请先<a href="{{ route('login') }}">登陆</a>，然后再发表回复 </p>
        @endif

    </div>

@endsection