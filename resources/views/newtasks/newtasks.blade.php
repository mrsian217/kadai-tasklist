@extends('layouts.app')

@section('content')

 <div class="prose ml-4">
        <h2>タスク 一覧</h2>
    </div>

    @if (isset($newasks))
        <table class="table table-zebra w-full my-4">
            <thead>
                <tr>
                    <th>id</th>
                    <th>タスク</th>
                    <th>状態</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($newtasks as $newtask)
                <tr>
                    <td><a class="link link-hover text-info" href="{{route("newtasks.show",$task->id)}}">{{ $newtask->id }}</a></td>
                    <td>{!! nl2br(e($newtask->content))!!}</td>
                    <td>{!! nl2br(e($newtask->status))!!}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
           <a class="btn btn-primary" href="{{ route('newtasks.create') }}">新規タスクの投稿</a>
@endsection
