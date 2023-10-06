<template>
    <app-layout>

        <template #header>
          <h2 class="text-xl font-semibold leading-tight text-gray-800"> Projects</h2>
        </template>
        <div class="py-12">
            <div class="mx-auto text-right max-w-7xl sm:px-6 lg:px-8"> 
                <jet-button class="p-3 font-bold text-blue-500 bg-blue-100 border-2 border-blue-500 hover:bg-blue-200 rounded-xl"
                @click="
                acting = true;
                method = 'post',
                action = route('skills.store');
                ">
                    Add new +
                </jet-button>
                
                <jet-modal :show="acting" closeable="true" @close="acting = null">
                    <div class="p-8 shadow-2xl bg-gray-50" >
                        <form class="flex-col items-center p-16" @submit.prevent="submit"> 
                        
                        <jet-input class="mt-5 border border-gray-600 rounded w-96"
                        type="text" name="title" placeholder="Project Title"
                        v-model="form.title">
                        </jet-input>
                        
                        <jet-input-error :message="form.errors.title"/>

                        <jet-input class="px-5 py-3 mt-5 border-gray-600 rounded pyborder w-96"
                        type="text" name="Description" placeholder="Project Description"
                        v-model="form.Description">
                        </jet-input>
                        
                        <jet-input-error :message="form.errors.Description"/>

                        <select class="mt-5 border border-gray-600 rounded w-96"
                        v-model="form.Color">
                        <option value="">Select a color</option>
                        
                        <option v-for="Color in avaliableColors" :value="Color">{{ Color }}</option>
                        </select>
                        <jet-input-error :message="form.errors.Color"/>

                        <select class="mt-5 border border-gray-600 rounded w-96"
                        v-model="form.icon_name">
                        <option value="">Select an Icon</option>
                        
                        <option v-for="icon in avaliableIcons" :value="icon">{{ icon }}</option>
                        </select>
                        <jet-input-error :message="form.errors.icon_name"/>

                        <jet-button class="justify-center px-5 py-3 mt-5 text-sm bg-purple-400 w-96 rounded-xl"
                        :disabled="form.processing">
                        
                        <span class="mr-1 animate-spin" v-show="form.processing"> &#9696;</span>
                        
                        <span v-show="!form.processing"> Submit</span>
                            
                        </jet-button>
                        </form>
                    </div>
                </jet-modal>
                <table v-if="projects.length > 0" class="w-full text-left"> 
                <thead class="text-indigo-600 border-b-2 border-gray-300">
                    <tr>
                        <th class="px-6 py-3 text-left"> Title</th>
                        <th class="px-6 py-3 text-left"> Description</th>
                        <th class="px-6 py-3 text-left"> Color</th>
                        <th class="px-6 py-3 text-left"> Icon</th>
                        <th class="px-6 py-3 text-left"> Actions</th>
                    </tr>
                </thead>
                <tbody v-for="(project, index) in projects">
                    <tr class="text-sm text-indigo-900 border-b border-gray-400">
                        <td class="px-6 py-4">{{ project.title }}</td>
                        <td class="px-6 py-4">{{ project.Description }}</td>
                        <td class="px-6 py-4">
                            <p>
                                <span class="p-4 mr-5 rounded" :class="project.Color"> {{ project.Color }}</span>
                               
                            </p>
                        </td>
                        <td class="px-6 py-4" :class="project.Color">
                            <BeakerIcon> </BeakerIcon>  
                        </td>
                        <td class="px-6 py-4">
                            <jet-button class="mr-2 text-indigo-500 bg-indigo-500 border border-indigo-300 hover:bg-indigo-800">
                                Edit
                            </jet-button>
                            <jet-button class="ml-2 text-red-500 bg-red-500 border border-red-300 hover:bg-red-800">
                                Delete
                            </jet-button>
                        </td>
                    </tr>
                    
                </tbody>
                </table>
                <div v-else class="p-3 text-red-800 bg-red-100 border border-red-400 rounded-lg">
                    There are no projects yet. Let's create one.
                </div>
            </div>

        </div>
    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import JetButton from '@/Components/PrimaryButton.vue'
import { defineAsyncComponent } from 'vue'
import { BeakerIcon } from "@heroicons/vue/solid";
import JetModal from '@/Components/Modal.vue'
import JetInput from "@/Components/TextInput.vue";
import JetInputError from "@/Components/InputError.vue";
export default {
    components: {
        AppLayout,
        JetButton,
        BeakerIcon,
        JetModal,
        JetInput,
        JetInputError,
        
    },
    props: {
        projects: Object,
        avaliableColors: Object,
        avaliableIcons: Object,
        
        
    },
    methods:{
        submit()
        {
            this.form.submit('post', route('projects.store'), 
            {
                onSuccess: ()=> {
                    this.form.reset('title');
                    this.form.reset('Description');
                    this.form.reset('Color');
                    this.form.reset('icon_name');
                    this.acting = null;
                    
                }
            });
        }
    },
    data(){
        return {
            acting:null,
            method:null,
            action:null,
            form: this.$inertia.form({
                'title': '',
                'Description': '',
                'Color': '',
                'icon_name': '',
            })
        }
    }
}

</script>