<x-admin-layout>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-end p-2 bg-white">
                    <a href="" class="px-4 py-2 text-white bg-blue-700 hover:bg-blue-600 rounded-md">Create Permission</a>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-6">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-6 text-right">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $permission->name }}
                                    </th>
                                    <td class="px-6 py-4 text-right">
                                        <a href="#"
                                            class="font-medium text-green-600 dark:text-green-500 hover:underline">Edit</a>
                                        <a href="#"
                                            class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
