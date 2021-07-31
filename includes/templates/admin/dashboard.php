<div class="cmt_wrapper" id="cmt_app">

    <!-- loader  -->
    <div class="cmt_loader">
        <div>
            <div data-loader style="width: 15%"></div>
        </div>
    </div>

    <!-- navigation  -->

    <nav class="cmt_nav">
        <h3 class="cmt_header"><?php echo __('Custom MIME Types', 'custommimetypes'); ?></h3>
        <div class="cmt_ul">
            <a data-href="mimes" href="#mimes" @click="show('mimes')" @keydown.left="show('mimes')" @keydown.right="show('filesize')" class="cmt_nav_a"><?php echo __('Mimes', 'custommimetypes'); ?></a>
            <a data-href="filesize" href="#filesize" @click="show('filesize')" @keydown.left="show('mimes')" @keydown.right="show('filesize')" class="cmt_nav_a"><?php echo __('File Size', 'custommimetypes'); ?></a>
        </div>
    </nav>

    <!-- main  -->
    <div class="cmt_main">
        <!-- mime types  -->
        <section data-content="mimes" style="display: none;">
            <div class="cmt_grid">
                <div class="cmt_table_div">
                    <div class="table-bar">
                        <div class="search-bar"><input type="text" v-model="search" @input="pagination = 1" placeholder="<?php echo __('Search Extention', 'custommimetypes'); ?>"></div>
                        <a href="#" @click.prevent="newExt()" class="cmt-new-button"><?php echo __('Add new', 'custommimetypes'); ?></a>
                    </div>
                    <div class="table-container">
                        <table v-if="Object.keys(getExtentions).length" class="cmt-table">
                            <thead class="border-b border-gray-200">
                                <tr class="bg-gray-100 text-xs text-gray-500">
                                    <th scope="col" class="font-normal text-left"><?php echo __('Extension', 'custommimetypes'); ?></th>
                                    <th scope="col" class="mobile_hide text-left"><?php echo __('Types', 'custommimetypes'); ?></th>
                                    <th scope="col" class="text-left"><?php echo __('Permissions', 'custommimetypes'); ?></th>
                                    <th scope="col" class="text-center"><?php echo __('Status', 'custommimetypes'); ?></th>
                                    <th scope="col" class="text-right"><?php echo __('Action', 'custommimetypes'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(mime, ext) in getExtentions" :class="{'bg-white' : current_extention == ext && mode == 'edit'}">
                                    <td @click.prevent="edit(ext)">.{{ext}}</td>
                                    <td class="mobile_hidden" @click.prevent="edit(ext)">{{mime.types}}</td>
                                    <td class="" @click.prevent="edit(ext)">{{mime_roles(mime)}}</td>
                                    <td class="text-center" @click.prevent="edit(ext)">{{mime.enabled ? '<?php echo __('Enabled', 'custommimetypes'); ?>' : '<?php echo __('Disabled', 'custommimetypes'); ?>'}}</td>
                                    <td class="cmt_mime_quick_buttons">
                                        <a href="#" :title="`(mime.enabled ? '<?php echo __('Disable', 'custommimetypes'); ?>' : '<?php echo __('Enable', 'custommimetypes'); ?>') .${mime.extention}`" @click.prevent="mime.enabled = !mime.enabled; saveSettings()" class="button-enabled-disabled" :class="mime.enabled ? ['bg-red-200'] : ['bg-green-200']"><span class="dashicons text-white" :class="mime.enabled ? 'dashicons-no' : 'dashicons-yes'"></span></a>
                                        <a href="#" v-if="!mime.delete" @click.prevent="mime.delete = true" :class="mime.delete ? ['bg-red-400'] : ['bg-red-100']" class="button-delete"><span class="dashicons dashicons-trash text-white"></span></a>
                                        <a href="#" v-if="mime.delete" @click.prevent="deleteMime(ext)" class="button-delete-confirm"><?php echo __('Delete', 'custommimetypes'); ?></a>
                                        <a href="#" v-if="mime.delete" @click.prevent="mime.delete = false" class="button-delete-cancel"><?php echo __('Cancel', 'custommimetypes'); ?></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div v-if="Object.keys(getExtentions).length == 0" class="error-message"><?php echo __('No Extention Found', 'custommimetypes'); ?></div>
                    </div>
                    <div v-if="Object.keys(getExtentions).length" class="cmt-pagination">
                        <button :disabled="pagination == 1" :class="pagination == 1 ? 'disabled' : 'enabled'" @click.prevent="--pagination" class=""><span class="dashicons dashicons-arrow-left-alt2"></span> <?php echo __('Prev', 'custommimetypes'); ?></button>
                        <button :disabled="pagination == max_pagination" :class="pagination == max_pagination ? 'disabled' : 'enabled'" @click.prevent="++pagination" class=""><?php echo __('Next', 'custommimetypes'); ?> <span class="dashicons dashicons-arrow-right-alt2"></span></button>
                    </div>

                </div>
                <div class="cmt_edit_div">
                    <!-- add type  -->
                    <div id="edit_mime" class="cmt-edit">
                        <h3 class="edit-title">{{mode == 'new' ? '<?php echo __('Add Mime', 'custommimetypes'); ?>' : '<?php echo __('Edit Mime', 'custommimetypes'); ?>'}}</h3>
                        <div class="edit-p">

                            <div class="fleldset">
                                <label for=""><?php echo __('Extention', 'custommimetypes'); ?></label>
                                <input type="text" @input="strip_extention" v-model="current_extention" placeholder="<?php echo __('Extention', 'custommimetypes'); ?>" class="form-input">
                            </div>

                            <div class="fleldset">
                                <label for=""><?php echo __('Types', 'custommimetypes'); ?></label>
                                <input type="text" @input="strip_types" v-model="current.types" placeholder="<?php echo __('Types', 'custommimetypes'); ?>" class="form-input">
                            </div>

                            <div class="fleldset" v-if="mode == 'new' && Object.keys(getSuggestions).length > 0">
                                <label for=""><?php echo __('Suggestions', 'custommimetypes'); ?></label>
                                <div class="relative">
                                    <div class="suggestions">
                                        <button v-for="(types, ext) in getSuggestions" @click.prevent="current_extention = ext; current.types = types">.{{ext}}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="fleldset">
                                <label for=""><?php echo __('Enabled / Disabled', 'custommimetypes'); ?></label>
                                <div>
                                    <button @click="current.enabled = ! current.enabled" class="button-enabled-large" :class="{active: current.enabled}">{{current.enabled ? '<?php echo __('Enabled', 'custommimetypes'); ?>' : '<?php echo __('Disabled', 'custommimetypes'); ?>' }}</button>
                                </div>
                            </div>
                            <div class="fleldset">
                                <label for=""><?php echo __('Role Permissions', 'custommimetypes'); ?></label>
                                <div class="relative">
                                    <div class="permissions">
                                        <button v-for="(label, role) in roles" :class="{active: current.roles.includes(role)}" @click.prevent="toggleRole(role)" class="">{{label}}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 fleldset">
                                <div class="success-message" v-if="savedCurrent"><?php echo __('Saved Mime Type', 'custommimetypes'); ?></div>
                                <div class="error-message" v-if="error">{{error}}</div>
                                <div>
                                    <button @click.prevent="saveCurrent()" v-if="!error" class="cmt-button"><?php echo __('Save', 'custommimetypes'); ?></button>
                                    <button @click.prevent="newExt()" v-if="mode == 'edit'" class="ml-2 cmt-button-outline"><?php echo __('Cancel', 'custommimetypes'); ?></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- filesize  -->
        <section data-content="filesize" style="display: none;">
            <div class="cmt_filesize">
                <div class="info-message">
                    <div>
                        <?php echo __('Important: Maximum allowed upload size <span class="uppercase font-bold">{{size(wp_max_upload_size)}}</span> is configured by the server itself.', 'custommimetypes'); ?>

                    </div>
                    <div>
                        <?php echo __('It\'s <span class="uppercase font-bold">NOT POSIBLE</span> to increase the limit more than {{size(wp_max_upload_size)}} using a plugin. Contact your hosting provider to increase the limit', 'custommimetypes'); ?>

                    </div>
                </div>
                <div class="fleld-set">
                    <div class="settings-flex">
                        <label for=""><?php echo __('Maximum Upload Size', 'custommimetypes'); ?></label>
                        <div>
                            <input v-model="max_upload_size" @input="strip_max_upload_size" type="text" class="form-input form-size" size="12" placeholder="Size">
                            <div class="form-size">
                                <button @click="max_file_size_dropdown = !max_file_size_dropdown">
                                    <span>{{size_unit.toUpperCase()}}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div v-show="max_file_size_dropdown" @click="max_file_size_dropdown = false" class="overlay"></div>

                                <div v-show="max_file_size_dropdown" class="dropdown-div">
                                    <a v-for="unit in Object.keys(size_units)" @click.prevent="size_unit = unit; max_file_size_dropdown = false" :class="{active: size_unit == unit}" href="#" class="">
                                        {{unit.toUpperCase()}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fleld-set">
                    <div class="settings-flex">
                        <label for="" class=""></label>
                        <div class="">
                            <div v-if="savedSize" class="success-message"><?php echo __('Saved!', 'custommimetypes'); ?></div>
                            <div v-if="limit_error" class="error-message"><?php echo __('You can\'t set value more than {{size(wp_max_upload_size)}}', 'custommimetypes'); ?></div>
                            <button v-else @click.prevent="saveSize()" class="cmt-button"><?php echo __('Save Settings', 'custommimetypes'); ?></button>
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