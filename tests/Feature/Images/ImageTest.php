<?php

namespace Tests\Feature\Images;

use App\Models\Image;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use function PHPUnit\Framework\assertNotNull;

class ImageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $path = '/defaults/room-defaults.jpg';
        $data = Storage::disk('public')->get($path);

        $image = Image::first() ??
            Image::create([Image::BINARY => $data]);

        assertNotNull($image);
    }
}
