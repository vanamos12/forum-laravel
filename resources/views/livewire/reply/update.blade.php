<div>
    {{-- Success is as dangerous as failure. --}}
    {!! $oldReply !!}

    <div>   
        <form wire:submit.prevent="updateReply">
            <button>Save</button>
        </form>
    </div>
</div>
