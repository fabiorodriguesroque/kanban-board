<script setup>
import { ref, nextTick } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { PlusIcon } from '@heroicons/vue/24/solid';
import InputError from '@/Components/InputError.vue'

const props = defineProps({
  board: Object
})

const form = useForm({
  title: ''
})

const inputColumnNameRef = ref()
const isCreating = ref(false)

const onSubmit = () => {
  // todo: continue here ...
  form.post(route('boards.columns.store', { board: props?.board }), {
    onSuccess: () => {
      form.reset()
      isCreating.value = false
    }
  })
}

const showForm = async () => {
  isCreating.value = true
  await nextTick() // await for form to be rendered
  inputColumnNameRef.value.focus()
}
</script>

<template>
  <div>
    <form 
      v-if="isCreating"
      @keydown.esc="isCreating = false"
      @submit.prevent="onSubmit"
      class="p-3 bg-gray-200 rounded-md"
    > 
      <input
        v-model="form.title"
        @keydown.esc="isCreating = false"
        placeholder="Column name ..."
        ref="inputColumnNameRef"
        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
      />
      <div class="my-2 px-1">
        <InputError :message="$page.props.errors.title" />
      </div>
      <div class="mt-2 space-x-2">
        <button
          type="submit"
          class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
          Add column
        </button>
        <button
          @click.prevent="isCreating = false"
          type="button"
          class="inline-flex items-center rounded-md border border-transparent px-4 py-2 text-sm font-medium text-gray-700 hover:text-black focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
          Cancel
        </button>
      </div>
    </form>
    <button
      v-if="!isCreating"
      @click.prevent="showForm"
      type="button"
      class="flex items-center p-2 text-sm rounded-md font-medium bg-gray-200 text-gray-600 hover:text-black hover:bg-gray-300 w-full"
    >
      <PlusIcon class="w-4 h-4"/>
      <span class="ml-1">Add another list</span>
    </button>
  </div>
</template>