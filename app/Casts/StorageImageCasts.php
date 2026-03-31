<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class StorageImageCasts implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        $show_images = env('IMAGE_SHOW') ?? false;

        if ($show_images) {
            // 1. Cek apakah kolom di database null atau kosong

            $images_default = env('IMAGE_DEFAULT') ?? false;
            if (empty($value) && $images_default) {
                // Mengambil gambar default dari folder storage/app/public/defaults/room-defaults-1.jpg
                $path = '/defaults/room-defaults-1.jpg';
                $data = Storage::disk('public')->get($path);
                $type = Storage::disk('public')->mimeType($path);
    
                $base64 = 'data:' . $type . ';base64,' . base64_encode($data);
    
                return $base64;
            }
    
            // 2. Jika ada isinya (Data BLOB), ubah menjadi Base64 Data URI
            // Kita perlu mendeteksi tipe filenya (mime type), di sini saya contohkan image/png atau image/jpeg
            $base64 = base64_encode($value);
    
            // Mengembalikan string yang bisa langsung masuk ke tag <img src="...">
            return 'data:image/png;base64,' . $base64;
        }

        return null;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return $value;
    }
}
