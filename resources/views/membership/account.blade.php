<div
    class="flex flex-col overflow-hidden hover:shadow-blue-300 items-center relative bg-white shadow-md rounded-md p-4 min-w-[300px]">
    <div
        class="absolute pl-4 pr-6 py-1 left-0 top-0 text-lg md:text-xl lg:text-2xl  shadow-md rounded-br-full bg-[#002e59] text-white">
        Account Information</div>
    <div class="mt-8 grid md:grid-cols-2 gap-x-2 gap-y-6 w-full">
        <!-- User Name -->
        <div class="md:col-span-2 md:w-1/2">
            <x-input-label for="username">Username</x-input-label>
            <x-text-input type="text" id="username" class="block mt-1 w-full" name="username" :value="old('username')"
                required autofocus />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>
        <!-- Password -->
        <div>
            <x-input-label for="password">Password</x-input-label>
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation">Confirm Password</x-input-label>
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required  />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
    </div>
    <!-- 2 Column Grid -->
</div>
