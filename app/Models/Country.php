<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
/**
 * Class Country
 * @package App\Models
 * @version April 2, 2024, 11:24 pm UTC
 *
 * @property string $name
 * @property string $description
 */
class Country extends Model implements TranslatableContract
{
    use SoftDeletes;

    use HasFactory;
    use Translatable;
    public $table = 'countries';


    protected $dates = ['deleted_at'];


    public $translatedAttributes =
        ['name',
            'description'];


    public $fillable = [
        'name',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name:en' => 'required|max:50'
    ];


}
