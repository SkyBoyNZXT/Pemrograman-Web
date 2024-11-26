<?php
session_start();
include 'koneksi.php'; // Sertakan file koneksi

// Pastikan ID ada dalam URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data berdasarkan ID
    $stmt = $conn->prepare("DELETE FROM naruto_characters WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: tampil.php?msg=Data berhasil dihapus");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
    $stmt->close();
} else {
    echo "ID tidak ditemukan dalam URL.";
}

$conn->close();
?>
