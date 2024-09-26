<?php
namespace App\Models\Academics;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class AddUniversity extends Model
{
    use HasFactory;
    protected $table = 'universities';
    protected $fillable = [
        'Is_Vocational',
        'Name',
        'Short_Name',
        'Vertical',
        'Address',
        'Logo'
    ];
    public $timestamps = true;
}
