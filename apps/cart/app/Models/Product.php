<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property float price
 * @property string title
 */
class Product extends Model
{
    protected $table = 'products';

    protected $guarded = 'id';
}
