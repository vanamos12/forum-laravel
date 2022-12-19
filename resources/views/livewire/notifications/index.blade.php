<div class="overflow-hidden border-b border-gray-200">
    @if(!$notifications->isEmpty())
        <table class="min-w-full">
            <thead class="bg-blue-500">
                <tr>
                    <x-table.head>Message</x-table.head>
                    <x-table.head>Date</x-table.head>
                    <x-table.head>Birthday</x-table.head>
                    <x-table.head class="text-center">Action</x-table.head>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 divide-solid">
                @foreach($notifications as $notification)
                    <tr>
                        <x-table.data>
                            <div>
                                A new reply was add to
                                <a href="{{ route('replies.replyAble', [
                                    $notification->data['replyable_id'],
                                    $notification->data['replyable_type']
                                ]) }}" class="ml-2 font-bold text-blue-500">
                                {{ $notification->data ['replyable_subject']}}
                                </a>
                            </div>
                        </x-table.data>
                        <x-table.data>
                            <div>{{ $notification->created_at }}</div>
                        </x-table.data>
                        <x-table.data>
                            <x-jet-button wire:click="markAsRead('{{ $notification->id}}')">
                                {{ __('Mark As Read') }}
                            </x-jet-button>
                        </x-table.data>
                        <x-table.data>
                            <div class="text-center">2005-14-06</div>
                        </x-table.data>
                    </tr>    
                @endforeach
                
            </tbody>

        </table>
    @else 
        You have no unread Notifications.   
    @endif
</div>
