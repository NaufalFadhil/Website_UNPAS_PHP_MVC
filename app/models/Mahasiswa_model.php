<?php
// CLASS MODEL MAHASISWA
// MENGATUR CRUD DATABASE
////////////////////////

// MEMBUAT CLASS
class Mahasiswa_model
{
    // BUAT PROPERTY
    private $table = 'mahasiswa', $db;

    // BUAT OBJEK CONSTRUCTOR
    public function __construct()
    {
        // BUAT OBJEK INSTANSIASI DARI DB   
        $this->db = new Database;
    }

    // METHOD MENGAMBIL SEMUA DATA MAHASISWA 
    public function getAllMahasiswa()
    {
        // PANGGIL DB, PANGGIL QUERY
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    // METHOD MENGAMBIL SEMUA DATA MAHASISWA 
    public function getMahasiswaById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    // METHOD MENAMBAH DATA MAHASISWA
    public function tambahDataMahasiswa($data)
    {
        $query = "INSERT INTO mahasiswa
        VALUES
        ('', :nama, :npm, :email, :fakultas)";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('npm', $data['npm']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('fakultas', $data['fakultas']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    // METHOD MENGHPUS DATA MAHASISWA
    public function hapusDataMahasiswa($id)
    {
        $query = "DELETE FROM mahasiswa WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    // METHOD MENGUBAH DATA MAHASISWA
    public function ubahDataMahasiswa($data)
    {
        $query = "UPDATE mahasiswa SET 
        nama = :nama,
        npm = :npm,
        email = :email,
        fakultas = :fakultas 
        WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('npm', $data['npm']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('fakultas', $data['fakultas']);
        $this->db->bind('id', $data['id']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    // METHOD MENCARI DATA MAHASISWA
    public function cariDataMahasiswa()
    {
        // AMBIL KEYWORD
        $keyword = $_POST['keyword'];
        // AMBIL DATABASE BERDASARKAN SEPERTI KEYWORD
        $query = "SELECT * FROM mahasiswa WHERE nama LIKE :keyword";
        $this->db->query($query);
        // MENENTUKAN PARAMETER
        $this->db->bind('keyword', "%$keyword%");
        return $this->db->resultSet();
    }
}
