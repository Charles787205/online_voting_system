<x-app-layout>
    <div class="container mx-auto px-4">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Available Elections</h1>
            <p class="text-gray-600">View and participate in ongoing elections.</p>
        </div>

        @if(count($elections) == 0)
        <div class="bg-white rounded-lg p-6 text-center border-2 border-dashed border-gray-300">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-100 mb-4">
                <i class="fas fa-ballot-check text-2xl text-indigo-600"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-1">No Elections Available</h3>
            <p class="text-gray-600">There are no active elections available at this time.</p>
        </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($elections as $election)
            @if($election->hasVoted)
            <div class="card bg-white rounded-lg overflow-hidden shadow-md border border-gray-200">
                <div class="bg-gradient-to-r from-gray-700 to-gray-600 px-4 py-4 border-b">
                    <h2 class="text-xl font-semibold text-white">{{ strtoupper($election->name) }}</h2>
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mt-2">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Already voted
                    </span>
                </div>
                <div class="p-4">
                    <div class="mb-4">
                        <div class="flex items-center text-gray-600 mb-2">
                            <i class="fas fa-calendar-alt text-indigo-600 mr-2"></i>
                            <span>Voting Start: {{ $election->formatted_voting_start }}</span>
                        </div>
                        <div class="flex items-center text-gray-600 mb-2">
                            <i class="fas fa-calendar-check text-indigo-600 mr-2"></i>
                            <span>Voting End: {{ $election->formatted_voting_end }}</span>
                        </div>
                        <div class="mt-3 text-gray-600">{{ $election->description }}</div>
                    </div>
                    <div class="mt-4 flex justify-center">
                        <span
                            class="px-4 py-2 bg-gray-200 text-gray-600 rounded-md cursor-not-allowed w-full text-center">
                            Already Voted
                        </span>
                    </div>
                </div>
            </div>
            @else
            <div class="card bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-all duration-300">
                <div class="bg-gradient-to-r from-indigo-800 to-blue-700 px-4 py-4 border-b">
                    <h2 class="text-xl font-semibold text-white">{{ strtoupper($election->name) }}</h2>
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 mt-2">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Available
                    </span>
                </div>
                <div class="p-4">
                    <div class="mb-4">
                        <div class="flex items-center text-gray-600 mb-2">
                            <i class="fas fa-calendar-alt text-indigo-600 mr-2"></i>
                            <span>Voting Start: {{ $election->formatted_voting_start }}</span>
                        </div>
                        <div class="flex items-center text-gray-600 mb-2">
                            <i class="fas fa-calendar-check text-indigo-600 mr-2"></i>
                            <span>Voting End: {{ $election->formatted_voting_end }}</span>
                        </div>
                        <div class="mt-3 text-gray-600">{{ $election->description }}</div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ url('student/elections/' . $election->id) }}"
                            class="block w-full px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-center rounded-md transition duration-300 ease-in-out">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
        @endif
    </div>
</x-app-layout>