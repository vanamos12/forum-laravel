<?php

namespace Database\Seeders;

use App\Models\Reply;
use App\Notifications\NewReplyNotification;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Reply::all()->each(function(Reply $reply){
            $reply->replyAble()->author()->notifications()->create([
               'type' => NewReplyNotification::class,
               'data' => [
                    'type' => 'new_reply',
                    'reply'=> $reply->id(),
                    'replyable_id' => $reply->replyable_id,
                    'replyable_type' => $reply->replyable_type,
                    'replyable_subject' => $reply->replyAble()->replyAbleSubject(),
               ],

               'created_at' => $reply->createdAt(),
               'updated_at' => $reply->createdAt(),
            ]);
        });
    }
}
