<script setup>

import { Label } from '@/components/ui/label/index.js';
import { Input } from '@/components/ui/input/index.js';
import { useForm } from '@inertiajs/vue3';
import FormBase from '@/layouts/AuthLayout.vue';
import { TextArea } from '@/components/ui/textarea/index.js';

const form = useForm({
    title: '',
    desc: '',
    // password: '',
    // remember: false,
});
</script>

<template>
    <FormBase title="Recept hozzáadása">
        <form class="flex flex-col gap-6">
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="title">Cím</Label>
                    <Input
                        id="title"
                        type="text"
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="title"
                        v-model="form.title"
                        placeholder="Túrós Tészta"
                    >
                    </Input>
                </div>

                <div class="grid gap-2">
                    <Label for="title">Leírás</Label>
                    <TextArea
                        id="desc"
                        rows="15"
                        required
                        autofocus
                        autocomplete="desc"
                        v-model="form.desc"
                        placeholder="Ez egy ilyen meg olyan recept..."
                    >
                    </TextArea>
                </div>
            </div>
        </form>
    </FormBase>
</template>
