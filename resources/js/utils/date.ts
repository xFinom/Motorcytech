export function formatDate(value: string, locale = 'es-MX') {
    if (!value) return ''
    return new Intl.DateTimeFormat(locale, {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
    }).format(new Date(value))
}

export function formatHour24(value: string, locale = 'es-MX'): string {
    if (!value) return ''

    const date = new Date(value)

    return new Intl.DateTimeFormat(locale, {
        hour: '2-digit',
        minute: '2-digit',
        hour12: false,
    }).format(date)
}
