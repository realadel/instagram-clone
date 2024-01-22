<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'bio',
        'avatar',
        'password',
        'isPrivate'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function following(): BelongsToMany
    {
        return $this->belongsToMany(self::class, 'follows', 'follower_id', 'following_id')
            ->withTimestamps()
            ->withPivot('accepted');
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(self::class, 'follows', 'following_id', 'follower_id')
            ->withTimestamps()
            ->withPivot('accepted');
    }

    public function follow(self $user): void
    {
        if (!$user->isPrivate){
            $this->following()
                ->attach($user, ['accepted' => true]);
        }else {
            $this->following()
                ->attach($user);
        }
    }

    public function unfollow(self $user): void
    {
        $this->following()
            ->detach($user);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'likes');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function suggested_users(): Collection
    {
        return self::whereNot('id', auth()->id())
            ->inRandomOrder()
            ->take(5)
            ->get();
    }

}
