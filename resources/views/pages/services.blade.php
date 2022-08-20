@extends('layouts.app')

@section('content')
        <h1>{{$title}}</h1> <!-- This comes from an associative array in controllers -->

        @if(count($services) > 0)
            <ul>
                @foreach ($services as $service)
                    <li class="list-group-item">{{$service}}</li>
                @endforeach
            </ul>
        @endif
@endsection
