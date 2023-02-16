<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LocationFactory extends Factory
{

    protected $model = Location::class;


    public function definition()
    {
        $city = $this->faker->city;
        $slug = Str::slug('location-journey-' . $city, '-') ;
        return [
            'name' => $city,
            'slug' => $slug,
            'lat' => $this->faker->latitude,
            'lng' => $this->faker->longitude,
        ];
    }
}
