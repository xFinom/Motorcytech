<script setup lang="ts">
import { Icon } from '@iconify/vue'

import MenuSection from '@/Components/Dashboard/MenuSection.vue'
import NavUser from '@/Components/Dashboard/NavUser.vue'
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    SidebarProps,
} from '@/Components/ui/sidebar'
import { employeeMenu, financeMenu, salesMenu, serviceOrderMenu } from '@/constants/sidebarMenus'

const props = withDefaults(defineProps<SidebarProps>(), {
    variant: 'inset',
})

const servideOrderMenuItems = serviceOrderMenu
const financeMenuItems = financeMenu
const salesMenuItems = salesMenu
const employeeMenuItems = employeeMenu
</script>

<template>
    <Sidebar v-bind="props">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <a class="flex items-center justify-center" :href="route('dashboard.overview')">
                            <div class="flex items-center justify-center">
                                <Icon icon="mdi:tools" class="mr-1 text-2xl text-primary" />
                                <div class="text-xl font-black uppercase tracking-wide">
                                    <span> Motorcy</span>
                                    <span class="font-semibold text-primary">tech </span>
                                </div>
                            </div>
                        </a>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>
        <SidebarContent>
            <MenuSection label="Servicios" :items="servideOrderMenuItems" />
            <MenuSection label="Tienda" :items="salesMenuItems" />
            <MenuSection label="Agenda" :items="employeeMenuItems" />
            <MenuSection label="Business Intelligence" :items="financeMenuItems" />
        </SidebarContent>
        <SidebarFooter>
            <NavUser />
        </SidebarFooter>
    </Sidebar>
</template>
