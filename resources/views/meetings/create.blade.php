@extends('layouts.app')

@section('content')
    <div class="flex items-center">
        <div class="w-full px-4 md:px-0 md:w-1/2 md:mx-auto">

            @if (session('status'))
                <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <h1 class="text-3xl bold text-center">Create a new meeting</h1>

            <form action="/meetings" method="post">
                @csrf
                <input class="mt-8 text-2xl p-3 w-full" type="text" placeholder="Name / Title" name="name">
                <textarea class="mt-8 text-2xl p-3 w-full" placeholder="Description" rows="5" name="description"></textarea>
                <input class="mt-8 text-2xl p-3 max-w-full" id="start" type="text" placeholder="Start date/time" name="start">
                <input class="mt-8 text-2xl p-3 max-w-full" id="end" type="text" placeholder="End date/time" name="end">
                <input class="mt-8 text-2xl p-3 w-full" type="text" placeholder="Location name" name="location_name">
                <input class="mt-8 text-2xl p-3 w-full" type="text" placeholder="Location address" name="location_address">
                <input class="mt-8 text-2xl p-3 w-full" type="text" placeholder="Location URL" name="location_url">
                <input class="text-2xl p-3 bg-blue-400 text-white my-8 cursor-pointer" type="submit" value="Create meeting">
            </form>
        </div>
    </div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.3/flatpickr.min.css" integrity="sha256-Zh4AVwxlwpUo2c5u4Z5emTmYZxbCk972ewf4tqGRsBg=" crossorigin="anonymous" />
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.3/flatpickr.js" integrity="sha256-3soYYYidbbsrmHXTGgxeCdgMfgt6IqWjWPKfuDWduqM=" crossorigin="anonymous"></script>
<script>
    var options = {
        altInput: true,
        enableTime: true,
        dateTimeFormat: 'Y-m-d H:i:S',
        altFormat: 'Y-m-d H:i:S',
    };

    flatpickr('#start', options);
    flatpickr('#end', options);
</script>
@endsection
