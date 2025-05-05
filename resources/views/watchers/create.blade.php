<x-app-layout>
  <div class="container mx-auto bg-grey-lightest">
    <div class="min-h-screen flex flex-col">
      <main class="bg-white-500 flex-1 p-3 overflow-hidden">
        <div class="flex flex-col">
          <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
            <div class="mb-2 border-solid border-grey-light rounded border shadow-sm w-full">
              <div class="bg-gray-300 px-2 py-3 border-solid border-gray-400 border-b">
                Add Watcher
              </div>
              <div class="p-3">
                <form action="{{ route('watchers.store') }}" method="POST">
                  @csrf
                  <div class="mb-4">
                    <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">Select User</label>
                    <select name="user_id" id="user_id"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                      @foreach ($users as $user)
                      <option value="{{ $user->id }}">{{ $user->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="mb-4">
                    <label for="election_id" class="block text-gray-700 text-sm font-bold mb-2">Select Election</label>
                    <select name="election_id" id="election_id"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                      @foreach ($elections as $election)
                      <option value="{{ $election->id }}">{{ $election->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="mb-4">
                    <label for="nominee_id" class="block text-gray-700 text-sm font-bold mb-2">Select Nominee</label>
                    <select name="nominee_id" id="nominee_id"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                      @foreach ($nominees as $nominee)
                      <option value="{{ $nominee->id }}">{{ $nominee->student->user->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="mt-5">
                    <button type="submit"
                      class="bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded">Add
                      Watcher</button>
                    <a href="{{ route('watchers.index') }}"
                      class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</a>
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