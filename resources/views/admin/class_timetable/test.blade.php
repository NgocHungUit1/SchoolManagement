@extends('layouts.app')
@section('content')
    <div id="calendar"></div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    @endpush
@endsection
