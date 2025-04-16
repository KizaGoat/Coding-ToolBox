<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ProfilUserChange extends Model
{
    use HasFactory;

    protected $table = 'profil_user_changes';

    // Rendre plus clair que l'on ne suit pas les modifications de mot de passe ici
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'avatar',
        'email',
    ];

    // Définir la relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
