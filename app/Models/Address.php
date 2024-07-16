<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $company_name
 * @property string $address_1
 * @property string|null $address_2
 * @property string $city
 * @property string $county
 * @property string $post_code
 * @property string $country
 * @property float|null $longitude
 * @property float|null $latitude
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Address extends Model
{
    use HasFactory;

    protected $guarded = [];
}
