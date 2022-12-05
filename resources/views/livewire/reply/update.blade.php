<div>
    <div x-data="{
        editReply: false,
        focus: function(){
            const textInput = this.$refs.textInput;
            textInput.focus();
            console.log('focused', textInput)
        }
    }" x-cloak>
        {{-- Success is as dangerous as failure. --}}
        <div x-show="!editReply" class="relative">
            <div class="p-5 space-y-4 text-gray-500 bg-white border-l-4 border-blue-300 shadow">
                <div class="grid grid-cols-8">
                    {{-- Avatar --}}
                    <div class="col-span-1">
                        <x-user.avatar :user="$author"/>
                    </div>
                    {{--<button class="flex items-center text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                         <img class="object-cover w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" /> 
                        <img class="object-cover w-16 h-16 rounded" src="{{ asset('img/avatars/person4.jpg') }}" alt="Person One" />
                    </button>--}}
                    <div class="col-span-6 space-y-4 relative">
                        <p>
                           {{ $replyOrigBody }}
                        </p>
                        <div class="flex justify-between absolute bottom-1 w-full">
                            {{-- Likes --}}
                            <div class="flex space-x-5 text-gray-500">
                                <a href="" class="flex items-center space-x-2">
                                    <x-heroicon-o-heart class="w-5 h-5 text-red-300" />
                                    <span class="text-xs font-bold">30</span>
                                </a>
                            </div>

                            {{-- Date Posted --}}
                            <div class="flex items-center text-xs text-gray-500">
                                <x-heroicon-o-clock class="w-4 h-4 mr-1" />
                                Replied: {{ $dateDiffCreatedAt }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex absolute top-2 right-2 space-x-2">
                @can(App\Policies\ReplyPolicy::UPDATE, App\Models\Reply::find($replyId))
                    <x-links.secondary 
                        x-on:click="editReply = true; $nextTick(() => {focus()});" 
                        class="cursor-pointer">
                        {{ __('Edit') }}
                    </x-links.secondary>
                @endcan

                @can(App\Policies\ReplyPolicy::DELETE, App\Models\Reply::find($replyId))
                    <livewire:reply.delete 
                        :replyId="$replyId"
                        :wire:key="$replyId"
                        :page="request()->fullUrl()" />
                @endcan
            </div>
        </div>

        <div x-show="editReply">   
            <form wire:submit.prevent="updateReply">
                <input 
                    class="w-full bg-gray-100 border-none shadow-inner focus:ring-blue-500"
                    type="text" 
                    name="replyNewBody" 
                    wire:model.lazy="replyNewBody" 
                    x-ref="textInput"
                    x-on:keydown.enter="editReply = false"
                    x-on:keydown.escape="editReply = false"
                    />
                <div class="mt-2 space-x-3 text-xs">
                    <button type="button" class="text-green-400" x-on:click="editReply = false">Cancel</button>
                    <button type="submit" class="text-red-400" x-on:click="editReply = false">Save</button>
                </div>
                
            </form>
        </div>
    </div>
</div>
