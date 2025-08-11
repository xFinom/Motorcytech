<script setup lang="ts">
import { ChevronRight } from 'lucide-vue-next'

import { Collapsible, CollapsibleContent, CollapsibleTrigger } from '@/Components/ui/collapsible'
import {
    SidebarGroup,
    SidebarGroupLabel,
    SidebarMenu,
    SidebarMenuAction,
    SidebarMenuButton,
    SidebarMenuItem,
    SidebarMenuSub,
    SidebarMenuSubButton,
    SidebarMenuSubItem,
} from '@/Components/ui/sidebar'
import { MenuItem } from '@/types/MenuItem'

defineProps<{
    label?: string
    items: MenuItem[]
}>()
</script>

<template>
    <SidebarGroup>
        <SidebarGroupLabel v-if="label">{{ label }}</SidebarGroupLabel>
        <SidebarMenu>
            <Collapsible
                v-for="item in items"
                :key="item.title"
                as-child
                :default-open="item.isActive"
            >
                <SidebarMenuItem>
                    <SidebarMenuButton as-child :tooltip="item.title">
                        <a :href="item.url">
                            <component class="text-[#fb5607]" :is="item.icon" />
                            <span class="font-semibold">{{ item.title }}</span>
                        </a>
                    </SidebarMenuButton>
                    <template v-if="item.items?.length">
                        <CollapsibleTrigger as-child>
                            <SidebarMenuAction class="data-[state=open]:rotate-90">
                                <ChevronRight class="text-[#fb5607]" />
                                <span class="sr-only">Toggle</span>
                            </SidebarMenuAction>
                        </CollapsibleTrigger>
                        <CollapsibleContent>
                            <SidebarMenuSub>
                                <SidebarMenuSubItem
                                    v-for="subItem in item.items"
                                    :key="subItem.title"
                                >
                                    <SidebarMenuSubButton as-child>
                                        <a :href="subItem.url">
                                            <span>{{ subItem.title }}</span>
                                        </a>
                                    </SidebarMenuSubButton>
                                </SidebarMenuSubItem>
                            </SidebarMenuSub>
                        </CollapsibleContent>
                    </template>
                </SidebarMenuItem>
            </Collapsible>
        </SidebarMenu>
    </SidebarGroup>
</template>
