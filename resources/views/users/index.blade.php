<x-app-layout>
  <div class="container mx-auto">
    <div class="mb-6">
      <h1 class="text-2xl font-bold text-gray-800 mb-2">User Management</h1>
      <p class="text-gray-600">View and manage all registered users in the system.</p>
    </div>

    <div class="card bg-white rounded-lg overflow-hidden shadow-md">
      <div class="bg-gradient-to-r from-indigo-800 to-blue-700 px-6 py-4 border-b flex justify-between items-center">
        <h2 class="text-xl font-semibold text-white">Users Directory</h2>
        <div class="flex items-center space-x-2">
          <span class="bg-indigo-200 text-indigo-800 text-xs font-medium px-2.5 py-1 rounded-full">
            {{ count($users) }} Users
          </span>
        </div>
      </div>

      <div class="p-6">
        @if(count($users) > 0)
        <div class="overflow-x-auto">
          <table class="w-full border-collapse">
            <thead>
              <tr class="bg-gray-50 text-left text-gray-700">
                <th class="px-6 py-3 border-b border-gray-200 font-medium text-sm uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 border-b border-gray-200 font-medium text-sm uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 border-b border-gray-200 font-medium text-sm uppercase tracking-wider">Type</th>
                <th class="px-6 py-3 border-b border-gray-200 font-medium text-sm uppercase tracking-wider">Status</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              @foreach ($users as $user)
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center">
                      <span class="text-indigo-700 font-medium text-sm">{{ substr($user->name, 0, 2) }}</span>
                    </div>
                    <div class="ml-4">
                      <div class="font-medium text-gray-800">{{ $user->name }}</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                  <div class="flex items-center">
                    <i class="fas fa-envelope text-indigo-600 mr-2"></i>
                    <span>{{ $user->email }}</span>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  @if($user->type == 'admin')
                  <span
                    class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Admin</span>
                  @elseif($user->type == 'student')
                  <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Student</span>
                  @elseif($user->type == 'professor')
                  <span
                    class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Professor</span>
                  @else
                  <span
                    class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ ucfirst($user->type) }}</span>
                  @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  @if($user->is_admin)
                  <span class="inline-flex items-center">
                    <span class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></span>
                    <span class="text-sm text-gray-700">Active</span>
                  </span>
                  @else
                  <span class="inline-flex items-center">
                    <span class="h-2.5 w-2.5 rounded-full bg-gray-400 mr-2"></span>
                    <span class="text-sm text-gray-700">Regular</span>
                  </span>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @else
        <div class="text-center py-8 bg-gray-50 rounded-lg border border-gray-200">
          <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-100 mb-4">
            <i class="fas fa-users text-2xl text-indigo-600"></i>
          </div>
          <h3 class="text-lg font-medium text-gray-900 mb-1">No Users Found</h3>
          <p class="text-gray-600">No users have been registered in the system yet.</p>
        </div>
        @endif
      </div>
    </div>
  </div>
</x-app-layout>