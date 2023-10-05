<template>
    <Head title="Welcome"></Head>

    <div
        class="grid grid-cols-2 py-10 text-right text-gray-300 bg-gray-800 px-72"
    >
        <div>
            <jet-application-mark class="w-auto h-12"></jet-application-mark>
        </div>

        <div v-if="canLogin">
            <Link
                v-if="$page.props.user"
                :href="route('dashboard')"
                class="text-sm underline"
                >Dashboard</Link
            >

            <template v-else>
                <Link :href="route('login')" class="text-base underline">
                    Login</Link
                >
                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ml-4 text-base underline place-self-end"
                >
                    Register</Link
                >
            </template>
        </div>
    </div>

    <div>
        <section class="h-screen pt-16 bg-gray-800 px-72">
            <div class="flex flex-wrap content-between h-2/3 pb-36">
                <p
                    class="pb-3 text-2xl font-bold text-gray-300 uppercase border-b-2 border-gray-400"
                >
                    Hey this is Raunak and Im a software engineer and i would be
                    glad to work with you.
                </p>

                <div class="flex items-end pb-2 border-b-2 border-gray-500">
                    <p class="mr-5 text-xl font-bold text-gray-500">
                        Want to know more?
                    </p>
                    <JetButton
                        class="text-sm font-bold text-gray-800 bg-green-400 rounded hover:bg-green-800"
                        @click="contacting = true"
                        >{{
                    $page.props.flash.contacted ? 'Thanks' : 'Let\'s Chat'
                    }} </JetButton
                    >
                </div>
            </div>
            <div class="mt-3 text-center text-gray-300 animate-pulse text-9xl">
                <a href="#skills">&#8675;</a>
            </div>
        </section>

        <section
            id="skills"
            class="h-screen py-10 text-gray-800 bg-gray-200 px-72"
        >
            <h2 class="pt-3 text-6xl font-bold">Skills</h2>
            <div class="grid grid-cols-2">
                <div v-for="skill in skills">
                    <Skill :background="skill.color">
                        {{ skill.name }}
                    </Skill>
                </div>
            </div>

            <div class="flex justify-center mt-10">
                <JetButton
                    class="text-sm font-bold text-gray-200 bg-indigo-800 rounded hover:bg-indigo-700"
                    @click="contacting = true"
                    >{{
                    $page.props.flash.contacted ? 'Thanks' : 'Get in Touch'
                    }}</JetButton
                >
            </div>
        </section>

        <section class="h-screen py-10 text-gray-200 bg-gray-600 px-72">
            <h2 class="pt-3 text-6xl font-bold">Projects</h2>

            <div v-for="project in projects">
                <Project
                    :title="project.title"
                    :Description="project.Description"
                    :Color="project.Color"
                >
                    <BeakerIcon> </BeakerIcon>
                </Project>
            </div>

            <div class="flex justify-center mt-10">
                <JetButton
                    class="text-sm font-bold text-gray-800 bg-purple-300 rounded hover:bg-indigo-200"
                    @click="contacting = true"
                    >{{
                    $page.props.flash.contacted ? 'Thanks' : 'Know More'
                    }}</JetButton
                >
            </div>
        </section>

        <section
            class="flex justify-between py-10 text-xl text-gray-300 bg-gray-800 px-72"
        >
            <p>&copy; Raunak. All rights Reserved</p>
            <div class="flex items-center justify-evenly">
                <Link class="px-2 pb-1 border-b hover:text-gray-50" href=""
                    >Github</Link
                >
                <Link class="px-2 pb-1 border-b hover:text-gray-50" href=""
                    >Twitter</Link
                >
                <Link class="px-2 pb-1 border-b hover:text-gray-50" href=""
                    >Linkind</Link
                >
            </div>
        </section>
    </div>
    <jet-modal :show="contacting" :closeable="true" @close="contacting = null">
        
            <div class="bg-green-400 shadow-2xl p-8 text-center font-bold" v-if="$page.props.flash.contacted">
            <p class="text-8xl m-5" >👍</p>
            <p class="text-5xl font-bold m-2">THanks!</p>
            <p class="text-xl m-2">I'll get back to you soon.</p>
            </div>

            <div v-else class="p-8 shadow-2xl bg-gray-50">
                <p class="text-2xl font-extrabold text-center text-gray-600">
                Let me Know some details
                </p>

                <form
                    @submit.prevent="submit"
                    class="flex flex-col items-center p-16"
                >
                    <jet-input
                        v-model="form.email"
                        class="px-5 py-3 mt-5 border border-gray-600 rounded w-96"
                        type="email"
                        name="email"
                        placeholder="Your Email"
                    ></jet-input>
                    <jet-input-error :message="form.errors.email" />

                    <textarea
                        v-model="form.message"
                        class="px-5 py-3 mt-5 border border-gray-600 rounded w-96"
                        name="message"
                        placeholder="The details :)"
                    ></textarea>
                    <jet-input-error :message="form.errors.message" />
                    <jet-button
                        class="justify-center px-5 py-3 mt-5 text-sm bg-purple-400 w-96 rounded-xl"
                        :disabled="form.processing"
                    >
                    <span class="animate-spin mr-1" v-show="form.processing">&#9696</span>
                    <span v-show="!form.processing">Get In touch</span>
                        
                    </jet-button>
                </form>
            </div>
            
        
    </jet-modal>
</template>

<script>
import { defineAsyncComponent, defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

import JetApplicationMark from "@/Components/ApplicationMark.vue";
import JetButton from "@/Components/PrimaryButton.vue";
import JetModal from "@/Components/Modal.vue";
import JetInput from "@/Components/TextInput.vue";
import JetInputError from "@/Components/InputError.vue";

import Skill from "@/Components/Skill.vue";
import Project from "@/Components/Project.vue";
import { BeakerIcon } from "@heroicons/vue/solid";

export default defineComponent({
    components: {
        Head,
        Link,
        JetApplicationMark,
        JetButton,
        JetModal,
        Skill,
        Project,
        BeakerIcon,
        JetInput,
        JetInputError,
    },
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        skills: Object,
        projects: Object,
    },
    methods: {
        submit() {
            this.form.post(route("contact"));
        },
    },

    data() {
        return {
            contacting: null,
            form: this.$inertia.form({
                email: "",
                message: "",
            }),
        };
    },
});
</script>
