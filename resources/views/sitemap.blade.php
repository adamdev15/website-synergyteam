<?php echo '<?' . 'xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 
                            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ \Carbon\Carbon::parse(date('Y-m-d H:i:s'))->toIso8601String() }}</lastmod>
        <priority>1.00</priority>
    </url>

    <url><loc>{{ url('/tentang-kami') }}</loc><lastmod>{{ \Carbon\Carbon::parse(date('Y-m-d H:i:s'))->toIso8601String() }}</lastmod><priority>0.80</priority></url>
    <url><loc>{{ url('/testimoni') }}</loc><lastmod>{{ \Carbon\Carbon::parse(date('Y-m-d H:i:s'))->toIso8601String() }}</lastmod><priority>0.80</priority></url>
    <url><loc>{{ url('/jasa-coding') }}</loc><lastmod>{{ \Carbon\Carbon::parse(date('Y-m-d H:i:s'))->toIso8601String() }}</lastmod><priority>0.80</priority></url>
    <url><loc>{{ url('/pembuatan-website') }}</loc><lastmod>{{ \Carbon\Carbon::parse(date('Y-m-d H:i:s'))->toIso8601String() }}</lastmod><priority>0.80</priority></url>
    <url><loc>{{ url('/api-integration') }}</loc><lastmod>{{ \Carbon\Carbon::parse(date('Y-m-d H:i:s'))->toIso8601String() }}</lastmod><priority>0.80</priority></url>
    <url><loc>{{ url('/hosting-domain') }}</loc><lastmod>{{ \Carbon\Carbon::parse(date('Y-m-d H:i:s'))->toIso8601String() }}</lastmod><priority>0.80</priority></url>
    <url><loc>{{ url('/tugas-akhir') }}</loc><lastmod>{{ \Carbon\Carbon::parse(date('Y-m-d H:i:s'))->toIso8601String() }}</lastmod><priority>0.80</priority></url>
    <url><loc>{{ url('/promo') }}</loc><lastmod>{{ \Carbon\Carbon::parse(date('Y-m-d H:i:s'))->toIso8601String() }}</lastmod><priority>0.80</priority></url>
    <url><loc>{{ url('/pemesanan') }}</loc><lastmod>{{ \Carbon\Carbon::parse(date('Y-m-d H:i:s'))->toIso8601String() }}</lastmod><priority>0.80</priority></url>
    <url><loc>{{ url('/pembayaran') }}</loc><lastmod>{{ \Carbon\Carbon::parse(date('Y-m-d H:i:s'))->toIso8601String() }}</lastmod><priority>0.80</priority></url>
    <url><loc>{{ url('/faq') }}</loc><lastmod>{{ \Carbon\Carbon::parse(date('Y-m-d H:i:s'))->toIso8601String() }}</lastmod><priority>0.80</priority></url>
    <url><loc>{{ url('/kontak-kami') }}</loc><lastmod>{{ \Carbon\Carbon::parse(date('Y-m-d H:i:s'))->toIso8601String() }}</lastmod><priority>0.80</priority></url>
    <url><loc>{{ url('/login') }}</loc><lastmod>{{ \Carbon\Carbon::parse(date('Y-m-d H:i:s'))->toIso8601String() }}</lastmod><priority>0.80</priority></url>

    @foreach($products as $product)
        <url>
            <loc>{{ url('/produk/'.$product->id) }}</loc>
            <lastmod>{{ \Carbon\Carbon::parse($product->updated_at)->toIso8601String() }}</lastmod>
            <priority>0.80</priority>
        </url>
        <url>
            <loc>{{ url('/produk-detail/'.$product->id) }}</loc>
            <lastmod>{{ \Carbon\Carbon::parse($product->updated_at)->toIso8601String() }}</lastmod>
            <priority>0.64</priority>
        </url>
    @endforeach

</urlset>
