{{-- resources/views/design-system/form.blade.php --}}

@extends('layouts.design-system')

@section('content')
    <div class="max-w-5xl mx-auto px-8 py-12 flex flex-col gap-16">

        {{-- 01 INPUT --}}
        <section class="flex flex-col gap-6">
            <div class="flex flex-col gap-1">
                <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">01</span>
                <h2 class="text-xl font-semibold text-gray-900 dark:text-slate-100 tracking-tight">Input</h2>
                <p class="text-sm text-gray-400 dark:text-slate-500">Prop <code
                        class="bg-gray-100 dark:bg-slate-800 px-1.5 py-0.5 rounded text-gray-600 dark:text-slate-400 text-xs">type</code> — text, email,
                    password, number…</p>
            </div>

            <div class="rounded-2xl border border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-xs divide-y divide-gray-50 dark:divide-slate-800">
                <div class="flex items-start justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">type="text"</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">Standard text field</span>
                    </div>
                    <div class="flex-1">
                        <x-form.input name="ex_text" placeholder="Your name"/>
                    </div>
                </div>
                <div class="flex items-start justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">label + hint</code>
                        <span class="text-xs text-gray-400">With label and help text</span>
                    </div>
                    <div class="flex-1">
                        <x-form.input name="ex_email" type="email" label="Email"
                                      hint="We will never share your email." placeholder="john@example.com"
                                      icon="fa-solid fa-envelope"/>
                    </div>
                </div>
                <div class="flex items-start justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">:error="..."</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">Error state</span>
                    </div>
                    <div class="flex-1">
                        <x-form.input name="ex_err" label="Email" error="This address is already in use."
                                      value="john@example" icon="fa-solid fa-envelope"/>
                    </div>
                </div>
                <div class="flex items-start justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">:disabled="true"</code>
                        <span class="text-xs text-gray-400">Disabled field</span>
                    </div>
                    <div class="flex-1">
                        <x-form.input name="ex_disabled" label="Identifier" value="USR-00412" :disabled="true"/>
                    </div>
                </div>
            </div>
        </section>

        {{-- 02 TEXTAREA --}}
        <section class="flex flex-col gap-6">
            <div class="flex flex-col gap-1">
                <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">02</span>
                <h2 class="text-xl font-semibold text-gray-900 dark:text-slate-100 tracking-tight">Textarea</h2>
                <p class="text-sm text-gray-400 dark:text-slate-500">Props <code
                        class="bg-gray-100 dark:bg-slate-800 px-1.5 py-0.5 rounded text-gray-600 dark:text-slate-400 text-xs">rows</code> and <code
                        class="bg-gray-100 dark:bg-slate-800 px-1.5 py-0.5 rounded text-gray-600 dark:text-slate-400 text-xs">resize</code>.</p>
            </div>

            <div class="rounded-2xl border border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-xs divide-y divide-gray-50 dark:divide-slate-800">
                <div class="flex items-start justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">default</code>
                        <span class="text-xs text-gray-400">4 rows, resizable</span>
                    </div>
                    <div class="flex-1">
                        <x-form.text-area name="ex_ta" label="Description" placeholder="Describe your project…"/>
                    </div>
                </div>
                <div class="flex items-start justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">:resize="false"</code>
                        <span class="text-xs text-gray-400">Fixed height</span>
                    </div>
                    <div class="flex-1">
                        <x-form.text-area name="ex_ta2" :rows="3" :resize="false" placeholder="Short note…"
                                         hint="Maximum 200 characters."/>
                    </div>
                </div>
            </div>
        </section>

        {{-- 03 TOGGLE --}}
        <section class="flex flex-col gap-6">
            <div class="flex flex-col gap-1">
                <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">03</span>
                <h2 class="text-xl font-semibold text-gray-900 dark:text-slate-100 tracking-tight">Toggle</h2>
                <p class="text-sm text-gray-400 dark:text-slate-500">Prop <code class="bg-gray-100 dark:bg-slate-800 px-1.5 py-0.5 rounded text-gray-600 dark:text-slate-400 text-xs">checked</code> · <code class="bg-gray-100 dark:bg-slate-800 px-1.5 py-0.5 rounded text-gray-600 dark:text-slate-400 text-xs">disabled</code> · <code class="bg-gray-100 dark:bg-slate-800 px-1.5 py-0.5 rounded text-gray-600 dark:text-slate-400 text-xs">hint</code></p>
            </div>

            <div class="rounded-2xl border border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-xs divide-y divide-gray-50 dark:divide-slate-800">
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">default</code>
                        <span class="text-xs text-gray-400">Unchecked</span>
                    </div>
                    <x-form.toggle name="ex_toggle1" label="Receive notifications" />
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">:checked="true"</code>
                        <span class="text-xs text-gray-400">Checked by default</span>
                    </div>
                    <x-form.toggle name="ex_toggle2" label="Dark mode" :checked="true" hint="Applied across all your devices." />
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">:disabled="true"</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">Disabled</span>
                    </div>
                    <x-form.toggle name="ex_toggle3" label="Locked option" :disabled="true" :checked="true" />
                </div>
            </div>
        </section>

        {{-- 04 Checkbox --}}
        <section class="flex flex-col gap-6">
            <div class="flex flex-col gap-1">
                <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">04</span>
                <h2 class="text-lg font-semibold text-gray-800 dark:text-slate-100">Checkbox</h2>
                <p class="text-sm text-gray-400 dark:text-slate-500">Props <code class="bg-gray-100 dark:bg-slate-800 px-1.5 py-0.5 rounded text-gray-600 dark:text-slate-400 text-xs">checked</code> · <code class="bg-gray-100 dark:bg-slate-800 px-1.5 py-0.5 rounded text-gray-600 dark:text-slate-400 text-xs">disabled</code> · <code class="bg-gray-100 dark:bg-slate-800 px-1.5 py-0.5 rounded text-gray-600 dark:text-slate-400 text-xs">hint</code> · <code class="bg-gray-100 dark:bg-slate-800 px-1.5 py-0.5 rounded text-gray-600 dark:text-slate-400 text-xs">error</code></p>
            </div>

            <div class="rounded-2xl border border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-xs divide-y divide-gray-50 dark:divide-slate-800">
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">default</code>
                        <span class="text-xs text-gray-400">Unchecked</span>
                    </div>
                    <x-form.checkbox name="ex_checkbox1" label="I accept the terms" />
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">:checked="true"</code>
                        <span class="text-xs text-gray-400">Checked by default</span>
                    </div>
                    <x-form.checkbox name="ex_checkbox2" label="Receive newsletter" :checked="true" hint="You can unsubscribe at any time." />
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">error</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">Error state</span>
                    </div>
                    <x-form.checkbox name="ex_checkbox3" label="I accept the terms" error="You must accept the terms." />
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">:disabled="true"</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">Disabled</span>
                    </div>
                    <x-form.checkbox name="ex_checkbox4" label="Locked option" :disabled="true" :checked="true" />
                </div>
            </div>
        </section>

        {{-- 05 · Radio --}}
        <section class="flex flex-col gap-6">
            <div class="flex flex-col gap-1">
                <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">05</span>
                <h2 class="text-lg font-semibold text-gray-800 dark:text-slate-100">Radio</h2>
                <p class="text-sm text-gray-400 dark:text-slate-500">Props <code class="bg-gray-100 dark:bg-slate-800 px-1.5 py-0.5 rounded text-gray-600 dark:text-slate-400 text-xs">checked</code> · <code class="bg-gray-100 dark:bg-slate-800 px-1.5 py-0.5 rounded text-gray-600 dark:text-slate-400 text-xs">disabled</code> · <code class="bg-gray-100 dark:bg-slate-800 px-1.5 py-0.5 rounded text-gray-600 dark:text-slate-400 text-xs">hint</code> · <code class="bg-gray-100 dark:bg-slate-800 px-1.5 py-0.5 rounded text-gray-600 dark:text-slate-400 text-xs">error</code></p>
            </div>

            <div class="rounded-2xl border border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-xs divide-y divide-gray-50 dark:divide-slate-800">
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">default</code>
                        <span class="text-xs text-gray-400">Not selected</span>
                    </div>
                    <x-form.radio name="ex_radio1" value="a" label="Option A" />
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">:checked="true"</code>
                        <span class="text-xs text-gray-400">Selected by default</span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <x-form.radio name="ex_radio2" value="a" label="Option A" :checked="true" />
                        <x-form.radio name="ex_radio2" value="b" label="Option B" />
                        <x-form.radio name="ex_radio2" value="c" label="Option C" hint="Recommended for most cases." />
                    </div>
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">error</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">Error state</span>
                    </div>
                    <x-form.radio name="ex_radio3" value="a" label="Option A" error="Please select an option." />
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">:disabled="true"</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">Disabled</span>
                    </div>
                    <x-form.radio name="ex_radio4" value="a" label="Locked option" :disabled="true" :checked="true" />
                </div>
            </div>
        </section>

        {{-- 06 · Select --}}
        <section class="flex flex-col gap-6">
            <div class="flex flex-col gap-1">
                <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">06</span>
                <h2 class="text-lg font-semibold text-gray-800 dark:text-slate-100">Select</h2>
                <p class="text-sm text-gray-400 dark:text-slate-500">Dropdown custom · Props <code class="bg-gray-100 dark:bg-slate-800 px-1.5 py-0.5 rounded text-gray-600 dark:text-slate-400 text-xs">options</code> · <code class="bg-gray-100 dark:bg-slate-800 px-1.5 py-0.5 rounded text-gray-600 dark:text-slate-400 text-xs">selected</code> · <code class="bg-gray-100 dark:bg-slate-800 px-1.5 py-0.5 rounded text-gray-600 dark:text-slate-400 text-xs">disabled</code> · <code class="bg-gray-100 dark:bg-slate-800 px-1.5 py-0.5 rounded text-gray-600 dark:text-slate-400 text-xs">error</code></p>
            </div>

            <div class="rounded-2xl border border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-xs divide-y divide-gray-50 dark:divide-slate-800">
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">default</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">No selection</span>
                    </div>
                    <div class="w-72">
                        <x-form.select name="ex_select1" label="Country" placeholder="Choose a country..."
                                       :options="[
                        ['value' => 'fr', 'label' => 'France'],
                        ['value' => 'be', 'label' => 'Belgium'],
                        ['value' => 'ch', 'label' => 'Switzerland'],
                        ['value' => 'de', 'label' => 'Germany'],
                        ['value' => 'es', 'label' => 'Spain'],
                    ]"
                        />
                    </div>
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">selected="fr"</code>
                        <span class="text-xs text-gray-400">Pre-selected value</span>
                    </div>
                    <div class="w-72">
                        <x-form.select name="ex_select2" label="Country" selected="fr"
                                       :options="[
                        ['value' => 'fr', 'label' => 'France'],
                        ['value' => 'be', 'label' => 'Belgium'],
                        ['value' => 'ch', 'label' => 'Switzerland'],
                    ]"
                                       hint="Can be modified at any time."
                        />
                    </div>
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">error</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">Error state</span>
                    </div>
                    <div class="w-72">
                        <x-form.select name="ex_select3" label="Category" error="Please select a category."
                                       :options="[
                        ['value' => '1', 'label' => 'Design'],
                        ['value' => '2', 'label' => 'Development'],
                        ['value' => '3', 'label' => 'Marketing'],
                    ]"
                        />
                    </div>
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">:disabled="true"</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">Disabled</span>
                    </div>
                    <div class="w-72">
                        <x-form.select name="ex_select4" label="Country" selected="fr" :disabled="true"
                                       :options="[
                        ['value' => 'fr', 'label' => 'France'],
                        ['value' => 'be', 'label' => 'Belgium'],
                    ]"
                        />
                    </div>
                </div>
            </div>
        </section>

        {{-- 07· Autocomplete --}}
        <section class="flex flex-col gap-6">
            <div class="px-6 py-4 border-b border-gray-100 dark:border-slate-800">
                <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">07</span>
                <h2 class="text-lg font-semibold text-gray-800 dark:text-slate-100">Autocomplete</h2>
                <p class="text-sm text-gray-400 dark:text-slate-500 mt-0.5">Selection with input filtering</p>
            </div>
            <div class="rounded-2xl border border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-xs divide-y divide-gray-50 dark:divide-slate-800">
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">default</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">No selection</span>
                    </div>
                    <div class="w-72">
                        <x-form.autocomplete
                            name="ex_auto1"
                            label="Country"
                            placeholder="Choose a country..."
                            :options="[
                        ['value' => 'fr', 'label' => 'France'],
                        ['value' => 'be', 'label' => 'Belgium'],
                        ['value' => 'ch', 'label' => 'Switzerland'],
                        ['value' => 'de', 'label' => 'Germany'],
                        ['value' => 'es', 'label' => 'Spain'],
                        ['value' => 'it', 'label' => 'Italy'],
                        ['value' => 'pt', 'label' => 'Portugal'],
                    ]"
                        />
                    </div>
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">selected="fr"</code>
                        <span class="text-xs text-gray-400">Pre-selected value</span>
                    </div>
                    <div class="w-72">
                        <x-form.autocomplete
                            name="ex_auto2"
                            label="Country"
                            selected="fr"
                            :options="[
                        ['value' => 'fr', 'label' => 'France'],
                        ['value' => 'be', 'label' => 'Belgium'],
                        ['value' => 'ch', 'label' => 'Switzerland'],
                    ]"
                            hint="Can be modified at any time."
                        />
                    </div>
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">error</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">Error state</span>
                    </div>
                    <div class="w-72">
                        <x-form.autocomplete
                            name="ex_auto3"
                            label="City"
                            error="Please select a city."
                            :options="[
                        ['value' => 'paris', 'label' => 'Paris'],
                        ['value' => 'lyon', 'label' => 'Lyon'],
                        ['value' => 'marseille', 'label' => 'Marseille'],
                        ['value' => 'bordeaux', 'label' => 'Bordeaux'],
                    ]"
                        />
                    </div>
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">:disabled="true"</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">Disabled</span>
                    </div>
                    <div class="w-72">
                        <x-form.autocomplete
                            name="ex_auto4"
                            label="Country"
                            selected="fr"
                            :disabled="true"
                            :options="[
                        ['value' => 'fr', 'label' => 'France'],
                        ['value' => 'be', 'label' => 'Belgium'],
                    ]"
                        />
                    </div>
                </div>
            </div>
        </section>

        {{-- 08· Date --}}
        <section class="flex flex-col gap-6">
            <div class="px-6 py-4 border-b border-gray-100 dark:border-slate-800">
                <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">08</span>
                <h2 class="text-lg font-semibold text-gray-800 dark:text-slate-100">Date</h2>
                <p class="text-sm text-gray-400 dark:text-slate-500 mt-0.5">Date picker with custom calendar</p>
            </div>
            <div class="rounded-2xl border border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-xs divide-y divide-gray-50 dark:divide-slate-800">
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">default</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">No date</span>
                    </div>
                    <div class="w-72">
                        <x-form.date name="ex_date1" label="Date of birth" />
                    </div>
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">value="2024-03-15"</code>
                        <span class="text-xs text-gray-400">Pre-filled date</span>
                    </div>
                    <div class="w-72">
                        <x-form.date name="ex_date2" label="Start date" value="2024-03-15" hint="Format DD/MM/YYYY." />
                    </div>
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">error</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">Error state</span>
                    </div>
                    <div class="w-72">
                        <x-form.date name="ex_date3" label="Expiration date" error="The date is invalid." />
                    </div>
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">:disabled="true"</code>
                        <span class="text-xs text-gray-400 dark:text-slate-500">Disabled</span>
                    </div>
                    <div class="w-72">
                        <x-form.date name="ex_date4" label="Date" value="2024-01-01" :disabled="true" />
                    </div>
                </div>
            </div>
        </section>

        {{-- 09 COLOR --}}
        <section class="flex flex-col gap-6">
            <div class="flex flex-col gap-1">
                <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">09</span>
                <h2 class="text-xl font-semibold text-gray-900 dark:text-slate-100 tracking-tight">Color</h2>
                <p class="text-sm text-gray-400 dark:text-slate-500">Props <code class="bg-gray-100 dark:bg-slate-800 px-1.5 py-0.5 rounded text-gray-600 dark:text-slate-400 text-xs">swatches</code> et <code class="bg-gray-100 dark:bg-slate-800 px-1.5 py-0.5 rounded text-gray-600 dark:text-slate-400 text-xs">value</code>.</p>
            </div>

            <div class="rounded-2xl border border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-xs divide-y divide-gray-50 dark:divide-slate-800">
                <div class="flex items-start justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">default</code>
                        <span class="text-xs text-gray-400">Swatches + custom picker</span>
                    </div>
                    <div class="flex-1">
                        <x-form.color name="ex_color" label="Brand color" hint="Choose from swatches or a custom color."/>
                    </div>
                </div>
                <div class="flex items-start justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">value + error</code>
                        <span class="text-xs text-gray-400">Initial value + error state</span>
                    </div>
                    <div class="flex-1">
                        <x-form.color name="ex_color2" label="Secondary color" value="#ef4444" error="This color is already in use."/>
                    </div>
                </div>
                <div class="flex items-start justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">disabled</code>
                        <span class="text-xs text-gray-400">Not modifiable</span>
                    </div>
                    <div class="flex-1">
                        <x-form.color name="ex_color3" label="Locked color" value="#14b8a6" :disabled="true"/>
                    </div>
                </div>
            </div>
        </section>




        {{-- Future sections will be added as needed --}}

    </div>
@endsection
