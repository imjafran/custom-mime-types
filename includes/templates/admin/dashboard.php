<div class="cmt_wrapper bg-white relative" id="cmt_app">
    <div class="absolute top-0 left-0 w-full cmt_loader">
        <div class="overflow-hidden h-1 text-xs flex bg-sky-50 relative">
            <div data-loader style="width: 15%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-sky-300"></div>
        </div>
    </div>

    <!-- navigation  -->

    <nav class="cmt_nav">
        <h3 class="cmt_header">Custom MIME Types</h3>
        <div class="cmt_ul">
            <a data-href="mimes" href="#mimes" @click="show('mimes')" @keydown.left="show('mimes')" @keydown.right="show('settings')" class="cmt_nav_a">Mimes</a>
            <a data-href="settings" href="#settings" @click="show('settings')" @keydown.left="show('mimes')" @keydown.right="show('settings')" class="cmt_nav_a">Settings</a>
        </div>
    </nav>

    <!-- main  -->
    <div class="main p-6">
        <!-- mime types  -->
        <section data-content="mimes" style="display: none;">
            <div class="flex justify-between flex-col sm:flex-row gap-3">
                <div class="w-full overflow-auto">
                    <div class="text-right mb-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center"><input type="text" v-model="search" @input="pagination = 1" class="rounded-sm form-input text-sm px-2 py-2 h-8 sm:h-9" placeholder="Search Extention"></div>
                            <a href="#" @click.prevent="newExt()" class="sm:mt-0 px-4 py-2 rounded-sm bg-sky-300 cursor-pointer bg-sky-50 hover:bg-sky-400 inline-flex items-center justify-center text-white hover:text-white focus:text-white">Add new</a>
                        </div>

                    </div>
                    <div class="overflow-auto w-full">
                        <table v-if="Object.keys(getExtentions).length" class="mb-4 table-auto w-full p-0 m-0 bg-gray-50 border border-gray-100 overflow-hidden rounded-sm overflow-hidden">
                            <thead class="border-b border-gray-200">
                                <tr class="bg-gray-100 text-xs text-gray-500">
                                    <th scope="col" class="max-w-20 text-left font-normal px-3 py-3 border-r border-gray-200">{{Object.keys(getExtentions).length}} Extension{{Object.keys(getExtentions).length > 1 ? 's': '' }}</th>
                                    <th scope="col" class="text-left font-normal px-3 py-3 border-r border-gray-200">Types</th>
                                    <th scope="col" class="text-left font-normal px-3  border-r border-gray-200">Permissions</th>
                                    <th scope="col" class="text-center font-normal px-3  border-r border-gray-200">Status</th>
                                    <th scope="col" class="text-right px-3 font-normal">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(mime, ext) in getExtentions" class="hover:bg-white transition duration-150 cursor-pointer border-b border-gray-100" :class="{'bg-white' : current_extention == ext && mode == 'edit'}">
                                    <td class="px-3 max-w-20 font-bold  border-r border-gray-100 " @click.prevent="edit(ext)">.{{ext}}</td>
                                    <td class="px-3 max-w-64 border-r border-gray-100 text-sm" @click.prevent="edit(ext)">{{mime.types}}</td>
                                    <td class="px-3  border-r border-gray-100 text-sm" @click.prevent="edit(ext)">{{mime_roles(mime)}}</td>
                                    <td class="px-3 text-center border-r border-gray-100 " @click.prevent="edit(ext)">{{mime.enabled ? 'Enabled' : 'Disabled'}}</td>
                                    <td class="h-12 text-right px-3 flex items-center justify-start">
                                        <a href="#" :title="`(mime.enabled ? 'Disable' : 'Enable') .${mime.extention}`" @click.prevent="mime.enabled = !mime.enabled; saveSettings()" class="mr-1 w-8 h-8 rounded-sm transition duration-150 inline-flex items-center justify-center focus:ring-0" :class="mime.enabled ? ['bg-red-200'] : ['bg-green-200']"><span class="dashicons text-white" :class="mime.enabled ? 'dashicons-no' : 'dashicons-yes'"></span></a>
                                        <!-- <a href="#" :class="{'bg-sky-500' : current.extention == mime.extention && mode == 'edit'}" @click.prevent="edit(ext)" class="mx-1 bg-sky-200 text-gray-400 w-8 h-8 rounded-sm hover:bg-sky-400 transition duration-150 inline-flex items-center justify-center"><span class="dashicons dashicons-edit text-white"></span></a> -->
                                        <a href="#" v-if="!mime.delete" @click.prevent="mime.delete = true" :class="mime.delete ? ['bg-red-400'] : ['bg-red-100']" class="text-gray-400 w-8 h-8 rounded-sm hover:bg-red-400 transition duration-150 inline-flex items-center justify-center"><span class="dashicons dashicons-trash text-white"></span></a>

                                        <a href="#" v-if="mime.delete" @click.prevent="mime.delete = false" class="ml-1 bg-gray-200 text-gray-400 px-3 hover:text-gray-500 h-8 rounded-sm hover:bg-gray-100 hover:border hover:border-gray-100 transition duration-150 inline-flex items-center justify-center">Cancel</a>
                                        <a href="#" v-if="mime.delete" @click.prevent="deleteMime(ext)" class="ml-1 bg-red-100 text-red-400 px-3 hover:text-white h-8 rounded-sm hover:bg-red-400 hover:border hover:border-gray-100 transition duration-150 inline-flex items-center justify-center">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div v-if="Object.keys(getExtentions).length == 0" class="bg-red-100 text-red-400 rounded-md m-3 px-6 py-4 text-center">No Extention Found</div>
                    </div>
                    <div v-if="Object.keys(getExtentions).length" class="flex items-center justify-between mt-2">
                        <button :disabled="pagination == 1" :class="pagination == 1 ? ['bg-gray-100', 'hover:bg-gray-100', 'text-gray-500', 'hover:text-gray-500'] : ['bg-sky-50', 'text-gray-500', 'hover:bg-sky-400', 'hover:text-white']" @click.prevent="--pagination" class="inline-flex items-center px-3 py-2 roundded-sm transition duration-150"><span class="dashicons dashicons-arrow-left-alt2"></span> Previous</button>
                        <button :disabled="pagination == max_pagination" :class="pagination == max_pagination ? ['bg-gray-100', 'hover:bg-gray-100', 'text-gray-500', 'hover:text-gray-500'] : ['bg-sky-50', 'text-gray-500', 'hover:bg-sky-400', 'hover:text-white']" @click.prevent="++pagination" class="inline-flex items-center rounded-sm px-3 py-2  transition duration-150">Next <span class="dashicons dashicons-arrow-right-alt2"></span></button>

                    </div>

                </div>
                <div class="max-w-96">

                    <!-- add type  -->
                    <div class="bg-white rounded-sm" id="edit_mime">
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
                                            <button v-for="(types, ext) in suggestions" @click.prevent="current_extention = ext; current.types = types" class="bg-sky-300 transition duration-150 opacity-75 hover:opacity-100 text-white rounded-sm inline-flex items-center justify-center px-4 py-2 tracking-wide">.{{ext}}</button>
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
                                            <button v-for="(label, role) in roles" :class="current.roles.includes(role) ? ['bg-sky-400'] : ['bg-gray-200', 'text-gray-500']" @click.prevent="toggleRole(role)" class="transition duration-150 text-white rounded-sm inline-flex items-center justify-center px-4 py-2  tracking-wide">{{label}}</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 mb-4">
                                    <div class="my-2 px-4 py-4 rounded-md bg-green-50 text-green-400 text-sm border border-green-100" v-if="savedCurrent">Saved Mime Type</div>
                                    <div class="my-2 px-4 py-4 rounded-md bg-red-50 text-red-400 text-sm border border-red-100" v-if="error">{{error}}</div>
                                    <div>
                                        <button @click.prevent="saveCurrent()" v-if="!error" class="rounded-sm text-lg bg-sky-300 hover:bg-sky-500 text-white focus:text-white px-8 py-2 transition duration-150">Save</button>
                                        <button @click.prevent="newExt()" v-if="mode == 'edit'" class="rounded-sm text-lg ml-2 bg-gray-100 hover:bg-gray-300 text-gray-500  px-8 py-2 transition duration-150">Cancel</button>
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
            <h3 class="mb-3 text-xl text-gray-600">Common Settings</h3>
            <div class="p-4 rounded-md border border-gray-200">
                <div class="bg-gray-100 mb-5 text-gray-500 px-4 py-6 rounded-sm text-sm tracking-wide">
                    <div><span class="font-bold">Important: </span>Maximum allowed upload size <span class="uppercase font-bold">{{size(wp_max_upload_size)}}</span> is configured by the server itself.</div>
                    <div>It's <span class="uppercase font-bold">NOT POSIBLE</span> to increase the limit more than {{size(wp_max_upload_size)}} using a plugin. Contact your hosting provider to increase the limit</div>
                </div>
                <div class="mb-4 px-4">
                    <div class="flex items-center flex-col sm:flex-row">
                        <label for="" class="w-64 text-gray-500 mb-2 mb:0">Maximum Upload Size</label>
                        <div class="w-full flex items-center">
                            <input v-model="max_upload_size" @input="strip_max_upload_size" type="text" class="form-input inline-block h-12 w-12 px-4" size="12" placeholder="Size">
                            <div class="relative">
                                <button @click="max_file_size_dropdown = !max_file_size_dropdown" class="border border-gray-100 relative z-10 block bg-white px-6 h-12 focus:outline-none flex items-center">
                                    <span class="mr-2  text-gray-500">{{size_unit.toUpperCase()}}</span>
                                    <svg class="h-5 w-5 text-gray-800" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div v-show="max_file_size_dropdown" @click="max_file_size_dropdown = false" class="fixed inset-0 h-full w-full z-10"></div>

                                <div v-show="max_file_size_dropdown" class="absolute right-0  w-32 bg-white rounded-md shadow-xl z-20">
                                    <a v-for="mb in Object.keys(size_units)" @click.prevent="size_unit = mb; max_file_size_dropdown = false" :class="size_unit == mb ? ['bg-sky-400', 'text-white'] : ['text-gray-500']" href="#" class="block px-4 py-2 text-sm capitalize hover:bg-sky-500 hover:text-white focus:text-white">
                                        {{mb.toUpperCase()}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-4 px-4">
                    <div class="flex items-center flex-col sm:flex-row">
                        <label for="" class="w-64"></label>
                        <div class="w-full">
                            <div v-if="savedSize" class="bg-green-100 text-green-400 p-3 rounded-sm mb-2">Saved!</div>
                            <div v-if="limit_error" class="bg-red-100 text-red-400 p-3 rounded-sm mb-2">You can't set value more than {{size(wp_max_upload_size)}}</div>
                            <button v-else @click.prevent="saveSize()" class="bg-sky-300 hover:bg-sky-500 text-white focus:text-white px-8 py-2 transition duration-150 rounded-sm text-lg ">Save Settings</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>


<style>
    #wpcontent {
        background: #fff;
        padding: 0 !important;
    }
</style>