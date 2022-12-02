<?php

namespace App\Http\Livewire\Reply;

use App\Models\Reply;
use Livewire\Component;

class Update extends Component
{
    public $oldReply;

    public function mount(Reply $reply)
    {
        $this->oldReply = $reply->body();
    }

    public function updateReply(){
        dd('Updating reply');
    }

    public function render()
    {
        return view('livewire.reply.update');
    }
}
