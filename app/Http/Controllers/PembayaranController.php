<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $testimonis = Testimoni::latest()->get();
        $subcategories = Subcategory::with('products')->get();
        $steps = [
            [
                'number' => '01',
                'title' => 'PILIH PAKET LAYANAN',
                'description' => 'Pilih paket layanan kami yang paling sesuai dengan kebutuhan Anda',
                'bgColor' => '#4ECDC4',
                'image' => 'pemesanan/pemesanan-1.png',
            ],
            [
                'number' => '02',
                'title' => 'PILIH DENGAN KLIK TOMBOL',
                'description' => 'Pilih layanan yang sesuai, klik Tombol Hubungi Admin. Jika tersedia, Klik Tombol Order.',
                'bgColor' => '#45B7D1',
                'image' => 'pemesanan/pemesanan-2.png',
            ],
            [
                'number' => '03',
                'title' => 'OTOMATIS MASUK KE WHATSAPP',
                'description' => 'Silahkan Menuju situs Whatsapp Anda, Chat Pesan akan ditujukan ke Admin SynergyTeam.id informasi yang akurat dan lengkap',
                'bgColor' => '#96CEB4',
                'image' => 'pemesanan/pemesanan-3.png',
            ],
            [
                'number' => '04',
                'title' => 'LAKUKAN PEMESANAN',
                'description' => 'Lakukan pemesanan Layanan Melalui Whatsapp Admin SynergyTeam.id dan lakukan pembayaran sesuai dengan layanan yang dipilih',
                'bgColor' => '#fe5757ff',
                'image' => 'pemesanan/pemesanan-4.png',
            ],
        ];
        return view('pembayaran', compact('subcategories','testimonis','steps'));
    }
}
