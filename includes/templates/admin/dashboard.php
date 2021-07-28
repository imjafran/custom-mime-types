<div class="cmt_wrapper bg-white relative" id="cmt_app">
    <div class="absolute top-0 left-0 w-full cmt_loader">
        <div class="overflow-hidden h-1 text-xs flex bg-sky-50 relative">
            <div data-loader style="width: 15%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-sky-300"></div>
        </div>
    </div>

    <!-- navigation  -->

    <nav class="flex items-center bg-gray-100">
        <h3 class="mx-4 font-bold text-lg">Custom MIME Types</h3>
        <div class="flex items-center font-semibold">
            <a href="#mimes" @click="show('mimes')" class="tracking-wide text-gray-700 hover:bg-sky-500 hover:text-white transition duration-150 px-6 py-3 border-l border-gray-200 focus:ring-0 focus:border-0">Mimes</a>
            <a href="#settings" @click="show('settings')" class="tracking-wide text-gray-700 hover:bg-sky-500 hover:text-white transition duration-150 px-6 py-3 ">Settings</a>
        </div>
    </nav>

    <!-- main  -->
    <div class="main m-1 p-2">
        <!-- mime types  -->
        <section data-content="mimes" style="display: none;">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div>
                    <table class="mb-6 table-auto w-full p-0 m-0 bg-gray-50 border border-gray-100 rounded-sm overflow-hidden">
                        <thead class="border-b border-gray-200">
                            <tr class="bg-gray-100">
                                <th scope="col" class="w-12 h-8 text-left px-3">#</th>
                                <th scope="col" class="text-left">Extension</th>
                                <th scope="col" class="text-left">Permissions</th>
                                <th scope="col" class="text-left">Status</th>
                                <th scope="col" class="text-right px-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="mime_type in 10" class="hover:bg-white transition duration-150">
                                <td class="h-10  px-3">{{mime_type}}</td>
                                <td class="">.docs</td>
                                <td class="">Admin, Editor, Author</td>
                                <td class="">Enabled</td>
                                <td class="h-10 flex items-center justify-end text-right px-3">
                                    <a href="#" class="bg-green-300 text-gray-500 w-6 h-6 rounded-sm hover:bg-green-500 transition duration-150 inline-flex items-center justify-center"><span class="dashicons dashicons-yes text-white"></span></a>
                                    <a href="#" class="mx-2 bg-sky-300 text-gray-500 w-6 h-6 rounded-sm hover:bg-sky-500 transition duration-150 inline-flex items-center justify-center"><span class="dashicons dashicons-edit text-white"></span></a>
                                    <a href="#" class="bg-red-300 text-gray-500 w-6 h-6 rounded-sm hover:bg-red500 transition duration-150 inline-flex items-center justify-center"><span class="dashicons dashicons-trash text-white"></span></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div>

                    <!-- add type  -->
                    <div class="bg-white rounded-sm">
                        <div class="mb-4">
                            <a href="#" class="h-12 w-full cursor-pointer bg-sky-50 hover:bg-sky-400 flex items-center justify-center text-lg hover:text-white">Add new</a>
                        </div>

                        <div class="bg-gray-50 border border-gray-200 rounded-sm overflow-hidden">
                            <h3 class="py-3 text-center bg-gray-100 text-lg">Edit Type</h3>
                            <div class="p-4">
                                <div class="mb-3">
                                    <label for="" class="text-gray-400 mb-2 block text-xs">Type</label>
                                    <input type="text" class="block form-input px-4 py-3 rounded-none w-full bg-gray-400">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="text-gray-400 mb-2 block text-xs">Permissions</label>
                                    <div class="relative">
                                        <div class="w-full p-1 flex items-center flex-wrap bg-white gap-1">
                                            <button v-for="n in 10" class="group bg-sky-500 transition duration-150 opacity-75 hover:opacity-100 text-white rounded-sm inline-flex items-center justify-center px-3 py-1">Administrator</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>

        <!-- settings  -->
        <section data-content="settings" style="display: none;">
            settings
        </section>
    </div>
</div>


<style>
    #wpcontent {
        background: #fff;
        padding: 0;
    }
</style>