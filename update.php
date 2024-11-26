<?php
session_start();
include 'koneksi.php'; // Pastikan file koneksi disertakan

// Pastikan id ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data dari form yang akan diupdate
    $name = $_POST['name'];
    $clan = $_POST['clan'];
    $chakra_element = $_POST['chakra_element'];
    $ninja_rank = $_POST['ninja_rank'];
    $special_technique = $_POST['special_technique'];

    // Query update untuk memperbarui data berdasarkan id
    $stmt = $conn->prepare("UPDATE naruto_characters SET name = ?, clan = ?, chakra_element = ?, ninja_rank = ?, special_technique = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $name, $clan, $chakra_element, $ninja_rank, $special_technique, $id);

    if ($stmt->execute()) {
        header("Location: tampil.php?msg=Data berhasil diupdate");
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