<x-app-layout>
  <div class="container mx-auto bg-grey-lightest">
    <div class="min-h-screen flex flex-col">
      <main class="bg-white-500 flex-1 p-3 overflow-hidden">
        <div class="flex flex-col">
          <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
            <div class="mb-2 border-solid border-grey-light rounded border shadow-sm w-full">
              <div class="bg-gray-300 px-2 py-3 border-solid border-gray-400 border-b">
                Welcome, {{ $user->name }}
              </div>
              <div class="p-3">
                <p class="text-gray-700">This is your student dashboard. Here you can view elections, nominees, and cast
                  your votes.</p>
                <div class="mt-5">
                  <a href="{{ route('elections.index') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View Elections</a>
                  <a href="{{ route('votes.index') }}"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">View Votes</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</x-app-layout>