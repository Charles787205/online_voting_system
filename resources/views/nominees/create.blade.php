<x-app-layout>
  <div class="container mx-auto bg-grey-lightest">
    <div class="min-h-screen flex flex-col">
      <main class="bg-white-500 flex-1 p-3 overflow-hidden">
        <div class="flex flex-col">
          <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
            <div class="mb-2 border-solid border-grey-light rounded border shadow-sm w-full">
              <div class="bg-gray-300 px-2 py-3 border-solid border-gray-400 border-b">
                Add Nominee
              </div>
              <div class="p-3">
                <form action="{{ route('nominees.store') }}" method="POST">
                  @csrf
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
                    <label for="student_id" class="block text-gray-700 text-sm font-bold mb-2">Select Student</label>
                    <select name="student_id" id="student_id"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                      @foreach ($students as $student)
                      <option value="{{ $student->id_number }}">{{ $student->user->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="mb-4">
                    <label for="position_id" class="block text-gray-700 text-sm font-bold mb-2">Select Position</label>
                    <select name="position_id" id="position_id"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                      <option value="">Select Position</option>
                    </select>
                  </div>
                  <div class="mt-5">
                    <button type="submit"
                      class="bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded">Add
                      Nominee</button>
                    <a href="{{ route('nominees.index') }}"
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
  <script>
    const elections = @json($elections);

    document.addEventListener('DOMContentLoaded', function () {
      const electionSelect = document.getElementById('election_id');
      const positionSelect = document.getElementById('position_id');
      console.log(elections);
      // Pre-select the first election and its positions
      if (elections.length > 0) {
        const firstElection = elections[0];
        electionSelect.value = firstElection.id;

        // Populate positions for the first election
        positionSelect.innerHTML = '<option value="">Select Position</option>';
        firstElection.positions.forEach(position => {
          const option = document.createElement('option');
          option.value = position.id;
          option.textContent = position.name;
          positionSelect.appendChild(option);
        });
      }

      electionSelect.addEventListener('change', function () {
        const selectedElectionId = this.value;

        // Clear the position select options
        positionSelect.innerHTML = '<option value="">Select Position</option>';

        // Fetch positions for the selected election
        const selectedElection = elections.find(election => election.id == selectedElectionId);

        if (selectedElection) {
          selectedElection.positions.forEach(position => {
            const option = document.createElement('option');
            option.value = position.id;
            option.textContent = position.name;
            positionSelect.appendChild(option);
          });
        }
      });
    });
  </script>
</x-app-layout>