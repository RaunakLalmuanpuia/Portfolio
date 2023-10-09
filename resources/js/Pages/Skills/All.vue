<template>
    
    <app-layout title="Skills">

         <template #header >
           <h2 class="text-xl font-semibold leading-tight text-gray-800">Skills</h2>
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
                
                <jet-modal :show="acting" :closeable="true" @close="acting = null">
                    <div class="p-8 shadow-2xl bg-gray-50" >
                        <form class="flex-col items-center p-16" @submit.prevent="submit"> 
                        
                        <jet-input class="mt-5 border border-gray-600 rounded w-96"
                        type="text" name="name" placeholder="Skill name"
                        v-model="form.name">
                        </jet-input>
                        
                        <jet-input-error :message="form.errors.name"/>

                        <select class="mt-5 border border-gray-600 rounded w-96"
                        v-model="form.color">
                        <option value="">Select a color</option>
                        
                        <option v-for="color in avaliableColors" :value="color">{{ color }}</option>
                        </select>
                        <jet-input-error :message="form.errors.color"/>

                        <jet-button class="justify-center px-5 py-3 mt-5 text-sm bg-purple-400 w-96 rounded-xl"
                        :disabled="form.processing">
                        
                        <span class="mr-1 animate-spin" v-show="form.processing"> &#9696;</span>
                        
                        <span v-show="!form.processing"> Submit</span>
                            
                        </jet-button>
                        </form>
                    </div>
                </jet-modal>
                
                <table v-if="skills.length > 0" class="w-full text-left">
                <thead class="text-indigo-600 border-b-2 border-gray-300">
                    <tr>
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left">Color</th>
                        <th class="px-6 py-3 text-left">Action</th>
                    </tr>
                </thead>
                
                <tbody v-for="skill in skills">
                    <tr class="text-sm text-indigo-900 border-b border-gray-400">
                        <td class="px-6 py-4">{{ skill.name }}</td>
                        <td class="px-6 py-4">
                            <p>
                                <span class="p-4 mr-5 rounded" :class="skill.color"></span>
                                {{ skill.color }}
                            </p>
                        </td>
                        <td class="px-6 py-4">
                            <jet-button class="mr-2 text-indigo-500 bg-indigo-500 border border-indigo-300 hover:bg-indigo-800"
                            @click="
                            acting= true; //open model
                            method='put'; 
                            action = route('skills.update', [skill.id]) // 
                            form.name = skill.name;
                            form.color = skill.color;
                            "
                            >Edit</jet-button>
                            
                            <jet-button class="ml-2 text-red-500 bg-red-500 border border-red-300 hover:bg-red-800"
                            @click=" //after clicking button
                            method='delete';
                            action = route('skills.destroy', [skill.id]);
                            submit(); ">
                                Delete
                            </jet-button>
                        </td>
                    </tr>
                </tbody>
                </table>
                <div v-else class="p-3 mt-5 text-left text-red-800 bg-red-100 border border-red-400 rounded-lg">
                    There are no skills yet. Let's Create one.
                </div>
            </div>
            
        </div>





    </app-layout>
        
    
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import JetButton from '@/Components/PrimaryButton.vue'
import JetModal from '@/Components/Modal.vue'
import JetInput from "@/Components/TextInput.vue";
import JetInputError from "@/Components/InputError.vue";

export default{
    components:{
        AppLayout,
        JetButton,
        JetModal,
        JetInput,
        JetInputError,
    },  
    props: {
        skills: Object,
        avaliableColors: Object,
    },
    methods:{
        submit()
        {
            this.form.submit(this.method, this.action, 
            {
                onSuccess: ()=> {
                    this.form.reset('name');
                    this.form.reset('color');
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
                'name': '',
                'color': '',
            })
        }
    }
}

</script>