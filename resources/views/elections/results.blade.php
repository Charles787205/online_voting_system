<x-app-layout>
  <div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h1 class="text-2xl font-semibold text-gray-900 mb-6">Election Results: {{ $election->name }}</h1>

      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
        <div class="p-6 bg-white border-b border-gray-200">
          <h2 class="text-lg font-medium text-gray-900 mb-2">Election Information</h2>
          <p><strong>Voting Period:</strong> {{ $election->voting_start->format('M d, Y h:i A') }} -
            {{ $election->voting_end->format('M d, Y h:i A') }}</p>
          <p><strong>Election Period:</strong> {{ $election->election_start->format('M d, Y h:i A') }} -
            {{ $election->election_end->format('M d, Y h:i A') }}</p>
        </div>
      </div>

      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <h2 class="text-lg font-medium text-gray-900 mb-4">Results by Position</h2>

          @forelse($election->positions as $position)
          <div class="mb-8">
            <h3 class="text-xl font-medium text-gray-800 mb-3">{{ $position->name }}</h3>
            <p class="text-sm text-gray-600 mb-4">Available positions: {{ $position->pivot->available_positions }}</p>

            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rank</th>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nominee
                    </th>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Votes</th>
                    <th scope="col"
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  @php
                  $nominees = $position->nominees()
                  ->where('election_id', $election->id)
                  ->withCount('votes')
                  ->orderByDesc('votes_count')
                  ->get();
                  $rank = 1;
                  @endphp

                  @forelse($nominees as $index => $nominee)
                  <tr class="{{ $index < $position->pivot->available_positions ? 'bg-green-50' : '' }}">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      {{ $rank++ }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="ml-4">
                          <div class="text-sm font-medium text-gray-900">
                            {{ $nominee->user->name }}
                          </div>
                          <div class="text-sm text-gray-500">
                            {{ $nominee->user->email }}
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                      {{ $nominee->votes_count }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      @if($index < $position->pivot->available_positions)
                        <span
                          class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                          Elected
                        </span>
                        @else
                        <span
                          class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                          Not Elected
                        </span>
                        @endif
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                      No nominees found for this position.
                    </td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
          @empty
          <p class="text-gray-500">No positions have been added to this election.</p>
          @endforelse
        </div>
      </div>

      <div class="mt-6">
        <a href="{{ route('elections.index') }}"
          class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
          Back to Elections
        </a>
      </div>
    </div>
  </div>
</x-app-layout>