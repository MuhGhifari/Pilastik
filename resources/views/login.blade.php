@extends('layouts/app')

@section('title', 'Pilastik|Login')
@section('content')
<div class="container bg-white flex items-center justify-center min-h-screen font-sans">
  <div class="w-80 p-6 space-y-6">
    <!-- Logo -->
    <div class="flex flex-col items-center space-y-2">
      <!-- Replace with actual logo image if needed -->
      <img src="{{ asset('images/logo-fill.png') }}" alt="Pilastik Logo" class="w-48 h-auto">
      <h1 class="text-xl font-bold text-grass hover:bg-grass-dark">Pilahan berbasis Statistik</h1>
    </div>

    <!-- Input fields -->
    <div class="space-y-4">
      <input type="text" placeholder="Username"
        class="w-full px-4 py-2 rounded-full bg-gray-100 text-sm placeholder-gray-500 focus:outline-none">
      <div class="relative">
        <input type="password" placeholder="Password"
          class="w-full px-4 py-2 rounded-full bg-gray-100 text-sm placeholder-gray-500 focus:outline-none">
        <span class="absolute right-4 top-2.5 text-gray-500 cursor-pointer">👁️</span>
      </div>
    </div>

    <!-- Log In Button -->
    <button class="w-full py-2 bg-grass hover:bg-grass-dark text-white rounded-full font-semibold">
      Log In
    </button>

    <!-- Forgot Password -->
    <div class="text-right">
      <a href="#" class="text-xs text-gray-700 hover:underline">Lupa Sandi?</a>
    </div>
  </div>
</div>
@endsection