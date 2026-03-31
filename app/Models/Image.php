<?php

namespace App\Models;

use App\Casts\StorageImageCasts;
use App\Traits\Attributes\HasIdentifier;
use App\Traits\HasBasicAudit;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * @use HasBasicAudit<App\Traits\Audit\HasBasicAudit> 
     * @use HasIdentifier<App\Traits\Attributes\HasIdentifier> 
     * 
     */
    use HasIdentifier,
        HasBasicAudit;

    public const TABLE_NAME = "sipr_images";
    public const NAME = 'name';
    public const DESCRIPTION = 'description';
    public const BINARY = 'binary';

    protected $table = self::TABLE_NAME;
    protected $primaryKey = self::ID;
    protected $keyType = "int";
    public $incrementing = true;
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        self::NAME,
        self::DESCRIPTION,
        self::BINARY,
        self::ID,
        self::CREATED_AT,
        self::UPDATED_AT
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        self::BINARY => StorageImageCasts::class,
    ];


    public function rooms()
    {
        return $this->belongsToMany(
            Room::class,                // Model tujuan
            RoomHasImages::TABLE_NAME,     // Nama tabel pivot
            RoomHasImages::IMAGE_ID,                  // Foreign key di tabel pivot untuk Image
            RoomHasImages::ROOM_ID,                 // Foreign key di tabel pivot untuk Room
        )
            ->withPivot(RoomHasImages::CREATED_AT)      // Mengambil kolom created_at dari tabel pivot
            ->withTimestamps();            // Memastikan pivot timestamps ditangani otomatis
    }
}
