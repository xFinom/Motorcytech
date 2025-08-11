import { useDark, useToggle } from '@vueuse/core'

export const isDark = useDark({ selector: 'html' })
const toggleDark = useToggle(isDark)

export function toggleDarkMode() {
    toggleDark()
}
