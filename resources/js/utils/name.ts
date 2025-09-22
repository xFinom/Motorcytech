export function generateInitials(name: string): string {
    const firstMatch = name.match(/(^\S\S?|\s\S)?/g) || []

    const cleaned = firstMatch.map((v: string) => v.trim()).join('')

    const finalMatch = cleaned.match(/(^\S|\S$)?/g) || []

    return finalMatch.join('').toLocaleUpperCase()
}
