<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\Attributes\HasIdentifier;
use App\Traits\HasBasicAudit;
use App\Traits\Relation\HasRelationWithRoleModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** 
     * @use HasFactory<\Database\Factories\UserFactory> 
     * 
     */
    use HasFactory,
        HasIdentifier,
        HasRelationWithRoleModel,
        HasBasicAudit,
        Notifiable;

    public const TABLE_NAME = 'users';
    public const NAME = 'name';
    public const EMAIL = 'email';
    public const EMAIL_VERIFIED_AT = 'email_verified_at';
    public const PASSWORD = 'password';
    public const REMEMBER_TOKEN = 'remember_token';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        self::ID,
        self::NAME,
        self::EMAIL,
        self::PASSWORD,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        self::PASSWORD,
        self::REMEMBER_TOKEN,
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            self::EMAIL_VERIFIED_AT => 'datetime',
            self::PASSWORD => 'hashed',
        ];
    }

    // app/Models/User.php

    public function roles()
    {
        return $this->belongsToMany(
            Role::class,                // Model tujuan
            UserHasRole::TABLE_NAME,     // Nama tabel pivot
            UserHasRole::USER_ID,                 // Foreign key di tabel pivot untuk User
            UserHasRole::ROLE_ID                  // Foreign key di tabel pivot untuk Role
        )
            ->withPivot(UserHasRole::CREATED_AT)      // Mengambil kolom created_at dari tabel pivot
            ->withTimestamps();            // Memastikan pivot timestamps ditangani otomatis
    }
}
