@extends('layouts.admin')

@section('title', 'Produk')
@section('sub-title', 'Kelola Produk')

@section('content')
<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="fw-bold mb-0 text-primary">Daftar Produk</h4>
            <button id="btnAdd" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Produk
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Thumbnail</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="table-body"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Form Produk -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form id="formProduk" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body row g-3">
                    <input type="hidden" id="produkId">

                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Thumbnail</label>
                        <input type="file" id="thumbnail" name="thumbnail" class="form-control" accept="image/*">
                        <img id="previewThumbnail" class="mt-2 rounded shadow-sm d-none" width="100">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Gambar</label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*">
                        <img id="previewImage" class="mt-2 rounded shadow-sm d-none" width="100">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Produk</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea id="description" name="description" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Link Drive</label>
                        <input type="text" id="link_drive" name="link_drive" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Sub Kategori</label>
                        <select id="sub_category_id" name="sub_category_id" class="form-select" required></select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Harga (Rp)</label>
                        <input type="number" id="price" name="price" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Status</label>
                        <select id="status" name="status" class="form-select">
                            <option value="available">Available</option>
                            <option value="in_progress">In Progress</option>
                            <option value="unavailable">Unavailable</option>
                        </select>
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
    const form = document.getElementById("formProduk");
    const btnAdd = document.getElementById("btnAdd");
    const subCategorySelect = document.getElementById("sub_category_id");

    const previewThumb = document.getElementById("previewThumbnail");
    const previewImg = document.getElementById("previewImage");

    let editMode = false;
    let editId = null;

    // Preview gambar
    document.getElementById("thumbnail").addEventListener("change", e => {
        const file = e.target.files[0];
        if (file) {
            previewThumb.src = URL.createObjectURL(file);
            previewThumb.classList.remove("d-none");
        }
    });
    document.getElementById("image").addEventListener("change", e => {
        const file = e.target.files[0];
        if (file) {
            previewImg.src = URL.createObjectURL(file);
            previewImg.classList.remove("d-none");
        }
    });

    let dataTable = null;

    // Load Subkategori
    function loadSubcategories() {
        axios.get("/subkategori").then(res => {
            subCategorySelect.innerHTML = res.data.map(sub =>
                `<option value="${sub.id}">${sub.name}</option>`
            ).join("");
        }).catch(err => console.error("Gagal memuat kategori:", err));
    }

    // Load Produk
    function loadProducts() {
        tableBody.innerHTML = '<tr><td colspan="7" class="text-center">Memuat data...</td></tr>';
        
        if (dataTable) {
            dataTable.destroy();
        }

        axios.get("/produk").then(res => {
            tableBody.innerHTML = "";
            if (res.data.length === 0) {
                tableBody.innerHTML = '<tr><td colspan="7" class="text-center">Tidak ada produk tersedia.</td></tr>';
                return;
            }

            res.data.forEach((p, i) => {
                tableBody.innerHTML += `
                    <tr>
                        <td class="fw-semibold">${p.name}</td>
                        <td>${p.sub_category?.name ?? '<span class="text-muted">-</span>'}</td>
                        <td class="text-primary fw-bold">Rp ${p.price.toLocaleString('id-ID')}</td>
                        <td><span class="badge bg-${p.status === 'available' ? 'success' : 'secondary'} text-capitalize">${p.status.replace('_', ' ')}</span></td>
                        <td>${p.thumbnail ? `<img src="/storage/${p.thumbnail}" width="50" height="50" class="rounded shadow-sm" style="object-fit:cover;">` : '<span class="text-muted">-</span>'}</td>
                        <td>${p.image ? `<img src="/storage/${p.image}" width="50" height="50" class="rounded shadow-sm" style="object-fit:cover;">` : '<span class="text-muted">-</span>'}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <button class="btn btn-warning btn-sm" onclick="editProduct(${p.id})" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="deleteProduct(${p.id})" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            });
            
            dataTable = new simpleDatatables.DataTable("#datatablesSimple", {
                searchable: true,
                fixedHeight: false,
                labels: {
                    placeholder: "Cari produk...",
                    perPage: "{select} data per halaman",
                    noRows: "Tidak ada data produk",
                    info: "Menampilkan {start} sampai {end} dari {rows} data",
                }
            });
        }).catch(err => {
            tableBody.innerHTML = '<tr><td colspan="7" class="text-center text-danger">Gagal memuat data produk.</td></tr>';
            console.error(err);
        });
    }

    loadProducts();
    loadSubcategories();

    // Tambah
    btnAdd.addEventListener("click", () => {
        editMode = false;
        form.reset();
        previewThumb.classList.add("d-none");
        previewImg.classList.add("d-none");
        document.getElementById("modalFormLabel").textContent = "Tambah Produk";
        modal.show();
    });

    // Simpan Produk
    form.addEventListener("submit", e => {
        e.preventDefault();
        const btnSave = document.getElementById('btnSave');
        btnSave.disabled = true;
        btnSave.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...';

        const formData = new FormData(form);
        let url = editMode ? `/produk/${editId}?_method=PUT` : "/produk";

        axios.post(url, formData, { 
            headers: { 'Content-Type': 'multipart/form-data' } 
        })
        .then(res => {
            modal.hide();
            Swal.fire({
                title: "Berhasil!",
                text: res.data.message,
                icon: "success",
                timer: 2000,
                showConfirmButton: false
            });
            loadProducts();
        })
        .catch(err => {
            let errorMsg = 'Terjadi kesalahan saat menyimpan produk.';
            if (err.response && err.response.data && err.response.data.errors) {
                errorMsg = Object.values(err.response.data.errors).flat().join('<br>');
            } else if (err.response && err.response.data && err.response.data.message) {
                errorMsg = err.response.data.message;
            }
            Swal.fire({
                title: "Gagal!",
                html: errorMsg,
                icon: "error"
            });
        })
        .finally(() => {
            btnSave.disabled = false;
            btnSave.innerHTML = "Simpan";
        });
    });

    // Edit Produk
    window.editProduct = (id) => {
        axios.get(`/produk/${id}`).then(res => {
            const p = res.data;
            editMode = true;
            editId = id;
            document.getElementById("modalFormLabel").textContent = "Edit Produk";
            document.getElementById("name").value = p.name;
            document.getElementById("sub_category_id").value = p.sub_category_id;
            document.getElementById("price").value = p.price;
            document.getElementById("description").value = p.description;
            document.getElementById("status").value = p.status;
            document.getElementById("link_drive").value = p.link_drive;

            if (p.thumbnail) {
                previewThumb.src = "/storage/" + p.thumbnail;
                previewThumb.classList.remove("d-none");
            } else {
                previewThumb.classList.add("d-none");
            }
            if (p.image) {
                previewImg.src = "/storage/" + p.image;
                previewImg.classList.remove("d-none");
            } else {
                previewImg.classList.add("d-none");
            }

            modal.show();
        }).catch(err => {
            Swal.fire("Error", "Gagal mengambil data produk.", "error");
        });
    };

    // Hapus Produk
    window.deleteProduct = (id) => {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data produk ini akan dihapus secara permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal"
        }).then(result => {
            if (result.isConfirmed) {
                axios.delete(`/produk/${id}`)
                    .then(res => {
                        Swal.fire({
                            title: "Terhapus!",
                            text: res.data.message,
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false
                        });
                        loadProducts();
                    })
                    .catch(() => {
                        Swal.fire("Gagal!", "Tidak dapat menghapus produk.", "error");
                    });
            }
        });
    };
});
</script>
@endsection
