<script setup>
import { defineProps, nextTick, ref ,computed } from 'vue';
import { PencilIcon , TrashIcon } from '@heroicons/vue/24/solid'
import {store} from '@/store'
const props = defineProps({
  card: Object
})

const isShowingForm = computed(()=>props.card.id==store.value.editingCardId)
const inputTitleRef = ref()
import { useForm ,Link} from '@inertiajs/vue3';
async function showForm() {
  console.log('first tick')
  store.value.editingCardId = props.card.id
  await nextTick()
}


const form = useForm({
  title: props.card.title,
  description: props.card.description,
})
function onSubmit() {
  form.put(route('cards.update', {
    card: props.card.id
  }), {
    onSuccess: () => store.value.editingCardId = null
  })
}
</script>

<template>
  <li>
    <div class="group relative bg-white p-3 shadow rounded-md border-b border-gray-300 hover:bg-gray-50">

<form v-if="isShowingForm" @keydown.escape="store.editingCardId = null" ref="formRef" @submit.prevent="onSubmit()"
  class="p-3 bg-gray-200 rounded-md">
  <input type="text" v-model="form.title" ref="inputTitleRef" placeholder="Enter list title"
    class="block w-full text-sm rounded-md border-gray-300  shadow-sm focus:border-blue-400 focus:ring-blue-400">

  <textarea v-model="form.description" rows="3" @keydown.enter.prevent="onSubmit()" placeholder="Enter list name"
    class="mt-2 block w-full text-sm rounded-md border-gray-300  shadow-sm focus:border-blue-400 focus:ring-blue-400">
</textarea>
  <div class="space-x-2 mt-3">
    <button type="submit"
      class="px-4 py-2 text-sm font-medium bg-red-600 text-white rounded-md hover:bg-rose-500 shadow focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 focus:outline-none">
      Save Card
    </button>
    <button @click="store.editingCardId = null" class="px-4 py-2 text-sm font-medium bg-gray-200 text-gray-700 rounded-md hover:text-black
  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500" type="button">Cancel</button>
  </div>
</form>
<template v-if="!isShowingForm">

  <p class="font-bold">{{ card.title }}</p>
  <p class="font-light text-xs">{{ card.description }}</p>
  <button @click="showForm()"
    class="hidden absolute top-2 right-6 mr-1 w-7 h-7 bg-gray-50 group-hover:grid place-content-center rounded-md text-gray-600 hover:text-black hover:bg-gray-200 ">
    <PencilIcon class="w-3 h-8" />

  </button>
  <Link
    :href="route('card.delete',{id:card.id})"
    method="delete"
    as="button"
     class="absolute top-2 ml-3 text-red-600 right-1 w-7 h-7  group-hover:grid place-content-center rounded-md hidden  hover:text-red hover:bg-gray-200 ">
    <TrashIcon class="w-3 h-8" />
  </Link>
</template>
</div>
  </li>

</template>

<style scoped>

.drag > div {
transform: rotate(5deg);
}
.ghost{
  background: lightgray;
  border-radius: 6px;

}

.ghost > div {
  visibility: hidden;
}
</style>
