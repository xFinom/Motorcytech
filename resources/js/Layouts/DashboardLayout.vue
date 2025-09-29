<script setup lang="ts">
import { Head } from '@inertiajs/vue3'

import { Icon } from '@iconify/vue'

import Sidebar from '@/Components/Dashboard/Sidebar.vue'
import {
    Breadcrumb,
    BreadcrumbItem,
    BreadcrumbLink,
    BreadcrumbList,
    BreadcrumbPage,
    BreadcrumbSeparator,
} from '@/Components/ui/breadcrumb'
import { Button } from '@/Components/ui/button'
import { SidebarInset, SidebarProvider, SidebarTrigger } from '@/Components/ui/sidebar'
import { isDark, toggleDarkMode } from '@/lib/darkMode'
</script>

<template>
    <Head title="Dashboard" />

    <SidebarProvider>
        <Sidebar />
        <SidebarInset>
            <header class="flex h-16 shrink-0 items-center gap-2 border-b px-4">
                <SidebarTrigger class="-ml-1" />
                <Separator orientation="vertical" class="mr-2 h-4" />
                <Breadcrumb>
                    <BreadcrumbList>
                        <BreadcrumbItem class="hidden md:block">
                            <BreadcrumbLink href="#"> Ordenes de Servicio </BreadcrumbLink>
                        </BreadcrumbItem>
                        <BreadcrumbSeparator class="hidden text-primary md:block" />
                        <BreadcrumbItem>
                            <BreadcrumbPage>Registro</BreadcrumbPage>
                        </BreadcrumbItem>
                    </BreadcrumbList>
                </Breadcrumb>
                <Button
                    variant="ghost"
                    class="ml-auto rounded-md font-normal text-foreground transition-colors duration-300 focus:outline-none dark:text-gray-200"
                    @click="toggleDarkMode"
                >
                    <Icon
                        :icon="
                            isDark
                                ? 'line-md:moon-alt-to-sunny-outline-loop-transition'
                                : 'line-md:sunny-outline-to-moon-loop-transition'
                        "
                    />
                </Button>
            </header>
            <div class="flex flex-1 flex-col gap-4 px-4 py-10">
                <slot />
            </div>
        </SidebarInset>
    </SidebarProvider>
</template>
