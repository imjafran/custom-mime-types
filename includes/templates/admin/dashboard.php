<div class="cmt_wrapper bg-white relative" id="cmt_app">
    <div class="absolute top-0 left-0 w-full cmt_loader">
        <div class="overflow-hidden h-1 text-xs flex bg-sky-50 relative">
            <div data-loader style="width: 15%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-sky-300"></div>
        </div>
    </div>

    <!-- navigation  -->

    <nav class="flex items-center bg-gray-100">
        <h3 class="mx-4 font-bold text-lg">Custom MIME Types</h3>
        <div class="flex text-sm uppercase items-center font-semibold">
            <a href="#mimes" @click="show('mimes')" class="tracking-wide text-gray-700 hover:bg-sky-500 hover:text-white transition duration-150 px-8 py-4 border-l border-gray-200 focus:ring-0 focus:border-0">Mimes</a>
            <a href="#settings" @click="show('settings')" class="tracking-wide text-gray-700 hover:bg-sky-500 hover:text-white transition duration-150 px-8 py-4">Settings</a>
        </div>
    </nav>

    <!-- main  -->
    <div class="main m-1 p-2">
        <!-- mime types  -->
        <section data-content="mimes" style="display: none;">
            <div class="flex justify-between flex-col sm:flex-row gap-3">
                <div class="text-sm w-full overflow-auto">
                    <div class="text-right mb-3 flex items-center justify-between">
                        <div class="flex items-center h-10">
                            <select class="form-select px-4 py-3 h-10 mr-2">
                                <option v-for="n in [10, 50, 100, 500, -1]" :value="n">Show {{n == -1 ? 'All' : n}}</option>
                            </select>

                            <input type="text" v-model="search" class="form-input text-sm px-2 py-2 h-10" placeholder="Search Extention">
                        </div>
                        <a href="#" @click.prevent="newExt()" class="px-4 py-2 rounded-sm bg-sky-300 cursor-pointer bg-sky-50 hover:bg-sky-400 inline-flex items-center justify-center text-white hover:text-white">Add new</a>
                    </div>
                    <div class="overflow-auto w-full">
                        <table class="mb-6 table-auto w-full p-0 m-0 bg-gray-50 border border-gray-100 overflow-hidden rounded-sm overflow-hidden">
                            <thead class="border-b border-gray-200">
                                <tr class="bg-gray-100 text-xs text-gray-500">
                                    <th scope="col" class="max-w-20 text-left font-normal px-3 py-3 border-r border-gray-200">Extension</th>
                                    <th scope="col" class="text-left font-normal px-3 py-3 border-r border-gray-200">Types</th>
                                    <th scope="col" class="text-left font-normal px-3  border-r border-gray-200">Permissions</th>
                                    <th scope="col" class="text-center font-normal px-3  border-r border-gray-200">Status</th>
                                    <th scope="col" class="text-right px-3 font-normal">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(mime, ext) in extentions" class="hover:bg-white transition duration-150 cursor-pointer border-b border-gray-100" :class="{'bg-white' : current.extention == mime.extention && mode == 'edit'}">
                                    <td class="px-3 max-w-20 font-bold  border-r border-gray-100 " @click.prevent="edit(ext)">.{{ext}}</td>
                                    <td class="px-3 max-w-64 border-r border-gray-100 " @click.prevent="edit(ext)">{{mime.types}}</td>
                                    <td class="px-3  border-r border-gray-100 " @click.prevent="edit(ext)">{{mime_roles(mime)}}</td>
                                    <td class="px-3 text-center border-r border-gray-100 " @click.prevent="edit(ext)">{{mime.enabled ? 'Enabled' : 'Disabled'}}</td>
                                    <td class="h-12 text-right px-3 flex items-center justify-start">
                                        <a href="#" :title="`(mime.enabled ? 'Disable' : 'Enable') .${mime.extention}`" @click.prevent="mime.enabled = !mime.enabled; saveExtentions()" class="mr-1 w-8 h-8 rounded-sm transition duration-150 inline-flex items-center justify-center focus:ring-0" :class="mime.enabled ? ['bg-red-200'] : ['bg-green-200']"><span class="dashicons text-white" :class="mime.enabled ? 'dashicons-no' : 'dashicons-yes'"></span></a>
                                        <!-- <a href="#" :class="{'bg-sky-500' : current.extention == mime.extention && mode == 'edit'}" @click.prevent="edit(ext)" class="mx-1 bg-sky-200 text-gray-400 w-8 h-8 rounded-sm hover:bg-sky-400 transition duration-150 inline-flex items-center justify-center"><span class="dashicons dashicons-edit text-white"></span></a> -->
                                        <a href="#" v-if="!mime.delete" @click.prevent="mime.delete = true" :class="mime.delete ? ['bg-red-400'] : ['bg-red-100']" class="text-gray-400 w-8 h-8 rounded-sm hover:bg-red-400 transition duration-150 inline-flex items-center justify-center"><span class="dashicons dashicons-trash text-white"></span></a>
                                        <a href="#" v-if="mime.delete" @click.prevent="deleteMime(ext)" class="ml-1 bg-red-100 text-red-400 px-3 hover:text-white h-8 rounded-sm hover:bg-red-400 hover:border hover:border-gray-100 transition duration-150 inline-flex items-center justify-center">Delete</a>
                                        <a href="#" v-if="mime.delete" @click.prevent="mime.delete = false" class="ml-1 bg-gray-200 text-gray-400 px-3 hover:text-gray-500 h-8 rounded-sm hover:bg-gray-100 hover:border hover:border-gray-100 transition duration-150 inline-flex items-center justify-center">Cancel</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="max-w-96">

                    <!-- add type  -->
                    <div class="bg-white rounded-sm">
                        <div class="bg-gray-50 border border-gray-200 rounded-sm overflow-hidden">
                            <h3 class="py-3 text-center bg-gray-100 text-lg border-b border-gray-200">{{mode == 'new' ? 'Add Mime' : 'Edit Mime'}}</h3>
                            <div class="p-4">

                                <div class="mb-4">
                                    <label for="" class="text-gray-400 mb-2 block text-xs">Extention</label>
                                    <input type="text" @input="strip_extention" v-model="current_extention" placeholder="Extention" class="form-input tracking-wider px-6">
                                </div>

                                <div class="mb-4">
                                    <label for="" class="text-gray-400 mb-2 block text-xs">Types</label>
                                    <input type="text" @input="strip_extention" v-model="current.types" placeholder="Types" class="form-input tracking-wide px-6">
                                </div>

                                <div class="mb-4" v-show="mode == 'new'">
                                    <label for="" class="text-gray-400 mb-2 block text-xs">Suggestions</label>
                                    <div class="relative">
                                        <div class="w-full  flex items-center flex-wrap gap-1">
                                            <button v-for="(types, ext) in suggestions" @click.prevent="current_extention = ext; current.types = types" class="bg-sky-300 transition duration-150 opacity-75 hover:opacity-100 text-white rounded-sm inline-flex items-center justify-center px-4 py-2 text-sm tracking-wide">.{{ext}}</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="text-gray-400 mb-2 block text-xs">Enabled / Disabled</label>
                                    <div class="">
                                        <button @click="current.enabled = ! current.enabled" class="rounded-sm inline-block overflow-hidden  px-4 py-2" :class="current.enabled ? ['bg-sky-400', 'text-white'] : ['bg-gray-200', 'text-gray-500']">{{current.enabled ? 'Enabled' : 'Disabled' }}</button>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="text-gray-400 mb-2 block text-xs">Role Permissions</label>
                                    <div class="relative">
                                        <div class="w-full  flex items-center flex-wrap gap-1">
                                            <button v-for="(label, role) in roles" :class="current.roles.includes(role) ? ['bg-sky-400'] : ['bg-gray-200', 'text-gray-500']" @click.prevent="toggleRole(role)" class="transition duration-150 text-white rounded-sm inline-flex items-center justify-center px-4 py-2 text-sm tracking-wide">{{label}}</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 mb-4">
                                    <div class="my-2 px-4 py-4 rounded-md bg-red-50 text-red-400 text-sm" v-if="error">{{error}}</div>
                                    <button @click.prevent="saveCurrent()" v-if="!error" class="bg-sky-500 rounded-sm px-8 py-2 text-lg tracking-wide  text-white hover:bg-sky-600 transition duration-150">Save</button>
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