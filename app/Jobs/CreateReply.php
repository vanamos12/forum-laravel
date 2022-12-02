<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Reply;
use App\Models\ReplyAble;
use Illuminate\Bus\Queueable;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Http\Requests\CreateReplyRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CreateReply implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $body;
    private $author;
    private $replyAble;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $body, User $author, ReplyAble $replyAble)
    {
        //
        $this->body = $body;
        $this->author = $author;
        $this->replyAble = $replyAble;
    }

    public static function fromRequest(CreateReplyRequest $request){
        return new static(
            $request->body(),
            $request->author(),
            $request->replyAble()
        );
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle():Reply
    {
        //
        $reply = new Reply([
            //'body' => Purifier::clean($this->body)
            'body' => $this->body
        ]);
        $reply->authoredBy($this->author);
        $reply->to($this->replyAble);
        $reply->save();

        return $reply;
    }
}
