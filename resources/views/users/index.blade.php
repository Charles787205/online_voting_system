<x-app-layout>
  <div class="container mx-auto bg-grey-lightest">
    <div class="min-h-screen flex flex-col">
      <main class="bg-white-500 flex-1 p-3 overflow-hidden">
        <div class="flex flex-col">
          <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
            <div class="mb-2 border-solid border-grey-light rounded border shadow-sm w-full">
              <div class="bg-gray-300 px-2 py-3 border-solid border-gray-400 border-b">
                Users Table
              </div>
              <div class="p-3">
                <table class="table-fixed w-full mt-4">
                  <thead>
                    <tr>
                      <th class="border w-1/4 px-4 py-2">Name</th>
                      <th class="border w-1/4 px-4 py-2">Email</th>
                      <th class="border w-1/4 px-4 py-2">Type</th>

                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $user)
                    <tr>
                      <td class="border px-4 py-2">{{ $user->name }}</td>
                      <td class="border px-4 py-2">{{ $user->email }}</td>
                      <td class="border px-4 py-2">{{ ucfirst($user->type) }}</td>

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