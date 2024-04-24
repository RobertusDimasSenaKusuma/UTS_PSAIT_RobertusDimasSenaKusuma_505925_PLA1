<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Headers: Content-Type');
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);

require_once 'koneksi.php'; // File untuk membuat koneksi ke database
switch ($method) {
    case 'GET':
        if (isset($_GET['nim'])) {
            // Menampilkan nilai mahasiswa tertentu (berdasarkan parameter nim)
            $nim = $_GET['nim'];
            $sql = "SELECT * FROM database_perkuliahan WHERE nim = '$nim'";
            $result = $conn->query($sql);
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            echo json_encode($data);
        } else {
            // Menampilkan semua nilai mahasiswa
            $sql = "SELECT * FROM database_perkuliahan";
            $result = $conn->query($sql);
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            echo json_encode($data);
        }
        break;

        case 'POST':
            // Memasukkan nilai baru untuk mahasiswa tertentu
            $data = json_decode(file_get_contents('php://input'), true);
            $nim = $data['nim'];
            $kode_mk = $data['kode_mk'];
            $nilai = $data['nilai'];
            $sql = "INSERT INTO perkuliahan (nim, kode_mk, nilai) VALUES ('$nim', '$kode_mk', '$nilai')";
            if ($conn->query($sql) === TRUE) {
                $response = array('success' => true, 'message' => 'Data nilai berhasil ditambahkan');
            } else {
                $response = array('success' => false, 'message' => 'Gagal menambahkan data nilai: ' . $conn->error);
            }
            echo json_encode($response);
            break;
        


    case 'PUT':
        // Mengupdate nilai (berdasarkan parameter nim dan kode_mk)
        // Pastikan hanya menggunakan metode PUT
        $data = json_decode(file_get_contents('php://input'), true);
if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    http_response_code(405); // Method Not Allowed
    exit();
}

// Mendapatkan data dari body permintaan
$data = json_decode(file_get_contents('php://input'), true);

// Memastikan bahwa data yang dibutuhkan tersedia
if (!isset($data['nim']) || !isset($data['kode_mk']) || !isset($data['nilai'])) {
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Parameter yang diperlukan tidak lengkap.'));
    exit();
}

$nim = $conn->real_escape_string($data['nim']);
$kode_mk = $conn->real_escape_string($data['kode_mk']);
$nilai = $conn->real_escape_string($data['nilai']);

// Query untuk melakukan update nilai
$sql = "UPDATE perkuliahan SET nilai = '$nilai' WHERE nim = '$nim' AND kode_mk = '$kode_mk'";

if ($conn->query($sql) === TRUE) {
    http_response_code(200); // OK
    echo json_encode(array('message' => 'Data nilai berhasil diupdate'));
} else {
    http_response_code(500); // Internal Server Error
    echo json_encode(array('message' => 'Gagal mengupdate data nilai: ' . $conn->error));
}

    case 'DELETE':
        // Menghapus nilai (berdasarkan parameter nim dan kode_mk)
        // Pastikan hanya menggunakan metode DELETE
if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    http_response_code(405); // Method Not Allowed
    exit();
}

// Mendapatkan data dari URL
$nim = isset($_GET['nim']) ? $conn->real_escape_string($_GET['nim']) : '';
$kode_mk = isset($_GET['kode_mk']) ? $conn->real_escape_string($_GET['kode_mk']) : '';

// Memastikan bahwa data yang dibutuhkan tersedia
if ($nim === '' || $kode_mk === '') {
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Parameter yang diperlukan tidak lengkap.'));
    exit();
}

// Query untuk melakukan penghapusan data nilai
$sql = "DELETE FROM perkuliahan WHERE nim = '$nim' AND kode_mk = '$kode_mk'";

if ($conn->query($sql) === TRUE) {
    http_response_code(200); // OK
    echo json_encode(array('message' => 'Data nilai berhasil dihapus'));
} else {
    http_response_code(500); // Internal Server Error
    echo json_encode(array('message' => 'Gagal menghapus data nilai: ' . $conn->error));
}

}

$conn->close();