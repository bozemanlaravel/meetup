@extends('layouts.app')

@section('content')
    <div class="flex items-center">
        <div class="w-full px-3 md:w-1/2 md:mx-auto">

            @if (session('status'))
                <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @foreach ($meetings as $mt)
            <div class="break-words bg-white border border-2 rounded shadow-md p-6
            @if(!$loop->first)
            mt-8
            @endif">
                <p class="text-gray-600 text-lg">{{ sql_date_to_format($mt->start, 'l, F jS, Y \\a\\t g:i a') }}</p>
                <h2 class="text-gray-700 text-xl mt-4">
                    {{ $mt->name }}
                </h2>
                <p class="text-gray-700 mt-4 text-lg">
                    {{ $mt->description }}
                </p>
            </div>
            @endforeach
        </div>
    </div>
@endsection
