<template>
    <textarea class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        :value="modelValue" @input="onInput" ref="input"></textarea>
</template>
<script lang="ts" setup>
    import { defineProps, defineEmits, ref, onMounted } from 'vue';

    interface Props {
        modelValue: string;
    }

    interface Emits {
        'update:modelValue': (value: string) => void;
    }

    defineProps<Readonly<Props>>();
    defineEmits<Emits>();
    
    const input = ref<HTMLTextAreaElement | null>(null);

    onMounted(() => {
        if (input.value?.hasAttribute('autofocus')) {
            input.value.focus();
        }
    });

    function onInput(event: Event) {
        const target = event.target as HTMLTextAreaElement;
        $emit('update:modelValue', target.value);
    }
</script>