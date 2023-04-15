
  <script lang="ts">
    import { defineComponent, defineProps, ref } from 'vue';
    import {
      Head,
      Link,
      useForm,
    } from '@inertiajs/vue3';
    import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import BreezeLabel from '@/Components/InputLabel.vue';
    import BreezeInput from '@/Components/TextInput.vue';
    import BreezeTextArea from '@/Components/TextInput.vue';
    
    interface FormData {
      name: string;
      email: string;
    }
    
    interface user {
    id: number,
    name: string,
    email: string
}

  defineProps<{
      user: string;
  }>()
    
    export default defineComponent({
      name: 'EditUser',
      components: {
        BreezeAuthenticatedLayout,
        BreezeLabel,
        BreezeInput,
        BreezeTextArea,
      },
      props: defineProps(),
      setup(props) {

        console.log(props.user," ============ ");
        const form = useForm<FormData>({
          name: user || '',
          email: user|| '',
        });
        const errors = ref<DefineFormErrors>({
          name: null,
          email: null,
        });
    
        const submit = () => {
          form.put(route('users.update', props.user.id), {
            errorBag: errors,
            preserveScroll: true,
          });
        };
    
        return {
          form,
          errors,
          submit,
        };
      },
    });
    </script>

<template>
  <div>
    <Head title=" Edit User " />
    <BreezeAuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Edit user
        </h2>
      </template>
      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
              <div class="flex items-center justify-between mb-6">
                <Link
                  class="px-6 py-2 text-white bg-blue-500 rounded-md focus:outline-none"
                  :href="route('users.index')"
                >
                  Back
                </Link>
              </div>
              <form name="createForm" @submit.prevent="submitForm">
                <div class="flex flex-col">
                  <div class="mb-4">
                    <BreezeLabel for="name" value="Name" />
                    <BreezeInput
                      id="name"
                      type="text"
                      class="mt-1 block w-full"
                      v-model="form.name"
                      autofocus
                    />
                    <span class="text-red-600" v-if="form.errors.name">
                      {{ form.errors.name }}
                    </span>
                  </div>
                  <div class="mb-4">
                    <BreezeLabel for="email" value="Email" />
                    <BreezeInput
                      id="email"
                      type="email"
                      class="mt-1 block w-full"
                      v-model="form.email"
                      autofocus
                    />
                    <span class="text-red-600" v-if="form.errors.email">
                      {{ form.errors.email }}
                    </span>
                  </div>
                </div>
                <div class="mt-4">
                  <button
                    type="submit"
                    class="px-6 py-2 font-bold text-white bg-green-500 rounded"
                  >
                    Save
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </BreezeAuthenticatedLayout>
    </div>
  </template>