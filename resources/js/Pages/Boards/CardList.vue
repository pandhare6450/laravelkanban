<script setup>
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
import { Cog6ToothIcon, PencilIcon, PlusIcon } from '@heroicons/vue/24/solid'
import CardListItemCreateForm from '@/Pages/Boards/CardListItemCreateForm.vue'
import CardListItem from '@/Pages/Boards/CardListItem.vue'
import { nextTick, ref, watch } from 'vue';
import Draggable from "vuedraggable";
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/vue3';// Adjust based on Vue version
const props = defineProps({
  list: Object
})
const cards = ref(props.list.cards);
watch(() => props.list.cards, (newCards) => cards.value = newCards);
const listRef = ref()
async function onCardCreated() {
  await nextTick()
  listRef.value.scrollTop = listRef.value.scrollHeight;
}

function onChange(e) {
  let item = e.added || e.moved;
  if (!item) return;
  let index = item.newIndex;
  let prevCard = cards.value[index - 1];
  let nextCard = cards.value[index + 1];
  let card = cards.value[index];

  let position = card.position;

  if (prevCard && nextCard) {
    position = (prevCard.position + nextCard.position) / 2;
  } else if (prevCard) {
    position = prevCard.position + (prevCard.position / 2);
  } else if (nextCard) {
    position = nextCard.position / 2;
  }

  Inertia.patch(route('cards.move', { card: card.id }), {
    position: position,
    cardListId: props.list.id
  });
}

</script>


<template>
  <div class="w-72 bg-gray-200 max-h-full flex flex-col rounded-md ">
    <div class="flex items-center justify-between px-3 py-2">
      <h3 class="text-sm font-semibold text-gray-700">{{ list.name }}</h3>
      <Menu as="div" class="relative z-10">
        <MenuButton class="hover:bg-gray-300 w-8 h-8 rounded-md grid place-content-center">
          <Cog6ToothIcon class="w-5 h-5" />
        </MenuButton>
        <transition enter-active-class="transition transform duration-100 ease-out"
          enter-from-class="opacity-0 scale-90" enter-to-class="opacity-100 scale-100"
          leave-active-class="transition transform duration-100 ease-in" leave-from-class="opacity-100 scale-100"
          leave-to-class="opacity-0 scale-90">
          <MenuItems
            class="origin-top-left mt-2 focus:outline-none absolute left-0 bg-white overflow-hidden rounded-md shadow-lg border w-40">
            <MenuItem v-slot="{ active }">
            <a href="#" :class="{ 'bg-gray-100': active }" class="block px-4 py-2 text-sm text-gray-700">Add
              Card</a>
            </MenuItem>
            <MenuItem v-slot="{ active }">
            <Link :href="route('list.delete', { id: list.id })" method="delete" as="button"
              :class="{ 'bg-gray-100': active }"
              class="block px-4 py-2 text-sm text-red-600 cursor-pointer w-full text-left">
            Delete list
            </Link>
            </MenuItem>
          </MenuItems>
        </transition>
      </Menu>
    </div>
    <div class=" pb-3 flex flex-col overflow-hidden">
      <div class="px-3 flex-1 overflow-y-auto" ref="listRef">


        <Draggable v-model="cards" class="space-y-3" drag-class="drag" ghost-class="ghost" group="cards" item-key="id"
          tag="ul" @change="onChange">
          <template #item="{ element }">
            <CardListItem :card="element" />
          </template>
        </Draggable>


        <!--        <ul class="space-y-3">-->
        <!--          <CardListItem -->
        <!--          v-for="card in list.cards"-->
        <!--          :key="card.key"-->
        <!--          :card="card"-->
        <!--          />-->
        <!--        </ul>-->
      </div>
      <div class="mt-3">
        <CardListItemCreateForm :list="list" @created="onCardCreated()" />

      </div>
    </div>
  </div>
</template>
