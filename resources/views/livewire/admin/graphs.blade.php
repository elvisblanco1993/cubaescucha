<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="grid grid-cols-3 gap-8 my-12">
        <div class="col-span-3 md:col-span-1 bg-white rounded-lg shadow px-4 py-3">
            {{-- Users counter --}}
            <p class="text-sm font-bold text-blueGray-500">{{__("Total Users")}}</p>

            <div class="text-3xl font-semibold text-indigo-600 mt-2">
                {{ $users_total }}
            </div>
        </div>

        <div class="col-span-3 md:col-span-1 bg-white rounded-lg shadow px-4 py-3">
            {{-- New users counter --}}
            <div class="flex items-center justify-between">
                <p class="text-sm font-bold text-blueGray-500">{{__("New Users")}}</p>

                <select wire:model="filterRange" wire:click="filterNewUsers" class="text-xs w-1/4 py-1 px-1">
                    <option value="30">30 Days</option>
                    <option value="60">60 Days</option>
                    <option value="90">90 Days</option>
                    <option value="365">1 year</option>
                </select>
            </div>

            <div class="text-3xl font-semibold text-indigo-600 mt-2">
                {{ $users_new }}
            </div>
        </div>

        <div class="col-span-3 md:col-span-1 bg-white rounded-lg shadow px-4 py-3">
            {{-- Podcasts counter --}}
            <p class="text-sm font-bold text-blueGray-500">{{__("Total Podcasts")}}</p>

            <div class="text-3xl font-semibold text-indigo-600 mt-2">
                {{ $podcasts_total }}
            </div>
        </div>
    </div>
</div>
