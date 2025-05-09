<x-app-layout>
  <div class="container mx-auto bg-grey-lightest">
    <div class="min-h-screen flex flex-col">
      <main class="bg-white-500 flex-1 p-3 overflow-hidden">
        <div class="flex flex-col">
          <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
            <div class="mb-2 border-solid border-grey-light rounded border shadow-sm w-full">
              <div class="bg-gray-300 px-2 py-3 border-solid border-gray-400 border-b">
                Edit Nominee
              </div>
              <div class="p-3">
                <style>
                  .nominee-image {
                    width: 100px;
                    height: 100px;
                    border-radius: 50%;
                    margin: 0 auto;
                    display: block;
                  }
                </style>
                <form action="{{ route('nominees.update', $nominee) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')


                  <div class="mb-4">
                    <label for="image_url" class="block text-gray-700 text-sm font-bold mb-2">Upload Image</label>
                    <input type="file" name="image_url" id="image_url"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @if ($nominee->image_url)
                    <div class="mt-2">
                      <img src="{{ Storage::url($nominee->image_url) }}" alt="Nominee Image" class="nominee-image">
                    </div>
                    @endif
                  </div>

                  <div class="mb-4">
                    <label for="student_id" class="block text-gray-700 text-sm font-bold mb-2">Select Student</label>
                    <select name="student_id" id="student_id"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                      @foreach ($students as $student)
                      <option value="{{ $student->id_number }}"
                        {{ $nominee->student_id == $student->id_number ? 'selected' : '' }}>{{ $student->user->name }}
                      </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="mb-4">
                    <label for="position_id" class="block text-gray-700 text-sm font-bold mb-2">Select Position</label>
                    <select name="position_id" id="position_id"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                      <option value="">Select Position</option>
                      @foreach ($positions as $position)
                      <option value="{{ $position->id }}"
                        {{ $nominee->position_id == $position->id ? 'selected' : '' }}>{{ $position->position->name }}
                      </option>
                      @endforeach
                    </select>
                  </div>

                  <div class="mt-5">
                    <button type="submit"
                      class="bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded">Update
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
</x-app-layout>