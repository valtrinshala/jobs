<div>
    @include('external-jobs.partials.filters')

    <div class="grid gap-3 grid-cols-1 sm:grid-cols-2">
        @forelse($jobs as $job)
            <x:jobs.card :item="$job"/>
        @empty
            <div class="flex justify-center col-span-4 text-red-600">No data.</div>
        @endforelse
    </div>

    <div class="mt-5">
        {{$jobs->links()}}
    </div>

    <x:delete-item-modal/>

    <div wire:loading>
        <x:full-screen-loader/>
    </div>

</div>
