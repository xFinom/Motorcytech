import { ServiceOrder } from '@/interfaces/ServiceOrder'
import { User } from '@/types'

export interface PrivateMessage {
    id: number
    message: string
    user: User
    serviceOrder: ServiceOrder
}
