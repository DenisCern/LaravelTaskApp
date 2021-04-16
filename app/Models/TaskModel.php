<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class TaskModel extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = ['status'];
    public $sortable = ['status'];

}
