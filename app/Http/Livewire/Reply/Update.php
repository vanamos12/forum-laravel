<?php

namespace App\Http\Livewire\Reply;

use App\Models\Reply;
use App\Policies\ReplyPolicy;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Update extends Component
{
    use AuthorizesRequests;

    public $replyId;
    public $replyOrigBody;
    public $replyNewBody;
    public $author;
    public $dateDiffCreatedAt;

    protected $listeners = ['deleteReply' => 'deleteReply'];

    public function mount(Reply $reply)
    {
        $this->replyId = $reply->id();
        $this->replyOrigBody = $reply->body();
        $this->author = $reply->author();
        $this->dateDiffCreatedAt = $reply->diffForHumansCreatedAt();

        $this->initialize($reply);
    }

    public function updateReply(){
        $reply = Reply::findOrFail($this->replyId);
        $this->authorize(ReplyPolicy::UPDATE, $reply);
        $reply->body = $this->replyNewBody;
        $reply->save();

        session()->flash('success', 'Reply Updated!');
        $this->initialize($reply);
    }

    public function initialize(Reply $reply){
        $this->replyOrigBody = $reply->body();
        $this->replyNewBody = $this->replyOrigBody;
    }

    public function deleteReply($page){
        session()->flash('success', 'Reply Deleted!');
        return  redirect()->to($page);
    }

    public function render()
    {
        return view('livewire.reply.update');
    }
}
