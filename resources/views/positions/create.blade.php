<x-app-layout>
  <div class="mx-auto bg-grey-lightest">
    <div class="min-h-screen flex flex-col">
      <main class="bg-white-500 flex-1 p-3 overflow-hidden">
        <div class="flex flex-col">
          <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
            <div class="mb-2 border-solid border-grey-light rounded border shadow-sm w-full">
              <div class="bg-gray-300 px-2 py-3 border-solid border-gray-400 border-b">
                Create Position
              </div>
              <div class="p-3">
                <form action="{{ route('positions.store') }}" method="POST">
                  @csrf
                  <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Position Name</label>
                    <input type="text" name="name" id="name"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                      required>
                  </div>
                  <div class="mb-4">
                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Position
                      Description</label>
                    <textarea name="description" id="description" rows="4"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                  </div>
                  <div class="flex items-center justify-between">
                    <button type="submit"
                      class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create
                      Position</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</x-app-layout>