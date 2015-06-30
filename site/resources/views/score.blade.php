@extends('app') 
@section('content')
      @include ('layouts.user_nav')
  @foreach ($scores as $score)
    {{$score->ScoreDetails->reason}}
  @endforeach
@endsection
