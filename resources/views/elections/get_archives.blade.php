<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Archived Elections') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <h3 class="text-lg font-medium text-gray-900">List of Archived Elections</h3>
          <table class="min-w-full divide-y divide-gray-200 mt-4">
            <thead>
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Name</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Voting Start</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Voting End</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Election Start</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Election End</th>p
              </tr>
            </thead>
            <tbody>
              @forelse ($archivedElections as $election)
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $election->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $election->voting_start }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $election->voting_end }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $election->election_start }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $election->election_end }}</td>
              </tr>
              @empty
              <tr>
                <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">No archived elections found.
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>