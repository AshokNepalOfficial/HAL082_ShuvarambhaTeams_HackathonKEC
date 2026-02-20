<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- <title>Auth | Command Center</title> -->
  <title>{{ config('app.name', 'Laravel') }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { display: ['Space Grotesk', 'sans-serif'], body: ['DM Sans', 'sans-serif'] },
          colors: { 
            brand: { primary: '#0a0f1a', secondary: '#111827', card: '#1a2234', border: '#2a3548', accent: '#00d4aa', muted: '#64748b' }
          }
        }
      }
    }
  </script>


        @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>
    .bg-pattern {
      background-image: linear-gradient(135deg, #0a0f1a 0%, #0d1424 50%, #0a0f1a 100%),
        url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%232a3548' fill-opacity='0.15'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    @keyframes fadeSlideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    .animate-in { animation: fadeSlideUp 0.5s ease-out forwards; }
  </style>
</head>
<body class="bg-pattern font-body text-slate-200 min-h-screen">
  
  <div class="min-h-screen flex flex-col items-center justify-center p-4">
    {{ $slot }}
  </div>
</body>
</html>
