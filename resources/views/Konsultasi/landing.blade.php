<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurusanku - Konsultasi Jurusan SMK</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f7f9fc;
            color: #333;
            line-height: 1.6;
        }

        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: #ff6b6b;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
        }

        .nav-link {
            color: #555;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: #ff6b6b;
        }

        .hero {
            text-align: center;
            padding: 5rem 2rem;
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            color: white;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .hero p {
            font-size: 1.2rem;
            max-width: 800px;
            margin: 0 auto 2rem;
        }

        .cta-button {
            display: inline-block;
            background-color: #fff;
            color: #ff6b6b;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            font-weight: bold;
            font-size: 1.1rem;
            text-decoration: none;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(0, 0, 0, 0.15);
        }

        .features {
            padding: 5rem 2rem;
            text-align: center;
            background-color: #fff;
        }

        .section-title {
            font-size: 2.2rem;
            margin-bottom: 3rem;
            position: relative;
            padding-bottom: 1rem;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 25%;
            width: 50%;
            height: 4px;
            background: linear-gradient(90deg, transparent, #ff6b6b, transparent);
        }

        .feature-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 2rem;
            margin-top: 2rem;
        }

        .feature-card {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 2rem;
            flex: 1;
            min-width: 250px;
            max-width: 300px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #ff6b6b;
        }

        .feature-title {
            font-size: 1.2rem;
            margin-bottom: 0.8rem;
        }

        .majors {
            padding: 5rem 2rem;
            background-color: #f7f9fc;
            text-align: center;
        }

        .major-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 2rem;
            margin-top: 2rem;
        }

        .major-card {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            width: 300px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
        }

        .major-card:hover {
            transform: translateY(-5px);
        }

        .major-image {
            height: 180px;
            background-color: #eee;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
            font-size: 1.2rem;
        }

        .major-content {
            padding: 1.5rem;
        }

        .major-title {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .major-desc {
            color: #777;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 2rem;
        }
    </style>
</head>

<body>
    <!-- Di navbar konsultasi/landing.blade.php -->
    <nav class="navbar">
        <a href="{{ route('landing') }}" class="logo">Jurusanku</a>
        <div class="nav-links">
            <a href="{{ route('landing') }}" class="nav-link">Beranda</a>
            <a href="#features" class="nav-link">Fitur</a>
            <a href="#majors" class="nav-link">Jurusan</a>
            <a href="#footer" class="nav-link">Tentang</a>

            <!-- Link login/logout/data admin -->
            @guest
            <a href="{{ route('login') }}" class="nav-link">Login</a>
            @else
            <a href="{{ route('konsultasi.data') }}" class="nav-link">Data</a>
            <a href="{{ route('logout') }}" class="nav-link"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @endguest
        </div>
    </nav>
    <!-- Hero Section -->
    <section class="hero">
        <h1>Temukan Jurusan SMK yang Tepat Untukmu</h1>
        <p>Jurusanku membantu kamu menemukan jurusan SMK yang paling sesuai dengan minat, bakat, dan potensimu agar tidak salah pilih jurusan.</p>
        <a href="{{ route('konsultasi') }}" class="cta-button">Ayo Coba Sekarang</a>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <h2 class="section-title">Mengapa Jurusanku?</h2>
        <div class="feature-container">
            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <h3 class="feature-title">Analisis Potensi</h3>
                <p>Kami menganalisis potensi dan minat kamu berdasarkan data yang kamu berikan.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🎯</div>
                <h3 class="feature-title">Rekomendasi Tepat</h3>
                <p>Dapatkan rekomendasi jurusan yang tepat sesuai dengan kekuatan dan minatmu.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🚀</div>
                <h3 class="feature-title">Masa Depan Cerah</h3>
                <p>Pilih jurusan yang tepat untuk meningkatkan peluang karir masa depanmu.</p>
            </div>
        </div>
    </section>

    <!-- Majors Section -->
    <section class="majors" id="majors">
        <h2 class="section-title">Jurusan SMKN 6 JEMBER</h2>
        <p>Kenali berbagai jurusan SMK yang tersedia untuk pilihan masa depanmu</p>
        <div class="major-container">
            <div class="major-card">
                <div class="major-image">

                <img src = "https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiVAhmKLMFhMd-tcdx33Gf7WRmKZfpzPt4oA-elMnUKNGdKm1EF1cZ2pEO3_nP6OhdTKYrumHqLELrjNFNLv7cHTlYxUgAR2nrZgzjMHkkulC74mDtOmXH_TyKLUfmxWOlIKdQQHt0PbhAuU-MQk8gc_8egzzA0nrnkJjBOK6zr_rXHMM_FMUwtkmxWGGQ/s320-rw/White%20and%20Blue%20Minimalist%20Financial%20Report%20Presentation%20(6).png" height="170px">
                </div>
                <div class="major-content">
                    <h3 class="major-title">Rekayasa Perangkat Lunak (RPL)</h3>
                    <p class="major-desc">Mempelajari teknik pemrograman, pengembangan aplikasi, dan sistem informasi.</p>
                </div>
            </div>
            <div class="major-card">
                <div class="major-image">

                <img src = "https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEh4W-hat-ME7qDdow6J9dmhqcxaaoq6qDF8Vp1ef_6aRN2Os1zw3e5xMZzwz3hp3ppxqqNrfRFMQQ59_ouSp2MAqJYN9D1Zy36QXEz2Hozx3fbEB_GP2jsA9eyE99PkCihyHWRwU6rtT93pfUeXfPMVC07vRh2lHoQdZPlBdv8Tb8xkY87YX6PWiGZLlEo/s320-rw/White%20and%20Blue%20Minimalist%20Financial%20Report%20Presentation.png" height="170px">

                </div>
                <div class="major-content">
                    <h3 class="major-title">Akuntansi</h3>
                    <p class="major-desc">Fokus pada pengelolaan keuangan, pembukuan, dan laporan keuangan perusahaan.</p>
                </div>
            </div>
            <div class="major-card">
                <div class="major-image">

                <img src = "https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjyrJ-OtKtsytU_zjuZUp3BKRKBjV-alQYP9mIB_Pu5Y6JChjVKIXveDXwNcqFUfDzxeHqgIO_2G7hB7N-zTA5qcC7R-PvY8tTOnoT5Bowzk65SLNvUzDnq0UZPK9G5KeFcV_E2gx-sduHVJDcQOOptm7n6dGLnGnK-FvmBC2hkTaAgMERvYQv2_gPA4nA/s320-rw/White%20and%20Blue%20Minimalist%20Financial%20Report%20Presentation%20(4).png" height="170px">

                </div>
                <div class="major-content">
                    <h3 class="major-title">Bisnis Digital</h3>
                    <p class="major-desc">Mempelajari pemasaran digital, e-commerce, dan pengelolaan bisnis online.</p>
                </div>
            </div>
            <div class="major-card">
                <div class="major-image">

                <img src = "https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgtKC9nAOPutE-m4gaddqEQ-ZvjX3F7tk-nPOa824IDEgIv7Hya6LS-_YTW_PWXmqPHNbx5d_1Jp3TzW3VSRkbmkJu3Z60OS2HSWHs25jx1OVgK4oRWpxFeIouEuS9BYgy6X16x7wq5gyQoJAMOLLy6h5ncgThJnJqzL4yXJzi2A1sd8trjfWFRP9ChUpU/s320-rw/White%20and%20Blue%20Minimalist%20Financial%20Report%20Presentation%20(1).png" height="170px">

                </div>
                <div class="major-content">
                    <h3 class="major-title">Desain Komunikasi Visual (DKV)</h3>
                    <p class="major-desc">Belajar tentang desain grafis, multimedia, dan komunikasi visual kreatif.</p>
                </div>
            </div>
            <div class="major-card">
                <div class="major-image">

                <img src = "https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEg-y0AnoYZvBWz86woij9HW2tOjAAXWh4IlPUzKYEjMi2jy8tgXBgv6HNmF1IHOiZ381YevcSHh-8l6k0RgTk5TKRp4KzQA5XYGjKyZcrnoB0530LqaDo2vGymdATG803BVe1QCG4DgBkNxOUGnurMx6mmrLo7YZ-v26u70uGYAK5k2LZSRW4ei4-3ycxQ/s320-rw/White%20and%20Blue%20Minimalist%20Financial%20Report%20Presentation%20(5).png" height="170px">

                </div>
                <div class="major-content">
                    <h3 class="major-title">Kriya Kreatif Batik dan Tekstil (KKBT)</h3>
                    <p class="major-desc">Mengembangkan kreativitas dalam desain batik, pengolahan tekstil, dan produk kriya.</p>
                </div>
            </div>
            <div class="major-card">
                <div class="major-image">

                <img src = "https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjK8f88UY7ORaDLUGDk7f2s89QMZlarOb_An2N1o_5VXrYzEcWi38mpQGwCzgGsfuiexrZjjpsEDJXPGOROkDhoL1Rr99y31djVUon0sV5uShs9EveXhHZCeQDUOVHqG8YOEJtnD4kyUPZyQ8jdjAQVbaOdc7a0MEyPfA1YgD4fW3RRVf96lJATePa8epo/s320-rw/White%20and%20Blue%20Minimalist%20Financial%20Report%20Presentation%20(2).png" height="170px">


                </div>
                <div class="major-content">
                    <h3 class="major-title">Manajemen Perkantoran (MP)</h3>
                    <p class="major-desc">Mendalami administrasi perkantoran, korespondensi, dan manajemen dokumen.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="footer">
        <p>© 2025 Jurusanku - Aplikasi Konsultasi Jurusan SMK</p>
        <p>Dibuat untuk membantu siswa menemukan jurusan yang sesuai dengan potensi dan minat mereka</p>
    </footer>
</body>

</html>
