<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VectorstoreQuality extends Model
{
    use HasFactory;

    protected $table = 'vectorstore_quality';

    protected $fillable = [
        'name',
        'value',
    ];
}