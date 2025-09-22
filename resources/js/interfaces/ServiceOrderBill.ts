import { PaymentStatus } from '@/enums/PaymentStatus'
import { ServiceOrder } from '@/interfaces/ServiceOrder'

export interface ServiceOrderBill {
    id: number
    description: string
    price: number
    status: PaymentStatus
    serviceOrders: ServiceOrder[]
}
