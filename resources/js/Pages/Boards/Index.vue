<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { PlusIcon } from '@heroicons/vue/24/solid'
import { ChevronDownIcon } from '@heroicons/vue/20/solid'
import { Popover, PopoverButton, PopoverPanel,PopoverOverlay } from '@headlessui/vue'
const props = defineProps({
	boards: Array
})

const form =useForm({
	name: ''
})

function OnSubmit(closePopover) {
	form.post(route('boards.store'),{
		onSuccess: () =>{
			closePopover()
			form.reset()
		} 
	})
}
</script>

<template>

	<Head title="Boards" />

	<AuthenticatedLayout>
		<div class="h-full bg-gray-50 py-6 overflow-y-auto">
			<div class="max-w-5xl mx-auto">
				<div class="flex items-center mb-3 px-3">
					<h3 class="font-black text-gray-700">My Borads</h3>
					<Popover v-slot="{ open }" class="relative">
						<PopoverButton :class="open ? 'bg-blue-50 text-blue-600' : ''"
							class="ml-4 py-2 bg-gray-100 rounded font-medium hover:bg-gray-200 p-2 flex items-center ring-0">
							<PlusIcon class="w-5 h-5" />
							<span class="ml-2">
								Create Board
							</span>

						</PopoverButton>
						<PopoverOverlay class="z-10 fixed inset-0 bg-black opacity-30" />

						<transition enter-active-class="transition duration-200 ease-out" enter-from-class="translate-y-1 opacity-0"
							enter-to-class="translate-y-0 opacity-100" leave-active-class="transition duration-150 ease-in"
							leave-from-class="translate-y-0 opacity-100" leave-to-class="translate-y-1 opacity-0">
							<PopoverPanel 
							focus=true
							v-slot="{close}"
							class="absolute left-1/2 z-10 mt-3 w-72 -translate-x-1/2  px-4 sm:px-0">
								<div class="p-3 bg-white overflow-hidden rounded-lg shadow-lg ring-1 ring-black/5">
									<form @submit.prevent="OnSubmit(close)">
										<label class="block text-sm text-gray-600 font-medium mb-1" for="name">Your new board</label>
										<input
										 v-model="form.name"
										  class="block w-full text-sm rounded-md border-gray-300  shadow-sm focus:border-blue-400 focus:ring-blue-400" type="text" name="name" placeholder="Board name">
										<p v-if="form.errors.name" class="text-sm text-red-600">{{form.errors.name}}</p>
										<div class="flex justify-end mt-2 ">

											<button class="px-4 py-2 text-sm font-medium bg-red-600 text-white rounded-md hover:bg-rose-500 shadow focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 focus:outline-none">
												Create Board
											</button>
										</div>
									</form>
								</div>
							</PopoverPanel>
						</transition>
					</Popover>


				</div>
				<ul class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
					<li v-for="board in boards" :key="board.id"
						class="relative bg-sky-900 hover:bg-sky-950 rounded-md min-h-[7rem] break-all">
						<Link :href="route('boards.show', { board: board.id })"
							class="p-3 text-white text-lg font-bold absolute inset-0">
						{{ board.name }}
						</Link>
					</li>
				</ul>
			</div>
		</div>
	</AuthenticatedLayout>
</template>
