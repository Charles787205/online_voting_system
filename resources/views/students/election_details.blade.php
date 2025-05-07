<x-app-layout>
  @section('content')
  <div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-4">{{ $election->name }}</h1>

    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-gray-600 text-lg"><span class="font-semibold">Starts:</span> {{ $election->voting_start }}</p>
          <p class="text-gray-600 text-lg"><span class="font-semibold">Ends:</span> {{ $election->voting_end }}</p>
        </div>
        <div class="bg-blue-100 text-blue-800 rounded-lg px-4 py-2 font-medium">
          Active Election
        </div>
      </div>
    </div>

    {{-- @if(now() >= $election->vote_start_time && now() <= $election->vote_end_time) --}}
    <form action="{{ route('student.vote.submit', $election->id) }}" method="POST" class="mt-6">
      @csrf

      @foreach($election->electionPositions as $position)
      <div class="mb-10">
        <h2 class="text-2xl font-bold mb-4 border-b pb-2">{{ $position->position->name }}</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach($position->nominees as $nominee)
          <div class="relative nominee-card">
            <input type="radio" name="nominee[{{ $position->id }}]" id="nominee_{{ $nominee->id }}"
              value="{{ $nominee->id }}" class="hidden peer nominee-radio">
            <label for="nominee_{{ $nominee->id }}" class="block cursor-pointer">
              <div
                class="bg-white rounded-xl shadow-md overflow-hidden peer-checked:ring-4 peer-checked:ring-blue-500 transition-all duration-200 hover:shadow-lg candidate-card">
                <div class="h-48 overflow-hidden">
                  @if($nominee->image_url)
                  <img src="{{ Storage::url($nominee->image_url) }}" alt="{{ $nominee->student->user->name }}"
                    class="w-full h-full object-cover">
                  @else
                  <div class="w-full h-full flex items-center justify-center bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-400" viewBox="0 0 20 20"
                      fill="currentColor">
                      <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                        clip-rule="evenodd" />
                    </svg>
                  </div>
                  @endif
                </div>
                <div class="p-4">
                  <h3 class="font-bold text-lg mb-1">{{ $nominee->student->user->name }}</h3>
                  <p class="text-gray-600">{{ $nominee->student->course }} - {{ $nominee->student->year }}</p>
                </div>
                <div
                  class="peer-checked:bg-blue-500 bg-gray-100 p-3 peer-checked:text-white text-center font-medium transition-colors duration-200">
                  <span class="peer-checked:hidden">Select Candidate</span>
                  <span class="hidden peer-checked:flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                      fill="currentColor">
                      <path fill-rule="evenodd"
                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                        clip-rule="evenodd" />
                    </svg>
                    Selected
                  </span>
                </div>
                <div class="absolute top-2 right-2 hidden peer-checked:block">
                  <div class="bg-blue-500 text-white rounded-full p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                    </svg>
                  </div>
                </div>
              </div>
            </label>
          </div>
          @endforeach
        </div>
      </div>
      @endforeach

      <div class="mt-8 flex justify-end">
        <button type="submit"
          class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-colors duration-200 flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
              clip-rule="evenodd" />
          </svg>
          Submit Your Vote
        </button>
      </div>
    </form>
    {{-- @else
      <p class="text-red-500 mt-6">Voting is not active at this time.</p>
    @endif --}}
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Get all radio inputs
      const radioButtons = document.querySelectorAll('.nominee-radio');

      // Add event listener to each radio button
      radioButtons.forEach(radio => {
        radio.addEventListener('change', function () {
          // Remove green border from all cards in this position group
          const positionName = this.name;
          const positionGroup = document.querySelectorAll(`input[name="${positionName}"]`);

          positionGroup.forEach(groupRadio => {
            const card = groupRadio.closest('.nominee-card').querySelector('.candidate-card');
            card.classList.remove('ring-4', 'ring-green-500', 'ring-blue-500');
          });

          // Add green border to selected card
          if (this.checked) {
            const selectedCard = this.closest('.nominee-card').querySelector('.candidate-card');
            selectedCard.classList.add('ring-4', 'ring-green-500');
          }
        });
      });

      // Initial check for any pre-selected radios
      radioButtons.forEach(radio => {
        if (radio.checked) {
          const card = radio.closest('.nominee-card').querySelector('.candidate-card');
          card.classList.add('ring-4', 'ring-green-500');
          card.classList.remove('ring-blue-500');
        }
      });
    });
  </script>
</x-app-layout>