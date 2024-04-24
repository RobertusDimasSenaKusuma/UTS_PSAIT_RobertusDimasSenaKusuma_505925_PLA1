<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <!-- Tambahkan link CSS Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold mb-8">Data Mahasiswa</h1>
        <div class="overflow-x-auto mb-4">
            <!-- Tambahkan id "tableBody" di sini -->
            <table id="tableBody" class="table-auto w-full bg-white border border-gray-200 divide-y divide-gray-200">
                <thead class="bg-yellow-500 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium">NIM</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Nama</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Alamat</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Tanggal Lahir</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Kode MK</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Nama MK</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">SKS</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Nilai</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php
                    // Ambil data dari endpoint menggunakan PHP
                    $data = file_get_contents('http://localhost/UTS_PSIT/db/mahasiwado.php');
                    $mahasiswas = json_decode($data, true);

                    // Loop untuk menampilkan data mahasiswa dalam tabel
                    foreach ($mahasiswas as $mahasiswa) {
                        echo '<tr class="hover:bg-gray-100">';
                        echo '<td class="px-6 py-4 whitespace-nowrap">' . $mahasiswa['nim'] . '</td>';
                        echo '<td class="px-6 py-4 whitespace-nowrap">' . $mahasiswa['nama'] . '</td>';
                        echo '<td class="px-6 py-4 whitespace-nowrap">' . $mahasiswa['alamat'] . '</td>';
                        echo '<td class="px-6 py-4 whitespace-nowrap">' . $mahasiswa['tanggal_lahir'] . '</td>';
                        echo '<td class="px-6 py-4 whitespace-nowrap">' . $mahasiswa['kode_mk'] . '</td>';
                        echo '<td class="px-6 py-4 whitespace-nowrap">' . $mahasiswa['nama_mk'] . '</td>';
                        echo '<td class="px-6 py-4 whitespace-nowrap">' . $mahasiswa['sks'] . '</td>';
                        echo '<td class="px-6 py-4 whitespace-nowrap">' . $mahasiswa['nilai'] . '</td>';
                        echo '<td class="px-6 py-4 whitespace-nowrap">';
                        echo '<button class="bg-red-800 hover:bg-red-300 text-white font-bold py-2 px-4 rounded mr-2" onclick="deleteMahasiswa(\'' . $mahasiswa['nim'] . '\', \'' . $mahasiswa['kode_mk'] . '\')">Delete</button>';
                        echo '<a href="update.php?nim=' . $mahasiswa['nim'] . '&kode_mk=' . $mahasiswa['kode_mk'] . '" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Update</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="flex justify-start">
    <a href="insert.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Tambah</a>
</div>

    </div>

    <!-- Tambahkan kode JavaScript di sini -->
    <script>
        function deleteMahasiswa(nim, kode_mk) {
            // Konfirmasi penghapusan
            if (confirm("Apakah Anda yakin ingin menghapus mahasiswa dengan NIM " + nim + " dan KODE MK " + kode_mk + "?")) {
                // Kirim permintaan penghapusan ke endpoint
                fetch('http://localhost/UTS_PSIT/db/mahasiwado.php?nim=' + nim + '&kode_mk=' + kode_mk, {
                        method: 'DELETE'
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Ada masalah saat menghapus mahasiswa.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Tampilkan pesan sukses
                        alert('Mahasiswa berhasil dihapus.');
                        // Refresh halaman setelah penghapusan
                        location.reload();
                    })
                    .catch(error => {
                        // Tampilkan pesan error jika terjadi masalah
                        alert(error.message);
                    });
            }
        }
    </script>
</body>

</html>
