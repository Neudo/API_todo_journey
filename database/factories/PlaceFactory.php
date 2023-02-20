<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PlaceFactory extends Factory
{

    protected $model = Place::class;


    public function definition()
    {
        return [
            'name' => $this->faker->address,
            'lat' => $this->faker->latitude,
            'lng' => $this->faker->longitude,
            'location_id' => 352,
            'visited' => 0
        ];
    }
}
