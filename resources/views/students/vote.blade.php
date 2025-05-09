<x-app-layout>
  <div class="container mx-auto">
    <div class="mb-6">
      <h1 class="text-2xl font-bold text-gray-800 mb-2">Cast Your Vote</h1>
      <p class="text-gray-600">Select your preferred candidate from the options below.</p>
    </div>

    <div class="card bg-white rounded-lg overflow-hidden shadow-md">
      <div class="bg-gradient-to-r from-indigo-800 to-blue-700 px-6 py-4 border-b">
        <h2 class="text-xl font-semibold text-white">Voting Form</h2>
      </div>

      <div class="p-6">
        @if(count($elections) == 0)
        <div class="text-center py-8 bg-gray-50 rounded-lg border border-gray-200">
          <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-100 mb-4">
            <i class="fas fa-ballot-check text-2xl text-indigo-600"></i>
          </div>
          <h3 class="text-lg font-medium text-gray-900 mb-1">No Active Elections</h3>
          <p class="text-gray-600">There are no active elections available for voting at this time.</p>
        </div>
        @else
        <form action="{{ route('student.vote') }}" method="POST" class="space-y-6">
          @csrf

          <div class="bg-indigo-50 rounded-lg p-4 border border-indigo-100">
            <div class="mb-4">
              <label for="election_id" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-vote-yea text-indigo-600 mr-2"></i>
                Select Election
              </label>
              <select name="election_id" id="election_id" onchange="updateNominees()"
                class="mt-1 block w-full pl-3 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm">
                <option value="">-- Select an Election --</option>
                @foreach ($elections as $election)
                <option value="{{ $election->id }}">{{ $election->name }}</option>
                @endforeach
              </select>
              <p class="mt-2 text-sm text-gray-500">Choose the election you want to participate in</p>
            </div>

            <div class="relative">
              <div class="absolute inset-0 flex items-center" aria-hidden="true">
                <div class="w-full border-t border-gray-300"></div>
              </div>
              <div class="relative flex justify-center">
                <span class="bg-indigo-50 px-2 text-sm text-gray-500">Select Your Candidate</span>
              </div>
            </div>

            <div class="mt-6">
              <label for="nominee_id" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-user-tie text-indigo-600 mr-2"></i>
                Select Nominee
              </label>
              <select name="nominee_id" id="nominee_id"
                class="mt-1 block w-full pl-3 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm">
                <option value="">-- First Select an Election --</option>
                @foreach ($elections as $election)
                @foreach ($election->positions as $position)
                @foreach ($position->nominees as $nominee)
                <option value="{{ $nominee->id }}" data-election="{{ $election->id }}"
                  data-position="{{ $position->name }}" class="nominee-option">
                  {{ $nominee->name }} ({{ $position->name }})
                </option>
                @endforeach
                @endforeach
                @endforeach
              </select>
              <p class="mt-2 text-sm text-gray-500">Choose your preferred candidate</p>
            </div>
          </div>

          <div class="pt-4 border-t border-gray-200 flex justify-end">
            <button type="submit"
              class="bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-medium py-2 px-4 rounded-md shadow-sm flex items-center justify-center transition-all duration-200">
              <i class="fas fa-check-circle mr-2"></i>
              <span>Submit Vote</span>
            </button>
          </div>
        </form>

        <script>
          function updateNominees() {
            const electionSelect = document.getElementById('election_id');
            const nomineeSelect = document.getElementById('nominee_id');
            const selectedElection = electionSelect.value;

            // Clear current options
            nomineeSelect.innerHTML = '';

            if (!selectedElection) {
              const option = document.createElement('option');
              option.value = '';
              option.textContent = '-- First Select an Election --';
              nomineeSelect.appendChild(option);
              return;
            }

            // Group nominees by position
            const nominees = document.querySelectorAll('.nominee-option');
            const positions = new Map();

            nominees.forEach(nominee => {
              if (nominee.dataset.election === selectedElection) {
                const position = nominee.dataset.position;
                if (!positions.has(position)) {
                  positions.set(position, []);
                }
                positions.get(position).push(nominee);
              }
            });

            // Add position groups and nominees
            if (positions.size === 0) {
              const option = document.createElement('option');
              option.value = '';
              option.textContent = 'No nominees available for this election';
              nomineeSelect.appendChild(option);
            } else {
              positions.forEach((nominees, position) => {
                const group = document.createElement('optgroup');
                group.label = position;

                nominees.forEach(nominee => {
                  const option = document.createElement('option');
                  option.value = nominee.value;
                  option.textContent = nominee.textContent;
                  group.appendChild(option);
                });

                nomineeSelect.appendChild(group);
              });
            }
          }

          // Initialize on page load
          document.addEventListener('DOMContentLoaded', function () {
            const electionSelect = document.getElementById('election_id');
            if (electionSelect.value) {
              updateNominees();
            }
          });
        </script>
        @endif
      </div>
    </div>
  </div>
</x-app-layout>