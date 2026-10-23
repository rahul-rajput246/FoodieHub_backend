<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;



class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;
    use HasRoles;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_image',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var list<string>
     */
    protected $appends = [
        'profile_image_url',
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

    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }   

    // New relationship for cart items

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function wishlistItems()
    {
        return $this->hasMany(WishlistItem::class);
    }

    /**
     * Send the password reset notification with FoodieHub branding.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\FoodieHubResetPasswordNotification($token));
    }

    /**
     * Get the resolved URL for the user's profile image with multiple fallbacks.
     */
    public function getProfileImageUrlAttribute(): string
    {
        $fallbackAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($this->name ?: 'User') . '&background=ff7e00&color=fff';

        if (empty($this->user_image)) {
            return $fallbackAvatar;
        }

        // Absolute URL (external or cloud storage)
        if (str_starts_with($this->user_image, 'http://') || str_starts_with($this->user_image, 'https://')) {
            return $this->user_image;
        }

        $cleanPath = ltrim($this->user_image, '/');

        // Check if directly in public/ (e.g. assets/images/... or uploads/...)
        if (file_exists(public_path($cleanPath))) {
            return asset($cleanPath);
        }

        $baseName = basename($cleanPath);

        // Check if in public/assets/images/
        if (file_exists(public_path('assets/images/' . $baseName))) {
            return asset('assets/images/' . $baseName);
        }

        // Check if in public/uploads/
        if (file_exists(public_path('uploads/' . $baseName))) {
            return asset('uploads/' . $baseName);
        }

        // Check in storage/app/public/
        if (file_exists(storage_path('app/public/' . $cleanPath))) {
            return asset('storage/' . $cleanPath);
        }

        // If path begins with storage/
        if (str_starts_with($cleanPath, 'storage/')) {
            return asset($cleanPath);
        }

        // Default to storage asset path which our fallback route will catch if needed
        return asset('storage/' . $cleanPath);
    }
}

