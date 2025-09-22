import { PaymentStatus } from '@/enums/PaymentStatus'
import { ServiceOrder } from '@/interfaces/ServiceOrder'

export interface ServiceOrderSparePart {
    id: number
    name: string
    price: number
    status: PaymentStatus
    serviceOrders: ServiceOrder
}
