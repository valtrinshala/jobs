<div>
    @include('grants.partials.filters')

    <div class="grid gap-3 grid-cols-1 sm:grid-cols-2">
        @forelse($grants as $grant)
            <x:grants.card :item="$grant"/>
        @empty
            <div class="flex justify-center col-span-4 text-red-600">No data.</div>
        @endforelse
    </div>

    <div class="mt-5">
        {{$grants->links()}}
    </div>
    <x:delete-item-modal/>
</div>
