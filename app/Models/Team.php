<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public function add($users)
    {

        if ($this->users()->count() >= $this->size) {
            $this->guardAgainstTooManyMembers();
        }

        if ($this->users()->count() < $this->size) {
            if ($users instanceof User) {
                return $this->users()->save($users);
            }
    
            $this->users()->saveMany($users);
        }
        
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    protected function guardAgainstTooManyMembers()
    {
        if ($this->users()->count() >= $this->size) {
            throw new Exception('El equipo ya tiene el número máximo de miembros permitido.');
        }
    }
}
