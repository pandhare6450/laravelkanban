<script setup>
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref, watch } from 'vue';


const props = defineProps({
  board: Object
})

const form = useForm({
  name: props.board.name
})


const input = ref()


async function edit() {
  isEditing.value = true
}

function onSubmit() {
  isEditing.value = false
  form.put(route('boards.update',{board: props.board.id}),{
    onError:()=>form.reset()
  })
}
const isEditing = ref(false)
</script>

<template>
  <div class="flex flex-col items-start max-w-full relative">
    <h1 @click="edit()" :class="[isEditing ? 'invisible' : '']" 
      class="hover:bg-white/20 whitespace-pre w-full overflow-hidden border-transparent rounded-md text-ellipsis cursor-pointer  px-3 py-1.5 text-2xl text-white font-bold">
      {{ form.name ? form.name : '' }}
    </h1>
    <form 
    v-show="isEditing" 
    @submit.prevent="onSubmit()" 
    @focusout="onSubmit()"
    class="w-full"
    >
      <input ref="input" type="text" v-model="form.name" placeholder="Board name"
        class="absolute inset-0 text-2xl max-w-full font-bold placeholder-gray-400 px-3 py-1.5 rounded-md focus:ring-2 focus:ring-blue-300">
    </form>
  </div>
</template>