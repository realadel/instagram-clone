<x-app-layout>

    <form action="{{ route('update.profile', $user->username) }}" method="POST" enctype="multipart/form-data" class="pb-5">
        @csrf
        @method('PATCH')
        <div class="space-y-12 bg-white p-7 rounded-xl">

            @session('success')
            <div id="success" class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
                <i class='bx bxs-check-circle bx-tada text-3xl' ></i>
                <div>
                    <span class="font-bold">Done!</span> Your Profile has been updated successfully.
                </div>
            </div>
            @endsession

            <div>
                <h1 class="text-center text-3xl font-bold leading-7 text-gray-900 pt-7">Edit Your Profile</h1>
                <p class="text-center text-sm leading-6 text-gray-600">Customize your profile from here.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">
                    <div class="sm:col-span-4">

                        <label for="photo" class="text-xl font-medium leading-6 text-gray-900 flex justify-center mb-3">{{__('Avatar')}}</label>

                        <div class="flex justify-center">
                            <img src="{{ asset($user->avatar) }}" alt="" class="h-40 w-40 text-gray-300 rounded-full">
                        </div>

                        @error('avatar')
                            <p class="text-center text-red-700 mt-4">{{ $message }}</p>
                        @enderror

                        <div class="col-span-full mt-2 mb-5 flex justify-center">
                            <div class="mt-2 flex items-center gap-x-3">
                                <input type="file" name="avatar">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 my-2">
                            <div class="sm:col-span-3">
                                <label for="first-name"
                                       class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                                <div class="mt-2">
                                    <input type="text" name="name" id="name" value="{{ $user->name }}"
                                           autocomplete="given-name"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6">
                                </div>
                                @error('name')
                                    <p class="text-red-700">{{ $message }}</p>
                                @enderror

                            </div>

                            <div class="sm:col-span-3">
                                <label for="username"
                                       class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                                <div class="mt-2">
                                    <input type="text" name="username" id="username" value="{{ $user->username }}"
                                           autocomplete="family-name"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6">
                                </div>
                                @error('username')
                                    <p class="text-red-700">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-span-full my-4 mt-10">
                            <div>
                                <label for="bio" class="block text-sm font-medium leading-6 text-gray-900">Bio</label>
                                <textarea
                                    id="bio"
                                    name="bio"
                                    rows="5"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6"
                                    placeholder="Tell the world about you.">{{ $user->bio }}</textarea>
                            </div>
                            <p class="mt-3 text-sm leading-6 text-gray-600">Write a few sentences about yourself.</p>
                            @error('bio')
                                <p class="text-red-700">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="sm:col-span-4">
                            <div class="mt-2">
                                <label for="email"
                                       class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    placeholder="Type your new email."
                                    value="{{ $user->email }}"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6">
                            </div>
                            @error('email')
                                <p class="text-red-700">{{ $message }}</p>
                            @enderror
                        </div>


                    </div>
                </div>

                <div class="pt-3">
                    <h1 class="text-center text-3xl font-bold leading-7 text-gray-900 pt-7">Change Password</h1>
                    <p class="text-center text-sm leading-6 text-gray-600">You can change your password from here.</p>

                    <div class="sm:col-span-4">
                        <div class="mt-2">
                            <label for="current_password" class="block text-sm font-medium leading-6 text-gray-900">Current Password</label>
                            <input
                                id="current_password"
                                name="current_password"
                                type="password"
                                placeholder="Type your old password."
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6">
                        </div>
                        @error('current_password')
                             <p class="text-red-700">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <div class="mt-2">
                                <label for="newPassword" class="block text-sm font-medium leading-6 text-gray-900">New Password</label>
                                <input
                                    type="password"
                                    name="newPassword"
                                    id="newPassword"
                                    placeholder="New password."
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6">
                            </div>
                            @error('newPassword')
                                <p class="text-red-700">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <div class="mt-2">
                                <label for="newPassword_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Password Confirmation</label>
                                <input
                                    type="password"
                                    name="newPassword_confirmation"
                                    id="newPassword_confirmation"
                                    placeholder="Re-enter your new password."
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6">
                            </div>
                            @error('newPassword')
                                <p class="text-red-700">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                <div>

                    <h1 class="text-3xl font-bold leading-7 text-gray-900 pt-9">Privacy</h1>
                    <p class="text-sm leading-6 text-gray-600">Decide who can see your posts.</p>
                    <div class="mt-3 space-y-10">
                        <fieldset>
                            <div class="space-y-6">
                                <div class="flex items-center gap-x-3">
                                    <input
                                        {{ $user->isPrivate ? 'checked' : '' }}
                                        id="isPrivate"
                                        name="isPrivate"
                                        type="checkbox"
                                        class="h-5 w-5 border-black focus:ring-transparent text-black rounded transition">
                                    <label for="isPrivate" class="block text-sm font-medium leading-6 text-gray-900">Private Account</label>
                                    <p class="text-sm leading-6 text-gray-600">This is mean nobody can see your posts except your friends.</p>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-x-6">
                <a href="{{ route('user.profile', $user->username) }}" type="button" class="text-sm font-semibold leading-6 text-gray-900 p-1">Cancel</a>
                <x-primary-button>{{__('Update')}}</x-primary-button>
            </div>
        </div>
    </form>

    <script>
        let isPrivate = document.getElementById('isPrivate');
        isPrivate.addEventListener('change', function () {
            if (isPrivate.hasAttribute('checked')) {
                isPrivate.removeAttribute('checked');
            } else {
                isPrivate.setAttribute('checked', 'checked');
            }
        });

        setTimeout(function(){
            if (document.getElementById('success')){
                document.getElementById('success').remove();
            }
        },5000);
    </script>

</x-app-layout>
