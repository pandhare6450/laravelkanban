<script setup>
import { defineProps,nextTick,ref } from 'vue';
const props = defineProps({
  board: Object
})
const isShowingForm =ref(false)
const formRef =ref()
const inputNameRef = ref()
import { PlusIcon } from '@heroicons/vue/24/solid'
import { useForm } from '@inertiajs/vue3';
async function showForm(){
  isShowingForm.value=true
  await nextTick()
  inputNameRef.value.focus();
}

const form = useForm({
  name:''
})
function onSubmit(){
  form.post(route('cardLists.store',{
    board:props.board.id
  }),{
    onSuccess:()=>{
      form.reset();
      inputNameRef.value.focus();
      formRef.value.scrollIntoView();
    }
  })
}

</script>

<template>

  <form 
  ref="formRef"
  
  @submit.prevent="onSubmit()"
  class="p-3 bg-gray-200 rounded-md" v-if="isShowingForm">
    <input type="text"
    v-model="form.name"
    ref="inputNameRef"
     placeholder="Enter list name" class="block w-full text-sm rounded-md border-gray-300  shadow-sm focus:border-blue-400 focus:ring-blue-400">
    <div class="space-x-2 mt-3" >
      <button 
       type="submit"
      class="px-4 py-2 text-sm font-medium bg-red-600 text-white rounded-md hover:bg-rose-500 shadow focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 focus:outline-none">Add list</button>
      <button @click="isShowingForm=false" 
     
      class="px-4 py-2 text-sm font-medium bg-gray-200 text-gray-700 rounded-md hover:text-black
      focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500" type="button">Cancel</button>
    </div>
  </form>


  <button
  v-if="!isShowingForm"
  @click="showForm" 
  type="button"
  class="flex items-center bg-white/10 w-full hover:bg-white/20 text-white p-2 rounded-md text-sm font-medium">
    <PlusIcon class="w-5 h-5" />
    <span>Add another List</span>
  </button>
</template>