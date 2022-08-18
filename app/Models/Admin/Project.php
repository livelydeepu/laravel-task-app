<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name'
    ];

    public function Tasks()
    {
        return $this->hasMany(Task::class, 'project_id');
    }
}
