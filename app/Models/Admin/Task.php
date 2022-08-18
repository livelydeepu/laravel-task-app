<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_title',
        'task_description',
        'project_id',
        'priority',
        'status',
        'created_by',
        'duedate',
    ];

    public function Project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
