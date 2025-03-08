<script setup>
import { Cog6ToothIcon, PencilIcon, PlusIcon } from '@heroicons/vue/24/solid'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import BoardNameForm from '@/Pages/Boards/BoardNameForm.vue'
import CreateBoardListForm from '@/Pages/Boards/CreateBoardListForm.vue'
import CardList from '@/Pages/Boards/CardList.vue'
import { Head, Link, useForm } from '@inertiajs/vue3';
const props = defineProps({
  board: Object
})
</script>

<template>
  <Head title="Board/Cards" />
  <AuthenticatedLayout>
    <div class="flex flex-col h-full  bg-sky-950">
      <div class="shrink-0 flex flex-wrap justify-between items-center p-4">
        <BoardNameForm :board="board" />
        <div class="">
          <button
            class=" inline-flex items-center bg-white/10 hover:bg-white/20 px-3 py-2 font-medium text-sm text-white rounded-md">
            <Cog6ToothIcon class="w-5 h-5" />
            <span class="ml-1">
              Settings
            </span>
          </button>
        </div>
      </div>
      <div class="flex-1 overflow-x-auto">
        <div class="inline-flex h-full items-start px-4 pb-4 space-x-4">
          <CardList 
          v-for="list in board.lists" 
          :key="list.id" 
          :list="list" 
          />
          <div class="w-72">
            <CreateBoardListForm

             :board="board" />
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>


<style>
/* Hide the scrollbar for all elements */
::-webkit-scrollbar {
  width: 10px;
  /* Adjust width if needed */
  background-color: transparent;
  /* Make the scrollbar track invisible */
}
/* Style the scrollbar thumb */
::-webkit-scrollbar-thumb {
  background-color: rgba(85, 81, 81, 0.5);
  /* Semi-transparent thumb color */
  border-radius: 8px;
  /* Rounded corners */
  transition: background-color 0.3s;
  /* Smooth color transition */
}
/* Style the scrollbar track */
::-webkit-scrollbar-track {
  background: transparent;
  /* Make the track invisible */
}
/* Make the scrollbar appear on hover */
::-webkit-scrollbar-thumb:hover {
  background-color: rgba(0, 0, 0, 0.8);
  /* Darker thumb color on hover */
}
</style>