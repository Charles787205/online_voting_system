<x-app-layout>
  <div class="container mx-auto bg-grey-lightest">
    <div class="min-h-screen flex flex-col">
      <main class="bg-white-500 flex-1 p-3 overflow-hidden">
        <div class="flex flex-col">
          <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
            <div class="mb-2 border-solid border-grey-light rounded border shadow-sm w-full">
              <div class="bg-gray-300 px-2 py-3 border-solid border-gray-400 border-b">
                Elections Dashboard
              </div>
              <div class="p-3">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                  @forelse ($watchers as $watcher)
                  <div class="border-solid border-grey-light rounded border shadow-sm">
                    <div class="bg-gray-200 px-2 py-3 border-solid border-gray-300 border-b">
                      {{ $watcher->election->name }}
                    </div>
                    <div class="p-3">
                      <div class="flex justify-between items-center mb-4">
                        <div class="text-gray-500">
                          <i class="fas fa-calendar-alt mr-2"></i>
                          <span>{{ $watcher->election->voting_start ? \Carbon\Carbon::parse($watcher->election->voting_start)->format('M d, Y') : 'Date not set' }}</span>
                        </div>
                        <span
                          class="{{ $watcher->election->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }} text-xs px-3 py-1 rounded-full font-semibold">
                          {{ $watcher->election->is_active ? 'Active' : 'Inactive' }}
                        </span>
                      </div>

                      @if($watcher->election->is_active)
                      <div class="mb-4 bg-blue-50 border border-blue-100 rounded p-3">
                        <h4 class="text-sm font-semibold text-blue-800">Voting Ends In:</h4>
                        <div id="timer-{{ $watcher->election->id }}" class="text-lg font-bold text-blue-700"
                          data-end="{{ $watcher->election->voting_end_timestamp }}">
                          {{ $watcher->election->time_remaining }}
                        </div>
                      </div>
                      @endif

                      <div class="mb-4">
                        <h3 class="text-lg font-semibold mb-2">Live Vote Results</h3>
                        <div id="nominees-{{ $watcher->election->id }}" class="space-y-3">
                          <div class="text-center py-4">
                            <div
                              class="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-blue-500">
                            </div>
                            <p class="mt-2">Loading nominees and votes...</p>
                          </div>
                        </div>
                      </div>


                    </div>
                  </div>
                  @empty
                  <div class="col-span-full text-center py-6 text-gray-500">
                    <p>You're not assigned as a watcher for any elections.</p>
                  </div>
                  @endforelse

                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const watchers = @json($watchers);

      // Initialize vote count fetching for each election
      watchers.forEach(watcher => {
        fetchVotes(watcher.election_id);

        // Set interval to refresh vote counts every 3 seconds
        setInterval(() => {
          fetchVotes(watcher.election_id);
        }, 3000);

        // Set up countdown timer for active elections
        if (watcher.election && watcher.election.is_active) {
          const timerElement = document.getElementById(`timer-${watcher.election.id}`);
          if (timerElement) {
            const endTimestamp = parseInt(timerElement.getAttribute('data-end')) * 1000; // Convert to milliseconds

            // Update timer immediately and then every second
            updateTimer(timerElement, endTimestamp);
            setInterval(() => updateTimer(timerElement, endTimestamp), 1000);
          }
        }
      });

      function updateTimer(element, endTimestamp) {
        const now = new Date().getTime();
        const timeLeft = endTimestamp - now;

        if (timeLeft <= 0) {
          element.innerHTML = "Voting has ended";
          element.parentElement.classList.remove('bg-blue-50', 'border-blue-100');
          element.parentElement.classList.add('bg-red-50', 'border-red-100');
          element.classList.remove('text-blue-700');
          element.classList.add('text-red-700');
          return;
        }

        // Calculate days, hours, minutes and seconds
        const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
        const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

        // Display the result
        let timeString = '';

        if (days > 0) {
          timeString += `${days}d `;
        }
        if (hours > 0 || days > 0) {
          timeString += `${hours}h `;
        }
        if (minutes > 0 || hours > 0 || days > 0) {
          timeString += `${minutes}m `;
        }
        timeString += `${seconds}s`;

        element.innerHTML = timeString;
      }

      function fetchVotes(electionId) {
        fetch(`/election/${electionId}/votes`)
          .then(response => response.json())
          .then(data => {
            updateVotesDisplay(electionId, data);
          })
          .catch(error => {
            console.error('Error fetching vote counts:', error);
          });
      }

      function updateVotesDisplay(electionId, nominees) {
        const container = document.getElementById(`nominees-${electionId}`);

        if (!nominees.length) {
          container.innerHTML = '<p class="text-center py-4">No nominees found for this election.</p>';
          return;
        }

        // Group nominees by position
        const positionGroups = {};
        nominees.forEach(nominee => {
          if (!positionGroups[nominee.position]) {
            positionGroups[nominee.position] = [];
          }
          positionGroups[nominee.position].push(nominee);
        });

        // Generate HTML for each position and its nominees
        let html = '';
        for (const position in positionGroups) {
          html += `
            <div class="border-b border-gray-200 pb-3 mb-3">
              <h4 class="font-medium text-gray-800">${position}</h4>
              <div class="mt-2 space-y-2">
          `;

          // Sort nominees by vote count (descending)
          const sortedNominees = positionGroups[position].sort((a, b) => b.vote_count - a.vote_count);

          sortedNominees.forEach(nominee => {
            // Calculate percentage for progress bar
            const maxVotes = Math.max(...sortedNominees.map(n => n.vote_count)) || 1;
            const percentage = (nominee.vote_count / maxVotes) * 100;

            html += `
              <div class="nominee-item">
                <div class="flex justify-between items-center mb-1">
                  <span class="text-sm font-medium">${nominee.name}</span>
                  <span class="text-sm font-bold">${nominee.vote_count} votes</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                  <div class="bg-blue-600 h-2.5 rounded-full transition-all duration-500" style="width: ${percentage}%"></div>
                </div>
              </div>
            `;
          });

          html += `
              </div>
            </div>
          `;
        }

        container.innerHTML = html;
      }
    });
  </script>
</x-app-layout>