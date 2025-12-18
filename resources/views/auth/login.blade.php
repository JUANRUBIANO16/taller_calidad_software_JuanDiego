<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PixelPass Portal - Login</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#6366f1',
                        secondary: '#f43f5e',
                    }
                }
            }
        }
    </script>
    
    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    
    <!-- Custom Styles -->
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <main class="w-full max-w-md">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header -->
            <div class="bg-primary p-6 text-center">
                <i data-feather="lock" class="w-12 h-12 text-white mx-auto"></i>
                <h1 class="text-2xl font-bold text-white mt-4">FarmaVital</h1>
                <p class="text-primary-100 mt-1"></p>
            </div>
            
            <!-- Form -->
            <form action="{{ route('login') }}" method="POST" class="p-8 space-y-6">
                @csrf
                
                <!-- Success Message -->
                @if (session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <!-- Username Field -->
                <div class="space-y-2">
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-feather="user" class="text-gray-400"></i>
                        </div>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            value="{{ old('username') }}"
                            class="pl-10 w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary shadow-sm transition" 
                            placeholder="Enter your username"
                            required
                        >
                    </div>
                </div>
                
                <!-- Password Field -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-feather="key" class="text-gray-400"></i>
                        </div>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="pl-10 w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary shadow-sm transition" 
                            placeholder="••••••••"
                            required
                        >
                    </div>
                </div>
                
                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input 
                            id="remember-me" 
                            name="remember" 
                            type="checkbox" 
                            class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded"
                        >
                        <label for="remember-me" class="ml-2 block text-sm text-gray-700">Remember me</label>
                    </div>
                    <a href="#" class="text-sm text-primary hover:text-primary-600">Forgot password?</a>
                </div>
                
                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full flex items-center justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors"
                >
                    Sign in
                    <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
                </button>
            </form>
            
            <!-- Sign Up Link -->
            <div class="px-8 pb-6 text-center">
                <p class="text-sm text-gray-500">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="font-medium text-primary hover:text-primary-600">Sign up</a>
                </p>
            </div>
        </div>
    </main>
    
    <!-- Scripts -->
    <script>
        feather.replace();
    </script>
</body>
</html>
