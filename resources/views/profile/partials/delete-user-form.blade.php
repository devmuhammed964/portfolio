<section
    x-data="{
        deleteModalOpen: {{ $errors->userDeletion->isNotEmpty() ? 'true' : 'false' }}
    }"
>
    <div
        class="
            flex
            flex-col
            gap-5
            sm:flex-row
            sm:items-center
            sm:justify-between
        "
    >
        <div>
            <p
                class="
                    text-xs
                    font-medium
                    uppercase
                    tracking-[0.18em]
                    text-red-300/60
                "
            >
                Tehlikeli İşlemler
            </p>

            <h3
                class="
                    mt-2
                    text-lg
                    font-semibold
                    text-white
                "
            >
                Hesabı Sil
            </h3>

            <p
                class="
                    mt-2
                    max-w-2xl
                    text-sm
                    leading-6
                    text-slate-400
                "
            >
                Hesabınızı sildiğinizde kullanıcı bilgileriniz
                kalıcı olarak kaldırılır. Bu işlem geri alınamaz.
            </p>
        </div>

        <button
            type="button"
            x-on:click="deleteModalOpen = true"
            class="
                inline-flex
                shrink-0
                items-center
                justify-center
                rounded-xl
                border
                border-red-500/20
                bg-red-500/10
                px-5
                py-3
                text-sm
                font-semibold
                text-red-300
                transition
                hover:bg-red-500/20
                hover:text-red-200
            "
        >
            Hesabı Sil
        </button>
    </div>

    {{-- DELETE MODAL --}}
    <div
        x-cloak
        x-show="deleteModalOpen"
        x-transition.opacity
        x-on:keydown.escape.window="deleteModalOpen = false"
        class="
            fixed
            inset-0
            z-[100]
            flex
            items-center
            justify-center
            bg-black/75
            p-5
            backdrop-blur-sm
        "
    >
        <div
            x-show="deleteModalOpen"
            x-transition
            x-on:click.outside="deleteModalOpen = false"
            class="
                w-full
                max-w-lg
                overflow-hidden
                rounded-[28px]
                border
                border-white/10
                bg-slate-950
                shadow-2xl
                shadow-black/50
            "
        >
            <form
                method="POST"
                action="{{ route('profile.destroy') }}"
            >
                @csrf
                @method('DELETE')

                <div class="p-6 sm:p-8">

                    <div
                        class="
                            flex
                            h-12
                            w-12
                            items-center
                            justify-center
                            rounded-2xl
                            border
                            border-red-500/20
                            bg-red-500/10
                            text-lg
                            font-semibold
                            text-red-300
                        "
                    >
                        !
                    </div>

                    <h3
                        class="
                            mt-5
                            text-xl
                            font-semibold
                            tracking-tight
                            text-white
                        "
                    >
                        Hesabınızı silmek istediğinize emin misiniz?
                    </h3>

                    <p
                        class="
                            mt-3
                            text-sm
                            leading-6
                            text-slate-400
                        "
                    >
                        Hesabınız ve kullanıcı bilgileriniz kalıcı olarak
                        silinecektir. Devam etmek için mevcut şifrenizi girin.
                    </p>

                    <div class="mt-6">

                        <label
                            for="delete_account_password"
                            class="
                                mb-2
                                block
                                text-sm
                                font-medium
                                text-slate-300
                            "
                        >
                            Mevcut Şifre
                        </label>

                        <input
                            id="delete_account_password"
                            name="password"
                            type="password"
                            autocomplete="current-password"
                            placeholder="Şifrenizi girin"
                            class="
                                w-full
                                rounded-2xl
                                border
                                border-white/10
                                bg-slate-900/80
                                px-4
                                py-3.5
                                text-sm
                                text-white
                                outline-none
                                transition
                                placeholder:text-slate-600
                                focus:border-red-500/40
                                focus:ring-4
                                focus:ring-red-500/5
                            "
                        >

                        @foreach(
                            $errors->userDeletion->get('password')
                            as $message
                        )
                            <p
                                class="
                                    mt-2
                                    text-xs
                                    font-medium
                                    text-red-300
                                "
                            >
                                {{ $message }}
                            </p>
                        @endforeach

                    </div>

                </div>

                <div
                    class="
                        flex
                        flex-col-reverse
                        gap-3
                        border-t
                        border-white/10
                        bg-black/10
                        px-6
                        py-5
                        sm:flex-row
                        sm:justify-end
                    "
                >
                    <button
                        type="button"
                        x-on:click="deleteModalOpen = false"
                        class="
                            inline-flex
                            items-center
                            justify-center
                            rounded-xl
                            border
                            border-white/10
                            bg-white/5
                            px-5
                            py-3
                            text-sm
                            font-medium
                            text-slate-300
                            transition
                            hover:bg-white/10
                            hover:text-white
                        "
                    >
                        Vazgeç
                    </button>

                    <button
                        type="submit"
                        class="
                            inline-flex
                            items-center
                            justify-center
                            rounded-xl
                            border
                            border-red-500/20
                            bg-red-500/10
                            px-5
                            py-3
                            text-sm
                            font-semibold
                            text-red-300
                            transition
                            hover:bg-red-500/20
                            hover:text-red-200
                        "
                    >
                        Hesabı Kalıcı Olarak Sil
                    </button>
                </div>

            </form>
        </div>
    </div>
</section>