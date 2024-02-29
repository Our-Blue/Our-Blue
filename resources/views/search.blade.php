@extends('layouts.app')

@section('content')
<h2><p class="tabi_top">検索結果</p></h2>

@if(count($projects) > 0)
 <h3>Project情報</h3>
    @foreach($projects as $project)
    {{ $project->title }}
    {{ $project->status }}
    @endforeach
@endif  


@endsection