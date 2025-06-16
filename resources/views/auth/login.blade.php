@extends('layouts/app')

@section('title', 'Pilastik|Login')
@section('content')
  <div class="container bg-white flex items-center justify-center min-h-screen font-sans">
    <div class="w-80 p-6 space-y-6">
    <!-- Logo -->
    <div class="flex flex-col items-center space-y-2">
      <!-- Replace with actual logo image if needed -->
      <img src="{{ asset('images/logo-fill.png') }}" alt="Pilastik Logo" class="w-48 h-auto">
      <h1 class="text-xl font-bold text-grass">Pilahan berbasis Statistik</h1>
    </div>

    <!-- Input fields -->
    <form class="space-y-4" action="{{  route('login') }}" method="POST">
      @csrf
      <!-- <input id="username" name="username" type="text" placeholder="Username" required autofocus value="{{ old('username') }}" -->
      <input id="username" name="email" type="text" placeholder="Username" required autofocus value="{{ old('username') }}"
      class="w-full px-4 py-2 rounded-full bg-gray-100 text-sm placeholder-gray-500 focus:outline-none">
      <div class="relative">
      <input id="password" name="password" type="password" placeholder="Password" required class="w-full px-4 py-2 rounded-full bg-gray-100 text-sm placeholder-gray-500 focus:outline-none">
        <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center"
          tabindex="-1">
          <img id="eyeIcon" src="{{ asset('icons/eye_closed.svg') }}" class="h-6 w-6" alt="Show">
          <img id="eyeIconOff" src="{{ asset('icons/eye_open.svg') }}" class="h-6 w-6 hidden" alt="Hide">
        </button>
      </div>
      <button type="submit" class="w-full py-2 bg-grass hover:bg-grass-dark text-white rounded-full font-semibold">Masuk</button>
      <div class="text-center">
        <a href="#" class="text-xs text-gray-700 hover:underline">Lupa Sandi?</a>
      </div>

      @if($errors->any())
        <ul class="px-4 py-2 bg-red-100">
          @foreach($errors->all() as $error)
            <li class="my-2 text-red-500">{{ $error }}</li>
          @endforeach
        </ul>
      @endif
    </form>

    <!-- Forgot Password -->
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    function togglePassword() {
    const input = document.getElementById("password");
    const eye = document.getElementById("eyeIcon");
    const eyeOff = document.getElementById("eyeIconOff");

    if (input.type === "password") {
      input.type = "text";
      eye.classList.add("hidden");
      eyeOff.classList.remove("hidden");
    } else {
      input.type = "password";
      eye.classList.remove("hidden");
      eyeOff.classList.add("hidden");
    }
    }
  </script>
@endsection