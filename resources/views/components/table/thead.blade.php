<thead class="bg-gray-50">
<tr>
    @foreach($columns as $column)
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
            {{ $column }}
        </th>
    @endforeach
</tr>
</thead>
