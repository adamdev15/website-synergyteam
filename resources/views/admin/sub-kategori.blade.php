@extends('layouts.admin')

@section('title', 'Subkategori')
@section('sub-title', 'Kelola Subkategori Produk')

@section('content')
<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
            <h2 class="fw-bold" style="color: #0c54b7;"></h2>
            <button id="btnAdd" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Subkategori
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatablesSimple" class="table  table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Thumnail</th>
                            <th>Nama</th>
                            <th>Label</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="table-body"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Tambah/Edit --}}
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="formSubkategori">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">Tambah Subkategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="subId">
                    <div class="col-md-6">
                            <label class="form-label">Thumbnail</label>
                            <input type="file" id="thumbnail" name="thumbnail" class="form-control" accept="image/*">
                            <div class="mt-2">
                                <img id="previewImage" src="" alt="" class="img-thumbnail d-none" style="max-height: 120px;">
                            </div>
                        </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Subkategori</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama subkategori" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Label</label>
                        <textarea id="label" name="label" class="form-control" placeholder="Masukkan label subkategori" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Masukkan deskripsi" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="public">Public</option>
                            <option value="draft">Draft</option>
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
document.addEventListener('DOMContentLoaded', function() {
    const modal = new bootstrap.Modal(document.getElementById('modalForm'));
    const form = document.getElementById('formSubkategori');
    const tableBody = document.getElementById('table-body');
    const preview = document.getElementById('previewImage');

    let editMode = false;

    // 🔹 Preview gambar saat upload
    document.getElementById('thumbnail').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(evt) {
                preview.src = evt.target.result;
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        }
    });

    // 🔹 Load Data
    function loadSubcategories() {
        axios.get("{{ route('subkategori.index') }}").then(res => {
            tableBody.innerHTML = "";
            res.data.forEach((item, index) => {
                const thumb = item.thumbnail ? `<img src="/storage/${item.thumbnail}" class="img-thumbnail" style="max-height:50px;">` : `<span class="text-muted">No Image</span>`;
                tableBody.innerHTML += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${thumb}</td>
                        <td>${item.name}</td>
                        <td>${item.label ?? '-'}</td>
                        <td>${item.description ?? '-'}</td>
                        <td><span class="badge bg-${item.status === 'public' ? 'success' : 'secondary'}">${item.status}</span></td>
                        <td>
                            <button class="btn btn-sm btn-warning me-1" onclick="editSubcategory(${item.id})">Edit</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteSubcategory(${item.id})">Hapus</button>
                        </td>
                    </tr>
                `;
            });
        });
    }

    loadSubcategories();

    // 🔹 Tambah
    document.getElementById('btnAdd').addEventListener('click', () => {
        editMode = false;
        form.reset();
        preview.src = '';
        preview.classList.add('d-none');
        document.getElementById('subId').value = '';
        document.getElementById('modalFormLabel').textContent = 'Tambah Subkategori';
        modal.show();
    });

    // 🔹 Submit Form
    form.addEventListener('submit', e => {
        e.preventDefault();
        const formData = new FormData(form);
        const id = document.getElementById('subId').value;

        let url = "{{ route('subkategori.store') }}";
        let method = 'post';
        if (editMode) {
            url = `/subkategori/${id}`;
            method = 'post';
            formData.append('_method', 'PUT');
        }

        axios({
            method: method,
            url: url,
            data: formData,
            headers: { 'Content-Type': 'multipart/form-data' }
        })
        .then(res => {
            Swal.fire('Berhasil!', res.data.message, 'success');
            modal.hide();
            loadSubcategories();
        })
        .catch(err => {
            Swal.fire('Error!', 'Terjadi kesalahan saat menyimpan.', 'error');
            console.error(err);
        });
    });

    // 🔹 Edit
    window.editSubcategory = function(id) {
        axios.get(`/subkategori/${id}`).then(res => {
            const item = res.data;
            editMode = true;
            document.getElementById('subId').value = item.id;
            document.getElementById('name').value = item.name;
            document.getElementById('label').value = item.label;
            document.getElementById('description').value = item.description;
            document.getElementById('status').value = item.status;

            if (item.thumbnail) {
                preview.src = `/storage/${item.thumbnail}`;
                preview.classList.remove('d-none');
            } else {
                preview.classList.add('d-none');
            }

            document.getElementById('modalFormLabel').textContent = 'Edit Subkategori';
            modal.show();
        });
    }

    // 🔹 Hapus
    window.deleteSubcategory = function(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: 'Data yang dihapus tidak dapat dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/subkategori/${id}`).then(res => {
                    Swal.fire('Terhapus!', res.data.message, 'success');
                    loadSubcategories();
                });
            }
        });
    }
});
</script>

@endsection