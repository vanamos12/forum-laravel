<div>
    <div x-data="{
        editReply: false,
        focus: function(){
            const textInput = $this.$refs.textInput;
            textInput.focus();
        }
    }">
        {{-- Success is as dangerous as failure. --}}
        {{ $replyOrigBody }}

        <div>   
            <form wire:submit.prevent="updateReply">
                <button>Save</button>
            </form>
        </div>
    </div>
</div>
