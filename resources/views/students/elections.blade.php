<x-app-layout>
    @section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Elections</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($elections as $election)
            @if($election->hasVoted)
            <div class="block bg-white shadow-md rounded-lg p-4 opacity-75 cursor-not-allowed">
                <h2 class="text-xl font-semibold">{{ strtoupper($election->name) }}</h2>
                <p class="text-gray-600">Voting Start: {{ $election->formatted_voting_start }}</p>
                <p class="text-gray-600">Voting End: {{ $election->formatted_voting_end }}</p>
                <p class="text-gray-600">{{ $election->description }}</p>
                <div class="mt-2 bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">Already voted</div>
            </div>
            @else
            <a href="{{ url('student/elections/' . $election->id) }}"
                class="block bg-white shadow-md rounded-lg p-4 hover:shadow-lg transition-shadow hover:scale-105">
                <h2 class="text-xl font-semibold">{{ strtoupper($election->name) }}</h2>
                <p class="text-gray-600">Voting Start: {{ $election->formatted_voting_start }}</p>
                <p class="text-gray-600">Voting End: {{ $election->formatted_voting_end }}</p>
                <p class="text-gray-600">{{ $election->description }}</p>
            </a>
            @endif
            @endforeach
        </div>
    </div>
</x-app-layout>