<?php

namespace App\Models;

use App\Enums\UserRole;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Cashier\Billable;

/**
 * @property string $name
 * @property string $email
 * @property UserRole $role
 * @property string $rfc
 * @property string $phone
 * @property string $address
 *
 * @property Collection<int, ServiceOrders> $serviceOrders
 * @property Collection<int, Motorcycle> $motorcycles
 */
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'rfc',
        'phone',
        'address',
    ];

    protected $casts = [
        'role' => UserRole::class,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function serviceOrders(): HasMany
    {
        return $this->hasMany(ServiceOrders::class, 'client_id');
    }

    public function motorcycles(): HasMany
    {
        return $this->hasMany(Motorcycle::class, 'id_cliente');
    }
}
