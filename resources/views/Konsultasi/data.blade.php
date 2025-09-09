<!-- resources/views/konsultasi/data.blade.php -->
@if (!Auth::check())
<script>
    window.location = "{{ route('login') }}";
</script>
@endif

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Konsultasi Jurusan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        pink: {
                            50: '#fdf2f8',
                            100: '#fce7f3',
                            200: '#fbcfe8',
                            300: '#f9a8d4',
                            400: '#f472b6',
                            500: '#ec4899',
                            600: '#db2777',
                            700: '#be185d',
                            800: '#9d174d',
                            900: '#831843'
                        },
                    }
                }
            }
        }
    </script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #fdf2f8 0%, #ffffff 100%);
        }

        .gradient-card {
            background: linear-gradient(135deg, #ffffff 0%, #fce7f3 100%);
        }

        /* .table-row {
            transition: all 0.2s ease;
        }

        .table-row:hover {
            background-color: #fce7f3;
        } */
    </style>
</head>

<body class="gradient-bg min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- User Authentication Info -->
        <div class="flex justify-between items-center mb-6">
            <div class="text-gray-700">
                Selamat datang, <span class="font-medium">{{ Auth::user()->name }}</span>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="text-pink-600 hover:text-pink-800">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>

        <!-- Header Animation -->
        <div class="text-center mb-10" id="header-animation">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Data Konsultasi Jurusan</h1>
            <div class="h-1 w-32 bg-pink-400 mx-auto rounded"></div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded shadow-sm" id="success-message">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Error Message -->
        @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded shadow-sm" id="error-message">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-red-700">{{ session('error') }}</p>
                </div>
            </div>
        </div>
        @endif



        <!-- Debug info (remove in production) -->
        @if(app()->environment('local'))
        <div class="mb-4 p-4 bg-gray-100 rounded-md">
            <p class="text-sm text-gray-700">Jumlah data: {{ isset($data) ? count($data) : 0 }}</p>
        </div>
        @endif

        
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden" id="data-table">
            <div class="p-6 space-y-6">

                <!-- Tombol Download -->
                <div class="flex justify-end">
                    <a href="{{ route('data.download') }}" class="inline-flex items-center gap-2 bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 px-5 rounded-full shadow transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3" />
                        </svg>
                        Download PDF
                    </a>
                </div>

            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-pink-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-pink-700 uppercase tracking-wider">No</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-pink-700 uppercase tracking-wider">Nama</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-pink-700 uppercase tracking-wider">Nilai</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-pink-700 uppercase tracking-wider">Mapel Favorit</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-pink-700 uppercase tracking-wider">Cita-cita</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-pink-700 uppercase tracking-wider">Tanggal</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-pink-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($data ?? [] as $index => $item)
                        <tr class="table-row">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-medium text-gray-900">{{ $item->nama }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->nilai }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->mapel_favorit }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->cita_cita }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if(is_string($item->created_at))
                                {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i') }}
                                @else
                                {{ $item->created_at->format('d M Y, H:i') }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ url('/hasil/'.$item->id) }}" class="text-blue-600 hover:text-blue-900 bg-blue-50 px-3 py-1 rounded transition-colors">
                                        <span>Lihat</span>
                                    </a>
                                    <form action="{{ url('/data/'.$item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 px-3 py-1 rounded transition-colors">
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-500 italic">
                                <div class="flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <p class="text-lg">Belum ada data konsultasi</p>
                                    <a href="{{ url('/konsultasi') }}" class="mt-4 text-pink-600 hover:text-pink-800 font-medium">
                                        Tambah data konsultasi sekarang
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animasi dengan GSAP
            gsap.from("#header-animation", {
                opacity: 0,
                y: -50,
                duration: 1,
                ease: "power3.out"
            });



            gsap.from("#success-message, #error-message", {
                opacity: 0,
                y: -20,
                duration: 0.8,
                delay: 0.3,
                ease: "power3.out"
            });

            gsap.from("#action-buttons", {
                opacity: 0,
                x: -30,
                duration: 0.8,
                delay: 0.5,
                ease: "power3.out"
            });

            gsap.from("#data-table", {
                opacity: 0,
                y: 30,
                duration: 0.8,
                delay: 0.7,
                ease: "power3.out"
            });

            // Animasi untuk table rows
            const tableRows = document.querySelectorAll(".table-row");
            if (tableRows.length > 0) {
                gsap.from(tableRows, {
                    opacity: 0,
                    y: 20,
                    duration: 0.5,
                    stagger: 0.1,
                    delay: 1,
                    ease: "power3.out"
                });
            }

            // Auto-hide success message
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                setTimeout(function() {
                    gsap.to(successMessage, {
                        opacity: 0,
                        y: -20,
                        duration: 0.5,
                        ease: "power3.out",
                        onComplete: function() {
                            successMessage.style.display = 'none';
                        }
                    });
                }, 5000);
            }
        });
    </script>
</body>

</html>
