@extends('layouts.app') {{-- Sesuaikan layout adminmu --}}

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Comments</h2>
    <ul class="space-y-4">
        @forelse($comments as $comment)
            @foreach($comment->pickupLogs as $pickupLog)
                @if($pickupLog->rating && $pickupLog->rating->comments)
                    <li class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center mb-2">
                            <span class="font-semibold text-blue-600">{{ $pickupLog->collection_run?->collector?->name }}</span>
                        </div>
                        <p class="text-gray-700 mb-2">{{ $pickupLog->rating->comments }}</p>
                        <small class="text-gray-400">
                            {{ $pickupLog->created_at ? $pickupLog->created_at->diffForHumans() : '' }}
                        </small>
                    </li>
                @endif
            @endforeach
        @empty
            <li class="bg-gray-100 rounded-lg p-6 text-gray-500 text-center">No comments found.</li>
        @endforelse
    </ul>
</div>
@endsection
