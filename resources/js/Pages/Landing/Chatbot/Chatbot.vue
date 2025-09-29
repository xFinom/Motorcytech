<script setup lang="ts">
import { ref } from "vue"
import { Popover, PopoverTrigger, PopoverContent } from "@/Components/ui/popover"
import { Card, CardHeader, CardTitle, CardDescription, CardContent, CardFooter } from "@/Components/ui/card"
import { Input } from "@/Components/ui/input"
import { Button } from "@/Components/ui/button"
import { Icon } from "@iconify/vue"

const messages = ref([
  { from: "agent", text: "¿Cómo te puedo ayudar hoy?" },
])

const newMessage = ref("")
const sendMessage = () => {
  if (newMessage.value.trim() !== "") {
    messages.value.push({ from: "user", text: newMessage.value })
    newMessage.value = ""
  }
}
</script>

<template>
  <div class="fixed bottom-6 right-6">
    <Popover>
      <!-- BOTÓN DEL CHAT (ALARGADO, NO CIRCULAR) -->
      <PopoverTrigger as-child>
        <Button
          class="rounded-xl px-4 py-2 flex items-center gap-2 shadow-lg 
                 bg-primary text-white hover:bg-primary/90"
        >
          <span class="text-sm font-medium">Ayuda</span>
          <Icon icon="mdi:chat-processing-outline" class="w-5 h-5" />
        </Button>
      </PopoverTrigger>

      <!-- CONTENEDOR DEL CHAT -->
      <PopoverContent
        class="w-80 p-0 mr-2 shadow-xl rounded-xl border 
               bg-white text-gray-900 border-gray-200 
               dark:bg-[#061222] dark:text-white dark:border-gray-800"
      >
        <Card class="border-none bg-transparent">
          <!-- HEADER -->
          <CardHeader
            class="flex items-center gap-2 border-b 
                   border-gray-200 dark:border-gray-800"
          >
            <div
              class="w-10 h-10 rounded-full bg-orange-500 flex items-center justify-center"
            >
              <Icon icon="mdi:robot-outline" class="w-6 h-6 text-white" />
            </div>
            <div>
              <CardTitle class="text-sm">Motorcybot</CardTitle>
              <CardDescription
                class="text-gray-500 text-xs dark:text-gray-400"
              >
                Asistente virtual
              </CardDescription>
            </div>
          </CardHeader>

          <!-- MENSAJES -->
          <CardContent class="h-64 overflow-y-auto space-y-3 p-4">
            <div v-for="(msg, i) in messages" :key="i" class="flex">
              <div
                :class="msg.from === 'user'
                  ? 'ml-auto bg-primary text-white rounded-lg px-3 py-2 max-w-[75%]'
                  : 'mr-auto bg-gray-100 text-gray-900 rounded-lg px-3 py-2 max-w-[75%] dark:bg-gray-800 dark:text-gray-200'"
              >
                {{ msg.text }}
              </div>
            </div>
          </CardContent>

          <!-- INPUT -->
          <CardFooter
            class="flex items-center gap-2 border-t 
                   border-gray-200 dark:border-gray-800 p-3"
          >
            <Input
              v-model="newMessage"
              placeholder="Escribe tu mensaje..."
              class="bg-gray-100 text-gray-900 border border-gray-200 
                     focus-visible:ring-1 focus-visible:ring-primary
                     dark:bg-gray-800 dark:text-white dark:border-0"
            />
            <Button
              size="icon"
              class="rounded-full bg-primary text-white hover:bg-primary/90"
              @click="sendMessage"
            >
              <Icon icon="mdi:send" class="w-5 h-5" />
            </Button>
          </CardFooter>
        </Card>
      </PopoverContent>
    </Popover>
  </div>
</template>


