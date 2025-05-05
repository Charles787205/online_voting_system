<x-app-layout>
  <div class="container mx-auto bg-grey-lightest">
    <div class="min-h-screen flex flex-col">
      <main class="bg-white-500 flex-1 p-3 overflow-hidden">
        <div class="flex flex-col">
          <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
            <div class="mb-2 border-solid border-grey-light rounded border shadow-sm w-full">
              <div class="bg-gray-300 px-2 py-3 border-solid border-gray-400 border-b">
                Watchers List
              </div>
              <div class="p-3">
                <div class="mb-4">
                  <a href="{{ route('watchers.create') }}"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add Watcher</a>
                </div>

                <table class="table-auto w-full">
                  <thead>
                    <tr>
                      <th class="px-4 py-2">ID</th>
                      <th class="px-4 py-2">User</th>
                      <th class="px-4 py-2">Election</th>
                      <th class="px-4 py-2">Nominee</th>
                      <th class="px-4 py-2">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($watchers as $watcher)
                    <tr>
                      <td class="border px-4 py-2">{{ $watcher->id }}</td>
                      <td class="border px-4 py-2">{{ $watcher->user->name }}</td>
                      <td class="border px-4 py-2">{{ $watcher->election->name }}</td>
                      <td class="border px-4 py-2">{{ $watcher->nominee->student->user->name }}</td>
                      <td class="border px-4 py-2">
                        <a href="{{ route('watchers.edit', $watcher->id) }}"
                          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Edit</a>
                        <form action="{{ route('watchers.destroy', $watcher->id) }}" method="POST" class="inline">
                          @csrf
                          @method('DELETE')
                          <button type="submit"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                        </form>
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