<script setup>

import { Label } from '@/components/ui/label/index.js';
import { Input } from '@/components/ui/input/index.js';
import { useForm } from '@inertiajs/vue3';
import FormBase from '@/layouts/AuthLayout.vue';
import { TextArea } from '@/components/ui/textarea/index.js';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card/index.js';

const form = useForm({
    title: '',
    desc: '',
    url: '',
    cook_time: 0,
    prep_time: 0,
    tags: '',
    servings: 0,
    // password: '',
    // remember: false,
});
</script>

<template>
    <FormBase title="Recept hozzáadása">
        <form class="flex flex-col gap-6">
            <div class="grid gap-6">
                <div class="flex flex-col gap-6">
                    <Card class="rounded-xl">
                        <CardHeader class="px-10 pt-8 pb-0 text-center">
                            <CardTitle class="text-xl">Alapadatok</CardTitle>
                            <CardDescription>
                            </CardDescription>
                        </CardHeader>
                        <CardContent class="px-10 py-8">
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
                                    rows="5"
                                    autofocus
                                    autocomplete="desc"
                                    v-model="form.desc"
                                    placeholder="Ez egy ilyen meg olyan recept..."
                                >
                                </TextArea>
                            </div>
                            <slot />
                        </CardContent>
                    </Card>
                </div>

                <div class="flex flex-col gap-6">
                    <Card class="rounded-xl">
                        <CardHeader class="px-10 pt-8 pb-0 text-center">
                            <CardTitle class="text-xl">Elkészítéshez és sütéshez idő percben és adagok száma</CardTitle>
                        </CardHeader>
                        <CardContent class="px-10 py-8">
                            <div class="grid grid-cols-3 gap-6">
                                <div class="flex flex-col gap-2">
                                    <Label for="prep_time">Elkészítés</Label>
                                    <Input
                                        id="prep_time"
                                        type="number"
                                        autofocus
                                        :tabindex="1"
                                        min="0"
                                        step="5"
                                        autocomplete="prep_time"
                                        v-model="form.prep_time"
                                        placeholder="30"
                                    >
                                    </Input>
                                </div>

                                <div class="flex flex-col gap-2">
                                    <Label for="cook_time">Sütés</Label>
                                    <Input
                                        id="cook_time"
                                        type="number"
                                        autofocus
                                        :tabindex="1"
                                        min="0"
                                        step="5"
                                        autocomplete="cook_time"
                                        v-model="form.cook_time"
                                        placeholder="40"
                                    >
                                    </Input>
                                </div>

                                <div class="flex flex-col gap-2">
                                    <Label for="servings">Adag</Label>
                                    <Input
                                        id="servings"
                                        type="number"
                                        autofocus
                                        :tabindex="1"
                                        min="1"
                                        step="1"
                                        autocomplete="servings"
                                        v-model="form.servings"
                                        placeholder="4"
                                    >
                                    </Input>
                                </div>
                            </div>
                            <slot />
                        </CardContent>
                    </Card>
                </div>

                <div class="flex flex-col gap-6">
                    <Card class="rounded-xl">
                        <CardHeader class="px-10 pt-8 pb-0 text-center">
                            <CardTitle class="text-xl">Hozzávalók</CardTitle>
                        </CardHeader>
                        <CardContent class="px-10 py-8">
                            <div class="grid grid-cols-3 gap-6">
                                <div class="flex flex-col gap-2">
                                    <Label for="qty">Mennyi...</Label>
                                    <Input
                                        id="qty"
                                        type="number"
                                        autofocus
                                        :tabindex="1"
                                        min="0"
                                        step="5"
                                        autocomplete="qty"
                                        v-model="form.qty"
                                        placeholder="1"
                                    >
                                    </Input>
                                </div>

                                <div class="flex flex-col gap-2">
                                    <Label for="unit">Mrtkegys.</Label>
                                    <Input
                                        id="unit"
                                        type="number"
                                        autofocus
                                        :tabindex="1"
                                        min="0"
                                        step="5"
                                        autocomplete="cook_time"
                                        v-model="form.cook_time"
                                        placeholder="40"
                                    >
                                    </Input>
                                </div>

                                <div class="flex flex-col gap-2">
                                    <Label for="ingredient">Hozzávaló</Label>
                                    <Input
                                        id="ingredient"
                                        type="text"
                                        autofocus
                                        :tabindex="1"
                                        autocomplete="ingredient"
                                        v-model="form.ingredient"
                                        placeholder="Liszt"
                                    >
                                    </Input>
                                </div>
                            </div>
                            <slot />
                        </CardContent>
                    </Card>
                </div>


                <div class="grid gap-2">
                    <Label for="url">Link</Label>
                    <Input
                        id="url"
                        type="url"
                        autofocus
                        :tabindex="1"
                        autocomplete="url"
                        v-model="form.url"
                        placeholder="https://vm.tiktok.com/ZNd9jhnWo/"
                    >
                    </Input>
                </div>
            </div>
        </form>
    </FormBase>
</template>
