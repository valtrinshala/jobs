<div>
    <div>
        <x:table.table>
            <x:table.thead
                :columns="['#', 'Image', 'Name', 'Created At', '']"/>
            <tbody>
            @forelse($objects as $object)
                <x:table.tr :index="$loop->index">
                    <x:table.td class="whitespace-nowrap">{{$object->id}}</x:table.td>
                    <x:table.td>
                        <div class="group flex relative  text-sm font-medium text-gray-900  text-left w-32">
                            <div class="relative flex-shrink-0">
                                <a href="{{resourceUrl($object->image_path)}}" target="_blank">
                                    <div class="relative">
                                        <img
                                            onerror="this.src = '{{ default_404_image() }}'"
                                            src="{{ resourceUrl($object->image_path)}}"
                                            alt="img" class="h-20 w-32 mr-3 object-contain">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </x:table.td>
                    <x:table.td class="whitespace-nowrap">{{$object->name ?? '-'}}</x:table.td>
                    <x:table.td class="whitespace-nowrap">{{ date_formatter($object->created_at) ?? '-'}}</x:table.td>
                    <x:table.td>
                        <x:dropdown :relative="false">
                            <x:slot name="trigger">
                                <button type="button" class="focus:outline-none">
                                    <x:icons.dots-vertical/>
                                </button>
                            </x:slot>

                            <x:slot name="content">
                                <x:dropdown-link href="{{ route('admin.providers.edit', $object) }}">
                                    Edit
                                </x:dropdown-link>
                                <x-dropdown-link href="#" onclick="event.preventDefault();"
                                                 @click.prevent="$dispatch('open-delete-modal', '{{ $object->slug }}')">
                                    {{ __('Delete') }}
                                </x-dropdown-link>
                            </x:slot>
                        </x:dropdown>
                    </x:table.td>
                </x:table.tr>
            @empty
                <x:table.tr>
                    <x:table.td colspan="100%">
                        There are no data.
                    </x:table.td>
                </x:table.tr>
            @endforelse

            </tbody>
        </x:table.table>

        <div class="mt-10">
            {{ $objects->links() }}
        </div>
    </div>

    <x:delete-item-modal/>
</div>
