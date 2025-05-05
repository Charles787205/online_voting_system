<x-app-layout>
  <div class="container mx-auto bg-grey-lightest">
    <div class="min-h-screen flex flex-col">
      <main class="bg-white-500 flex-1 p-3 overflow-hidden">
        <div class="flex flex-col">
          <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
            <div class="mb-2 border-solid border-grey-light rounded border shadow-sm w-full">
              <div class="bg-gray-300 px-2 py-3 border-solid border-gray-400 border-b">
                Election Results
              </div>
              <div class="p-3">
                @foreach ($election->electionPositions as $position)
                <h2 class="text-lg font-bold">{{ $position->position->name}}</h2>
                <table class="table-auto w-full mb-4">

                  <tbody>
                    @foreach ($position->nominees as $nominee)
                    <tr>
                      <td class="border px-4 py-2">{{ $nominee->student->user->name }}</td>
                      <td class="border px-4 py-2">{{ $nominee->votes->count()}}</td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</x-app-layout>