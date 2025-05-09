<x-app-layout>
  <div class="container mx-auto">
    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between">
      <div>
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Nominees Management</h1>
        <p class="text-gray-600">View and manage all nominees for elections.</p>
      </div>
      <div class="mt-4 md:mt-0">
        <a href="{{ route('nominees.create') }}"
          class="bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-medium py-2 px-4 rounded-md shadow-sm flex items-center justify-center transition-all duration-200">
          <i class="fas fa-plus mr-2"></i>
          <span>Add Nominee</span>
        </a>
      </div>
    </div>

    <div class="card bg-white rounded-lg overflow-hidden shadow-md">
      <div class="bg-gradient-to-r from-indigo-800 to-blue-700 px-6 py-4 border-b flex justify-between items-center">
        <h2 class="text-xl font-semibold text-white">Nominees Directory</h2>
        <div class="flex items-center space-x-2">
          <span class="bg-indigo-200 text-indigo-800 text-xs font-medium px-2.5 py-1 rounded-full">
            {{ count($nominees) }} Nominees
          </span>
        </div>
      </div>

      <div class="p-6">
        @if(count($nominees) > 0)
        <div class="overflow-x-auto">
          <table class="w-full border-collapse">
            <thead>
              <tr class="bg-gray-50 text-left text-gray-700">
                <th class="px-6 py-3 border-b border-gray-200 font-medium text-sm uppercase tracking-wider">Photo</th>
                <th class="px-6 py-3 border-b border-gray-200 font-medium text-sm uppercase tracking-wider">Student</th>
                <th class="px-6 py-3 border-b border-gray-200 font-medium text-sm uppercase tracking-wider">Position
                </th>
                <th class="px-6 py-3 border-b border-gray-200 font-medium text-sm uppercase tracking-wider text-center">
                  Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              @foreach ($nominees as $nominee)
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div
                      class="flex-shrink-0 h-12 w-12 rounded-full overflow-hidden bg-gray-100 border border-gray-200">
                      <img src="{{ Storage::url($nominee->image_url) }}" alt="Nominee Image"
                        class="h-full w-full object-cover">
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex flex-col">
                    <div class="font-medium text-gray-800">{{ $nominee->student->user->name }}</div>
                    <div class="text-sm text-gray-500">Student ID: {{ $nominee->student->student_id ?? 'N/A' }}</div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="bg-indigo-100 text-indigo-800 text-xs font-medium px-2.5 py-1 rounded-full">
                    {{ $nominee->electionPosition->position->name }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 text-center">
                  <div class="flex items-center justify-center space-x-2">
                    <a href="{{ route('nominees.edit', $nominee) }}"
                      class="bg-amber-50 hover:bg-amber-100 text-amber-700 font-medium py-1.5 px-3 rounded text-sm transition-colors duration-200 inline-flex items-center">
                      <i class="fas fa-edit mr-1.5"></i>
                      Edit
                    </a>
                    <form action="{{ route('nominees.destroy', $nominee) }}" method="POST" class="inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" onclick="return confirm('Are you sure you want to delete this nominee?')"
                        class="bg-red-50 hover:bg-red-100 text-red-700 font-medium py-1.5 px-3 rounded text-sm transition-colors duration-200 inline-flex items-center">
                        <i class="fas fa-trash mr-1.5"></i>
                        Delete
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @else
        <div class="text-center py-8 bg-gray-50 rounded-lg border border-gray-200">
          <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-100 mb-4">
            <i class="fas fa-user-tie text-2xl text-indigo-600"></i>
          </div>
          <h3 class="text-lg font-medium text-gray-900 mb-1">No Nominees Added</h3>
          <p class="text-gray-600 mb-4">There are no nominees registered in the system yet.</p>
          <a href="{{ route('nominees.create') }}"
            class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md shadow-sm inline-flex items-center transition-all duration-200">
            <i class="fas fa-plus mr-2"></i>
            Add First Nominee
          </a>
        </div>
        @endif
      </div>
    </div>
  </div>
</x-app-layout>