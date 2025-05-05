<x-app-layout>
  <div class="container mx-auto bg-grey-lightest">
    <div class="min-h-screen flex flex-col">
      <main class="bg-white-500 flex-1 p-3 overflow-hidden">
        <div class="flex flex-col">
          <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
            <div class="mb-2 border-solid border-grey-light rounded border shadow-sm w-full">
              <div class="bg-gray-300 px-2 py-3 border-solid border-gray-400 border-b">
                Election Details
              </div>
              <div class="p-3">
                <h2 class="text-lg font-bold">Election Information</h2>
                <p><strong>Election Start:</strong> {{ $election->formatted_date }}</p>
                <p><strong>Election End:</strong> {{ $election->formatted_election_end }}</p>
                <p><strong>Voting Start:</strong> {{ $election->formatted_voting_start }}</p>
                <p><strong>Voting End:</strong> {{ $election->formatted_voting_end }}</p>

                <h3 class="text-lg font-bold mt-4">Election Positions</h3>
                <table class="table-auto w-full border-collapse border border-gray-300">
                  <thead>
                    <tr>
                      <th class="border border-gray-300 px-4 py-2">Position Name</th>
                      <th class="border border-gray-300 px-4 py-2">Available Position</th>
                      <th class="border border-gray-300 px-4 py-2">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($election->positions as $position)
                    <tr>
                      <td class="border border-gray-300 px-4 py-2">{{ $position->name }}</td>
                      <td class="border border-gray-300 px-4 py-2">
                        {{ $position->pivot->available_positions }}
                      </td>
                      <td class="border border-gray-300 px-4 py-2">
                        <form action="{{ route('elections.delete_position', $election) }}" method="POST" class="inline">
                          @csrf
                          @method('DELETE')
                          <input type="hidden" name="delete_position_id" value="{{ $position->id }}">
                          <button type="submit"
                            class="bg-red-500 hover:bg-red-800 text-white font-bold py-2 px-4 rounded">Delete</button>
                        </form>
                        <button data-modal='editPositionModal-{{ $position->id }}'
                          class="modal-trigger bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>

                        <!-- Edit Position Modal -->
                        <div id='editPositionModal-{{ $position->id }}' class="modal-wrapper">
                          <div class="overlay close-modal"></div>
                          <div class="modal modal-centered">
                            <div class="modal-content shadow-lg p-5">
                              <div class="border-b p-2 pb-3 pt-0 mb-4">
                                <div class="flex justify-between items-center">
                                  Edit Position
                                  <span
                                    class='close-modal cursor-pointer px-3 py-1 rounded-full bg-gray-100 hover:bg-gray-200'>
                                    <i class="fas fa-times text-gray-700"></i>
                                  </span>
                                </div>
                              </div>
                              <form action="{{ route('elections.edit_position', $election) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="position_id" value="{{ $position->id }}">
                                <div class="mb-4">
                                  <label for="available_positions"
                                    class="block text-gray-700 text-sm font-bold mb-2">Available Positions</label>
                                  <input type="number" name="available_positions" id="available_positions"
                                    value="{{ $position->pivot->available_positions }}" min="1"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required>
                                </div>
                                <div class="mt-5">
                                  <button type="submit"
                                    class='bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded'>Update</button>
                                  <span
                                    class='close-modal cursor-pointer bg-red-200 hover:bg-red-500 text-red-900 font-bold py-2 px-4 rounded'>Close</span>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>

                <button data-modal='addPositionModal'
                  class="modal-trigger bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">Add
                  Position</button>

                <!-- Add Position Modal -->
                <div id='addPositionModal' class="modal-wrapper">
                  <div class="overlay close-modal"></div>
                  <div class="modal modal-centered">
                    <div class="modal-content shadow-lg p-5">
                      <div class="border-b p-2 pb-3 pt-0 mb-4">
                        <div class="flex justify-between items-center">
                          Add Position
                          <span class='close-modal cursor-pointer px-3 py-1 rounded-full bg-gray-100 hover:bg-gray-200'>
                            <i class="fas fa-times text-gray-700"></i>
                          </span>
                        </div>
                      </div>
                      <form action="{{ route('elections.add_position', $election) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                          <label for="position_id" class="block text-gray-700 text-sm font-bold mb-2">Select
                            Position</label>
                          <select name="position_id" id="position_id"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @foreach ($availablePositions as $position)
                            <option value="{{ $position->id }}">{{ $position->name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="mb-4">
                          <label for="available_positions" class="block text-gray-700 text-sm font-bold mb-2">Available
                            Positions</label>
                          <input type="number" value="1" name="available_positions" id="available_positions" min="1"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                        </div>
                        <div class="mt-5">
                          <button type="submit"
                            class='bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded'>Add</button>
                          <span
                            class='close-modal cursor-pointer bg-red-200 hover:bg-red-500 text-red-900 font-bold py-2 px-4 rounded'>
                            Close
                          </span>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                <a href="{{ route('elections.index') }}"
                  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4 inline-block">Back to
                  Elections</a>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</x-app-layout>