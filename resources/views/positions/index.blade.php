<x-app-layout>
  <div class="container mx-auto">
    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between">
      <div>
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Positions Management</h1>
        <p class="text-gray-600">Manage all available positions for election nominations.</p>
      </div>
      <div class="mt-4 md:mt-0">
        <a href="{{ route('positions.create') }}"
          class="bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-medium py-2 px-4 rounded-md shadow-sm flex items-center justify-center transition-all duration-200">
          <i class="fas fa-plus mr-2"></i>
          <span>Add Position</span>
        </a>
      </div>
    </div>

    <div class="card bg-white rounded-lg overflow-hidden shadow-md">
      <div class="bg-gradient-to-r from-indigo-800 to-blue-700 px-6 py-4 border-b flex justify-between items-center">
        <h2 class="text-xl font-semibold text-white">Positions Directory</h2>
        <div class="flex items-center space-x-2">
          <span class="bg-indigo-200 text-indigo-800 text-xs font-medium px-2.5 py-1 rounded-full">
            {{ count($positions) }} Positions
          </span>
        </div>
      </div>

      <div class="p-6">
        @if(count($positions) > 0)
        <div class="overflow-x-auto">
          <table class="w-full border-collapse">
            <thead>
              <tr class="bg-gray-50 text-left text-gray-700">
                <th class="px-6 py-3 border-b border-gray-200 font-medium text-sm uppercase tracking-wider">Position
                </th>
                <th class="px-6 py-3 border-b border-gray-200 font-medium text-sm uppercase tracking-wider">Description
                </th>
                <th class="px-6 py-3 border-b border-gray-200 font-medium text-sm uppercase tracking-wider text-center">
                  Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              @foreach ($positions as $position)
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div
                      class="flex-shrink-0 h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                      <i class="fas fa-briefcase text-indigo-600"></i>
                    </div>
                    <div class="font-medium text-gray-800">{{ $position->name }}</div>
                  </div>
                </td>
                <td class="px-6 py-4">
                  <div class="text-sm text-gray-600 line-clamp-2">
                    {{ $position->description ?: 'No description available' }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 text-center">
                  <form action="{{ route('positions.destroy', $position) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this position?')"
                      class="bg-red-50 hover:bg-red-100 text-red-700 font-medium py-1.5 px-3 rounded text-sm transition-colors duration-200 inline-flex items-center">
                      <i class="fas fa-trash mr-1.5"></i>
                      Delete
                    </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @else
        <div class="text-center py-8 bg-gray-50 rounded-lg border border-gray-200">
          <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-100 mb-4">
            <i class="fas fa-briefcase text-2xl text-indigo-600"></i>
          </div>
          <h3 class="text-lg font-medium text-gray-900 mb-1">No Positions Added</h3>
          <p class="text-gray-600 mb-4">There are no positions created in the system yet.</p>
          <a href="{{ route('positions.create') }}"
            class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md shadow-sm inline-flex items-center transition-all duration-200">
            <i class="fas fa-plus mr-2"></i>
            Add First Position
          </a>
        </div>
        @endif
      </div>
    </div>
  </div>
</x-app-layout>