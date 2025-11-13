export enum EventType {
    STATUS_CHANGED = 'StatusChange',
    SERVICE_CHANGE = 'ServiceChange',
    SPARE_PART_QUOTE = 'SparePartQuote',
    BILL_GENERATED = 'BillGenerated',
}

const eventIcons: Record<EventType, string> = {
    [EventType.STATUS_CHANGED]: 'mdi:receipt-text',
    [EventType.SERVICE_CHANGE]: 'mdi:tools',
    [EventType.SPARE_PART_QUOTE]: 'mingcute:loading-line',
    [EventType.BILL_GENERATED]: 'mdi:credit-card-clock',
}

export function getEventStatusIcon(event: EventType): string {
    return eventIcons[event]
}
