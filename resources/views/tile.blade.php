<x-dashboard-tile :position="$position" :refresh-interval="$refreshIntervalInSeconds">
    <ul role="list" class="min-h-full space-y-3 flex flex-col items-center justify-center">
        @foreach ($rates as $rate)
            <li class="overflow-hidden rounded-md bg-white px-6 py-4 shadow w-full">
                <div class="w-full flex justify-between items-center text-xl">
                    <p class="w-1/3">
                        1 {{ $base }}
                    </p>
                    <div class="w-1/3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                        </svg>
                    </div>
                    <p class="w-1/3">
                        {{ "{$rate['rate']} {$rate['symbol']}" }}
                    </p>
                </div>
            </li>
        @endforeach
    </ul>
</x-dashboard-tile>
