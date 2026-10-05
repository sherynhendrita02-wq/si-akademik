<?php

class MahasiswaController extends Controller
{
    private MahasiswaRepository $repository;

    public function __construct(MahasiswaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): void
    {
        $keyword = $_GET['search'] ?? '';

        $data = $this->repository->all($keyword);

        $this->view('mahasiswa/index', [
            'mahasiswa' => $data,
            'keyword' => $keyword
        ]);
    }

    public function create(): void
    {
        $this->view('mahasiswa/create');
    }

    public function store(): void
    {
        $data = [
            'nim' => $_POST['nim'] ?? '',
            'nama' => $_POST['nama'] ?? '',
            'email' => $_POST['email'] ?? '',
            'prodi_id' => $_POST['prodi_id'] ?? '',
            'angkatan' => $_POST['angkatan'] ?? ''
        ];

        $this->repository->create($data);

        $this->redirect('/acara9/public/index.php?route=mahasiswa');
    }

    public function edit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);

        $mahasiswa = $this->repository->find($id);

        if (!$mahasiswa) {
            die('Data mahasiswa tidak ditemukan.');
        }

        $this->view('mahasiswa/edit', [
            'mahasiswa' => $mahasiswa
        ]);
    }

    public function update(): void
    {
        $id = (int) ($_POST['id'] ?? 0);

        $data = [
            'nim' => $_POST['nim'] ?? '',
            'nama' => $_POST['nama'] ?? '',
            'email' => $_POST['email'] ?? '',
            'prodi_id' => $_POST['prodi_id'] ?? '',
            'angkatan' => $_POST['angkatan'] ?? ''
        ];

        $this->repository->update($id, $data);

        $this->redirect('/acara9/public/index.php?route=mahasiswa');
    }

    public function delete(): void
    {
        $id = (int) ($_GET['id'] ?? 0);

        $this->repository->delete($id);

        $this->redirect('/acara9/public/index.php?route=mahasiswa');
    }
}