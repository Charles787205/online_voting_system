<x-guest-layout :additionalBodyClass="'login'">
    <div class="container mx-auto h-full flex flex-1 justify-center items-center">
        <div class="w-full max-w-lg">
            <div class="leading-loose">
                <div id="role-selection" class="max-w-xl m-4 p-10 bg-white rounded shadow-xl">
                    <p class="text-gray-800 font-medium text-center text-lg font-bold">Register</p>
                    <div class="mt-4">
                        <button id="professor-btn"
                            class="px-4 py-2 text-white font-light tracking-wider bg-gray-900 rounded w-full">Register
                            as Professor</button>
                    </div>
                    <div class="mt-4">
                        <button id="student-btn"
                            class="px-4 py-2 text-white font-light tracking-wider bg-gray-900 rounded w-full">Register
                            as Student</button>
                    </div>
                </div>

                <form id="professor-form" method="POST" action="{{ route('register') }}"
                    class="hidden max-w-xl m-4 p-10 bg-white rounded shadow-xl">
                    @csrf
                    <p class="text-gray-800 font-medium text-center text-lg font-bold">Register as Professor</p>
                    <div class="mt-4">
                        <label class="block text-sm text-gray-00" for="name">Name</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="name" name="name"
                            type="text" required placeholder="Your Name" aria-label="Name">
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm text-gray-600" for="email">Email</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="email" name="email"
                            type="email" required placeholder="Your Email" aria-label="Email">
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm text-gray-600" for="password">Password</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="password" name="password"
                            type="password" required placeholder="*******" aria-label="Password">
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm text-gray-600" for="password_confirmation">Confirm Password</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="password_confirmation"
                            name="password_confirmation" type="password" required placeholder="*******"
                            aria-label="Confirm Password">
                    </div>
                    <input type="hidden" id="type" name="type" value="professor">
                    <div class="mt-4">
                        <button class="px-4 py-2 text-white font-light tracking-wider bg-gray-900 rounded w-full"
                            type="submit">Register</button>
                    </div>
                    <div class="mt-4">
                        <button id="back-to-role-selection-prof"
                            class="px-4 py-2 text-gray-900 font-light tracking-wider bg-gray-200 rounded w-full"
                            type="button">Back</button>
                    </div>
                </form>

                <form id="student-form" method="POST" action="{{ route('register') }}"
                    class="hidden max-w-xl m-4 p-10 bg-white rounded shadow-xl">
                    @csrf
                    <p class="text-gray-800 font-medium text-center text-lg font-bold">Register as Student</p>
                    <div class="mt-4">
                        <label class="block text-sm text-gray-00" for="name">Name</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="name" name="name"
                            type="text" required placeholder="Your Name" aria-label="Name">
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm text-gray-600" for="email">Email</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="email" name="email"
                            type="email" required placeholder="Your Email" aria-label="Email">
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm text-gray-600" for="password">Password</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="password" name="password"
                            type="password" required placeholder="*******" aria-label="Password">
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm text-gray-600" for="password_confirmation">Confirm Password</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="password_confirmation"
                            name="password_confirmation" type="password" required placeholder="*******"
                            aria-label="Confirm Password">
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm text-gray-600" for="id_number">Student ID</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="id_number"
                            name="id_number" type="text" required placeholder="Your Student ID" aria-label="Student ID">
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm text-gray-600" for="year">Year</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="year" name="year"
                            type="text" required placeholder="Year" aria-label="Year">
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm text-gray-600" for="course">Course</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="course" name="course"
                            type="text" required placeholder="Course" aria-label="Course">
                    </div>
                    <input type="hidden" id="type" name="type" value="student">
                    <div class="mt-4">
                        <button class="px-4 py-2 text-white font-light tracking-wider bg-gray-900 rounded w-full"
                            type="submit">Register</button>
                    </div>
                    <div class="mt-4">
                        <button id="back-to-role-selection-student"
                            class="px-4 py-2 text-gray-900 font-light tracking-wider bg-gray-200 rounded w-full"
                            type="button">Back</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('professor-btn').addEventListener('click', function () {
            document.getElementById('role-selection').classList.add('hidden');
            document.getElementById('professor-form').classList.remove('hidden');
        });

        document.getElementById('student-btn').addEventListener('click', function () {
            document.getElementById('role-selection').classList.add('hidden');
            document.getElementById('student-form').classList.remove('hidden');
        });

        document.getElementById('back-to-role-selection-prof').addEventListener('click', function () {
            document.getElementById('professor-form').classList.add('hidden');
            document.getElementById('role-selection').classList.remove('hidden');
        });

        document.getElementById('back-to-role-selection-student').addEventListener('click', function () {
            document.getElementById('student-form').classList.add('hidden');
            document.getElementById('role-selection').classList.remove('hidden');
        });
    </script>
</x-guest-layout>