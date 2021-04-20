<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'accountId',
        'role',
        'firstName',
        'middleName',
        'lastName',
        'contactNumber',
        'email',
        'city',
        'address',
        'password',
        'profile_photo_path',
        'provider_id',
        'name',
        'avatar',
        'status',
        'last_seen',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public static function orderDetails($id)
    {
        /* $orders = Order::join('products', 'orders.product_id', '=', 'products.id')
                    ->where('orders.user_id', auth()->user()->id)
                    ->where('orders.isOncart', 0)
                    ->where('products.units', '!=', 0)
                    ->select('orders.*', 'products.category', 'products.name', 'products.price', 'products.units', 'products.details', 'products.description', 'products.image_path', DB::raw('count(order_id) as numberofItems'))
                    ->orderBy('orders.created_at', 'DESC')
                    ->groupBy('order_id')
                    ->get(); */

        $orders = Order::where('user_id', $id)
                    ->where('orders.isOncart', 0)
                    ->select('orders.*', DB::raw('count(order_id) as numberofItems'))
                    ->orderBy('orders.created_at', 'DESC')
                    ->groupBy('order_id')
                    ->get();

        return $orders;
    }

    public static function userDetails($id)
    {
        return User::findOrFail($id);
    }

    public static function generatedFakeContactNumber()
    {
        return mt_rand(100000000, 999999999);
    }

    public static function generatedPassword()
    {
        return Str::random(8);
    }
}
