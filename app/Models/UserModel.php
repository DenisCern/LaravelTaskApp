<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class UserModel extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [ 'name', 'email' ];
    public $sortable = ['id', 'name', 'email'];
    
}
