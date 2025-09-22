import { User } from '@/types'
import { ServiceOrder } from '@/interfaces/ServiceOrder'

export interface PrivateMessage {
    id: number;
    message: string;
    user: User;
    serviceOrder: ServiceOrder;
}
