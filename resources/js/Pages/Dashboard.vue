<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex flex-col p-6 overflow-hidden text-xl bg-white border-gray-200 rounded-lg shadow-xl ">
                    <p class="mb-5">Your Resources</p>

                    <ul class="p-3">
                        <li class="flex flex-row items-center ml-2">
                            <div class="w-2 h-2 mr-3 bg-gray-500"></div>
                            <Link class="mt-2 text-sm text-indigo-500 border-b border-gray-400 hover:text-gray-800"

                                :href="route('skills.index')"
                            >
                                Skills
                            </Link>
                        </li>
                        <li class="flex flex-row items-center ml-2">
                            <div class="w-2 h-2 mr-3 bg-gray-500"></div>
                            <Link class="mt-2 text-sm text-indigo-500 border-b border-gray-400 hover:text-gray-800"
                                :href="route('projects.index')"
                            >
                                Projects
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/vue3'
    import AppLayout from '@/Layouts/AppLayout.vue'

    export default defineComponent({
        components: {
            AppLayout,
            Link,
        },
    })
</script>