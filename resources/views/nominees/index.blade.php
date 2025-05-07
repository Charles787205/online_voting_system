<x-app-layout>
  <div class="container mx-auto bg-grey-lightest">
    <div class="min-h-screen flex flex-col">
      <main class="bg-white-500 flex-1 p-3 overflow-hidden">
        <div class="flex flex-col">
          <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
            <div class="mb-2 border-solid border-grey-light rounded border shadow-sm w-full">
              <div class="bg-gray-300 px-2 py-3 border-solid border-gray-400 border-b">
                Nominees Table
              </div>
              <div class="p-3">
                <a href="{{ route('nominees.create') }}"
                  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Nominee</a>
                <table class="table-fixed w-full mt-4">
                  <thead>
                    <tr>
                      <th class="border w-1/6 px-4 py-2">Image</th>
                      <th class="border w-1/3 px-4 py-2">Student</th>
                      <th class="border w-1/3 px-4 py-2">Position</th>
                      <th class="border w-1/3 px-4 py-2">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($nominees as $nominee)
                    <tr>
                      <td class="border px-4 py-2">
                        <img src="{{ Storage::url($nominee->image_url) }}" alt="Nominee Image"
                          class="w-10 h-10 rounded-full">
                      </td>
                      <td class="border px-4 py-2">{{ $nominee->student->user->name }}</td>
                      <td class="border px-4 py-2">{{ $nominee->electionPosition->position->name }}</td>
                      <td class="border px-4 py-2">
                        <a href="{{ route('nominees.edit', $nominee) }}"
                          class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Edit</a>
                        <form action="{{ route('nominees.destroy', $nominee) }}" method="POST"
                          style="display:inline-block;">
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