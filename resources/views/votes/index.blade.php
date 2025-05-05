<x-app-layout>
  <div class="container mx-auto bg-grey-lightest">
    <div class="min-h-screen flex flex-col">
      <main class="bg-white-500 flex-1 p-3 overflow-hidden">
        <div class="flex flex-col">
          <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
            <div class="mb-2 border-solid border-grey-light rounded border shadow-sm w-full">
              <div class="bg-gray-300 px-2 py-3 border-solid border-gray-400 border-b">
                Elections List
              </div>
              <div class="p-3">
                <table class="table-auto w-full">
                  <thead>
                    <tr>
                      <th class="px-4 py-2">ID</th>
                      <th class="px-4 py-2">Election Name</th>
                      <th class="px-4 py-2">Voting Start</th>
                      <th class="px-4 py-2">Voting End</th>
                      <th class="px-4 py-2">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($elections as $election)
                    <tr>
                      <td class="border px-4 py-2">{{ $election->id }}</td>
                      <td class="border px-4 py-2">{{ $election->name }}</td>
                      <td class="border px-4 py-2">{{ $election->voting_start }}</td>
                      <td class="border px-4 py-2">{{ $election->voting_end }}</td>
                      <td class="border px-4 py-2">
                        <a href="{{ route('votes.show', $election->id) }}"
                          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</x-app-layout>