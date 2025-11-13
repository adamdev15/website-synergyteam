@extends('layouts.admin')

@section('title', 'Dashboard')
@section('sub-title', 'Ringkasan Aktivitas')

@section('content')

<div class="container-fluid px-4">


    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <a class="card lift h-100" href="#!">
                <div class="card-body d-flex justify-content-center flex-column">
                    <div class="me-3">
                        <i class="feather-xl text-primary mb-3" style="color: #0c54b7;" data-feather="package"></i>
                        <h5>Total Penghasilan</h5>
                        <div class="text-muted small">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6">
            <a class="card lift h-100" href="#!">
                <div class="card-body d-flex justify-content-center flex-column">
                    <div class="me-3">
                        <i class="feather-xl text-primary mb-3" style="color: #0c54b7;" data-feather="credit-card"></i>
                        <h5>Total Transaksi</h5>
                        <div class="text-muted small">{{ $totalTransaction }}</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6">
            <a class="card lift h-100" href="#!">
                <div class="card-body d-flex justify-content-center flex-column">
                    <div class="me-3">
                        <i class="feather-xl text-primary mb-3" style="color: #0c54b7;" data-feather="users"></i>
                        <h5>Total Users</h5>
                        <div class="text-muted small">{{ $totalUsers }}</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6">
            <a class="card lift h-100" href="#!">
                <div class="card-body d-flex justify-content-center flex-column">
                    <div class="me-3">
                        <i class="feather-xl text-primary mb-3" style="color: #0c54b7;" data-feather="package"></i>
                        <h5>Total Produk</h5>
                        <div class="text-muted small">{{ $totalProducts }}</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    {{-- GRAFIK --}}
    <div class="card shadow-md mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0 text-primary">Grafik Transaksi</h5>

            <div class="dropdown">
                <a class="btn btn-light dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    Filter
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item filter-chart" data-filter="3days">3 Hari</a></li>
                    <li><a class="dropdown-item filter-chart" data-filter="month">1 Bulan</a></li>
                    <li><a class="dropdown-item filter-chart" data-filter="year">1 Tahun</a></li>
                </ul>
            </div>
        </div>

        <div class="card-body">
            <canvas id="transactionChart" height="100"></canvas>
        </div>
    </div>

    <div class="card shadow-md">
        <div class="card-header text-primary" style="color: #0c54b7;">
            <h5 class="fw-bold">User Baru</h5>
        </div>
        <div class="table-responsive">
            <table id="datatablesSimple" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($latestUsers as $i => $u)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->created_at->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    let chart;

    function loadChart(filter = 'month') {
        fetch(`/admin/dashboard/stats?filter=${filter}`)
            .then(res => res.json())
            .then(data => {
                const ctx = document.getElementById('transactionChart').getContext('2d');

                if (chart) chart.destroy();

                chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: 'Total Transaksi',
                            data: data.values,
                            borderColor: '#0c54b7',
                            backgroundColor: 'rgba(12, 84, 183, 0.2)',
                            tension: 0.4,
                            borderWidth: 3
                        }]
                    }
                });
            });
    }

    loadChart();

    document.querySelectorAll('.filter-chart').forEach(btn => {
        btn.addEventListener('click', function() {
            loadChart(this.getAttribute('data-filter'));
        });
    });
</script>

@endsection