<x-admin-layout>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex p-2 bg-white">
                    <a href="{{ route('admin.permissions.index') }}"
                        class="px-4 py-2 text-white bg-gray-700 hover:bg-gray-600 rounded-md">Back</a>
                </div>
                <div class="flex flex-col py-8 px-4 mx-auto lg:py-16">
                    @if (empty($permission->id))
                        <form action="{{ route('admin.permissions.store') }}" method="POST">
                        @else
                            <form action="{{ route('admin.permissions.update', $permission) }}" method="POST">
                                @method('PATCH')
                    @endif
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Permission
                                Name</label>
                            <input type="text" name="name" id="name" value="{{ $permission->name }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Type permission name">
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit"
                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                        {{ empty($permission->id) ? 'Create' : 'Update' }}
                    </button>
                    </form>
                </div>

                @unless (empty($permission->id))
                    <div class="mt-6 py-2 px-4">
                        <h2 class="text-2xl dark:text-slate-100 font-semibold">Role Permissions</h2>
                        <div class="flex space-x-1 mt-2 px-2 pb-1">
                            @if ($permission->roles)
                                @foreach ($permission->roles as $permission_role)
                                    <form
                                        action="{{ route('admin.permissions.roles.remove', [$permission->id, $permission_role->id]) }}"
                                        onsubmit="return confirm('Are you sure you want to remove?')"
                                        class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">{{ $permission_role->name }}</button>
                                    </form>
                                @endforeach
                            @endif
                        </div>
                        <div class="max-w-xl py-3">
                            <form action="{{ route('admin.permissions.roles', $permission->id) }}" method="POST">
                                @csrf
                                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                    <div class="sm:col-span-2">
                                        <label for="role"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                                            Roles</label>
                                        <select id="role" name="role"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="">Assign Role</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit"
                                    class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                    Assign
                                </button>
                            </form>
                        </div>
                    </div>
                @endunless

            </div>
        </div>
    </div>
</x-admin-layout>
