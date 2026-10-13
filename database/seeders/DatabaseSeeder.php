<?php

namespace Database\Seeders;

use App\Models\JenisKelamin;
use App\Models\Kelas;
use App\Models\PendaftaranOsis;
use App\Models\Siswa;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Empat data master kelas
        $kelas1 = Kelas::create(['nama_kelas' => 'X RPL 1']);
        $kelas2 = Kelas::create(['nama_kelas' => 'X RPL 2']);
        $kelas3 = Kelas::create(['nama_kelas' => 'XI RPL 1']);
        $kelas4 = Kelas::create(['nama_kelas' => 'XI RPL 2']);

        // 2. Dua data master jenis kelamin
        $jkLaki = JenisKelamin::create(['nama' => 'Laki-laki']);
        $jkPerempuan = JenisKelamin::create(['nama' => 'Perempuan']);

        // 3. Dua belas siswa fiktif tersebar pada kelas-kelas di atas
        $siswaList = [
            ['nis' => '1001', 'nama' => 'Aditya Pratama', 'kelas_id' => $kelas1->id, 'jenis_kelamin_id' => $jkLaki->id],
            ['nis' => '1002', 'nama' => 'Budi Santoso', 'kelas_id' => $kelas1->id, 'jenis_kelamin_id' => $jkLaki->id],
            ['nis' => '1003', 'nama' => 'Citra Lestari', 'kelas_id' => $kelas1->id, 'jenis_kelamin_id' => $jkPerempuan->id],
            ['nis' => '1004', 'nama' => 'Dewi Anggraini', 'kelas_id' => $kelas2->id, 'jenis_kelamin_id' => $jkPerempuan->id],
            ['nis' => '1005', 'nama' => 'Eko Prasetyo', 'kelas_id' => $kelas2->id, 'jenis_kelamin_id' => $jkLaki->id],
            ['nis' => '1006', 'nama' => 'Fajar Nugraha', 'kelas_id' => $kelas2->id, 'jenis_kelamin_id' => $jkLaki->id],
            ['nis' => '1007', 'nama' => 'Gita Permata', 'kelas_id' => $kelas3->id, 'jenis_kelamin_id' => $jkPerempuan->id],
            ['nis' => '1008', 'nama' => 'Hadi Wijaya', 'kelas_id' => $kelas3->id, 'jenis_kelamin_id' => $jkLaki->id],
            ['nis' => '1009', 'nama' => 'Indah Wahyuni', 'kelas_id' => $kelas3->id, 'jenis_kelamin_id' => $jkPerempuan->id],
            ['nis' => '1010', 'nama' => 'Joko Susilo', 'kelas_id' => $kelas4->id, 'jenis_kelamin_id' => $jkLaki->id],
            ['nis' => '1011', 'nama' => 'Kartika Sari', 'kelas_id' => $kelas4->id, 'jenis_kelamin_id' => $jkPerempuan->id],
            ['nis' => '1012', 'nama' => 'Lukman Hakim', 'kelas_id' => $kelas4->id, 'jenis_kelamin_id' => $jkLaki->id],
        ];

        $createdSiswa = [];
        foreach ($siswaList as $data) {
            $createdSiswa[] = Siswa::create($data);
        }

        // 4. Dua data pendaftaran OSIS awal dari siswa yang berbeda
        PendaftaranOsis::create([
            'siswa_id' => $createdSiswa[0]->id, // Siswa 1 (Aditya Pratama)
            'pilihan_bidang' => 'kepemimpinan',
            'motivasi' => 'Ingin melatih kemampuan memimpin dan memajukan kegiatan organisasi sekolah agar lebih aktif dan bermanfaat.',
        ]);

        PendaftaranOsis::create([
            'siswa_id' => $createdSiswa[3]->id, // Siswa 4 (Dewi Anggraini)
            'pilihan_bidang' => 'olahraga',
            'motivasi' => 'Berkomitmen menyelenggarakan kompetisi antarkelas serta meningkatkan kebugaran jasmani seluruh siswa sekolah.',
        ]);
    }
}
