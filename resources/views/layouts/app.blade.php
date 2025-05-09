<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Online Voting System</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom styles -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
        }

        .notification {
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
            animation: slideIn 0.5s forwards;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .fade-out {
            animation: fadeOut 0.5s forwards;
        }

        @keyframes fadeOut {
            from {
                transform: translateY(0);
                opacity: 1;
            }

            to {
                transform: translateY(-20px);
                opacity: 0;
            }
        }

        .card {
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .page-content {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #4f46e5;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #3730a3;
        }
    </style>
</head>

<body>
    <div class="min-h-screen bg-gray-50">
        <!-- Error and Success Messages -->
        <div id="notifications" class="fixed top-4 right-4 z-50 space-y-3 max-w-sm">
            @if ($errors->any())
            <div id="error-notification"
                class="notification flex items-center p-4 pr-6 bg-white border-l-4 border-red-500 rounded shadow-lg">
                <div class="flex-shrink-0 mr-3">
                    <i class="fas fa-times-circle text-red-500 text-xl"></i>
                </div>
                <div class="flex-grow">
                    <h3 class="font-medium text-gray-800">Error</h3>
                    <div class="text-sm text-gray-600 max-h-28 overflow-auto">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <button onclick="closeNotification('error-notification')"
                    class="text-gray-500 hover:text-gray-700 ml-3">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            @endif

            @if (session('success'))
            <div id="success-notification"
                class="notification flex items-center p-4 pr-6 bg-white border-l-4 border-green-500 rounded shadow-lg">
                <div class="flex-shrink-0 mr-3">
                    <i class="fas fa-check-circle text-green-500 text-xl"></i>
                </div>
                <div class="flex-grow">
                    <h3 class="font-medium text-gray-800">Success</h3>
                    <p class="text-sm text-gray-600">{{ session('success') }}</p>
                </div>
                <button onclick="closeNotification('success-notification')"
                    class="text-gray-500 hover:text-gray-700 ml-3">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            @endif

            @if (session('error'))
            <div id="session-error-notification"
                class="notification flex items-center p-4 pr-6 bg-white border-l-4 border-red-500 rounded shadow-lg">
                <div class="flex-shrink-0 mr-3">
                    <i class="fas fa-exclamation-circle text-red-500 text-xl"></i>
                </div>
                <div class="flex-grow">
                    <h3 class="font-medium text-gray-800">Error</h3>
                    <p class="text-sm text-gray-600">{{ session('error') }}</p>
                </div>
                <button onclick="closeNotification('session-error-notification')"
                    class="text-gray-500 hover:text-gray-700 ml-3">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            @endif
        </div>

        <!-- Page Heading -->
        <div class="min-h-screen flex flex-col">
            @include('layouts.navbar')
            <div class="flex flex-1">
                @include('layouts.sidebar')
                <main class="bg-gray-50 flex-1 p-6 overflow-auto">
                    <!-- Page Content -->
                    <div class="page-content">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </div>

    <script>
        // Function to toggle sidebar
        function sidebarToggle() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
        }

        // Auto-hide notifications after 5 seconds
        setTimeout(function () {
            const notifications = document.querySelectorAll('.notification');
            notifications.forEach(notification => {
                notification.classList.add('fade-out');
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 500);
            });
        }, 5000);

        // Close notification function
        function closeNotification(id) {
            const notification = document.getElementById(id);
            notification.classList.add('fade-out');
            setTimeout(() => {
                notification.style.display = 'none';
            }, 500);
        }
    </script>
    <script src="js/main.js"></script>
</body>

</html>