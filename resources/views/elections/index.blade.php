<x-app-layout>
  <div class="container mx-auto bg-grey-lightest">
    <div class="min-h-screen flex flex-col">
      <main class="bg-white-500 flex-1 p-3 overflow-hidden">
        <div class="flex flex-col">
          <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
            <div class="mb-2 border-solid flex flex-col border-grey-light rounded border shadow-sm w-full">
              <div class="bg-gray-300 px-2 py-3 border-solid border-gray-400 border-b">
                Elections Table
              </div>
              <a href="{{ route('elections.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-5 mx-3 max-w-[150px]">Add
                Election</a>
              <div class="p-3">
                <table class="table-auto w-full border-collapse border border-gray-300">
                  <thead>
                    <tr>
                      <th class="border border-gray-300 px-4 py-2">Name</th>
                      <th class="border border-gray-300 px-4 py-2">Election Start</th>
                      <th class="border border-gray-300 px-4 py-2">Election End</th>
                      <th class="border border-gray-300 px-4 py-2">Voting Start</th>
                      <th class="border border-gray-300 px-4 py-2">Voting End</th>
                      <th class="border border-gray-300 px-4 py-2">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($elections as $election)
                    <tr>
                      <td class="border border-gray-300 px-4 py-2">{{ $election->name }}</td>
                      <td class="border border-gray-300 px-4 py-2">{{ $election->formatted_date }}</td>
                      <td class="border border-gray-300 px-4 py-2">{{ $election->formatted_election_end }}</td>
                      <td class="border border-gray-300 px-4 py-2">{{ $election->formatted_voting_start }}</td>
                      <td class="border border-gray-300 px-4 py-2">{{ $election->formatted_voting_end }}</td>
                      <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('elections.show', $election) }}"
                          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View</a>
                        <a href="{{ route('elections.edit', $election) }}"
                          class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                        <form action="{{ route('elections.destroy', $election) }}" method="POST" class="inline">
                          @csrf
                          @method('DELETE')
                          <button type="submit"
                            class="bg-red-500 hover:bg-red-800 text-white font-bold py-2 px-4 rounded">Delete</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

              <div class="p-3">
                @if(isset($selectedElection))
                <h2 class="text-lg font-bold">Election Details</h2>
                <p><strong>Election Start:</strong> {{ $selectedElection->election_start }}</p>
                <p><strong>Election End:</strong> {{ $selectedElection->election_end }}</p>
                <p><strong>Voting Start:</strong> {{ $selectedElection->voting_start }}</p>
                <p><strong>Voting End:</strong> {{ $selectedElection->voting_end }}</p>

                <h3 class="text-lg font-bold mt-4">Election Positions</h3>
                <ul>
                  @foreach ($selectedElection->positions as $position)
                  <li>{{ $position->name }}</li>
                  @endforeach
                </ul>
                @endif
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</x-app-layout>