<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customerId' => $this->faker->unique()->randomNumber(9),
            'bsn' => $this->faker->unique()->randomNumber(9),
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'dateOfBirth' => $this->faker->date('Y-m-d', '-18 years'),
            'phoneNumber' => ('+31') . $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'tag' => $this->faker->word,
            'ipAddress' => $this->faker->ipv4,
            'iban' => $this->faker->iban('NL'),
            'lastInvoiceDate' => $this->faker->date('Y-m-d', '-1 year'),
            'lastLoginDateTime' => $this->faker->dateTimeThisYear->format('y-m-d H:i:s'),
        ];
    }
}
