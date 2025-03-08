<script setup>
import { Head, Link } from '@inertiajs/vue3';
defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>
<template>

    <Head title="Welcome" />
    <div>
        <div class=" text-gray-100  bg-blue-950 ">
            <header>
                <div v-if="canLogin" class=" sm:top-0 sm:fixed sm:right-0 p-3 text-end">
                    <Link v-if="$page.props.auth.user" :href="route('boards')"
                        class=" text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                    Dashboard</Link>
                    <template v-else>
                        <Link :href="route('login')"
                            class=" text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        Log in</Link>
                        <Link v-if="canRegister" :href="route('register')"
                            class="ms-4  text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        Register</Link>
                    </template>
                </div>
                <div class="container mx-auto text-center py-4">
                    <h1 class="text-4xl font-bold mb-2">Welcome to Kanban</h1>
                    <p class="text-lg">Streamline Your Workflow and Boost Productivity</p>
                </div>
                <hr>
            </header>
            <main class="container mx-auto py-16 px-4">
                <section class="mb-12">
                    <h2 class="text-3xl  mb-4">What is Kanban?</h2>
                    <p class="text-lg leading-relaxed">Kanban is a visual workflow management method that helps you
                        visualize
                        tasks, limit work in progress, and maximize efficiency. It was originally developed by Toyota to
                        improve
                        manufacturing processes, and has since been adapted for various types of work.</p>
                </section>
                <section class="mb-12">
                    <div class="flex justify-between">
                        <div>

                            <h2 class="text-3xl  mb-4">Benefits of Kanban</h2>
                            <ul class="list-disc list-inside space-y-2">

                                <li>Enhanced visibility of work</li>
                                <li>Improved team collaboration</li>
                                <li>Increased productivity and efficiency</li>
                                <li>Reduced cycle times and bottlenecks</li>
                                <li>Better adaptability to changes</li>
                            </ul>
                        </div>
                        <div class="flex justify-center items-center rounded-md">
                            <div class="max-w-sm w-full bg-white shadow-lg rounded-lg overflow-hidden">
                                <div class="p-4">
                                    <h2 class="text-xl font-bold text-gray-900">Card Title</h2>
                                    <p class="text-gray-700 mt-2">This is a brief description of the card. It gives more
                                        details
                                        about what this card represents or what task needs to be accomplished.</p>
                                </div>
                                <div class="border-t border-gray-200">
                                    <div class="flex justify-between items-center p-4">
                                        <button
                                            class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">Edit</button>
                                        <span class="text-sm text-gray-500">Due: Aug 30, 2024</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="mb-12">
                    <h2 class="text-3xl  mb-4">How Kanban Works</h2>
                    <p class="text-lg leading-relaxed">Kanban uses visual boards and cards to represent tasks and their
                        statuses. Tasks move through various stages, such as To Do, In Progress, and Done. By limiting
                        the
                        number of tasks in each stage, teams can focus on completing work efficiently and avoid
                        overloading any
                        part of the process.</p>
                </section>
                <section>
                    <h2 class="text-3xl  mb-4">Get Started with Kanban</h2>
                    <p class="text-lg leading-relaxed mb-4">If you're interested in implementing Kanban in your team or
                        organization, get in touch with us for more information and resources.</p>
                    <a href="#"
                        class="bg-green-500 hover:bg-green-600 text-white  py-2 px-4 rounded">Contact
                        Us</a>
                </section>
            </main>
            <footer class="bg-blue-800 py-4 text-center">
                <p>&copy; 2024 Kanban Solutions. All rights reserved.</p>
            </footer>
        </div>

    </div>
</template>
<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
