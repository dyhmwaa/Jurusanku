<!-- resources/views/konsultasi/hasil.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Konsultasi Jurusan</title>
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

        .recommendation-card {
            transition: all 0.3s ease;
        }

        .recommendation-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(236, 72, 153, 0.1), 0 10px 10px -5px rgba(236, 72, 153, 0.04);
        }

        /* Add style for the circle color classes */
        .text-\[\#ec4899\] {
            stroke: #ec4899;
        }

        .text-\[\#db2777\] {
            stroke: #db2777;
        }

        .text-\[\#be185d\] {
            stroke: #be185d;
        }

        .text-\[\#9d174d\] {
            stroke: #9d174d;
        }

        .text-\[\#831843\] {
            stroke: #831843;
        }

        .text-\[\#fda4af\] {
            stroke: #fda4af;
        }
    </style>
</head>

<body class="gradient-bg min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header Animation -->
        <div class="text-center mb-10" id="header-animation">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Hasil Konsultasi Jurusan SMK</h1>
            <div class="h-1 w-24 bg-pink-400 mx-auto rounded"></div>
        </div>

        <!-- Profile Card -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8 transform  hover:shadow-lg border-l-4 border-pink-500" id="profile-card">
            <div class="md:flex">
                <div class="p-6 w-full">
                    <h2 class="text-xl font-semibold text-pink-600 mb-4">Profil Siswa</h2>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-500">Nama</p>
                                <p class="font-medium text-gray-800">{{ $data->nama ?? 'Data tidak tersedia' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Nilai Rata-rata</p>
                                <p class="font-medium text-gray-800">{{ $data->nilai ?? 'Data tidak tersedia' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Hobi dan Minat</p>
                                <p class="font-medium text-gray-800">{{ $data->hobi ?? 'Data tidak tersedia' }}</p>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-500">Mata Pelajaran Favorit</p>
                                <p class="font-medium text-gray-800">{{ $data->mapel_favorit ?? 'Data tidak tersedia' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Cita-cita</p>
                                <p class="font-medium text-gray-800">{{ $data->cita_cita ?? 'Data tidak tersedia' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Tanggal Konsultasi</p>
                                <p class="font-medium text-gray-800">{{ isset($data->created_at) ? $data->created_at->format('d M Y, H:i') : 'Data tidak tersedia' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hasil Rekomendasi -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8" id="recommendation-container">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-pink-600 mb-6">Rekomendasi Jurusan</h2>

                <!-- Menampilkan hasil AI -->
                <div class="prose max-w-none hasil-ai">
                    @if(isset($data->hasil_ai))
                    @if(strpos($data->hasil_ai, 'Error:') !== false || strpos($data->hasil_ai, 'Terjadi kesalahan') !== false || strpos($data->hasil_ai, 'Tidak dapat menghasilkan') !== false)
                    <div class="bg-red-50 text-red-800 p-4 rounded-md border-l-4 border-red-500">
                        {{ $data->hasil_ai }}
                    </div>
                    @else
                    <div class="recommendation-content">
                        {!! $data->hasil_ai !!}
                    </div>
                    @endif
                    @else
                    <div class="bg-yellow-50 text-yellow-800 p-4 rounded-md border-l-4 border-yellow-500">
                        Hasil konsultasi belum tersedia
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Visualisasi Persentase (Chart) -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8" id="chart-container">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-pink-600 mb-6">Visualisasi Kecocokan</h2>

                <div class="flex flex-wrap justify-center gap-4" id="chart-elements">
                    <!-- Akan diisi dengan chart via JavaScript -->
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-wrap justify-center gap-4 mt-8">
            <!-- Konsultasi Baru -->
            <a href="{{ url('/konsultasi') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Konsultasi Baru
            </a>

            <!-- Beranda -->
            <a href="{{ url('/') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h3m10-11v10a1 1 0 001 1h3m-16 0h16" />
                </svg>
                Beranda
            </a>




            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Animasi dengan GSAP
                    gsap.from("#header-animation", {
                        opacity: 0,
                        y: -50,
                        duration: 1,
                        ease: "power3.out"
                    });

                    gsap.from("#profile-card", {
                        opacity: 0,
                        x: -50,
                        duration: 0.8,
                        delay: 0.3,
                        ease: "power3.out"
                    });

                    gsap.from("#recommendation-container", {
                        opacity: 0,
                        y: 50,
                        duration: 0.8,
                        delay: 0.6,
                        ease: "power3.out"
                    });

                    gsap.from("#chart-container", {
                        opacity: 0,
                        y: 50,
                        duration: 0.8,
                        delay: 0.9,
                        ease: "power3.out"
                    });

                    // Extract persentase dari hasil AI
                    setTimeout(function() {
                        const content = document.querySelector('.recommendation-content');
                        if (content) {
                            const percentages = [];
                            const regex = /(\d+)%/g;
                            const html = content.innerHTML;
                            let match;
                            let count = 0;
                            const majorNames = ["Rekayasa Perangkat Lunak", "DKV", "Pemasaran", "Akuntansi", "Manajemen Perkantoran", "KKBT"];
                            const chartColors = ["#ec4899", "#db2777", "#be185d", "#9d174d", "#831843", "#fda4af"];

                            // Mencari semua persentase dalam hasil
                            while ((match = regex.exec(html)) !== null && count < 6) {
                                // Create safe major name if index is out of bounds
                                const majorName = count < majorNames.length ? majorNames[count] : `Jurusan ${count + 1}`;
                                const colorIndex = count < chartColors.length ? count : count % chartColors.length;

                                percentages.push({
                                    name: majorName,
                                    value: parseInt(match[1]),
                                    color: chartColors[colorIndex]
                                });
                                count++;
                            }

                            // Jika tidak ditemukan persentase, gunakan data dummy
                            if (percentages.length === 0) {
                                percentages.push({
                                    name: "Jurusan 1",
                                    value: 85,
                                    color: "#ec4899"
                                }, {
                                    name: "Jurusan 2",
                                    value: 70,
                                    color: "#db2777"
                                }, {
                                    name: "Jurusan 3",
                                    value: 60,
                                    color: "#be185d"
                                });
                            }

                            // Buat chart lingkaran (donut chart)
                            const chartContainer = document.getElementById('chart-elements');
                            if (chartContainer) {
                                chartContainer.innerHTML = ''; // Clear existing content

                                percentages.forEach(item => {
                                    const chartElement = document.createElement('div');
                                    chartElement.className = 'flex flex-col items-center recommendation-card p-4 rounded-lg';

                                    // Create safe class name for color
                                    const colorClass = item.color.includes('#') ?
                                        `text-[${item.color}]` : `text-${item.color}`;

                                    chartElement.innerHTML = `
                                <div class="relative w-32 h-32">
                                    <svg class="w-32 h-32">
                                        <circle class="text-gray-200" stroke-width="10" stroke="currentColor" fill="transparent" r="56" cx="64" cy="64"></circle>
                                        <circle class="${colorClass} circle-progress" stroke-width="10" stroke="currentColor" stroke-linecap="round" stroke-dasharray="${item.value * 3.51}, 351" stroke-dashoffset="0" fill="transparent" r="56" cx="64" cy="64"></circle>
                                    </svg>
                                    <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center">
                                        <span class="text-2xl font-bold text-gray-700">${item.value}%</span>
                                    </div>
                                </div>
                                <div class="mt-3 text-center">
                                    <h3 class="font-medium text-gray-800">${item.name}</h3>
                                </div>
                            `;
                                    chartContainer.appendChild(chartElement);
                                });
                            }
                        }
                    }, 1000);
                });
            </script>
</body>

</html>