<!-- resources/views/konsultasi/multi-step-form.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konsultasi Jurusan SMK</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'pink-light': '#FFF0F7',
                        'pink-mid': '#FFCEE4',
                        'pink-primary': '#FF85B1',
                        'pink-dark': '#FF5C8D',
                    },
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: linear-gradient(135deg, #FFF0F7 0%, #fff 100%);
            min-height: 100vh;
        }

        .form-step {
            display: none;
        }

        .form-step.active {
            display: block;
        }

        .input-field {
            @apply transition-all duration-300 border border-pink-200 rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-pink-primary focus:border-transparent;
        }

        .btn-primary {
            @apply bg-gradient-to-r from-pink-primary to-pink-dark text-white font-medium py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105 hover:shadow-lg focus:outline-none;
        }

        .btn-secondary {
            @apply bg-white text-pink-dark border border-pink-primary font-medium py-3 px-6 rounded-lg transition-all duration-300 hover:bg-pink-light focus:outline-none;
        }

        .progress-bar {
            height: 0.5rem;
            border-radius: 9999px;
            background-color: #FFE0EF;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #FF85B1 0%, #FF5C8D 100%);
            transition: width 0.5s ease;
        }

        .step-indicator {
            @apply flex items-center justify-center w-8 h-8 rounded-full font-medium text-sm transition-all duration-300;
        }

        .step-indicator.active {
            @apply bg-pink-primary text-white;
        }

        .step-indicator.completed {
            @apply bg-pink-dark text-white;
        }

        .step-indicator.inactive {
            @apply bg-pink-light text-pink-primary border border-pink-primary;
        }

        .form-card {
            @apply bg-white rounded-xl shadow-lg p-8 mb-6 transition-all duration-300 transform;
        }

        .form-card:hover {
            @apply shadow-xl;
        }

        .floating-label {
            @apply absolute left-3 transition-all duration-200 text-gray-500 pointer-events-none;
            transform-origin: 0 0;
        }

        .input-field:focus+.floating-label,
        .input-field:not(:placeholder-shown)+.floating-label {
            @apply text-pink-primary text-xs;
            transform: translateY(-1.5rem) scale(0.85);
        }

        .input-field::placeholder {
            color: transparent;
        }
    </style>
</head>

<body class="antialiased">
    <div class="container mx-auto px-4 py-12 max-w-3xl">
        <div class="text-center mb-12 form-header">
            <h1 class="text-3xl md:text-4xl font-bold 1 mb-4">
                <span class="bg-clip-text bg-gradient-to-r from-pink-primary to-pink-dark">
                    Konsultasi Jurusan SMK
                </span>
            </h1>
            <p class="text-gray-600 mb-6">Temukan jurusan yang paling sesuai dengan potensi dan minatmu</p>

            <!-- Progress Bar & Steps -->
            <div class="max-w-lg mx-auto mb-8">
                <div class="flex justify-between mb-2">
                    <div class="step-indicator active" id="step-1">1</div>
                    <div class="h-0.5 bg-pink-light flex-grow my-auto mx-2"></div>
                    <div class="step-indicator inactive" id="step-2">2</div>
                    <div class="h-0.5 bg-pink-light flex-grow my-auto mx-2"></div>
                    <div class="step-indicator inactive" id="step-3">3</div>
                    <div class="h-0.5 bg-pink-light flex-grow my-auto mx-2"></div>
                    <div class="step-indicator inactive" id="step-4">4</div>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 25%"></div>
                </div>
            </div>
        </div>

        <form id="konsultasiForm" action="{{ url('/konsultasi') }}" method="POST" class="mx-auto">
            @csrf

            <!-- Step 1: Identitas Diri -->
            <div class="form-step active" id="step1">
                <div class="form-card" id="card1">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Identitas Diri</h2>

                    <div class="mb-6 relative">
                        <input
                            type="text"
                            id="nama"
                            name="nama"
                            placeholder=" "
                            required
                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 peer" />
                        <label
                            for="nama"
                            class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-2.5 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                            Nama Lengkap
                        </label>
                    </div>

                    <div class="mb-6 relative">
                        <input
                            type="number"
                            id="nilai"
                            name="nilai"
                            min="0"
                            max="100"
                            placeholder=" "
                            required
                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 peer" />
                        <label
                            for="nilai"
                            class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-2.5 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">
                            Nilai Rata-rata Rapor (0-100)
                        </label>

                        <!-- Pesan peringatan -->
                        <p id="warning-nilai" class="text-red-500 text-sm mt-1 hidden">Nilai harus antara 0 dan 100</p>

                        <script>
                            const inputNilai = document.getElementById('nilai');
                            const warning = document.getElementById('warning-nilai');

                            inputNilai.addEventListener('input', function() {
                                if (this.value > 100) {
                                    this.value = 100;
                                    warning.classList.remove('hidden');
                                } else if (this.value < 0) {
                                    this.value = 0;
                                    warning.classList.remove('hidden');
                                } else {
                                    warning.classList.add('hidden');
                                }
                            });
                        </script>
                    </div>

                    <div class="text-right">
                        <button type="button" class="btn-primary next-step" data-step="1">
                            Lanjutkan
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block ml-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="form-step" id="step2">
                <div class="form-card" id="card2">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Minat dan Bakat</h2>

                    <div class="mb-6 relative">
                        <label for="hobi" class="block mb-2 text-sm font-medium text-gray-700">
                            Hobi dan Minat
                        </label>
                        <textarea
                            id="hobi"
                            name="hobi"
                            rows="4"
                            required
                            placeholder="Ceritakan hobi dan minat yang kamu sukai..."
                            class="block p-2.5 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></textarea>

                        <!-- Autocomplete Dropdown -->
                        <ul id="hobi-suggestions" class="absolute z-10 bg-white border border-gray-300 rounded-lg mt-1 w-full hidden max-h-40 overflow-y-auto shadow-md"></ul>
                    </div>

                    <div class="flex justify-between">
                        <button type="button" class="btn-secondary prev-step" data-step="2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                            Kembali
                        </button>
                        <button type="button" class="btn-primary next-step" data-step="2">
                            Lanjutkan
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block ml-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tambahkan JavaScript di bawah -->
            <script>
                const hobbies = [
                    "Membaca",
                    "Menulis",
                    "Menggambar",
                    "Bermain musik",
                    "Olahraga",
                    "Bersepeda",
                    "Fotografi",
                    "Memasak",
                    "Bermain game",
                    "Coding",
                    "Traveling",
                    "Menyanyi",
                    "Menari",
                    "Desain grafis",
                    "Berkebun"
                ];

                const textarea = document.getElementById('hobi');
                const suggestionBox = document.getElementById('hobi-suggestions');

                textarea.addEventListener('input', function() {
                    const input = this.value.toLowerCase();
                    suggestionBox.innerHTML = '';
                    if (input.length === 0) {
                        suggestionBox.classList.add('hidden');
                        return;
                    }
                    const filtered = hobbies.filter(hobby => hobby.toLowerCase().includes(input));
                    if (filtered.length === 0) {
                        suggestionBox.classList.add('hidden');
                        return;
                    }
                    filtered.forEach(hobby => {
                        const li = document.createElement('li');
                        li.textContent = hobby;
                        li.className = 'p-2 cursor-pointer hover:bg-blue-100';
                        li.addEventListener('click', function() {
                            textarea.value = hobby;
                            suggestionBox.classList.add('hidden');
                        });
                        suggestionBox.appendChild(li);
                    });
                    suggestionBox.classList.remove('hidden');
                });

                document.addEventListener('click', function(e) {
                    if (!suggestionBox.contains(e.target) && e.target !== textarea) {
                        suggestionBox.classList.add('hidden');
                    }
                });
            </script>


            <!-- Step 3: Akademik -->
            <div class="form-step" id="step3">
                <div class="form-card" id="card3">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Preferensi Akademik</h2>

                    <div class="mb-6">
                        <label for="mapel_favorit" class="block text-gray-700 mb-2">Mata Pelajaran Favorit</label>
                        <select id="mapel_favorit" name="mapel_favorit" class="input-field" required>
                            <option value="">-- Pilih Mata Pelajaran --</option>
                            <option value="Matematika">Matematika</option>
                            <option value="IPA">IPA</option>
                            <option value="IPS">IPS</option>
                            <option value="Bahasa">Bahasa</option>
                            <option value="Komputer">Komputer</option>
                            <option value="Seni">Seni</option>
                        </select>
                    </div>

                    <div class="flex justify-between">
                        <button type="button" class="btn-secondary prev-step" data-step="3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                            Kembali
                        </button>
                        <button type="button" class="btn-primary next-step" data-step="3">
                            Lanjutkan
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block ml-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Step 4: Final -->
            <div class="form-step" id="step4">
                <div class="form-card" id="card4">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Aspirasi Karir</h2>

                    <div class="mb-6 relative">
                        <input
                            type="text"
                            id="cita_cita"
                            name="cita_cita"
                            required
                            autocomplete="off"
                            placeholder=" "
                            class="block w-full px-3 pt-4 pb-2 text-sm text-gray-900 bg-transparent border border-gray-300 rounded-lg appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 peer" />
                        <label
                            for="cita_cita"
                            class="absolute text-sm text-gray-500 duration-300 transform -translate-y-3 scale-75 top-2 z-10 origin-[0] left-3 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-2.5 peer-focus:scale-75 peer-focus:-translate-y-3">
                            Cita-cita atau Pekerjaan yang Diinginkan
                        </label>

                        <!-- Autocomplete Dropdown -->
                        <ul id="cita-cita-suggestions" class="absolute z-10 bg-white border border-gray-300 rounded-lg mt-1 w-full hidden max-h-40 overflow-y-auto shadow-md"></ul>
                    </div>

                    <div class="flex justify-between">
                        <button type="button" class="btn-secondary prev-step" data-step="4">
                            Kembali
                        </button>
                        <button type="button" class="btn-primary next-step" data-step="4">
                            Lanjutkan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tambahkan Scriptnya -->
            <script>
                const careerOptions = [
                    "Dokter",
                    "Pilot",
                    "Pengacara",
                    "Guru",
                    "Programmer",
                    "Desainer Grafis",
                    "Arsitek",
                    "Ilmuwan",
                    "Entrepreneur",
                    "Polisi",
                    "Tentara",
                    "Penyanyi",
                    "Aktor",
                    "Penulis",
                    "Chef",
                    "Psikolog",
                    "Animator",
                    "Data Analyst",
                    "Web Developer",
                    "Content Creator"
                ];

                const citaCitaInput = document.getElementById('cita_cita');
                const suggestionList = document.getElementById('cita-cita-suggestions');

                citaCitaInput.addEventListener('input', function() {
                    const inputVal = this.value.toLowerCase();
                    suggestionList.innerHTML = '';
                    if (inputVal.length === 0) {
                        suggestionList.classList.add('hidden');
                        return;
                    }
                    const filteredCareers = careerOptions.filter(career => career.toLowerCase().includes(inputVal));
                    if (filteredCareers.length === 0) {
                        suggestionList.classList.add('hidden');
                        return;
                    }
                    filteredCareers.forEach(career => {
                        const li = document.createElement('li');
                        li.textContent = career;
                        li.className = 'p-2 cursor-pointer hover:bg-blue-100';
                        li.addEventListener('click', function() {
                            citaCitaInput.value = career;
                            suggestionList.classList.add('hidden');
                        });
                        suggestionList.appendChild(li);
                    });
                    suggestionList.classList.remove('hidden');
                });

                document.addEventListener('click', function(e) {
                    if (!suggestionList.contains(e.target) && e.target !== citaCitaInput) {
                        suggestionList.classList.add('hidden');
                    }
                });
            </script>



            <div class="mb-6 bg-pink-light p-4 rounded-lg text-gray-700">
                <p class="text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block text-pink-primary mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                    Tekan tombol "Dapatkan Rekomendasi" untuk memproses data dan mendapatkan rekomendasi jurusan yang sesuai dengan profil kamu.
                </p>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn-primary" id="submitButton">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Dapatkan Rekomendasi
                </button>
            </div>




            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Animation for initial load
                    gsap.from(".form-header", {
                        duration: 1,
                        y: -50,
                        opacity: 0,
                        ease: "power3.out"
                    });
                    gsap.from("#card1", {
                        duration: 0.8,
                        y: 30,
                        opacity: 0,
                        delay: 0.4,
                        ease: "back.out(1.4)"
                    });

                    const totalSteps = 4;
                    let currentStep = 1;

                    // Next step buttons
                    document.querySelectorAll('.next-step').forEach(btn => {
                        btn.addEventListener('click', function() {
                            const step = parseInt(this.getAttribute('data-step'));
                            const nextStep = step + 1;

                            // Validate current step
                            if (validateStep(step)) {
                                // Update progress
                                currentStep = nextStep;
                                updateProgress(currentStep);

                                // Hide current step, show next step
                                document.getElementById(`step${step}`).classList.remove('active');
                                document.getElementById(`step${nextStep}`).classList.add('active');

                                // Animate the transition
                                const nextCard = document.getElementById(`card${nextStep}`);
                                gsap.fromTo(nextCard, {
                                    y: 30,
                                    opacity: 0
                                }, {
                                    duration: 0.5,
                                    y: 0,
                                    opacity: 1,
                                    ease: "back.out(1.4)"
                                });
                            }
                        });
                    });

                    // Previous step buttons
                    document.querySelectorAll('.prev-step').forEach(btn => {
                        btn.addEventListener('click', function() {
                            const step = parseInt(this.getAttribute('data-step'));
                            const prevStep = step - 1;

                            // Update progress
                            currentStep = prevStep;
                            updateProgress(currentStep);

                            // Hide current step, show previous step
                            document.getElementById(`step${step}`).classList.remove('active');
                            document.getElementById(`step${prevStep}`).classList.add('active');

                            // Animate the transition
                            const prevCard = document.getElementById(`card${prevStep}`);
                            gsap.fromTo(prevCard, {
                                y: -30,
                                opacity: 0
                            }, {
                                duration: 0.5,
                                y: 0,
                                opacity: 1,
                                ease: "back.out(1.4)"
                            });
                        });
                    });

                    // Update progress indicator
                    function updateProgress(step) {
                        // Update progress bar
                        const progressBar = document.querySelector('.progress-fill');
                        progressBar.style.width = `${(step / totalSteps) * 100}%`;

                        // Update step indicators
                        for (let i = 1; i <= totalSteps; i++) {
                            const stepIndicator = document.getElementById(`step-${i}`);

                            if (i < step) {
                                stepIndicator.classList.remove('active', 'inactive');
                                stepIndicator.classList.add('completed');
                                stepIndicator.innerHTML = '✓';
                            } else if (i === step) {
                                stepIndicator.classList.remove('inactive', 'completed');
                                stepIndicator.classList.add('active');
                                stepIndicator.innerHTML = i;
                            } else {
                                stepIndicator.classList.remove('active', 'completed');
                                stepIndicator.classList.add('inactive');
                                stepIndicator.innerHTML = i;
                            }
                        }
                    }

                    // Form validation for each step
                    function validateStep(step) {
                        let isValid = true;

                        switch (step) {
                            case 1:
                                const nama = document.getElementById('nama').value;
                                const nilai = document.getElementById('nilai').value;

                                if (!nama || !nilai) {
                                    isValid = false;
                                    showError('Harap isi semua field di langkah 1');
                                } else if (nilai < 0 || nilai > 100) {
                                    isValid = false;
                                    showError('Nilai harus dalam rentang 0-100');
                                }
                                break;
                            case 2:
                                const hobi = document.getElementById('hobi').value;
                                if (!hobi) {
                                    isValid = false;
                                    showError('Harap isi hobi dan minat kamu');
                                }
                                break;
                            case 3:
                                const mapel = document.getElementById('mapel_favorit').value;
                                if (!mapel) {
                                    isValid = false;
                                    showError('Harap pilih mata pelajaran favorit');
                                }
                                break;
                        }

                        return isValid;
                    }

                    // Show error message
                    function showError(message) {
                        // Create error element if not exist
                        if (!document.querySelector('.error-message')) {
                            const errorDiv = document.createElement('div');
                            errorDiv.className = 'error-message bg-red-50 text-red-600 p-3 rounded-lg mb-4 text-sm';
                            errorDiv.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <span>${message}</span>
                    `;

                            // Insert before the first form field
                            const currentCard = document.getElementById(`card${currentStep}`);
                            currentCard.insertBefore(errorDiv, currentCard.firstChild.nextSibling);

                            // Animate error message
                            gsap.from('.error-message', {
                                duration: 0.3,
                                y: -10,
                                opacity: 0,
                                ease: "power2.out"
                            });

                            // Remove error after 3 seconds
                            setTimeout(() => {
                                if (document.querySelector('.error-message')) {
                                    gsap.to('.error-message', {
                                        duration: 0.3,
                                        opacity: 0,
                                        y: -10,
                                        onComplete: () => {
                                            document.querySelector('.error-message').remove();
                                        }
                                    });
                                }
                            }, 3000);
                        } else {
                            // Update existing error message
                            document.querySelector('.error-message span').textContent = message;
                        }
                    }

                    // Submit form with loading animation
                    document.getElementById('konsultasiForm').addEventListener('submit', function(e) {
                        const submitBtn = document.getElementById('submitButton');

                        // Validate final step
                        if (!validateStep(4)) {
                            e.preventDefault();
                            return false;
                        }

                        // Change button text and disable
                        submitBtn.innerHTML = '<svg class="animate-spin h-5 w-5 mr-2 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memproses...';
                        submitBtn.disabled = true;

                        // Let the form submit
                        return true;
                    });
                });
            </script>
</body>

</html>
