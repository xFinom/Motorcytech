import { PaymentStatus } from '@/enums/PaymentStatus'
import { ServiceOrder } from '@/interfaces/ServiceOrder'
import { ApprovalStatus } from '@/enums/ApprovalStatus'

export interface ServiceOrderSparePart {
    id: number
    name: string
    price: number
    payment_status: PaymentStatus
    approval_status: ApprovalStatus
    serviceOrders: ServiceOrder
}
