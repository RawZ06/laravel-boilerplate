{{-- resources/views/design-system/buttons.blade.php --}}

@extends('layouts.design-system')

@section('content')
    <div class="max-w-5xl mx-auto px-8 py-12 flex flex-col gap-16">

        {{-- 01 INPUT --}}
        <section class="flex flex-col gap-6">
            <div class="flex flex-col gap-1">
                <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">01</span>
                <h2 class="text-xl font-semibold text-gray-900 tracking-tight">Input</h2>
                <p class="text-sm text-gray-400">Prop <code
                        class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">type</code> — text, email,
                    password, number…</p>
            </div>

            <div class="rounded-2xl border border-gray-100 bg-white shadow-xs divide-y divide-gray-50">
                <div class="flex items-start justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">type="text"</code>
                        <span class="text-xs text-gray-400">Champ texte standard</span>
                    </div>
                    <div class="flex-1">
                        <x-form.input name="ex_text" placeholder="Votre nom"/>
                    </div>
                </div>
                <div class="flex items-start justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">label + hint</code>
                        <span class="text-xs text-gray-400">Avec label et texte d'aide</span>
                    </div>
                    <div class="flex-1">
                        <x-form.input name="ex_email" type="email" label="Email"
                                      hint="Nous ne partagerons jamais votre email." placeholder="jean@example.com"
                                      icon="fa-solid fa-envelope"/>
                    </div>
                </div>
                <div class="flex items-start justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">:error="..."</code>
                        <span class="text-xs text-gray-400">État d'erreur</span>
                    </div>
                    <div class="flex-1">
                        <x-form.input name="ex_err" label="Email" error="Cette adresse est déjà utilisée."
                                      value="jean@example" icon="fa-solid fa-envelope"/>
                    </div>
                </div>
                <div class="flex items-start justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">:disabled="true"</code>
                        <span class="text-xs text-gray-400">Champ désactivé</span>
                    </div>
                    <div class="flex-1">
                        <x-form.input name="ex_disabled" label="Identifiant" value="USR-00412" :disabled="true"/>
                    </div>
                </div>
            </div>
        </section>

        {{-- 02 TEXTAREA --}}
        <section class="flex flex-col gap-6">
            <div class="flex flex-col gap-1">
                <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">02</span>
                <h2 class="text-xl font-semibold text-gray-900 tracking-tight">Textarea</h2>
                <p class="text-sm text-gray-400">Props <code
                        class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">rows</code> et <code
                        class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">resize</code>.</p>
            </div>

            <div class="rounded-2xl border border-gray-100 bg-white shadow-xs divide-y divide-gray-50">
                <div class="flex items-start justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">défaut</code>
                        <span class="text-xs text-gray-400">4 lignes, redimensionnable</span>
                    </div>
                    <div class="flex-1">
                        <x-form.textarea name="ex_ta" label="Description" placeholder="Décrivez votre projet…"/>
                    </div>
                </div>
                <div class="flex items-start justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">:resize="false"</code>
                        <span class="text-xs text-gray-400">Hauteur fixe</span>
                    </div>
                    <div class="flex-1">
                        <x-form.textarea name="ex_ta2" :rows="3" :resize="false" placeholder="Note courte…"
                                         hint="Maximum 200 caractères."/>
                    </div>
                </div>
            </div>
        </section>

        {{-- 03 TOGGLE --}}
        <section class="flex flex-col gap-6">
            <div class="flex flex-col gap-1">
                <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">03</span>
                <h2 class="text-xl font-semibold text-gray-900 tracking-tight">Toggle</h2>
                <p class="text-sm text-gray-400">Prop <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">checked</code> · <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">disabled</code> · <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">hint</code></p>
            </div>

            <div class="rounded-2xl border border-gray-100 bg-white shadow-xs divide-y divide-gray-50">
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">défaut</code>
                        <span class="text-xs text-gray-400">Non coché</span>
                    </div>
                    <x-form.toggle name="ex_toggle1" label="Recevoir les notifications" />
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">:checked="true"</code>
                        <span class="text-xs text-gray-400">Coché par défaut</span>
                    </div>
                    <x-form.toggle name="ex_toggle2" label="Mode sombre" :checked="true" hint="Appliqué sur tous vos appareils." />
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">:disabled="true"</code>
                        <span class="text-xs text-gray-400">Désactivé</span>
                    </div>
                    <x-form.toggle name="ex_toggle3" label="Option verrouillée" :disabled="true" :checked="true" />
                </div>
            </div>
        </section>

        {{-- 04 Checkbox --}}
        <section class="flex flex-col gap-6">
            <div class="flex flex-col gap-1">
                <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">04</span>
                <h2 class="text-lg font-semibold text-gray-800">Checkbox</h2>
                <p class="text-sm text-gray-400">Props <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">checked</code> · <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">disabled</code> · <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">hint</code> · <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">error</code></p>
            </div>

            <div class="rounded-2xl border border-gray-100 bg-white shadow-xs divide-y divide-gray-50">
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">défaut</code>
                        <span class="text-xs text-gray-400">Non coché</span>
                    </div>
                    <x-form.checkbox name="ex_checkbox1" label="J'accepte les conditions" />
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">:checked="true"</code>
                        <span class="text-xs text-gray-400">Coché par défaut</span>
                    </div>
                    <x-form.checkbox name="ex_checkbox2" label="Recevoir la newsletter" :checked="true" hint="Vous pouvez vous désabonner à tout moment." />
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">error</code>
                        <span class="text-xs text-gray-400">État erreur</span>
                    </div>
                    <x-form.checkbox name="ex_checkbox3" label="J'accepte les conditions" error="Vous devez accepter les conditions." />
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">:disabled="true"</code>
                        <span class="text-xs text-gray-400">Désactivé</span>
                    </div>
                    <x-form.checkbox name="ex_checkbox4" label="Option verrouillée" :disabled="true" :checked="true" />
                </div>
            </div>
        </section>

        {{-- 05 · Radio --}}
        <section class="flex flex-col gap-6">
            <div class="flex flex-col gap-1">
                <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">05</span>
                <h2 class="text-lg font-semibold text-gray-800">Radio</h2>
                <p class="text-sm text-gray-400">Props <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">checked</code> · <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">disabled</code> · <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">hint</code> · <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">error</code></p>
            </div>

            <div class="rounded-2xl border border-gray-100 bg-white shadow-xs divide-y divide-gray-50">
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">défaut</code>
                        <span class="text-xs text-gray-400">Non sélectionné</span>
                    </div>
                    <x-form.radio name="ex_radio1" value="a" label="Option A" />
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">:checked="true"</code>
                        <span class="text-xs text-gray-400">Sélectionné par défaut</span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <x-form.radio name="ex_radio2" value="a" label="Option A" :checked="true" />
                        <x-form.radio name="ex_radio2" value="b" label="Option B" />
                        <x-form.radio name="ex_radio2" value="c" label="Option C" hint="Recommandé pour la plupart des cas." />
                    </div>
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">error</code>
                        <span class="text-xs text-gray-400">État erreur</span>
                    </div>
                    <x-form.radio name="ex_radio3" value="a" label="Option A" error="Veuillez sélectionner une option." />
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">:disabled="true"</code>
                        <span class="text-xs text-gray-400">Désactivé</span>
                    </div>
                    <x-form.radio name="ex_radio4" value="a" label="Option verrouillée" :disabled="true" :checked="true" />
                </div>
            </div>
        </section>

        {{-- 06 · Select --}}
        <section class="flex flex-col gap-6">
            <div class="flex flex-col gap-1">
                <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">06</span>
                <h2 class="text-lg font-semibold text-gray-800">Select</h2>
                <p class="text-sm text-gray-400">Dropdown custom · Props <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">options</code> · <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">selected</code> · <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">disabled</code> · <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">error</code></p>
            </div>

            <div class="rounded-2xl border border-gray-100 bg-white shadow-xs divide-y divide-gray-50">
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">défaut</code>
                        <span class="text-xs text-gray-400">Aucune sélection</span>
                    </div>
                    <div class="w-72">
                        <x-form.select name="ex_select1" label="Pays" placeholder="Choisir un pays..."
                                       :options="[
                        ['value' => 'fr', 'label' => 'France'],
                        ['value' => 'be', 'label' => 'Belgique'],
                        ['value' => 'ch', 'label' => 'Suisse'],
                        ['value' => 'de', 'label' => 'Allemagne'],
                        ['value' => 'es', 'label' => 'Espagne'],
                    ]"
                        />
                    </div>
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">selected="fr"</code>
                        <span class="text-xs text-gray-400">Valeur pré-sélectionnée</span>
                    </div>
                    <div class="w-72">
                        <x-form.select name="ex_select2" label="Pays" selected="fr"
                                       :options="[
                        ['value' => 'fr', 'label' => 'France'],
                        ['value' => 'be', 'label' => 'Belgique'],
                        ['value' => 'ch', 'label' => 'Suisse'],
                    ]"
                                       hint="Modifiable à tout moment."
                        />
                    </div>
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">error</code>
                        <span class="text-xs text-gray-400">État erreur</span>
                    </div>
                    <div class="w-72">
                        <x-form.select name="ex_select3" label="Catégorie" error="Veuillez sélectionner une catégorie."
                                       :options="[
                        ['value' => '1', 'label' => 'Design'],
                        ['value' => '2', 'label' => 'Développement'],
                        ['value' => '3', 'label' => 'Marketing'],
                    ]"
                        />
                    </div>
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">:disabled="true"</code>
                        <span class="text-xs text-gray-400">Désactivé</span>
                    </div>
                    <div class="w-72">
                        <x-form.select name="ex_select4" label="Pays" selected="fr" :disabled="true"
                                       :options="[
                        ['value' => 'fr', 'label' => 'France'],
                        ['value' => 'be', 'label' => 'Belgique'],
                    ]"
                        />
                    </div>
                </div>
            </div>
        </section>

        {{-- 07· Autocomplete --}}
        <section class="flex flex-col gap-6">
            <div class="px-6 py-4 border-b border-gray-100">
                <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">07</span>
                <h2 class="text-lg font-semibold text-gray-800">Autocomplete</h2>
                <p class="text-sm text-gray-400 mt-0.5">Sélection avec filtrage par saisie</p>
            </div>
            <div class="rounded-2xl border border-gray-100 bg-white shadow-xs divide-y divide-gray-50">
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">défaut</code>
                        <span class="text-xs text-gray-400">Aucune sélection</span>
                    </div>
                    <div class="w-72">
                        <x-form.autocomplete
                            name="ex_auto1"
                            label="Pays"
                            placeholder="Choisir un pays..."
                            :options="[
                        ['value' => 'fr', 'label' => 'France'],
                        ['value' => 'be', 'label' => 'Belgique'],
                        ['value' => 'ch', 'label' => 'Suisse'],
                        ['value' => 'de', 'label' => 'Allemagne'],
                        ['value' => 'es', 'label' => 'Espagne'],
                        ['value' => 'it', 'label' => 'Italie'],
                        ['value' => 'pt', 'label' => 'Portugal'],
                    ]"
                        />
                    </div>
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">selected="fr"</code>
                        <span class="text-xs text-gray-400">Valeur pré-sélectionnée</span>
                    </div>
                    <div class="w-72">
                        <x-form.autocomplete
                            name="ex_auto2"
                            label="Pays"
                            selected="fr"
                            :options="[
                        ['value' => 'fr', 'label' => 'France'],
                        ['value' => 'be', 'label' => 'Belgique'],
                        ['value' => 'ch', 'label' => 'Suisse'],
                    ]"
                            hint="Modifiable à tout moment."
                        />
                    </div>
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">error</code>
                        <span class="text-xs text-gray-400">État erreur</span>
                    </div>
                    <div class="w-72">
                        <x-form.autocomplete
                            name="ex_auto3"
                            label="Ville"
                            error="Veuillez sélectionner une ville."
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
                        <span class="text-xs text-gray-400">Désactivé</span>
                    </div>
                    <div class="w-72">
                        <x-form.autocomplete
                            name="ex_auto4"
                            label="Pays"
                            selected="fr"
                            :disabled="true"
                            :options="[
                        ['value' => 'fr', 'label' => 'France'],
                        ['value' => 'be', 'label' => 'Belgique'],
                    ]"
                        />
                    </div>
                </div>
            </div>
        </section>

        {{-- 08· Date --}}
        <section class="flex flex-col gap-6">
            <div class="px-6 py-4 border-b border-gray-100">
                <span class="text-xs font-medium tracking-widest text-gray-400 uppercase">08</span>
                <h2 class="text-lg font-semibold text-gray-800">Date</h2>
                <p class="text-sm text-gray-400 mt-0.5">Sélecteur de date avec calendrier custom</p>
            </div>
            <div class="rounded-2xl border border-gray-100 bg-white shadow-xs divide-y divide-gray-50">
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">défaut</code>
                        <span class="text-xs text-gray-400">Aucune date</span>
                    </div>
                    <div class="w-72">
                        <x-form.date name="ex_date1" label="Date de naissance" />
                    </div>
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">value="2024-03-15"</code>
                        <span class="text-xs text-gray-400">Date pré-remplie</span>
                    </div>
                    <div class="w-72">
                        <x-form.date name="ex_date2" label="Date de début" value="2024-03-15" hint="Format JJ/MM/AAAA." />
                    </div>
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">error</code>
                        <span class="text-xs text-gray-400">État erreur</span>
                    </div>
                    <div class="w-72">
                        <x-form.date name="ex_date3" label="Date d'expiration" error="La date est invalide." />
                    </div>
                </div>
                <div class="flex items-center justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">:disabled="true"</code>
                        <span class="text-xs text-gray-400">Désactivé</span>
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
                <h2 class="text-xl font-semibold text-gray-900 tracking-tight">Color</h2>
                <p class="text-sm text-gray-400">Props <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">swatches</code> et <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 text-xs">value</code>.</p>
            </div>

            <div class="rounded-2xl border border-gray-100 bg-white shadow-xs divide-y divide-gray-50">
                <div class="flex items-start justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">défaut</code>
                        <span class="text-xs text-gray-400">Swatches + picker custom</span>
                    </div>
                    <div class="flex-1">
                        <x-form.color name="ex_color" label="Couleur de marque" hint="Choisissez parmi les swatches ou une couleur libre."/>
                    </div>
                </div>
                <div class="flex items-start justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">value + error</code>
                        <span class="text-xs text-gray-400">Valeur initiale + état erreur</span>
                    </div>
                    <div class="flex-1">
                        <x-form.color name="ex_color2" label="Couleur secondaire" value="#ef4444" error="Cette couleur est déjà utilisée."/>
                    </div>
                </div>
                <div class="flex items-start justify-between px-6 py-4 gap-8">
                    <div class="flex flex-col gap-0.5 w-64 shrink-0">
                        <code class="text-xs font-medium text-indigo-500">disabled</code>
                        <span class="text-xs text-gray-400">Non modifiable</span>
                    </div>
                    <div class="flex-1">
                        <x-form.color name="ex_color3" label="Couleur verrouillée" value="#14b8a6" :disabled="true"/>
                    </div>
                </div>
            </div>
        </section>




        {{-- Les sections suivantes seront ajoutées au fur et à mesure --}}

    </div>
@endsection
