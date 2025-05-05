<x-app-layout>
  @section('content')
  <div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">{{ $election->name }}</h1>
    <p class="text-gray-600">Vote Start Time: {{ $election->voting_start }}</p>
    <p class="text-gray-600">Vote End Time: {{ $election->voting_end }}</p>

    {{-- @if(now() >= $election->vote_start_time && now() <= $election->vote_end_time) --}}
    <form action="{{ route('student.vote.submit', $election->id) }}" method="POST" class="mt-6">
      @csrf
      @foreach($election->electionPositions as $position)
      <div class="mb-4">
        <label for="position_{{ $position->id }}"
          class="block text-gray-700 font-bold mb-2">{{ $position->position->name }}</label>
        <select name="nominee[{{ $position->id }}]" id="position_{{ $position->id }}"
          class="w-full border-gray-300 rounded">
          <option value="">Select a nominee</option>
          @foreach($position->nominees as $nominee)
          <option value="{{ $nominee->id }}">{{ $nominee->student->user->name }}</option>
          @endforeach
        </select>
      </div>
      @endforeach
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit Vote</button>
    </form>
    {{-- @else
      <p class="text-red-500 mt-6">Voting is not active at this time.</p>
    @endif --}}
  </div>
</x-app-layout>