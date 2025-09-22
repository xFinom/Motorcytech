import { UserRole } from '@/constants/enums/UserRole'
import { PrivateMessage } from '@/interfaces/PrivateMessage'
import { Review } from '@/interfaces/Review'

export interface BaseUser {
    id?: number
    name: string
    email: string
    role: UserRole
    privateMessages: PrivateMessage[]
}

export interface Client extends BaseUser {
    role: UserRole.CLIENTE
    rfc: string | null
    phone: string
    address: string
    reviews: Review[]
}

export interface Worker extends BaseUser {
    role: UserRole.TRABAJADOR
    phone: string | null
    address: string | null
}

export interface Admin extends BaseUser {
    role: UserRole.ADMIN
}

export type User = Client | Worker | Admin
