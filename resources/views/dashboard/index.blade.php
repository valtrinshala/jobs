<div>
    <div class="grid grid-cols-12 gap-5">
        <div class="col-span-12 md:col-span-3 bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <x:icons.clipboard-list-o class="h-6 w-6 text-gray-400"/>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-white truncate">
                                Punë Gjithsej
                            </dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900 dark:text-white">
                                    {{ number_format($localJobsTotal) }}
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-12 md:col-span-3 bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <x:icons.calendar-o class="h-6 w-6 text-gray-400"/>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-white truncate">
                                Punët e përditësuara së fundi
                            </dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900 dark:text-white">
                                    {{ $localJobsLastRecordUpdatedAt ?? '-' }}
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-12 md:col-span-3 bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <x:icons.clipboard-list-o class="h-6 w-6 text-gray-400"/>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-white truncate">
                                Punë jashtë vendit gjithsej
                            </dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900 dark:text-white">
                                    {{ number_format($externalJobsTotal) }}
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-12 md:col-span-3 bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <x:icons.calendar-o class="h-6 w-6 text-gray-400"/>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-white truncate">
                                Punët e jashtme përditësuara së fundi
                            </dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900 dark:text-white">
                                    {{ $externalJobsLastRecordUpdatedAt ?? '-' }}
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-12 md:col-span-3 bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <x:icons.clipboard-list-o class="h-6 w-6 text-gray-400"/>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-white truncate">
                                Tenderë Gjithsej
                            </dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900 dark:text-white">
                                    {{ number_format($tendersTotal) }}
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-12 md:col-span-3 bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <x:icons.calendar-o class="h-6 w-6 text-gray-400"/>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-white truncate">
                                Tenderët e përditësuara së fundi
                            </dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900 dark:text-white">
                                    {{ $tendersLastRecordUpdatedAt ?? '-' }}
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-12 md:col-span-3 bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <x:icons.clipboard-list-o class="h-6 w-6 text-gray-400"/>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-white truncate">
                                Grante Gjithsej
                            </dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900 dark:text-white">
                                    {{ number_format($grantsTotal) }}
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-12 md:col-span-3 bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <x:icons.calendar-o class="h-6 w-6 text-gray-400"/>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-white truncate">
                                Grantet e përditësuara së fundi
                            </dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900 dark:text-white">
                                    {{ $grantsLastRecordUpdatedAt ?? '-' }}
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
