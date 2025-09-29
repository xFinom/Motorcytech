import { ServiceOrder } from '@/interfaces/ServiceOrder'
import { User } from '@/interfaces/User'

export interface PrivateMessage {
    id: number
    message: string
    created_at: string
    user: User
    serviceOrder?: ServiceOrder
}
