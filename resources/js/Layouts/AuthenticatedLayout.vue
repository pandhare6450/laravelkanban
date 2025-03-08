<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
const showingNavigationDropdown = ref(false);
</script>
<template>
    <div>
        <div class="flex flex-col h-screen">
            <nav class="shrink-0 flex justify-between bg-white px-4 py-3 border-b">
                <span  class="text-2xl font-black tracking-tight">Kanboard</span>
                <div class="flex items-center">
                    <NavLink class="text-sm font-bold px-3 py-2 rounded-md hover:bg-gray-100" :href="route('boards')">My Board</NavLink>
                    <Menu as="div" class="ml-3 relative z-10">
                        <MenuButton
                            class="hover:bg-gray-300 w-8 h-8 rounded-md grid place-content-center focus:ring-blue-950">
                            <img class="h-9 w-9 inline-block rounded-full"
                                :src="$page.props.auth.user.avatar_url"
                                alt="">
                        </MenuButton>
                        <transition enter-active-class="transition transform duration-100 ease-out"
                            enter-from-class="opacity-0 scale-90" enter-to-class="opacity-100 scale-100"
                            leave-active-class="transition transform duration-100 ease-in"
                            leave-from-class="opacity-100 scale-100" leave-to-class="opacity-0 scale-90">
                            <MenuItems
                                class="origin-top-right mt-2 focus:outline-none absolute right-0 bg-white overflow-hidden rounded-md shadow-lg border w-40">
                                <MenuItem v-slot="{ active }">
                                <Link :href="route('profile.edit')" :class="{ 'bg-gray-100': active }"
                                    class="block px-4 py-2 text-sm text-gray-700">My
                                    profile</Link>
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                <Link  :href="route('logout')" :class="{ 'bg-gray-100': active } " method="post" as="button"
                                    class="block px-4 py-2 text-sm w-full text-left">Logout</Link>
                                </MenuItem>
                            </MenuItems>
                        </transition>
                    </Menu>
                </div>
            </nav>
            <!-- Page Content -->
            <main class="flex-1 overflow-hidden">
                <slot />
            </main>
        </div>
    </div>
</template>
