<script setup>
import { defineProps, nextTick, ref ,computed} from 'vue';
import { PlusIcon } from '@heroicons/vue/24/solid'
import {store} from '@/store'
const props = defineProps({
  list: Object
})
const isShowingForm = computed(()=>props.list.id==store.value.editingCardId)
const inputNameRef = ref()
import { useForm } from '@inertiajs/vue3';
async function showForm() {
  store.value.editingCardId = props.list.id
  await nextTick()
  inputNameRef.value.focus();
}

const emit = defineEmits(['created'])
const form = useForm({
  title: '',
  description: '',
  card_list_id: props.list.id,
  board_id: props.list.board_id
})
function onSubmit() {
  form.post(route('cards.store'), {
    onSuccess: () => {
      form.reset();
      inputNameRef.value.focus();
      emit('created')
    }
  })
}
</script>
<template>
  <form @keydown.escape="store.editingCardId=null" ref="formRef" @submit.prevent="onSubmit()"
    class="p-3 bg-gray-200 rounded-md" v-if="isShowingForm">

    <input 
    type="text" 
    v-model="form.title" 
    ref="inputNameRef" 
    placeholder="Enter card title"
      class="block w-full text-sm rounded-md border-gray-300  shadow-sm focus:border-blue-400 focus:ring-blue-400">

    <textarea v-model="form.description" rows="3" @keydown.enter.prevent="onSubmit()" placeholder="Enter card description"
      class="mt-2 block w-full text-sm rounded-md border-gray-300  shadow-sm focus:border-blue-400 focus:ring-blue-400">
  </textarea>
    <div class="space-x-2 mt-3">
      <button type="submit"
        class="px-4 py-2 text-sm font-medium bg-red-600 text-white rounded-md hover:bg-rose-500 shadow focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 focus:outline-none">Add
        Card</button>
      <button @click="store.editingCardId=null" class="px-4 py-2 text-sm font-medium bg-gray-200 text-gray-700 rounded-md hover:text-black
      focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500" type="button">Cancel</button>
    </div>
  </form>
  <button v-if="!isShowingForm" @click="showForm" type="button"
    class="w-full text-center flex items-center p-2 text-sm font-medium text-gray hover:text-black hover:bg-gray-300 rounded-md w-fullm">
    <PlusIcon class="w-5 h-5" />
    <span>Add card</span>
  </button>
</template>