<?php

namespace Database\Factories;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    protected $model = Reply::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'body' => $this->faker->text(),
            //'author_id' => $attributes['author_id'] ?? User::factory()->Create()->id(),
            //'replyable_id' => $attributes['replyable_id'] ?? Thread::factory()->create()->id(),
            'author_id' => function (array $attributes){
                return $attributes['author_id'] ?? User::factory()->Create()->id();
            },
            'replyable_id' => function(array $attributes){
                return $attributes['replyable_id'] ?? Thread::factory()->create()->id();
            },
            'replyable_type' => Thread::TABLE,
        ];
    }
}
