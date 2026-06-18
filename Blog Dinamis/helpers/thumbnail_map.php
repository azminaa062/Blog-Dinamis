<?php
/**
 * Peta thumbnail Unsplash per artikel — foto dipilih sesuai topik artikel.
 * Semua foto dari Unsplash (bebas lisensi, selalu tampil).
 */
function get_article_thumbnail(int $article_id, string $judul = '', int $category_id = 0, string $size = 'hero'): string {
    $w = ($size === 'hero') ? 900 : 400;
    $h = ($size === 'hero') ? 500 : 260;
    $q = 80;

    // Peta per artikel ID → foto Unsplash yang sesuai topik
    $map = [
        // Belajar PHP Dasar
        9  => 'photo-1461749280684-dccba630e2f6',
        // AI dan Masa Depan UMKM
        15 => 'photo-1677442135703-1787eea5ce01',
        // Fashion Trends 2026
        16 => 'photo-1558769132-cb1aea458c5e',
        // Self Improvement
        17 => 'photo-1499750310107-5fef28a66643',
        // Financial Tips
        18 => 'photo-1554224155-6726b3ff858f',
        // Backpacking Budget
        19 => 'photo-1501854140801-50d01698950b',
        // Hidden Gems Indonesia
        20 => 'photo-1518548419970-58e3b4079ab2',
        // Travel Tips
        21 => 'photo-1488085061387-422e29b40080',
        // Resep Nusantara
        22 => 'photo-1563245372-f21724e3856d',
        // Street Food Indonesia
        23 => 'photo-1504674900247-0877df9cc836',
        // Web Development
        24 => 'photo-1461749280684-dccba630e2f6',
        // Digital Marketing UMKM
        25 => 'photo-1432888498266-38ffec3eaf0a',
        // Branding UMKM
        26 => 'photo-1493421419110-74f4e85ba126',
    ];

    if (isset($map[$article_id])) {
        $photo = $map[$article_id];
        return "https://images.unsplash.com/{$photo}?w={$w}&h={$h}&q={$q}&auto=format&fit=crop";
    }

    // Fallback by category
    $cat_map = [
        2 => 'photo-1452860606245-08befc0ff44b', // Hobi
        3 => 'photo-1556742049-0cfed4f6a45d', // UMKM
        4 => 'photo-1488085061387-422e29b40080', // Traveling
        5 => 'photo-1504674900247-0877df9cc836', // Kuliner
        6 => 'photo-1499750310107-5fef28a66643', // Lifestyle
        7 => 'photo-1518770660439-4636190af475', // Teknologi
    ];

    if ($category_id && isset($cat_map[$category_id])) {
        $photo = $cat_map[$category_id];
        return "https://images.unsplash.com/{$photo}?w={$w}&h={$h}&q={$q}&auto=format&fit=crop";
    }

    // Ultimate fallback
    return "https://images.unsplash.com/photo-1499750310107-5fef28a66643?w={$w}&h={$h}&q={$q}&auto=format&fit=crop";
}
