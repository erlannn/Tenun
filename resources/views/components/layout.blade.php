<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riska Sulam - Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-white font-sans min-h-screen flex m-0 p-0 overflow-x-hidden">

    <x-sidebar />
    

    <!-- CONTENT WRAPPER -->
    <div class="flex-1 flex flex-col min-w-0">
        
        <!-- TOPBAR (Latar Krem Lembut Sesuai Gambar) -->
        <header class="bg-[#FAF6E9] px-8 py-5 flex items-center border-b border-gray-100 shadow-sm sticky top-0y">
            <!-- Ikon Hamburger -->
            <button id="sidebarToggle" class="text-gray-600 mr-4 focus:outline-none flex items-center">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <h2 class="text-3xl font-bold text-gray-900 tracking-tight font-sans">{{ $title }}</h2>
        </header>

        <!-- KONTEN UTAMA -->
        <main class="flex-1 p-8 bg-white overflow-y-auto">
            {{ $slot }}
        </main>

    </div>

    <script>
  document.getElementById('sidebarToggle').addEventListener('click', function () {
    const sidebar = document.querySelector('aside');
    if (sidebar) {
      sidebar.classList.toggle('hidden');
    }
  });
</script>

</body>
</html>