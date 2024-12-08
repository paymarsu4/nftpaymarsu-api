<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nft extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'college_id', 'category_id', 'name', 'description', 'price', 'image_url', 'pinata_url', 'marketplace_address'];
}
