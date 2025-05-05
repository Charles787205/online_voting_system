<x-app-layout>
  <div class="mx-auto bg-grey-lightest">
    <div class="min-h-screen flex flex-col">
      <main class="bg-white-500 flex-1 p-3 overflow-hidden">
        <div class="flex flex-col">
          <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
            <div class="mb-2 border-solid border-grey-light rounded border shadow-sm w-full">
              <div class="bg-gray-300 px-2 py-3 border-solid border-gray-400 border-b">
                Create Election
              </div>
              <div class="p-3">
                <form action="{{ route('elections.store') }}" method="POST">
                  @csrf
                  <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Election Name</label>
                    <input type="text" name="name" id="name"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                      required>
                  </div>
                  <div class="mb-4">
                    <label for="election_start" class="block text-gray-700 text-sm font-bold mb-2">Election
                      Start</label>
                    <input type="datetime-local" name="election_start" id="election_start"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                      required>
                  </div>
                  <div class="mb-4">
                    <label for="election_end" class="block text-gray-700 text-sm font-bold mb-2">Election End</label>
                    <input type="datetime-local" name="election_end" id="election_end"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                      required>
                  </div>
                  <div class="mb-4">
                    <label for="voting_start" class="block text-gray-700 text-sm font-bold mb-2">Voting Start</label>
                    <input type="datetime-local" name="voting_start" id="voting_start"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                      required>
                  </div>
                  <div class="mb-4">
                    <label for="voting_end" class="block text-gray-700 text-sm font-bold mb-2">Voting End</label>
                    <input type="datetime-local" name="voting_end" id="voting_end"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                      required>
                  </div>
                  <div class="mt-5">
                    <button type="submit"
                      class="bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded">Create
                      Election</button>
                    <a href="{{ route('elections.index') }}"
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
    document.addEventListener('DOMContentLoaded', function () {
      const form = document.querySelector('form');
      const electionStartInput = document.getElementById('election_start');
      const electionEndInput = document.getElementById('election_end');
      const votingStartInput = document.getElementById('voting_start');
      const votingEndInput = document.getElementById('voting_end');

      form.addEventListener('submit', function (event) {
        const now = new Date();
        const electionStart = new Date(electionStartInput.value);
        const electionEnd = new Date(electionEndInput.value);
        const votingStart = new Date(votingStartInput.value);
        const votingEnd = new Date(votingEndInput.value);

        if (electionStart < now) {
          alert('Election start time must be greater than or equal to the current time.');
          event.preventDefault();
          return;
        }

        if (electionEnd <= electionStart) {
          alert('Election end time must be greater than the election start time.');
          event.preventDefault();
          return;
        }

        if (votingStart <= electionStart) {
          alert('Voting start time must be greater than the election start time.');
          event.preventDefault();
          return;
        }

        if (votingEnd > electionEnd) {
          alert('Voting end time must be less than or equal to the election end time.');
          event.preventDefault();
          return;
        }
      });
    });
  </script>
</x-app-layout>