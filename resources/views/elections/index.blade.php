<x-app-layout>
  <div class="container mx-auto">
    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between">
      <div>
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Elections Management</h1>
        <p class="text-gray-600">Manage, create, and monitor all election events.</p>
      </div>
      <div class="mt-4 md:mt-0">
        <a href="{{ route('elections.create') }}"
          class="bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-medium py-2 px-4 rounded-md shadow-sm flex items-center justify-center transition-all duration-200">
          <i class="fas fa-plus mr-2"></i>
          <span>Add Election</span>
        </a>
      </div>
    </div>

    <div class="card bg-white rounded-lg overflow-hidden shadow-md">
      <div class="bg-gradient-to-r from-indigo-800 to-blue-700 px-6 py-4 border-b">
        <h2 class="text-xl font-semibold text-white">Elections Overview</h2>
      </div>

      <div class="p-6">
        @if(count($elections) > 0)
        <div class="overflow-x-auto">
          <table class="w-full border-collapse">
            <thead>
              <tr class="bg-gray-50 text-left text-gray-700">
                <th class="px-6 py-3 border-b border-gray-200 font-medium text-sm uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 border-b border-gray-200 font-medium text-sm uppercase tracking-wider">Election
                  Start</th>
                <th class="px-6 py-3 border-b border-gray-200 font-medium text-sm uppercase tracking-wider">Election End
                </th>
                <th class="px-6 py-3 border-b border-gray-200 font-medium text-sm uppercase tracking-wider">Voting Start
                </th>
                <th class="px-6 py-3 border-b border-gray-200 font-medium text-sm uppercase tracking-wider">Voting End
                </th>
                <th class="px-6 py-3 border-b border-gray-200 font-medium text-sm uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 border-b border-gray-200 font-medium text-sm uppercase tracking-wider text-center">
                  Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              @foreach ($elections as $election)
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="font-medium text-gray-800">{{ $election->name }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $election->formatted_election_start }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $election->formatted_election_end }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $election->formatted_voting_start }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $election->formatted_voting_end }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                  @php
                  $now = \Carbon\Carbon::now();
                  $votingStart = \Carbon\Carbon::parse($election->voting_start);
                  $votingEnd = \Carbon\Carbon::parse($election->voting_end);
                  $isActive = $now->between($votingStart, $votingEnd);
                  @endphp

                  @if($isActive)
                  <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Active</span>
                  @else
                  @if($now->lt($votingStart))
                  <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Upcoming</span>
                  @else
                  <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Ended</span>
                  @endif
                  @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 text-center">
                  <div class="flex items-center justify-center space-x-2">
                    <a href="{{ route('elections.show', $election) }}"
                      class="bg-indigo-50 hover:bg-indigo-100 text-indigo-700 font-medium py-1.5 px-3 rounded text-sm transition-colors duration-200 inline-flex items-center">
                      <i class="fas fa-eye mr-1.5"></i>
                      View
                    </a>
                    <form action="{{ route('elections.destroy', $election) }}" method="POST" class="inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" onclick="return confirm('Are you sure you want to delete this election?')"
                        class="bg-red-50 hover:bg-red-100 text-red-700 font-medium py-1.5 px-3 rounded text-sm transition-colors duration-200 inline-flex items-center">
                        <i class="fas fa-trash mr-1.5"></i>
                        Delete
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @else
        <div class="text-center py-8 bg-gray-50 rounded-lg border border-gray-200">
          <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-100 mb-4">
            <i class="fas fa-vote-yea text-2xl text-indigo-600"></i>
          </div>
          <h3 class="text-lg font-medium text-gray-900 mb-1">No Elections Available</h3>
          <p class="text-gray-600 mb-4">No elections have been created yet.</p>
          <a href="{{ route('elections.create') }}"
            class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md shadow-sm inline-flex items-center transition-all duration-200">
            <i class="fas fa-plus mr-2"></i>
            Create First Election
          </a>
        </div>
        @endif
      </div>

      @if(isset($selectedElection))
      <div class="border-t border-gray-200 p-6">
        <div class="bg-indigo-50 border-l-4 border-indigo-500 p-4 rounded-r">
          <h2 class="text-lg font-bold text-gray-800 mb-3">Election Details</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex items-center">
              <i class="fas fa-calendar-alt text-indigo-600 mr-2"></i>
              <span class="font-medium text-gray-700 mr-2">Election Start:</span>
              <span>{{ $selectedElection->election_start }}</span>
            </div>
            <div class="flex items-center">
              <i class="fas fa-calendar-check text-indigo-600 mr-2"></i>
              <span class="font-medium text-gray-700 mr-2">Election End:</span>
              <span>{{ $selectedElection->election_end }}</span>
            </div>
            <div class="flex items-center">
              <i class="fas fa-vote-yea text-indigo-600 mr-2"></i>
              <span class="font-medium text-gray-700 mr-2">Voting Start:</span>
              <span>{{ $selectedElection->voting_start }}</span>
            </div>
            <div class="flex items-center">
              <i class="fas fa-poll-h text-indigo-600 mr-2"></i>
              <span class="font-medium text-gray-700 mr-2">Voting End:</span>
              <span>{{ $selectedElection->voting_end }}</span>
            </div>
          </div>

          <h3 class="text-lg font-bold text-gray-800 mt-6 mb-3">Election Positions</h3>
          <ul class="grid grid-cols-1 md:grid-cols-3 gap-2">
            @foreach ($selectedElection->positions as $position)
            <li class="bg-white border border-gray-200 rounded px-3 py-2 flex items-center">
              <i class="fas fa-user-tie text-indigo-600 mr-2"></i>
              <span>{{ $position->name }}</span>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
      @endif
    </div>
  </div>
</x-app-layout>