<x-app-layout>

    {{-- Header --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <section class="px-6">
        <div class="overflow-hidden border-b border-gray-200">
            <table class="min-w-full">
                <thead class="bg-blue-500">
                    <tr>
                        <x-table.head>Id</x-table.head>
                        <x-table.head>Name</x-table.head>
                        <x-table.head>Slug</x-table.head>
                        <x-table.head class="text-center">Created At</x-table.head>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 divide-solid">
                    @foreach($categories as $category)
                    <tr>
                        <x-table.data>
                            <div>{{ $category->id }}</div>
                        </x-table.data>
                        <x-table.data>
                            <div>{{ $category->name }}</div>
                        </x-table.data>
                        <x-table.data>
                            <div>{{ $category->slug }}</div>
                        </x-table.data>
                        <x-table.data>
                            <div class="text-center">{{ $category->created_at }}</div>
                        </x-table.data>
                    </tr>   
                    @endforeach
                </tbody>

            </table>
        </div>
    </section>


</x-app-layout>
