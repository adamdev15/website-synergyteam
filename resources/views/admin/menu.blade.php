@extends('layouts.admin')

@section('title', 'Menu')
@section('sub-title', 'Kelola Menu Produk')

@section('content')
<div class="container-fluid px-4">
    <div class="card mb-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="fw-bold mb-0" style="color: #0c54b7;">Daftar Menu</h4>
            <button id="btnAdd" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Menu
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-bordered align-middle small">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Menu</th>
                            <th>Deskripsi</th>
                            <th>Produk Terkait</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="table-body"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Form Menu -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form id="formMenu">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">Tambah Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body row g-3">
                    <input type="hidden" id="menuId">

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Menu</label>
                        <input type="text" id="name" class="form-control" placeholder="Masukkan nama menu" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Produk Terkait</label>
                        <select id="product_id" class="form-select" required></select>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea id="description" class="form-control" placeholder="Masukkan deskripsi menu" rows="3"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btnSave">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const tableBody = document.getElementById("table-body");
    const modal = new bootstrap.Modal(document.getElementById("modalForm"));
    const form = document.getElementById("formMenu");
    const btnAdd = document.getElementById("btnAdd");
    const productSelect = document.getElementById("product_id");

    let editMode = false;
    let editId = null;

    // Load produk untuk dropdown
    function loadProducts() {
        axios.get("/produk")
            .then(res => {
                productSelect.innerHTML = res.data.map(p =>
                    `<option value="${p.id}">${p.name}</option>`
                ).join("");
            });
    }

    // Load data menu
    function loadMenus() {
        axios.get("/menu")
            .then(res => {
                tableBody.innerHTML = "";
                res.data.forEach((m, i) => {
                    tableBody.innerHTML += `
                        <tr>
                            <td>${i + 1}</td>
                            <td>${m.name}</td>
                            <td>${m.description}</td>
                            <td>${m.product?.name ?? '-'}</td>
                            <td>
                                <button class="btn btn-warning btn-sm me-1" onclick="editMenu(${m.id})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="deleteMenu(${m.id})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>`;
                });
                new simpleDatatables.DataTable("#datatablesSimple");
            });
    }

    loadMenus();
    loadProducts();

    // Tambah
    btnAdd.addEventListener("click", () => {
        editMode = false;
        form.reset();
        document.getElementById("modalFormLabel").textContent = "Tambah Menu";
        modal.show();
    });

    // Simpan
    form.addEventListener("submit", e => {
        e.preventDefault();
        const data = {
            name: document.getElementById("name").value,
            description: document.getElementById("description").value,
            product_id: document.getElementById("product_id").value
        };

        if (!editMode) {
            axios.post("/menu", data)
                .then(() => {
                    modal.hide();
                    Swal.fire("Berhasil!", "Menu berhasil ditambahkan.", "success");
                    loadMenus();
                })
                .catch(() => Swal.fire("Gagal!", "Tidak dapat menambah menu.", "error"));
        } else {
            axios.put(`/menu/${editId}`, data)
                .then(() => {
                    modal.hide();
                    Swal.fire("Berhasil!", "Menu berhasil diperbarui.", "success");
                    loadMenus();
                })
                .catch(() => Swal.fire("Gagal!", "Tidak dapat memperbarui menu.", "error"));
        }
    });

    // Edit
    window.editMenu = (id) => {
        axios.get(`/menu/${id}`)
            .then(res => {
                const m = res.data;
                editMode = true;
                editId = id;
                document.getElementById("modalFormLabel").textContent = "Edit Menu";
                document.getElementById("name").value = m.name;
                document.getElementById("description").value = m.description;
                document.getElementById("product_id").value = m.product_id;
                modal.show();
            });
    };

    // Hapus
    window.deleteMenu = (id) => {
        Swal.fire({
            title: "Yakin ingin menghapus?",
            text: "Data menu akan dihapus permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!"
        }).then(result => {
            if (result.isConfirmed) {
                axios.delete(`/menu/${id}`)
                    .then(() => {
                        Swal.fire("Dihapus!", "Menu berhasil dihapus.", "success");
                        loadMenus();
                    })
                    .catch(() => Swal.fire("Gagal!", "Tidak dapat menghapus menu.", "error"));
            }
        });
    };
});
</script>
@endsection
