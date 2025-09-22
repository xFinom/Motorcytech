export function formatDate(value: string, locale = "es-MX") {
    if (!value) return ""
    return new Intl.DateTimeFormat(locale, {
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
    }).format(new Date(value))
}
