<script setup>
import { ref , nextTick} from 'vue'
import { useForm } from '@inertiajs/vue3';
import { PlusIcon } from '@heroicons/vue/24/solid';
import InputError from '@/Components/InputError.vue'

const props = defineProps({
  column: Object
})

const emit = defineEmits(['created'])

const form = useForm({
  content: '',
})

const inputCardContentRef = ref()
const isCreating = ref(false)

const onSubmit = () => {
  form.post(route('columns.cards.store', { column: props?.column?.id }), {
    onSuccess: () => {
      form.reset()
      isCreating.value = false
      emit('created')
    }
  })
}

const showForm = async () => {
  isCreating.value = true
  await nextTick() // await for form to be rendered
  inputCardContentRef.value.focus()
}
</script>

<template>
  <div>
    <form
      v-if="isCreating"
      @keydown.esc="isCreating = false"
      @submit.prevent="onSubmit"
    >
      <textarea 
        ref="inputCardContentRef"
        v-model="form.content"
        type="text"
        placeholder="Card content ..."
        rows="3"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
        @keydown.enter.prevent="onSubmit"
      />
      <div class="my-2 px-1" v-if="$page.props.errors">
        <InputError class="text-xl" :message="$page.props.errors.content" />
      </div>
      <div class="mt-2 space-x-2">
        <button
          type="submit"
          class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
          Add Card
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
      <PlusIcon class="w-5 h-5" />
      <span class="ml-1">Add Card</span>
    </button>
  </div>
</template>