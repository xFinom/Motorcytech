import { ServiceOrderStatus } from '@/enums/ServiceOrderStatus'
import { Motorcycle } from '@/interfaces/Motorcycle'
import { PaginatedList } from '@/interfaces/PaginatedList'
import { PrivateMessage } from '@/interfaces/PrivateMessage'
import { Service } from '@/interfaces/Service'
import { ServiceOrderBill } from '@/interfaces/ServiceOrderBill'
import { ServiceOrderSparePart } from '@/interfaces/ServiceOrderSparePart'
import { Client } from '@/interfaces/User'

export interface ServiceOrder {
    id: string
    entry_date: string
    delivery_date: string
    note: string
    status: ServiceOrderStatus
    motorcycle: Motorcycle
    client: Client
    service: Service
    spareParts?: ServiceOrderSparePart[]
    bills?: ServiceOrderBill[]
    privateMessages?: PrivateMessage[]
}

export type PaginatedServiceOrderList = PaginatedList<ServiceOrder>
