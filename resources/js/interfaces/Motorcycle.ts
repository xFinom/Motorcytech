import { MotorcycleType } from '@/interfaces/MotorcycleType'
import { PaginatedList } from '@/interfaces/PaginatedList'
import { Client } from '@/interfaces/User'

export interface Motorcycle {
    id: number
    placa: string
    serial_num: string
    motor_num: string
    year: number
    type: MotorcycleType
    cliente: Client
}

export type PaginatedMotorcycleList = PaginatedList<Motorcycle>
