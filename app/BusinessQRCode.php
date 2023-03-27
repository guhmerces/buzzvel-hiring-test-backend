<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessQRCode extends Model
{
    use HasFactory;

    protected $table = 'business_qr_code';

    protected $fillable = [
        'owner_name',
        'github_url',
        'linkedin_url',
        'qrcode_path',
    ];

    protected $hidden = [
        'id',
    ];
}
