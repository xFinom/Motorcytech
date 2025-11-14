import { ApprovalStatus } from '@/enums/ApprovalStatus'
import { EventType } from '@/enums/Event'

export interface ServiceOrderEvent {
    id: number
    type: EventType,
    approval_status: ApprovalStatus,
    title: string,
    description: string,
    data: object,
    created_at: string,
}
