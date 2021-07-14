<!-- wrapper  -->

<div class="wrap pushme-admin-wrapper" id="pushme-admin">
    <nav class="pushme-nav bg-indigo-400 flex items-center cursor-pointer uppercase">
        <div class="text-lg px-4 text-white focus:text-white">Pushme</div>
        <a href="#/dashboard" class="px-4 py-3 text-white hover:text-white hover:bg-indigo-500 focus:text-white focus:bg-indigo-500 transition duration-150">Dashboard</a>
        <a href="#/projects" class="px-4 py-3 text-white hover:text-white hover:bg-indigo-500 focus:text-white focus:bg-indigo-500 transition duration-150">Projects</a>
        <a href="#/plans" class="px-4 py-3 text-white hover:text-white hover:bg-indigo-500 focus:text-white focus:bg-indigo-500 transition duration-150">Plans</a>
        <a href="#/users" class="px-4 py-3 text-white hover:text-white hover:bg-indigo-500 focus:text-white focus:bg-indigo-500 transition duration-150">Users</a>
        <a href="#/settings" class="px-4 py-3 text-white hover:text-white hover:bg-indigo-500 focus:text-white focus:bg-indigo-500 transition duration-150">Settings</a>
    </nav>
    <main class="m-0 p-6 pushme-contents">
        <section data-content="dashboard" style="display: none;">
            dashboard
        </section>

        <!-- projects  -->
        <section data-content="projects" style="display: none;">
            <div class="text-right my-4 clear block">
                <a href="" class="button">Add Project</a>

                <div>
                    <form action="">
                        <div class="mb-3">
                            <label for="">Project Name</label>
                            <input type="text">
                        </div>
                    </form>
                </div>
            </div>
            <div class="border border-gray-200 rounded-sm">
                <div class="overflow-auto">
                    <table class="table w-full" id="pushme-projects">
                        <thead class="bg-gray-200 h-8">
                            <tr>
                                <th class="px-3 w-10">ID</th>
                                <th class="text-left">User</th>
                                <th class="text-left">Project Name</th>
                                <th class="text-left">Project Channel</th>
                                <th class="text-left">Push Key</th>
                                <th class="text-left">Fetch Key</th>
                                <th class="text-right px-5">Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="h-10 text-sm" v-for="project in projects.items">
                                <td class="text-center">{{project.id}}</td>
                                <td class="text-left">Jafran Hasan</td>
                                <td class="text-left" @dblclick.prevent="project.edit_name = true" v-on:keyup.enter="project.edit_name = false; update_project(project)">
                                    <input v-if="project.edit_name" type="text" v-model="project.name" class="form-input inline-block px-3 py-2 rounded-sm border border-gray-100">
                                    <span v-else>{{project.name}}</span>
                                </td>
                                <td class="text-left">{{project.channel}}</td>
                                <td class="text-left">{{project.push_key}}</td>
                                <td class="text-left">{{project.fetch_key}}</td>
                                <td class="text-right px-5">
                                    <button v-if="project.active" class="bg-indigo-400 text-white px-3 py-1 text-xs" @click.prevent="project.active = false; update_project(project)">Active</button>
                                    <button v-else class="bg-red-400 text-white px-3 py-1 text-xs" @click.prevent="project.active = true; update_project(project)">Inactive</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="my-4 text-center">
                <button class="bg-indigo-400 text-white px-4 py-2 rounded-sm hover:bg-indigo-500">Load more</button>
            </div>
        </section>

        <!-- plans  -->
        <section data-content="plans" style="display: none;">
            <div class="border border-gray-200 rounded-sm">
                <div class="flex items-center bg-gray-100 py-3 px-4 border-b border-gray-200">
                    <h2 class="font-semibold text-sm text-gray-700 uppercase">Projects</h2>
                </div>
                <div class="py-3 px-4">
                    <table class="table w-full">
                        <thead class="bg-indigo-500 p-0">
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Project Name</th>
                                <th>Project Channel</th>
                                <th>Push Key</th>
                                <th>Fetch Key</th>
                                <th>Active</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </section>
        <section data-content="users" style="display: none;">users</section>
        <section data-content="settings" style="display: none;">settings</section>
    </main>
</div>


<!-- custom styles  -->
<style>
    #wpcontent {
        padding: 0px;
        background: white;
    }
</style>