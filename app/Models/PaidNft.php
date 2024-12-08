<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaidNft extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'paid_price', 'datepaid', 'token_id', 'wallet_address_from', 'wallet_address_to'];
}
