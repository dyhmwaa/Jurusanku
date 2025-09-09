<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konsultasi;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class KonsultasiController extends Controller
{
    public function index()
    {
        return view('konsultasi.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'hobi' => 'required',
            'mapel_favorit' => 'required',
            'nilai' => 'required|numeric|min:0|max:100',
            'cita_cita' => 'required',
        ]);

        $konsultasi = Konsultasi::create($data);

        // Ambil API key dari environment variable
        $apiKey = env('GEMINI_API_KEY');

        if (!$apiKey) {
            Log::error('Gemini API Key not configured');
            $konsultasi->update(['hasil_ai' => 'Error: API Key tidak dikonfigurasi']);
            return redirect('/hasil/' . $konsultasi->id);
        }

        // Buat prompt
        $prompt = "Kamu adalah sistem penasihat jurusan SMK.
        Nama: {$data['nama']}
        Nilai: {$data['nilai']}
        Hobi: {$data['hobi']}
        Mapel Favorit: {$data['mapel_favorit']}
        Cita-cita: {$data['cita_cita']}
        Jurusan tersedia: Rekayasa Perangkat Lunak, DKV, Pemasaran, Akuntansi, Manajemen Perkantoran, KKBT(Kriya Kreatif Batik dan Textil).
        Buat analisis singkat, rekomendasi 3 jurusan terbaik + alasannya, persentase, dan saran tambahan.
        Format jawab: HTML dengan <div>, <h3>, <p>, <ul>. dan hilangkan tanda (* ,```,',''')";

        try {
            // Coba dengan model gemini-pro
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->timeout(30)->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ],
                        'role' => 'user'
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.7,
                    'maxOutputTokens' => 1000,
                    'topP' => 0.95,
                    'topK' => 40
                ],
                'safetySettings' => [
                    [
                        'category' => 'HARM_CATEGORY_HARASSMENT',
                        'threshold' => 'BLOCK_ONLY_HIGH'
                    ],
                    [
                        'category' => 'HARM_CATEGORY_HATE_SPEECH',
                        'threshold' => 'BLOCK_ONLY_HIGH'
                    ],
                ]
            ]);

            $responseData = $response->json();

            // Logging untuk debugging
            Log::info('Gemini API Response', ['response' => $responseData]);

            // Periksa struktur respons dan ekstrak teks
            if (isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
                $hasil = $responseData['candidates'][0]['content']['parts'][0]['text'];
            } elseif (isset($responseData['candidates'][0]['text'])) {
                $hasil = $responseData['candidates'][0]['text'];
            } elseif (isset($responseData['text'])) {
                $hasil = $responseData['text'];
            } elseif (isset($responseData['candidates'][0]['content']['text'])) {
                $hasil = $responseData['candidates'][0]['content']['text'];
            } else {
                // Jika tidak ada teks yang ditemukan, log error
                Log::error('Gemini API Error: Format respons tidak valid', ['response' => $responseData]);

                if (isset($responseData['error'])) {
                    $hasil = 'Error: ' . $responseData['error']['message'];
                } else {
                    $hasil = 'Tidak dapat menghasilkan rekomendasi. Silakan coba lagi.';
                }
            }
        } catch (\Exception $e) {
            // Log error
            Log::error('Gemini API Exception: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'line' => $e->getLine()
            ]);
            $hasil = 'Terjadi kesalahan saat berkomunikasi dengan AI: ' . $e->getMessage();
        }

        $konsultasi->update(['hasil_ai' => $hasil]);

        return redirect('/hasil/' . $konsultasi->id);
    }

    public function show($id)
    {
        $data = Konsultasi::findOrFail($id);
        return view('konsultasi.hasil', compact('data'));
    }

    public function data()
    {
        $data = Konsultasi::latest()->get();
        return view('konsultasi.data', compact('data'));
    }

    public function destroy($id)
    {
        Konsultasi::destroy($id);
        return redirect('/data')->with('success', 'Data berhasil dihapus!');
    }

    public function download()
    {
        $data = Konsultasi::all(); // Modelmu
        $pdf = Pdf::loadView('konsultasi.data_pdf', compact('data'));
        return $pdf->download('data_konsultasi.pdf');
    }
}
