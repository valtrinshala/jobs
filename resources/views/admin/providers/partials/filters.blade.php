<div class="flex items-center gap-4 mb-5">
    <div class="relative w-72">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <x:icons.search class="h-5 w-5 text-gray-400"/>
        </div>

        <x-form.input class="pl-10 w-full" wire:model.debounce.750="query" placeholder="Kërko..."/>

    </div>
    <a href="{{route('admin.providers.create')}}">
        <x:primary-button>Shto Ofrues</x:primary-button>
    </a>

</div>
