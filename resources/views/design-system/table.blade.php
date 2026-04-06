@extends('layouts.design-system')

@section('content')
    <div class="max-w-5xl mx-auto px-8 py-12 flex flex-col gap-16">

        {{-- TABLE --}}
        <section class="flex flex-col divide-y divide-gray-100 dark:divide-slate-800 rounded-2xl border border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-xs overflow-hidden">

            {{-- Header --}}
            <div class="px-6 py-4 border-b border-gray-100 dark:border-slate-800">
                <span class="text-xs font-medium tracking-widest text-gray-400 dark:text-slate-500 uppercase">Table</span>
                <h2 class="text-sm font-semibold text-gray-800 dark:text-slate-100">Table</h2>
                <p class="text-xs text-gray-400 dark:text-slate-500 mt-0.5">Data table with sorting, inline search, and pagination</p>
            </div>

            {{-- 01 — Simple --}}
            <div class="flex items-start gap-8 px-6 py-8">
                <div class="flex flex-col gap-0.5 w-56 shrink-0">
                    <code class="text-xs font-medium text-indigo-500">01 — simple</code>
                    <span class="text-xs text-gray-400 dark:text-slate-500">Basic table without sorting or search</span>
                </div>
                <div class="flex-1">
                    <x-table.table
                        id="table01"
                        :rows="collect([
                            (object) ['name' => 'Alice', 'email' => 'alice@example.com', 'role' => 'Admin'],
                            (object) ['name' => 'Bob',   'email' => 'bob@example.com',   'role' => 'User'],
                            (object) ['name' => 'Carol', 'email' => 'carol@example.com', 'role' => 'User'],
                        ])"
                        :columns="[
                            ['key' => 'name',  'label' => 'Name',  'sortable' => false, 'searchable' => false],
                            ['key' => 'email', 'label' => 'Email', 'sortable' => false, 'searchable' => false],
                            ['key' => 'role',  'label' => 'Role',  'sortable' => false, 'searchable' => false],
                        ]"
                    >
                        <x-slot:rowTemplate>
                            <x-table.row column="role">
                                @verbatim
                                <span class="px-2 py-1 text-xs font-medium rounded-full {{ $row->role === 'Admin' ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-500/20 dark:text-indigo-400' : 'bg-gray-100 text-gray-700 dark:bg-slate-800 dark:text-slate-400' }}">
                                    {{ $row->role }}
                                </span>
                                @endverbatim
                            </x-table.row>
                        </x-slot:rowTemplate>
                    </x-table.table>
                </div>
            </div>

            {{-- 02 — Sortable --}}
            <div class="flex items-start gap-8 px-6 py-8">
                <div class="flex flex-col gap-0.5 w-56 shrink-0">
                    <code class="text-xs font-medium text-indigo-500">02 — sortable</code>
                    <span class="text-xs text-gray-400 dark:text-slate-500">Sortable columns, independent from table 04</span>
                </div>
                <div class="flex-1">
                    <x-table.table
                        id="table02"
                        :rows="collect([
                            ['name' => 'Alice', 'email' => 'alice@example.com', 'role' => 'Admin'],
                            ['name' => 'Bob',   'email' => 'bob@example.com',   'role' => 'User'],
                            ['name' => 'Carol', 'email' => 'carol@example.com', 'role' => 'User'],
                        ])"
                        :columns="[
                            ['key' => 'name',  'label' => 'Name',  'sortable' => true,  'searchable' => false],
                            ['key' => 'email', 'label' => 'Email', 'sortable' => true,  'searchable' => false],
                            ['key' => 'role',  'label' => 'Role',  'sortable' => false, 'searchable' => false],
                        ]"
                        :current-sort="request('table02_sort', 'email')"
                        :current-dir="request('table02_dir', 'asc')"
                    />
                </div>
            </div>

            {{-- 03 — Inline search --}}
            <div class="flex items-start gap-8 px-6 py-8">
                <div class="flex flex-col gap-0.5 w-56 shrink-0">
                    <code class="text-xs font-medium text-indigo-500">03 — searchable</code>
                    <span class="text-xs text-gray-400 dark:text-slate-500">Inline search in column header (Enter)</span>
                </div>
                <div class="flex-1">
                    <x-table.table
                        id="table03"
                        :rows="collect([
                            ['name' => 'Alice', 'email' => 'alice@example.com', 'role' => 'Admin'],
                            ['name' => 'Bob',   'email' => 'bob@example.com',   'role' => 'User'],
                            ['name' => 'Carol', 'email' => 'carol@example.com', 'role' => 'User'],
                        ])"
                        :columns="[
                            ['key' => 'name',  'label' => 'Name',  'sortable' => true, 'searchable' => true],
                            ['key' => 'email', 'label' => 'Email', 'sortable' => true, 'searchable' => true],
                            ['key' => 'role',  'label' => 'Role',  'sortable' => false,'searchable' => false],
                        ]"
                        :current-sort="request('table03_sort')"
                        :current-dir="request('table03_dir', 'asc')"
                    />
                </div>
            </div>

            {{-- 04 — Paginator --}}
            <div class="flex items-start gap-8 px-6 py-8">
                <div class="flex flex-col gap-0.5 w-56 shrink-0">
                    <code class="text-xs font-medium text-indigo-500">04 — paginator</code>
                    <span class="text-xs text-gray-400 dark:text-slate-500">Pagination + inline search, independent sorting from table 02</span>
                </div>
                <div class="flex-1">
                    @php
                        $allItems = collect(array_map(fn($i) => [
                            'name'  => ['Alice','Bob','Carol','David','Eva','Frank','Grace','Hugo','Iris','Jules',
                                        'Kevin','Laura','Marc','Nina','Olivia','Paul','Quinn','Rose','Sam','Tina',
                                        'Uma','Victor','Wendy','Xander','Yara','Zoe','Aaron','Bella','Caleb','Diana'][$i],
                            'email' => strtolower(['Alice','Bob','Carol','David','Eva','Frank','Grace','Hugo','Iris','Jules',
                                        'Kevin','Laura','Marc','Nina','Olivia','Paul','Quinn','Rose','Sam','Tina',
                                        'Uma','Victor','Wendy','Xander','Yara','Zoe','Aaron','Bella','Caleb','Diana'][$i]) . '@example.com',
                            'role'  => $i % 3 === 0 ? 'Admin' : 'User',
                        ], range(0, 29)));

                        $perPage04   = (int) request('per_page', 10);
                        $page04      = (int) request('page', 1);
                        $pageItems04 = $allItems->slice(($page04 - 1) * $perPage04, $perPage04)->values();

                        $paginator04 = new \Illuminate\Pagination\LengthAwarePaginator(
                            $pageItems04,
                            $allItems->count(),
                            $perPage04,
                            $page04,
                            ['path' => request()->url(), 'query' => request()->query()]
                        );
                    @endphp

                    <x-table.table
                        id="table04"
                        :rows="$paginator04"
                        :columns="[
                            ['key' => 'name',  'label' => 'Name',  'sortable' => true,  'searchable' => true],
                            ['key' => 'email', 'label' => 'Email', 'sortable' => true,  'searchable' => true],
                            ['key' => 'role',  'label' => 'Role',  'sortable' => false, 'searchable' => false],
                        ]"
                        :current-sort="request('table04_sort', 'name')"
                        :current-dir="request('table04_dir', 'asc')"
                    />
                </div>
            </div>

            {{-- 05 — Empty --}}
            <div class="flex items-start gap-8 px-6 py-8">
                <div class="flex flex-col gap-0.5 w-56 shrink-0">
                    <code class="text-xs font-medium text-indigo-500">05 — empty</code>
                    <span class="text-xs text-gray-400 dark:text-slate-500">No data — empty state</span>
                </div>
                <div class="flex-1">
                    <x-table.table
                        id="table05"
                        :rows="collect([])"
                        :columns="[
                            ['key' => 'name',  'label' => 'Name',  'sortable' => false, 'searchable' => false],
                            ['key' => 'email', 'label' => 'Email', 'sortable' => false, 'searchable' => false],
                            ['key' => 'role',  'label' => 'Role',  'sortable' => false, 'searchable' => false],
                        ]"
                        empty-message="No user found."
                    />
                </div>
            </div>

        </section>

    </div>
@endsection
